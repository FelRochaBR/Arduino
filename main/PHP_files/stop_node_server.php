<?php
// stop_node_server.php

// Porta do servidor Node.js
$port = 3000; // Substitua pela porta correta do seu servidor Node.js

// Endereço do servidor Node.js
$nodeServerAddress = 'http://localhost:' . $port . '/parar';

// Inicia uma solicitação HTTP para o servidor Node.js para desligá-lo
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $nodeServerAddress);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

// Verifica se a solicitação foi bem-sucedida
if ($response === false) {
    echo "Failed to stop Node.js server.";
} else {
    echo "Node.js server stopped successfully.";
}

// Fecha a sessão cURL
curl_close($ch);
?>
