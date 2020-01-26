<?php

    $host    = "127.0.0.1";
    $port    = 8080;
    $message = "Hello Serversss";
    $flag = -1;
    while(1) {
    $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
    $result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");  
    // send string to server
    socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
    // get server response
    $result = socket_read ($socket, 1024) or die("Could not read server response\n");
    echo $result . "\n";
    socket_close($socket); 
    }

?>
