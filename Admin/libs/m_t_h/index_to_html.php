<?php
function index_to_html($mode){
  global $db,$wztitle,$wzurl,$wzkeys,$wzdec,$wzname,$wzlogo,$wxlogo,$wztel,$wzemail,$wzaddress,$wzicp,$xycms_about_id,$news_fl_id,$pro_fl_id,$case_fl_id;
  $model_file='../templates/index_model.html';
  $xycms_nav=get_nav();
  $fp_o=fopen($model_file,"r");
  $str_o=fread($fp_o,filesize($model_file));
  fclose($fp_o);
  $xycms_top=read_model('../templates/head.html');
  $xycms_foot=read_model('../templates/foot.html');
  $xycms_jdt="";
  $xycms_focus="";
  $xycms_case_list="";
  $xycms_linkimg="";
  $xycms_linktxt="";
  $sql_f="select link_url,link_img from xy_jdt order by c_order asc";
  $jdt_data=$db->get_all($sql_f,MYSQL_ASSOC);
  if($jdt_data){
	  foreach($jdt_data as $data=>$val){
		$xycms_jdt.="<li style='background:url(".$wzurl.$val['link_img'].") center 0px no-repeat; background-size:100% 100%;'><a target='_blank' href='".$val['link_url']."'></a></li>";
	  }
  }
  $news_fl="";
  $news_box="";
  $sql_newsfl="select cid,cname,folderpath from `xy_category` where pid='$news_fl_id' and c_type=1 order by c_order asc";
  $news_fl_data=$db->get_all($sql_newsfl,MYSQL_ASSOC);
  $news_fl_num=count($news_fl_data);
  if($news_fl_data){
	  for($i=0;$i<$news_fl_num;$i++){
		if($i==0){
		  $news_fl.="<li id='one1' onmouseover=\"setTab('one',1,".$news_fl_num.")\" class='hover'><a href='".$wzurl.$news_fl_data[0]['folderpath']."'>".$news_fl_data[0]['cname']."</a></li>";
		  $news_box.="<div id='con_one_1'>";
		  $sql_h="select * from `xy_article` where catid=".$news_fl_data[0]['cid']." and is_hot=1 and typeid=1 order by c_date desc LIMIT 1";
		  $news_top=$db->get_one($sql_h,MYSQL_ASSOC);
		  if($news_top){
			  $ww_url=trim($news_top['a_url']);
			  $link_url=$wzurl."/html/info/".date('Ymd',$news_top['c_date'])."/".$news_top['f_path'].".html";
			  if(!empty($ww_url)){
				 $link_url=$ww_url;
			  }
			  $news_box.="<h2><span>".date('Y-m-d',$news_top['c_date'])."</span><a href='".$link_url."' target='_blank' style='color:".$news_top['a_color'].";'>".str_cut($news_top['title'],80,'...','utf-8')."</a></h2>";
			  $news_box.="<p>".str_cut(strip_tags($news_top['content']),190,'...','utf-8')."</p>";
		  }
		  $news_box.="<ul>";
		  $sql_l="select * from `xy_article` where catid=".$news_fl_data[0]['cid']." and is_hot=0 and typeid=1 order by c_date desc LIMIT 4";
		  $news_list=$db->get_all($sql_l,MYSQL_ASSOC);
		  foreach($news_list as $d=>$v){
			$news_url=trim($v['a_url']);
			$news_link=$wzurl."/html/info/".date('Ymd',$v['c_date'])."/".$v['f_path'].".html";
			if(!empty($news_url)){
			  $news_link=$news_url;	
			}
			$news_box.="<li><span>".date('Y-m-d',$v['c_date'])."</span><a href='".$news_link."' target='_blank' title='".$v['title']."' style='color:".$v['a_color'].";'>".$v['title']."</a></li>"; 
		  }
		  $news_box.="</ul></div>";
		  
		}else{
		  $news_fl.="<li id='one".($i+1)."' onmouseover=\"setTab('one',".($i+1).",".$news_fl_num.")\"><a href='".$wzurl.$news_fl_data[$i]['folderpath']."'>".$news_fl_data[$i]['cname']."</a></li>";
		  $news_box.="<div id='con_one_".($i+1)."' style='display:none'>";
		  $sql_h="select * from `xy_article` where catid=".$news_fl_data[$i]['cid']." and is_hot=1 and typeid=1 order by c_date desc LIMIT 1";
		  $news_top=$db->get_one($sql_h,MYSQL_ASSOC);
		  if($news_top){
			  $ww_url=trim($news_top['a_url']);
			  $link_url=$wzurl."/html/info/".date('Ymd',$news_top['c_date'])."/".$news_top['f_path'].".html";
			  if(!empty($ww_url)){
				 $link_url=$ww_url;
			  }
			  $news_box.="<h2><span>".date('Y-m-d',$news_top['c_date'])."</span><a href='".$link_url."' target='_blank' style='color:".$news_top['a_color'].";'>".str_cut($news_top['title'],80,'...','utf-8')."</a></h2>";
			  $news_box.="<p>".str_cut(strip_tags($news_top['content']),190,'...','utf-8')."</p>";
		  }
		  $news_box.="<ul>";
		  $sql_l="select * from `xy_article` where catid=".$news_fl_data[$i]['cid']." and is_hot=0 and typeid=1 order by c_date desc LIMIT 4";
		  $news_list=$db->get_all($sql_l,MYSQL_ASSOC);
		  foreach($news_list as $d=>$v){
			$news_url=trim($v['a_url']);
			$news_link=$wzurl."/html/info/".date('Ymd',$v['c_date'])."/".$v['f_path'].".html";
			if(!empty($news_url)){
			  $news_link=$news_url;	
			}  
			$news_box.="<li><span>".date('Y-m-d',$v['c_date'])."</span><a href='".$news_link."' target='_blank' title='".$v['title']."' style='color:".$v['a_color'].";'>".$v['title']."</a></li>"; 
		  }
		  $news_box.="</ul></div>";
		}
	  }
  }
  
  $sql_profl="select cid,cname,folderpath from `xy_category` where pid='$pro_fl_id' and c_type=2 order by c_order asc";
  $pro_fl_data=$db->get_all($sql_profl,MYSQL_ASSOC);
  $pro_fl_num=count($pro_fl_data);
  if($pro_fl_data){
	  for($i=0;$i<$pro_fl_num;$i++){
		if($i==0){
		  $pro_fl.="<li class='hover' id='pt1' onmouseover=\"showp(1);\">".$pro_fl_data[0]['cname']."</li>";
		  $pro_box.="<div class='pro_src' id='pinfo1'>";
		  $sql_l="select * from `xy_article` where catid=".$pro_fl_data[0]['cid']." and typeid=2 order by c_date desc LIMIT 5";
		  $pro_list=$db->get_all($sql_l,MYSQL_ASSOC);
		  foreach($pro_list as $d=>$v){
			$pro_box.="<div class='p_box'>";
			$pro_box.="<div class='p_pic'><a href='".$wzurl."/html/product/".date('Ymd',$v['c_date'])."/".$v['f_path'].".html' title='".$v['title']."'><img src='".$wzurl.$v['thumb']."' alt='".$v['title']."' /></a></div>";
			$pro_box.="<div class='p_txt'><a href='".$wzurl."/html/product/".date('Ymd',$v['c_date'])."/".$v['f_path'].".html' title='".$v['title']."'>".$v['title']."</a></div>";
			$pro_box.="</div>";
		  }
		  $pro_box.="</div>";
		  
		}else{
		  $pro_fl.="<li id='pt".($i+1)."' onmouseover=\"showp(".($i+1).");\">".$pro_fl_data[$i]['cname']."</li>";
		  $pro_box.="<div class='pro_src' style='display:none' id=\"pinfo".($i+1)."\">";
		  $sql_l="select * from `xy_article` where catid=".$pro_fl_data[$i]['cid']." and typeid=2 order by c_date desc LIMIT 5";
		  $pro_list=$db->get_all($sql_l,MYSQL_ASSOC);
		  foreach($pro_list as $d=>$v){
			$pro_box.="<div class='p_box'>";
			$pro_box.="<div class='p_pic'><a href='".$wzurl."/html/product/".date('Ymd',$v['c_date'])."/".$v['f_path'].".html' title='".$v['title']."'><img src='".$wzurl.$v['thumb']."' alt='".$v['title']."' /></a></div>";
			$pro_box.="<div class='p_txt'><a href='".$wzurl."/html/product/".date('Ymd',$v['c_date'])."/".$v['f_path'].".html' title='".$v['title']."'>".$v['title']."</a></div>";
			$pro_box.="</div>";
		  }
		  $pro_box.="</div><div class='cl'></div>";
		}
	  }
  }
  $Ids=getChildIds($news_fl_id,1);
  $sql_focus="select title,f_path,thumb,c_date from xy_article where catid in($Ids) and typeid=1 and length(thumb)>10 order by c_date desc LIMIT 5";
  $row_focus=$db->get_all($sql_focus,MYSQL_ASSOC);
  if($row_focus){
	foreach($row_focus as $d=>$v){
		$xycms_focus.="<li><a href='".$wzurl."/html/info/".date('Ymd',$v['c_date'])."/".$v['f_path'].".html' target='_blank'><img src='".$wzurl.$v['thumb']."' border='0' alt='".$v['title']."' ></a></li>";
	}
  }
  
  $sql_us="select content from `xy_category` where cid=".$xycms_about_id." and c_type=8 LIMIT 1";
  $row_us=$db->get_one($sql_us,MYSQL_ASSOC);
  $xycms_us=str_cut(strip_tags($row_us['content']),483,'...','utf-8');
  
  $cids=getChildIds($case_fl_id,1);
  $sql_c="select * from xy_article where catid in($cids) and typeid=3 order by c_date desc";
  $case_data=$db->get_all($sql_c,MYSQL_ASSOC);
  if($case_data){
	  foreach($case_data as $data=>$val){
		$xycms_case_list.="<li>";
		$xycms_case_list.="<h5><a href='".$wzurl."/html/case/".date('Ymd',$val['c_date'])."/".$val['f_path'].".html' target='_blank' title='".$val['title']."'><img src='".$wzurl.$val['thumb']."' alt='".$val['title']."' />".str_cut($val['title'],30,'...','utf-8')."</a></h5>";
		$xycms_case_list.="<dl>".str_cut(strip_tags($val['content']),150,'...','utf-8')."</dl>";
		$xycms_case_list.="</li>";
	  }
  }
  
  $sql_li="select title,link_url,link_img from `xy_links` where c_id=1 order by c_order asc";
  $rowimg=$db->get_all($sql_li,MYSQL_ASSOC);
  $imgnum=count($rowimg);
  if($rowimg){
	 for($k=0;$k<$imgnum;$k++){
		if(($k+1)%11==0){
		  $xycms_linkimg.="<li class='f_no'><a href='".$rowimg[10]['link_url']."' target='_blank' title='".$rowimg[10]['title']."'><img src='".$wzurl.$rowimg[10]['link_img']."' alt='".$rowimg[10]['title']."' /></a></li>";	
		}else{
		  $xycms_linkimg.="<li><a href='".$rowimg[$k]['link_url']."' target='_blank' title='".$rowimg[$k]['title']."'><img src='".$wzurl.$rowimg[$k]['link_img']."' alt='".$rowimg[$k]['title']."' /></a></li>";
		}
	 }
  }
  
  $sql_lt="select title,link_url from `xy_links` where c_id=0 order by c_order asc";
  $rowtxt=$db->get_all($sql_lt,MYSQL_ASSOC);
  $txtnum=count($rowtxt);
  if($rowtxt){
	 for($k=0;$k<$txtnum;$k++){
		$xycms_linktxt.="<a href='".$rowtxt[$k]['link_url']."' target='_blank' title='".$rowtxt[$k]['title']."'>".$rowtxt[$k]['title']."</a>";
	 }
  }
  
  $str_o=str_replace("{xycms_top}",$xycms_top,$str_o);
  $str_o=str_replace("{xycms_foot}",$xycms_foot,$str_o);
  $str_o=str_replace("{xycms_jdt}",$xycms_jdt,$str_o);
  $str_o=str_replace("{xycms_news_fl}",$news_fl,$str_o);
  $str_o=str_replace("{xycms_news_list}",$news_box,$str_o);
  $str_o=str_replace("{xycms_pro_fl}",$pro_fl,$str_o);
  $str_o=str_replace("{xycms_pro_list}",$pro_box,$str_o);
  $str_o=str_replace("{xycms_case_list}",$xycms_case_list,$str_o);
  $str_o=str_replace("{xycms_focus}",$xycms_focus,$str_o);
  $str_o=str_replace("{xycms_us}",$xycms_us,$str_o);
  $str_o=str_replace("{sitemap}",$site,$str_o);
  $str_o=str_replace("{wzkeys}",$wzkeys,$str_o);
  $str_o=str_replace("{wzdec}",$wzdec,$str_o);
  $str_o=str_replace("{xycms_nav}",$xycms_nav,$str_o);
  $str_o=str_replace("{wzname}",$wzname,$str_o);
  $str_o=str_replace("{wzurl}",$wzurl,$str_o);
  $str_o=str_replace("{wzlogo}",$wzlogo,$str_o);
  $str_o=str_replace("{wxlogo}",$wxlogo,$str_o);
  $str_o=str_replace("{wztel}",$wztel,$str_o);
  $str_o=str_replace("{wzicp}",$wzicp,$str_o);
  $str_o=str_replace("{xycms_linkimg}",$xycms_linkimg,$str_o);
  $str_o=str_replace("{xycms_linktxt}",$xycms_linktxt,$str_o);
  $str_o=str_replace("{wzemail}",$wzemail,$str_o);
  $str_o=str_replace("{wzaddress}",$wzaddress,$str_o);
  $folderpath="..";
  if(!file_exists($folderpath)){
	 dir_create($folderpath,0777);
  }
  $filename="index.html";
  $filepath=$folderpath."/".$filename;
  if(is_file ($filepath)){
	 @unlink ($filepath);//若文件已存在，则删除
  }
  
  $handle=fopen($filepath,"w"); //打开文件指针，创建文件
  if($mode==0){
    fwrite($handle,$str_o);
	fclose($handle);
  }else{
	  if (!is_writable($filepath)){
		  echo "<font color='red'>文件：".$filepath."不可写，请检查其属性后重试！</font><br>";
	  }
	  if (!fwrite ($handle,$str_o)){  //将信息写入文件
	    echo "<font color='red'>生成文件".$filepath."失败 ".date('Y-m-d H:i:s')."</font><br>";
	  }else{
		  echo "<font color='green'>生成文件".$filepath."成功&nbsp;&nbsp;&nbsp;[".date('Y-m-d H:i:s')."]</font><br>";
		  fclose ($handle); //关闭指针
	  }
  }
}
?>