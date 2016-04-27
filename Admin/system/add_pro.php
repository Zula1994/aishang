<?php
require 'include/session.php';
require 'include/globle.inc.php';
?>
<!DOCTYPE>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>信息添加</title>
<script type="text/javascript" src="Js/jquery.min.js"></script>
<link href="style/style.css" type="text/css" rel="stylesheet" />
<script charset="utf-8" src="/statics/xyeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/statics/xyeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="js/laydate.js"></script>
<script type="text/javascript" src="js/check.js"></script>
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
function openShutManager(oSourceObj,oTargetObj,shutAble,oOpenTip,oShutTip){
var sourceObj = typeof oSourceObj == "string" ? document.getElementById(oSourceObj) : oSourceObj;
var targetObj = typeof oTargetObj == "string" ? document.getElementById(oTargetObj) : oTargetObj;
var openTip = oOpenTip || "";
var shutTip = oShutTip || "";
if(targetObj.style.display!="none"){
   if(shutAble) return;
   targetObj.style.display="none";
   if(openTip  &&  shutTip){
    sourceObj.innerHTML = shutTip; 
   }
} else {
   targetObj.style.display="";//block设置成，就会造成错乱，看具体情况
   if(openTip  &&  shutTip){
    sourceObj.innerHTML = openTip; 
   }
}
}

</script>
</head>
<body style="overflow-x:hidden;">
<div class="mainbox">
  <div id="nav" class="mainnav_title">
    <ul>
      <a href="manage_pro.php">产品管理</a>| <a href="add_pro.php">添加产品</a>
    </ul>
    <div class="clear"></div>
  </div>
  <script>
	var onurl ='add_pro.php';
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
          </td>
      </tr>
      <tr>
        <td width="10%" >价格</td>
        <td width="90%"><input type="text" class="xy_input90" name="a_xy_price"  id="a_xy_price"  size="55" />【填写数字,默认单位￥】 &nbsp;&nbsp;<a href="#" onclick="openShutManager(this,'zk_box',false,'【点击关闭】','【更多产品参数】')" style="color:#F00; font-size:13px; font-weight:600;">【更多产品参数】</a></td>
      </tr>
      <tr id="zk_box" style="display:none; background-color:#DFDFDF;">
        <td width="10%" >&nbsp;</td>
        <td width="90%"><input type="text" class="xy_input90" name="a_xy_model"  id="a_xy_model"  size="55" /> 型号 &nbsp;&nbsp;<input type="text" class="xy_input90" name="a_xy_spec"  id="a_xy_spec"  size="55" /> 规格</td>
      </tr>
      <tr>
        <td width="10%" >关键词</td>
        <td width="90%"><input type="text" class="input-text" name="keywords"  id="keywords"  size="55" /></td>
      </tr>
      <tr>
        <td width="10%" >SEO简介</td>
        <td width="90%"><textarea  name="description"  style="width: 446px;resize: none;" id="description"   /></textarea></td>
      </tr>
      <tr>
        <td width="10%" >图片</td>
        <td width="90%" id="box_pics"><input type="text" name="link_img" id="link_img" class="input-text" size="50"/>
        <input type="buttons" id="s_img" class="xy_smt" value="选择图片" /></td>
				<input type="file" id="file" style="display: none;" />
        <script>
        		$("#file").change(function() {
							$('#link_img').val($("#file").val())
						}) 
						$("#s_img").click(function() {
							$("#file").click();
						});
        </script>
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
		'title' => $_POST['title'],
		'xy_price' => $_POST['a_xy_price'],
		'xy_model' => $_POST['a_xy_model'],
		'xy_spec' => $_POST['a_xy_spec'],
		'keywords' => $_POST['keywords'],
		'description' => $_POST['description'],
		'thumb' => $_POST['link_img'],
		'content' => $_POST['content'],
		'a_author' => $_POST['a_author'],
		'a_from' => $_POST['a_from'],
		"is_hot"=>$_POST['is_hot'],
		'c_date' => strtotime($_POST['c_date']),
		);
		$db->insert("xy_pro", $siteinfo);
		
  @$c_date = strtotime($_POST['c_date']);
	@$title = $_POST['title'];
	@$content = $_POST['content'];
	@$thumb=$_POST['$thumb'];
	$xy_model=$_POST['$xy_model'];
	$xy_spec=$_POST['xy_spec'];
	$sqlId = "select id from xy_pro where c_date='$c_date'";
	$result=$db->query($xy_sql); 
	while ($row = mysqli_fetch_array($result))
	$Id = $row['id'];

	//生成静态页面
	$Title = $title;
	$C_date = date(("Y-m-d"), $c_date);
	$Content = $content;
	$Thumb=$thumb;
	$Xy_model=$xy_model;
	$Xy_spec=$xy_spec;
	$id= $Id;
	//定义变量
	$temp_file = "../../html/product/1.html";
	//临时文件，也可以是模板文件
	$dest_file = "../../html/product/".$C_date.".html";
	//生成的目标页面
	$fp = fopen($temp_file, "r");
	//只读打开模板
	$str = fread($fp, filesize($temp_file));
	//读取模板中内容
	$str = str_replace("{title}", $Title, $str);
	$str = str_replace("{date}", $C_date, $str);
	$str = str_replace("{content}", $Content, $str);
	$str = str_replace("{id}", $id, $str);
	$str = str_replace("{xy_model}", $Xy_model, $str);
	$str = str_replace("{xy_spec}", $Xy_spec, $str);
	$str = str_replace("{thumb}", $Thumb, $str);
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
	echo " location='manage_pro.php';";
	echo "</script>";
}
?>