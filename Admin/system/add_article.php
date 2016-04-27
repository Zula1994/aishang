<?php
require 'include/session.php';
require 'include/globle.inc.php';
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文章信息添加</title>
<script type="text/javascript" src="Js/jquery.min.js"></script>


<link href="style/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/laydate.js"></script>
<script type="text/javascript" src="js/check.js"></script>

</head>
<body style="overflow-x:hidden;">
<div class="mainbox">
  <div id="nav" class="mainnav_title">
    <ul>
      <a href="manage_article.php">文章管理</a>| <a href="add_article.php">添加文章</a>
    </ul>
    <div class="clear"></div>
  </div>
  <script>
	var onurl ='add_article.php';
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
          <input type="text" class="input-text" name="title"  id="title"  size="55" />
          &nbsp;
          <input type="checkbox" class="style_bold" id="a_bold" name="a_bold" value="bold"  />
          <b>加粗</b> &nbsp;&nbsp;<input name="a_color"  type="text"  id="colorPicker" /> <b>标题颜色</b>
          <script type="text/javascript" src="js/Deepteach_colorPicker.js"></script></td>
      </tr>
      <tr>
        <td width="10%" >关键词</td>
        <td width="90%"><input type="text" class="input-text" name="keywords"  id="keywords"  size="55" /></td>
      </tr>
      <tr>
        <td width="10%" >SEO简介</td>
        <td width="90%"><textarea  name="description"  style="width: 446px;height: 120px;resize: none;" id="description"   /></textarea></td>
      </tr>
      <tr>
        <td width="10%" >内容</td>
        <td width="90%" id="box_content"><textarea name="content" style="width:446px;height:200px; resize: none;"></textarea></td>
      </tr>
      <tr>
        <td width="10%" ><font color="red">*</font>发布时间</td>
        <td width="90%" id="box_createtime"><input name="c_date" type='text' class="laydate-icon" id="c_date" value="<?php echo date('Y-m-d h:i:s');?>" /></td>
      </tr>
      <tr>
        <td width="10%" ><font color="red">*</font>文章作者</td>
        <td width="90%" id="box_createtime"><input name="a_author" type='text' id="a_author" class="input-text" value="本站编辑" /></td>
      </tr>
      <tr>
        <td width="10%" ><font color="red">*</font>文章来源</td>
        <td width="90%" id="box_createtime"><input name="a_from" type='text' id="a_from" class="input-text" value="本站" /></td>
      </tr>
      <tr>
        <td width="10%" >是否推荐</td>
        <td width="90%" id="box_posid"><select id="is_hot" name="is_hot" class="input_select" >
            <option value="0" selected="selected">否</option>
            <option value="1">是</option>
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


if($_GET["act"]==ok){
	$siteinfo = array(
	  'catid'=>$_POST['catid'],
		'title' => $_POST['title'],
		'a_bold' => $_POST['a_bold'],
		'a_color' => $_POST['a_color'],
		'keywords' => $_POST['keywords'],
		'description' => $_POST['description'],
		'content' => $_POST['content'],
		'is_hot' => $_POST['is_hot'],
		'a_author' => $_POST['a_author'],
		'a_from' => $_POST['a_from'],
		'c_date' => strtotime($_POST['c_date']),
		);
	@$c_date = strtotime($_POST['c_date']);
	@$title = $_POST['title'];
	@$content = $_POST['content'];
	$db->insert("xy_article", $siteinfo);
	$sqlId = "select id from xy_article where c_date='$c_date'";
	$result=$db->query($xy_sql); 
	while ($row = mysqli_fetch_array($result))
	$Id = $row['id'];

	//生成静态页面
	$Title = $title;
	$C_date = date(("Y-m-d"), $c_date);
	$Content = $content;
	
	$id= $Id;
	//定义变量
	$temp_file = "../../html/news/news.html";
	//临时文件，也可以是模板文件
	$dest_file = "../../html/news/".$C_date.".html";
	//生成的目标页面
	$fp = fopen($temp_file, "r");
	//只读打开模板
	$str = fread($fp, filesize($temp_file));
	//读取模板中内容
	$str = str_replace("{title}", $Title, $str);
	$str = str_replace("{infos}", $C_date, $str);
	$str = str_replace("{MainContent}", $Content, $str);
	$str = str_replace("{id}", $id, $str);
	//替换内容
	fclose($fp);
	$handle = fopen($dest_file, "w");
	//写入方式打开需要写入的文件
	fwrite($handle, $str);
	//把刚才替换的内容写进生成的HTML文件
	fclose($handle);
	//关闭打开的文件，释放文件指针和相关的缓冲区
	$db->close();
	echo "<script language='javascript'>";
	echo "alert('恭喜您,信息内容添加成功!');";
	echo " location='manage_article.php';";
	echo "</script>";
}
?>