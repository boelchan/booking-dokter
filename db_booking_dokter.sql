/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 100113
Source Host           : 127.0.0.1:3306
Source Database       : db_booking_dokter

Target Server Type    : MYSQL
Target Server Version : 100113
File Encoding         : 65001

Date: 2016-12-26 14:50:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_nama` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `is_active` int(1) NOT NULL,
  `is_parent` int(1) NOT NULL,
  `controller` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', 'Master', '#', 'fa fa-home fa-lg', '1', '1', '0', '', '2016-11-08 20:52:03', '2016-11-08 20:52:03', null);
INSERT INTO `menu` VALUES ('2', 'Transaksi', '#', 'fa fa-list fa-lg', '4', '1', '0', null, '2016-11-08 20:58:09', null, null);
INSERT INTO `menu` VALUES ('53', 'Pasien', 'm_user', 'fa', '1', '1', '1', '', '2016-11-08 20:53:55', null, null);
INSERT INTO `menu` VALUES ('54', 'Jadwal', 't_layanan', 'fa', '2', '1', '1', '', '2016-11-08 20:56:36', null, null);
INSERT INTO `menu` VALUES ('55', 'Antrian', 't_antrian', 'fa', '1', '1', '2', '', '2016-11-08 20:57:06', null, null);

-- ----------------------------
-- Table structure for m_hari
-- ----------------------------
DROP TABLE IF EXISTS `m_hari`;
CREATE TABLE `m_hari` (
  `hari_id` int(11) NOT NULL AUTO_INCREMENT,
  `hari_nama` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`hari_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_hari
-- ----------------------------
INSERT INTO `m_hari` VALUES ('1', 'Senin', null, null, null);
INSERT INTO `m_hari` VALUES ('2', 'Selasa', null, null, null);
INSERT INTO `m_hari` VALUES ('3', 'Rabu', null, null, null);
INSERT INTO `m_hari` VALUES ('4', 'Kamis', null, null, null);
INSERT INTO `m_hari` VALUES ('5', 'Jumat', null, '2016-12-25 16:52:06', null);
INSERT INTO `m_hari` VALUES ('6', 'Sabtu', null, null, null);
INSERT INTO `m_hari` VALUES ('7', 'Minggu', null, null, null);

-- ----------------------------
-- Table structure for m_level
-- ----------------------------
DROP TABLE IF EXISTS `m_level`;
CREATE TABLE `m_level` (
  `level_id` int(11) NOT NULL,
  `level_nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_level
-- ----------------------------
INSERT INTO `m_level` VALUES ('1', 'Admin', null, null, '2016-12-25 21:37:04');
INSERT INTO `m_level` VALUES ('2', 'Operator', null, null, null);
INSERT INTO `m_level` VALUES ('3', 'Pasien', null, null, null);

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `user_pass` varchar(255) DEFAULT NULL,
  `no_rm` varchar(255) DEFAULT NULL,
  `level` int(1) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(1) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `no_rm` (`no_rm`),
  KEY `level` (`level`),
  CONSTRAINT `m_user_ibfk_1` FOREIGN KEY (`level`) REFERENCES `m_level` (`level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES ('1', 'admin', 'admin', '1', '1', 'Administrator', 'l', null, null, null, '2016-12-25 20:44:53', '2016-12-25 20:44:53', null);
INSERT INTO `m_user` VALUES ('2', '2', '2', '2', '2', 'Operator', 'l', '0000-00-00', '', '', '2016-12-25 20:45:02', '2016-12-25 17:06:09', null);
INSERT INTO `m_user` VALUES ('3', 'pasien1', 'pasien123', 'rm10', '3', 'nurul', 'p', '0000-00-00', 'dsfhjk', '7897', '2016-12-25 20:45:22', '2016-12-26 04:16:23', null);
INSERT INTO `m_user` VALUES ('18', 'pasien2', 'pasien2', '12', '3', 'naral3', 'p', '2015-07-16', 'asdfhjk', '9089', '2016-12-25 17:22:42', '2016-12-26 02:47:18', null);
INSERT INTO `m_user` VALUES ('19', 'bulyan', 'bulyan', '123', '3', 'bulyan', 'l', '2014-06-10', 'sfjl', '098779', '2016-12-26 02:34:17', null, null);
INSERT INTO `m_user` VALUES ('20', '3', '3', '1234', '3', 'pasien3', 'l', '2015-07-16', 'daskjhf', 'hjkshdjkfh', '2016-12-26 02:35:51', null, null);
INSERT INTO `m_user` VALUES ('21', 'pasien4', 'pasien4', '1235', '3', 'hfksdj', 'l', '2014-06-17', 'djkjfk', 'hskjdfh', '2016-12-26 02:45:24', null, null);

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `status_id` varchar(255) NOT NULL,
  `status_nama` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES ('1', 'Diterima', '', '2016-12-25 20:23:14', '2016-12-25 23:50:12', null);
INSERT INTO `status` VALUES ('2', 'Periksa', null, null, '2016-12-25 23:52:19', null);
INSERT INTO `status` VALUES ('3', 'Selesai', '', '2016-12-25 20:23:40', '2016-12-25 23:51:03', null);
INSERT INTO `status` VALUES ('4', 'Bayar', '', null, '2016-12-25 23:51:04', null);
INSERT INTO `status` VALUES ('5', 'Batal', null, null, '2016-12-25 23:51:05', null);

-- ----------------------------
-- Table structure for t_antrian
-- ----------------------------
DROP TABLE IF EXISTS `t_antrian`;
CREATE TABLE `t_antrian` (
  `antrian_id` int(11) NOT NULL AUTO_INCREMENT,
  `layanan_id` int(11) DEFAULT NULL,
  `no_rm` varchar(255) DEFAULT NULL,
  `antrian_no` int(11) DEFAULT NULL,
  `tgl_pesan` date DEFAULT NULL,
  `diagnosa` text,
  `biaya` int(11) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`antrian_id`),
  KEY `layanan_id` (`layanan_id`),
  KEY `status` (`status`),
  KEY `no_rm` (`no_rm`),
  CONSTRAINT `t_antrian_ibfk_1` FOREIGN KEY (`layanan_id`) REFERENCES `t_layanan` (`layanan_id`),
  CONSTRAINT `t_antrian_ibfk_3` FOREIGN KEY (`status`) REFERENCES `status` (`status_id`),
  CONSTRAINT `t_antrian_ibfk_4` FOREIGN KEY (`no_rm`) REFERENCES `m_user` (`no_rm`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_antrian
-- ----------------------------
INSERT INTO `t_antrian` VALUES ('3', '2', 'rm10', '1', null, 'fklajfkljaksjfksl', '26000', '3', '2016-12-25 17:47:23', '2016-12-25 18:04:23', null);
INSERT INTO `t_antrian` VALUES ('4', '2', '123', '3', null, null, null, '1', '2016-12-26 03:58:27', null, null);
INSERT INTO `t_antrian` VALUES ('5', '2', '123', '0', null, null, null, '1', '2016-12-26 03:58:54', null, null);
INSERT INTO `t_antrian` VALUES ('6', '3', '123', '0', null, null, null, '1', '2016-12-26 04:01:40', null, null);
INSERT INTO `t_antrian` VALUES ('7', '2', '123', '0', null, null, null, '1', '2016-12-26 04:02:00', null, null);
INSERT INTO `t_antrian` VALUES ('8', '3', '123', '0', null, null, null, '1', '2016-12-26 04:02:24', null, null);
INSERT INTO `t_antrian` VALUES ('9', '3', '123', '0', null, null, null, '1', '2016-12-26 04:04:40', null, null);
INSERT INTO `t_antrian` VALUES ('10', '3', '123', '0', null, null, null, '1', '2016-12-26 04:05:05', null, null);
INSERT INTO `t_antrian` VALUES ('11', '3', '123', '0', null, null, null, '1', '2016-12-26 04:05:09', null, null);
INSERT INTO `t_antrian` VALUES ('12', '2', '123', '0', null, null, null, '1', '2016-12-26 04:05:15', null, null);
INSERT INTO `t_antrian` VALUES ('13', '2', '123', '0', null, null, null, '1', '2016-12-26 04:05:33', null, null);
INSERT INTO `t_antrian` VALUES ('14', '2', '123', '0', null, null, null, '1', '2016-12-26 04:05:56', null, null);
INSERT INTO `t_antrian` VALUES ('15', '2', '123', '0', null, null, null, '1', '2016-12-26 04:06:51', null, null);
INSERT INTO `t_antrian` VALUES ('16', '2', '123', '0', null, null, null, '1', '2016-12-26 04:06:57', null, null);
INSERT INTO `t_antrian` VALUES ('17', '2', '123', '0', null, null, null, '1', '2016-12-26 04:08:03', null, null);
INSERT INTO `t_antrian` VALUES ('18', '2', '123', '0', null, null, null, '1', '2016-12-26 04:08:34', null, null);
INSERT INTO `t_antrian` VALUES ('19', '2', '123', '0', null, null, null, '1', '2016-12-26 04:09:04', null, null);
INSERT INTO `t_antrian` VALUES ('20', '2', '123', '0', null, null, null, '1', '2016-12-26 04:09:34', null, null);
INSERT INTO `t_antrian` VALUES ('21', '2', '123', '0', null, null, null, '1', '2016-12-26 04:10:30', null, null);

-- ----------------------------
-- Table structure for t_layanan
-- ----------------------------
DROP TABLE IF EXISTS `t_layanan`;
CREATE TABLE `t_layanan` (
  `layanan_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_hari_id` int(11) DEFAULT NULL,
  `jam_buka` time DEFAULT NULL,
  `jam_tutup` time DEFAULT NULL,
  `max_antrian` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`layanan_id`),
  KEY `m_hari_id` (`m_hari_id`),
  CONSTRAINT `t_layanan_ibfk_1` FOREIGN KEY (`m_hari_id`) REFERENCES `m_hari` (`hari_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_layanan
-- ----------------------------
INSERT INTO `t_layanan` VALUES ('2', '1', '23:29:26', '01:29:33', '10', null, null, null);
INSERT INTO `t_layanan` VALUES ('3', '3', '03:30:15', '08:30:23', '5', null, null, null);

-- ----------------------------
-- View structure for v_jadwal
-- ----------------------------
DROP VIEW IF EXISTS `v_jadwal`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `v_jadwal` AS SELECT
	t_layanan.layanan_id,
	t_layanan.jam_buka,
	t_layanan.jam_tutup,
	t_layanan.max_antrian,
	t_layanan.created_at,
	t_layanan.updated_at,
	t_layanan.deleted_at,
	m_hari.hari_id,
	m_hari.hari_nama
FROM
	t_layanan
LEFT JOIN m_hari ON t_layanan.m_hari_id = m_hari.hari_id ;
