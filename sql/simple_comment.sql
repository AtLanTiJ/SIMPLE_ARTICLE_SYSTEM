/*
 Navicat Premium Dump SQL

 Source Server         : study
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : simple_comment

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 28/10/2024 19:14:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article`  (
  `article_id` int NOT NULL AUTO_INCREMENT,
  `author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `content` varchar(10240) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`article_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES (5, 'admin', ' 神经网络任务特定参数激活方法', ' 神经网络任务特定参数激活方法.txt');
INSERT INTO `article` VALUES (6, '小编', 'Hugging Face 漏洞概述', 'Hugging Face 漏洞概述.txt');

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment`  (
  `user_id` int NOT NULL,
  `article_id` int NOT NULL,
  `comment` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  INDEX `article_id`(`article_id` ASC) USING BTREE,
  CONSTRAINT `article_id` FOREIGN KEY (`article_id`) REFERENCES `article` (`article_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES (3, 5, 'hello');
INSERT INTO `comment` VALUES (3, 5, 'jksahgksdla');
INSERT INTO `comment` VALUES (3, 6, 'dgsdg');
INSERT INTO `comment` VALUES (2, 5, '好好好');
INSERT INTO `comment` VALUES (5, 5, 're');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE INDEX `user_name`(`user_name` ASC) USING BTREE,
  UNIQUE INDEX `user_id`(`user_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (2, 'admin', '$2y$10$p10w8Nt/5d2RMY6hyW44S.A62Y7MFE.uZdntBXOwbbfDwRk5tjvwe', 'admin');   --admin
INSERT INTO `user` VALUES (3, 'happy', '$2y$10$HlzIRThHpOXNX/z/duKwB.eZ3wmqGRgYg8ZcD/ak4Qt1lAl/WUzPm', 'users');   --123456
INSERT INTO `user` VALUES (4, '小编', '$2y$10$enfvANv30kMPOK/lTEos1Ow/t0OS.Puy5uzYx8pGlKlqbs4YgIu8q', 'editor');   --editor
INSERT INTO `user` VALUES (5, '11111', '$2y$10$9RgK8xKaCLyTl2u0tyLcm.x0b9Jjqe0nV1cdAjA34rEnCvaeY3ONK', 'users');   --11111

SET FOREIGN_KEY_CHECKS = 1;
