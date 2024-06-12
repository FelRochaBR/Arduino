<?php
session_start();
include 'config.php';

$userId = $_SESSION['user_id'];

$sql = "SELECT id, nome, email, cargo, cpf, numero_cel FROM usuarios WHERE id=$userId";
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode([]);
}

$conexao->close();
?>
