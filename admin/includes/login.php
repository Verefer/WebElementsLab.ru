<?php
session_start();
require_once 'db.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Введите логин и пароль';
    } else {
        // Ищем пользователя по логину
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            // Успешная авторизация
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin['username'];
            header('Location: ../index.php?page=dashboard');
            exit;
        } else {
            $error = 'Неверный логин или пароль';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head><meta charset="UTF-8"><title>Вход в админку</title></head>
<link rel="stylesheet" href="../assets/admin_style.css" />
<body>
    <div class="form">
        <h1 class="ldp-admin-title">Вход</h1>
        <?php if (!empty($error)): ?>
        <p style="color:red;"><?=htmlspecialchars($error)?></p>
        <?php endif; ?>
        <form method="post" action="">
            <label>Логин: <input type="text" name="username" required></label><br>
            <label>Пароль: <input type="password" name="password" required></label><br>
            <button type="submit">Войти</button>
        </form>
</div>
</body>
</html>
