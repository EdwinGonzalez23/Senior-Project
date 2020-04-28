<?php
     $host    = "127.0.0.1";
    $port    = 8080;
    $message = "Hello Serversss";
    //echo "Message To server :".$message;
    // create socket
    // connect to server
    $flag = -1;
    while($flag == -1) {
    
    $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
    $result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");  
    // send string to server
    socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
    // get server response
    $result = socket_read ($socket, 1024) or die("Could not read server response\n");
    socket_close($socket);
    if ($result[0] != '-')
        $flag = 0;
    }

//    $result = "012";
    $jsonString = file_get_contents('../../json/employee.json');
    $jsonArray = json_decode($jsonString, true);
    $tempArray = array();
    $counter = 0;
    while ($counter < 3) {
        foreach ($jsonArray as $data) {
            if ($data['id'] == $result[$counter]) {
                $employee = array (
                    'id' => $data['id'],
                    'name' => $data['name']
                );
                array_push($tempArray, $employee);
                break;
            }
        }
        $counter++;
    }
    $jsonObj = json_encode($tempArray);
    echo $jsonObj;
    // close socket
?>
