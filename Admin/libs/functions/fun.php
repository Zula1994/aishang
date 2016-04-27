<?php
//用户名参数过滤
function xy_rep($str){ 
return str_replace(array('#', '@', '\'','or'),'', $str);
}

/**操作成功提示**/
function ok_info($url,$langinfo){
echo("<script type='text/javascript'> alert('$langinfo'); location.href='$url'; </script>");
exit;
}

//加密解密
function encryptDecrypt($key, $string, $decrypt){
    if($decrypt){
        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "12");
        return $decrypted;
    }else{
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
        return $encrypted;
    }
}

//生成随机字符串
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
//生成随机数字和字母
function numRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
//获取文件扩展名
function getExtension($filename){
  $myext = substr($filename, strrpos($filename, '.'));
  return str_replace('.','',$myext);
}

//获取文件大小并格式化
function formatSize($size) {
    $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
    if ($size == 0) { 
		return('n/a'); 
	} else {
      return (round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]); 
	}
}

//PHP替换标签字符
function stringParser($string,$replacer){
    $result = str_replace(array_keys($replacer), array_values($replacer),$string);
    return $result;
}

//列出目录下的文件
function listDirFiles($DirPath){
    if($dir = opendir($DirPath)){
         while(($file = readdir($dir))!== false){
                if(!is_dir($DirPath.$file))
                {
                    echo "filename: $file<br />";
                }
         }
    }
}

//获取当前页面的url
function curPageURL() {
	$pageURL = 'http';
	if (!empty($_SERVER['HTTPS'])) {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

//强制下载
function download($filename){
    if ((isset($filename))&&(file_exists($filename))){
       header("Content-length: ".filesize($filename));
       header('Content-Type: application/octet-stream');
       header('Content-Disposition: attachment; filename="' . $filename . '"');
       readfile("$filename");
    } else {
       echo "Looks like file does not exist!";
    }
}

/*
 Utf-8、gb2312都支持的汉字截取函数
 cut_str(字符串, 截取长度, 开始长度, 编码);
 编码默认为 utf-8
 开始长度默认为 0
*/
function str_cut($string, $length, $dot = '...',$charset) {
	$strlen = strlen($string);
	if($strlen <= $length) return $string;
	$string = str_replace(array(' ','&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array('∵',' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), $string);
	$strcut = '';
	if(strtolower($charset) == 'utf-8') {
		$length = intval($length-strlen($dot)-$length/3);
		$n = $tn = $noc = 0;
		while($n < strlen($string)) {
			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1; $n++; $noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif(224 <= $t && $t <= 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}
			if($noc >= $length) {
				break;
			}
		}
		if($noc > $length) {
			$n -= $tn;
		}
		$strcut = substr($string, 0, $n);
		$strcut = str_replace(array('∵', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), array(' ', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), $strcut);
	} else {
		$dotlen = strlen($dot);
		$maxi = $length - $dotlen - 1;
		$current_str = '';
		$search_arr = array('&',' ', '"', "'", '“', '”', '—', '<', '>', '·', '…','∵');
		$replace_arr = array('&amp;','&nbsp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;',' ');
		$search_flip = array_flip($search_arr);
		for ($i = 0; $i < $maxi; $i++) {
			$current_str = ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
			if (in_array($current_str, $search_arr)) {
				$key = $search_flip[$current_str];
				$current_str = str_replace($search_arr[$key], $replace_arr[$key], $current_str);
			}
			$strcut .= $current_str;
		}
	}
	return $strcut.$dot;
}


//获取用户真实IP
function getIp() {
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
		$ip = getenv("HTTP_CLIENT_IP");
	else
		if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		else
			if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
				$ip = getenv("REMOTE_ADDR");
			else
				if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
					$ip = $_SERVER['REMOTE_ADDR'];
				else
					$ip = "unknown";
	return ($ip);
}

//防止注入
function injCheck($sql_str) { 
	$check = preg_match('/select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/', $sql_str);
	if ($check) {
		echo '非法字符！！'.$sql_str;
		exit;
	} else {
		return $sql_str;
	}
}

//页面提示跳转
function message($msgTitle,$message,$jumpUrl){
	$str = '<!DOCTYPE HTML>';
	$str .= '<html>';
	$str .= '<head>';
	$str .= '<meta charset="utf-8">';
	$str .= '<title>页面提示</title>';
	$str .= '<style type="text/css">';
	$str .= '*{margin:0; padding:0}a{color:#369; text-decoration:none;}a:hover{text-decoration:underline}body{height:100%; font:12px/18px Tahoma, Arial,  sans-serif; color:#424242; background:#fff}.message{width:450px; height:120px; margin:16% auto; border:1px solid #99b1c4; background:#ecf7fb}.message h3{height:28px; line-height:28px; background:#2c91c6; text-align:center; color:#fff; font-size:14px}.msg_txt{padding:10px; margin-top:8px}.msg_txt h4{line-height:26px; font-size:14px}.msg_txt h4.red{color:#f30}.msg_txt p{line-height:22px}';
	$str .= '</style>';
	$str .= '</head>';
	$str .= '<body>';
	$str .= '<div class="message">';
	$str .= '<h3>'.$msgTitle.'</h3>';
	$str .= '<div class="msg_txt">';
	$str .= '<h4 class="red">'.$message.'</h4>';
	$str .= '<p>系统将在 <span style="color:blue;font-weight:bold">3</span> 秒后自动跳转,如果不想等待,直接点击 <a href="'.$jumpUrl.'">这里</a> 跳转</p>';
	$str .= "<script>setTimeout('location.replace(\'".$jumpUrl."\')',2000)</script>";
	$str .= '</div>';
	$str .= '</div>';
	$str .= '</body>';
	$str .= '</html>';
	echo $str;
}

/**
 * xss过滤函数
 *
 * @param $string
 * @return string
 */
function remove_xss($string) { 
    $string = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S', '', $string);

    $parm1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');

    $parm2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');

    $parm = array_merge($parm1, $parm2); 

	for ($i = 0; $i < sizeof($parm); $i++) { 
		$pattern = '/'; 
		for ($j = 0; $j < strlen($parm[$i]); $j++) { 
			if ($j > 0) { 
				$pattern .= '('; 
				$pattern .= '(&#[x|X]0([9][a][b]);?)?'; 
				$pattern .= '|(&#0([9][10][13]);?)?'; 
				$pattern .= ')?'; 
			}
			$pattern .= $parm[$i][$j]; 
		}
		$pattern .= '/i';
		$string = preg_replace($pattern, ' ', $string); 
	}
	return $string;
}

/**
 * 安全过滤函数
 *
 * @param $string
 * @return string
 */
function safe_replace($string) {
	$string = str_replace('%20','',$string);
	$string = str_replace('%27','',$string);
	$string = str_replace('%2527','',$string);
	$string = str_replace('*','',$string);
	$string = str_replace('"','&quot;',$string);
	$string = str_replace("'",'',$string);
	$string = str_replace('"','',$string);
	$string = str_replace(';','',$string);
	$string = str_replace('<','&lt;',$string);
	$string = str_replace('>','&gt;',$string);
	$string = str_replace("{",'',$string);
	$string = str_replace('}','',$string);
	$string = str_replace('\\','',$string);
	return $string;
}

/**
 * Function dataformat
 * 时间转换
  * @param $n INT时间
 */
 function dataformat($n) {
	$hours = floor($n/3600);
	$minite	= floor($n%3600/60);
	$secend = floor($n%3600%60);
	$minite = $minite < 10 ? "0".$minite : $minite;
	$secend = $secend < 10 ? "0".$secend : $secend;
	if($n >= 3600){
		return $hours.":".$minite.":".$secend;
	}else{
		return $minite.":".$secend;
	}

 } 
 
 /**
* 转化 \ 为 /
* 
* @param	string	$path	路径
* @return	string	路径
*/
function dir_path($path) {
	$path = str_replace('\\', '/', $path);
	if(substr($path, -1) != '/') $path = $path.'/';
	return $path;
}
/**
* 创建目录
* 
* @param	string	$path	路径
* @param	string	$mode	属性
* @return	string	如果已经存在则返回true，否则为flase
*/
function dir_create($path, $mode = 0777) {
	if(is_dir($path)) return TRUE;
	$ftp_enable = 0;
	$path = dir_path($path);
	$temp = explode('/', $path);
	$cur_dir = '';
	$max = count($temp) - 1;
	for($i=0; $i<$max; $i++) {
		$cur_dir .= $temp[$i].'/';
		if (@is_dir($cur_dir)) continue;
		@mkdir($cur_dir, 0777,true);
		@chmod($cur_dir, 0777);
	}
	return is_dir($path);
}

/**
* 列出目录下所有文件
* 
* @param	string	$path		路径
* @param	string	$exts		扩展名
* @param	array	$list		增加的文件列表
* @return	array	所有满足条件的文件
*/
function dir_list($path, $exts = '', $list= array()) {
	$path = dir_path($path);
	$files = glob($path.'*');
	foreach($files as $v) {
		if (!$exts || pathinfo($v, PATHINFO_EXTENSION) == $exts) {
			$list[] = $v;
			if (is_dir($v)) {
				$list = dir_list($v, $exts, $list);
			}
		}
	}
	return $list;
}

/**
* 删除目录及目录下面的所有文件
* 
* @param	string	$dir		路径
* @return	bool	如果成功则返回 TRUE，失败则返回 FALSE
*/
function dir_delete($dir) {
	$dir = dir_path($dir);
	if (!is_dir($dir)) return FALSE;
	$list = glob($dir.'*');
	foreach($list as $v) {
		is_dir($v) ? dir_delete($v) : @unlink($v);
	}
    return @rmdir($dir);
}

/**
* 读取html模板内容
* @return	string
*/
function read_model($model_file){
	$fp=fopen($model_file,"r");
	$model_content=fread($fp,filesize($model_file));
	fclose($fp);
	return $model_content;
}

function CheckEmptyString($C_char){
	if (!is_string($C_char)) return false; //判断是否是字符串类型
	if (empty($C_char)) return false; //判断是否已定义字符串
	if ($C_char=='') return false; //判断字符串是否为空
	return true;
}

//去除html
function no_html($str){
  $str=trim($str); //清除字符串两边的空格 
  $str=str_replace("\n", '', $str); 
  $str=str_replace("\r", '', $str); 
  $str=str_replace("\t", '', $str);
  return trim($str);
}
?>