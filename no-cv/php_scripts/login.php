<?php
/*
    4 - Manager 
    3 - Server 
    2- Host
*/
    session_start();
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['pos'] = $_POST['pos'];
    $_SESSION['id'] = $_POST['id'];
    echo $_POST['id'];
    $pos = $_POST['pos'];;
    if ($pos == 4) {
        header("Location: ../managerpage/Manager.php");
    } else if ($pos == 3) {
        header("Location: ../serverpage/serverpage.php");
    } else if ($pos == 2) {
        header("Location: ../hostpage/hostpage.php");
    }
?>
