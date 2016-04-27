<?php
require 'include/session.php';
require 'include/globle.inc.php';
if($_GET["act"]==ok){
	$l_id=$_POST['id'];
	$e_name=strtolower(trim($_POST['xyname']));
	$e_pwd=trim($_POST['pwd']);
	$e_re_pwd=trim($_POST['re_pwd']);
	if(!empty($e_pwd)){
	  $e_pwd=$e_pwd;
	  $e_re_pwd=$e_re_pwd;
	  if($e_pwd!==$e_re_pwd){
		 echo("<script type='text/javascript'> alert('两次密码不一致，请重新输入'); window.history.back();</script>");
		 exit;
	  }else{
		 $siteinfo = array(
			'xyname'=>$e_name,
			'xypwd' => md5(md5($e_pwd))
		 );
		 $db->update("xy_admin_user", $siteinfo,"id=$l_id");
		 ok_info('manage_info.php',"恭喜你，修改成功！");
	  }
	}else{
		$siteinfo = array(
	    'xyname'=>$e_name
		);
		$db->update("xy_admin_user", $siteinfo,"id=$l_id");
		ok_info('manage_info.php',"恭喜你，修改成功！");
	}
}
$sxid=$_GET["id"];
$e_rs=$db->get_one("select * from `xy_admin_user` where id=$sxid",MYSQL_ASSOC);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>信息添加</title>
<script type="text/javascript" src="Js/jquery.min.js"></script>
<link href="style/style.css" type="text/css" rel="stylesheet" />
</head>
<body >
<div id="loader" >页面加载中...</div>
<div id="result" class="result none"></div>
<div class="mainbox">
  <div id="nav" class="mainnav_title">
    <ul>
      <a href="manage_info.php">管理员管理</a>| <a href="add_info.php">添加管理员</a>
    </ul>
    <div class="clear"></div>
  </div>
  <script>
	//|str_replace=.'/index.php','',###
	var onurl ='manage_info.php';
	jQuery(document).ready(function(){
		$('#nav ul a ').each(function(i){
		if($('#nav ul a').length>1){
			var thisurl= $(this).attr('href');
			if(onurl.indexOf(thisurl) == 0 ) $(this).addClass('on').siblings().removeClass('on');
		}else{
			$('#nav ul').hide();
		}
		});
		if($('#nav ul a ').hasClass('on')==false){
		$('#nav ul a ').eq(0).addClass('on');
		}
	});
  </script>
  <div id="msg"></div>
  <form name="addform" id="addform" action="?act=ok" method="post">
    <table cellpadding=0 cellspacing=0 class="table_form" width="100%">
      <tr>
        <td width="10%" >用户名</td>
        <td width="90%" >
          <input type="text" class="input-text" name="xyname"  id="title"  size="55" value="<?php echo $e_rs['xyname'];?>" /><input name="id" type="hidden" value="<?php echo $sxid;?>" /> <font color="red">*</font>
          </td>
      </tr>
      <tr>
        <td width="10%" >密 码</td>
        <td width="90%"><input type="text" name="pwd" class="input-text" size="55" /> <font color="#FF0000"><strong>[不修改请留空]</strong></font></td>
      </tr>
      <tr>
        <td width="10%" >重复密码</td>
        <td width="90%"><input type="text" name="re_pwd" class="input-text" size="55" /></td>
      </tr>
    </table>
    <div id="bootline"></div>
    <div id="btnbox" class="btn">
      <INPUT TYPE="submit"  value="提交" class="button" >
      <input TYPE="reset"  value="取消" class="button">
    </div>
  </form>
</div>
</body>
</html>