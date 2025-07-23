<?php
session_start();
require_once __DIR__ . '/includes/db.php';

$email = trim($_POST['login'] ?? '');
$password = $_POST['password'] ?? '';

// Подготовка ответа
$errors = [];

if ($email === '' || $password === '') {
    $errors[] = 'Заполните все поля';
} else {
    // Поиск только по email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Успешный вход
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        header('Location: /dashboard.php');
        exit;
    } else {
        $errors[] = 'Неверный email или пароль';
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
      content="content">
    <link rel="apple-touch-icon" href="/assets/img/logo192.png" >
    <title>Вход | WebElementsLab</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<div class="wrapper">
<main>
    <div class="authentication ">
        <div class="auth-text-up">
            <a href="index.php">
                <img src="/assets/img/logo.svg" alt="logo" class="auth-logo">
            </a>
            <h1>Войти</h1>
        </div>
        <div class="auth-form">
            <form name="loginForm" onsubmit="return validateLogin()" method="post">
                <div>
                    <label for="email">Email:</label>
                    <input type="text" name="login" id="login_field" autocapitalize="off" autocorrect="off" autocomplete="email"
                        class="form-control js-login-field" autofocus="autofocus" required="required"
                        placeholder="Ваш email">
                    <span class="error-message" id="login-error">&nbsp;</span>

                </div>
                <div class="position-relative">
                    <label for="password">Пароль:</label>
                    <input type="password" name="password" id="password" class="form-control form-control js-password-field" autocomplete="current-password" required="required" placeholder="Введите ваш пароль">
                    <a class="label-link link-form position-absolute top-0 right-0" id="forgot-password" href="/password_reset.php">Забыли пароль?</a>
                    <span class="error-message" id="password-error">&nbsp;</span>
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
    
    <script>
document.querySelector('form').addEventListener('submit', function (e) {
    let loginField = document.getElementById('login_field');
    let passwordField = document.getElementById('password');
    let hasError = false;

    // Очистка сообщений
    document.getElementById('login-error').textContent = '\u00A0';
    document.getElementById('password-error').textContent = '\u00A0';

    // Проверка login/email
    if (loginField.value.trim() === '') {
        document.getElementById('login-error').textContent = 'Поле обязательно для заполнения';
        hasError = true;
    }

    // Проверка пароля
    if (passwordField.value.trim() === '') {
        document.getElementById('password-error').textContent = 'Введите пароль';
        hasError = true;
    }

    if (hasError) {
        e.preventDefault(); // Останавливаем отправку формы
    }
});
</script>

</main>
<?php require_once __DIR__ . '/templates/footer.php'; ?>
</div>
</body>
</html>