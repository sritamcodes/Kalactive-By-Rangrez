<?php
$pageTitle = 'Sign In';
require_once __DIR__ . '/config/database.php';

if (isLoggedIn()) {
    header("Location: index.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = 'Please fill in both email and password fields.';
    } else {
        $db = getDBConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $error = 'Invalid email address or password.';
        }
    }
}

include __DIR__ . '/includes/header.php';
?>

<main class="py-16 md:py-24 px-4 max-w-container-max mx-auto">
    <div class="max-w-md mx-auto border border-outline-variant p-8 md:p-12 bg-primary-container card-shadow">
        <div class="text-center mb-8">
            <h1 class="font-headline-xl text-headline-xl text-on-background mb-2">WELCOME BACK</h1>
            <p class="font-body-md text-on-surface-variant">Sign in to your Kalactive account</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="mb-6 p-4 border border-error bg-error-container text-on-error-container text-sm font-body-md">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="login.php" class="space-y-6">
            <div>
                <label class="block font-label-sm text-label-sm uppercase tracking-widest text-primary mb-2">EMAIL ADDRESS</label>
                <input type="email" name="email" class="w-full bg-background border border-outline-variant focus:border-secondary focus:ring-0 px-4 py-3 font-body-md text-on-background transition-colors" required placeholder="user@kalactive.com" value="<?= sanitize($_POST['email'] ?? ''); ?>">
            </div>

            <div>
                <label class="block font-label-sm text-label-sm uppercase tracking-widest text-primary mb-2">PASSWORD</label>
                <input type="password" name="password" class="w-full bg-background border border-outline-variant focus:border-secondary focus:ring-0 px-4 py-3 font-body-md text-on-background transition-colors" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn-primary w-full py-4 text-center">
                SIGN IN &rarr;
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-outline-variant/60 text-center">
            <p class="font-body-md text-on-surface-variant">
                Don't have an account? <a href="register.php" class="text-secondary font-semibold hover:underline">Create one here</a>
            </p>
        </div>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
