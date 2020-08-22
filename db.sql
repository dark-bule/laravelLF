/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-08-21 20:15:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tableadmin`
-- ----------------------------
DROP TABLE IF EXISTS `tableadmin`;
CREATE TABLE `tableadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_key` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `login_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `name` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `password` varchar(255) CHARACTER SET utf8 DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tableadmin
-- ----------------------------
INSERT INTO `tableadmin` VALUES ('1', 'C6O1zA8s', '2020-08-21 07:47:17', '1号管理者', '');
INSERT INTO `tableadmin` VALUES ('2', '85lqt4s2', '2020-08-07 13:58:25', '1号访问者', '');

-- ----------------------------
-- Table structure for `tablefound`
-- ----------------------------
DROP TABLE IF EXISTS `tablefound`;
CREATE TABLE `tablefound` (
  `found_id` int(11) NOT NULL AUTO_INCREMENT,
  `found_name` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `found_time` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `found_place` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `found_detail` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `found_img` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `found_person` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `found_phone` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `found_status` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `created_at` date DEFAULT NULL,
  `return_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`found_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tablefound
-- ----------------------------
INSERT INTO `tablefound` VALUES ('1', 'watch', '8.5晚', '食堂', '卡通手表', '1.gif', '小明', '19811732620', '1', '2020-08-05', null, null);
INSERT INTO `tablefound` VALUES ('2', 'cup1', '8.5晚上', '去食堂的路上', '玻璃的', '20200808/hQPDd19col.jpg', '小明', '19811732620', '1', '2020-08-05', null, '2020-08-08 11:37:02');
INSERT INTO `tablefound` VALUES ('3', 'watch1', '8.5晚', '食堂', '卡通手表', '1.gif', '小明', '19811732620', '0', '2020-08-05', '2020-08-07 10:36:09', null);

-- ----------------------------
-- Table structure for `tablelost`
-- ----------------------------
DROP TABLE IF EXISTS `tablelost`;
CREATE TABLE `tablelost` (
  `lost_id` int(11) NOT NULL AUTO_INCREMENT,
  `lost_name` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `lost_time` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `lost_place` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `lost_detail` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `lost_img` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `lost_person` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `lost_phone` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `lost_status` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `created_at` date DEFAULT NULL,
  `found_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`lost_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tablelost
-- ----------------------------
INSERT INTO `tablelost` VALUES ('1', 'cup', '8.5晚上', '去食堂的路上', '玻璃的', '20200808/v0jbwFUCAP.jpg', '小明', '19811732620', '1', '2020-08-05', '2020-08-08 19:24:20', '2020-08-08 11:24:20');
INSERT INTO `tablelost` VALUES ('2', 'cup1', '8.5晚上', '去食堂的路上', '玻璃的', '20200808/t5nV7SJCA1.jpg', '小明', '19811732620', '1', '2020-08-05', null, '2020-08-08 11:35:29');
INSERT INTO `tablelost` VALUES ('3', 'watch1', '8.5晚', '食堂', '卡通手表', null, '小明', '19811732620', '0', '2020-08-05', '2020-08-21 02:03:51', '2020-08-21 10:03:51');
INSERT INTO `tablelost` VALUES ('8', '水杯', '8.8中午', '地下室12', 'shubei，red', '20200821/uH6oNFMW4p.jpg', 'Alen', '19811732620', '1', '2020-08-21', null, null);
INSERT INTO `tablelost` VALUES ('5', '水杯', '8.8中午', '停车场', 'shubei', '20200808/ZQGoY31NT5.jpg', '小红', '19811732620', '1', '2020-08-08', null, null);
INSERT INTO `tablelost` VALUES ('6', '水杯', '8.8中午', '地下室', 'shubei，bule', '20200808/W4q0S1CUXu.jpg', 'Mike', '19811732620', '1', '2020-08-08', null, null);
INSERT INTO `tablelost` VALUES ('7', '水杯', '8.8中午', '地下室12', 'shubei，red', '20200808/V1Uz8ZAhlb.jpg', 'Alen', '19811732620', '1', '2020-08-08', null, null);
INSERT INTO `tablelost` VALUES ('9', '水杯', '8.8中午', '地下室12', 'shubei，red', '20200821/SCQzBOjoEU.jpg', 'Alen', '19811732620', '1', '2020-08-21', null, null);
INSERT INTO `tablelost` VALUES ('10', '水杯', '8.8中午', '地下室12', 'shubei，red', '20200821/CFjLS62951.jpg', 'Alen', '19811732620', '1', '2020-08-21', null, null);

-- ----------------------------
-- Table structure for `tableuser`
-- ----------------------------
DROP TABLE IF EXISTS `tableuser`;
CREATE TABLE `tableuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `password` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `isadmin` int(11) DEFAULT NULL,
  `picture` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `creat_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tableuser
-- ----------------------------
INSERT INTO `tableuser` VALUES ('1', '1号管理者', '123', '1', '20200808/EMRxWcX5vO.jpg', '2020-08-08 15:05:22');
INSERT INTO `tableuser` VALUES ('2', '1号访问者', '123', '0', '20200808/UIAJEsTeFd.jpg', '2020-08-08 15:05:29');
INSERT INTO `tableuser` VALUES ('3', '2号测试者', '123', '0', '20200808/CUeAlgmdML.1.png', '2020-08-08 04:58:09');
INSERT INTO `tableuser` VALUES ('4', '3号测试者', '123', '0', '20200808/YhLzWwOinC.jpg', '2020-08-08 06:18:35');
INSERT INTO `tableuser` VALUES ('5', '4test', '567', '0', '20200808/fwrO6Yn45G.jpg', '2020-08-08 06:20:31');
INSERT INTO `tableuser` VALUES ('6', '5test', '567', '0', '20200808/EMRxWcX5vO.jpg', '2020-08-08 06:25:50');
INSERT INTO `tableuser` VALUES ('7', '5test', '567', '0', '20200808/UIAJEsTeFd.jpg', '2020-08-08 06:26:00');
INSERT INTO `tableuser` VALUES ('8', '5test', '567', '0', '20200808/SVOn9YFWu0.jpg', '2020-08-08 06:32:53');
INSERT INTO `tableuser` VALUES ('9', '6号测试者', '123123', '0', '20200808/EecmBgdUVa.jpg', '2020-08-08 06:33:42');
INSERT INTO `tableuser` VALUES ('10', '2号管理者', '123123', '1', '20200821/K6yJEA1i3P.jpg', '2020-08-21 06:36:41');
