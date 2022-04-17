<?php

$host = 'localhost';
$dbname = 'hypnosevaluation';
$username = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=hypnosevaluation";

try {
    $pdo = new PDO($dsn, username:'root', password:'');
} catch (PDOException $e) {
    echo 'Impossible de se connecter à la base de données';
}
