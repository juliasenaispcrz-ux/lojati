<?php

header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");

require "config.php";

function listarClientes($con) {
    $stmt = $con->query("SELECT * FROM Clientes");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 

function cadastrarCliente($con) { 
    $input = json_decode(file_get_contents('php://input'), true);

    $stmt = $con->prepare("INSERT INTO Clientes (nome, email, numero, endereco) VALUES (:nome, :email, :numero, :endereco)");
    
    $stmt->execute([
        ':nome'     => $input['nome'] ?? '',
        ':email'    => $input['email'] ?? '',
        ':numero'   => $input['numero'] ?? '',
        ':endereco' => $input['endereco'] ?? ''
    ]);
}

$rota = $_GET['rota'] ?? '';
$acao = $_GET['acao'] ?? '';

switch ($rota) {
    case "clientes":
        if ($acao === 'read') {
            listarClientes($con);
        } elseif ($acao === 'create') {
            cadastrarCliente($con);
        }
        break;
}