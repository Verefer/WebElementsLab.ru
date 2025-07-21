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
    <title>Регистрация</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
        <div> 
<!-- форма регистрации -->
        <form name="registrationForm" onsubmit="return validateForm()" method="post">
        <div class="form-group">
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name">
            <div class="error-msg" id="name-error"></div>
        </div>

        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password">
            <div class="error-msg" id="password-error"></div>
        </div>

        <div class="form-group">
            <label for="confirmPassword">Подтвердите пароль:</label>
            <input type="password" id="confirmPassword" name="confirmPassword">
            <div class="error-msg" id="confirmPassword-error"></div>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email">
            <div class="error-msg" id="email-error"></div>
        </div>
        <div class="form-group checkbox-group">
            <label>
                <input type="checkbox" id="agree" name="agree">
                Я согласен с <a href="/privacy" target="_blank">политикой конфиденциальности</a>
            </label>
            <div class="error-msg" id="agree-error"></div>
        </div>

        <input type="submit" value="Зарегистрироваться">
        </form>
    </div>

    <script src="assets/js/form_validation.js"></script>
</body>
</html>