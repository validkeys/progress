/*
 Navicat Premium Data Transfer

 Source Server         : MAMP
 Source Server Type    : MySQL
 Source Server Version : 50137
 Source Host           : localhost
 Source Database       : pressly_progress

 Target Server Type    : MySQL
 Target Server Version : 50137
 File Encoding         : utf-8

 Date: 05/23/2012 09:25:34 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `milestones`
-- ----------------------------
DROP TABLE IF EXISTS `milestones`;
CREATE TABLE `milestones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `roadmap_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=148 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `milestones`
-- ----------------------------
BEGIN;
INSERT INTO `milestones` VALUES ('146', 'API Technology Stack Decision', '63', '0', '2012-05-22 15:40:30', '2012-05-22 15:40:30'), ('147', 'Develop API Endpoints', '63', '1', '2012-05-22 15:40:37', '2012-05-22 15:40:37');
COMMIT;

-- ----------------------------
--  Table structure for `roadmaps`
-- ----------------------------
DROP TABLE IF EXISTS `roadmaps`;
CREATE TABLE `roadmaps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `roadmaps`
-- ----------------------------
BEGIN;
INSERT INTO `roadmaps` VALUES ('63', 'V2', '2012-05-22 15:39:43', '2012-05-22 15:39:43'), ('64', 'V 2.1', '2012-05-22 15:39:49', '2012-05-22 15:39:49'), ('65', 'Website', '2012-05-22 15:39:55', '2012-05-22 15:39:55');
COMMIT;

-- ----------------------------
--  Table structure for `steps`
-- ----------------------------
DROP TABLE IF EXISTS `steps`;
CREATE TABLE `steps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `milestone_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `complete` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=214 DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 1;
