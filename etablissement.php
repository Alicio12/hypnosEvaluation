<?php

$host = 'localhost';
$dbname = 'hypnosevaluation';
$username = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname";

try {
    $pdo = new PDO($dsn, username:'root', password:'');
} catch (PDOException $e) {
    echo 'Impossible de se connecter à la base de données';
}
$pdo->exec(statement: "CREATE TABLE hostels (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    adress VARCHAR(50) NOT NULL,
);");