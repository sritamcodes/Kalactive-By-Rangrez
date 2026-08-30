<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/session.php';

if (is_logged_in()) {
    header('Location: index.php');
    exit;
}

$error = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = (string) ($_POST['password'] ?? '');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
        $error = 'Invalid email or password.';
    } else {
        $stmt = $conn->prepare("SELECT id, name, email, password, role FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && $user['role'] === 'customer' && password_verify($password, $user['password'])) {
            login_user($user);
            header('Location: index.php');
            exit;
        }

        $error = 'Invalid email or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Kalactive</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-[#faf9f5] text-[#1b1c1a] font-[Inter] antialiased min-h-screen">
    <main class="max-w-[460px] mx-auto px-5 py-16">
        <a href="index.php" class="font-['Playfair_Display'] text-3xl text-[#5f5e58]">कला'ctive</a>
        <section class="mt-10 border border-[#c9c7bd] bg-[#f5f2ea] p-6 md:p-8">
            <p class="text-xs uppercase tracking-widest text-[#974724] mb-4">Account</p>
            <h1 class="font-['Playfair_Display'] text-4xl mb-6">Login</h1>
            <?php if ($error): ?><div class="border border-[#974724]/40 bg-[#ffdbce]/40 text-[#772f0d] p-3 mb-5"><?= e($error) ?></div><?php endif; ?>
            <form method="POST" class="space-y-5">
                <input class="w-full border-[#c9c7bd] bg-[#faf9f5]" type="email" name="email" placeholder="Email" value="<?= e($email) ?>" required>
                <input class="w-full border-[#c9c7bd] bg-[#faf9f5]" type="password" name="password" placeholder="Password" required>
                <button class="btn-primary w-full" type="submit">Login</button>
            </form>
            <div class="mt-6 flex flex-wrap gap-4 text-xs uppercase tracking-widest text-[#974724]">
                <a href="register.php" class="underline underline-offset-4">Create account</a>
                <a href="index.php" class="underline underline-offset-4">Back to store</a>
            </div>
        </section>
    </main>
</body>
</html>
