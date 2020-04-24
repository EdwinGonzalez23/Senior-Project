<?php
include('../db_connect.php');

$oid = "1";
$test = pg_query($conn, "SELECT *FROM list_curr_orders WHERE orderid = $oid");
while ($data =pg_fetch_row($test)){
   $id = $data[0];
   $fname = $data[1];
   $lname = $data[2];
   $size = $data[4];
   $ctime = $data[6];
   $max = $data[7];
}

list($hour,$min,$sec)=preg_split('[:]',$ctime);
list($mhour,$mmin,$msec)=preg_split('[:]',$max);
$hdiff =abs( date("H") - $hour);
$mdiff =abs( date("i") - $min);
$sdiff =abs( date("s") - round($sec));

///testing
$timer = "3:10";
?>
