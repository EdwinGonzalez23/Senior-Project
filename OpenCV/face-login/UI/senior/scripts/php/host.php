<?php
    session_start();
    if (isset($_SESSION['user'])) {
        $username = $_SESSION['user'];
    $jsonString = file_get_contents('../../json/employee.json');
    $jsonArray = json_decode($jsonString, true);
    $tempArray = array();
    foreach ($jsonArray as $data) {
        
        if ($data['name'] == $username) {
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
    } else { 
        echo 0; 
    }
    


?>