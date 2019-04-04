<?php 
$host = 'localhost';
$db_user = 'root';
$db_pass = '';
$dbname = 'accounts';
$dsn = "mysql:host=$host;dbname=$dbname";
try {
    $PDO = new PDO($dsn,$db_user,$db_pass);
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    echo "Connection failed" . $err->getMessage();
}