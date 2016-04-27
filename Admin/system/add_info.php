<?php
require 'include/session.php';
require 'include/globle.inc.php';
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>信息添加</title>
<script type="text/javascript" src="Js/jquery.min.js"></script>
<link href="style/style.css" type="text/css" rel="stylesheet" />
<script language='javascript'>
function checksignup() {
if ( document.addform.xyname.value == '' ) {
window.alert('请输入用户名^_^');
document.addform.xyname.focus();
return false;}

if ( document.addform.pwd.value == '' || document.addform.re_pwd.value =='' ) {
window.alert('请填写密码^_^');
document.addform.pwd.focus();
return false;}

return true;}
</script>
</head>
<body >
<div class="mainbox">
  <div id="nav" class="mainnav_title">
    <ul>
      <a href="manage_info.php">管理员管理</a>| <a href="add_info.php">添加管理员</a>
    </ul>
  </div>
  <script>
	var onurl ='add_info.php';
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
          <input type="text" class="input-text" name="xyname"  id="title"  size="55" /> <font color="red">*</font>
          </td>
      </tr>
      <tr>
        <td width="10%" >密 码</td>
        <td width="90%"><input type="text" name="pwd" class="input-text" size="55" /> <font color="red">*</font></td>
      </tr>
      <tr>
        <td width="10%" >重复密码</td>
        <td width="90%" ><input type="text" name="re_pwd" class="input-text" size="55" /></td>
      </tr> 
    </table>
    <div id="bootline"></div>
    <div id="btnbox" class="btn">
      <INPUT TYPE="submit"  value="提交" class="button" onClick='javascript:return checksignup()'>
      <input TYPE="reset"  value="取消" class="button">
    </div>
  </form>
</div>
</body>
</html>
<?php
//返回字符串（正在使用）
if($_GET["act"]==ok){
	$a_name=trim($_POST['xyname']);
	$a_pwd=trim($_POST['pwd']);
	$a_re_pwd=trim($_POST['re_pwd']);
	if($a_pwd!==$a_re_pwd){
	  echo("<script type='text/javascript'> alert('两次密码不一致，请重新输入'); window.history.back();</script>");
	  exit;
	}else{
	  $siteinfo = array(
	    'xyname'=>$a_name,
		'xypwd' =>md5(md5($a_pwd)),
		'c_date' =>strtotime(date('Y-m-d'))
	  );
	  $db->insert("xy_admin_user", $siteinfo);
	  $db->close();
	  ok_info('manage_info.php',"恭喜你，添加成功！");
	}
}
?>