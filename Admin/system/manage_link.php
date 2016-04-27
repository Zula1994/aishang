<?php
require 'include/session.php';
require 'include/globle.inc.php';
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="Js/jquery.min.js"></script>
<link href="style/style.css" type="text/css" rel="stylesheet" />
<title>链接管理</title>
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
<div id="loader" >页面加载中...</div>
<div id="result" class="result none"></div>
<div class="mainbox">
  <div id="nav" class="mainnav_title">
    <ul>
      <a href="manage_link.php">链接管理</a>| <a href="add_link.php">添加链接</a>
    </ul>
  </div>
  <script>
	var onurl ='manage_link.php';
	jQuery(document).ready(function(){
		$('#nav ul a ').each(function(i){
		if($('#nav ul a').length>1){
			var thisurl= $(this).attr('href');
			thisurl = thisurl.replace('&menuid=17','');
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
    <DIV id='xy_con'>
      <UL id='tags'>
        <LI class='selectTag'><A onClick="selectTag('tagContent0',this)" href="javascript:void(0)">文字链接</A> </LI>
        <LI><A onClick="selectTag('tagContent1',this)" href="javascript:void(0)">图片链接</A></LI>
      </UL>
      <DIV id=tagContent>
        <DIV class='tagContent selectTag' id='tagContent0'>
          <form name="addform" action="" method="post">
            <div class="table-list">
              <table width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th width="40">Link_id</th>
                    <th>链接名称</th>
                    <th width="30">排序</th>
                    <th width="240">链接</th>
                    <th width="220">管理操作</th>
                  </tr>
                </thead>
                <tbody>
			      <?php echo get_list(0);?>
                </tbody>
              </table>
            </div>
          </form>
        </DIV>
        <DIV class="tagContent" id='tagContent1'>
          <form>
          <div class="table-list">
              <table width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th width="40">Link_id</th>
                    <th>链接名称</th>
                    <th width="30">排序</th>
                    <th width="160">图片</th>
                    <th width="240">链接</th>
                    <th width="220">管理操作</th>
                  </tr>
                </thead>
                <tbody>
			      <?php echo get_list(1);?>
                </tbody>
              </table>
            </div>
          </form>  
        </DIV>
      </DIV>
    </DIV>
 
</div>
</body>
</html>
<SCRIPT type=text/javascript>
function selectTag(showContent,selfObj){
	// 操作标签
	var tag = document.getElementById("tags").getElementsByTagName("li");
	var taglength = tag.length;
	for(i=0; i<taglength; i++){
		tag[i].className = "";
	}
	selfObj.parentNode.className = "selectTag";
	// 操作内容
	for(i=0; j=document.getElementById("tagContent"+i); i++){
		j.style.display = "none";
	}
	document.getElementById(showContent).style.display = "block";
	
	
}
</SCRIPT>

<?php
//返回字符串（正在使用）
function get_list($cid=0) { 
    global $db;
    $sql = "select * from xy_links WHERE c_id=$cid order by c_order asc";  
    $result =$db->query($sql);//查询pid的子类的分类 
    if($result && mysql_affected_rows()){//如果有子类 
        while ($row = mysql_fetch_array($result)) { //循环记录集
		    $str .="<tr>";
			$str .="<td align='center'>".$row['id']."</td>";
			$str .="<td align='center'>".$row['title']."</td>";
			$str .="<td align='center'><input name='c_order' size='4' class='input-text-t' value='".$row['c_order']."' /></td>";
			if($cid==1){
				$str .="<td align='center'><img src='".$row['link_img']."' width='130' height='42' /></td>";
				}else{
					$str .="";
				}
			$str .="<td align='center'><input name='link_url' size='50' class='input-text-t' value='".$row['link_url']."' /></td>";
			$str .="<td align='center'><a href='edit_link.php?id=".$row['id']."'>修改</a> | <a href=\"javascript:if(ask('警告：删除后将不可恢复，可能造成意想不到后果？')) location.href='del_link.php?id=".$row['id']."';\" onClick=\"delcfm();\">删除</a></td>";
			$str .="</tr>";  
        } 
    } 
    return $str; 
} 
require 'include/encode.php';
//生成JSON文件
$sqlSel = "SELECT * FROM `xy_links`  ";
$Result =$db->query($sqlSel);
$list=array();
$i=0;
while($row=mysql_fetch_array($Result)){
	$list[$i]=$row;
	$i++;
} 
$json=JSON(array("list"=>$list));
file_put_contents("../json/link.txt", $json);
?>