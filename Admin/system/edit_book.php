<?php
require 'include/session.php';
require 'include/globle.inc.php';
if($_GET["act"]==ok){
	$c_id=$_POST['id'];
	$siteinfo = array(
	    'title' => $_POST['title'],
		'content' => $_POST['ly_content'],
		'reply_content' => $_POST['content'],
		'c_order' => $_POST['c_order'],
		'is_view' => $_POST['is_view'],
		'c_date' => strtotime($_POST['c_date'])
		);
	$db->update("xy_book", $siteinfo,"id=$c_id");
	//$db->close();
    echo "<script language='javascript'>"; 
    echo "alert('恭喜您,留言内容回复成功!');";
    echo " location='manage_gbook.php';"; 
    echo "</script>";
}
$sxid=$_GET["id"];
$e_rs=$db->get_one("select * from xy_book where id=$sxid",MYSQL_ASSOC);
$is_view=$e_rs['is_view'];
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>栏目信息添加</title>
<script type="text/javascript" src="Js/jquery.min.js"></script>
<link href="style/style.css" type="text/css" rel="stylesheet" />
<script charset="utf-8" src="/statics/xyeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/statics/xyeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="js/laydate.js"></script>
<script>
var editor;
KindEditor.ready(function(K) {
  editor = K.create('textarea[name="content"]', {
	uploadJson : '/statics/xyeditor/php/upload_json.php',
	fileManagerJson : '/statics/xyeditor/php/file_manager_json.php',
    allowFileManager : true
  });
  K('#s_img').click(function() {
	editor.loadPlugin('image', function() {
	editor.plugin.imageDialog({
	imageUrl : K('#link_img').val(),
	clickFn : function(img, title, width, height, border, align) {
	K('#link_img').val(img);
	editor.hideDialog();
	}
	});
   });
  });
});
</script>
</head>
<body style="overflow-x:hidden;">
<div class="mainbox">
  <div id="nav" class="mainnav_title">
    <ul>
      <a href="manage_article.php">文章管理</a>| <a href="add_article.php">添加文章</a>|
    </ul>
    <div class="clear"></div>
  </div>
  <script>
	var onurl ='add_category.php';
	jQuery(document).ready(function(){
		$('#nav ul a ').each(function(i){
		if($('#nav ul a').length>1){
			var thisurl= $(this).attr('href');
			thisurl = thisurl.replace('&menuid=22','');
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
        <td width="10%" ><font color="red">*</font>标题</td>
        <td width="90%" >
          <input type="text" class="input-text" name="title"  id="title"  size="55" value="<?php echo $e_rs['title'];?>" />
          &nbsp;
          <input type="hidden" name="id" value="<?php echo $sxid;?>" /></td>
      </tr>
      <tr>
        <td width="10%" >留言内容</td>
        <td width="90%"><textarea name="ly_content" id="ly_content" cols="85" rows="8"><?php echo $e_rs['content'];?></textarea></td>
      </tr>
      <tr>
        <td width="10%" >回复内容</td>
        <td width="90%" id="box_content"><textarea name="content" style="width:446px;height:300px;resize: none;"><?php echo $e_rs['reply_content'];?></textarea></td>
      </tr>
      <tr>
        <td width="10%" ><font color="red">*</font>发布时间</td>
        <td width="90%" id="box_createtime"><input name="c_date" type='text' class="laydate-icon" id="c_date" value="<?php echo date("Y-m-d",$e_rs['c_date']);?>" /></td>
      </tr>
      <tr>
        <td width="10%" ><font color="red">*</font>排序</td>
        <td width="90%" id="box_createtime"><input type="text" class="input-text" name="c_order"  id="c_order"  size="10" value="<?php echo $e_rs['c_order'];?>" /> 【数字，数字越小越靠前】</td>
      </tr>
      <tr>
        <td width="10%" >是否显示</td>
        <td width="90%" id="box_posid"><select id="is_view" name="is_view" class="input_select" >
            <option value="0" <?php if($is_view==0){?> selected="selected"<?php }?>>不显示</option>
            <option value="1" <?php if($is_view==1){?> selected="selected"<?php }?>>显示</option>
          </select></td>
      </tr>
      
    </table>
    <div id="bootline"></div>
    <div id="btnbox" class="btn">
      <INPUT TYPE="submit"  value="提交" class="button" onClick='javascript:return checkaddform()'>
      <input TYPE="reset"  value="取消" class="button">
    </div>
  </form>
</div>
</body>
</html>
<script>
laydate({
    elem: '#c_date', 
    event: 'focus'
	});
</script>