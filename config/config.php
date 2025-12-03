<?php

$host = "localhost";
$dbname = "fitmanager";
$username = "root";
$password = "";


try {

    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // echo "safi connected!!!";
} catch (PDOException $e) {
    echo "matconnectach" . $e->getMessage();
    exit();
}