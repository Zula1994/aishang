<?php
require 'include/session.php';
require 'include/globle.inc.php';
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文章信息删除</title>
<script type="text/javascript" src="Js/jquery.min.js"></script>


<link href="style/style.css" type="text/css" rel="stylesheet" />
</head>
<body style="overflow-x:hidden;">
<?php
$d_id = isset ($_GET['id']) ? intval($_GET['id']) : '0' ;
if($d_id!=0){
	$sql="DELETE FROM xy_article where id=$d_id";
	$db->query($sql);
	 ok_info('manage_article.php',"恭喜你，文章删除成功！");
	 exit;
}else{
	 ok_info('manage_article.php',"抱歉，文章删除失败！");
	 exit;
}
$db->close();
?>
</body>
</html>
