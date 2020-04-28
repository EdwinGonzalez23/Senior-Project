<?php

/*
Grab Session Variable. Grab table-assign.json, find currenty working tables
ECHO JSON to server.html
*/
    session_start();
    // echo $_SESSION['user'];

    $jsonString = file_get_contents('../../json/table-assign.json');
    
    $jsonArray = json_decode($jsonString, true);
    //var_dump($jsonArray);
    // $tempArray = array();
    // foreach ($jsonArray as $data) {
    //     //if ($data['name'] == $username) {
    //         $employee = array (
    //             'id' => $data['id'],
    //             'name' => $data['name']
    //         );
    //         array_push($tempArray, $employee);
    // } 
    $jsonObj = json_encode($jsonArray);
    echo $jsonObj;

?>