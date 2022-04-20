<?php

$host = 'bv2rebwf6zzsv341.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
$dbname = 'yi5e8ckpkufti8g2';
$username = 'g35nf51zxizrbii0';
$password = 'jmghd4gna01jef6v';
$dsn = "mysql:host=$host;dbname=$dbname";

try {
    $pdo = new PDO($dsn,$username,$password);
} catch (PDOException $e) {
    echo 'Impossible de se connecter à la base de données';
}
