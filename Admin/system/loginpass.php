<?php
session_start();
require 'include/globle.inc.php';
//登录验证
if(strtolower($_POST["checkcode"])==strtolower($_SESSION["randval"])){
  unset($_SESSION["randval"]);//释放session中的变量
}else{
  unset($_SESSION["randval"]);
  message("验证码输入有误","验证码输入有误!","index.php");
  exit();
}
if(isset($_POST["admin"]) && isset($_POST["password"]) && isset($_POST["checkcode"])){
  $m_name=xy_rep(trim($_POST["admin"]));
  $m_pwd=md5(md5($_POST["password"]));
  $login_ip=getIp();
  $sql="select * from xy_admin_user where xyname='".$m_name."' and xypwd='".$m_pwd."'";
  $result=$db->query($sql);
  if(!mysql_num_rows($result)==0){
    $_SESSION["m_name"] = $m_name;
	$db->query("UPDATE xy_admin_user SET login_num=login_num+1 where xyname='".$m_name."'");
	$login_info=array(
	   'login_name'=>$m_name,
	   'login_date'=>strtotime(date('Y-m-d')),
	   'login_ip'=>$login_ip
	);
	$db->insert("xy_admin_user_count",$login_info);
	$db->close();
	message("恭喜您，登陆成功","恭喜您，登陆成功","admin.php");
  }else{
	message("帐号或者密码有误","帐号或者密码有误!","index.php");
	exit();
  }
}
?>
