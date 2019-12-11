<?php
    $host    = "127.0.0.1";
    $port    = 8081;
    $message = "Hello Serversss";
    //echo "Message To server :".$message;
    // create socket
    // connect to server
    $flag = "-";
    while($flag == "-") {
    
    $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
        $result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");  
        // send string to server
        socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
        // get server response
        $result = socket_read ($socket, 1024) or die("Could not read server response\n");
        echo $result[0] . "\n";
        echo $result . "\n";
        socket_close($socket);
        $flag = $result[0];
    }

    $jsonString = file_get_contents('e.json');
    $jsonArray = json_decode($jsonString, true);
    $tempArray = array();
    foreach ($jsonArray as $data) {

        if ($data['id'] == $result[0]) {
            $employee = array (
                'id' => $data['id'],
                'name' => $data['name']
            );
            array_push($tempArray, $employee);
            break;
        }
    }

    $jsonObj = json_encode($tempArray);
    echo $jsonObj;

    // close socket
?>
