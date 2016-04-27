<?php
require 'include/session.php';
require 'include/globle.inc.php';
require 'include/encode.php';
require XYCMS_ROOT . 'libs/classes/page.class.php'; 
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>信息管理</title>
<script type="text/javascript" src="Js/jquery.min.js"></script>
<link href="style/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="Js/check.js"></script>
<script language="javascript">
function ask(msg) {
	if( msg=='' ) {
		msg='警告：删除后将不可恢复，可能造成意想不到后果？';
	}
	if (confirm(msg)) {
		return true;
	} else {
		return false;
	}
}
</script>
</head>
<body style="overflow-x:hidden;">
<div class="mainbox">
  <div id="nav" class="mainnav_title">
    <ul>
      <a href="manage_article.php">文章管理</a>| <a href="add_article.php">添加文章</a>|
    </ul>
  </div>
  <script>
	var onurl ='manage_article.php';
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
  <table  class="search_table" width="100%">
    <tr>
      <td class="search"><form action="?act=search" method="post">
          <input id="keyword" type="text" size="14" class="input-text" name="keyword" />
          <input type="submit" value="查询"  class="button" />
          <input type="reset" value="重置" class="button"  />
        </form></td>
    </tr>
  </table>
  <form name="addform" id="addform" action="?del=checkbox" method="post">
   <?php 
   	global $db;
    $sql = "SELECT * FROM `xy_article` order by id asc";  
    $result =$db->query($sql);//查询pid的子类的分类 
   ?>
    <div class="table-list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="30"><input type="checkbox" name="allbox" id="check_box" onclick="CheckAll()"></th>
            <th width="40">ID</th>
            <th>标题</th>
            <th width="60">状态</th>
            <th width="40">点击</th>
            <th width="72">管理操作</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while($row=mysql_fetch_array($result)){
		  ?>
          <tr>
            <td  width="30" align="center"><input class="inputcheckbox " name="id[]" id="id[]" value="<?php echo $row['id'];?>" type="checkbox" ></td>
            <td align="center"><?php echo $row['id'];?></td>
            <td align="center"><?php echo $row['title']; ?></td>
            <td align="center"><?php if($row['a_zt']==1){?><font color="green">已审核</font><?php }else{?><font color="red">未审核</font><?php }?></td>
            <td align="center"><?php echo $row['hits'];?></td>
            <td align="center"><a href="edit_article.php?id=<?php echo $row['id'];?>">编辑</a> | <a href="javascript:if(ask('警告：删除后将不可恢复，可能造成意想不到后果？')) location.href='del_article.php?id=<?php echo $row['id'];?>';" onClick="delcfm();">删除</a></td>
          </tr>
          <?php
		  }
		  
		  ?>
        </tbody>
      </table>
    </div>
    <div class="btn">
      <select name="lx" id="lx" class="input_select">
        <option selected="selected" value="">操作类型</option>
        <option value="1">通过审核</option>
        <option value="2">取消审核</option>
        <option value="3">批量删除</option>
      </select>
      <input type="submit" class="button" name="dosubmit" value="提交操作" />
    </div>
  </form>
</div>
</body>
</html>
<?php
if($_GET['del']=='checkbox'){
	$ids=$_POST['id'];
	if(empty($ids)){
		echo"<script>alert('必须选择一个ID,才可以操作!');history.back(-1);</script>";  
        exit; 
	}else{
		$cz_lx=$_POST['lx'];
		if($cz_lx==''){
			echo"<script>alert('必须选择一个有效操作!');history.back(-1);</script>";  
			exit;
		}
		$id=implode(",",$ids);
		switch($cz_lx){
			case 1:
			$sql="UPDATE xy_article set a_zt=1 where id in ($id)";
			$db->query($sql);
			break;
			case 2:
			$sql="UPDATE xy_article set a_zt=0 where id in ($id)";
			$db->query($sql);
			break;
			case 3:
			$idsnum=count($ids);
			for($i=0;$i<$idsnum;$i++){
				DelHtml($ids[$i]);
			}
			break;
		} 
		echo "<script>alert('恭喜你，操作成功！');window.location.href='manage_article.php';</script>";  
	}
}
//生成JSON文件
$sqlSel = "SELECT * FROM `xy_article`  ";
$Result =$db->query($sqlSel);
$list=array();
$i=0;
while($row=mysql_fetch_array($Result)){
	$list[$i]=$row;
	$i++;
} 
$json=JSON(array("list"=>$list));
file_put_contents("../json/news.txt", $json);



$db->close();
?>

