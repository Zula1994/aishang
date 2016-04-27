<?php
require 'include/session.php';
require 'include/globle.inc.php';
	$siteinfo = array(
		'f_name' => $_POST['name'],
		'f_email'=>$_POST["email"],
		'content' => $_POST['content'],
		'f_tel' => $_POST['phone'],
		'c_date' => strtotime( date('y-m-d h:i:s',time())),
	);
		$db->insert("xy_book", $siteinfo);
?>