<?php
$host = "localhost";
$dbname = "lojati";
$user = "root";
$pass = "";

try {
    $con = new PDO("mysql:host=localhost;dbname=lojati;charset=utf8", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["erro" => "Erro conexao: " . $e->getMessage()]);
    exit;
}

