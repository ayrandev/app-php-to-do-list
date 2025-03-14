<?php
$host = "localhost";
$dbname = "to-do-list";
$dbuser = "root";
$passw = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $passw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) { 
    die("Erro na conexão: " . $e->getMessage());
}

?>