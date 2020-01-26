<?php
/*
    $host    = "127.0.0.1";
    $port    = 8080;
    $message = "Hello Serversss";
    $flag = -1;
    //while($flag == -1) {
    $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
    $result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");  
    // send string to server
    socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
    // get server response
    $result = socket_read ($socket, 1024) or die("Could not read server response\n");
    echo $result . "\n";
    socket_close($socket);
*/
    $did = 0;
    echo "Connecting....\n";

    $host        = "host=167.172.200.202";
    $port        = "port=5432";
    $dbname      = "dbname=senior_project";
    $credentials = "user=ben password=reset-this";

    $connect= pg_connect( "$host $port $dbname $credentials"  ) or die("Could not connect: " . pg_last_error());

    $party = pg_query($connect, "SELECT * FROM senior.party"); 
    // -- Where pid=$did");
    $row = pg_fetch_row($party);
    echo "\nConnected!\n";
    echo $row[0] . "\n";
    echo $row[1] . "\n";
    echo $row[2] . "\n";

    //}


    // If Green, start initial timer, save start time to DB
    // $timestamp;
    // $timestamp = date('Y-m-d H:i:s');

    // $time = "INSERT INTO timers (timerid) values (0)";
    // $result = pg_query($connect, $time);
    // If Yellow

    // If Red

    // If Blue

    pg_close($connect);

















/*
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
    */
    // close socket
?>
