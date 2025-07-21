<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/favicon.ico" >
    <meta name="theme-color" content="#000000" >
    <meta
      name="description"
      content="Web site Web Elements Lab">
    <link rel="apple-touch-icon" href="assets/img/logo192.png" >
    <title>WebElementsLab</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <div class="nav-left">
            <img src=assets/img/logo.svg class="logo-header" alt="logo">
            <a href='#'>Меню 1</a>
            <a href='#'>Меню 2</a>
            <a href='#'>Меню 3</a>
            <a href='#'>Меню 4</a>
            <a href='#'>Меню 5</a>
        </div>
        <div class="nav-right">
            <!-- <input type='search' placeholder='Поиск...'> -->
            <a href='#'>Вход</a>
            <a class="reg-btn" href='#'>Регистрация</a>
        </div>
    </header>
    <div class="slogan">
        <h1>Большой первый слоган - <br> на две строки хотябы</h1>
        <h3>Подпишитесь на наши обновления, чтобы всегда первыми узнавать о новинках</h3>
    </div>
    <div class="sub-block">
        <input type="email" name="subcribeemail" id="subcribeemail" placeholder="Ваша почта...">
        <button class="sub-btn" id="sub-btn">Подписаться</button>
    </div>

    <div>
<!-- Внешний вид карточек -->
    </div>

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
    <div>
<!-- форма авторизации -->
        <form name="loginForm" onsubmit="return validateLogin()" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" placeholder="Введите почту...">
                <div class="error-msg" id="email-error"></div>
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" placeholder="Введите пароль...">
                <div class="error-msg" id="password-error"></div>
            </div>
            <input type="submit" value="Войти">
        </form>
        
    </div>
    <script src="assets/js/form_validation.js"></script>
</body>
</html>