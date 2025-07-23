<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../auth_check.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Неверный метод запроса');
}

$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$category = trim($_POST['category'] ?? '');
$price = $_POST['price'] ?? '';
$weight = $_POST['weight'] ?? '';
$dish_id = $_POST['dish_id'] ?? null;

if ($title === '' || $description === '' || $category === '' || $price === '' || $weight === '') {
    die('Пожалуйста, заполните все обязательные поля');
}

if (!is_numeric($price) || !is_numeric($weight)) {
    die('Цена и вес должны быть числовыми');
}

$imageName = null;
$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';

if (!empty($_FILES['image']['name'])) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];
    $fileType = $_FILES['image']['type'];

    if (!in_array($fileType, $allowedTypes)) {
        die('Недопустимый тип изображения');
    }

    $imageName = time() . '_' . basename($_FILES['image']['name']);
    $uploadFile = $uploadDir . $imageName;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        die('Ошибка загрузки файла');
    }
}

if ($dish_id) {
    // Обновление
    if ($imageName) {
        $sql = "UPDATE dishes SET title = ?, description = ?, category = ?, price = ?, weight = ?, image = ? WHERE dish_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $description, $category, $price, $weight, $imageName, $dish_id]);
    } else {
        $sql = "UPDATE dishes SET title = ?, description = ?, category = ?, price = ?, weight = ? WHERE dish_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $description, $category, $price, $weight, $dish_id]);
    }
} else {
    // Добавление
    $sql = "INSERT INTO dishes (title, description, category, price, weight, image, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $description, $category, $price, $weight, $imageName]);
}

header('Location: ../../index.php?page=menu_edit');
exit;
