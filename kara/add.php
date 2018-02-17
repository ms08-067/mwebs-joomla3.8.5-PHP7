<?php 
/*
include "./models/classDB.php";
$db = new db;
$listBH = $db->listBH();
while($row = mysql_fetch_assoc($listBH)){

 echo strtolower($db->stripUnicode($row['tenbh'])); echo " - ".$row['mabh']." - ".$row['casi']."#"; 
 
}
*/

var_dump($_REQUEST);
$mabh = $_GET['mabh'];$tenbh = $_GET['tenbh'];$casi = $_GET['casi'];$nhacsi = $_GET['nhacsi'];
echo "\n".$mabh."\n".$tenbh."\n".$casi."\n".$nhacsi."\n";

?>