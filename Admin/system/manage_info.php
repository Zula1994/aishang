<?php
require 'include/session.php';
require 'include/globle.inc.php';
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="Js/jquery.min.js"></script>
<link href="style/style.css" type="text/css" rel="stylesheet" />
<title>管理员管理</title>
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
<body>
<div class="mainbox">
  <div id="nav" class="mainnav_title">
    <ul>
      <a href="manage_info.php">管理员管理</a>| <a href="add_info.php">添加管理员</a>
    </ul>
    <div class="clear"></div>
  </div>
  <script>
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
  <form name="addform" action="" method="post">
    <div class="table-list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="40">M_id</th>
            <th>管理用户名</th>
            <th width="220">管理操作</th>
          </tr>
        </thead>
        <tbody>
          <?php echo get_list();?>
        </tbody>
      </table>
    </div>
  </form>
</div>
</body>
</html>
<?php
//返回字符串（正在使用）
function get_list() { 
    global $db;
    $sql = "select * from `xy_admin_user` order by id asc";  
    $result =$db->query($sql);//查询pid的子类的分类 
    if($result && mysql_affected_rows()){//如果有子类 
        while ($row = mysql_fetch_array($result)) { //循环记录集
		    $str .="<tr>";
			$str .="<td align='center'>".$row['id']."</td>";
			$str .="<td align='center'>".$row['xyname']."</td>";
			$str .="<td align='center'><a href='edit_info.php?id=".$row['id']."'>修改</a> | <a href=\"javascript:if(ask('警告：删除后将不可恢复，可能造成意想不到后果？')) location.href='del_info.php?id=".$row['id']."';\" onClick=\"delcfm();\">删除</a></td>";
			$str .="</tr>";  
        } 
    } 
    return $str; 
} 
?>