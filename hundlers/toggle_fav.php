<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

header('Content-Type: application/json');

// Проверка авторизации
if (empty($_SESSION['id'])) {
    echo json_encode(['error' => 'unauthorized']);
    exit;
}

// Получаем данные
$data = json_decode(file_get_contents('php://input'), true);
$snippet_id = (int)($data['id'] ?? 0);
$user_id = $_SESSION['id']; // <-- вот тут было неправильно

// Проверяем наличие в избранном
$stmt = $pdo->prepare("SELECT * FROM favorites WHERE user_id = ? AND snippet_id = ?");
$stmt->execute([$user_id, $snippet_id]);
$exists = $stmt->fetch();

if ($exists) {
    $del = $pdo->prepare("DELETE FROM favorites WHERE user_id = ? AND snippet_id = ?");
    $del->execute([$user_id, $snippet_id]);
    echo json_encode(['status' => 'removed']);
} else {
    $add = $pdo->prepare("INSERT INTO favorites (user_id, snippet_id) VALUES (?, ?)");
    $add->execute([$user_id, $snippet_id]);
    echo json_encode(['status' => 'added']);
}
<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

header('Content-Type: application/json');

// Проверка авторизации
if (empty($_SESSION['id'])) {
    echo json_encode(['error' => 'unauthorized']);
    exit;
}

// Получаем данные
$data = json_decode(file_get_contents('php://input'), true);
$snippet_id = (int)($data['id'] ?? 0);
$user_id = $_SESSION['id']; // <-- вот тут было неправильно

// Проверяем наличие в избранном
$stmt = $pdo->prepare("SELECT * FROM favorites WHERE user_id = ? AND snippet_id = ?");
$stmt->execute([$user_id, $snippet_id]);
$exists = $stmt->fetch();

if ($exists) {
    $del = $pdo->prepare("DELETE FROM favorites WHERE user_id = ? AND snippet_id = ?");
    $del->execute([$user_id, $snippet_id]);
    echo json_encode(['status' => 'removed']);
} else {
    $add = $pdo->prepare("INSERT INTO favorites (user_id, snippet_id) VALUES (?, ?)");
    $add->execute([$user_id, $snippet_id]);
    echo json_encode(['status' => 'added']);
}
