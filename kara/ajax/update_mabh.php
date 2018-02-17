<?php 
include_once "../models/classDB.php";	
	$mabh = $_POST['mabh'];
	$id = $_POST['id'];
	settype($id,"int");
	$db = new db;
	
	$row = $db->updateBH($mabh,$id);
	echo $row;exit();
?>