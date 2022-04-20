<?php

$host = 'bv2rebwf6zzsv341.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
$dbname = 'hypnosevaluation';
$username = 'g35nf51zxizrbii0';
$password = 'jmghd4gna01jef6v';
$dsn = "mysql://g35nf51zxizrbii0:jmghd4gna01jef6v@bv2rebwf6zzsv341.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/yi5e8ckpkufti8g2";

try {
    $pdo = new PDO($dsn, username:'g35nf51zxizrbii0', password:'jmghd4gna01jef6v');
} catch (PDOException $e) {
    echo 'Impossible de se connecter à la base de données';
}
