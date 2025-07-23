<?php
$host = 'localhost';
$dbname = 'u3015620_webelementslab';
$user = 'u3015620_admin';
$password = 'Y2G-kSe-Tfh-3wC'; 

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Ошибки будут исключениями
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // По умолчанию получаем ассоц массивы
    PDO::ATTR_EMULATE_PREPARES => false, // Поддержка настоящих подготовленных запросов
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    exit('Ошибка подключения к базе: ' . $e->getMessage());
}
