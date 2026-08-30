<?php
require_once __DIR__ . '/includes/product-functions.php';
require_once __DIR__ . '/includes/session.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: products.php');
    exit;
}

if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}

$productId = (int) ($_POST['product_id'] ?? 0);
$redirect = $_POST['redirect'] ?? 'products.php';
if (!preg_match('/^[a-z0-9_\-]+\.php(\?id=\d+)?$/i', $redirect)) {
    $redirect = 'products.php';
}

$product = $productId > 0 ? find_product($productId) : null;
if ($product) {
    ensure_wishlist_schema();
    $userId = (int) current_user()['id'];
    $stmt = $conn->prepare("SELECT id FROM wishlist WHERE user_id = ? AND product_id = ? LIMIT 1");
    $stmt->execute([$userId, $productId]);
    if ($stmt->fetch()) {
        $delete = $conn->prepare("DELETE FROM wishlist WHERE user_id = ? AND product_id = ?");
        $delete->execute([$userId, $productId]);
    } else {
        $insert = $conn->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)");
        try {
            $insert->execute([$userId, $productId]);
        } catch (PDOException $exception) {
            // Unique constraint races are harmless for a toggle endpoint.
        }
    }
}

header('Location: ' . $redirect);
exit;
?>
