<?php

$host = 'localhost';
$dbname = 'hypnosevaluation';
$username = 'root';
$password = '';
$dsn = "mysql:host=$host";

try {
    $pdo = new PDO($dsn, username:'root', password:'');
    $pdo->exec(statement: "CREATE DATABASE hypnosevaluation");
} catch (PDOException $e) {
    echo 'Impossible de se connecter à la base de données';
}
$pdo->exec(statement: "CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    lastname VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL
);");