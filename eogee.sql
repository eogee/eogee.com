-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        8.0.12 - MySQL Community Server - GPL
-- 服务器操作系统:                      Win64
-- HeidiSQL 版本:                  11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- 导出 eogee 的数据库结构
CREATE DATABASE IF NOT EXISTS `eogee` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `eogee`;

-- 导出  表 eogee.basicinfo 结构
CREATE TABLE IF NOT EXISTS `basicinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '网站标题',
  `titleIcon` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '网站标题图标',
  `indexUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '主页地址',
  `keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '网站关键字',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '网站描述',
  `logoImage` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'logo图标',
  `logoAlt` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'logo提示文字',
  `navToolName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '工具按钮名称',
  `navToolUrl` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '工具按钮链接',
  `singlePageName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '关于' COMMENT '单页内容分类名称',
  `copyright` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '版权声明',
  `siteName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '本站名称',
  `recordCode` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '备案编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='网站基本信息';

-- 正在导出表  eogee.basicinfo 的数据：~0 rows (大约)
DELETE FROM `basicinfo`;
/*!40000 ALTER TABLE `basicinfo` DISABLE KEYS */;
INSERT INTO `basicinfo` (`id`, `title`, `titleIcon`, `indexUrl`, `keywords`, `description`, `logoImage`, `logoAlt`, `navToolName`, `navToolUrl`, `singlePageName`, `copyright`, `siteName`, `recordCode`) VALUES
	(1, 'EOGEE_岳极技术_企业管理综合技术咨询服务平台_小投入，大越级', '/Resource/pic/logomini-2.ico', 'https://www.eogee.com', '仓库管理系统,WMS,环境影响评价,环评', '岳极技术：小投入，大越级！为企业提供客户仓库管理系统（WMS）等云软件产品；环境影响评价等技术咨询服务', '/Resource/pic/logo-首页-深色-英文.png', 'EOGEE 岳极技术', '产品预览', '/contentParent/detail/1', '关于', '2022-2024', 'EOGEE 岳极技术', '冀ICP备2024095105号');
/*!40000 ALTER TABLE `basicinfo` ENABLE KEYS */;

-- 导出  表 eogee.carousel 结构
CREATE TABLE IF NOT EXISTS `carousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '首标题',
  `titleSize` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'h2' COMMENT '首标题字号',
  `titleColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '首标题颜色',
  `titleShadowColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '首标题阴影颜色',
  `backgroundImage` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '背景图',
  `keynote` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '副标题',
  `keynoteColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '副标题颜色',
  `keynoteShadowColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '副标题阴影颜色',
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '内容',
  `contentColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '内容颜色',
  `contentShadowColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '内容阴影颜色',
  `btn1` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '按钮1',
  `btn1url` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '按钮1链接',
  `btn1blank` int(11) DEFAULT '0' COMMENT '是否新页面打开',
  `btn2` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '按钮2',
  `btn2url` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '按钮2链接',
  `btn2blank` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '0' COMMENT '是否新页面打开',
  `sort` int(11) DEFAULT NULL COMMENT '排序值',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='轮播图';

-- 正在导出表  eogee.carousel 的数据：~2 rows (大约)
DELETE FROM `carousel`;
/*!40000 ALTER TABLE `carousel` DISABLE KEYS */;
INSERT INTO `carousel` (`id`, `title`, `titleSize`, `titleColor`, `titleShadowColor`, `backgroundImage`, `keynote`, `keynoteColor`, `keynoteShadowColor`, `content`, `contentColor`, `contentShadowColor`, `btn1`, `btn1url`, `btn1blank`, `btn2`, `btn2url`, `btn2blank`, `sort`, `deleted_at`) VALUES
	(1, '小投入·大越级', 'h1', 'white', 'black', '/Resource/pic/品牌轮播图.jpg', 'EOGEE 岳极技术', 'green', 'black', '企业管理综合技术咨询服务平台', 'white', 'black', '', '', 0, '', '', '', 2, NULL),
	(2, 'WMS 仓库管理系统', 'h2', 'white', 'black', '/Resource/pic/仓库轮播图.jpg', '限时特惠 68元/年 起', 'red', 'black', '快速上手·功能健全·多端多账号·全面统计', 'white', 'black', '预览产品', 'http://wms-demo.eogee.com/', 1, '了解详情', 'https://eogee.taobao.com', '1', 1, NULL);
/*!40000 ALTER TABLE `carousel` ENABLE KEYS */;

-- 导出  表 eogee.content 结构
CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `parentId` int(11) NOT NULL DEFAULT '1' COMMENT '父级ID',
  `top` int(11) DEFAULT '1' COMMENT '是否空置顶部',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '首标题',
  `titleAbbre` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '首标题简称',
  `titleColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '首标题颜色',
  `titleShadowColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '首标题阴影颜色',
  `keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '关键字',
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '描述',
  `backgroundImage` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '背景图',
  `keynote` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '副标题',
  `keynoteColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '副标题颜色',
  `keynoteShadowColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '副标题阴影颜色',
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '内容',
  `contentColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '内容颜色',
  `contentShadowColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '内容阴影颜色',
  `detail` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT '详情',
  `detailColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '详情颜色',
  `detailShadowColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '详情阴影颜色',
  `newsContent` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '动态内容',
  `btn1` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '按钮1',
  `btn1url` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '按钮1链接',
  `btn1blank` int(11) DEFAULT '0' COMMENT '是否新页面打开',
  `btn2` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '按钮2',
  `btn2url` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '按钮2链接',
  `btn2blank` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '0' COMMENT '是否新页面打开',
  `sort` float DEFAULT '0' COMMENT '排序值',
  `isNews` int(11) DEFAULT NULL COMMENT '是否列入动态',
  `newsDate` date DEFAULT NULL COMMENT '动态时间',
  `enterId` int(11) DEFAULT NULL COMMENT '录入人员ID',
  `enter` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '录入人员',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_content_contentparent` (`parentId`),
  CONSTRAINT `FK_content_contentparent` FOREIGN KEY (`parentId`) REFERENCES `contentparent` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='内容明细';

-- 正在导出表  eogee.content 的数据：~12 rows (大约)
DELETE FROM `content`;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` (`id`, `parentId`, `top`, `title`, `titleAbbre`, `titleColor`, `titleShadowColor`, `keywords`, `description`, `backgroundImage`, `keynote`, `keynoteColor`, `keynoteShadowColor`, `content`, `contentColor`, `contentShadowColor`, `detail`, `detailColor`, `detailShadowColor`, `newsContent`, `btn1`, `btn1url`, `btn1blank`, `btn2`, `btn2url`, `btn2blank`, `sort`, `isNews`, `newsDate`, `enterId`, `enter`, `deleted_at`) VALUES
	(1, 1, 1, 'WMS 仓库管理系统', 'WMS', 'black', 'white', 'WMS,仓库,管理,系统', 'EOGEE 岳极技术，WMS 仓库管理系统，限时特惠 68元/年起，快速上手，功能健全，多端多账号，全面统计', '/Resource/pic/WMS产品首图.jpg', '限时特惠 68元/年 起', 'red', 'white', '快速上手·功能健全·多端多账号·全面统计', 'black', 'white', '物品管理 / 入库管理 / 库存管理 / 出口管理 / 收付款管理 / 用户管理 / 供应商管理 / 客户管理 / 权限设置 / 数据看板 / 报表统计', 'black', '', 'EOGEE WMS 仓库管理系统 V1.0版本正式上线。', '预览产品', 'http://wms-demo.eogee.com/', 1, '了解详情', 'https://eogee.taobao.com', '1', 3, 1, '2023-10-16', 1, 'admin', NULL),
	(2, 1, 1, 'MMS 会员管理系统', 'MMS', 'black', 'white', 'MMS', '近日上线，敬请期待...', '', '近日上线，敬请期待...', '', '', '近日上线，敬请期待...', '', '', '', '', '', 'MMS 会员管理系统 近日上线，敬请期待...', '', '', 0, '', '', '0', 2, 1, '2024-12-24', 1, 'admin', NULL),
	(3, 1, 1, 'PMS 项目管理系统', 'PMS', 'black', 'white', 'PMS', '近日上线，敬请期待...', '', '近日上线，敬请期待...', '', '', '近日上线，敬请期待...', '', '', '', '', '', 'MMS 会员管理系统 近日上线，敬请期待...', '', '', 0, '', '', '0', 1, 1, '2024-12-24', 1, 'admin', NULL),
	(4, 4, 1, '环保技术咨询服务', '环保', 'blue', 'white', '环保', '近日上线，敬请期待...', '', 'EP Services', '', '', '近日上线，敬请期待...', '', '', '', '', '', '', '', '', 0, '', '', '0', 2, NULL, '2024-12-25', 1, 'admin', NULL),
	(5, 4, 1, '安全技术咨询服务', '安全', 'red', 'white', '安全', '近日上线，敬请期待...', '', 'Security Services', '', '', '近日上线，敬请期待...', '', '', '近日上线，敬请期待...', '', '', '', '', '', 0, '', '', '0', 1, NULL, '2024-12-25', 1, 'admin', NULL),
	(6, 2, 1, 'PHP进阶', 'PHP进阶', 'purple', 'white', 'PHP进阶', '近日上线，敬请期待...', '', '近日上线，敬请期待...', '', '', '近日上线，敬请期待...', '', '', '', 'PHP面向对象/PHP自制框架/Laravel框架/商城系统项目实战', '', 'PHP进阶 近日上线，敬请期待...', '', '', 0, '', '', '0', 1, 1, '2024-12-24', 1, 'admin', NULL),
	(7, 2, 1, 'WEB后端基础', 'WEB后端', 'black', 'white', 'WEB后端', '近日上线，敬请期待...', '', '近日上线，敬请期待...', '', '', '近日上线，敬请期待...', '', '', 'Python基础/Node.js基础/PHP基础/Mysql基础/服务器/即时聊天系统项目实战', '', '', 'WEB后端基础 近日上线，敬请期待...', '', '', 0, '', '', '0', 2, 1, '2024-12-24', 1, 'admin', NULL),
	(8, 2, 1, 'JavaScript进阶', 'JS进阶', 'orange', 'white', 'JS进阶', '近日上线，敬请期待...', '', '近日上线，敬请期待...', '', '', '近日上线，敬请期待...', '', '', 'JavaScript进阶/Ajax/Vue.js/Layui/图书管理系统项目实战', '', '', 'JavaScript进阶 近日上线，敬请期待...', '', '', 0, '', '', '0', 3, 1, '2024-12-24', 1, 'admin', NULL),
	(9, 2, 1, 'WEB前端基础', 'WEB前端', 'red', 'white', 'WEB前端', '近日上线，敬请期待...', '', '近日上线，敬请期待...', '', '', '近日上线，敬请期待...', '', '', 'HTML/Markdown/CSS/Javascript基础/文档应用项目实战', '', '', 'WEB前端基础 近日上线，敬请期待...', '', '', 0, '', '', '0', 4, 1, '2024-12-24', 1, 'admin', NULL),
	(10, 3, 1, '新用户立减10元', '新户立减', 'black', 'white', '', '', '', '新用户下单软件产品，领券立减10元', '', '', '新用户下单软件产品，领券立减10元', '', '', '新用户下单软件产品，领券立减10元', '', '', '', '', '', 0, '了解详情', 'https://eogee.taobao.com', '1', 3, NULL, '2024-12-24', 1, 'admin', NULL),
	(11, 3, 1, 'WMS限时68元/年', 'WMS限时优惠 68元/年', 'black', 'white', 'WMS限时68元/年', 'WMS限时优惠 68元/年', '', 'WMS限时优惠 68元/年', '', '', 'WMS限时优惠 68元/年', '', '', 'WMS限时优惠 68元/年', '', '', '', '', '', 0, '了解详情', 'https://eogee.taobao.com', '1', 2, NULL, '2024-12-24', 1, 'admin', NULL),
	(12, 3, 1, '好评返现5元', '好评返现', 'black', 'white', '好评返现', '近日上线，敬请期待...', '', '近日上线，敬请期待...', '', '', '近日上线，敬请期待...', '', '', '近日上线，敬请期待...', '', '', '', '', '', 0, '', '', '0', 1, NULL, '2024-12-24', 1, 'admin', NULL);
/*!40000 ALTER TABLE `content` ENABLE KEYS */;

-- 导出  表 eogee.contentparent 结构
CREATE TABLE IF NOT EXISTS `contentparent` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `top` int(11) DEFAULT '1' COMMENT '是否空置顶部',
  `isNews` int(11) DEFAULT '0' COMMENT '是否列入动态',
  `style` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '样式',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '标题',
  `titleAbbre` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '标题简称',
  `titleColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '首标题颜色',
  `titleShadowColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '首标题阴影颜色',
  `keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '关键字',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '描述',
  `backgroundImage` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '背景图',
  `keynote` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '副标题',
  `keynoteColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '副标题颜色',
  `keynoteShadowColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '副标题阴影颜色',
  `lastChildTitle` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '末尾项',
  `lastChildTitleAbbre` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '末尾项简称',
  `lastChildTitleUrl` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '末尾项链接',
  `sort` float DEFAULT '0' COMMENT '排序值',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='主体内容';

-- 正在导出表  eogee.contentparent 的数据：~5 rows (大约)
DELETE FROM `contentparent`;
/*!40000 ALTER TABLE `contentparent` DISABLE KEYS */;
INSERT INTO `contentparent` (`id`, `top`, `isNews`, `style`, `title`, `titleAbbre`, `titleColor`, `titleShadowColor`, `keywords`, `description`, `backgroundImage`, `keynote`, `keynoteColor`, `keynoteShadowColor`, `lastChildTitle`, `lastChildTitleAbbre`, `lastChildTitleUrl`, `sort`, `deleted_at`) VALUES
	(1, 1, 1, '', '软件产品', '产品', '', '', '仓库,会员,项目,管理,系统,软件', 'EOGEE岳极技术倾力打造超高性价比各类企业管理系统软件，助力企业实现数字化经营，提升生产经营效率，使企业实现小投入，大越级！', '/Resource/pic/软件产品背景图.jpg', 'Software product', '', '', '全部产品', '全部', '/contentParent/detail/1', 3, NULL),
	(2, 1, 1, '', 'WEB开发课程', '课程', '', '', 'WEB课程,php,JS,mysql,Nodejs', 'EOGEE岳极技术倾力打造WEB编程课程，快速上手WEB应用开发，免费、开源、共享！', '/Resource/pic/精品课堂背景图.jpg', 'WEB Course', '', '', '全部课程', '全部', '/contentParent/detail/18', 1, NULL),
	(3, 1, 0, '', '限时活动', '活动', '', '', '优惠,活动,软件产品,岳极技术,EOGEE', '小投入，大越级！限时活动，限时优惠', '/Resource/pic/活动中心背景图.jpg', 'Limited time event', '', '', '全部活动', '全部', '/contentParent/detail/19', 4, NULL),
	(4, 1, 0, '', '咨询服务', '服务', '', '', '环保,安全,技术咨询服务,商务服务,建站', 'EOGEE岳极技术及专业第三方服务商，可为企业提供专业的技术咨询服务，使企业从立项阶段到投产运营阶段各类技术咨询任务均能一站式高效完成！', '/Resource/pic/咨询服务背景图.jpg', 'Survice', '', '', '全部服务', '全部', '/contentParent/detail/17', 2, NULL);
/*!40000 ALTER TABLE `contentparent` ENABLE KEYS */;

-- 导出  表 eogee.footurl 结构
CREATE TABLE IF NOT EXISTS `footurl` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '名称',
  `colorCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '颜色代码',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '链接地址',
  `blank` int(11) DEFAULT '0' COMMENT '是否新页面打开',
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '类型',
  `sort` float DEFAULT '0' COMMENT '排序值',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='底部链接';

-- 正在导出表  eogee.footurl 的数据：~5 rows (大约)
DELETE FROM `footurl`;
/*!40000 ALTER TABLE `footurl` DISABLE KEYS */;
INSERT INTO `footurl` (`id`, `name`, `colorCode`, `url`, `blank`, `type`, `sort`, `deleted_at`) VALUES
	(1, '卷不卷', '', 'https://www.juanbujuan.net', 0, '友情链接', 2, NULL),
	(2, '申请友链(QQ:3886370035）', NULL, 'https://www.eogee.com', 0, '友情链接', 1, NULL),
	(3, '河北德百', '#23A7E8', 'http://www.dbyo.com', 0, '赞助商', 4, NULL),
	(4, '曲率驱动', '#F7672D', 'http://www.curdrive.com', 0, '赞助商', 3, NULL),
	(5, '免责声明', '', '/singlePage/detail/3', 0, '内部链接', 0, NULL);
/*!40000 ALTER TABLE `footurl` ENABLE KEYS */;

-- 导出  表 eogee.log 结构
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'IP',
  `userId` int(11) DEFAULT NULL COMMENT '用户ID',
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户名',
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '访问路径',
  `userAgent` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT '浏览器信息',
  `statusCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '状态码',
  `referrer` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '来源',
  `requestMethod` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '请求方式',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='访问日志';

-- 正在导出表  eogee.log 的数据：~0 rows (大约)
DELETE FROM `log`;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;

-- 导出  表 eogee.news 结构
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `top` int(11) DEFAULT '1' COMMENT '是否空置顶部',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '标题',
  `titleColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '首标题颜色',
  `titleShadowColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '首标题阴影颜色',
  `keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '关键字',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '描述',
  `backgroundImage` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '背景图',
  `keynote` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '副标题',
  `keynoteColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '副标题颜色',
  `keynoteShadowColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '副标题阴影颜色'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='最新动态';

-- 正在导出表  eogee.news 的数据：~0 rows (大约)
DELETE FROM `news`;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `top`, `title`, `titleColor`, `titleShadowColor`, `keywords`, `description`, `backgroundImage`, `keynote`, `keynoteColor`, `keynoteShadowColor`) VALUES
	(1, 1, '最新动态', '', 'white', '最新动态', '最新动态', '/Resource/pic/最新动态背景图.jpg', 'News', '', 'white');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;

-- 导出  表 eogee.permission 结构
CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `parentId` int(11) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '权限名称',
  `url` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '链接',
  `sort` int(11) DEFAULT '0' COMMENT '排序值',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_permission_permission` (`parentId`),
  CONSTRAINT `FK_permission_permission` FOREIGN KEY (`parentId`) REFERENCES `permission` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='权限明细';

-- 正在导出表  eogee.permission 的数据：~0 rows (大约)
DELETE FROM `permission`;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` (`id`, `parentId`, `name`, `url`, `sort`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, '轮播图设置', '/basicInfo/list', 10, '2024-12-30 06:09:36', '2024-12-30 06:09:36', NULL),
	(2, 1, '轮播图设置', '/carousel/list', 9, '2024-12-30 06:09:57', '2024-12-30 06:14:27', NULL),
	(3, 1, '底部链接', '/footUrl/list', 8, '2024-12-30 06:10:13', '2024-12-30 06:14:33', NULL),
	(4, 2, '主体内容', '/contentParent/list', 10, '2024-12-30 06:11:33', '2024-12-30 06:13:57', NULL),
	(5, 2, '单页内容', '/singlePage/list', 9, '2024-12-30 06:11:51', '2024-12-30 06:14:03', NULL),
	(6, 2, '最新动态', '/news/list', 8, '2024-12-30 06:12:09', '2024-12-30 06:14:08', NULL),
	(7, 3, '用户管理', '/user/list', 10, '2024-12-30 06:13:00', '2024-12-30 06:14:46', NULL),
	(8, 3, '角色管理', '/role/list', 9, '2024-12-30 06:13:15', '2024-12-30 06:14:50', NULL),
	(9, 3, '权限管理', '/permissionParent/list', 8, '2024-12-30 06:13:41', '2024-12-30 06:14:55', NULL);
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;

-- 导出  表 eogee.permissionparent 结构
CREATE TABLE IF NOT EXISTS `permissionparent` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '权限名称',
  `url` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '链接',
  `sort` int(11) DEFAULT '0' COMMENT '排序值',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='权限管理';

-- 正在导出表  eogee.permissionparent 的数据：~0 rows (大约)
DELETE FROM `permissionparent`;
/*!40000 ALTER TABLE `permissionparent` DISABLE KEYS */;
INSERT INTO `permissionparent` (`id`, `name`, `url`, `sort`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '首页设置', '', 10, '2024-12-30 06:08:32', '2024-12-30 06:08:32', NULL),
	(2, '内容中心', '', 9, '2024-12-30 06:11:20', '2024-12-30 06:11:20', NULL),
	(3, '用户管理', '', 8, '2024-12-30 06:12:45', '2024-12-30 06:12:45', NULL);
/*!40000 ALTER TABLE `permissionparent` ENABLE KEYS */;

-- 导出  表 eogee.role 结构
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '角色名称',
  `sort` int(11) DEFAULT '0' COMMENT '排序值',
  `permission` text COLLATE utf8_unicode_ci COMMENT '拥有权限',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='角色管理';

-- 正在导出表  eogee.role 的数据：~2 rows (大约)
DELETE FROM `role`;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`, `name`, `sort`, `permission`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '超级管理员', 10, '1', '2024-12-28 21:03:55', '2024-12-30 03:28:13', NULL),
	(2, '编辑人员', 0, '[{"title":"午餐","id":2,"spread":true,"checked":true,"children":[{"title":"藜蒿炒腊肉","id":8},{"title":"西湖醋鱼","id":9},{"title":"小白菜","id":10},{"title":"海带排骨汤","id":11}]},{"title":"夜宵","id":4,"spread":true,"children":[{"title":"小龙虾","id":14,"checked":true},{"title":"香辣蟹","id":15,"checked":true}]}]', '2024-12-28 21:04:58', '2024-12-30 05:06:49', NULL);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- 导出  表 eogee.singlepage 结构
CREATE TABLE IF NOT EXISTS `singlepage` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `top` int(11) DEFAULT '1' COMMENT '是否空置顶部',
  `inNav` int(11) DEFAULT '1' COMMENT '是否列入导航菜单',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '首标题',
  `titleColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '首标题颜色',
  `titleShadowColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '首标题阴影颜色',
  `keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '关键字',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '描述',
  `backgroundImage` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '背景图',
  `keynote` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '副标题',
  `keynoteColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '副标题颜色',
  `keynoteShadowColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '副标题阴影颜色',
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '内容',
  `contentColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '内容颜色',
  `contentShadowColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '内容阴影颜色',
  `detail` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT '详情',
  `detailColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '详情颜色',
  `detailShadowColor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '详情阴影颜色',
  `sort` float DEFAULT '0' COMMENT '排序值',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='单页内容';

-- 正在导出表  eogee.singlepage 的数据：~4 rows (大约)
DELETE FROM `singlepage`;
/*!40000 ALTER TABLE `singlepage` DISABLE KEYS */;
INSERT INTO `singlepage` (`id`, `top`, `inNav`, `title`, `titleColor`, `titleShadowColor`, `keywords`, `description`, `backgroundImage`, `keynote`, `keynoteColor`, `keynoteShadowColor`, `content`, `contentColor`, `contentShadowColor`, `detail`, `detailColor`, `detailShadowColor`, `sort`, `deleted_at`) VALUES
	(1, 1, 1, '关于我们', 'black', 'white', '关于我们', '关于我们', '/Resource/pic/关于我们背景图.jpg', 'About us', 'black', 'white', '关于我们', 'black', 'white', '', '', '', 0, NULL),
	(2, 1, 1, '技术支持', 'black', 'white', '技术支持', '技术支持', '/Resource/pic/技术支持背景图.jpg', 'Support', 'black', 'white', '技术支持', '', '', '', '', '', 0, NULL),
	(3, 1, 0, '免责声明', '', '', '免责声明', '免责声明', '/Resource/pic/免责声明背景图.png', 'Disclaimer', '', '', '免责声明', '', '', '', '', '', 0, NULL),
	(4, 1, 1, '工具软件', '', '', '工具软件', '工具软件', '/Resource/pic/工具软件背景图.png', 'Toolsoftware', '', '', '工具软件', '', '', '', '', '', 0, NULL);
/*!40000 ALTER TABLE `singlepage` ENABLE KEYS */;

-- 导出  表 eogee.user 结构
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `identity` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '身份',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '密码',
  `adminRoleId` int(11) DEFAULT NULL COMMENT '角色ID',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户管理';

-- 正在导出表  eogee.user 的数据：~4 rows (大约)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `identity`, `password`, `adminRoleId`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'admin', '管理员', '$2y$10$t7Z.3swAaTgaJJhSWOrXCOKhfDxzp0ad2K/gUY0NP2oxcvHgO.wN6', 1, '2024-12-17 21:26:28', '2024-12-30 03:19:22', NULL),
	(2, 'double', '管理员', '$2y$10$DXXUX39Le0JbBXuD5t8Sd.T8Xr41qmgk.gSWUIVLiI.ysTzubkK9i', 1, '2024-10-13 05:13:20', '2024-12-30 03:20:21', NULL),
	(3, 'chenzehui', '管理员', '$2y$10$q6jCiZ6F8AnvvsO.jxHM6uqvvQN7Vqtu6L0/pB1dFKOw5DE6pKTnS', 1, '2024-10-13 05:13:22', '2024-12-30 03:19:35', NULL),
	(4, '18713501125', '管理员', '$2y$10$nZqkIuu2FxeodBG3hBw2PeFhtLKO7BfS/SqVytKO7GHmOn8EHT.jW', 1, '2024-10-13 05:13:23', '2024-12-30 03:23:55', NULL),
	(5, 'eogee', '管理员', '$2y$10$TKGtbCW7Yr.k.JGay.vqsO6mMSRmtw9IZBzTeMPAvPLWVBqs09t/S', 1, '2024-10-13 05:13:24', '2024-12-30 03:20:50', NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
