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
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="wrapper">
<main>
    <div class="authentication ">
        <div class="auth-text-up">
            <img src="assets/img/logo.svg" alt="logo" class="auth-logo">
            <h1>Войти</h1>
        </div>
        <div class="auth-form">
            <form name="loginForm" onsubmit="return validateLogin()" method="post">
                <div>
                    <label for="email">Email:</label>
                    <input type="text" name="login" id="login_field" autocapitalize="off" autocorrect="off" autocomplete="username" class="form-control  js-login-field" autofocus="autofocus" required="required">
                </div>
                <div class="position-relative">
                    <label for="password">Пароль:</label>
                    <input type="password" name="password" id="password" class="form-control form-control js-password-field" autocomplete="current-password" required="required">
                    <a class="label-link position-absolute top-0 right-0" id="forgot-password" href="/password_reset">Забыли пароль?</a>
                </div>
                <div>
                    <input type="submit" value="Войти">
                </div>
            </form>
        </div>
        <div class="auth-footer">
            <div class="auth-down">
                <p>Нет аккаунта?</p>
                <a href="register.php">Создать аккаунт</a>
            </div>
        </div>
        
        
    </div>
    
    <script src="assets/js/form_validation.js"></script>
</main>
<?php require_once 'includes/footer.php'; ?>
</div>
</body>
</html>