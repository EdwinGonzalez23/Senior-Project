<?php
include('../db_connect.php');
if (!$dbconn) {
  echo "An error occurred.\n";
  exit;
}

$oid = intval($_GET['oid']);
$sid = ($_GET['serverAssigned']);
$tid = intval($_GET['tableNumber']);

$result = pg_query($dbconn, "SELECT seat_party($oid, $sid, $tid)");
pg_close();
if (!$result) {
  echo "An error occurred.\n";
  exit;
} else {
  header("Location: ../hostpage/hostpage.php");
}


?>