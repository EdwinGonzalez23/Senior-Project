<?php

    $username = $_POST['plname'];
    $userid = $_POST['plid'];
    $partyOrder = $_POST['pOrder'];
    $numGuests = $_POST['pNumGuests'];
    $tableNum = $_POST['pTableNum'];
    $assignedServer = $_POST['pServer'];
    //echo $userid;
    echo $username;

    $customerArray = array(
        'party order' => (int)$partyOrder,
        'name' => $username,
        'custID' => (int)$userid,
        'number guests' => (int)$numGuests,
        'server' => $assignedServer,
        'table' => (int)$tableNum
    );
    
    //open or read json data
    $employeeJsonString = file_get_contents('../../json/table-assign.json');
    $tempArray = json_decode($employeeJsonString);
    
    //append additional json to json file
    $tempArray->Party[] = $customerArray ;
    $jsonData = json_encode($tempArray);
    
    file_put_contents('../../json/table-assign.json', $jsonData);
    echo $jsonData;
    header("Location: ../../hostpage.html");
   
?>