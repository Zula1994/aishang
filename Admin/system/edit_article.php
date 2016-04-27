<?php
require 'include/session.php';
require 'include/globle.inc.php';
if($_GET["act"]==ok){
	$c_id=$_POST['id'];
	$siteinfo = array(
	    'catid'=>$_POST['catid'],
		'title' => $_POST['title'],
		'a_bold' => $_POST['a_bold'],
		'a_color' => $_POST['a_color'],
		'a_url' => $_POST['a_url'],
		'keywords' => $_POST['keywords'],
		'description' => $_POST['description'],
		'thumb' => $_POST['link_img'],
		'content' => $_POST['content'],
		'is_hot' => $_POST['is_hot'],
		'a_author' => $_POST['a_author'],
		'a_from' => $_POST['a_from'],
		'c_date' => strtotime($_POST['c_date'])
		);
	$db->update("xy_article", $siteinfo,"id=$c_id");
	make_to_html($c_id,0);
	index_to_html(0);
	//$db->close();
    echo "<script language='javascript'>"; 
    echo "alert('恭喜您,文章内容信息修改成功!');";
    echo " location='manage_article.php';"; 
    echo "</script>";
}
$sxid=$_GET["id"];
$e_rs=$db->get_one("select * from xy_article where id=$sxid",MYSQL_ASSOC);
$catid=$e_rs['catid'];
$is_hot=$e_rs['is_hot'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
<div id="loader" >页面加载中...</div>
<div id="result" class="result none"></div>
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
        <td width="10%" ><font color="red">*</font>栏目分类</td>
        <td width="90%" id="box_catid"><select  id="catid" name="catid" class="input_select">
            <option value="请选择">请选择</option>
            <?php echo get_str(0,$catid);?>
          </select></td>
      </tr>
      <tr>
        <td width="10%" ><font color="red">*</font>标题</td>
        <td width="90%" >
          <input type="text" class="input-text" name="title"  id="title"  size="55" value="<?php echo $e_rs['title'];?>" />
          &nbsp;
          <input type="checkbox" class="style_bold" id="a_bold" name="a_bold" value="bold" <?php if($e_rs['a_bold']=='bold'){?> checked="checked"<?php }?> />
          <b>加粗</b> &nbsp;&nbsp;<input name="a_color"  type="text"  id="colorPicker" value="<?php echo $e_rs['a_color'];?>" /> <b>标题颜色</b>
          <script type="text/javascript" src="js/Deepteach_colorPicker.js"></script> <input type="hidden" name="id" value="<?php echo $sxid;?>" /></td>
      </tr>
      <tr>
        <td width="10%" >外网URL</td>
        <td width="90%"><input type="text" class="input-text" name="a_url"  id="a_url"  size="55" value="<?php echo $e_rs['a_url'];?>"/> 【此项填写以下内容失效】</td>
      </tr>
      <tr>
        <td width="10%" >关键词</td>
        <td width="90%"><input type="text" class="input-text" name="keywords"  id="keywords"  size="55" value="<?php echo $e_rs['keywords'];?>" /></td>
      </tr>
      <tr>
        <td width="10%" >SEO简介</td>
        <td width="90%"><textarea  name="description"  rows="4" cols="75" id="description" /><?php echo $e_rs['description'];?></textarea></td>
      </tr>
      <tr>
        <td width="10%" >图片</td>
        <td width="90%" id="box_pics"><input type="text" name="link_img" id="link_img" class="input-text" value="<?php echo $e_rs['thumb'];?>" size="50" /> <input type="button" id="s_img" class="xy_smt" value="选择图片" /></td>
      </tr>
      <tr>
        <td width="10%" >内容</td>
        <td width="90%" id="box_content"><textarea name="content" style="width:670px;height:400px;visibility:hidden;"><?php echo $e_rs['content'];?></textarea></td>
      </tr>
      <tr>
        <td width="10%" ><font color="red">*</font>发布时间</td>
        <td width="90%" id="box_createtime"><input name="c_date" type='text' class="laydate-icon" id="c_date" value="<?php echo date("Y-m-d h:i:s",$e_rs['c_date']);?>" /></td>
      </tr>
      <tr>
        <td width="10%" ><font color="red">*</font>文章作者</td>
        <td width="90%" id="box_createtime"><input name="a_author" type='text' id="a_author" class="input-text" value="<?php echo $e_rs['a_author'];?>" /></td>
      </tr>
      <tr>
        <td width="10%" ><font color="red">*</font>文章来源</td>
        <td width="90%" id="box_createtime"><input name="a_from" type='text' id="a_from" class="input-text" value="<?php echo $e_rs['a_from'];?>" /></td>
      </tr>
      <tr>
        <td width="10%" >是否推荐</td>
        <td width="90%" id="box_posid"><select id="is_hot" name="is_hot" class="input_select" >
            <option value="0" <?php if($is_hot==0){?> selected="selected"<?php }?>>否</option>
            <option value="1" <?php if($is_hot==1){?> selected="selected"<?php }?>>是</option>
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
    event: 'focus',
	format: 'YYYY-MM-DD hh:mm:ss'
	});
</script>
<?php
//返回字符串（正在使用）
function get_str($pid=0,$catid) { 
    global $db;
	global $str;
    $sql = "select * from xy_category where pid= $pid order by c_order asc";  
    $result =$db->query($sql);//查询pid的子类的分类 
    if($result && mysql_affected_rows()){//如果有子类 
        while ($row = mysql_fetch_array($result)) { //循环记录集 
		    if($row['cid']==$catid){
				$select="selected='selected'";
			}else{
				$select="";
			}
			if($row['c_type']!=1){
				$disabled="disabled='disabled'";
			}else{
				$disabled="";
			}
			
            $str .= "<option value='".$row['cid']."' $select $disabled>|".str_repeat("---",$row['c_lev'])."".$row['cname']."</option>"; //构建字符串 
            get_str($row['cid'],$catid); //调用get_str()，将记录集中的id参数传入函数中，继续查询下级 
        } 
    } 
    return $str; 
}
?>