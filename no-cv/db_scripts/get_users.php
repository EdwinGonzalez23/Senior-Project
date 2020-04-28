<?php
include('../db_connect.php');
if (!$dbconn) {
  echo "Unable to Connect.\n";
  exit;
}
$jsonTopThree = array();
// Pretend IDs 1,2,4 have been returned from OPENCV
$possibleUsers = array (1,3,4);

$topOneQuery = pg_query($dbconn, "SELECT * FROM humans WHERE humanid = $possibleUsers[0]");
$topOne = pg_fetch_array($topOneQuery);
$topTwoQuery = pg_query($dbconn, "SELECT * FROM humans WHERE humanid = $possibleUsers[1]");
$topTwo = pg_fetch_array($topTwoQuery);
$topThreeQuery = pg_query($dbconn, "SELECT * FROM humans WHERE humanid = $possibleUsers[2]");
$topThree = pg_fetch_array($topThreeQuery);

array_push($jsonTopThree, $topOne);
array_push($jsonTopThree, $topTwo);
array_push($jsonTopThree, $topThree);

pg_close();
echo json_encode($jsonTopThree);

?>
