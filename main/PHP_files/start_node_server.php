<?php
// start_node_server.php

// Path to your Node.js server script
$nodeScriptPath = 'C:\xampp\htdocs\Arduino\Arduino\main\NODEJS_Files\main.js';

// Command to start the Node.js server
$command = "node $nodeScriptPath";

// Execute the command
exec($command . " > /dev/null &", $output, $return_var);

if ($return_var === 0) {
    
} else {
    echo "Failed to start Node.js server.";
}
?>
