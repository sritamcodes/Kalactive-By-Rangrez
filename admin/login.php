<?php
require_once __DIR__ . '/../config/database.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Default admin credential check for starter scaffold
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user'] = 'Admin';
        header("Location: dashboard.php");
        exit;
    } else {
        $error = 'Invalid admin credentials. (Default: admin / admin123)';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body style="background: #0f172a; display: flex; align-items: center; justify-content: center; min-height: 100vh;">
    <div style="background: #ffffff; padding: 40px; border-radius: var(--radius); width: 100%; max-width: 420px; box-shadow: var(--shadow-lg);">
        <h1 style="font-size: 1.6rem; color: #0f172a; margin-bottom: 8px; text-align: center;">⚙️ Admin Panel</h1>
        <p style="color: var(--text-muted); text-align: center; margin-bottom: 24px; font-size: 0.95rem;">Enter credentials to access administration</p>

        <?php if ($error): ?>
            <div style="background: #fee2e2; color: var(--danger); padding: 10px; border-radius: 6px; margin-bottom: 16px; font-size: 0.9rem;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" required placeholder="admin">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; margin-top: 10px;">Sign In as Admin</button>
        </form>
    </div>
</body>
</html>
