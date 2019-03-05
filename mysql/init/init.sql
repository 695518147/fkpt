use mysql;
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'rootroot';
# update user set host = '%' where user = 'root';

CREATE DATABASE IF NOT EXISTS fkpt  DEFAULT CHARSET utf8 COLLATE utf8_general_ci;

use fkpt;
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ayangw_blacklist
-- ----------------------------
DROP TABLE IF EXISTS `ayangw_blacklist`;
CREATE TABLE `ayangw_blacklist` (
                                  `id` int(11) NOT NULL AUTO_INCREMENT,
                                  `type` int(11) DEFAULT NULL,
                                  `date` datetime DEFAULT NULL,
                                  `data` varchar(200) DEFAULT NULL,
                                  `remarks` text,
                                  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ayangw_config
-- ----------------------------
DROP TABLE IF EXISTS `ayangw_config`;
CREATE TABLE `ayangw_config` (
                               `ayangw_k` varchar(255) NOT NULL DEFAULT '',
                               `ayangw_v` text,
                               PRIMARY KEY (`ayangw_k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ayangw_config
-- ----------------------------
BEGIN;
INSERT INTO `ayangw_config` VALUES ('title', '个人发卡网');
INSERT INTO `ayangw_config` VALUES ('keywords', '个人发卡网');
INSERT INTO `ayangw_config` VALUES ('description', 'QQ：781061178，下载地址：www.qzoner.cn');
INSERT INTO `ayangw_config` VALUES ('zzqq', '3002710880');
INSERT INTO `ayangw_config` VALUES ('notice2', '付款后按提示点击确定跳转到提取页面，不可提前关闭窗口！否则无法提取到卡密！');
INSERT INTO `ayangw_config` VALUES ('notice3', '提取码是订单编号 或者 您的联系方式！');
INSERT INTO `ayangw_config` VALUES ('notice1', '提取卡密后请尽快激活使用或保存好，系统定期清除被提取的卡密');
INSERT INTO `ayangw_config` VALUES ('foot', '阿洋发卡网');
INSERT INTO `ayangw_config` VALUES ('dd_notice', '1.联系方式也可以作为你的提卡凭证<br>2.必须等待付款完成自动跳转，不可提前关闭页面，否则会导致订单失效，后果自负');
INSERT INTO `ayangw_config` VALUES ('admin', 'admin');
INSERT INTO `ayangw_config` VALUES ('pwd', 'f3b4e3b975e0484835e90514f8318e61');
INSERT INTO `ayangw_config` VALUES ('web_url', 'http://localhost');
INSERT INTO `ayangw_config` VALUES ('payapi', '1');
INSERT INTO `ayangw_config` VALUES ('epay_id', '201902287585');
INSERT INTO `ayangw_config` VALUES ('epay_key', '8b884fbbd0d15f1d5499f7e9fa02838c');
INSERT INTO `ayangw_config` VALUES ('showKc', '1');
INSERT INTO `ayangw_config` VALUES ('CC_Defender', '2');
INSERT INTO `ayangw_config` VALUES ('txprotect', '1');
INSERT INTO `ayangw_config` VALUES ('qqtz', '1');
INSERT INTO `ayangw_config` VALUES ('sqlv', '1041');
INSERT INTO `ayangw_config` VALUES ('mail_stmp', 'smtp.qq.com');
INSERT INTO `ayangw_config` VALUES ('mail_port', '465');
INSERT INTO `ayangw_config` VALUES ('mail_name', '695518147@qq.com');
INSERT INTO `ayangw_config` VALUES ('mail_pwd', 'splykddjogqbbehh');
INSERT INTO `ayangw_config` VALUES ('mail_title', '狂奔的蜗牛');
INSERT INTO `ayangw_config` VALUES ('submit', '修改');
INSERT INTO `ayangw_config` VALUES ('epay_url', '');
INSERT INTO `ayangw_config` VALUES ('create', '2019-03-03 22:58:54');
INSERT INTO `ayangw_config` VALUES ('showImgs', '1');
INSERT INTO `ayangw_config` VALUES ('cyapi', '1');
INSERT INTO `ayangw_config` VALUES ('cyid', '');
INSERT INTO `ayangw_config` VALUES ('cykey', '');
INSERT INTO `ayangw_config` VALUES ('cygg', '');
INSERT INTO `ayangw_config` VALUES ('syslog', '1');
INSERT INTO `ayangw_config` VALUES ('view', 'ocean');
COMMIT;

-- ----------------------------
-- Table structure for ayangw_goods
-- ----------------------------
DROP TABLE IF EXISTS `ayangw_goods`;
CREATE TABLE `ayangw_goods` (
                              `id` int(11) NOT NULL AUTO_INCREMENT,
                              `gName` varchar(255) DEFAULT NULL,
                              `gInfo` text,
                              `imgs` varchar(110) DEFAULT NULL,
                              `tpId` int(11) NOT NULL COMMENT 'Ã¦â€°â‚¬Ã¥Â±Å¾Ã¥Ë†â€ Ã§Â±Â»',
                              `price` float DEFAULT NULL,
                              `state` int(11) DEFAULT '1',
                              `sotr` int(4) DEFAULT '1',
                              `sales` int(11) DEFAULT '0',
                              PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ayangw_goods
-- ----------------------------
BEGIN;
INSERT INTO `ayangw_goods` VALUES (1, '测试-商品', '测试的', 'assets/goodsimg/1551626794.png', 1, 0.01, 1, 5, 0);
COMMIT;

-- ----------------------------
-- Table structure for ayangw_km
-- ----------------------------
DROP TABLE IF EXISTS `ayangw_km`;
CREATE TABLE `ayangw_km` (
                           `id` int(11) NOT NULL AUTO_INCREMENT,
                           `gid` int(11) NOT NULL,
                           `km` varchar(100) DEFAULT NULL,
                           `benTime` datetime DEFAULT NULL,
                           `endTime` datetime DEFAULT NULL,
                           `out_trade_no` varchar(100) DEFAULT NULL,
                           `trade_no` varchar(100) DEFAULT NULL,
                           `rel` varchar(50) DEFAULT NULL,
                           `stat` int(11) DEFAULT '0',
                           PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ayangw_km
-- ----------------------------
BEGIN;
INSERT INTO `ayangw_km` VALUES (1, 1, 'wwwwww\r', '2019-03-03 23:27:16', '2019-03-03 23:29:21', '2019232328202366', '860220190303232849694927', '3389309', 1);
INSERT INTO `ayangw_km` VALUES (2, 1, 'eeeeeee\r', '2019-03-03 23:27:17', NULL, NULL, NULL, NULL, 0);
INSERT INTO `ayangw_km` VALUES (3, 1, 'rrrrrrrrr\r', '2019-03-03 23:27:17', NULL, NULL, NULL, NULL, 0);
INSERT INTO `ayangw_km` VALUES (4, 1, 'tttttttt\r', '2019-03-03 23:27:17', NULL, NULL, NULL, NULL, 0);
INSERT INTO `ayangw_km` VALUES (5, 1, 'yyyyyyuu\r', '2019-03-03 23:27:17', NULL, NULL, NULL, NULL, 0);
INSERT INTO `ayangw_km` VALUES (6, 1, 'uuuuuuuuu\r', '2019-03-03 23:27:17', NULL, NULL, NULL, NULL, 0);
INSERT INTO `ayangw_km` VALUES (7, 1, 'uuuuuu555', '2019-03-03 23:27:17', NULL, NULL, NULL, NULL, 0);
COMMIT;

-- ----------------------------
-- Table structure for ayangw_order
-- ----------------------------
DROP TABLE IF EXISTS `ayangw_order`;
CREATE TABLE `ayangw_order` (
                              `id` int(11) NOT NULL AUTO_INCREMENT,
                              `out_trade_no` varchar(100) DEFAULT NULL,
                              `trade_no` varchar(100) DEFAULT NULL,
                              `gid` int(11) DEFAULT NULL,
                              `money` float DEFAULT NULL,
                              `rel` varchar(30) DEFAULT NULL,
                              `type` varchar(20) DEFAULT NULL,
                              `benTime` datetime DEFAULT NULL,
                              `endTime` datetime DEFAULT NULL,
                              `number` int(11) DEFAULT NULL,
                              `sta` int(11) DEFAULT '0',
                              `sendE` int(11) DEFAULT '0',
                              PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ayangw_order
-- ----------------------------
BEGIN;
INSERT INTO `ayangw_order` VALUES (1, '2019232328202366', '860220190303232849694927', 1, 0.01, '3389309', 'alipay', '2019-03-03 23:28:48', '2019-03-03 23:29:21', 1, 1, 0);
COMMIT;

-- ----------------------------
-- Table structure for ayangw_syslog
-- ----------------------------
DROP TABLE IF EXISTS `ayangw_syslog`;
CREATE TABLE `ayangw_syslog` (
                               `id` int(11) NOT NULL AUTO_INCREMENT,
                               `log_name` varchar(20) DEFAULT NULL,
                               `log_time` datetime DEFAULT NULL,
                               `log_txt` text,
                               PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ayangw_syslog
-- ----------------------------
BEGIN;
INSERT INTO `ayangw_syslog` VALUES (1, '交易成功！[回调处理]', '2019-03-03 23:29:21', '订单编号：2019232328202366;数量：1;成功提取数量：1');
COMMIT;

-- ----------------------------
-- Table structure for ayangw_type
-- ----------------------------
DROP TABLE IF EXISTS `ayangw_type`;
CREATE TABLE `ayangw_type` (
                             `id` int(11) NOT NULL AUTO_INCREMENT,
                             `tName` varchar(100) DEFAULT NULL,
                             `state` int(11) DEFAULT '0',
                             PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ayangw_type
-- ----------------------------
BEGIN;
INSERT INTO `ayangw_type` VALUES (1, '测试分类1', 1);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
