<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/session.php';

$errors = [];
$name = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = (string) ($_POST['password'] ?? '');
    $confirm = (string) ($_POST['confirm_password'] ?? '');

    if ($name === '') $errors[] = 'Please enter your full name.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter a valid email address.';
    if (strlen($password) < 8) $errors[] = 'Password must be at least 8 characters.';
    if ($password !== $confirm) $errors[] = 'Passwords do not match.';

    if (!$errors) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors[] = 'An account already exists for this email.';
        } else {
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'customer')");
            $stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);
            $userId = (int) $conn->lastInsertId();
            login_user(['id' => $userId, 'name' => $name, 'email' => $email, 'role' => 'customer']);
            header('Location: index.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | Kalactive</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-[#faf9f5] text-[#1b1c1a] font-[Inter] antialiased min-h-screen">
    <main class="max-w-[500px] mx-auto px-5 py-16">
        <a href="index.php" class="font-['Playfair_Display'] text-3xl text-[#5f5e58]">कला'ctive</a>
        <section class="mt-10 border border-[#c9c7bd] bg-[#f5f2ea] p-6 md:p-8">
            <p class="text-xs uppercase tracking-widest text-[#974724] mb-4">Account</p>
            <h1 class="font-['Playfair_Display'] text-4xl mb-6">Create Account</h1>
            <?php foreach ($errors as $error): ?><div class="border border-[#974724]/40 bg-[#ffdbce]/40 text-[#772f0d] p-3 mb-3"><?= e($error) ?></div><?php endforeach; ?>
            <form method="POST" class="space-y-5">
                <input class="w-full border-[#c9c7bd] bg-[#faf9f5]" name="name" placeholder="Full Name" value="<?= e($name) ?>" required>
                <input class="w-full border-[#c9c7bd] bg-[#faf9f5]" type="email" name="email" placeholder="Email" value="<?= e($email) ?>" required>
                <input class="w-full border-[#c9c7bd] bg-[#faf9f5]" type="password" name="password" placeholder="Password" required>
                <input class="w-full border-[#c9c7bd] bg-[#faf9f5]" type="password" name="confirm_password" placeholder="Confirm Password" required>
                <button class="btn-primary w-full" type="submit">Create Account</button>
            </form>
            <div class="mt-6 flex flex-wrap gap-4 text-xs uppercase tracking-widest text-[#974724]">
                <a href="login.php" class="underline underline-offset-4">Login</a>
                <a href="index.php" class="underline underline-offset-4">Back to store</a>
            </div>
        </section>
    </main>
</body>
</html>
