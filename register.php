<?php
$pageTitle = 'Create Account';
require_once __DIR__ . '/config/database.php';

if (isLoggedIn()) {
    header("Location: index.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = sanitize($_POST['full_name'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if (empty($fullName) || empty($email) || empty($password)) {
        $error = 'Please fill in all required fields.';
    } elseif ($password !== $confirmPassword) {
        $error = 'Passwords do not match.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters long.';
    } else {
        $db = getDBConnection();
        $checkStmt = $db->prepare("SELECT id FROM users WHERE email = ?");
        $checkStmt->execute([$email]);
        if ($checkStmt->fetch()) {
            $error = 'An account with this email address already exists.';
        } else {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $insertStmt = $db->prepare("INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, 'customer')");
            if ($insertStmt->execute([$fullName, $email, $hashedPassword])) {
                $success = 'Account created successfully! You can now sign in.';
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
    }
}

include __DIR__ . '/includes/header.php';
?>

<main class="py-16 md:py-24 px-4 max-w-container-max mx-auto">
    <div class="max-w-md mx-auto border border-outline-variant p-8 md:p-12 bg-primary-container card-shadow">
        <div class="text-center mb-8">
            <h1 class="font-headline-xl text-headline-xl text-on-background mb-2">CREATE ACCOUNT</h1>
            <p class="font-body-md text-on-surface-variant">Join Kalactive to save favorites and track orders</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="mb-6 p-4 border border-error bg-error-container text-on-error-container text-sm font-body-md">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="mb-6 p-4 border border-secondary bg-surface-container text-secondary text-sm font-body-md">
                <?= $success; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="register.php" class="space-y-6">
            <div>
                <label class="block font-label-sm text-label-sm uppercase tracking-widest text-primary mb-2">FULL NAME</label>
                <input type="text" name="full_name" class="w-full bg-background border border-outline-variant focus:border-secondary focus:ring-0 px-4 py-3 font-body-md text-on-background transition-colors" required placeholder="Jane Doe">
            </div>

            <div>
                <label class="block font-label-sm text-label-sm uppercase tracking-widest text-primary mb-2">EMAIL ADDRESS</label>
                <input type="email" name="email" class="w-full bg-background border border-outline-variant focus:border-secondary focus:ring-0 px-4 py-3 font-body-md text-on-background transition-colors" required placeholder="jane@example.com">
            </div>

            <div>
                <label class="block font-label-sm text-label-sm uppercase tracking-widest text-primary mb-2">PASSWORD</label>
                <input type="password" name="password" class="w-full bg-background border border-outline-variant focus:border-secondary focus:ring-0 px-4 py-3 font-body-md text-on-background transition-colors" required placeholder="••••••••">
            </div>

            <div>
                <label class="block font-label-sm text-label-sm uppercase tracking-widest text-primary mb-2">CONFIRM PASSWORD</label>
                <input type="password" name="confirm_password" class="w-full bg-background border border-outline-variant focus:border-secondary focus:ring-0 px-4 py-3 font-body-md text-on-background transition-colors" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn-primary w-full py-4 text-center">
                CREATE ACCOUNT &rarr;
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-outline-variant/60 text-center">
            <p class="font-body-md text-on-surface-variant">
                Already have an account? <a href="login.php" class="text-secondary font-semibold hover:underline">Sign in here</a>
            </p>
        </div>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
