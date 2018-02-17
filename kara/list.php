<?php 
include "./models/classDB.php";
$db = new db;
$listBH = $db->listBH();
while($row = mysql_fetch_assoc($listBH)){

 echo strtolower($db->stripUnicode($row['tenbh'])); echo " - ".$row['mabh']." - ".$row['casi']."#"; 
 
}

?>