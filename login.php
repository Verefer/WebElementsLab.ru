<?php
session_start();
require_once __DIR__ . '/includes/db.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $errors[] = 'Пожалуйста, заполните все поля';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if (!$user) {
            $errors[] = 'Пользователя с такой почтой нет';
        } elseif (!password_verify($password, $user['password'])) {
            $errors[] = 'Пароль неверный';
        } else {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header('Location: /');
            exit;
        }
    }

    header('Content-Type: application/json');
    echo json_encode(['errors' => $errors]);
    exit;
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
      content="Авторизация | WebElementsLab">
    <link rel="apple-touch-icon" href="/assets/img/logo192.png" >
    <title>Авторизация | WebElementsLab</title>
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
            <form id="login-form" method="post" novalidate>
                <div>
                    <label for="login_field">Почта:</label>
                    <input type="text" name="login" id="login_field" autocomplete="email"
                           class="form-control" placeholder="Ваша почта">
                           <span class="error-message" id="login-error">&nbsp;</span>
                </div>
                <div class="position-relative">
                    <label for="password">Пароль:</label>
                    <input type="password" name="password" id="password" autocomplete="current-password"
                           class="form-control" placeholder="Введите ваш пароль">
                    <a class="label-link link-form position-absolute top-0 right-0"
                       href="/password_reset.php">Забыли пароль?</a>
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
document.getElementById('login-form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const login = document.getElementById('login_field');
    const password = document.getElementById('password');
    const loginError = document.getElementById('login-error');
    const passwordError = document.getElementById('password-error');

    // Очистка старых ошибок
    loginError.textContent = '\u00A0';
    passwordError.textContent = '\u00A0';
    login.classList.remove('valid', 'invalid');
    password.classList.remove('valid', 'invalid');

    let hasError = false;

    if (login.value.trim() === '') {
        login.classList.add('invalid');
        loginError.textContent = 'Укажите вашу почту';
        hasError = true;
    }

    if (password.value.trim() === '') {
        password.classList.add('invalid');
        passwordError.textContent = 'Введите пароль';
        hasError = true;
    }

    if (hasError) return;

    const formData = new FormData(this);

    try {
        const response = await fetch('', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.errors && result.errors.length > 0) {
            const errorText = result.errors[0].toLowerCase();

            if (errorText.includes('почт')) {
                login.classList.add('invalid');
                loginError.textContent = result.errors[0];
            } else if (errorText.includes('парол')) {
                password.classList.add('invalid');
                passwordError.textContent = result.errors[0];
            } else {
                // Общая ошибка
                login.classList.add('invalid');
                password.classList.add('invalid');
                loginError.textContent = result.errors[0];
                passwordError.textContent = result.errors[0];
            }
        } else {
            // Успешный вход
            window.location.href = '/';
        }
    } catch (error) {
        console.error('Ошибка запроса:', error);
        loginError.textContent = 'Произошла ошибка соединения';
    }
});
</script>
</main>
<?php require_once __DIR__ . '/templates/footer.php'; ?>
</div>
</body>
</html>
