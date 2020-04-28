<?php
include('../db_connect.php');
if (!$dbconn) {
  echo "An error occurred.\n";
  exit;
}
// Simulate Table 1 visit
$result = pg_query($dbconn, "SELECT new_table_visit(1)");
pg_close();
if (!$result) {
  echo "An error occurred.\n";
  exit;
} else {
  header("Location: ../hostpage/hostpage.php");
}

?>