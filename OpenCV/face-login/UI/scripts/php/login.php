<?php

    session_start();
    ///echo "Attempting Login for";

    //should be sesssion variable 
    $username = $_POST['username'];
    $password = $_POST['password'];
    //echo $username . "\n";
    if (isset($_POST['username'])) {
        //Read JSON (later DATABASE) and find user, output JSON of data to HOST/SERVER
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
                $jsonObj = json_encode($tempArray);
                echo $jsonObj;
                $_SESSION['user'] = $username;
                if ($data['position'] == "host")
                    header("Location: ../../hostpage.html");
                else header("Location: ../../server.html");
                break;
            } else {
                header("Location: ../../index.html");
            }   
        }

      } else {
        echo "Loggin Error";
    }
?>
