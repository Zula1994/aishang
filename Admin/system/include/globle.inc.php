<?php
define('IN_ADMIN', true);
define('XYCMS_ROOT', str_replace('system/include/globle.inc.php', '', str_replace('\\', '/', __FILE__)));
ini_set("magic_quotes_runtime",0);
require XYCMS_ROOT . 'conf/common.inc.php';
require XYCMS_ROOT . 'libs/functions/fun.php';
require XYCMS_ROOT . 'libs/functions/dataFun.php';
require XYCMS_ROOT . 'libs/m_t_h/make_to_html.php';
require XYCMS_ROOT . 'libs/m_t_h/make_list_html.php';
require XYCMS_ROOT . 'libs/m_t_h/single_to_html.php';
require XYCMS_ROOT . 'libs/m_t_h/sitemap_to_html.php';
require XYCMS_ROOT . 'libs/m_t_h/index_to_html.php';
require XYCMS_ROOT . 'libs/m_t_h/search_to_html.php';
require XYCMS_ROOT . 'libs/m_t_h/add_book_to_html.php';
require XYCMS_ROOT . 'libs/m_t_h/book_list_to_html.php';
require XYCMS_ROOT . 'libs/m_t_h/error_to_html.php';
?>