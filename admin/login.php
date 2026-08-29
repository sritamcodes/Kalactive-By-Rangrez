<?php
require_once __DIR__ . '/../config/database.php';

if (isAdmin()) {
    header("Location: dashboard.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $db = getDBConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin'");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];

            header("Location: dashboard.php");
            exit();
        } else {
            $error = 'Invalid administrator credentials.';
        }
    } else {
        $error = 'Please fill in all fields.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Authentication | Kalactive</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-[#1c1815] text-[#faf9f5] flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-md border border-[#3c3631] bg-[#26211d] p-8 md:p-10 shadow-2xl">
        <div class="text-center mb-8">
            <a href="../index.php" class="font-serif text-3xl font-bold tracking-tight text-[#faf9f5]">कला'ctive</a>
            <p class="text-xs uppercase tracking-widest text-[#a39c92] mt-2">Administrator Access</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="mb-6 p-4 border border-red-500/50 bg-red-950/40 text-red-200 text-sm">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="login.php" class="space-y-6">
            <div>
                <label class="block text-xs uppercase tracking-widest text-[#a39c92] mb-2">ADMIN EMAIL</label>
                <input type="email" name="email" class="w-full bg-[#1c1815] border border-[#3c3631] focus:border-[#974724] focus:ring-0 px-4 py-3 text-sm text-[#faf9f5]" required placeholder="admin@kalactive.com">
            </div>

            <div>
                <label class="block text-xs uppercase tracking-widest text-[#a39c92] mb-2">PASSWORD</label>
                <input type="password" name="password" class="w-full bg-[#1c1815] border border-[#3c3631] focus:border-[#974724] focus:ring-0 px-4 py-3 text-sm text-[#faf9f5]" required placeholder="••••••••">
            </div>

            <button type="submit" class="w-full py-4 bg-[#974724] text-white text-xs font-semibold uppercase tracking-widest hover:bg-[#823b1d] transition-colors">
                AUTHENTICATE &rarr;
            </button>
        </form>

        <p class="text-center mt-6 text-xs text-[#a39c92]">
            <a href="../index.php" class="hover:underline">&larr; Return to Customer Storefront</a>
        </p>
    </div>

</body>
</html>
