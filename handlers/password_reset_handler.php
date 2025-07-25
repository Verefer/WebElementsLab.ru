<?php
require_once __DIR__ . '/../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Некорректный email']);
        exit;
    }
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'Пользователь с такой почтой не найден']);
        exit;
    }
    $token = bin2hex(random_bytes(32));
    $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
    $stmt = $pdo->prepare('INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)');
    $stmt->execute([$user['id'], $token, $expires]);
    $reset_link = 'https://webelementslab.ru/pages/password_reset.php?token=' . $token;
    // Здесь должен быть реальный отправщик почты
    // mail($email, 'Восстановление пароля', "Ссылка для сброса пароля: $reset_link");
    echo json_encode(['success' => true, 'message' => 'Ссылка для восстановления отправлена на почту']);
    exit;
}
