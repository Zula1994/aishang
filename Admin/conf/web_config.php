<?php
$sql="select * from xy_config where id=1";
$rsrs=$db->get_one($sql,MYSQL_ASSOC);
$wzname=$rsrs['wzname'];
$wztitle=$rsrs['wztitle'];
$wzkeys=$rsrs['wzkeys'];
$wzdec=$rsrs['wzdec'];
$wzurl=$rsrs['wzurl'];
$wzlogo=$rsrs['wzlogo'];
$wxlogo=$rsrs['wxlogo'];
$wzicp=$rsrs['wzicp'];
$wztel=$rsrs['wztel'];
$wzemail=$rsrs['wzemail'];
$wzaddress=$rsrs['wzaddress'];

$xycms_about_id=34;//关于我们栏目ID
$news_fl_id=18;//首页新闻一级分类ID
$pro_fl_id=17;//首页产品一级分类ID
$case_fl_id=21;//首页案例一级分类ID
?>