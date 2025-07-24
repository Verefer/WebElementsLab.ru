<?php
session_start();
require_once __DIR__ . '/includes/db.php';

header('Content-Type: application/json');

$errors = [];
$MAX_ATTEMPTS = 5;
$BLOCK_TIME = 30; // в секундах

// 1. Защита от перебора (через $_SESSION)
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['last_attempt_time'] = time();
}

if ($_SESSION['login_attempts'] >= $MAX_ATTEMPTS) {
    $wait = $BLOCK_TIME - (time() - $_SESSION['last_attempt_time']);
    if ($wait > 0) {
        echo json_encode([
            'success' => false,
            'errors' => ["Слишком много попыток входа. Попробуйте через $wait секунд."]
        ]);
        exit;
    } else {
        // Сбросим, если время прошло
        $_SESSION['login_attempts'] = 0;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    // 2. Проверка пустых полей
    if ($email === '' || $password === '') {
        $errors[] = 'Пожалуйста, заполните все поля';
    }

    // 3. Валидация почты
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Неверный формат почты';
    }

    if (empty($errors)) {
        // 4. Поиск пользователя
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        // 5. Проверка пароля
        if (!$user) {
            $errors[] = 'Пользователь не найден';
        } elseif (!password_verify($password, $user['password'])) {
            $errors[] = 'Неверный пароль';
        } else {
            // Успешный вход — сбрасываем попытки
            $_SESSION['login_attempts'] = 0;
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // 6. Очистка пароля из памяти
            unset($password);

            echo json_encode([
                'success' => true,
                'username' => $user['username']
            ]);
            exit;
        }
    }

    // 7. Увеличиваем счётчик попыток
    $_SESSION['login_attempts'] += 1;
    $_SESSION['last_attempt_time'] = time();

    // 8. Очистка пароля в любом случае
    unset($password);

    echo json_encode([
        'success' => false,
        'errors' => $errors
    ]);
    exit;
}
