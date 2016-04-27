<?php
require 'include/session.php';
require 'include/globle.inc.php';
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统</title>
<script type="text/javascript" src="Js/jquery.min.js"></script>
<link href="style/style.css" type="text/css" rel="stylesheet" />
<style>

.mainnav_title{ display:none;}
h1 { height:30px;line-height:30px;font-size:14px;padding-left:15px;background:#EEE;border-bottom:1px solid #ddd;border-right:1px solid #ddd;overflow:hidden;zoom:1;margin-bottom:10px;}
h1 b {color:#3865B8;}
h1 span {color:#ccc;font-size:10px;margin-left:10px;}
#system {width:99%;float:left;margin:5px 0px 0 0;}
.list ul{ border:1px #ddd solid;  overflow:hidden;border-bottom:none;}
.list ul li{ border-bottom:1px #ddd solid; height:32px;  overflow:hidden;zoom:1; line-height:32px; color:#777;padding-left:5px;}
.list ul li span{ display:block; float:left; color:#777; font-size:14px; width:110px;}

#coprights {width:99%;float:left;margin:5px 0px 0 0;}
#xycms_sn {color:#FB0000;font-weight:normal;}
#xycms_license {font-weight:normal;color:blue;}
#xycms_license a {color:#FB0000;}
</style>
<script language="JavaScript">
function selectall(name) {
	if (document.getElementById("check_box").checked) {
		$("input[name='"+name+"']").each(function() {
			this.checked=true;
		});
	} else {
		$("input[name='"+name+"']").each(function() {
			this.checked=false;
		});
	}
}

function openwin(id,url,title,width,height,lock,yesdo,topurl){ 

	top.box.open("iframe:"+url,title,width,height,{
			id:id,
			submit: function (v, h, f){
				iframeWin = top.box.getIframe(id);
				if (v == 'ok'){
					if(yesdo || topurl){
						if(yesdo){
							yesdo.call(this,iframeWin, id,inputid); 
						}else{
							top.jBox.close(true);
							top.location.href=topurl;
						}
					}else{
						var form = $(iframeWin).contents().find('#dosubmit');
						$(form).click();
						return false;
					}

				}
			}
		});
 
}

function showpicbox(url){
	top.box( '<img src="'+url+'" />',{width:'auto'});
} 
//-->
</script>
</head>
<body width="100%" style="overflow-x:hidden;">
<div class="mainbox">
 欢迎使用爱尚电子有限公司后台管理系统
 
</div>
</body>
</html>