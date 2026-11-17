<?php
session_start();
require_once __DIR__ . '/database.php';
if (isset($_SESSION['user_id'])) { header('Location: dashboard.php'); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
        $error = 'Enter a valid email address and password.';
    } else {
        $stmt = $pdo->prepare('SELECT id, name, password_hash FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = (int)$user['id'];
            $_SESSION['user_name'] = $user['name'];
            header('Location: dashboard.php');
            exit;
        }
        $error = 'Incorrect email or password.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sign in | Library Desk</title><link rel="stylesheet" href="assets/style.css">
</head>
<body class="auth-page">
<main class="auth-card">
    <div class="brand-mark">LD</div>
    <p class="eyebrow">LIBRARY MANAGEMENT</p>
    <h1>Welcome back</h1>
    <p class="muted">Sign in to manage your library collection.</p>
    <?php if ($error): ?><div class="alert"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="post">
        <label>Email address<input name="email" type="email" required placeholder="admin@example.com"></label>
        <label>Password<input name="password" type="password" required placeholder="Enter password"></label>
        <button class="button full-width">Sign in</button>
    </form>
    <p class="demo-hint">Demo: admin@example.com / password</p>
</main>
</body></html>
