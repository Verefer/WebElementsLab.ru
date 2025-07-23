<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/favicon.ico">
    <meta name="theme-color" content="#000000">
    <meta name="description" content="../Восстановление пароля">
    <link rel="apple-touch-icon" href="../assets/img/logo192.png">
    <title>Восстановление пароля | WebElementsLab</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="wrapper">
<main>
    <div class="authentication">
        <div class="auth-text-up">
            <a href="index.php">
                <img src="../assets/img/logo.svg" alt="logo" class="auth-logo">
            </a>
            <h1>Восстановление пароля</h1>
            <p class="subtext">Укажите почту, к которой привязан аккаунт. Мы отправим вам инструкцию.</p>
        </div>

        <div class="auth-form">
            <form name="passwordResetForm" method="post">
                <div>
                    <label for="email">Электронная почта:</label>
                    <input type="text" name="email" id="email" required="required" class="form-control" placeholder="Введите вашу почту">
                </div>
                <div>
                    <input type="submit" value="Отправить ссылку для восстановления">
                </div>
            </form>
        </div>

        <div class="auth-footer">
            <div class="auth-down">
                <a class="link-form" href="../login.php">← Вернуться ко входу</a>
            </div>
        </div>
    </div>
</main>
<?php require_once '../templates/footer.php'; ?>
</div>
</body>
</html>
