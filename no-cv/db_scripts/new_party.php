<?php
include('../db_connect.php');
if (!$dbconn) {
  echo "An error occurred.\n";
  exit;
}

$partyName = $_GET['pName'];
$partySize = intval($_GET["guestAmount"]);

$result = pg_query($dbconn, "SELECT new_party('$partyName', $partySize)");
pg_close();
if (!$result) {
  echo "An error occurred.\n";
  exit;
} else {
  header("Location: ../hostpage/hostpage.php");
}

?>