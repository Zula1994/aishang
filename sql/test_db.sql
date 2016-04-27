-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-04-27 19:49:48
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test_db`
--

-- --------------------------------------------------------

--
-- 表的结构 `xy_admin_user`
--

CREATE TABLE IF NOT EXISTS `xy_admin_user` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `xyname` varchar(255) NOT NULL DEFAULT '',
  `xypwd` varchar(255) NOT NULL DEFAULT '',
  `login_num` int(11) NOT NULL DEFAULT '0',
  `login_date` int(11) NOT NULL,
  `c_date` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `xyname` (`xyname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `xy_admin_user`
--

INSERT INTO `xy_admin_user` (`id`, `xyname`, `xypwd`, `login_num`, `login_date`, `c_date`) VALUES
(1, 'admin', 'c3284d0f94606de1fd2af172aba15bf3', 103, 1450406897, 1445959692),
(10, '朱璐', 'd9b1d7db4cd6e70935368a1efb10e377', 0, 0, 1461254400),
(9, 'aa', '14e1b600b1fd579f47433b88e8d85291', 0, 0, 1461168000);

-- --------------------------------------------------------

--
-- 表的结构 `xy_admin_user_count`
--

CREATE TABLE IF NOT EXISTS `xy_admin_user_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_name` varchar(255) NOT NULL,
  `login_date` int(11) NOT NULL,
  `login_ip` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `xy_admin_user_count`
--

INSERT INTO `xy_admin_user_count` (`id`, `login_name`, `login_date`, `login_ip`) VALUES
(10, 'admin', 1461513600, '::1'),
(9, 'admin', 1461340800, '::1'),
(8, 'admin', 1461340800, '::1'),
(1, 'admin', 1450454400, '127.0.0.1'),
(7, 'admin', 1461254400, '::1'),
(11, 'admin', 1461600000, '::1'),
(12, 'admin', 1461772800, '::1');

-- --------------------------------------------------------

--
-- 表的结构 `xy_ads`
--

CREATE TABLE IF NOT EXISTS `xy_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `ad_bs` varchar(255) NOT NULL,
  `c_id` int(6) NOT NULL DEFAULT '0',
  `link_url` varchar(255) NOT NULL,
  `link_img` text NOT NULL,
  `link_w` int(6) NOT NULL,
  `link_h` int(6) NOT NULL,
  `link_file` text NOT NULL,
  `c_order` int(6) NOT NULL,
  `c_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `xy_ads`
--

INSERT INTO `xy_ads` (`id`, `title`, `ad_bs`, `c_id`, `link_url`, `link_img`, `link_w`, `link_h`, `link_file`, `c_order`, `c_date`) VALUES
(3, '分页广告', '', 1, 'http://www.jsxyidc.com', '/uploads/image/20151209/20151209170003_74569.jpg', 1100, 180, '', 1, 1447776000),
(4, '百度', 'ad_150_60', 1, 'http://www.baidu.com', '/uploads/image/20151206/20151206175859_29893.jpg', 150, 60, '', 2, 1449417600),
(5, '测试flash广告', '', 2, 'http://www.baidu.com', '', 1040, 200, '/uploads/file/20151206/20151206180542_55458.swf', 3, 1449417600);

-- --------------------------------------------------------

--
-- 表的结构 `xy_article`
--

CREATE TABLE IF NOT EXISTS `xy_article` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `a_bold` varchar(255) NOT NULL,
  `a_color` varchar(30) NOT NULL,
  `keywords` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `a_author` varchar(100) NOT NULL,
  `a_from` varchar(100) NOT NULL,
  `c_date` int(11) NOT NULL,
  `is_hot` int(10) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '1',
  `a_zt` int(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=199 ;

--
-- 转存表中的数据 `xy_article`
--

INSERT INTO `xy_article` (`id`, `catid`, `title`, `a_bold`, `a_color`, `keywords`, `description`, `content`, `a_author`, `a_from`, `c_date`, `is_hot`, `hits`, `a_zt`) VALUES
(175, 42, '测试产品测试产品2', '', '', '', '', '测试产品测试产品2测试产品测试产品2测试产品测试产品2测试产品测试产品2测试产品测试产品2测试产品测试产品2测试产品测试产品2测试产品测试产品2测试产品测试产品2测试产品测试产品2测试产品测试产品2测试产品测试产品2测试产品测试产品2测试产品测试产品2测试产品测试产品2测试产品测试产品2测试产品测试产品2测试产品测试产品2测试产品测试产品2测试产品测试产品2测试产品测试产品2测试产品测试产品2', '本站编辑', '本站', 1449676800, 0, 1, 1),
(193, 20, '测试新闻信息测试新闻信息测试新闻信息', '', '', '', '', '测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息测试新闻信息', '本站编辑', '本站', 1450368000, 1, 4, 1),
(194, 21, '邯郸市安全生产监督管理局', '', '', '邯郸市安全生产监督管理局', '邯郸市安全生产监督管理局', '河北邯郸生产管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局邯郸市安全生产监督管理局', '本站编辑', '本站', 1450368000, 0, 1, 1),
(197, 0, '电商价格战煎熬上游供应商订单爆棚员工抓狂电商价格', '', '', '电商价格战煎熬上游供应商订单爆棚员工抓狂电商价格', '电商价格战煎熬上游供应商订单爆棚员工抓狂电商价格电商价格战煎熬上游供应商订单爆棚员工抓狂电商价格电商价格战煎熬上游供应商订单爆棚员工抓狂电商价格', '电商价格战煎熬上游供应商订单爆棚员工抓狂电商价格电商价格战煎熬上游供应商订单爆棚员工抓狂电商价格电商价格战煎熬上游供应商订单爆棚员工抓狂电商价格', '本站编辑', '本站', 1461644094, 0, 1, 1),
(198, 0, '上市即脱销 华为Ascend P1一机难求', '', '', '上市即脱销 华为Ascend P1一机难求上市即脱销 华为Ascend P1一机难求上市即脱销 华为Ascend P1一机难求', '<p>上市即脱销 华为Ascend P1一机难求上市即脱销 华为Ascend P1一机难求上市即脱销 华为Ascend P1一机难求<p>', '<p>上市即脱销 华为Ascend P1一机难求上市即脱销 华为Ascend P1一机难求上市即脱销 华为Ascend P1一机难求<p><p>上市即脱销 华为Ascend P1一机难求上市即脱销 华为Ascend P1一机难求上市即脱销 华为Ascend P1一机难求<p><p>上市即脱销 华为Ascend P1一机难求上市即脱销 华为Ascend P1一机难求上市即脱销 华为Ascend P1一机难求<p>', '本站编辑', '本站', 1461644129, 0, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `xy_book`
--

CREATE TABLE IF NOT EXISTS `xy_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `f_tel` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `reply_content` text NOT NULL,
  `is_view` int(4) NOT NULL DEFAULT '0',
  `c_order` int(10) NOT NULL,
  `b_ip` varchar(50) NOT NULL,
  `c_date` int(11) NOT NULL,
  `f_email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `xy_book`
--

INSERT INTO `xy_book` (`id`, `f_name`, `title`, `f_tel`, `content`, `reply_content`, `is_view`, `c_order`, `b_ip`, `c_date`, `f_email`) VALUES
(3, '', '新浪网', '', '测试留言内容', '<p>\r\n	测试留言回复内容\r\n</p>', 1, 0, '', 1447776000, ''),
(4, '咨询姓名', '测试咨询标题', '15851852314', '测试咨询内容', '', 1, 2, '', 1450195200, ''),
(5, '咨询姓名', '测试小题', '15851852314', '试试水', '试试水试试水试试水', 1, 0, '', 1450281600, ''),
(6, 'ddd', '测试小题444', 'ddd', 'dddd', '', 1, 0, '', 1450281600, ''),
(7, '咨询姓名', '测试咨询标题', '15851852314', 'sss', '', 1, 0, '', 1450281600, ''),
(8, '', 'aaa', '', 'aaaaaa', 'aaaaa', 1, 1, '', 1461513600, ''),
(12, 'aa', '', '11111', '11111', '', 0, 0, '', 1461645753, 'aa');

-- --------------------------------------------------------

--
-- 表的结构 `xy_category`
--

CREATE TABLE IF NOT EXISTS `xy_category` (
  `cid` int(6) NOT NULL AUTO_INCREMENT,
  `cname` varchar(32) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `c_order` int(11) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `folder` varchar(255) NOT NULL,
  `folderpath` varchar(255) NOT NULL,
  `s_id` varchar(11) NOT NULL,
  `s_path` varchar(255) NOT NULL,
  `c_type` int(11) NOT NULL,
  `c_lev` int(11) NOT NULL,
  `c_date` int(11) NOT NULL,
  PRIMARY KEY (`cid`),
  KEY `pid` (`pid`),
  KEY `cname` (`cname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- 转存表中的数据 `xy_category`
--

INSERT INTO `xy_category` (`cid`, `cname`, `keywords`, `description`, `content`, `pid`, `c_order`, `thumb`, `folder`, `folderpath`, `s_id`, `s_path`, `c_type`, `c_lev`, `c_date`) VALUES
(17, '产品展示', '产品展示', '产品展示', '产品展示产品展示产品展示产品展示', 0, 2, '', 'products', '/products', '17', '17,', 2, 1, 1441209600),
(18, '新闻动态', '新闻动态', '新闻动态', '新闻动态新闻动态新闻动态', 0, 3, '', 'news', '/news', '18', '18,', 1, 1, 1446307200),
(19, '企业公告', '企业公告', '企业公告', '企业公告企业公告企业公告企业公告', 18, 1, '', 'notice', '/news/notice', '18', '18,19,', 1, 2, 1446393600),
(20, '公司新闻', '', '', '', 18, 2, '', 'gongsixinwen', '/news/gongsixinwen', '18', '18,20,', 1, 2, 1448726400),
(21, '客户案例', '', '', '', 0, 3, '', 'case', '/case', '21', '21,', 3, 1, 1449072000),
(22, '人才招聘', '人才招聘', '人才招聘', '', 0, 6, '', 'job', '/job', '22', '22,', 4, 1, 1449072000),
(23, '资料下载', '', '', '', 0, 6, '', 'download', '/download', '23', '23,', 5, 1, 1449331200),
(25, '行业资讯', '', '', '', 18, 5, '', 'hyzx', '/news/hyzx', '18', '18,25,', 1, 2, 1449331200),
(26, '公司相册', '', '公司相册', '公司相册', 0, 5, '', 'photos', '/photos', '26', '26,', 7, 1, 1449331200),
(27, '企业视频', '', '', '', 0, 5, '', 'videos', '/videos', '27', '27,', 6, 1, 1449331200),
(34, '公司简介', '公司简介', '公司简介', '<p style="color:#5E5F60;text-indent:2em;background-color:#FFFFFF;">\r\n	江苏鑫跃科技有限公司（以下简称“鑫跃科技”），国内建站行业的先行者，是一家拥有自主知识产权的技术企业。自成立之初就秉承"用户需求至上，用户体验至上"的开发理念，从成立至今一直致力于为企事业单位及个人提供全方位网络信息及技术服务。\r\n</p>\r\n<p style="color:#5E5F60;text-indent:0px;background-color:#FFFFFF;">\r\n	<br />\r\n</p>\r\n<p style="color:#5E5F60;text-indent:2em;background-color:#FFFFFF;">\r\n	在互联网服务方面，我们专业提供<strong><span style="color:#006600;font-size:12px;background-color:#FFFFFF;">网站建设、电子商务运营</span></strong><strong><span style="color:#006600;font-size:12px;background-color:#FFFFFF;">、网站托管、</span></strong><span style="font-size:14px;"><strong><span style="font-size:12px;"><span style="color:#006600;background-color:#FFFFFF;">网络营销、域名注册、虚拟主机</span><span style="color:#006600;background-color:#FFFFFF;">、广告设计</span><span style="color:#006600;background-color:#FFFFFF;">、建站技术培训、IT设备等</span></span></strong><span style="font-size:12px;">服务。</span></span> \r\n</p>\r\n<p style="color:#5E5F60;text-indent:0px;background-color:#FFFFFF;">\r\n	<br />\r\n</p>\r\n<p style="color:#5E5F60;text-indent:2em;background-color:#FFFFFF;">\r\n	我们始终着眼于未来，不断关注人才成长，保持公司和人才竞争力的同步提升。鑫跃科技同时也在不断吸纳众多专业人才，并全力打造一个积极、高效、开放、稳健的研发运营团队，实现个人价值与公司价值的共赢。\r\n</p>\r\n<p style="color:#5E5F60;text-indent:0px;background-color:#FFFFFF;">\r\n	<br />\r\n</p>\r\n<p style="color:#5E5F60;text-indent:2em;background-color:#FFFFFF;">\r\n	如今，鑫跃科技在乘风破浪的同时，并未松懈。我们将永远以创业者的心态，敢于突破现状，精益求精，坚决保持以"客户至上"的经营理念，为广大用户呈现更多更优秀的系统作品。\r\n</p>', 0, 1, '', 'about', '/about', '34', '34,', 8, 1, 1449849600),
(35, '联系我们', '', '', '联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们', 34, 5, '', 'contact', '/about/contact', '34', '34,35,', 8, 2, 1449849600),
(36, '企业荣誉', '', '', '企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉企业荣誉', 34, 5, '', 'honor', '/about/honor', '34', '34,36,', 8, 2, 1449849600),
(42, '数码', '', '', '', 17, 1, '', 'sm', '/products/sm', '17', '17,42,', 2, 2, 1450368000),
(43, '家电', '', '', '', 17, 2, '', 'jd', '/products/jd', '17', '17,43,', 2, 2, 1450368000);

-- --------------------------------------------------------

--
-- 表的结构 `xy_config`
--

CREATE TABLE IF NOT EXISTS `xy_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wzname` varchar(255) NOT NULL,
  `wztitle` varchar(255) NOT NULL,
  `wzkeys` varchar(255) NOT NULL,
  `wzdec` varchar(255) NOT NULL,
  `wzurl` varchar(255) NOT NULL,
  `wzlogo` varchar(255) NOT NULL,
  `wxlogo` varchar(255) NOT NULL,
  `wzicp` varchar(50) NOT NULL,
  `wztel` varchar(30) NOT NULL,
  `wzemail` varchar(255) NOT NULL,
  `wzaddress` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `xy_config`
--

INSERT INTO `xy_config` (`id`, `wzname`, `wztitle`, `wzkeys`, `wzdec`, `wzurl`, `wzlogo`, `wxlogo`, `wzicp`, `wztel`, `wzemail`, `wzaddress`) VALUES
(1, 'XYCMS企业建站系统PHP版旗舰版', 'XYCMS建站系统', 'XYCMS建站系统XYCMS建站系统XYCMS建站系统XYCMS建站系统', 'XYCMS建站系统XYCMS建站系统XYCMS建站系统XYCMS建站系统', 'http://localhost', '/uploads/image/20151209/20151209164155_59031.jpg', '/uploads/image/20151208/20151208124803_56359.png', '苏ICP备08106044号', '15851850000', 'yang3rui@163.com', '江苏省南京市玄武区玄武大道徐庄软件园');

-- --------------------------------------------------------

--
-- 表的结构 `xy_jdt`
--

CREATE TABLE IF NOT EXISTS `xy_jdt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `link_url` varchar(255) NOT NULL,
  `link_img` varchar(255) NOT NULL,
  `c_order` int(6) NOT NULL,
  `c_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `xy_jdt`
--

INSERT INTO `xy_jdt` (`id`, `title`, `link_url`, `link_img`, `c_order`, `c_date`) VALUES
(2, '鑫跃科技', 'http://www.jsxyidc.com/', '/uploads/image/20151217/20151217161614_46513.jpg', 5, 1446998400);

-- --------------------------------------------------------

--
-- 表的结构 `xy_kfs`
--

CREATE TABLE IF NOT EXISTS `xy_kfs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `kf_code` text NOT NULL,
  `c_order` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `xy_kfs`
--

INSERT INTO `xy_kfs` (`id`, `title`, `kf_code`, `c_order`) VALUES
(3, '在线客服2', '<a href="http://wpa.qq.com/msgrd?V=1&Uin=364500483&Site=鑫跃科技&Menu=yes" target="blank"><img alt="点击这里咨询" src="http://wpa.qq.com/pa?p=1:364500483:4" border="0" /> 364500483</a>', 3);

-- --------------------------------------------------------

--
-- 表的结构 `xy_links`
--

CREATE TABLE IF NOT EXISTS `xy_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `c_id` int(6) NOT NULL,
  `link_url` varchar(255) NOT NULL,
  `link_img` varchar(255) NOT NULL,
  `c_order` int(6) NOT NULL,
  `c_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `xy_links`
--

INSERT INTO `xy_links` (`id`, `title`, `c_id`, `link_url`, `link_img`, `c_order`, `c_date`) VALUES
(2, '凤凰网', 0, 'http://www.ifeng.com', '', 2, 1446998400),
(3, '新浪网', 1, 'http://www.sina.com.cn', '/uploads/image/20151218/20151218162314_59523.gif', 1, 1450454400);

-- --------------------------------------------------------

--
-- 表的结构 `xy_menu`
--

CREATE TABLE IF NOT EXISTS `xy_menu` (
  `cid` int(6) NOT NULL AUTO_INCREMENT,
  `cname` varchar(32) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `c_order` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `open_method` varchar(255) NOT NULL,
  `c_lev` int(11) NOT NULL DEFAULT '1',
  `c_date` int(11) NOT NULL,
  PRIMARY KEY (`cid`),
  KEY `pid` (`pid`),
  KEY `cname` (`cname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- 转存表中的数据 `xy_menu`
--

INSERT INTO `xy_menu` (`cid`, `cname`, `pid`, `c_order`, `url`, `open_method`, `c_lev`, `c_date`) VALUES
(17, '网站首页', 0, 1, '/index.html', '_self', 1, 1441209600),
(18, '新闻动态', 0, 3, '/news', '_self', 1, 1446307200),
(19, '企业公告', 18, 1, '/news/notice', '_self', 2, 1446393600),
(20, '公司新闻', 18, 2, '/news/gongsixinwen', '_self', 2, 1448726400),
(21, '客户案例', 0, 3, '/case', '_self', 1, 1449072000),
(22, '人才招聘', 0, 6, '/job', '_self', 1, 1449072000),
(23, '资料下载', 0, 6, '/download', '_self', 1, 1449331200),
(25, '行业资讯', 18, 5, '/news/hyzx', '_self', 2, 1449331200),
(26, '公司相册', 0, 5, '/photos', '_self', 1, 1449331200),
(27, '企业视频', 0, 5, '/videos', '_self', 1, 1449331200),
(32, '公司简介', 0, 2, '/about', '_self', 1, 1449849600);

-- --------------------------------------------------------

--
-- 表的结构 `xy_pro`
--

CREATE TABLE IF NOT EXISTS `xy_pro` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `xy_price` varchar(255) NOT NULL,
  `xy_model` varchar(30) NOT NULL,
  `keywords` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `a_author` varchar(100) NOT NULL,
  `a_from` varchar(100) NOT NULL,
  `c_date` int(11) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '1',
  `xy_spec` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `is_hot` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=240 ;

--
-- 转存表中的数据 `xy_pro`
--

INSERT INTO `xy_pro` (`id`, `catid`, `title`, `xy_price`, `xy_model`, `keywords`, `description`, `content`, `a_author`, `a_from`, `c_date`, `hits`, `xy_spec`, `thumb`, `url`, `is_hot`) VALUES
(222, 0, '联想电脑', '4000', '', '联想电脑联想电脑', '联想电脑联想电脑联想电脑联想电脑联想电脑', '', '本站编辑', '本站', 1461546784, 1, '', '201252315108.jpg', '', 0),
(223, 0, '联想电脑', '联想电脑联想电脑', '', '联想电脑', '联想电脑联想电脑联想电脑', '', '本站编辑', '本站', 1461547969, 1, '', '201252315108.jpg', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
