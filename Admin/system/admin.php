<?php
require 'include/session.php';
require 'include/globle.inc.php';
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统 - </title>
<script type="text/javascript" src="Js/jquery.min.js"></script>
<link href="style/style.css" type="text/css" rel="stylesheet" />
</head>
<body style="background:#E2E9EA">
<div id="header" class="header">
  <div class="logo"><a href="#" target="_blank"><img src="images/logo.png" width="180"></a></div>
  <div class="nav f_r"> <a href="#" target="_blank">官方网站</a> <i>|</i> 技术支持QQ:783617729 &nbsp;&nbsp;&nbsp;&nbsp;</div>
  <div class="nav">&nbsp;&nbsp;&nbsp;&nbsp;欢迎你！<?php echo $_SESSION['m_name'];?> <i>|</i> [超级管理员] <i>|</i> [<a href="loginout.php" target="_top">退出</a>] <i>|</i> <a href="<?php echo $wzurl;?>" target="_blank">浏览站点</a> <i>|</i> </div>
  <div class="topmenu">
    <ul>
      <li id="menu_1"><span><a href="javascript:void(0);" onClick="sethighlight(1);">后台首页</a></span></li>
      <li id="menu_3"><span><a href="javascript:void(0);" onClick="sethighlight(3);">内容管理</a></span></li>
      <li id="menu_4"><span><a href="javascript:void(0);" onClick="sethighlight(4);">模块管理</a></span></li>
    </ul>
  </div>
  <div class="header_footer"></div>
</div>
<div id="Main_content">
  <div id="MainBox" >
    <div class="main_box">
      <iframe name="main" id="Main" src='system.php' frameborder="false" width="100%" height="auto" allowtransparency="true"></iframe>
    </div>
  </div>
  <div id="leftMenuBox">
    <div id="leftMenu">
      <div style="padding-left:12px;_padding-left:10px;">
        <dl id="nav_1">
          <dt>后台首页</dt>
          <dd id="nav_11"><span><a href="system.php" target="main">后台首页</a></span></dd>
          <dd id="nav_12"><span><a href="manage_info.php" target="main">管理员管理</a></span></dd>
        </dl>
        <dl id="nav_2">
          <dt>系统设置</dt>
          <dd id="nav_21"><span><a href="manage_setup.php" target="main">系统设置</a></span></dd>
        </dl>
        <dl id="nav_3">
          <dt>内容管理</dt>
          <dd id="nav_32"><span><a href="manage_article.php" target="main">文章模型</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="add_article.php" id="" target="main">添加</a></span></dd>
          <dd id="nav_33"><span><a href="manage_pro.php" target="main">产品模型</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="add_pro.php" target="main">添加</a></span></dd>
          <dd id="nav_34"><span><a href="manage_case.php" target="main">案例模型</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="add_case.php" id="" target="main">添加</a></span></dd>
          <dd id="nav_35"><span><a href="manage_job.php" target="main">招聘模型</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="add_job.php" id="" target="main">添加</a></span></dd>
          <dd id="nav_38"><span><a href="manage_photo.php" target="main">相册模型</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="add_photo.php" id="" target="main">添加</a></span></dd>
        </dl>
        <dl id="nav_4">
          <dt>模块管理</dt>
          <dd id="nav_41"><span><a href="manage_link.php" target="main">友情链接</a></span></dd>
          <dd id="nav_44"><span><a href="manage_gbook.php" target="main">在线留言</a></span></dd>
        </dl>
    </div>
    <div id="Main_drop"> <a  href="javascript:toggleMenu(1);" class="on"><img src="images/admin_barclose.gif" width="11" height="60" border="0"  /></a> <a  href="javascript:toggleMenu(0);" class="off" style="display:none;"><img src="images/admin_baropen.gif" width="11" height="60" border="0"  /></a> </div>
  </div>
</div>
<script language="JavaScript">
if(!Array.prototype.map)
Array.prototype.map = function(fn,scope) {
  var result = [],ri = 0;
  for (var i = 0,n = this.length; i < n; i++){
	if(i in this){
	  result[ri++]  = fn.call(scope ,this[i],i,this);
	}
  }
return result;
};
var getWindowWH = function(){
	  return ["Height","Width"].map(function(name){
	  return window["inner"+name] ||
		document.compatMode === "CSS1Compat" && document.documentElement[ "client" + name ] || document.body[ "client" + name ]
	});
}
window.onload = function (){
	if(!+"\v1" && !document.querySelector) { //IE6 IE7
	 document.body.onresize = resize;
	} else { 
	  window.onresize = resize;
	}
	function resize() {
		wSize();
		return false;
	}
}
function wSize(){
	var str=getWindowWH();
	var strs= new Array();
	strs=str.toString().split(","); //字符串分割
	var h = strs[0] - 95-30;
	$('#leftMenu').height(h);
	$('#Main').height(h); 
	$('#Main_drop').height(h-220); 
}
wSize();


function sethighlight(n) {
	 $('.topmenu li span').removeClass('current');
	 $('#menu_'+n+' span').addClass('current');
	 $('#leftMenu dl').hide();
	 $('#nav_'+n).show();
	 $('#leftMenu dl dd').removeClass('on');
	 $('#nav_'+n+' dd').eq(0).addClass('on');
	 url = $('#nav_'+n+' dd a').eq(0).attr('href'); //框架显示控制
	 window.main.location.href= url;  //框架显示控制
}

$('#leftMenu dl dd').click(function(){
	$('#leftMenu dl dd').removeClass('on');
	$(this).addClass('on');
    window.main.location.href = $(this).find("a").attr("href");
});
function gocacheurl(){
	mainurl = window.main.location.href;
	window.main.location.href= "/admin.php?m=Index&a=cache&forward="+encodeURIComponent(mainurl);
}

function toggleMenu(doit){
	if(doit==1){
		$('#Main_drop a.on').hide();
		$('#Main_drop a.off').show();
		$('#MainBox .main_box').css('margin-left','24px');
		$('#leftMenu').hide();
	}else{
		$('#Main_drop a.off').hide();
		$('#Main_drop a.on').show();
		$('#leftMenu').show();
		$('#MainBox .main_box').css('margin-left','224px');
	}
}	
sethighlight(1);
</script>

<div id="footer" class="footer">Powered by <a href="#" target="_blank">爱尚数码产品有限公司</a>&nbsp; Released&nbsp;Copyright 朱璐 技术支持QQ：783617729</div>
</body>
</html>