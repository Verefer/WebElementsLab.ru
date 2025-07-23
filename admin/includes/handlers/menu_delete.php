<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../auth_check.php';

if (!isset($_GET['id'])) {
    die('ID блюда не указан');
}

$dish_id = (int)$_GET['id'];

// Удаляем файл изображения, если есть
$stmt = $pdo->prepare("SELECT image FROM dishes WHERE dish_id = ?");
$stmt->execute([$dish_id]);
$dish = $stmt->fetch(PDO::FETCH_ASSOC);

if ($dish && $dish['image']) {
    $filePath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $dish['image'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

// Удаляем из БД
$stmt = $pdo->prepare("DELETE FROM dishes WHERE dish_id = ?");
$stmt->execute([$dish_id]);

header('Location: ../../index.php?page=menu_edit');
exit;
