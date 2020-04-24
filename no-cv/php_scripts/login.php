<?php
    session_start();
    $_SESSION['username'] = $_POST['username'];
    $pos = $_POST['pos'];;
    if ($pos == 4) {
        header("Location: ../hostpage/hostpage.php");
    } else if ($pos == 3) {
        header("Location: ../serverpage/serverpage.php");
    }
?>
