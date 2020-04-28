<?php
include('../db_connect.php');
if (!$dbconn) {
  echo "Could not connect to database.\n";
  exit;
}

$oid = intval($_GET['oid']);
$exp = intval($_GET['exp']);

$result = pg_query($dbconn, "SELECT check_out($oid, $exp)");
pg_close();
if (!$result) {
  echo "An error occurred.\n";
  exit;
} else {
  header("Location: ../hostpage/hostpage.php");
}

?>