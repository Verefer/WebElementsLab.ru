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
    <title>Регистрация | WebElementsLab</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="wrapper">
<main>
    <div class="authentication ">
        <div class="auth-text-up">
            <h1>Регистрация</h1>
        </div>
        <div class="auth-form">
            <form name="loginForm" onsubmit="return validateLogin()" method="post">
                <div>
                    <label for="email">Почта:</label>
                    <input type="text" name="login" id="login_field" autocapitalize="off" placeholder="Укажите вашу почту" autocorrect="off" autocomplete="username" class="form-control  js-login-field" autofocus="autofocus" required="required">
                </div>
                <div class="position-relative">
                    <label for="password">Пароль:</label>
                    <input type="password" name="password" id="password" autocomplete="current-password" required="required" placeholder="Сохраните ваш пароль">
                </div>
                <div class="position-relative">
                    <label for="username">Имя пользователя:</label>
                    <input type="text" name="username" id="username" required="required" placeholder="Придумайте уникальное имя пользователя">
                </div>
                <label class="f-s-09rem d-flex a-i-center gap1">
                    <input type="checkbox" id="agree-privacy" name="agree-privacy" required="required">
                    <p>Я согласен с <a class="link-form" href="privacy.php" target="_blank">политикой конфиденциальности</a></p>
                </label>
                <label class="f-s-09rem d-flex a-i-center gap1">
                    <input type="checkbox" id="agree-mailing" name="agree-mailing" required="required" checked>
                    <p>Получать уведомления об обновлениях</p>
                </label>
                <div>
                    <input type="submit" value="Зарегистрироваться">
                </div>
            </form>
        </div>
        <div class="auth-footer">
            <div class="auth-down">
                <p>Есть аккаунт?</p>
                <a class="link-form" href="login.php">Войти</a>
            </div>
        </div>
        
        
    </div>
    
    <script src="assets/js/form_validation.js"></script>
</main>
<?php require_once 'includes/footer.php'; ?>
</div>
</body>
</html>