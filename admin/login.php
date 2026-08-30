<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/session.php';

if (is_admin()) {
    header('Location: dashboard.php');
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
        $stmt = $conn->prepare("SELECT id, name, email, password, role FROM users WHERE email = ? AND role = 'admin' LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            login_user($user);
            header('Location: dashboard.php');
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
    <title>Admin Login | Kalactive</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="admin-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ivory: #f5f1e8;
            --paper: #f8f5f0;
            --terracotta: #b86a45;
            --charcoal: #1b1a19;
            --ink: #2a2725;
            --muted: #6d655d;
            --brass: #b28b4d;
            --border: rgba(27, 26, 25, 0.12);
            --shadow: 0 24px 60px rgba(27, 26, 25, 0.12);
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
            background:
                radial-gradient(circle at top, rgba(178, 139, 77, 0.12), transparent 40%),
                linear-gradient(135deg, #f4efe7, #efe8df);
            color: var(--ink);
            font-family: 'Inter', sans-serif;
        }
        .login-shell {
            width: min(100%, 460px);
            background: rgba(255,255,255,0.66);
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            backdrop-filter: blur(6px);
            border-radius: 22px;
            padding: 32px 28px 26px;
        }
        .brand {
            margin: 0 0 8px;
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.2rem, 4vw, 3rem);
            letter-spacing: -0.04em;
            color: var(--charcoal);
        }
        .eyebrow {
            text-transform: uppercase;
            letter-spacing: 0.18em;
            font-size: 0.7rem;
            color: var(--terracotta);
            font-weight: 700;
            margin: 0 0 12px;
        }
        .subtitle {
            margin: 0 0 24px;
            color: var(--muted);
            line-height: 1.6;
        }
        .alert {
            background: rgba(184, 106, 69, 0.08);
            border: 1px solid rgba(184, 106, 69, 0.18);
            color: #7a3822;
            border-radius: 12px;
            padding: 12px 14px;
            margin-bottom: 18px;
            font-size: 0.95rem;
        }
        form { display: grid; gap: 18px; }
        .form-group { display: grid; gap: 8px; }
        label {
            font-size: 0.76rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--muted);
            font-weight: 700;
        }
        input {
            width: 100%;
            border: 1px solid rgba(27,26,25,0.14);
            background: rgba(255,255,255,0.7);
            border-radius: 12px;
            padding: 14px 14px;
            font-size: 1rem;
            color: var(--charcoal);
            font-family: inherit;
        }
        input:focus {
            outline: none;
            border-color: rgba(178, 139, 77, 0.8);
            box-shadow: 0 0 0 4px rgba(178, 139, 77, 0.12);
        }
        .btn {
            border: none;
            border-radius: 12px;
            padding: 14px 18px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            cursor: pointer;
            transition: transform 0.2s ease, opacity 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            justify-content: center;
            align-items: center;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn-primary {
            background: linear-gradient(135deg, var(--terracotta), #8c4f36);
            color: #fff;
            box-shadow: 0 14px 28px rgba(184, 106, 69, 0.22);
        }
        .back-link {
            display: inline-block;
            margin-top: 18px;
            text-align: center;
            width: 100%;
            color: var(--muted);
            text-decoration: none;
            font-size: 0.8rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <main class="login-shell">
        <p class="eyebrow">Kalactive Admin</p>
        <h1 class="brand">A Curation by Rangrez</h1>
        <p class="subtitle">Commerce operations, luxury inventory and order oversight for the atelier.</p>

        <?php if ($error): ?>
            <div class="alert"><?= e($error) ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required value="<?= e($email) ?>" placeholder="admin1@kalactive.test">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Password">
            </div>

            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
        <a href="../index.php" class="back-link">Back to store</a>
    </main>
</body>
</html>
