<?php
session_start();
require_once 'db.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';
    $agree_privacy = $_POST['agree-privacy'] ?? '';
    $agree_mailing = $_POST['agree-mailing'] ?? '';

    if (!$username || !$email || !$password || !$agree_privacy) {
        $error = 'Пожалуйста, заполните все обязательные поля и примите политику';
    } else {
        // Проверка на существующего пользователя
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            $error = 'Такой пользователь или почта уже зарегистрированы';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $role = 'user'; // по умолчанию
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->execute([$username, $email, $hash, $role]);

            // Авторизуем пользователя сразу
            $_SESSION['user_logged_in'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            header('Location: index.php'); // или redirect куда нужно
            exit;
        }
    }
}
?>
