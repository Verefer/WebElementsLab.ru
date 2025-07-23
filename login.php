    <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/favicon.ico" >
    <meta name="theme-color" content="#000000" >
    <meta
      name="description"
      content="content">
    <link rel="apple-touch-icon" href="assets/img/logo192.png" >
    <title>Вход | WebElementsLab</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="wrapper">
<main>
    <div class="authentication ">
        <div class="auth-text-up">
            <a href="index.php">
                <img src="assets/img/logo.svg" alt="logo" class="auth-logo">
            </a>
            <h1>Войти</h1>
        </div>
        <div class="auth-form">
            <form name="loginForm" onsubmit="return validateLogin()" method="post">
                <div>
                    <label for="email">Почта или имя пользователя:</label>
                    <input type="text" name="login" id="login_field" autocapitalize="off" autocorrect="off" autocomplete="username" class="form-control  js-login-field" autofocus="autofocus" required="required" placeholder="Ваша почта или имя пользователя">
                </div>
                <div class="position-relative">
                    <label for="password">Пароль:</label>
                    <input type="password" name="password" id="password" class="form-control form-control js-password-field" autocomplete="current-password" required="required" placeholder="Введите ваш пароль">
                    <a class="label-link link-form position-absolute top-0 right-0" id="forgot-password" href="password_reset.php">Забыли пароль?</a>
                </div>
                <div>
                    <input type="submit" value="Войти">
                </div>
            </form>
        </div>
        <div class="auth-footer">
            <div class="auth-down">
                <p>Нет аккаунта?</p>
                <a class="link-form" href="register.php">Создать аккаунт</a>
            </div>
        </div>
        
        
    </div>
    
    <script src="assets/js/form_validation.js"></script>
</main>
<?php require_once 'templates/footer.php'; ?>
</div>
</body>
</html>