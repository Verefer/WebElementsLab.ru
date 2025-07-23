<?php
session_start();
require_once __DIR__ . '/includes/db.php';

$login = trim($_POST['login'] ?? '');
$password = $_POST['password'] ?? '';
$errors = [
    'login' => '',
    'password' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($login === '') {
        $errors['login'] = 'Поле обязательно для заполнения';
    }

    if ($password === '') {
        $errors['password'] = 'Введите пароль';
    }

    if (!$errors['login'] && !$errors['password']) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :login OR email = :login LIMIT 1");
        $stmt->execute(['login' => $login]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header('Location: /');
            exit;
        } else {
            $errors['login'] = 'Неверный email/имя пользователя или пароль';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/assets/img/favicon.ico">
    <meta name="theme-color" content="#000000">
    <meta name="description" content="content">
    <link rel="apple-touch-icon" href="/assets/img/logo192.png">
    <title>Вход | WebElementsLab</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<div class="wrapper">
<main>
    <div class="authentication">
        <div class="auth-text-up">
            <a href="index.php">
                <img src="/assets/img/logo.svg" alt="logo" class="auth-logo">
            </a>
            <h1>Войти</h1>
        </div>
        <div class="auth-form">
            <form name="loginForm" method="post" novalidate>
                <div>
                    <label for="login_field">Email или имя пользователя:</label>
                    <input type="text" name="login" id="login_field" value="<?= htmlspecialchars($login) ?>" autocapitalize="off" autocorrect="off" autocomplete="username" class="form-control js-login-field" required placeholder="Email или имя">
                    <span class="error-message" id="login-error"><?= $errors['login'] ?: '&nbsp;' ?></span>
                </div>
                <div class="position-relative">
                    <label for="password">Пароль:</label>
                    <input type="password" name="password" id="password" class="form-control js-password-field" autocomplete="current-password" required placeholder="Введите ваш пароль">
                    <a class="label-link link-form position-absolute top-0 right-0" id="forgot-password" href="/password_reset.php">Забыли пароль?</a>
                    <span class="error-message" id="password-error"><?= $errors['password'] ?: '&nbsp;' ?></span>
                </div>
                <div>
                    <input type="submit" value="Войти">
                </div>
            </form>
        </div>
        <div class="auth-footer">
            <div class="auth-down">
                <p>Нет аккаунта?</p>
                <a class="link-form" href="/register.php">Создать аккаунт</a>
            </div>
        </div>
    </div>
</main>
<?php require_once __DIR__ . '/templates/footer.php'; ?>
</div>
</body>
</html>
