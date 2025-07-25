<?php
require_once __DIR__ . '/includes/db.php';

$field = $_GET['field'] ?? '';
$value = trim($_GET['value'] ?? '');

$allowedFields = ['username', 'email'];
$response = ['exists' => false];

if (in_array($field, $allowedFields) && $value !== '') {
    $stmt = $pdo->prepare("SELECT id FROM users WHERE $field = ?");
    $stmt->execute([$value]);
    $response['exists'] = (bool)$stmt->fetch();
}

header('Content-Type: application/json');
echo json_encode($response);
