<?php
include('../db_connect.php');
if (!$dbconn) {
  echo "Unable to Connect.\n";
  exit;
}
$jsonTopThree = array();
// Pretend IDs 1,2,4 have been returned from OPENCV
$possibleUsers = array (4,2,3);
$topThreeDb = pg_query($dbconn, "SELECT * FROM humans WHERE humanid = $possibleUsers[0] OR humanid = $possibleUsers[1] OR humanid = $possibleUsers[2]");
while($topThreeDbArray = pg_fetch_array($topThreeDb)) {
    array_push($jsonTopThree, $topThreeDbArray);
}
pg_close();
echo json_encode($jsonTopThree);

?>