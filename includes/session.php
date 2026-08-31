<?php
declare(strict_types=1);

$sessionPath = __DIR__ . '/../storage/sessions';
if (!is_dir($sessionPath)) {
    mkdir($sessionPath, 0775, true);
}

if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    session_save_path($sessionPath);
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

function clear_legacy_admin_session(): void
{
    foreach (['admin_logged_in', 'admin_user'] as $legacyKey) {
        if (isset($_SESSION[$legacyKey])) {
            unset($_SESSION[$legacyKey]);
        }
    }
}

clear_legacy_admin_session();

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function current_user(): ?array
{
    if (isset($_SESSION['user']) && is_array($_SESSION['user']) && !empty($_SESSION['user']['id'])) {
        return $_SESSION['user'];
    }
    return null;
}

function is_logged_in(): bool
{
    return current_user() !== null;
}

function is_admin(): bool
{
    $user = current_user();
    return ($user['role'] ?? '') === 'admin';
}

function get_authenticated_customer(?PDO $conn = null): ?array
{
    $user = current_user();
    if (!$user || !isset($user['id']) || (int) $user['id'] <= 0 || ($user['role'] ?? '') !== 'customer') {
        return null;
    }

    if ($conn instanceof PDO) {
        try {
            $stmt = $conn->prepare("SELECT id, name, email, role FROM users WHERE id = ? AND role = 'customer' LIMIT 1");
            $stmt->execute([(int) $user['id']]);
            $dbUser = $stmt->fetch();
            if (!$dbUser) {
                unset($_SESSION['user']);
                return null;
            }
            return [
                'id' => (int) $dbUser['id'],
                'name' => (string) $dbUser['name'],
                'email' => (string) $dbUser['email'],
                'role' => (string) $dbUser['role'],
            ];
        } catch (PDOException $e) {
            error_log('Customer auth DB verification failed: ' . $e->getMessage());
            return null;
        }
    }

    return $user;
}

function require_customer(PDO $conn, string $redirect = 'checkout.php'): array
{
    $customer = get_authenticated_customer($conn);
    if ($customer === null) {
        $query = $redirect !== '' ? '?redirect=' . urlencode($redirect) : '';
        header('Location: login.php' . $query);
        exit;
    }

    return $customer;
}

function login_user(array $user): void
{
    if (session_status() === PHP_SESSION_NONE || headers_sent()) {
        return;
    }

    session_regenerate_id(true);
    foreach (['admin_logged_in', 'admin_user'] as $legacyKey) {
        unset($_SESSION[$legacyKey]);
    }
    $_SESSION['user'] = [
        'id' => (int) $user['id'],
        'name' => (string) $user['name'],
        'email' => (string) $user['email'],
        'role' => (string) $user['role'],
    ];
}

function logout_user(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        return;
    }

    $_SESSION = [];
    foreach (['admin_logged_in', 'admin_user'] as $legacyKey) {
        unset($_SESSION[$legacyKey]);
    }
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'] ?? '', (bool) ($params['secure'] ?? false), (bool) ($params['httponly'] ?? true));
    }
    session_destroy();
}

function require_admin(): void
{
    if (!is_admin()) {
        header('Location: login.php');
        exit;
    }
}

function first_name(?array $user = null): string
{
    $user ??= current_user();
    $name = trim((string) ($user['name'] ?? ''));
    if ($name === '') {
        return 'Account';
    }
    return strtok($name, ' ') ?: $name;
}

function cart_count(): int
{
    $count = 0;
    foreach (($_SESSION['cart'] ?? []) as $quantity) {
        $count += max(0, (int) $quantity);
    }
    return $count;
}
?>
