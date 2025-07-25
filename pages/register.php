<?php
session_start();
// Проверка авторизации
if (!empty($_SESSION['username'])) {
    header('Location: /pages/profile.php'); 
    exit;
}
require_once __DIR__ . '/../includes/db.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Для отображения ошибок
$emailError = '';
$usernameError = '';
$generalError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $agree_privacy = $_POST['agree-privacy'] ?? '';
    $agree_mailing = $_POST['agree-mailing'] ?? '';

    if (!$username || !$email || !$password || !$agree_privacy) {
        $generalError = 'Пожалуйста, заполните все обязательные поля и примите политику';
    } else {
        // Проверка на существующего пользователя
        $stmt = $pdo->prepare("SELECT username, email FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        $existing = $stmt->fetch();

        if ($existing) {
            if ($existing['username'] === $username) {
                $usernameError = 'Имя пользователя уже занято';
            }
            if ($existing['email'] === $email) {
                $emailError = 'Почта уже зарегистрирована';
            }
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $role = 'user';

            $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->execute([$username, $email, $hash, $role]);

            $_SESSION['user_logged_in'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            header('Location: /');
            exit;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/assets/img/favicon.ico" >
    <meta name="theme-color" content="#000000" >
    <meta
      name="description"
      content="Регистрация">
    <link rel="apple-touch-icon" href="/assets/img/logo192.png" >
    <title>Регистрация | WebElementsLab</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<div class="wrapper">
<main>
    <div class="authentication ">
        <div class="auth-text-up">
            <h1>Регистрация</h1>
        </div>
        <div class="auth-form">
            <?php if (!empty($error)): ?>
                <div class="form-error" style="color:red"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form name="loginForm" onsubmit="return validateLogin()" method="post">
                <div class="position-relative">
                    <label for="username">Имя пользователя:</label>
                    <input type="text" name="username" id="username" placeholder="Придумайте уникальное имя" autocomplete="off" required>
                    <span class="error-message" id="username-error">&nbsp;</span>
                </div>    
                <div>
                    <label for="email">Почта:</label>
                    <input type="email" name="email" id="email" value="<?= htmlspecialchars($_GET['email'] ?? '') ?>" placeholder="Укажите вашу почту" autocomplete="username" required>
                    <span class="error-message" id="email-error">&nbsp;</span>
                </div>
                <div class="position-relative">
                    <label for="password">Пароль:</label>
                    <input type="password" name="password" id="password" placeholder="Придумайте пароль" autocomplete="new-password" required>
                    <span id="password-error" class="form-error"></span>
                </div>
                <label class="f-s-09rem d-flex a-i-center gap1">
                    <input type="checkbox" id="agree-privacy" name="agree-privacy" required="required">
                    <p>Я согласен с <a class="link-form" href="/privacy.php" target="_blank">политикой конфиденциальности</a></p>
                </label>
                <label class="f-s-09rem d-flex a-i-center gap1">
                    <input type="checkbox" id="agree-mailing" name="agree-mailing" checked>
                    <p>Получать уведомления об обновлениях</p>
                </label>
                <span id="general-error" class="form-error"></span>
                <div>
                    <input type="submit" value="Зарегистрироваться">
                </div>
            </form>
        </div>
        <div class="auth-footer">
            <div class="auth-down">
                <p>Есть аккаунт?</p>
                <a class="link-form" href="/login.php">Войти</a>
            </div>
        </div>
    </div>
    <script src="/assets/js/form_validation.js"></script>
</main>
<?php require_once __DIR__ . '/../templates/footer.php'; ?>
</div>
</body>
</html>