<?php
// start_node_server.php

// Caminho para o script do servidor Node.js
$nodeScriptPath = 'C:\\xampp\\htdocs\\Arduino\\Arduino\\main\\NODEJS_Files\\main.js';

// Comando para iniciar o servidor Node.js
$command = "start /B node \"$nodeScriptPath\"";

// Executa o comando para iniciar o servidor Node.js
shell_exec($command);

// Espera um momento para garantir que o processo foi iniciado
sleep(2);

// Comando para encontrar o PID do processo Node.js em execução
$findPidCommand = 'tasklist /FI "IMAGENAME eq node.exe" /FO CSV /NH';

// Executa o comando para encontrar o PID
$tasklistOutput = shell_exec($findPidCommand);

// Extrai o PID do processo Node.js a partir da saída do tasklist
$pid = null;
$lines = explode(PHP_EOL, $tasklistOutput);
foreach ($lines as $line) {
    $data = str_getcsv($line);
    if (count($data) > 1 && strpos($data[0], "node.exe") !== false) {
        $pid = $data[1];
        break;
    }
}

// Verifica se o PID foi encontrado e o salva em um arquivo
if (is_numeric($pid)) {
    file_put_contents('nodejs_pid.txt', $pid);
    echo "Node.js esta rodando com Sucesso na porta $pid.";
} else {
    echo "Erro ao iniciar o  Node.js.";
}
?>
