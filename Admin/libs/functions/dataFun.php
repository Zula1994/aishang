<?php
//根据分类获取所有上级分类
function getParentcategory($sid,&$category = array()){
  global $db;
  $sql="select * from xy_category where cid=".$sid." LIMIT 1";
  $result = $db->query($sql);
  $row =$db->fetchRow($result);
  if($row){
	  $category[] = $row;
	  getParentcategory($row['pid'],$category);
  }
  krsort($category); //逆序,达到从父类到子类的效果
  return $category;
}
//根据分类获取所有上级分类[显示]
function displayCategory($sid){
  global $wzurl;
  $result = getParentcategory($sid);
  $str = "";
  foreach($result as $item){
	$str .= '<a href="'.$wzurl.''.$item['folderpath'].'">'.$item['cname'].'</a>-';
  }
  return substr($str,0,strlen($str)-1);
}

//根据父级ID,获取所有子类 1.包含父ID;0.不包含父ID
function getChildIds($sid,$mod=0){
	global $db;
	$sql="select * from xy_category where pid=".$sid." order by cid";
	$row = $db->get_all($sql,MYSQL_ASSOC);
	if($row){
		foreach($row as $key=>$val){
			$Ids.=','.$val['cid'];
		}
	}
	if($mod==0){
		return ltrim($Ids,',');
	}else
	{
		return $sid.$Ids;
	}
}

//根据父级ID,获取所有子类名称列表
function getChildName($sid){
	global $db,$wzurl;
	$ss="select cid,cname,folderpath,pid from xy_category where cid=".$sid." LIMIT 1";
	$rs=$db->get_one($ss);
	$cpid=$rs['pid'];
	$cname=$rs['cname'];
	$f_path=$rs['folderpath'];
	if($cpid==0){
		$sql="select cid,cname,folderpath from xy_category where pid=".$sid." order by c_order asc";
		$row = $db->get_all($sql,MYSQL_ASSOC);
		if($row){
			foreach($row as $data=>$val){
				$id=$val['cid'];
				if($sid==$id){
					$left_list.="<li class='hover'><a href='".$wzurl."".$val['folderpath']."' target='_self' title='".$val['cname']."'>".$val['cname']."</a></li>";
				}else{
					$left_list.="<li><a href='".$wzurl."".$val['folderpath']."' target='_self' title='".$val['cname']."'>".$val['cname']."</a></li>";
				}
			}
		}else{
			$left_list.="<li class='hover'><a href='".$wzurl."".$f_path."' target='_self' title='".$cname."'>".$cname."</a></li>";
		}
	}else{
		$sql="select cid,cname,folderpath from xy_category where pid=".$cpid." order by c_order asc";
		$row = $db->get_all($sql,MYSQL_ASSOC);
		if($row){
			foreach($row as $data=>$val){
				$id=$val['cid'];
				if($sid==$id){
					$left_list.="<li class='hover'><a href='".$wzurl."".$val['folderpath']."' target='_self' title='".$val['cname']."'>".$val['cname']."</a></li>";
				}else{
					$left_list.="<li><a href='".$wzurl."".$val['folderpath']."' target='_self' title='".$val['cname']."'>".$val['cname']."</a></li>";
				}
			}
		}
	}
	
	return $left_list;
}

//导航菜单
function get_nav(){
	global $db,$wzurl;
	$sql="select * from xy_menu where pid=0 order by c_order asc";
	$row = $db->get_all($sql,MYSQL_ASSOC);
	$nav_list="";
	if($row){
		foreach($row as $data=>$val){
			$id=$val['cid'];
			$nav_list.="<li><a href='".$wzurl."".$val['url']."' target='".$val['open_method']."' title='".$val['cname']."'>".$val['cname']."</a>";
			$ss="select * from xy_menu where pid=".$id." order by c_order asc";
			$rows = $db->get_all($ss,MYSQL_ASSOC);
			if($rows){
				$nav_list.="<div class='pa'><ul>";
				foreach($rows as $k=>$v){
					$nav_list.="<li><a href='".$wzurl."".$v['url']."' target='".$v['open_method']."' title='".$v['cname']."'>".$v['cname']."</a></li>";
				}
				$nav_list.="</ul></div></li>";
			}else{
				$nav_list.="</li>";
			}
		}
	}else{
		$nav_list.="<li><a href='".$wzurl."/index.html' title='网站首页'>网站首页</a></li>";
	}
	return $nav_list;
}


//上一篇
function PreText($id,$html_path,$type){
  global $db;
  $sql_p="select title,c_date,f_path from xy_article where id>$id and typeid=$type order by id asc limit 0,1";
  $result =$db->query($sql_p);
  if(mysql_num_rows($result)){
	  $rs =$db->get_one($sql_p);
	  $pre_title="<a href='".$html_path."/".date('Ymd',$rs['c_date'])."/".$rs['f_path'].".html' target='_self'>".$rs['title']."<a>";
  }else{
	  $pre_title='没有了';
  }
  return $pre_title;
}

//下一篇
function NextText($id,$html_path,$type){
  global $db;
  $sql_n="select title,c_date,f_path from xy_article where id<$id and typeid=$type order by id desc limit 0,1";
  $result =$db->query($sql_n);
  if(mysql_num_rows($result)){
	  $rs =$db->get_one($sql_n);
	  $next_title="<a href='".$html_path."/".date('Ymd',$rs['c_date'])."/".$rs['f_path'].".html' target='_self'>".$rs['title']."<a>";
  }else{
	  $next_title='没有了';
  }
  return $next_title;
}


//上一个 图集
function PreImg($id,$html_path,$type){
  global $db;
  $sql_p="select title,c_date,f_path,thumb from xy_article where id>$id and typeid=$type order by id asc limit 0,1";
  $result =$db->query($sql_p);
  if(mysql_num_rows($result)){
	  $rs =$db->get_one($sql_p);
	  if(!empty($res['thumb'])){
		  $p_imgs=explode(',',$rs['thumb']);
		  if($p_imgs==1){
			  $p_img=$rs['thumb'];
		  }else{
			  $p_img=$p_imgs[0];
		  }
	  }else{
		  $p_img="/statics/images/no.jpg";
	  }
	  $pre_img="<div class='picshowlist_left'>";
	  $pre_img.="<div class='picleftimg'> <a href='".$html_path."/".date('Ymd',$rs['c_date'])."/".$rs['f_path'].".html' target='_self'><img src='".$p_img."' alt='".$rs['title']."' /></a> </div>";
	  $pre_img.="<div class='piclefttxt'> <a href='".$html_path."/".date('Ymd',$rs['c_date'])."/".$rs['f_path'].".html' target='_self'>".$rs['title']."<a></div></div>";
  }else{
	  $pre_img="<div class='picshowlist_left'>";
	  $pre_img.="<div class='picleftimg'> <a href='#' title='没有了' target='_self'><img src='/statics/images/no.jpg' /></a> </div>";
	  $pre_img.="<div class='piclefttxt'> <a href='#' title='没有图集了' target='_self'>没有图集了</a></div></div>";
  }
  return $pre_img;
}

//下一个 图集
function NextImg($id,$html_path,$type){
  global $db;
  $sql_n="select title,c_date,f_path,thumb from xy_article where id<$id and typeid=$type order by id desc limit 0,1";
  $result =$db->query($sql_n);
  if(mysql_num_rows($result)){
	  $rs =$db->get_one($sql_n);
	  if(!empty($res['thumb'])){
		  $p_imgs=explode(',',$rs['thumb']);
		  if($p_imgs==1){
			  $p_img=$rs['thumb'];
		  }else{
			  $p_img=$p_imgs[0];
		  }
	  }else{
		  $p_img="/statics/images/no.jpg";
	  }
	  $next_img="<div class='picshowlist_right'>";
	  $next_img.="<div class='picleftimg'> <a href='".$html_path."/".date('Ymd',$rs['c_date'])."/".$rs['f_path'].".html' target='_self'><img src='".$p_img."' alt='".$rs['title']."' /></a> </div>";
	  $next_img.="<div class='piclefttxt'> <a href='".$html_path."/".date('Ymd',$rs['c_date'])."/".$rs['f_path'].".html' target='_self'>".$rs['title']."<a></div></div>";
  }else{
	  $next_img="<div class='picshowlist_right'>";
	  $next_img.="<div class='picleftimg'> <a href='#' title='没有了' target='_self'><img src='/statics/images/no.jpg' /></a> </div>";
	  $next_img.="<div class='piclefttxt'> <a href='#' title='没有图集了' target='_self'>没有图集了</a></div></div>";
  }
  return $next_img;
}


//上一个
function PreImgLi($id,$html_path,$type){
  global $db;
  $sql_p="select title,c_date,f_path,thumb from xy_article where id>$id and typeid=$type order by id asc limit 0,1";
  $result =$db->query($sql_p);
  if(mysql_num_rows($result)){
	  $rs =$db->get_one($sql_p);
	  if(!empty($res['thumb'])){
		  $p_imgs=explode(',',$rs['thumb']);
		  if($p_imgs==1){
			  $p_img=$rs['thumb'];
		  }else{
			  $p_img=$p_imgs[0];
		  }
	  }else{
		  $p_img="/statics/images/no.jpg";
	  }
	  $pre_li_img="<li><a href='".$html_path."/".date('Ymd',$rs['c_date'])."/".$rs['f_path'].".html' target='_self'><img src='".p_img."' alt='".$rs['title']."' /></a>";
	  $pre_li_img.="<div class='imgdivtext'>";
	  $pre_li_img.="<a href='".$html_path."/".date('Ymd',$rs['c_date'])."/".$rs['f_path'].".html' title='".$rs['title']."' target='_self'>上一图集</a></div></li>";
  }else{
	  $pre_li_img="<li><a href='#' title='没有了' target='_self'><img src='/statics/images/no.jpg' alt='没有了' /></a>";
	  $pre_li_img.="<div class='imgdivtext'><a href='#' title='上一图集' target='_self'>上一图集</a></div></li>";
  }
  return $pre_li_img;
}

//下一个
function NextImgLi($id,$html_path,$type){
  global $db;
  $sql_n="select title,c_date,f_path,thumb from xy_article where id<$id and typeid=$type order by id desc limit 0,1";
  $result =$db->query($sql_n);
  if(mysql_num_rows($result)){
	  $rs =$db->get_one($sql_n);
	  if(!empty($res['thumb'])){
		  $p_imgs=explode(',',$rs['thumb']);
		  if($p_imgs==1){
			  $p_img=$rs['thumb'];
		  }else{
			  $p_img=$p_imgs[0];
		  }
	  }else{
		  $p_img="/statics/images/no.jpg";
	  }
	  $next_li_img="<li><a href='".$html_path."/".date('Ymd',$rs['c_date'])."/".$rs['f_path'].".html' target='_self'><img src='".p_img."' alt='".$rs['title']."' /></a>";
	  $next_li_img.="<div class='imgdivtext'>";
	  $next_li_img.="<a href='".$html_path."/".date('Ymd',$rs['c_date'])."/".$rs['f_path'].".html' title='".$rs['title']."' target='_self'>下一图集</a></div></li>";
  }else{
	  $next_li_img="<li><a href='#' title='没有了' target='_self'><img src='/statics/images/no.jpg' alt='没有了' /></a>";
	  $next_li_img.="<div class='imgdivtext'><a href='#' title='下一图集' target='_self'>下一图集</a></div></li>";
  }
  return $next_li_img;
}

//删除一篇文章生成的多个静态页面  
function DelHtml($id){
  global $db; 
  $sql = "SELECT typeid,c_date,f_path FROM xy_article WHERE id=$id LIMIT 1";
  $art = $db->get_one($sql,MYSQL_ASSOC);
  $t_id=$art['typeid'];
  $a_path=$art['f_path'];
  switch($t_id){
	case 1:
	$link_path='../html/info';
	break;
	case 2:
	$link_path='../html/product';
	break;
	case 3:
	$link_path='../html/case';
	break;
	case 4:
	$link_path='../html/job';
	break;
	case 5:
	$link_path='../html/download';
	break;
	case 6:
	$link_path='../html/video';
	break;
	case 7:
	$link_path='../html/photo';
	break;
  }
  if($art){
	$n=0;
	$html_dir =$link_path.'/'.date('Ymd',$art['c_date']).'/';
	$filename = $html_dir.$a_path.'.html';
	while(file_exists($filename)){
		@unlink($filename);
		$n++;
		$filename = $html_dir.$a_path.'_'.$n.'.html';
	}
	$sqll="DELETE FROM xy_article where id=$id";
	$db->query($sqll);
  }
  return true; 
} 


?>