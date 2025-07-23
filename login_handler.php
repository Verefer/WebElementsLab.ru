<?php
session_start();
require_once __DIR__ . '/includes/db.php';

header('Content-Type: application/json');

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

            echo json_encode([
                'success' => true,
                'username' => $user['username']
            ]);
            exit;
        }
    }

    echo json_encode([
        'success' => false,
        'errors' => $errors
    ]);
    exit;
}
