<?php
require 'include/session.php';
require 'include/globle.inc.php';
$id=$_GET["id"];
$hits=$_GET["hits"];
	$sql = "SELECT hits FROM `xy_article` where id= $id ";
	$result =$db->query($sql);
	$row=mysql_fetch_array($result);
	$list=array("hits"=>$row[hits]);
	echo json_encode($list);
	$sqlUpa = "UPDATE xy_article set hits = $hits where id = $id";
	$db->query($sqlUpa);
	
?>