<?php
require_once __DIR__ . '/../includes/db.php';

$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$limit = 10;

$stmt = $pdo->prepare("SELECT id, name FROM snippets ORDER BY created_at DESC LIMIT ? OFFSET ?");
$stmt->bindValue(1, $limit, PDO::PARAM_INT);
$stmt->bindValue(2, $offset, PDO::PARAM_INT);
$stmt->execute();
$snippets = $stmt->fetchAll();

header('Content-Type: application/json');
echo json_encode($snippets);