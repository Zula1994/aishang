<?php
header("Content-type: text/html;charset=utf-8");
error_reporting(E_ERROR | E_PARSE);
@set_time_limit(0);
define('XYCMS',true);
define('XYCMSPATH', substr(dirname(__FILE__), 0, -4));
PHP_VERSION >= '5.1' && date_default_timezone_set('Asia/Shanghai');
//session_cache_limiter('private, must-revalidate'); 
//@ini_set('session.auto_start',0);
if(PHP_VERSION < '4.1.0') {
	$_GET         = &$HTTP_GET_VARS;
	$_POST        = &$HTTP_POST_VARS;
	$_COOKIE      = &$HTTP_COOKIE_VARS;
	$_SERVER      = &$HTTP_SERVER_VARS;
	$_ENV         = &$HTTP_ENV_VARS;
	$_FILES       = &$HTTP_POST_FILES;
}
require_once XYCMSPATH.'conf/common.db.php';
require_once XYCMSPATH.'libs/classes/mysql.class.php';
$db = new mysql();
$db->mysql($db_host,$db_user,$db_pass,$db_name,0);
require_once XYCMSPATH.'conf/web_config.php';
?>