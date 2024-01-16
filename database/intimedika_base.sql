/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50728
Source Host           : localhost:3306
Source Database       : intimedika_base

Target Server Type    : MYSQL
Target Server Version : 50728
File Encoding         : 65001

Date: 2024-01-12 13:38:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for active_notification_unread
-- ----------------------------
DROP TABLE IF EXISTS `active_notification_unread`;
CREATE TABLE `active_notification_unread` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of active_notification_unread
-- ----------------------------
INSERT INTO `active_notification_unread` VALUES ('1', '0', '2022-12-26 07:46:45', '2022-12-26 07:46:45');

-- ----------------------------
-- Table structure for active_update_simrs
-- ----------------------------
DROP TABLE IF EXISTS `active_update_simrs`;
CREATE TABLE `active_update_simrs` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of active_update_simrs
-- ----------------------------
INSERT INTO `active_update_simrs` VALUES ('1', '1', '2022-12-28 15:08:47', '2022-12-28 15:08:47');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `jobs_queue_index` (`queue`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for kop_surat
-- ----------------------------
DROP TABLE IF EXISTS `kop_surat`;
CREATE TABLE `kop_surat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_image` varchar(20) DEFAULT NULL,
  `image` text,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kop_surat
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('3', '2019_12_14_000001_create_personal_access_tokens_table', '1');
INSERT INTO `migrations` VALUES ('4', '2022_08_31_132301_create_jobs_table', '1');
INSERT INTO `migrations` VALUES ('5', '2022_09_12_101504_create_notification_unread_table', '1');

-- ----------------------------
-- Table structure for mppsio_patient_mwl_item_backup
-- ----------------------------
DROP TABLE IF EXISTS `mppsio_patient_mwl_item_backup`;
CREATE TABLE `mppsio_patient_mwl_item_backup` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `merge_fk` bigint(20) DEFAULT NULL,
  `pat_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `pat_id_issuer` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `pat_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `pat_fn_sx` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `pat_gn_sx` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `pat_i_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `pat_p_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `pat_birthdate` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `pat_sex` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `pat_custom1` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `pat_custom2` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `pat_custom3` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `patient_fk` bigint(20) DEFAULT NULL,
  `sps_status` int(11) DEFAULT NULL,
  `sps_id` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `start_datetime` datetime NOT NULL,
  `station_aet` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `station_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `modality` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `perf_physician` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `perf_phys_fn_sx` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `perf_phys_gn_sx` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `perf_phys_i_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `perf_phys_p_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `req_proc_id` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `accession_no` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `study_iuid` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `updated_time` datetime DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `item_attrs` longblob,
  PRIMARY KEY (`pk`) USING BTREE,
  KEY `mwl_patient_fk` (`patient_fk`) USING BTREE,
  KEY `sps_status` (`sps_status`) USING BTREE,
  KEY `mwl_start_time` (`start_datetime`) USING BTREE,
  KEY `mwl_station_aet` (`station_aet`(16)) USING BTREE,
  KEY `mwl_station_name` (`station_name`(16)) USING BTREE,
  KEY `mwl_modality` (`modality`(16)) USING BTREE,
  KEY `mwl_perf_physician` (`perf_physician`(64)) USING BTREE,
  KEY `mwl_perf_phys_fn_sx` (`perf_phys_fn_sx`(16)) USING BTREE,
  KEY `mwl_perf_phys_gn_sx` (`perf_phys_gn_sx`(16)) USING BTREE,
  KEY `mwl_perf_phys_i_nm` (`perf_phys_i_name`(64)) USING BTREE,
  KEY `mwl_perf_phys_p_nm` (`perf_phys_p_name`(64)) USING BTREE,
  KEY `mwl_req_proc_id` (`req_proc_id`(16)) USING BTREE,
  KEY `mwl_accession_no` (`accession_no`(16)) USING BTREE,
  KEY `mwl_study_iuid` (`study_iuid`(64)) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mppsio_patient_mwl_item_backup
-- ----------------------------
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('5', null, '9', '171612131', 'PKU GROGOL P^^^^', 'P226', '*', null, null, '19680221', 'F', null, null, null, '64', '0', 'SPS-xx8', '2023-06-30 14:10:00', 'ANGELL_CCDDR', null, 'MR', '-^^^^', '*', '*', null, null, 'RP-008', '34369500000516334', '1.2.40.0.13.1.9.20231207.3436950000051633403807', '2023-12-07 10:23:16', '2023-12-07 10:23:16', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('6', null, '9', '171612131', 'PKU GROGOL P^^^^', 'P226', '*', null, null, '19680221', 'F', null, null, null, '64', '0', 'SPS-xx9', '2023-06-30 14:10:00', 'ANGELL_CCDDR', null, 'MR', '-^^^^', '*', '*', null, null, 'RP-009', '343695000005163345', '1.2.40.0.13.1.9.20231207.34369500000516334503609', '2023-12-07 10:23:21', '2023-12-07 10:23:21', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('7', null, '9', '171612131', 'PKU GROGOL P^^^^', 'P226', '*', null, null, '19680221', 'F', null, null, null, '64', '0', 'SPS-xx10', '2023-06-30 14:10:00', 'ANGELL_CCDDR', null, 'MR', '-^^^^', '*', '*', null, null, 'RP-0010', '343695000005163346', '1.2.40.0.13.1.9.20231207.34369500000516334603129', '2023-12-07 10:23:25', '2023-12-07 10:23:25', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('8', null, '9', '171612131', 'PKU GROGOL P^^^^', 'P226', '*', null, null, '19680221', 'F', null, null, null, '64', '0', 'SPS-xx11', '2023-06-30 14:10:00', 'ANGELL_CCDDR', null, 'MR', '-^^^^', '*', '*', null, null, 'RP-0011', '343695000005163346', '1.2.40.0.13.1.9.20231207.34369500000516334603882', '2023-12-07 10:24:25', '2023-12-07 10:24:25', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('9', null, '1000001544', '1000001544', 'MUHRIANI MUHTIAR^^^^', 'M655', '*', null, null, '19920702', 'F', null, null, null, '67', '0', 'SPS-xx12', '2023-12-07 11:39:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0012', '100000154433', '1.2.40.0.13.1.1000001544.20231207.1000001544332543969', '2023-12-07 10:30:11', '2023-12-07 10:30:11', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('10', null, '1000001544', '1000001544', 'MUHRIANI MUHTIAR^^^^', 'M655', '*', null, null, '19920702', 'F', null, null, null, '67', '0', 'SPS-xx13', '2023-12-07 11:39:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0013', '100000154416', '1.2.40.0.13.1.1000001544.20231207.1000001544162543353', '2023-12-07 12:50:18', '2023-12-07 12:50:18', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('11', null, '1000001360', '1000001360', 'CHRISTIANTO LOPOLISA^^^^', 'C623', '*', null, null, '19510424', 'M', null, null, null, '68', '0', 'SPS-xx14', '2023-12-07 10:53:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0014', '100000136011', '1.2.40.0.13.1.1000001360.20231207.1000001360111161525', '2023-12-07 12:52:53', '2023-12-07 12:52:53', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('12', null, '1000001630', '1000001630', 'HAJARAH^^^^', 'H260', '*', null, null, '19630210', 'F', null, null, null, '69', '0', 'SPS-xx15', '2023-12-07 11:08:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0015', '100000163071', '1.2.40.0.13.1.1000001630.20231207.100000163071116164', '2023-12-07 12:56:19', '2023-12-07 12:56:19', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('13', null, '1000001630', '1000001630', 'HAJARAH^^^^', 'H260', '*', null, null, '19630210', 'F', null, null, null, '69', '0', 'SPS-xx16', '2023-12-07 11:08:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0016', '100000163029', '1.2.40.0.13.1.1000001630.20231207.1000001630291161976', '2023-12-07 12:57:18', '2023-12-07 12:57:18', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('14', null, '1000001630', '1000001630', 'HAJARAH^^^^', 'H260', '*', null, null, '19630210', 'F', null, null, null, '69', '0', 'SPS-xx17', '2023-12-07 11:08:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0017', '100000163054', '1.2.40.0.13.1.1000001630.20231207.1000001630541161376', '2023-12-07 13:00:05', '2023-12-07 13:00:05', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('15', null, '1000000856', '1000000856', 'ANDI PARIDA LATIP^^^^', 'A531', '*', null, null, '19630812', 'F', null, null, null, '70', '0', 'SPS-xx18', '2023-12-07 14:28:00', 'ANGELL_CCDDR', null, 'CT', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0018', '100000085627', '1.2.40.0.13.1.1000000856.20231207.10000008562779863', '2023-12-07 13:19:41', '2023-12-07 13:19:41', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('16', null, '1000000856', '1000000856', 'ANDI PARIDA LATIP^^^^', 'A531', '*', null, null, '19630812', 'F', null, null, null, '70', '0', 'SPS-xx19', '2023-12-07 14:28:00', 'ANGELL_CCDDR', null, 'CT', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0019', '100000085631', '1.2.40.0.13.1.1000000856.20231207.100000085631798627', '2023-12-07 13:19:57', '2023-12-07 13:19:57', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('17', null, '1000000856', '1000000856', 'ANDI PARIDA LATIP^^^^', 'A531', '*', null, null, '19630812', 'F', null, null, null, '70', '0', 'SPS-xx20', '2023-12-07 14:28:00', 'ANGELL_CCDDR', null, 'CT', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0020', '100000085696', '1.2.40.0.13.1.1000000856.20231207.100000085696798740', '2023-12-07 13:27:31', '2023-12-07 13:27:31', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('18', null, '1000000856', '1000000856', 'ANDI PARIDA LATIP^^^^', 'A531', '*', null, null, '19630812', 'F', null, null, null, '70', '0', 'SPS-xx21', '2023-12-07 14:28:00', 'ANGELL_CCDDR', null, 'CT', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0021', '100000085617', '1.2.40.0.13.1.1000000856.20231207.100000085617798490', '2023-12-07 13:38:53', '2023-12-07 13:38:53', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('19', null, '1000000856', '1000000856', 'ANDI PARIDA LATIP^^^^', 'A531', '*', null, null, '19630812', 'F', null, null, null, '70', '0', 'SPS-xx22', '2023-12-07 14:28:00', 'ANGELL_CCDDR', null, 'CT', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0022', '10000008563', '1.2.40.0.13.1.1000000856.20231207.10000008563798289', '2023-12-07 13:42:25', '2023-12-07 13:42:25', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('20', null, '1000000856', '1000000856', 'ANDI PARIDA LATIP^^^^', 'A531', '*', null, null, '19630812', 'F', null, null, null, '70', '0', 'SPS-xx23', '2023-12-07 14:28:00', 'ANGELL_CCDDR', null, 'CT', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0023', '10000008568', '1.2.40.0.13.1.1000000856.20231207.10000008568798991', '2023-12-07 13:43:41', '2023-12-07 13:43:41', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('21', null, '1000000856', '1000000856', 'ANDI PARIDA LATIP^^^^', 'A531', '*', null, null, '19630812', 'F', null, null, null, '70', '0', 'SPS-xx24', '2023-12-07 14:28:00', 'ANGELL_CCDDR', null, 'CT', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0024', '100000085636', '1.2.40.0.13.1.1000000856.20231207.100000085636798981', '2023-12-07 13:46:03', '2023-12-07 13:46:03', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('22', null, '1000000856', '1000000856', 'ANDI PARIDA LATIP^^^^', 'A531', '*', null, null, '19630812', 'F', null, null, null, '70', '0', 'SPS-xx25', '2023-12-07 14:28:00', 'ANGELL_CCDDR', null, 'CT', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0025', '100000085623', '1.2.40.0.13.1.1000000856.20231207.10000008562379836', '2023-12-07 13:47:13', '2023-12-07 13:47:13', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('23', null, '1000000856', '1000000856', 'ANDI PARIDA LATIP^^^^', 'A531', '*', null, null, '19630812', 'F', null, null, null, '70', '0', 'SPS-xx26', '2023-12-07 14:28:00', 'ANGELL_CCDDR', null, 'CT', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0026', '100000085648', '1.2.40.0.13.1.1000000856.20231207.10000008564879840', '2023-12-07 13:47:21', '2023-12-07 13:47:21', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('24', null, '1000000856', '1000000856', 'ANDI PARIDA LATIP^^^^', 'A531', '*', null, null, '19630812', 'F', null, null, null, '70', '0', 'SPS-xx27', '2023-12-07 14:28:00', 'ANGELL_CCDDR', null, 'CT', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0027', '100000085672', '1.2.40.0.13.1.1000000856.20231207.100000085672798725', '2023-12-07 13:48:33', '2023-12-07 13:48:33', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('25', null, '1000000856', '1000000856', 'ANDI PARIDA LATIP^^^^', 'A531', '*', null, null, '19630812', 'F', null, null, null, '70', '0', 'SPS-xx28', '2023-12-07 14:28:00', 'ANGELL_CCDDR', null, 'CT', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0028', '100000085641', '1.2.40.0.13.1.1000000856.20231207.100000085641798485', '2023-12-07 13:50:18', '2023-12-07 13:50:18', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('26', null, '1000000856', '1000000856', 'ANDI PARIDA LATIP^^^^', 'A531', '*', null, null, '19630812', 'F', null, null, null, '70', '0', 'SPS-xx29', '2023-12-07 14:28:00', 'ANGELL_CCDDR', null, 'CT', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0029', '100000085656', '1.2.40.0.13.1.1000000856.20231207.100000085656798345', '2023-12-07 13:59:00', '2023-12-07 13:59:00', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('27', null, '1000000856', '1000000856', 'ANDI PARIDA LATIP^^^^', 'A531', '*', null, null, '19630812', 'F', null, null, null, '70', '0', 'SPS-xx30', '2023-12-07 14:28:00', 'ANGELL_CCDDR', null, 'CT', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0030', '10000008565', '1.2.40.0.13.1.1000000856.20231207.10000008565798479', '2023-12-07 14:02:47', '2023-12-07 14:02:47', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('28', null, '0310195188', '0310195188', 'AQILAH HAYATUNNIZA^^^^', 'A243', '*', null, null, '20031006', 'F', null, null, null, '71', '0', 'SPS-xx31', '2023-12-07 15:58:00', 'ANGELL_CCDDR', null, 'CT', 'NASIR TAYYEB, A. MD. RAD^^^^', 'N263', '*', null, null, 'RP-0031', '031019518821', '1.2.40.0.13.1.0310195188.20231207.03101951882179828', '2023-12-07 14:49:04', '2023-12-07 14:49:04', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('29', null, '0310195188', '0310195188', 'AQILAH HAYATUNNIZA^^^^', 'A243', '*', null, null, '20031006', 'F', null, null, null, '71', '0', 'SPS-xx32', '2023-12-07 15:58:00', 'ANGELL_CCDDR', null, 'CT', 'NASIR TAYYEB, A. MD. RAD^^^^', 'N263', '*', null, null, 'RP-0032', '031019518853', '1.2.40.0.13.1.0310195188.20231207.031019518853798456', '2023-12-07 14:50:27', '2023-12-07 14:50:27', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('30', null, '0310195188', '0310195188', 'AQILAH HAYATUNNIZA^^^^', 'A243', '*', null, null, '20031006', 'F', null, null, null, '71', '0', 'SPS-xx33', '2023-12-07 15:58:00', 'ANGELL_CCDDR', null, 'CT', 'NASIR TAYYEB, A. MD. RAD^^^^', 'N263', '*', null, null, 'RP-0033', '031019518818', '1.2.40.0.13.1.0310195188.20231207.031019518818798358', '2023-12-07 14:51:50', '2023-12-07 14:51:50', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('31', null, '0310195188', '0310195188', 'AQILAH HAYATUNNIZA^^^^', 'A243', '*', null, null, '20031006', 'F', null, null, null, '71', '0', 'SPS-xx34', '2023-12-07 15:58:00', 'ANGELL_CCDDR', null, 'CT', 'NASIR TAYYEB, A. MD. RAD^^^^', 'N263', '*', null, null, 'RP-0034', '031019518815', '1.2.40.0.13.1.0310195188.20231207.031019518815798308', '2023-12-07 15:00:11', '2023-12-07 15:00:11', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('32', null, '1000001612', '1000001612', 'AHSANDI RESKI^^^^', 'A253', '*', null, null, '19981017', 'M', null, null, null, '72', '0', 'SPS-xx35', '2023-12-07 16:16:00', 'ANGELL_CCDDR', null, 'CT', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0035', '100000161294', '1.2.40.0.13.1.1000001612.20231207.100000161294798985', '2023-12-07 15:07:04', '2023-12-07 15:07:04', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('33', null, '1000001617', '1000001617', 'BAGUS GUNAWAN^^^^', 'B225', '*', null, null, '19950701', 'M', null, null, null, '73', '0', 'SPS-xx36', '2023-12-08 09:13:00', 'ANGELL_CCDDR', null, 'CR', 'NASIR TAYYEB, A. MD. RAD^^^^', 'N263', '*', null, null, 'RP-0036', '100000161719', '1.2.40.0.13.1.1000001617.20231208.1000001617191161356', '2023-12-08 08:04:30', '2023-12-08 08:04:30', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('34', null, '1000001617', '1000001617', 'BAGUS GUNAWAN^^^^', 'B225', '*', null, null, '19950701', 'M', null, null, null, '73', '0', 'SPS-xx37', '2023-12-08 09:13:00', 'ANGELL_CCDDR', null, 'CT', 'NASIR TAYYEB, A. MD. RAD^^^^', 'N263', '*', null, null, 'RP-0037', '100000161738', '1.2.40.0.13.1.1000001617.20231208.100000161738798146', '2023-12-08 08:04:33', '2023-12-08 08:04:33', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('35', null, '1000001592', '1000001592', 'ALIMIN^^^^', 'A455', '*', null, null, '19601024', 'M', null, null, null, '74', '0', 'SPS-xx38', '2023-12-08 10:16:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0038', '20231018009956', '1.2.40.0.13.1.1000001592.20231208.202310180099561161264', '2023-12-08 09:07:18', '2023-12-08 09:07:18', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('36', null, '1000001592', '1000001592', 'ALIMIN^^^^', 'A455', '*', null, null, '19601024', 'M', null, null, null, '74', '0', 'SPS-xx39', '2023-12-08 10:16:00', 'ANGELL_CCDDR', null, 'CT', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0039', '20231018009993', '1.2.40.0.13.1.1000001592.20231208.2023101800999379828', '2023-12-08 09:07:20', '2023-12-08 09:07:20', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('37', null, '0310121694', '0310121694', 'MUKHAMAD  IBNU WISMOYO^^^^', 'M253', '*', null, null, '19980114', 'M', null, null, null, '75', '0', 'SPS-xx40', '2023-12-08 10:24:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0040', '20231116000483', '1.2.40.0.13.1.0310121694.20231208.202311160004831161258', '2023-12-08 09:16:29', '2023-12-08 09:16:29', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('38', null, '0310121694', '0310121694', 'MUKHAMAD  IBNU WISMOYO^^^^', 'M253', '*', null, null, '19980114', 'M', null, null, null, '75', '0', 'SPS-xx41', '2023-12-08 10:24:00', 'ANGELL_CCDDR', null, 'CT', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0041', '20231116000431', '1.2.40.0.13.1.0310121694.20231208.20231116000431798583', '2023-12-08 09:16:31', '2023-12-08 09:16:31', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('39', null, '0310121694', '0310121694', 'MUKHAMAD  IBNU WISMOYO^^^^', 'M253', '*', null, null, '19980114', 'M', null, null, null, '75', '0', 'SPS-xx42', '2023-12-08 10:24:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0042', '20231116000485', '1.2.40.0.13.1.0310121694.20231208.202311160004851161273', '2023-12-08 09:32:03', '2023-12-08 09:32:03', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('40', null, '0310121694', '0310121694', 'MUKHAMAD  IBNU WISMOYO^^^^', 'M253', '*', null, null, '19980114', 'M', null, null, null, '75', '0', 'SPS-xx43', '2023-12-08 10:24:00', 'ANGELL_CCDDR', null, 'CT', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0043', '20231116000418', '1.2.40.0.13.1.0310121694.20231208.20231116000418798478', '2023-12-08 09:32:05', '2023-12-08 09:32:05', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('43', null, '1000001652', '1000001652', 'APRIAL ANGKASA PUTRA^^^^', 'A164', '*', null, null, '19990426', 'M', null, null, null, '77', '0', 'SPS-xx46', '2023-12-11 11:41:00', 'ANGELL_CCDDR', null, 'CR', 'NASIR TAYYEB, A. MD. RAD^^^^', 'N263', '*', null, null, 'RP-0046', '20231020008515', '1.2.40.0.13.1.1000001652.20231211.202310200085151161398', '2023-12-11 10:32:18', '2023-12-11 10:32:18', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('44', null, '1000001652', '1000001652', 'APRIAL ANGKASA PUTRA^^^^', 'A164', '*', null, null, '19990426', 'M', null, null, null, '77', '0', 'SPS-xx47', '2023-12-11 11:41:00', 'ANGELL_CCDDR', null, 'MR', 'NASIR TAYYEB, A. MD. RAD^^^^', 'N263', '*', null, null, 'RP-0047', '20231020008562', '1.2.40.0.13.1.1000001652.20231211.20231020008562170475', '2023-12-11 10:32:22', '2023-12-11 10:32:22', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('45', null, '1000001652', '1000001652', 'APRIAL ANGKASA PUTRA^^^^', 'A164', '*', null, null, '19990426', 'M', null, null, null, '77', '0', 'SPS-xx48', '2023-12-11 11:41:00', 'ANGELL_CCDDR', null, 'CR', 'NASIR TAYYEB, A. MD. RAD^^^^', 'N263', '*', null, null, 'RP-0048', '20231020008584', '1.2.40.0.13.1.1000001652.20231211.202310200085841161469', '2023-12-11 16:21:48', '2023-12-11 16:21:48', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('46', null, '1000001652', '1000001652', 'APRIAL ANGKASA PUTRA^^^^', 'A164', '*', null, null, '19990426', 'M', null, null, null, '77', '0', 'SPS-xx49', '2023-12-11 11:41:00', 'ANGELL_CCDDR', null, 'MR', 'NASIR TAYYEB, A. MD. RAD^^^^', 'N263', '*', null, null, 'RP-0049', '2023102000854', '1.2.40.0.13.1.1000001652.20231211.20231020008541704876', '2023-12-11 16:21:50', '2023-12-11 16:21:50', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('51', null, '1000001307', '1000001307', 'JOJOR MARGANDA HUTAGALUNG^^^^', 'J265', '*', null, null, '19890626', 'M', null, null, null, '80', '0', 'SPS-xx54', '2023-12-12 14:51:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0054', '2023100901145', '1.2.40.0.13.1.1000001307.20231212.20231009011452547696', '2023-12-12 13:41:31', '2023-12-12 13:41:30', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('52', null, '1000001307', '1000001307', 'JOJOR MARGANDA HUTAGALUNG^^^^', 'J265', '*', null, null, '19890626', 'M', null, null, null, '80', '0', 'SPS-xx55', '2023-12-12 14:51:00', 'ANGELL_CCDDR', null, 'CT', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0055', '20231009011460', '1.2.40.0.13.1.1000001307.20231212.20231009011460798523', '2023-12-12 13:41:32', '2023-12-12 13:41:32', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('53', null, '0310126684', '6110', 'NINDYA FEBRIYANI PUTRI^^^^', 'N531', '*', null, null, '19980220', 'F', null, null, null, '81', '0', 'SPS-xx56', '2023-12-15 07:37:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0056', '20231031001333', '1.2.40.0.13.1.0310126684.20231215.202310310013331161831', '2023-12-15 09:44:06', '2023-12-15 09:44:06', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('54', null, '0310126684', '6110', 'NINDYA FEBRIYANI PUTRI^^^^', 'N531', '*', null, null, '19980220', 'F', null, null, null, '81', '0', 'SPS-xx57', '2023-12-15 07:37:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0057', '20231031001382', '1.2.40.0.13.1.0310126684.20231215.202310310013821161371', '2023-12-15 09:44:44', '2023-12-15 09:44:44', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('55', null, '0310126684', '6110', 'NINDYA FEBRIYANI PUTRI^^^^', 'N531', '*', null, null, '19980220', 'F', null, null, null, '81', '0', 'SPS-xx58', '2023-12-15 07:37:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0058', '20231031001361', '1.2.40.0.13.1.0310126684.20231215.202310310013611161715', '2023-12-15 09:55:12', '2023-12-15 09:55:12', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('56', null, '0310126684', '6110', 'NINDYA FEBRIYANI PUTRI^^^^', 'N531', '*', null, null, '19980220', 'F', null, null, null, '81', '0', 'SPS-xx59', '2023-12-15 07:37:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0059', '20231031001386', '1.2.40.0.13.1.0310126684.20231215.20231031001386116147', '2023-12-15 09:58:38', '2023-12-15 09:58:38', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('57', null, '0310126684', '6110', 'NINDYA FEBRIYANI PUTRI^^^^', 'N531', '*', null, null, '19980220', 'F', null, null, null, '81', '0', 'SPS-xx60', '2023-12-15 07:37:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0060', '20231031001317', '1.2.40.0.13.1.0310126684.20231215.202310310013171161935', '2023-12-15 10:05:15', '2023-12-15 10:05:15', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('58', null, '0310126684', '6110', 'NINDYA FEBRIYANI PUTRI^^^^', 'N531', '*', null, null, '19980220', 'F', null, null, null, '81', '0', 'SPS-xx61', '2023-12-15 07:37:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0061', '20231031001340', '1.2.40.0.13.1.0310126684.20231215.202310310013401161350', '2023-12-15 13:21:10', '2023-12-15 13:21:10', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('59', null, '0310126684', '6110', 'NINDYA FEBRIYANI PUTRI^^^^', 'N531', '*', null, null, '19980220', 'F', null, null, null, '81', '0', 'SPS-xx62', '2023-12-15 07:37:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0062', '20231031001395', '1.2.40.0.13.1.0310126684.20231215.202310310013951161575', '2023-12-15 13:43:34', '2023-12-15 13:43:34', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('60', null, '0310126684', '6110', 'NINDYA FEBRIYANI PUTRI^^^^', 'N531', '*', null, null, '19980220', 'F', null, null, null, '81', '0', 'SPS-xx63', '2023-12-15 07:37:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0063', '20231031001325', '1.2.40.0.13.1.0310126684.20231215.202310310013251161742', '2023-12-15 14:04:35', '2023-12-15 14:04:35', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('61', null, '0310126684', '6110', 'NINDYA FEBRIYANI PUTRI^^^^', 'N531', '*', null, null, '19980220', 'F', null, null, null, '81', '0', 'SPS-xx64', '2023-12-15 07:37:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0064', '20231031001351', '1.2.40.0.13.1.0310126684.20231215.202310310013511161933', '2023-12-15 14:04:40', '2023-12-15 14:04:40', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('62', null, '0310126684', '6110', 'NINDYA FEBRIYANI PUTRI^^^^', 'N531', '*', null, null, '19980220', 'F', null, null, null, '81', '0', 'SPS-xx65', '2023-12-15 07:37:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0065', '20231031001311', '1.2.40.0.13.1.0310126684.20231215.202310310013111161123', '2023-12-15 14:05:43', '2023-12-15 14:05:43', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('63', null, '0310126684', '6110', 'NINDYA FEBRIYANI PUTRI^^^^', 'N531', '*', null, null, '19980220', 'F', null, null, null, '81', '0', 'SPS-xx66', '2023-12-15 07:37:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0066', '20231031001354', '1.2.40.0.13.1.0310126684.20231215.202310310013541161703', '2023-12-15 14:11:39', '2023-12-15 14:11:39', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('64', null, '0310126684', '6110', 'NINDYA FEBRIYANI PUTRI^^^^', 'N531', '*', null, null, '19980220', 'F', null, null, null, '81', '0', 'SPS-xx67', '2023-12-15 07:37:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0067', '2023103100136', '1.2.40.0.13.1.0310126684.20231215.20231031001361161965', '2023-12-15 14:13:32', '2023-12-15 14:13:32', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('65', null, '1000001307', '12152', 'JOJOR MARGANDA HUTAGALUNG^^^^', 'J265', '*', null, null, '19890626', 'M', null, null, null, '82', '0', 'SPS-xx68', '2023-12-12 14:51:00', 'ANGELL_CCDDR', null, 'CR', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0068', '20231009011478', '1.2.40.0.13.1.1000001307.20231215.202310090114782547886', '2023-12-15 15:00:35', '2023-12-15 15:00:35', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('66', null, '1000001307', '12152', 'JOJOR MARGANDA HUTAGALUNG^^^^', 'J265', '*', null, null, '19890626', 'M', null, null, null, '82', '0', 'SPS-xx69', '2023-12-12 14:51:00', 'ANGELL_CCDDR', null, 'CT', 'A. JUSNAINI NUR, AMD.AK^^^^', 'A225', '*', null, null, 'RP-0069', '20231009011471', '1.2.40.0.13.1.1000001307.20231215.20231009011471798779', '2023-12-15 15:00:36', '2023-12-15 15:00:36', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('67', null, '1000001632', '12546', 'SURIYANI^^^^', 'S650', '*', null, null, '19841212', 'F', null, null, null, '83', '0', 'SPS-xx70', '2024-01-08 11:16:00', 'ANGELL_CCDDR', null, 'CR', 'FANI RAHMAWATI AMD.KES^^^^', 'F565', '*', null, null, 'RP-0070', '20231019008238', '1.2.40.0.13.1.1000001632.20240108.202310190082382544869', '2024-01-08 10:08:51', '2024-01-08 10:08:51', null);
INSERT INTO `mppsio_patient_mwl_item_backup` VALUES ('69', null, '1000000856', '11498', 'ANDI PARIDA LATIP^^^^', 'A531', '*', null, null, '19630812', 'F', null, null, null, '85', '0', 'SPS-xx3', '2024-01-11 11:16:00', 'ANGELL_CCDDR', null, 'CR', 'NASIR TAYYEB, A. MD. RAD^^^^', 'N263', '*', null, null, 'RP-003', '20231018006939', '1.2.40.0.13.1.1000000856.20240111.202310180069391161264', '2024-01-11 10:19:47', '2024-01-11 10:19:47', null);

-- ----------------------------
-- Table structure for notification_unread
-- ----------------------------
DROP TABLE IF EXISTS `notification_unread`;
CREATE TABLE `notification_unread` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of notification_unread
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`) USING BTREE,
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------
INSERT INTO `personal_access_tokens` VALUES ('1', 'App\\User', '1', 'andikautama034@gmail.com', 'e4be60b9f1a58ceb7abdf8112aa4bc06a709eabdc59e5a94a5015d655d9d9d8b', '[\"*\"]', '2023-03-21 09:55:06', '2022-10-17 09:52:24', '2023-03-21 09:55:06');
INSERT INTO `personal_access_tokens` VALUES ('2', 'App\\User', '2', 'kutamz@gmail.com', '3a6aa94fa33e095a1cc53503fcadc52b7ecb6b774d0cab809a4ec3694ebd15ed', '[\"*\"]', '2023-07-03 15:07:54', '2022-12-08 10:22:48', '2023-07-03 15:07:54');
INSERT INTO `personal_access_tokens` VALUES ('3', 'App\\User', '3', 'andikautama0341@gmail.com', '4a1de0c47a56a6571dc8c2ebe8ac67e1eb7f5df52e51c8141b47d00d64ce81f9', '[\"*\"]', '2023-06-28 16:49:16', '2023-06-28 15:28:00', '2023-06-28 16:49:16');
INSERT INTO `personal_access_tokens` VALUES ('4', 'App\\User', '3', 'andikautama0341@gmail.com', '1f97e0d7c570fdbdf5457348541eab63f581d0f726205a0580323512af1cb8b4', '[\"*\"]', '2023-07-03 13:45:46', '2023-06-30 14:02:33', '2023-07-03 13:45:46');
INSERT INTO `personal_access_tokens` VALUES ('5', 'App\\User', '3', 'andikautama0341@gmail.com', 'd8291a55217a9ff3b44409dfada8ca42118861f6090a494d86a928e52ed6812c', '[\"*\"]', '2023-07-03 14:31:16', '2023-07-03 14:31:09', '2023-07-03 14:31:16');
INSERT INTO `personal_access_tokens` VALUES ('6', 'App\\User', '4', 'asd2@gmail.com', 'fa67001d89f7c8b9d618075ce24bdef6547d513d6d6ac65883827044f6e18b9b', '[\"*\"]', '2024-01-12 10:30:05', '2023-12-06 15:25:36', '2024-01-12 10:30:05');

-- ----------------------------
-- Table structure for rename_link
-- ----------------------------
DROP TABLE IF EXISTS `rename_link`;
CREATE TABLE `rename_link` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `link_simrs_dicom` varchar(255) DEFAULT NULL,
  `link_simrs_expertise` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of rename_link
-- ----------------------------
INSERT INTO `rename_link` VALUES ('1', 'intiwid', 'intiwid-base', null, null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `users_username_unique` (`username`) USING BTREE,
  UNIQUE KEY `users_email_unique` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'andika utama', 'andika', 'andikautama034@gmail.com', null, '$2y$10$hYyszbnB.Dy.ZGuCKrS.uOB3t2ZsS4YIk18ejQTsZUtdl6ENfaaty', null, '2022-10-17 09:52:20', '2022-10-17 09:52:20');
INSERT INTO `users` VALUES ('2', 'andika utama', 'kutamz', 'kutamz@gmail.com', null, '$2y$10$erZfBA9nbIZbQx7G3Jksh.Ex3Edbv.yhVwY3xejE0ooeRRSSGrVai', null, '2022-12-08 10:22:33', '2022-12-08 10:22:33');
INSERT INTO `users` VALUES ('3', 'andikautama0341', 'andikautama0341', 'andikautama0341@gmail.com', null, '$2y$10$80/uY0y3Q4lFQz8B/0S00eo9o9PP/zjWg2uFkXBf3.4N7AKuo9Hjy', null, '2023-06-28 15:27:56', '2023-06-28 15:27:56');
INSERT INTO `users` VALUES ('4', 'asd2', 'asd2', 'asd2@gmail.com', null, '$2y$10$eLhisZFgD0OTdDY3lhZfdubsSV/3EZVsMEgQbKMgX4lTHVtqVGWxW', null, '2023-12-06 15:25:26', '2023-12-06 15:25:26');

-- ----------------------------
-- Table structure for xray_admin
-- ----------------------------
DROP TABLE IF EXISTS `xray_admin`;
CREATE TABLE `xray_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_name` varchar(50) NOT NULL,
  `ad_lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`admin_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_admin
-- ----------------------------

-- ----------------------------
-- Table structure for xray_chat_message
-- ----------------------------
DROP TABLE IF EXISTS `xray_chat_message`;
CREATE TABLE `xray_chat_message` (
  `chat_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `to_username` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `from_username` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `chat_message` longtext COLLATE utf8_bin,
  `timestamp` timestamp NULL DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`chat_message_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_chat_message
-- ----------------------------

-- ----------------------------
-- Table structure for xray_complaint
-- ----------------------------
DROP TABLE IF EXISTS `xray_complaint`;
CREATE TABLE `xray_complaint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_date` date DEFAULT NULL,
  `complaint_time` time DEFAULT NULL,
  `person_call` varchar(100) DEFAULT NULL,
  `problem` longtext,
  `solve_date` date DEFAULT NULL,
  `solve_time` time DEFAULT NULL,
  `explanation` longtext,
  `solve_date_to` date DEFAULT NULL,
  `solve_time_to` time DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_complaint
-- ----------------------------

-- ----------------------------
-- Table structure for xray_contract
-- ----------------------------
DROP TABLE IF EXISTS `xray_contract`;
CREATE TABLE `xray_contract` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `no_contract` varchar(255) DEFAULT NULL,
  `contract_date` datetime DEFAULT NULL,
  `contract_duedate` datetime DEFAULT NULL,
  `contract_update` datetime DEFAULT NULL,
  `contract_sign_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_contract
-- ----------------------------

-- ----------------------------
-- Table structure for xray_department
-- ----------------------------
DROP TABLE IF EXISTS `xray_department`;
CREATE TABLE `xray_department` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `dep_id` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `name_dep` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`pk`,`dep_id`) USING BTREE,
  KEY `dep_id` (`dep_id`) USING BTREE,
  KEY `name_dep` (`name_dep`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_department
-- ----------------------------
INSERT INTO `xray_department` VALUES ('1', '1', 'poli 1');
INSERT INTO `xray_department` VALUES ('2', '2', 'poli 2');

-- ----------------------------
-- Table structure for xray_dokter
-- ----------------------------
DROP TABLE IF EXISTS `xray_dokter`;
CREATE TABLE `xray_dokter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dokterid` varchar(50) CHARACTER SET utf8 NOT NULL,
  `named` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `lastnamed` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sexd` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `telp` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `idtele` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `dokterid` (`dokterid`) USING BTREE,
  KEY `named` (`named`) USING BTREE,
  KEY `lastnamed` (`lastnamed`) USING BTREE,
  KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_dokter
-- ----------------------------
INSERT INTO `xray_dokter` VALUES ('1', '1', 'dokter pengirim', '1', null, '0', null, 'a@gmail.com', null, null);

-- ----------------------------
-- Table structure for xray_dokter_radiology
-- ----------------------------
DROP TABLE IF EXISTS `xray_dokter_radiology`;
CREATE TABLE `xray_dokter_radiology` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `dokradid` varchar(10) CHARACTER SET utf8 NOT NULL,
  `dokrad_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `dokrad_lastname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nip` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `dokrad_sex` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `dokrad_tlp` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `dokrad_email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `dokrad_img` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `otp` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `idtele` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`pk`,`username`) USING BTREE,
  KEY `dokradid` (`dokradid`) USING BTREE,
  KEY `dokrad_name` (`dokrad_name`) USING BTREE,
  KEY `dokrad_lastname` (`dokrad_lastname`) USING BTREE,
  KEY `nip` (`nip`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_dokter_radiology
-- ----------------------------
INSERT INTO `xray_dokter_radiology` VALUES ('1', '1', 'dr. sarah', 'sari.spRad', '1', 'Perempuan', '1', 'a@gmail.com', null, 'sarah', '$2y$12$ZKHrqojxjahwuhO1n4.rzeBLCC07nesHOZx.Z2bVUrhy2ZIeQXCza', null, '1');
INSERT INTO `xray_dokter_radiology` VALUES ('2', '2', 'dr demo radiologi', '', ' ', 'Laki-Laki', '0', 'a@gmail.com', null, 'demo_radiologi', '$2y$12$XMlc1xrPDgeWOANV7.n/lOEGKUDPAp.4mXquEvlHIkOXQ.9jC3LfO', null, ' ');
INSERT INTO `xray_dokter_radiology` VALUES ('3', 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', '', null, null, null, null, null, 'asd', 'asd', null, null);

-- ----------------------------
-- Table structure for xray_expertise
-- ----------------------------
DROP TABLE IF EXISTS `xray_expertise`;
CREATE TABLE `xray_expertise` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `qr_code_pasien` varchar(25) DEFAULT NULL,
  `signature_dokter_radiologi` varchar(25) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xray_expertise
-- ----------------------------
INSERT INTO `xray_expertise` VALUES ('1', '1', 'qr_code', '2023-05-30 11:35:30', '2023-05-30 11:35:30');

-- ----------------------------
-- Table structure for xray_hostname_publik
-- ----------------------------
DROP TABLE IF EXISTS `xray_hostname_publik`;
CREATE TABLE `xray_hostname_publik` (
  `pk` varchar(255) NOT NULL,
  `ip_publik` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_hostname_publik
-- ----------------------------
INSERT INTO `xray_hostname_publik` VALUES ('1', 'intimedika.net', '2023-11-27 13:34:50');

-- ----------------------------
-- Table structure for xray_login
-- ----------------------------
DROP TABLE IF EXISTS `xray_login`;
CREATE TABLE `xray_login` (
  `id_table` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `date` datetime DEFAULT NULL,
  `password_contract` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_table`,`username`) USING BTREE,
  KEY `username` (`username`) USING BTREE,
  KEY `password` (`password`) USING BTREE,
  KEY `level` (`level`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_login
-- ----------------------------
INSERT INTO `xray_login` VALUES ('1', 'superadmin', '$2y$12$3j1STCXbcRdnSHQ9W6FWHOocfLgtXGf4J3FZLxHyK5/un8kWFxh3q', 'superadmin', null, null);
INSERT INTO `xray_login` VALUES ('2', 'sarah', '$2y$12$nBKyz/0/MUvl5NGoqAO71Oy7cK1uinNU/u5miwhxBo/ODCMtNuucK', 'radiology', '2023-05-02 16:43:13', null);
INSERT INTO `xray_login` VALUES ('3', 'rafdi', '$2y$12$K79RVOF5yjkkPHo0XI4kBO4sF93C.VL7ZPEUnI27BSa/BJhhgGbWS', 'radiographer', '2023-05-02 16:44:37', null);
INSERT INTO `xray_login` VALUES ('4', 'bella', '$2y$12$A3qcshhsVaNcb0mgKGYrpeF4VqkjrvTXcyJkstB5dcBvWzNhHiQwK', 'refferal', '2023-05-02 16:44:45', null);
INSERT INTO `xray_login` VALUES ('5', 'admin', '$2y$12$RE2cZjy/3r4u1k4BQOdyEOxnsQZ9Uoah7HRjGfBZgkFI7V7rOAA2S', 'admin', '2023-05-02 16:44:53', null);
INSERT INTO `xray_login` VALUES ('6', 'igd', '$2y$12$diJe9FC8e/w8cGh2q6VmWeGl8l5SQwILDa7UQxF2r7gttVN6aGayS', 'refferal', '2023-09-14 14:15:16', null);
INSERT INTO `xray_login` VALUES ('7', 'dokter', '$2y$12$q6HAFJdZ7QwypzQEf9ynp.YZivJNR014SXf7xxoBopMZV1ucYp8bW', 'radiology', '2023-09-19 09:45:29', null);
INSERT INTO `xray_login` VALUES ('8', 'demo_radiologi', '$2y$12$XMlc1xrPDgeWOANV7.n/lOEGKUDPAp.4mXquEvlHIkOXQ.9jC3LfO', 'radiology', '2023-09-29 15:53:25', null);

-- ----------------------------
-- Table structure for xray_maintenance
-- ----------------------------
DROP TABLE IF EXISTS `xray_maintenance`;
CREATE TABLE `xray_maintenance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_id` varchar(255) DEFAULT NULL,
  `maintenance_date` datetime DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `do_maintenance_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_maintenance
-- ----------------------------

-- ----------------------------
-- Table structure for xray_modalitas
-- ----------------------------
DROP TABLE IF EXISTS `xray_modalitas`;
CREATE TABLE `xray_modalitas` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `id_modality` varchar(255) NOT NULL,
  `xray_type_code` varchar(101) NOT NULL,
  PRIMARY KEY (`pk`,`id_modality`) USING BTREE,
  UNIQUE KEY `xray_type_code` (`xray_type_code`) USING BTREE,
  KEY `id_modality` (`id_modality`) USING BTREE,
  KEY `xray_type_code_normal` (`xray_type_code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_modalitas
-- ----------------------------
INSERT INTO `xray_modalitas` VALUES ('1', 'CR', 'CR');
INSERT INTO `xray_modalitas` VALUES ('2', 'CT', 'CT');

-- ----------------------------
-- Table structure for xray_order
-- ----------------------------
DROP TABLE IF EXISTS `xray_order`;
CREATE TABLE `xray_order` (
  `pk` bigint(255) NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) CHARACTER SET utf8 NOT NULL,
  `acc` varchar(30) CHARACTER SET utf8 DEFAULT '',
  `patientid` varchar(100) CHARACTER SET utf8 DEFAULT '0',
  `mrn` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sex` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `weight` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `dep_id` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `name_dep` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_modality` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `xray_type_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `id_prosedur` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `prosedur` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `harga_prosedur` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `dokterid` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `named` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `lastnamed` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `radiographer_id` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `radiographer_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `radiographer_lastname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `dokradid` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `dokrad_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `dokrad_lastname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `schedule_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `schedule_time` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `contrast` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `priority` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `pat_state` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `contrast_allergies` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `spc_needs` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `id_payment` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payment` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fromorder` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `examed_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE,
  UNIQUE KEY `uid` (`uid`) USING BTREE,
  KEY `uid_normal` (`uid`) USING BTREE,
  KEY `acc` (`acc`) USING BTREE,
  KEY `patientid` (`patientid`) USING BTREE,
  KEY `mrn` (`mrn`) USING BTREE,
  KEY `name` (`name`) USING BTREE,
  KEY `address` (`address`) USING BTREE,
  KEY `sex` (`sex`) USING BTREE,
  KEY `birth_date` (`birth_date`) USING BTREE,
  KEY `weight` (`weight`) USING BTREE,
  KEY `dep_id` (`dep_id`) USING BTREE,
  KEY `name_dep` (`name_dep`) USING BTREE,
  KEY `id_modality` (`id_modality`) USING BTREE,
  KEY `xray_type_code` (`xray_type_code`) USING BTREE,
  KEY `id_prosedur` (`id_prosedur`) USING BTREE,
  KEY `prosedur` (`prosedur`) USING BTREE,
  KEY `harga_prosedur` (`harga_prosedur`) USING BTREE,
  KEY `dokterid` (`dokterid`) USING BTREE,
  KEY `named` (`named`) USING BTREE,
  KEY `lastnamed` (`lastnamed`) USING BTREE,
  KEY `email` (`email`) USING BTREE,
  KEY `radiographer_id` (`radiographer_id`) USING BTREE,
  KEY `radiographer_name` (`radiographer_name`) USING BTREE,
  KEY `dokradid` (`dokradid`) USING BTREE,
  KEY `dokrad_name` (`dokrad_name`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE,
  KEY `schedule_date` (`schedule_date`) USING BTREE,
  KEY `schedule_time` (`schedule_time`) USING BTREE,
  KEY `contrast` (`contrast`) USING BTREE,
  KEY `priority` (`priority`) USING BTREE,
  KEY `pat_state` (`pat_state`) USING BTREE,
  KEY `contrast_allergies` (`contrast_allergies`) USING BTREE,
  KEY `spc_needs` (`spc_needs`) USING BTREE,
  KEY `id_payment` (`id_payment`) USING BTREE,
  KEY `payment` (`payment`) USING BTREE,
  KEY `fromorder` (`fromorder`) USING BTREE,
  KEY `examed_at` (`examed_at`) USING BTREE,
  KEY `deleted_at` (`deleted_at`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_order
-- ----------------------------
INSERT INTO `xray_order` VALUES ('36', '1.2.40.0.13.1.9.20231207.34369500000516334603882', '343695000005163346', '171612131', '9', 'PKU GROGOL P', null, 'BEKASI', 'F', '1968-02-21', '-', '2', '& IGD MALAM', '20', 'MR', '03', 'MRI HEAD', '100000000000', 'Y0026', 'drg. R. Nuni Maharani, Sp.KG', null, null, '1292', null, null, '1', 'demo radiology', null, '2023-06-30 13:39:55', '2023-06-30', '14:10:45', null, 'Cito', 'Rawat Jalan', null, 'sehat', 'BPI', 'BPJS (PBI)', 'SIMRS', '2023-12-07 10:24:26', null);
INSERT INTO `xray_order` VALUES ('37', '1.2.156.112677.1000.101.20230829105343.1', '100000154433', '1000001544', '1000001544', 'MUHRIANI MUHTIAR', null, 'btp jl. keruk timur 32 blok h no 374', 'F', '1992-07-02', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '2543', 'Thoracal AP', '330000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, '1', 'dr. sarah', null, '2023-12-07 11:29:15', '2023-12-07', '11:39:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 10:30:12', null);
INSERT INTO `xray_order` VALUES ('38', '1.2.40.0.13.1.1000001544.20231207.1000001544162543353', '100000154416', '1000001544', '1000001544', 'MUHRIANI MUHTIAR', null, 'btp jl. keruk timur 32 blok h no 374', 'F', '1992-07-02', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '2543', 'Thoracal AP', '330000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 11:29:15', '2023-12-07', '11:39:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 12:50:18', null);
INSERT INTO `xray_order` VALUES ('39', '1.2.40.0.13.1.1000001360.20231207.1000001360111161525', '100000136011', '1000001360', '1000001360', 'CHRISTIANTO LOPOLISA', null, 'JLAN SUNU BLOK G N0.14A', 'M', '1951-04-24', '70', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1460000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 10:43:44', '2023-12-07', '10:53:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 12:52:53', null);
INSERT INTO `xray_order` VALUES ('40', '1.2.40.0.13.1.1000001630.20231207.100000163071116164', '100000163071', '1000001630', '1000001630', 'HAJARAH', null, 'BTN CITRA PERMAI 1 NO.15', 'F', '1963-02-10', '55', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1390000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 10:58:17', '2023-12-07', '11:08:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 12:56:19', null);
INSERT INTO `xray_order` VALUES ('41', '1.2.40.0.13.1.1000001630.20231207.1000001630291161976', '100000163029', '1000001630', '1000001630', 'HAJARAH', null, 'BTN CITRA PERMAI 1 NO.15', 'F', '1963-02-10', '55', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1390000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 10:58:17', '2023-12-07', '11:08:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 12:57:18', null);
INSERT INTO `xray_order` VALUES ('42', '1.2.40.0.13.1.1000001630.20231207.1000001630541161376', '100000163054', '1000001630', '1000001630', 'HAJARAH', null, 'BTN CITRA PERMAI 1 NO.15', 'F', '1963-02-10', '55', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1390000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 10:58:17', '2023-12-07', '11:08:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 13:00:05', null);
INSERT INTO `xray_order` VALUES ('43', '1.2.40.0.13.1.1000000856.20231207.10000008562779863', '100000085627', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 13:19:41', null);
INSERT INTO `xray_order` VALUES ('44', '1.2.40.0.13.1.1000000856.20231207.100000085631798627', '100000085631', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 13:19:57', null);
INSERT INTO `xray_order` VALUES ('45', '1.2.40.0.13.1.1000000856.20231207.100000085696798740', '100000085696', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 13:27:32', null);
INSERT INTO `xray_order` VALUES ('46', '1.2.40.0.13.1.1000000856.20231207.100000085617798490', '100000085617', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 13:38:53', null);
INSERT INTO `xray_order` VALUES ('47', '1.2.40.0.13.1.1000000856.20231207.10000008563798289', '10000008563', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 13:42:25', null);
INSERT INTO `xray_order` VALUES ('48', '1.2.40.0.13.1.1000000856.20231207.10000008568798991', '10000008568', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 13:43:42', null);
INSERT INTO `xray_order` VALUES ('49', '1.2.40.0.13.1.1000000856.20231207.100000085636798981', '100000085636', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 13:46:03', null);
INSERT INTO `xray_order` VALUES ('50', '1.2.40.0.13.1.1000000856.20231207.10000008562379836', '100000085623', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 13:47:13', null);
INSERT INTO `xray_order` VALUES ('51', '1.2.40.0.13.1.1000000856.20231207.10000008564879840', '100000085648', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 13:47:21', null);
INSERT INTO `xray_order` VALUES ('52', '1.2.40.0.13.1.1000000856.20231207.100000085672798725', '100000085672', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 13:48:34', null);
INSERT INTO `xray_order` VALUES ('53', '1.2.40.0.13.1.1000000856.20231207.100000085641798485', '100000085641', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 13:50:18', null);
INSERT INTO `xray_order` VALUES ('54', '1.2.40.0.13.1.1000000856.20231207.100000085656798345', '100000085656', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 13:59:00', null);
INSERT INTO `xray_order` VALUES ('55', '1.2.40.0.13.1.1000000856.20231207.10000008565798479', '10000008565', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 14:02:47', null);
INSERT INTO `xray_order` VALUES ('56', '1.2.40.0.13.1.0310195188.20231207.03101951882179828', '031019518821', '0310195188', '0310195188', 'AQILAH HAYATUNNIZA', null, 'KOMP BPS 2 BLOK E1 NOMOR 13', 'F', '2003-10-06', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0004', 'dr. Mursalim Sewang, Sp.B', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 15:48:16', '2023-12-07', '15:58:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 14:49:05', null);
INSERT INTO `xray_order` VALUES ('57', '1.2.40.0.13.1.0310195188.20231207.031019518853798456', '031019518853', '0310195188', '0310195188', 'AQILAH HAYATUNNIZA', null, 'KOMP BPS 2 BLOK E1 NOMOR 13', 'F', '2003-10-06', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0004', 'dr. Mursalim Sewang, Sp.B', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 15:48:16', '2023-12-07', '15:58:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 14:50:27', null);
INSERT INTO `xray_order` VALUES ('58', '1.2.40.0.13.1.0310195188.20231207.031019518818798358', '031019518818', '0310195188', '0310195188', 'AQILAH HAYATUNNIZA', null, 'KOMP BPS 2 BLOK E1 NOMOR 13', 'F', '2003-10-06', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0004', 'dr. Mursalim Sewang, Sp.B', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 15:48:16', '2023-12-07', '15:58:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 14:51:50', null);
INSERT INTO `xray_order` VALUES ('59', '1.2.40.0.13.1.0310195188.20231207.031019518815798308', '031019518815', '0310195188', '0310195188', 'AQILAH HAYATUNNIZA', null, 'KOMP BPS 2 BLOK E1 NOMOR 13', 'F', '2003-10-06', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0004', 'dr. Mursalim Sewang, Sp.B', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 15:48:16', '2023-12-07', '15:58:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 15:00:12', null);
INSERT INTO `xray_order` VALUES ('60', '1.2.40.0.13.1.1000001612.20231207.100000161294798985', '100000161294', '1000001612', '1000001612', 'AHSANDI RESKI', null, 'BONTOSUKA', 'M', '1998-10-17', '48', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '1950000', 'MD0004', 'dr. Mursalim Sewang, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 16:06:34', '2023-12-07', '16:16:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-07 15:07:04', null);
INSERT INTO `xray_order` VALUES ('61', '1.2.40.0.13.1.1000001617.20231208.1000001617191161356', '100000161719', '1000001617', '1000001617', 'BAGUS GUNAWAN', null, 'PERUMAHAN SUDIANG', 'M', '1995-07-01', '60', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1330000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0053', 'dr. Andi Darni Jaya, Sp. Rad', null, '2023-12-08 09:03:59', '2023-12-08', '09:13:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'JMN0043', 'CAR LIFE INSURANCE-ADMEDIKA', 'SIMRS', '2023-12-08 08:04:32', null);
INSERT INTO `xray_order` VALUES ('62', '1.2.40.0.13.1.1000001617.20231208.100000161738798146', '100000161738', '1000001617', '1000001617', 'BAGUS GUNAWAN', null, 'PERUMAHAN SUDIANG', 'M', '1995-07-01', '60', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '1860000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0053', 'dr. Andi Darni Jaya, Sp. Rad', null, '2023-12-08 09:03:59', '2023-12-08', '09:13:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'JMN0043', 'CAR LIFE INSURANCE-ADMEDIKA', 'SIMRS', '2023-12-08 08:04:33', null);
INSERT INTO `xray_order` VALUES ('63', '1.2.40.0.13.1.1000001592.20231208.202310180099561161264', '20231018009956', '1000001592', '1000001592', 'ALIMIN', null, 'JL. GELORA PAJAIANG', 'M', '1960-10-24', '55', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1330000', 'MD0028', 'dr. Nur Rahmansyah, Sp.OT(K)', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-08 10:06:32', '2023-12-08', '10:16:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-08 09:07:19', null);
INSERT INTO `xray_order` VALUES ('64', '1.2.40.0.13.1.1000001592.20231208.2023101800999379828', '20231018009993', '1000001592', '1000001592', 'ALIMIN', null, 'JL. GELORA PAJAIANG', 'M', '1960-10-24', '55', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '1860000', 'MD0028', 'dr. Nur Rahmansyah, Sp.OT(K)', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-08 10:06:32', '2023-12-08', '10:16:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-08 09:07:20', null);
INSERT INTO `xray_order` VALUES ('65', '1.2.40.0.13.1.0310121694.20231208.202311160004831161258', '20231116000483', '0310121694', '0310121694', 'MUKHAMAD  IBNU WISMOYO', null, 'oyo malawai blok m, kebayoran baru', 'M', '1998-01-14', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1510500', 'MD0004', 'dr. Mursalim Sewang, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-08 10:14:57', '2023-12-08', '10:24:00', null, 'NORMAL', 'RADIOLOGI', null, null, '0017', 'MANDIRI INHEALTH MANAGED CARE', 'SIMRS', '2023-12-08 09:16:30', null);
INSERT INTO `xray_order` VALUES ('66', '1.2.40.0.13.1.0310121694.20231208.20231116000431798583', '20231116000431', '0310121694', '0310121694', 'MUKHAMAD  IBNU WISMOYO', null, 'oyo malawai blok m, kebayoran baru', 'M', '1998-01-14', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2118500', 'MD0004', 'dr. Mursalim Sewang, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-08 10:14:57', '2023-12-08', '10:24:00', null, 'NORMAL', 'RADIOLOGI', null, null, '0017', 'MANDIRI INHEALTH MANAGED CARE', 'SIMRS', '2023-12-08 09:16:31', null);
INSERT INTO `xray_order` VALUES ('67', '1.2.40.0.13.1.0310121694.20231208.202311160004851161273', '20231116000485', '0310121694', '0310121694', 'MUKHAMAD  IBNU WISMOYO', null, 'oyo malawai blok m, kebayoran baru', 'M', '1998-01-14', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1510500', 'MD0004', 'dr. Mursalim Sewang, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-08 10:14:57', '2023-12-08', '10:24:00', null, 'NORMAL', 'RADIOLOGI', null, null, '0017', 'MANDIRI INHEALTH MANAGED CARE', 'SIMRS', '2023-12-08 09:32:04', null);
INSERT INTO `xray_order` VALUES ('68', '1.2.40.0.13.1.0310121694.20231208.20231116000418798478', '20231116000418', '0310121694', '0310121694', 'MUKHAMAD  IBNU WISMOYO', null, 'oyo malawai blok m, kebayoran baru', 'M', '1998-01-14', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2118500', 'MD0004', 'dr. Mursalim Sewang, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-08 10:14:57', '2023-12-08', '10:24:00', null, 'NORMAL', 'RADIOLOGI', null, null, '0017', 'MANDIRI INHEALTH MANAGED CARE', 'SIMRS', '2023-12-08 09:32:05', null);
INSERT INTO `xray_order` VALUES ('71', '1.2.40.0.13.1.1000001652.20231211.202310200085151161398', '20231020008515', '1000001652', '1000001652', 'APRIAL ANGKASA PUTRA', null, 'BTN MANGGA TIGA BLOK F9 NO 8', 'M', '1999-04-26', '66', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1590000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-11 11:31:25', '2023-12-11', '11:41:00', null, 'NORMAL', 'RADIOLOGI', null, 'ABDOMINAL AND PELVIC PAIN', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-11 10:32:21', null);
INSERT INTO `xray_order` VALUES ('72', '1.2.40.0.13.1.1000001652.20231211.20231020008562170475', '20231020008562', '1000001652', '1000001652', 'APRIAL ANGKASA PUTRA', null, 'BTN MANGGA TIGA BLOK F9 NO 8', 'M', '1999-04-26', '66', '38', 'RADIOLOGI', 'RADIOLOGI', 'MR', '1704', 'MRI Abdomen (upper)', '3010000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-11 11:31:25', '2023-12-11', '11:41:00', null, 'NORMAL', 'RADIOLOGI', null, 'ABDOMINAL AND PELVIC PAIN', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-11 10:32:23', null);
INSERT INTO `xray_order` VALUES ('73', '1.2.40.0.13.1.1000001652.20231211.202310200085841161469', '20231020008584', '1000001652', '1000001652', 'APRIAL ANGKASA PUTRA', null, 'BTN MANGGA TIGA BLOK F9 NO 8', 'M', '1999-04-26', '66', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1590000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-11 11:31:25', '2023-12-11', '11:41:00', null, 'NORMAL', 'RADIOLOGI', null, 'ABDOMINAL AND PELVIC PAIN', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-11 16:21:49', null);
INSERT INTO `xray_order` VALUES ('74', '1.2.40.0.13.1.1000001652.20231211.20231020008541704876', '2023102000854', '1000001652', '1000001652', 'APRIAL ANGKASA PUTRA', null, 'BTN MANGGA TIGA BLOK F9 NO 8', 'M', '1999-04-26', '66', '38', 'RADIOLOGI', 'RADIOLOGI', 'MR', '1704', 'MRI Abdomen (upper)', '3010000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-11 11:31:25', '2023-12-11', '11:41:00', null, 'NORMAL', 'RADIOLOGI', null, 'ABDOMINAL AND PELVIC PAIN', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-11 16:21:50', null);
INSERT INTO `xray_order` VALUES ('81', '1.2.40.0.13.1.669124.20101410406.2114174143', '', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1', 'dr. sarah', null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `xray_order` VALUES ('82', '1.2.40.0.13.1.1000001307.20231212.20231009011452547696', '2023100901145', '1000001307', '1000001307', 'JOJOR MARGANDA HUTAGALUNG', null, 'JL. RAKYAT GG MERPATI MEDAN', 'M', '1989-06-26', '76', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '2547', 'Thorax AP / PA', '230000', 'MD0026', 'dr. Bhayu Rizallinoor Sp.BS', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-12 14:41:11', '2023-12-12', '14:51:00', null, 'NORMAL', 'RADIOLOGI', null, 'INTRACRANIAL INJURY, UNSPECIFIED-TB PARU', '0015', 'UMUM', 'SIMRS', '2023-12-12 13:41:31', null);
INSERT INTO `xray_order` VALUES ('83', '1.2.40.0.13.1.1000001307.20231212.20231009011460798523', '20231009011460', '1000001307', '1000001307', 'JOJOR MARGANDA HUTAGALUNG', null, 'JL. RAKYAT GG MERPATI MEDAN', 'M', '1989-06-26', '76', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0026', 'dr. Bhayu Rizallinoor Sp.BS', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-12 14:41:11', '2023-12-12', '14:51:00', null, 'NORMAL', 'RADIOLOGI', null, 'INTRACRANIAL INJURY, UNSPECIFIED-TB PARU', '0015', 'UMUM', 'SIMRS', '2023-12-12 13:41:32', null);
INSERT INTO `xray_order` VALUES ('89', '1.2.392.200036.9125.2.224761041219.6547221958.692056', '', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1', 'dr. sarah', null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `xray_order` VALUES ('91', '1.2.40.0.13.1.0310126684.20231215.202310310013331161831', '20231031001333', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-15 09:44:08', null);
INSERT INTO `xray_order` VALUES ('92', '1.2.40.0.13.1.0310126684.20231215.202310310013821161371', '20231031001382', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-15 09:44:45', null);
INSERT INTO `xray_order` VALUES ('93', '1.2.40.0.13.1.0310126684.20231215.202310310013611161715', '20231031001361', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-15 09:55:13', null);
INSERT INTO `xray_order` VALUES ('94', '1.2.40.0.13.1.0310126684.20231215.20231031001386116147', '20231031001386', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-15 09:58:39', null);
INSERT INTO `xray_order` VALUES ('95', '1.2.40.0.13.1.0310126684.20231215.202310310013171161935', '20231031001317', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-15 10:05:15', null);
INSERT INTO `xray_order` VALUES ('96', '1.2.40.0.13.1.0310126684.20231215.202310310013401161350', '20231031001340', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-15 13:21:11', null);
INSERT INTO `xray_order` VALUES ('97', '1.2.40.0.13.1.0310126684.20231215.202310310013951161575', '20231031001395', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-15 13:43:34', null);
INSERT INTO `xray_order` VALUES ('98', '1.2.40.0.13.1.0310126684.20231215.202310310013251161742', '20231031001325', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-15 14:04:35', null);
INSERT INTO `xray_order` VALUES ('99', '1.2.40.0.13.1.0310126684.20231215.202310310013511161933', '20231031001351', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-15 14:04:40', null);
INSERT INTO `xray_order` VALUES ('100', '1.2.40.0.13.1.0310126684.20231215.202310310013111161123', '20231031001311', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-15 14:05:43', null);
INSERT INTO `xray_order` VALUES ('101', '1.2.40.0.13.1.0310126684.20231215.202310310013541161703', '20231031001354', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-15 14:11:39', null);
INSERT INTO `xray_order` VALUES ('102', '1.2.40.0.13.1.0310126684.20231215.20231031001361161965', '2023103100136', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2023-12-15 14:13:32', null);
INSERT INTO `xray_order` VALUES ('103', '1.2.40.0.13.1.1000001307.20231215.202310090114782547886', '20231009011478', '12152', '1000001307', 'JOJOR MARGANDA HUTAGALUNG', null, 'JL. RAKYAT GG MERPATI MEDAN', 'M', '1989-06-26', '76', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '2547', 'Thorax AP / PA', '230000', 'MD0026', 'dr. Bhayu Rizallinoor Sp.BS', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-12 00:00:00', '2023-12-12', '14:51:00', null, 'NORMAL', 'RADIOLOGI', null, 'INTRACRANIAL INJURY, UNSPECIFIED--TB PARU', '0015', 'UMUM', 'SIMRS', '2023-12-15 15:00:36', null);
INSERT INTO `xray_order` VALUES ('104', '1.2.40.0.13.1.1000001307.20231215.20231009011471798779', '20231009011471', '12152', '1000001307', 'JOJOR MARGANDA HUTAGALUNG', null, 'JL. RAKYAT GG MERPATI MEDAN', 'M', '1989-06-26', '76', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0026', 'dr. Bhayu Rizallinoor Sp.BS', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-12 00:00:00', '2023-12-12', '14:51:00', null, 'NORMAL', 'RADIOLOGI', null, 'INTRACRANIAL INJURY, UNSPECIFIED--TB PARU', '0015', 'UMUM', 'SIMRS', '2023-12-15 15:00:37', null);
INSERT INTO `xray_order` VALUES ('105', '1.2.40.0.13.1.1000001632.20240108.202310190082382544869', '20231019008238', '12546', '1000001632', 'SURIYANI', null, 'BUMI TAMALANREA PERMAI BLOK AE/321', 'F', '1984-12-12', '65', '38', 'RADIOLOGI', '01', 'CR', '2544', 'Thoracal AP + Lateral', '390000', 'MD0032', 'dr. Ferdinand Rambu Tandung, Sp.OG, M.Kes', null, null, '12451468', 'Fani Rahmawati Amd.Kes', null, 'MD0053', 'dr. Andi Darni Jaya, Sp. Rad', null, '2024-01-08 00:00:00', '2024-01-08', '11:16:00', null, 'NORMAL', 'RADIOLOGI', null, 'MALIGNANT NEOPLASM, HEAD, FACE AND NECK-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2024-01-08 10:08:54', null);
INSERT INTO `xray_order` VALUES ('106', '1.2.40.0.13.1.1000000856.20240111.202310180069391161264', '20231018006939', '11498', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', '01', 'CR', '1161', 'Fistulography', '1460000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2024-01-11 00:00:00', '2024-01-11', '11:16:00', null, 'NORMAL', 'RADIOLOGI', null, 'NAUSEA AND VOMITING-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2024-01-11 10:19:50', null);
INSERT INTO `xray_order` VALUES ('107', '1.2.40.0.13.1.1000001544.20240112.2023101700391025471', '20231017003910', '12445', '1000001544', 'MUHRIANI MUHTIAR', null, 'btp jl. keruk timur 32 blok h no 374', 'F', '1992-07-02', '0', '38', 'RADIOLOGI', '01', 'CR', '2547', 'Thorax AP / PA', '220000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2024-01-12 00:00:00', '2024-01-12', '11:38:00', null, 'NORMAL', 'RADIOLOGI', null, 'COMMUNITY ACQUIRED PNEUMONIA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2024-01-12 10:29:47', null);
INSERT INTO `xray_order` VALUES ('108', '1.2.40.0.13.1.1000001544.20240112.20231017003981161449', '2023101700398', '12445', '1000001544', 'MUHRIANI MUHTIAR', null, 'btp jl. keruk timur 32 blok h no 374', 'F', '1992-07-02', '0', '38', 'RADIOLOGI', '01', 'CR', '1161', 'Fistulography', '1390000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2024-01-12 00:00:00', '2024-01-12', '11:38:00', null, 'NORMAL', 'RADIOLOGI', null, 'COMMUNITY ACQUIRED PNEUMONIA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', '2024-01-12 10:29:49', null);

-- ----------------------------
-- Table structure for xray_order_simrs_backup
-- ----------------------------
DROP TABLE IF EXISTS `xray_order_simrs_backup`;
CREATE TABLE `xray_order_simrs_backup` (
  `pk` bigint(255) NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) CHARACTER SET utf8 NOT NULL,
  `acc` varchar(30) CHARACTER SET utf8 DEFAULT '',
  `patientid` varchar(100) CHARACTER SET utf8 DEFAULT '0',
  `mrn` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sex` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `weight` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `dep_id` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `name_dep` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_modality` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `xray_type_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `id_prosedur` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `prosedur` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `harga_prosedur` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `dokterid` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `named` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `lastnamed` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `radiographer_id` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `radiographer_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `radiographer_lastname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `dokradid` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `dokrad_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `dokrad_lastname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `schedule_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `schedule_time` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `contrast` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `priority` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `pat_state` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `contrast_allergies` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `spc_needs` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `id_payment` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payment` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fromorder` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `examed_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE,
  UNIQUE KEY `uid` (`uid`) USING BTREE,
  KEY `uid_normal` (`uid`) USING BTREE,
  KEY `acc` (`acc`) USING BTREE,
  KEY `patientid` (`patientid`) USING BTREE,
  KEY `mrn` (`mrn`) USING BTREE,
  KEY `name` (`name`) USING BTREE,
  KEY `address` (`address`) USING BTREE,
  KEY `sex` (`sex`) USING BTREE,
  KEY `birth_date` (`birth_date`) USING BTREE,
  KEY `weight` (`weight`) USING BTREE,
  KEY `dep_id` (`dep_id`) USING BTREE,
  KEY `name_dep` (`name_dep`) USING BTREE,
  KEY `id_modality` (`id_modality`) USING BTREE,
  KEY `xray_type_code` (`xray_type_code`) USING BTREE,
  KEY `id_prosedur` (`id_prosedur`) USING BTREE,
  KEY `prosedur` (`prosedur`) USING BTREE,
  KEY `harga_prosedur` (`harga_prosedur`) USING BTREE,
  KEY `dokterid` (`dokterid`) USING BTREE,
  KEY `named` (`named`) USING BTREE,
  KEY `lastnamed` (`lastnamed`) USING BTREE,
  KEY `email` (`email`) USING BTREE,
  KEY `radiographer_id` (`radiographer_id`) USING BTREE,
  KEY `radiographer_name` (`radiographer_name`) USING BTREE,
  KEY `dokradid` (`dokradid`) USING BTREE,
  KEY `dokrad_name` (`dokrad_name`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE,
  KEY `schedule_date` (`schedule_date`) USING BTREE,
  KEY `schedule_time` (`schedule_time`) USING BTREE,
  KEY `contrast` (`contrast`) USING BTREE,
  KEY `priority` (`priority`) USING BTREE,
  KEY `pat_state` (`pat_state`) USING BTREE,
  KEY `contrast_allergies` (`contrast_allergies`) USING BTREE,
  KEY `spc_needs` (`spc_needs`) USING BTREE,
  KEY `id_payment` (`id_payment`) USING BTREE,
  KEY `payment` (`payment`) USING BTREE,
  KEY `fromorder` (`fromorder`) USING BTREE,
  KEY `examed_at` (`examed_at`) USING BTREE,
  KEY `deleted_at` (`deleted_at`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of xray_order_simrs_backup
-- ----------------------------
INSERT INTO `xray_order_simrs_backup` VALUES ('1', '1', '3436950000051646', '171612117', '5', 'MUH RAFLI', null, 'BEKASI', 'F', '1968-02-21', null, '2', '& IGD MALAM', '20', 'MR', '03', 'MRI HEAD', '100000000000', 'Y0026', 'drg. R. Nuni Maharani, Sp.KG', null, null, '1', 'dika 1', null, '5', 'demo radiology', null, '2023-06-30 13:39:55', '2023-06-30', '14:10:45', null, 'Cito', 'Rawat Jalan', null, 'sehat', 'BPI', 'BPJS (PBI)', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('2', '2', '3436950000051641', '171612117', '5', 'MUH RAFLI', null, 'BEKASI', 'F', '1968-02-21', null, '2', '& IGD MALAM', '20', 'MR', '03', 'MRI HEAD', '100000000000', 'Y0026', 'drg. R. Nuni Maharani, Sp.KG', null, null, '1', 'dika 1', null, '5', 'demo radiology', null, '2023-06-30 13:39:55', '2023-06-30', '14:10:45', null, 'Cito', 'Rawat Jalan', null, 'sehat', 'BPI', 'BPJS (PBI)', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('3', '3', '3436950000051642', '171612118', '6', 'ANDIKA', null, 'BEKASI', 'F', '1968-02-21', null, '2', '& IGD MALAM', '20', 'MR', '03', 'MRI HEAD', '100000000000', 'Y0026', 'drg. R. Nuni Maharani, Sp.KG', null, null, '1', 'dika 1', null, '5', 'demo radiology', null, '2023-06-30 13:39:55', '2023-06-30', '14:10:45', null, 'Cito', 'Rawat Jalan', null, 'sehat', 'BPI', 'BPJS (PBI)', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('5', '5', '3436950000051644', '171612119', '7', 'AKUTAMZ', null, 'BEKASI', 'F', '1968-02-21', null, '2', '& IGD MALAM', '20', 'MR', '03', 'MRI HEAD', '100000000000', 'Y0026', 'drg. R. Nuni Maharani, Sp.KG', null, null, '1', 'dika 1', null, '5', 'demo radiology', null, '2023-06-30 13:39:55', '2023-06-30', '14:10:45', null, 'Cito', 'Rawat Jalan', null, 'sehat', 'BPI', 'BPJS (PBI)', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('6', '1.2.40.0.13.1.12312312.20230803.83764546561690', '8376454656', '6390909909', '12312312', 'andika', null, null, 'M', '2000-01-02', '80', '1', 'poli 1', 'CR', 'CR', '1', 'thorax', '1', '1', 'dokter pengirim', null, null, '1', 'radiografer', null, '1', 'sarah sari sp.rad', null, '2023-08-03 15:03:33', '2023-08-03', '15:08:58', '0', 'normal', null, '0', 'COVID', '1', 'bpjs', 'RIS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('7', '1.2.40.0.13.1.9.20231206.343695000005163303971', '3436950000051633', '171612131', '9', 'PKU GROGOL P', null, 'BEKASI', 'F', '1968-02-21', '-', '2', '& IGD MALAM', '20', 'MR', '03', 'MRI HEAD', '100000000000', 'Y0026', 'drg. R. Nuni Maharani, Sp.KG', null, null, '1292', null, null, '1', 'demo radiology', null, '2023-06-30 13:39:55', '2023-06-30', '14:10:45', null, 'Cito', 'Rawat Jalan', null, 'sehat', 'BPI', 'BPJS (PBI)', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('8', '1.2.40.0.13.1.9.20231207.3436950000051633403807', '34369500000516334', '171612131', '9', 'PKU GROGOL P', null, 'BEKASI', 'F', '1968-02-21', '-', '2', '& IGD MALAM', '20', 'MR', '03', 'MRI HEAD', '100000000000', 'Y0026', 'drg. R. Nuni Maharani, Sp.KG', null, null, '1292', null, null, '1', 'demo radiology', null, '2023-06-30 13:39:55', '2023-06-30', '14:10:45', null, 'Cito', 'Rawat Jalan', null, 'sehat', 'BPI', 'BPJS (PBI)', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('9', '1.2.40.0.13.1.9.20231207.34369500000516334503609', '343695000005163345', '171612131', '9', 'PKU GROGOL P', null, 'BEKASI', 'F', '1968-02-21', '-', '2', '& IGD MALAM', '20', 'MR', '03', 'MRI HEAD', '100000000000', 'Y0026', 'drg. R. Nuni Maharani, Sp.KG', null, null, '1292', null, null, '1', 'demo radiology', null, '2023-06-30 13:39:55', '2023-06-30', '14:10:45', null, 'Cito', 'Rawat Jalan', null, 'sehat', 'BPI', 'BPJS (PBI)', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('10', '1.2.40.0.13.1.9.20231207.34369500000516334603129', '343695000005163346', '171612131', '9', 'PKU GROGOL P', null, 'BEKASI', 'F', '1968-02-21', '-', '2', '& IGD MALAM', '20', 'MR', '03', 'MRI HEAD', '100000000000', 'Y0026', 'drg. R. Nuni Maharani, Sp.KG', null, null, '1292', null, null, '1', 'demo radiology', null, '2023-06-30 13:39:55', '2023-06-30', '14:10:45', null, 'Cito', 'Rawat Jalan', null, 'sehat', 'BPI', 'BPJS (PBI)', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('11', '1.2.40.0.13.1.9.20231207.34369500000516334603882', '343695000005163346', '171612131', '9', 'PKU GROGOL P', null, 'BEKASI', 'F', '1968-02-21', '-', '2', '& IGD MALAM', '20', 'MR', '03', 'MRI HEAD', '100000000000', 'Y0026', 'drg. R. Nuni Maharani, Sp.KG', null, null, '1292', null, null, '1', 'demo radiology', null, '2023-06-30 13:39:55', '2023-06-30', '14:10:45', null, 'Cito', 'Rawat Jalan', null, 'sehat', 'BPI', 'BPJS (PBI)', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('12', '1.2.40.0.13.1.1000001544.20231207.1000001544332543969', '100000154433', '1000001544', '1000001544', 'MUHRIANI MUHTIAR', null, 'btp jl. keruk timur 32 blok h no 374', 'F', '1992-07-02', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '2543', 'Thoracal AP', '330000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 11:29:15', '2023-12-07', '11:39:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('13', '1.2.40.0.13.1.1000001544.20231207.1000001544162543353', '100000154416', '1000001544', '1000001544', 'MUHRIANI MUHTIAR', null, 'btp jl. keruk timur 32 blok h no 374', 'F', '1992-07-02', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '2543', 'Thoracal AP', '330000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 11:29:15', '2023-12-07', '11:39:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('14', '1.2.40.0.13.1.1000001360.20231207.1000001360111161525', '100000136011', '1000001360', '1000001360', 'CHRISTIANTO LOPOLISA', null, 'JLAN SUNU BLOK G N0.14A', 'M', '1951-04-24', '70', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1460000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 10:43:44', '2023-12-07', '10:53:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('15', '1.2.40.0.13.1.1000001630.20231207.100000163071116164', '100000163071', '1000001630', '1000001630', 'HAJARAH', null, 'BTN CITRA PERMAI 1 NO.15', 'F', '1963-02-10', '55', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1390000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 10:58:17', '2023-12-07', '11:08:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('16', '1.2.40.0.13.1.1000001630.20231207.1000001630291161976', '100000163029', '1000001630', '1000001630', 'HAJARAH', null, 'BTN CITRA PERMAI 1 NO.15', 'F', '1963-02-10', '55', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1390000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 10:58:17', '2023-12-07', '11:08:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('17', '1.2.40.0.13.1.1000001630.20231207.1000001630541161376', '100000163054', '1000001630', '1000001630', 'HAJARAH', null, 'BTN CITRA PERMAI 1 NO.15', 'F', '1963-02-10', '55', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1390000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 10:58:17', '2023-12-07', '11:08:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('18', '1.2.40.0.13.1.1000000856.20231207.10000008562779863', '100000085627', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('19', '1.2.40.0.13.1.1000000856.20231207.100000085631798627', '100000085631', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('20', '1.2.40.0.13.1.1000000856.20231207.100000085696798740', '100000085696', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('21', '1.2.40.0.13.1.1000000856.20231207.100000085617798490', '100000085617', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('22', '1.2.40.0.13.1.1000000856.20231207.10000008563798289', '10000008563', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('23', '1.2.40.0.13.1.1000000856.20231207.10000008568798991', '10000008568', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('24', '1.2.40.0.13.1.1000000856.20231207.100000085636798981', '100000085636', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('25', '1.2.40.0.13.1.1000000856.20231207.10000008562379836', '100000085623', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('26', '1.2.40.0.13.1.1000000856.20231207.10000008564879840', '100000085648', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('27', '1.2.40.0.13.1.1000000856.20231207.100000085672798725', '100000085672', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('28', '1.2.40.0.13.1.1000000856.20231207.100000085641798485', '100000085641', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('29', '1.2.40.0.13.1.1000000856.20231207.100000085656798345', '100000085656', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('30', '1.2.40.0.13.1.1000000856.20231207.10000008565798479', '10000008565', '1000000856', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 14:18:55', '2023-12-07', '14:28:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('31', '1.2.40.0.13.1.0310195188.20231207.03101951882179828', '031019518821', '0310195188', '0310195188', 'AQILAH HAYATUNNIZA', null, 'KOMP BPS 2 BLOK E1 NOMOR 13', 'F', '2003-10-06', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0004', 'dr. Mursalim Sewang, Sp.B', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 15:48:16', '2023-12-07', '15:58:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('32', '1.2.40.0.13.1.0310195188.20231207.031019518853798456', '031019518853', '0310195188', '0310195188', 'AQILAH HAYATUNNIZA', null, 'KOMP BPS 2 BLOK E1 NOMOR 13', 'F', '2003-10-06', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0004', 'dr. Mursalim Sewang, Sp.B', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 15:48:16', '2023-12-07', '15:58:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('33', '1.2.40.0.13.1.0310195188.20231207.031019518818798358', '031019518818', '0310195188', '0310195188', 'AQILAH HAYATUNNIZA', null, 'KOMP BPS 2 BLOK E1 NOMOR 13', 'F', '2003-10-06', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0004', 'dr. Mursalim Sewang, Sp.B', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 15:48:16', '2023-12-07', '15:58:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('34', '1.2.40.0.13.1.0310195188.20231207.031019518815798308', '031019518815', '0310195188', '0310195188', 'AQILAH HAYATUNNIZA', null, 'KOMP BPS 2 BLOK E1 NOMOR 13', 'F', '2003-10-06', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0004', 'dr. Mursalim Sewang, Sp.B', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 15:48:16', '2023-12-07', '15:58:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('35', '1.2.40.0.13.1.1000001612.20231207.100000161294798985', '100000161294', '1000001612', '1000001612', 'AHSANDI RESKI', null, 'BONTOSUKA', 'M', '1998-10-17', '48', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '1950000', 'MD0004', 'dr. Mursalim Sewang, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-07 16:06:34', '2023-12-07', '16:16:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('36', '1.2.40.0.13.1.1000001617.20231208.1000001617191161356', '100000161719', '1000001617', '1000001617', 'BAGUS GUNAWAN', null, 'PERUMAHAN SUDIANG', 'M', '1995-07-01', '60', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1330000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0053', 'dr. Andi Darni Jaya, Sp. Rad', null, '2023-12-08 09:03:59', '2023-12-08', '09:13:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'JMN0043', 'CAR LIFE INSURANCE-ADMEDIKA', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('37', '1.2.40.0.13.1.1000001617.20231208.100000161738798146', '100000161738', '1000001617', '1000001617', 'BAGUS GUNAWAN', null, 'PERUMAHAN SUDIANG', 'M', '1995-07-01', '60', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '1860000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0053', 'dr. Andi Darni Jaya, Sp. Rad', null, '2023-12-08 09:03:59', '2023-12-08', '09:13:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'JMN0043', 'CAR LIFE INSURANCE-ADMEDIKA', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('38', '1.2.40.0.13.1.1000001592.20231208.202310180099561161264', '20231018009956', '1000001592', '1000001592', 'ALIMIN', null, 'JL. GELORA PAJAIANG', 'M', '1960-10-24', '55', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1330000', 'MD0028', 'dr. Nur Rahmansyah, Sp.OT(K)', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-08 10:06:32', '2023-12-08', '10:16:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('39', '1.2.40.0.13.1.1000001592.20231208.2023101800999379828', '20231018009993', '1000001592', '1000001592', 'ALIMIN', null, 'JL. GELORA PAJAIANG', 'M', '1960-10-24', '55', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '1860000', 'MD0028', 'dr. Nur Rahmansyah, Sp.OT(K)', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-08 10:06:32', '2023-12-08', '10:16:00', null, 'NORMAL', 'RADIOLOGI', null, null, 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('40', '1.2.40.0.13.1.0310121694.20231208.202311160004831161258', '20231116000483', '0310121694', '0310121694', 'MUKHAMAD  IBNU WISMOYO', null, 'oyo malawai blok m, kebayoran baru', 'M', '1998-01-14', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1510500', 'MD0004', 'dr. Mursalim Sewang, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-08 10:14:57', '2023-12-08', '10:24:00', null, 'NORMAL', 'RADIOLOGI', null, null, '0017', 'MANDIRI INHEALTH MANAGED CARE', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('41', '1.2.40.0.13.1.0310121694.20231208.20231116000431798583', '20231116000431', '0310121694', '0310121694', 'MUKHAMAD  IBNU WISMOYO', null, 'oyo malawai blok m, kebayoran baru', 'M', '1998-01-14', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2118500', 'MD0004', 'dr. Mursalim Sewang, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-08 10:14:57', '2023-12-08', '10:24:00', null, 'NORMAL', 'RADIOLOGI', null, null, '0017', 'MANDIRI INHEALTH MANAGED CARE', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('42', '1.2.40.0.13.1.0310121694.20231208.202311160004851161273', '20231116000485', '0310121694', '0310121694', 'MUKHAMAD  IBNU WISMOYO', null, 'oyo malawai blok m, kebayoran baru', 'M', '1998-01-14', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1510500', 'MD0004', 'dr. Mursalim Sewang, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-08 10:14:57', '2023-12-08', '10:24:00', null, 'NORMAL', 'RADIOLOGI', null, null, '0017', 'MANDIRI INHEALTH MANAGED CARE', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('43', '1.2.40.0.13.1.0310121694.20231208.20231116000418798478', '20231116000418', '0310121694', '0310121694', 'MUKHAMAD  IBNU WISMOYO', null, 'oyo malawai blok m, kebayoran baru', 'M', '1998-01-14', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2118500', 'MD0004', 'dr. Mursalim Sewang, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-08 10:14:57', '2023-12-08', '10:24:00', null, 'NORMAL', 'RADIOLOGI', null, null, '0017', 'MANDIRI INHEALTH MANAGED CARE', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('46', '1.2.40.0.13.1.1000001652.20231211.202310200085151161398', '20231020008515', '1000001652', '1000001652', 'APRIAL ANGKASA PUTRA', null, 'BTN MANGGA TIGA BLOK F9 NO 8', 'M', '1999-04-26', '66', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1590000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-11 11:31:25', '2023-12-11', '11:41:00', null, 'NORMAL', 'RADIOLOGI', null, 'ABDOMINAL AND PELVIC PAIN', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('47', '1.2.40.0.13.1.1000001652.20231211.20231020008562170475', '20231020008562', '1000001652', '1000001652', 'APRIAL ANGKASA PUTRA', null, 'BTN MANGGA TIGA BLOK F9 NO 8', 'M', '1999-04-26', '66', '38', 'RADIOLOGI', 'RADIOLOGI', 'MR', '1704', 'MRI Abdomen (upper)', '3010000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-11 11:31:25', '2023-12-11', '11:41:00', null, 'NORMAL', 'RADIOLOGI', null, 'ABDOMINAL AND PELVIC PAIN', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('48', '1.2.40.0.13.1.1000001652.20231211.202310200085841161469', '20231020008584', '1000001652', '1000001652', 'APRIAL ANGKASA PUTRA', null, 'BTN MANGGA TIGA BLOK F9 NO 8', 'M', '1999-04-26', '66', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1590000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-11 11:31:25', '2023-12-11', '11:41:00', null, 'NORMAL', 'RADIOLOGI', null, 'ABDOMINAL AND PELVIC PAIN', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('49', '1.2.40.0.13.1.1000001652.20231211.20231020008541704876', '2023102000854', '1000001652', '1000001652', 'APRIAL ANGKASA PUTRA', null, 'BTN MANGGA TIGA BLOK F9 NO 8', 'M', '1999-04-26', '66', '38', 'RADIOLOGI', 'RADIOLOGI', 'MR', '1704', 'MRI Abdomen (upper)', '3010000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-11 11:31:25', '2023-12-11', '11:41:00', null, 'NORMAL', 'RADIOLOGI', null, 'ABDOMINAL AND PELVIC PAIN', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('54', '1.2.40.0.13.1.1000001307.20231212.20231009011452547696', '2023100901145', '1000001307', '1000001307', 'JOJOR MARGANDA HUTAGALUNG', null, 'JL. RAKYAT GG MERPATI MEDAN', 'M', '1989-06-26', '76', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '2547', 'Thorax AP / PA', '230000', 'MD0026', 'dr. Bhayu Rizallinoor Sp.BS', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-12 14:41:11', '2023-12-12', '14:51:00', null, 'NORMAL', 'RADIOLOGI', null, 'INTRACRANIAL INJURY, UNSPECIFIED-TB PARU', '0015', 'UMUM', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('55', '1.2.40.0.13.1.1000001307.20231212.20231009011460798523', '20231009011460', '1000001307', '1000001307', 'JOJOR MARGANDA HUTAGALUNG', null, 'JL. RAKYAT GG MERPATI MEDAN', 'M', '1989-06-26', '76', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0026', 'dr. Bhayu Rizallinoor Sp.BS', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-12 14:41:11', '2023-12-12', '14:51:00', null, 'NORMAL', 'RADIOLOGI', null, 'INTRACRANIAL INJURY, UNSPECIFIED-TB PARU', '0015', 'UMUM', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('56', '1.2.40.0.13.1.0310126684.20231215.202310310013331161831', '20231031001333', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('57', '1.2.40.0.13.1.0310126684.20231215.202310310013821161371', '20231031001382', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('58', '1.2.40.0.13.1.0310126684.20231215.202310310013611161715', '20231031001361', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('59', '1.2.40.0.13.1.0310126684.20231215.20231031001386116147', '20231031001386', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('60', '1.2.40.0.13.1.0310126684.20231215.202310310013171161935', '20231031001317', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('61', '1.2.40.0.13.1.0310126684.20231215.202310310013401161350', '20231031001340', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('62', '1.2.40.0.13.1.0310126684.20231215.202310310013951161575', '20231031001395', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('63', '1.2.40.0.13.1.0310126684.20231215.202310310013251161742', '20231031001325', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('64', '1.2.40.0.13.1.0310126684.20231215.202310310013511161933', '20231031001351', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('65', '1.2.40.0.13.1.0310126684.20231215.202310310013111161123', '20231031001311', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('66', '1.2.40.0.13.1.0310126684.20231215.202310310013541161703', '20231031001354', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('67', '1.2.40.0.13.1.0310126684.20231215.20231031001361161965', '2023103100136', '6110', '0310126684', 'NINDYA FEBRIYANI PUTRI', null, 'Kp. Cijengkol', 'F', '1998-02-20', '0', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '1161', 'Fistulography', '1520000', 'MD0022', 'dr. Deasy Riefma, Mars, Sp.B', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-15 00:00:00', '2023-12-15', '07:37:00', null, 'NORMAL', 'RADIOLOGI', null, 'FATIGUE FRACTURE OF VERTEBRA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('68', '1.2.40.0.13.1.1000001307.20231215.202310090114782547886', '20231009011478', '12152', '1000001307', 'JOJOR MARGANDA HUTAGALUNG', null, 'JL. RAKYAT GG MERPATI MEDAN', 'M', '1989-06-26', '76', '38', 'RADIOLOGI', 'RADIOLOGI', 'CR', '2547', 'Thorax AP / PA', '230000', 'MD0026', 'dr. Bhayu Rizallinoor Sp.BS', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-12 00:00:00', '2023-12-12', '14:51:00', null, 'NORMAL', 'RADIOLOGI', null, 'INTRACRANIAL INJURY, UNSPECIFIED--TB PARU', '0015', 'UMUM', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('69', '1.2.40.0.13.1.1000001307.20231215.20231009011471798779', '20231009011471', '12152', '1000001307', 'JOJOR MARGANDA HUTAGALUNG', null, 'JL. RAKYAT GG MERPATI MEDAN', 'M', '1989-06-26', '76', '38', 'RADIOLOGI', 'RADIOLOGI', 'CT', '798', 'CT Scan Head Trauma', '2040000', 'MD0026', 'dr. Bhayu Rizallinoor Sp.BS', null, null, '12451469', 'A. Jusnaini Nur, Amd.Ak', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2023-12-12 00:00:00', '2023-12-12', '14:51:00', null, 'NORMAL', 'RADIOLOGI', null, 'INTRACRANIAL INJURY, UNSPECIFIED--TB PARU', '0015', 'UMUM', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('70', '1.2.40.0.13.1.1000001632.20240108.202310190082382544869', '20231019008238', '12546', '1000001632', 'SURIYANI', null, 'BUMI TAMALANREA PERMAI BLOK AE/321', 'F', '1984-12-12', '65', '38', 'RADIOLOGI', '01', 'CR', '2544', 'Thoracal AP + Lateral', '390000', 'MD0032', 'dr. Ferdinand Rambu Tandung, Sp.OG, M.Kes', null, null, '12451468', 'Fani Rahmawati Amd.Kes', null, 'MD0053', 'dr. Andi Darni Jaya, Sp. Rad', null, '2024-01-08 00:00:00', '2024-01-08', '11:16:00', null, 'NORMAL', 'RADIOLOGI', null, 'MALIGNANT NEOPLASM, HEAD, FACE AND NECK-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('71', '1.2.40.0.13.1.1000000856.20240111.202310180069391161264', '20231018006939', '11498', '1000000856', 'ANDI PARIDA LATIP', null, 'JALAN BUDI UTOMO LORONG MARINIR', 'F', '1963-08-12', '49', '38', 'RADIOLOGI', '01', 'CR', '1161', 'Fistulography', '1460000', 'MD0015', 'dr. Muhammad Asrul Apris, Sp.JP(K).,M.Kes', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2024-01-11 00:00:00', '2024-01-11', '11:16:00', null, 'NORMAL', 'RADIOLOGI', null, 'NAUSEA AND VOMITING-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('72', '1.2.40.0.13.1.1000001544.20240112.2023101700391025471', '20231017003910', '12445', '1000001544', 'MUHRIANI MUHTIAR', null, 'btp jl. keruk timur 32 blok h no 374', 'F', '1992-07-02', '0', '38', 'RADIOLOGI', '01', 'CR', '2547', 'Thorax AP / PA', '220000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2024-01-12 00:00:00', '2024-01-12', '11:38:00', null, 'NORMAL', 'RADIOLOGI', null, 'COMMUNITY ACQUIRED PNEUMONIA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);
INSERT INTO `xray_order_simrs_backup` VALUES ('73', '1.2.40.0.13.1.1000001544.20240112.20231017003981161449', '2023101700398', '12445', '1000001544', 'MUHRIANI MUHTIAR', null, 'btp jl. keruk timur 32 blok h no 374', 'F', '1992-07-02', '0', '38', 'RADIOLOGI', '01', 'CR', '1161', 'Fistulography', '1390000', 'MD0003', 'dr. Pratiwi Quranita, Sp.PD', null, null, '59061501', 'Nasir Tayyeb, A. Md. Rad', null, 'MD0037', 'dr. Kiki Amelia M., M.Kes, Sp.Rad (K)', null, '2024-01-12 00:00:00', '2024-01-12', '11:38:00', null, 'NORMAL', 'RADIOLOGI', null, 'COMMUNITY ACQUIRED PNEUMONIA-', 'BP0001', 'BPJS KESEHATAN', 'SIMRS', null, null);

-- ----------------------------
-- Table structure for xray_patient
-- ----------------------------
DROP TABLE IF EXISTS `xray_patient`;
CREATE TABLE `xray_patient` (
  `pk` int(10) NOT NULL AUTO_INCREMENT,
  `patientid` int(10) DEFAULT NULL,
  `mrn` varchar(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `birth_date` varchar(50) DEFAULT NULL,
  `weight` varchar(100) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `note` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pk`,`mrn`) USING BTREE,
  UNIQUE KEY `index_mrn` (`mrn`) USING BTREE,
  KEY `patientid` (`patientid`) USING BTREE,
  KEY `mrn` (`mrn`) USING BTREE,
  KEY `name` (`name`) USING BTREE,
  KEY `lastname` (`lastname`) USING BTREE,
  KEY `sex` (`sex`) USING BTREE,
  KEY `birth_date` (`birth_date`) USING BTREE,
  KEY `weight` (`weight`) USING BTREE,
  KEY `address` (`address`) USING BTREE,
  KEY `phone` (`phone`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_patient
-- ----------------------------
INSERT INTO `xray_patient` VALUES ('1', null, '12312312', 'andika', null, 'M', '2000-01-02', '80', null, null, null, null, '2023-05-02 16:41:05', '2023-05-02 16:41:05', null);
INSERT INTO `xray_patient` VALUES ('2', null, '213213', 'Rais', null, 'M', '2000-01-02', null, null, null, null, null, '2023-08-03 09:41:20', '2023-08-03 09:41:20', null);

-- ----------------------------
-- Table structure for xray_payment_insurance
-- ----------------------------
DROP TABLE IF EXISTS `xray_payment_insurance`;
CREATE TABLE `xray_payment_insurance` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `id_payment` varchar(255) NOT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pk`,`id_payment`) USING BTREE,
  KEY `id_payment` (`id_payment`) USING BTREE,
  KEY `payment` (`payment`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_payment_insurance
-- ----------------------------
INSERT INTO `xray_payment_insurance` VALUES ('1', '1', 'bpjs', null, null);

-- ----------------------------
-- Table structure for xray_radiographer
-- ----------------------------
DROP TABLE IF EXISTS `xray_radiographer`;
CREATE TABLE `xray_radiographer` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `radiographer_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `radiographer_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `radiographer_lastname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `radiographer_sex` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `radiographer_tlp` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `radiographer_email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE,
  KEY `radiographer_id` (`radiographer_id`) USING BTREE,
  KEY `radiographer_name` (`radiographer_name`) USING BTREE,
  KEY `radiographer_lastname` (`radiographer_lastname`) USING BTREE,
  KEY `radiographer_sex` (`radiographer_sex`) USING BTREE,
  KEY `radiographer_tlp` (`radiographer_tlp`) USING BTREE,
  KEY `radiographer_email` (`radiographer_email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_radiographer
-- ----------------------------
INSERT INTO `xray_radiographer` VALUES ('1', '1', 'radiografer', '1', 'Laki-Laki', '0', 'a@gmail.com');

-- ----------------------------
-- Table structure for xray_recyclebin
-- ----------------------------
DROP TABLE IF EXISTS `xray_recyclebin`;
CREATE TABLE `xray_recyclebin` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) CHARACTER SET utf8 NOT NULL,
  `acc` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `patientid` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `mrn` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sex` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `birth_date` varchar(19) CHARACTER SET utf8 DEFAULT NULL,
  `weight` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `depid` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `name_dep` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `xray_type_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `typename` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `prosedur` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `dokterid` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `named` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `lastnamed` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `radiographer_id` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `radiographer_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `radiographer_lastname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `dokradid` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `dokrad_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `dokrad_lastname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `schedule_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `schedule_time` time DEFAULT NULL,
  `contrast` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `priority` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `pat_state` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `contrast_allergies` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `spc_needs` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `payment` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `arrive_date` date DEFAULT NULL,
  `arrive_time` time DEFAULT NULL,
  `complete_date` date DEFAULT NULL,
  `complete_time` time DEFAULT NULL,
  `approve_date` date DEFAULT NULL,
  `approve_time` time DEFAULT NULL,
  `fill` longtext CHARACTER SET utf8,
  `status` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `study_datetime` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `updated_time` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `num_instances` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `num_series` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `series_desc` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `src_aet` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `del` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`pk`) USING BTREE,
  UNIQUE KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_recyclebin
-- ----------------------------

-- ----------------------------
-- Table structure for xray_selected_dokter_radiology
-- ----------------------------
DROP TABLE IF EXISTS `xray_selected_dokter_radiology`;
CREATE TABLE `xray_selected_dokter_radiology` (
  `pk` varchar(255) NOT NULL,
  `is_active` smallint(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_selected_dokter_radiology
-- ----------------------------
INSERT INTO `xray_selected_dokter_radiology` VALUES ('1', '0', '2023-05-02 16:45:08', '2023-05-02 16:45:08');

-- ----------------------------
-- Table structure for xray_study
-- ----------------------------
DROP TABLE IF EXISTS `xray_study`;
CREATE TABLE `xray_study` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `id_modality` varchar(255) DEFAULT NULL,
  `id_study` varchar(255) DEFAULT NULL,
  `study` varchar(100) DEFAULT NULL,
  `harga` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE,
  KEY `id_modality` (`id_modality`) USING BTREE,
  KEY `id_study` (`id_study`) USING BTREE,
  KEY `study` (`study`) USING BTREE,
  KEY `harga` (`harga`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_study
-- ----------------------------
INSERT INTO `xray_study` VALUES ('1', 'CR', '1', 'thorax', '1');
INSERT INTO `xray_study` VALUES ('2', 'CT', '1', 'CT HEAD', '1');

-- ----------------------------
-- Table structure for xray_take_envelope
-- ----------------------------
DROP TABLE IF EXISTS `xray_take_envelope`;
CREATE TABLE `xray_take_envelope` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_taken` smallint(6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pk`,`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_take_envelope
-- ----------------------------

-- ----------------------------
-- Table structure for xray_template
-- ----------------------------
DROP TABLE IF EXISTS `xray_template`;
CREATE TABLE `xray_template` (
  `template_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `fill` longtext,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`template_id`) USING BTREE,
  KEY `template_id` (`template_id`) USING BTREE,
  KEY `title` (`title`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_template
-- ----------------------------
INSERT INTO `xray_template` VALUES ('3', 'Thorax', 'Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal', 'sarah');
INSERT INTO `xray_template` VALUES ('4', 'Thorax PA', 'Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal', 'sarah');
INSERT INTO `xray_template` VALUES ('5', 'Thorax AP', '<p>Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal</p>\r\n', 'sarah');
INSERT INTO `xray_template` VALUES ('7', 'Pemeriksaan radiografi Toraks proyeksi PA', '<p><strong>Teknik: Pemeriksaan radiografi Toraks proyeksi PA</strong></p>\r\n\r\n<p><strong>Deskripsi:</strong></p>\r\n\r\n<p>Jantung tidak membesar, CTR &lt; 50%.</p>\r\n\r\n<p>Aorta dan mediastinum superior tidak melebar.</p>\r\n\r\n<p>Trakea di tengah. Kedua hilus tidak menebal.</p>\r\n\r\n<p>Corakan bronkovaskular kedua paru baik.</p>\r\n\r\n<p>Tidak tampak infiltrat maupun nodul di kedua paru.</p>\r\n\r\n<p>Kedua hemidiafragma licin. Kedua sinus kostofrenikus lancip.</p>\r\n\r\n<p>Tulang-tulang yang tervisualisasi optimal kesan intak.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Kesan:</strong></p>\r\n\r\n<p>Tidak tampak infiltrat maupun nodul di kedua paru.</p>\r\n\r\n<p>Jantung tidak membesar.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'sarah');
INSERT INTO `xray_template` VALUES ('10', 'Pemeriksaan radiografi Toraks proyeksi PA', '<strong>Teknik: Pemeriksaan radiografi Toraks proyeksi PA</strong><br />\r\n<br />\r\n<strong>Deskripsi:</strong><br />\r\nJantung tidak membesar, CTR &lt; 50%.<br />\r\nAorta dan mediastinum superior tidak melebar.<br />\r\nTrakea di tengah. Kedua hilus tidak menebal.<br />\r\nCorakan bronkovaskular kedua paru baik.<br />\r\nTidak tampak infiltrat maupun nodul di kedua paru.<br />\r\nKedua hemidiafragma licin. Kedua sinus kostofrenikus lancip.<br />\r\nTulang-tulang yang tervisualisasi optimal kesan intak.<br />\r\n<br />\r\n<strong>Kesan:</strong><br />\r\nTidak tampak infiltrat maupun nodul di kedua paru.<br />\r\nJantung tidak membesar.<br />\r\n&nbsp;', 'sarah');
INSERT INTO `xray_template` VALUES ('11', 'Pemeriksaan radiografi Toraks proyeksi AP', '<strong>Teknik: Pemeriksaan radiografi Toraks proyeksi AP</strong><br />\r\n<br />\r\n<strong>Deskripsi:</strong><br />\r\nJantung kesan tidak membesar.<br />\r\nAorta dan mediastinum superior tidak melebar.<br />\r\nTrakea di tengah. Kedua hilus tidak menebal.<br />\r\nCorakan bronkovaskular kedua paru baik.<br />\r\nTidak tampak infiltrat maupun nodul di kedua paru.<br />\r\nKedua hemidiafragma licin. Kedua sinus kostofrenikus lancip.<br />\r\nTulang-tulang yang tervisualisasi optimal kesan intak.<br />\r\n<br />\r\n<strong>Kesan:</strong><br />\r\nTidak tampak infiltrat maupun nodul di kedua paru.<br />\r\nJantung tidak membesar.<br />\r\n&nbsp;', 'sarah');
INSERT INTO `xray_template` VALUES ('13', 'USG Whole Abdomen', '<strong>USG Whole Abdomen </strong><br />\r\n<br />\r\nTelah dilakukan pemeriksaan USG abdomen dengan transducer kurvilinear 5-7 MHz.<br />\r\n<br />\r\n<br />\r\nHepar : Bentuk dan ukuran normal, dimensi craniocaudal sekitar &hellip; cm, permukaan reguler. Ekhostruktur parenkim homogen. Sistem bilier dan vaskuler intrahepatik tidak melebar. Tidak tampak nodul maupun SOL.<br />\r\nTidak tampak efusi pleura maupun asites.<br />\r\nKandung empedu : Bentuk dan ukuran normal. Dinding tidak menebal. Tidak tampak batu maupun sludge intralumen kandung empedu.<br />\r\nPankreas : Bentuk dan ukuran normal. Tidak tampak lesi fokal maupun SOL.<br />\r\nLien : Bentuk dan ukuran normal. Tidak tampak lesi fokal maupun SOL.<br />\r\nGinjal kanan: Bentuk normal, ukuran sekitar &hellip; x &hellip; x &hellip; cm, tebal parenkim sekitar &hellip; cm (N = 15-20 mm, tebal korteks N &gt;= 6 mm), diferensiasi korteks-medulla jelas. Sistem pelviokalises tidak melebar. Tidak tampak batu maupun SOL.<br />\r\nGinjal kiri: Bentuk normal, ukuran sekitar &hellip; x &hellip; x &hellip; cm, tebal parenkim sekitar &hellip; cm (N = 15-20 mm, tebal korteks N &gt;= 6 mm), diferensiasi korteks-medulla jelas. Sistem pelviokalises tidak melebar. Tidak tampak batu maupun SOL.<br />\r\nAorta abdominalis : Kaliber normal, tidak tampak pembesaran kelenjar limfe paraaorta.<br />\r\nVesika urinaria : Besar dan bentuk baik. Dinding tidak menebal (sekitar &hellip; cm). Tidak tampak batu, SOL, maupun debris intralumen.<br />\r\nUterus: besar dan bentuk baik, tidak tampak lesi fokal pada uterus dan adnexa bilateral.<br />\r\nProstat: Bentuk dan ukuran baik, estimasi volume sekitar &hellip; ml, tidak tampak lesi fokal maupun kalsifikasi intraparenkim.<br />\r\n<br />\r\nKesan:<br />\r\n&hellip;<br />\r\nTidak tampak kelainan pada organ intraabdomen lainnya yang tervisualisasi di atas.<br />\r\n&nbsp;', 'sarah');
INSERT INTO `xray_template` VALUES ('15', 'USG Thyroid', '<strong>USG Thyroid</strong><br />\r\n<br />\r\n<br />\r\nTelah dilakukan pemeriksaan USG thyroid, dengan hasil sebagai berikut:<br />\r\n<br />\r\n***Tampak nodul padat/kistik/padat kistik, an/iso/hipo/hiperekhoik, tepi reguler/berlobulasi/ireguler, wider than tall/taller than wide, dengan/tanpa kalsifikasi, dengan konfirmasi Doppler tampak/tidak tampak vaskularisasi, ukuran &hellip; x &hellip; x &hellip;<br />\r\n<br />\r\nThyroid kanan :<br />\r\nLobus thyroid bentuk dan ukuran normal.<br />\r\nTidak tampak lesi fokal patologis maupun kalsifikasi.<br />\r\nVaskularisasi dalam batas normal.<br />\r\n<br />\r\nThyroid kiri :<br />\r\nLobus thyroid bentuk dan ukuran normal.<br />\r\nTidak tampak lesi fokal patologis maupun kalsifikasi.<br />\r\nVaskularisasi dalam batas normal.<br />\r\n<br />\r\nIsthmus : Tidak menebal. Tidak tampak lesi fokal patologis maupun kalsifikasi.<br />\r\nTrakhea di tengah.<br />\r\nTidak tampak pembesaran kelenjar limfe regio colli<br />\r\n<br />\r\nKesan:<br />\r\nMultinodular goiter/diffuse goiter.<br />\r\nNodul padat kistik tiroid &hellip;<br />\r\nTidak tampak kelainan pada kedua lobus thyroid dan isthmus.<br />\r\nTidak tampak limfadenopati colli bilateral.', 'sarah');
INSERT INTO `xray_template` VALUES ('16', 'Radiografi Klavikula AP', '<strong>Radiografi Klavikula AP :</strong><br />\r\n<br />\r\nKedudukan os.clavicula baik, tidak tampak subluksasi maupun dislokasi.<br />\r\nTidak tanda-tanda tampak fraktur, destruksi, lesi litik maupun blastik.<br />\r\nTampak formasi osteofit di &hellip;<br />\r\nCelah sendi dan permukaan sendi sternoklavikula atau acromioclavicular baik.<br />\r\nJaringan lunak sekitar klavikula baik.<br />\r\n&nbsp;', 'sarah');
INSERT INTO `xray_template` VALUES ('17', 'USG Ginjal', '<strong>USG Ginjal </strong><br />\r\n<br />\r\nTelah dilakukan pemeriksaan USG urologi dengan hasil sebagai berikut :<br />\r\n<br />\r\nGinjal Kanan :<br />\r\nBentuk baik. Ukuran 11,6 x 4,9 cm. Tebal parenkim &hellip; cm. Permukaan reguler. Diferensiasi korteks medulla jelas. Tidak tampak pelebaran sistem pelviokalises. Tidak tampak batu/SOL.<br />\r\n<br />\r\nGinjal Kiri :<br />\r\nBentuk baik. Ukuran 9,5 x 5 cm. Tebal parenkim &hellip; cm. Permukaan reguler. Diferensiasi korteks medulla jelas. Tidak tampak pelebaran sistem pelviokalises. Tidak tampak batu/SOL.<br />\r\n<br />\r\nBuli-buli :<br />\r\nBentuk dan ukuran baik, dinding buli reguler dan tidak menebal. Tidak tampak batu/SOL.<br />\r\n<br />\r\nUterus:<br />\r\nBesar dan bentuk baik, tidak tampak lesi fokal pada uterus dan adnexa bilateral.<br />\r\n<br />\r\nProstat :<br />\r\nBentuk dan ukuran baik. Tidak tampak lesi fokal maupun kalsifikasi intraparenkim prostat.<br />\r\n&nbsp;', 'sarah');
INSERT INTO `xray_template` VALUES ('18', 'USG Testis', '<br />\r\n<strong>USG Testis</strong><br />\r\n<br />\r\nTelah dilakukan pemeriksaan USG testis dengan hasil sbb :<br />\r\nTestis Kanan:<br />\r\nTestis tampak terletak di dalam rongga skrotum. Ukuran membesar 4 x 2,7 cm. Tampak vaskularisasi meningkat. Tampak cairan di dalam rongga skrotum.<br />\r\nTestis kiri:<br />\r\nTestis tampak terletak di dalam rongga skrotum, Ukuran membesar 4,6 x 1,5 cm. Tampak vaskularisasi meningkat. Tampak cairan di dalam rongga skrotum.<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />\r\nKesan : Hidrokel, suspek Orchitis.<br />\r\n&nbsp;', 'sarah');
INSERT INTO `xray_template` VALUES ('19', 'USG Kepala', '<strong>USG Kepala</strong><br />\r\n<br />\r\nPemeriksaan USG Kepala dengan hasil sebagai berikut:<br />\r\n<br />\r\nKortikal sulci dan gyri terlihat baik.<br />\r\nTak tampak pelebaran sistem ventrikel.<br />\r\nTak tampak lesi hiperekhoik/periventrikular.<br />\r\nTak tampak kelainan pada corpus callosum dan basal ganglia.<br />\r\nThalamus kiri dan kanan tak tampak kelainan.<br />\r\nBatang otak dan cerebellum tak tampak kelainan.<br />\r\n<br />\r\nKesan:<br />\r\nTak tampak kelainan radiologis pada USG kepala saat ini.<br />\r\n&nbsp;', 'sarah');
INSERT INTO `xray_template` VALUES ('20', 'Pemeriksaan CT Scan Cerebral tanpa kontras intravena', '<strong>Teknik: Pemeriksaan CT Scan Cerebral tanpa kontras intravena</strong><br />\r\n<br />\r\n<strong>Deskripsi:</strong><br />\r\nSulci cerebri dan fissura Sylvii tidak melebar.<br />\r\nTidak tampak lesi patologis di intraparenkim cerebri dan cerebelli.<br />\r\nThalamus, pons, medulla oblongata dan CPA tidak tampak kelainan.<br />\r\nSella dan dorsum sella tidak tampak kelainan.<br />\r\nVentrikel lateralis kanan kiri, ventrikel III, dan IV tidak melebar.<br />\r\nSistem sisterna tidak melebar.<br />\r\n&mdash; (Tampak kalsifikasi fisiologis di pineal body dan pleksus koroideus bilateral.)---<br />\r\nTidak tampak pergeseran garis tengah.<br />\r\nKedua orbita, sinus paranasal, dan pneumatisasi air cell mastoid tidak tampak kelainan.<br />\r\nTulang-tulang yang tervisualisasi kesan intak.<br />\r\n<br />\r\nKesan:<br />\r\n- Tidak tampak tanda perdarahan, infark maupun SOL intrakranial.', 'sarah');
INSERT INTO `xray_template` VALUES ('21', 'CT Scan thorax tanpa kontras intravena', '<strong>Teknik: CT Scan thorax tanpa kontras intravena</strong><br />\r\n<br />\r\n<strong>Deskripsi:</strong><br />\r\nMediastinum superior tidak memperlihatkan kelainan.<br />\r\nTrakhea, bronkhus utama kanan-kiri terlihat baik.<br />\r\nTidak tampak pembesaran yang jelas pada kelenjar limfe mediastinum dan hilus.<br />\r\nJantung dan aorta kesan tidak membesar.<br />\r\nKedua paru tidak memperlihatkan adanya lesi patologis, nodul maupun infiltrat.<br />\r\nTak tampak penebalan pleura maupun efusi.<br />\r\nOrgan-organ abdomen atas yang tervisualisasi tidak memperlihatkan kelainan.<br />\r\nTulang-tulang kesan masih intak.<br />\r\n<br />\r\nKesan:<br />\r\nTidak tampak kelainan radiologis yang jelas di intra thorakal.<br />\r\n&nbsp;', 'sarah');
INSERT INTO `xray_template` VALUES ('22', 'CT Scan abdomen tanpa kontras intravena', '<strong>Teknik : CT Scan abdomen tanpa kontras intravena</strong><br />\r\n<br />\r\n<strong>Deskripsi :</strong><br />\r\nHepar bentuk dan ukuran baik. Densitas parenkim homogen. Tidak tampak lesi fokal patologis yang jelas maupun kalsifikasi.<br />\r\nTak tampak asites maupun efusi pleura.<br />\r\nKandung empedu bentuk dan ukuran baik, tidak tampak batu.<br />\r\nPankreas bentuk dan ukuran baik, tidak tampak kalsifikasi.<br />\r\nLimpa bentuk dan ukuran baik, densitas homogen. Tidak tampak kalsifikasi.<br />\r\nKedua ginjal bentuk dan ukuran baik. Tidak tampak batu maupun kalsifikasi.<br />\r\nGaster dan usus-usus tidak tampak dilatasi patologis.<br />\r\nAorta kaliber baik, tidak tampak kalsifikasi.<br />\r\nKelenjar limfe paraaorta dan parailiaka sulit dinilai, kesan tidak membesar.<br />\r\nVesika urinaria bentuk dan ukuran baik, tak tampak batu.<br />\r\nKelenjar prostat / Uterus dan adnexa tidak tampak kalsifikasi.<br />\r\nTulang-tulang tak tampak kelainan.<br />\r\n<br />\r\nKesan:<br />\r\nTidak tampak kelainan radiologis di intra abdomen.<br />\r\n&nbsp;', 'sarah');
INSERT INTO `xray_template` VALUES ('23', 'Radiografi abdomen 3 posisi (AP supine, AP erect, LLD):', '<strong>Radiografi abdomen 3 posisi (AP supine, AP erect, LLD):</strong><br />\r\n<br />\r\nLemak properitoneal masih baik.<br />\r\nPsoas line dan kontur kedua ginjal tertutup bayangan udara usus.<br />\r\nDistribusi udara usus mencapai distal dengan fecal material yang prominen.<br />\r\nTidak tampak dilatasi dan penebalan dinding usus.<br />\r\nTidak tampak multipel air-fluid level.<br />\r\nTidak tampak udara bebas ekstralumen.<br />\r\nTulang-tulang kesan intak.<br />\r\n<br />\r\nKesan:<br />\r\nTidak tampak ileus maupun pneumoperitoneum.<br />\r\n&nbsp;', 'sarah');
INSERT INTO `xray_template` VALUES ('24', 'Radiografi cervical proyeksi AP dan lateral dan oblik kanan dan kiri :', '<strong>Radiografi cervical proyeksi AP dan lateral dan oblik kanan dan kiri :</strong><br />\r\n<br />\r\nKelengkungan dan kedudukan vertebra cervical baik, tidak tampak listhesis.<br />\r\nStruktur dan bentuk vertebra cervicalis baik. Densitas vertebra cervical baik.<br />\r\nPedikel intak. Tidak tampak tanda-tanda fraktur, destruksi, lesi litik maupun blastik.<br />\r\nTampak formasi osteofit marginal di vertebra &hellip;<br />\r\nTidak tampak penyempitan celah diskus intervertebralis ataupun foramen intervertebralis.<br />\r\nSendi-sendi vertebra cervical terlihat baik.<br />\r\nJaringan lunak sekitar vertebra cervical baik.<br />\r\n&nbsp;', 'sarah');
INSERT INTO `xray_template` VALUES ('25', 'Radiografi soft tissue leher :', '<strong>Radiografi soft tissue leher :</strong><br />\r\n<br />\r\nTidak tampak penebalan jaringan lunak di regio colli.<br />\r\nTidak tampak penebalan jaringan lunak di retrotrakea dan retrofaring.<br />\r\nTidak tampak penyempitan ataupun deviasi trakea.<br />\r\nTidak tampak korpus alienum berdensitas radioopak.<br />\r\nTulang-tulang kesan intak.<br />\r\n&nbsp;', 'sarah');
INSERT INTO `xray_template` VALUES ('26', 'USG Mammae', '<strong>USG Mammae</strong><br />\r\nUltrasonografi mammae bilateral menggunakan transduser linear 12 MHz.<br />\r\n<br />\r\nMammae kanan:<br />\r\nKutis dan subkutis tidak menebal.<br />\r\nStruktur fibroglandular tidak memperlihatkan kelainan.<br />\r\nTidak tampak lesi fokal patologis maupun dilatasi duktus.<br />\r\nKelenjar limfe aksilla tidak membesar.<br />\r\n<br />\r\nMammae kiri:<br />\r\nKutis dan subkutis tidak menebal.<br />\r\nStruktur fibroglandular tidak memperlihatkan kelainan.<br />\r\nTidak tampak lesi fokal patologis maupun dilatasi duktus.<br />\r\nKelenjar limfe aksilla tidak membesar.<br />\r\n<br />\r\nKesan :<br />\r\nTidak tampak kelainan USG pada mammae dan aksilla bilateral.<br />\r\n&nbsp;', 'sarah');
INSERT INTO `xray_template` VALUES ('27', 'Radiografi vertebrae lumbosacral proyeksi AP dan lateral:', '<strong>Radiografi vertebrae lumbosacral proyeksi AP dan lateral:</strong><br />\r\n<br />\r\nKelengkungan vertebra lumbosacral baik, kedudukan baik, tidak tampak listesis.<br />\r\nStruktur dan bentuk vertebra lumbosacral baik. Densitas vertebra lumbosacral baik.<br />\r\nPedikel intak. Tidak tampak tanda-tanda fraktur, destruksi, lesi litik maupun blastik.<br />\r\nTampak formasi osteofit marginal di vertebra &hellip;<br />\r\nTidak tampak penyempitan celah diskus intervertebralis.<br />\r\nSendi-sendi vertebra lumbosacral dan sacroiliaca bilateral terlihat baik.<br />\r\nJaringan lunak paravertebra lumbal tidak menebal.<br />\r\n<br />\r\nKesan:<br />\r\nTidak tampak fraktur maupun listesis pada vertebra lumbosacral.<br />\r\nTidak tampak lesi patologis pada vertebra lumbosacral.<br />\r\n&nbsp;', 'sarah');
INSERT INTO `xray_template` VALUES ('29', 'CT Scan abdomen tanpa kontras intravena', '<p><strong>Teknik : CT Scan abdomen tanpa kontras intravena</strong><br />\r\n<br />\r\n<strong>Deskripsi :</strong><br />\r\nHepar bentuk dan ukuran baik. Densitas parenkim homogen. Tidak tampak lesi fokal patologis yang jelas maupun kalsifikasi.<br />\r\nTak tampak asites maupun efusi pleura.<br />\r\nKandung empedu bentuk dan ukuran baik, tidak tampak batu.<br />\r\nPankreas bentuk dan ukuran baik, tidak tampak kalsifikasi.<br />\r\nLimpa bentuk dan ukuran baik, densitas homogen. Tidak tampak kalsifikasi.<br />\r\nKedua ginjal bentuk dan ukuran baik. Tidak tampak batu maupun kalsifikasi.<br />\r\nGaster dan usus-usus tidak tampak dilatasi patologis.<br />\r\nAorta kaliber baik, tidak tampak kalsifikasi.<br />\r\nKelenjar limfe paraaorta dan parailiaka sulit dinilai, kesan tidak membesar.<br />\r\nVesika urinaria bentuk dan ukuran baik, tak tampak batu.<br />\r\nKelenjar prostat / Uterus dan adnexa tidak tampak kalsifikasi.<br />\r\nTulang-tulang tak tampak kelainan.<br />\r\n<br />\r\nKesan:<br />\r\nTidak tampak kelainan radiologis di intra abdomen.</p>\r\n', 'sarah');
INSERT INTO `xray_template` VALUES ('30', 'CT Scan abdomen tanpa kontras intravena', '<p><strong>Teknik : CT Scan abdomen tanpa kontras intravena</strong><br />\r\n<br />\r\n<strong>Deskripsi :</strong><br />\r\nHepar bentuk dan ukuran baik. Densitas parenkim homogen. Tidak tampak lesi fokal patologis yang jelas maupun kalsifikasi.<br />\r\nTak tampak asites maupun efusi pleura.<br />\r\nKandung empedu bentuk dan ukuran baik, tidak tampak batu.<br />\r\nPankreas bentuk dan ukuran baik, tidak tampak kalsifikasi.<br />\r\nLimpa bentuk dan ukuran baik, densitas homogen. Tidak tampak kalsifikasi.<br />\r\nKedua ginjal bentuk dan ukuran baik. Tidak tampak batu maupun kalsifikasi.<br />\r\nGaster dan usus-usus tidak tampak dilatasi patologis.<br />\r\nAorta kaliber baik, tidak tampak kalsifikasi.<br />\r\nKelenjar limfe paraaorta dan parailiaka sulit dinilai, kesan tidak membesar.<br />\r\nVesika urinaria bentuk dan ukuran baik, tak tampak batu.<br />\r\nKelenjar prostat / Uterus dan adnexa tidak tampak kalsifikasi.<br />\r\nTulang-tulang tak tampak kelainan.<br />\r\n<br />\r\nKesan:<br />\r\nTidak tampak kelainan radiologis di intra abdomen.<br />\r\n&nbsp;</p>\r\n', 'dokter');
INSERT INTO `xray_template` VALUES ('31', 'CT Scan thorax tanpa kontras intravena', '<p><strong>Teknik: CT Scan thorax tanpa kontras intravena</strong><br />\r\n<br />\r\n<strong>Deskripsi:</strong><br />\r\nMediastinum superior tidak memperlihatkan kelainan.<br />\r\nTrakhea, bronkhus utama kanan-kiri terlihat baik.<br />\r\nTidak tampak pembesaran yang jelas pada kelenjar limfe mediastinum dan hilus.<br />\r\nJantung dan aorta kesan tidak membesar.<br />\r\nKedua paru tidak memperlihatkan adanya lesi patologis, nodul maupun infiltrat.<br />\r\nTak tampak penebalan pleura maupun efusi.<br />\r\nOrgan-organ abdomen atas yang tervisualisasi tidak memperlihatkan kelainan.<br />\r\nTulang-tulang kesan masih intak.<br />\r\n<br />\r\nKesan:<br />\r\nTidak tampak kelainan radiologis yang jelas di intra thorakal.</p>\r\n', 'dokter');
INSERT INTO `xray_template` VALUES ('32', 'Pemeriksaan CT Scan Cerebral tanpa kontras intravena', '<p><strong>Teknik: Pemeriksaan CT Scan Cerebral tanpa kontras intravena</strong><br />\r\n<br />\r\n<strong>Deskripsi:</strong><br />\r\nSulci cerebri dan fissura Sylvii tidak melebar.<br />\r\nTidak tampak lesi patologis di intraparenkim cerebri dan cerebelli.<br />\r\nThalamus, pons, medulla oblongata dan CPA tidak tampak kelainan.<br />\r\nSella dan dorsum sella tidak tampak kelainan.<br />\r\nVentrikel lateralis kanan kiri, ventrikel III, dan IV tidak melebar.<br />\r\nSistem sisterna tidak melebar.<br />\r\n&mdash; (Tampak kalsifikasi fisiologis di pineal body dan pleksus koroideus bilateral.)---<br />\r\nTidak tampak pergeseran garis tengah.<br />\r\nKedua orbita, sinus paranasal, dan pneumatisasi air cell mastoid tidak tampak kelainan.<br />\r\nTulang-tulang yang tervisualisasi kesan intak.<br />\r\n<br />\r\nKesan:<br />\r\n- Tidak tampak tanda perdarahan, infark maupun SOL intrakranial.</p>\r\n', 'dokter');
INSERT INTO `xray_template` VALUES ('33', 'Pemeriksaan radiografi Toraks proyeksi AP', '<p><strong>Teknik: Pemeriksaan radiografi Toraks proyeksi AP</strong><br />\r\n<br />\r\n<strong>Deskripsi:</strong><br />\r\nJantung kesan tidak membesar.<br />\r\nAorta dan mediastinum superior tidak melebar.<br />\r\nTrakea di tengah. Kedua hilus tidak menebal.<br />\r\nCorakan bronkovaskular kedua paru baik.<br />\r\nTidak tampak infiltrat maupun nodul di kedua paru.<br />\r\nKedua hemidiafragma licin. Kedua sinus kostofrenikus lancip.<br />\r\nTulang-tulang yang tervisualisasi optimal kesan intak.<br />\r\n<br />\r\n<strong>Kesan:</strong><br />\r\nTidak tampak infiltrat maupun nodul di kedua paru.<br />\r\nJantung tidak membesar.</p>\r\n', 'dokter');
INSERT INTO `xray_template` VALUES ('34', 'Pemeriksaan radiografi Toraks proyeksi PA', '<p><strong>Teknik: Pemeriksaan radiografi Toraks proyeksi PA</strong></p>\r\n\r\n<p><strong>Deskripsi:</strong></p>\r\n\r\n<p>Jantung tidak membesar, CTR &lt; 50%.</p>\r\n\r\n<p>Aorta dan mediastinum superior tidak melebar.</p>\r\n\r\n<p>Trakea di tengah. Kedua hilus tidak menebal.</p>\r\n\r\n<p>Corakan bronkovaskular kedua paru baik.</p>\r\n\r\n<p>Tidak tampak infiltrat maupun nodul di kedua paru.</p>\r\n\r\n<p>Kedua hemidiafragma licin. Kedua sinus kostofrenikus lancip.</p>\r\n\r\n<p>Tulang-tulang yang tervisualisasi optimal kesan intak.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Kesan:</strong></p>\r\n\r\n<p>Tidak tampak infiltrat maupun nodul di kedua paru.</p>\r\n\r\n<p>Jantung tidak membesar.</p>\r\n', 'dokter');
INSERT INTO `xray_template` VALUES ('36', 'Radiografi abdomen 3 posisi (AP supine, AP erect, LLD)', '<p><strong>Radiografi abdomen 3 posisi (AP supine, AP erect, LLD):</strong><br />\r\n<br />\r\nLemak properitoneal masih baik.<br />\r\nPsoas line dan kontur kedua ginjal tertutup bayangan udara usus.<br />\r\nDistribusi udara usus mencapai distal dengan fecal material yang prominen.<br />\r\nTidak tampak dilatasi dan penebalan dinding usus.<br />\r\nTidak tampak multipel air-fluid level.<br />\r\nTidak tampak udara bebas ekstralumen.<br />\r\nTulang-tulang kesan intak.<br />\r\n<br />\r\nKesan:<br />\r\nTidak tampak ileus maupun pneumoperitoneum.</p>\r\n', 'dokter');
INSERT INTO `xray_template` VALUES ('37', 'Radiografi cervical proyeksi AP dan lateral dan oblik kanan dan kiri', '<p><strong>Radiografi cervical proyeksi AP dan lateral dan oblik kanan dan kiri :</strong><br />\r\n<br />\r\nKelengkungan dan kedudukan vertebra cervical baik, tidak tampak listhesis.<br />\r\nStruktur dan bentuk vertebra cervicalis baik. Densitas vertebra cervical baik.<br />\r\nPedikel intak. Tidak tampak tanda-tanda fraktur, destruksi, lesi litik maupun blastik.<br />\r\nTampak formasi osteofit marginal di vertebra &hellip;<br />\r\nTidak tampak penyempitan celah diskus intervertebralis ataupun foramen intervertebralis.<br />\r\nSendi-sendi vertebra cervical terlihat baik.<br />\r\nJaringan lunak sekitar vertebra cervical baik.</p>\r\n', 'dokter');
INSERT INTO `xray_template` VALUES ('38', 'PA,erect, simetri,inspirasi dan kondisi cukup;', '<p>Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal</p>\r\n', 'dokter');
INSERT INTO `xray_template` VALUES ('41', 'Radiografi soft tissue leher', '<p><strong>Radiografi soft tissue leher :</strong><br />\r\n<br />\r\nTidak tampak penebalan jaringan lunak di regio colli.<br />\r\nTidak tampak penebalan jaringan lunak di retrotrakea dan retrofaring.<br />\r\nTidak tampak penyempitan ataupun deviasi trakea.<br />\r\nTidak tampak korpus alienum berdensitas radioopak.<br />\r\nTulang-tulang kesan intak.</p>\r\n', 'dokter');
INSERT INTO `xray_template` VALUES ('42', 'Radiografi Ankle Joint â€¦ proyeksi AP dan lateral :', '<p>Radiografi Ankle Joint &hellip; proyeksi AP dan lateral :</p>\r\n\r\n<p>Kedudukan tulang-tulang pembentuk ankle joint baik, tidak tampak subluksasi maupun dislokasi.&nbsp;&nbsp;</p>\r\n\r\n<p>Tidak tampak tanda-tanda fraktur, destruksi, lesi litik maupun blastik.</p>\r\n\r\n<p>Tampak formasi osteofit di &hellip;</p>\r\n\r\n<p>Celah sendi dan permukaan sendi tibiotalar dan calcaneotarsal terlihat baik.</p>\r\n\r\n<p>Kager fat pad tidak tampak suram.</p>\r\n\r\n<p>Jaringan lunak sekitar regio ankle tidak menebal.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Kesan:</p>\r\n\r\n<p>Tidak tampak fraktur maupun dislokasi pada regio ankle &hellip;</p>\r\n\r\n<p>Tidak tampak lesi patologis pada regio ankle &hellip;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'dokter');
INSERT INTO `xray_template` VALUES ('47', 'test', 'test', 'dokter');
INSERT INTO `xray_template` VALUES ('48', 'contoh', 'Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal', 'sarah');

-- ----------------------------
-- Table structure for xray_upload_excel
-- ----------------------------
DROP TABLE IF EXISTS `xray_upload_excel`;
CREATE TABLE `xray_upload_excel` (
  `id` int(19) NOT NULL,
  `tanggal_upload` varchar(255) DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `tipe_file` varchar(255) DEFAULT NULL,
  `ukuran_file` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_upload_excel
-- ----------------------------
INSERT INTO `xray_upload_excel` VALUES ('1', '2023-08-07', 'testing', 'xls', '113746', 'files/testing.xls');
INSERT INTO `xray_upload_excel` VALUES ('2', '2023-08-07', 'laporan bulan januari', 'xls', '1509491', 'files/laporan bulan januari.xls');
INSERT INTO `xray_upload_excel` VALUES ('3', '2023-08-07', 'laporan bulan februari', 'xls', '3144', 'files/laporan bulan februari.xls');

-- ----------------------------
-- Table structure for xray_upload_pdf
-- ----------------------------
DROP TABLE IF EXISTS `xray_upload_pdf`;
CREATE TABLE `xray_upload_pdf` (
  `id` int(19) NOT NULL,
  `contract_id` varchar(255) DEFAULT NULL,
  `tanggal_upload` varchar(255) DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `tipe_file` varchar(255) DEFAULT NULL,
  `ukuran_file` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_upload_pdf
-- ----------------------------

-- ----------------------------
-- Table structure for xray_workload
-- ----------------------------
DROP TABLE IF EXISTS `xray_workload`;
CREATE TABLE `xray_workload` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `accession_no` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `fill` longtext CHARACTER SET utf8,
  `approved_at` datetime DEFAULT NULL,
  `approve_updated_at` datetime DEFAULT NULL,
  `pk_dokter_radiology` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `study_datetime_pacsio` datetime DEFAULT NULL,
  `updated_time_pacsio` datetime DEFAULT NULL,
  `study_desc_pacsio` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `priority_doctor` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `signature` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `signature_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE,
  KEY `accession_no` (`accession_no`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `approved_at` (`approved_at`) USING BTREE,
  KEY `approve_updated_at` (`approve_updated_at`) USING BTREE,
  KEY `pk_dokter_radiology` (`pk_dokter_radiology`) USING BTREE,
  KEY `study_datetime_pacsio` (`study_datetime_pacsio`) USING BTREE,
  KEY `updated_time_pacsio` (`updated_time_pacsio`) USING BTREE,
  KEY `study_desc_pacsio` (`study_desc_pacsio`) USING BTREE,
  KEY `priority_doctor` (`priority_doctor`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_workload
-- ----------------------------
INSERT INTO `xray_workload` VALUES ('12', '1.2.392.200036.9125.2.22476545153.6527619691.7268232', '774', 'waiting', null, null, null, null, '2023-02-16 11:41:31', '2023-02-16 12:00:30', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('13', '1.2.40.0.13.1.669124.20101410406.2114174143', '2114174', 'approved', '<strong>HASIL DUMMY EDITED<br />\r\nTeknik: CT Scan thorax tanpa kontras intravena</strong><br />\r\n<br />\r\n<strong>Deskripsi:</strong><br />\r\nMediastinum superior tidak memperlihatkan kelainan.<br />\r\nTrakhea, bronkhus utama kanan-kiri terlihat baik.<br />\r\nTidak tampak pembesaran yang jelas pada kelenjar limfe mediastinum dan hilus.<br />\r\nJantung dan aorta kesan tidak membesar.<br />\r\nKedua paru tidak memperlihatkan adanya lesi patologis, nodul maupun infiltrat.<br />\r\nTak tampak penebalan pleura maupun efusi.<br />\r\nOrgan-organ abdomen atas yang tervisualisasi tidak memperlihatkan kelainan.<br />\r\nTulang-tulang kesan masih intak.<br />\r\n<br />\r\nKesan:<br />\r\nTidak tampak kelainan radiologis yang jelas di intra thorakal.<br />\r\n&nbsp;', '2023-12-12 14:03:00', '2023-12-12 14:05:31', '1', '2020-10-14 11:39:27', '2023-02-03 16:39:18', 'CARDIAC^2_CORONARYCTA (ADULT)', 'normal', '1.2.40.0.13.1.669124.20101410406.2114174143.png', '2023-12-12 14:05:31');
INSERT INTO `xray_workload` VALUES ('14', '1.2.40.0.13.1.1562647.2323134920.2323365127', '01562647', 'waiting', null, null, null, null, '2023-02-03 13:40:55', '2023-02-03 14:36:41', 'THORAX', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('15', '1.2.40.0.13.1.1379654.2323134941.2323326127', '01379654', 'approved', 'Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal', '2023-05-17 11:15:17', '2023-08-07 14:18:13', '1', '2023-02-03 13:46:23', '2023-02-03 14:25:56', null, 'normal', '1.2.40.0.13.1.1379654.2323134941.2323326127.png', '2023-05-17 11:15:17');
INSERT INTO `xray_workload` VALUES ('16', '1.2.40.0.13.1.847029.20230126.11244206401', null, 'waiting', null, null, null, null, null, '2023-01-26 13:25:14', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('17', '1.2.276.0.7230010.3.0.3.5.1.13496901.319908297', 'DX000003', 'waiting', null, null, null, null, '2023-01-17 09:41:13', '2023-01-26 13:30:58', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('18', '1.2.276.0.7230010.3.0.3.5.1.13496898.490327001', 'DX000002', 'approved', 'what is lorem ipsum?<br />\r\nLorem ipsum is simply dumply text of the printing and typesetting industry. lorem ipsum has been the industry<br />\r\nkesan : lorem ipsum text printer', '2023-05-17 10:55:27', null, '1', '2023-01-17 09:38:50', '2023-01-17 09:51:50', null, 'normal', '1.2.276.0.7230010.3.0.3.5.1.13496898.490327001.png', '2023-05-17 10:55:27');
INSERT INTO `xray_workload` VALUES ('19', '1.2.276.0.7230010.3.0.3.5.1.13484708.2510452666', 'DX000036', 'waiting', null, null, null, null, '2023-01-11 11:16:01', '2023-01-11 11:40:41', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('20', '1.2.276.0.7230010.3.0.3.5.1.13482813.359075147', 'DX000025', 'waiting', null, null, null, null, '2023-01-10 13:49:02', '2023-01-10 15:54:18', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('21', '1.2.276.0.7230010.3.0.3.5.1.13482790.2369068798', 'DX000020', 'waiting', null, null, null, null, '2023-01-10 13:26:27', '2023-01-10 15:51:19', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('22', '1.2.276.0.7230010.3.0.3.5.1.13482787.3379395533', 'DX000019', 'waiting', null, null, null, null, '2023-01-10 13:23:49', '2023-01-10 15:49:18', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('23', '1.2.826.0.1.3680043.2.876.15656.1.8910.20221213093533.0.35', '1850958f0a3', 'waiting', null, null, null, null, '2022-12-13 09:35:33', '2022-12-14 13:59:52', 'CHEST / SHOULDER GIRDLE', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('24', '1.2.826.0.1.3680043.2.876.15656.1.8910.20221213133034.0.4', '1850a31d87b', 'waiting', null, null, null, null, '2022-12-13 13:30:34', '2022-12-14 13:59:16', 'CHEST / SHOULDER GIRDLE', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('25', '1.2.276.0.7230010.3.0.3.5.1.13413353.2909670469', 'DX000052', 'waiting', null, null, null, null, '2022-12-07 16:41:32', '2022-12-14 13:22:54', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('26', '1.2.826.0.1.3680043.2.876.15656.2.8910.20220921092228.0.3', '1835ddbb78d', 'waiting', null, null, null, null, '2022-09-21 09:22:28', '2023-03-07 10:24:31', 'CHEST / SHOULDER GIRDLE', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('27', '1.2.826.0.1.3680043.2.876.17701.1.8910.20220923020848.0.6', '183669ba9e0', 'waiting', null, null, null, null, '2022-09-23 02:08:48', '2022-09-23 09:30:13', 'ABDOMEN / PELVIS, CHEST / SHOULDER GIRDLE', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('28', '1.3.12.2.1107.5.13.2.0.30000022072207154146500000001', null, 'waiting', null, null, null, null, '2022-07-22 14:02:32', '2022-08-16 09:58:45', 'CORONARY^DIAGNOSTIC CORONARY CATHETERIZATION', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('29', '1.3.51.0.7.1746109436.42736.40512.46889.57199.43927.48705', '51 Thn', 'waiting', null, null, null, null, '2020-04-13 11:01:35', '2023-03-07 10:19:54', 'CHEST', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('30', '1.2.392.200036.9116.2.5.1.14.3338208259.1546404614.955983', '014416327698', 'approved', '<strong>CONTOH HASIL EXPERTISE DUMMY<br />\r\n<br />\r\nTeknik : CT Scan abdomen tanpa kontras intravena</strong><br />\r\n<br />\r\n<strong>Deskripsi :</strong><br />\r\nHepar bentuk dan ukuran baik. Densitas parenkim homogen. Tidak tampak lesi fokal patologis yang jelas maupun kalsifikasi.<br />\r\nTak tampak asites maupun efusi pleura.<br />\r\nKandung empedu bentuk dan ukuran baik, tidak tampak batu.<br />\r\nPankreas bentuk dan ukuran baik, tidak tampak kalsifikasi.<br />\r\nLimpa bentuk dan ukuran baik, densitas homogen. Tidak tampak kalsifikasi.<br />\r\nKedua ginjal bentuk dan ukuran baik. Tidak tampak batu maupun kalsifikasi.<br />\r\nGaster dan usus-usus tidak tampak dilatasi patologis.<br />\r\nAorta kaliber baik, tidak tampak kalsifikasi.<br />\r\nKelenjar limfe paraaorta dan parailiaka sulit dinilai, kesan tidak membesar.<br />\r\nVesika urinaria bentuk dan ukuran baik, tak tampak batu.<br />\r\nKelenjar prostat / Uterus dan adnexa tidak tampak kalsifikasi.<br />\r\nTulang-tulang tak tampak kelainan.<br />\r\n<br />\r\nKesan:<br />\r\nTidak tampak kelainan radiologis di intra abdomen.<br />\r\n&nbsp;', '2023-11-22 11:06:10', null, '1', '2019-01-02 13:52:20', '2021-10-27 14:14:04', null, 'normal', '1.2.392.200036.9116.2.5.1.14.3338208259.1546404614.955983.png', '2023-11-22 11:06:10');
INSERT INTO `xray_workload` VALUES ('31', '1.2.840.113564.1921681010.20191015084726754890', null, 'waiting', null, null, null, null, '2019-10-15 08:51:17', '2021-06-04 11:26:46', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('32', '1.2.840.113564.1921681010.20191015083127954840', null, 'waiting', null, null, null, null, '2019-10-15 08:34:21', '2021-06-04 11:26:47', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('33', '1.2.840.113564.1921681010.20191015091343023970', null, 'waiting', null, null, null, null, '2019-10-15 09:15:04', '2021-06-04 11:26:47', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('34', '1.2.840.113564.1921681010.201910150936021422', null, 'waiting', null, null, null, null, '2019-10-15 09:39:37', '2021-06-04 11:26:48', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('35', '1.2.840.113564.1921681011.20191015083858984410', null, 'waiting', null, null, null, null, '2019-10-15 08:44:51', '2021-06-04 11:26:48', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('36', '1.2.840.113619.2.398.3.2831165706.124.1564613102.595', null, 'waiting', null, null, null, null, '2019-08-04 21:33:21', '2021-06-04 12:45:33', 'CT HEAD', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('37', '1.2.840.113619.2.398.3.2831165706.308.1566191555.472', null, 'approved', '<strong>Teknik: Pemeriksaan radiografi Toraks proyeksi PA</strong><br />\r\n<strong>Deskripsi:</strong><br />\r\nJantung tidak membesar, CTR &lt; 50%.<br />\r\nAorta dan mediastinum superior tidak melebar.<br />\r\nTrakea di tengah. Kedua hilus tidak menebal.<br />\r\nCorakan bronkovaskular kedua paru baik.<br />\r\nTidak tampak infiltrat maupun nodul di kedua paru.<br />\r\nKedua hemidiafragma licin. Kedua sinus kostofrenikus lancip.<br />\r\nTulang-tulang yang tervisualisasi optimal kesan intak.<br />\r\n&nbsp;<br />\r\n<strong>Kesan:</strong><br />\r\nTidak tampak infiltrat maupun nodul di kedua paru.<br />\r\nJantung tidak membesar.<br />\r\n&nbsp;', '2023-08-24 10:26:53', null, '1', '2019-08-25 16:57:11', '2021-06-04 12:46:24', 'CT HEAD', 'normal', '1.2.840.113619.2.398.3.2831165706.308.1566191555.472.png', '2023-08-24 10:26:53');
INSERT INTO `xray_workload` VALUES ('38', '1.2.840.113619.2.398.3.2831165706.238.1565317944.57', null, 'waiting', null, null, null, null, '2019-08-16 10:26:26', '2021-06-04 12:47:22', 'CT HEAD', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('39', '1.2.840.113619.2.398.3.2831165706.158.1566883692.188', null, 'waiting', null, null, null, null, '2019-08-30 09:36:18', '2021-06-04 12:53:05', 'CT WHOLE ABDOMEN IV', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('40', '1.2.840.113619.2.398.3.2831165706.238.1565317945.706', null, 'waiting', 'test', null, null, null, '2019-08-17 12:07:20', '2023-03-07 10:16:05', 'CT SCAN GENU DEXTRA', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('41', '1.2.40.0.13.1.20784.20117111428.2117288122', '2117288', 'waiting', null, null, null, null, '2020-11-07 11:32:29', '2021-06-04 12:57:19', 'MAGDALENA', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('42', '11.2.250.1.90.1.1481436678.1566785445.184', null, 'waiting', null, null, null, null, '2019-08-26 08:54:00', '2021-06-04 12:57:52', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('43', '1.2.156.112657.55.1.2.1118315496.3432.1566621094.700', null, 'waiting', null, null, null, null, '2019-08-24 11:31:34', '2021-06-04 12:58:36', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('44', '1.2.826.0.1.3680043.2.876.15280.1.3.20210210112649.0.4', '172ad908411', 'waiting', null, null, null, null, '2020-06-13 19:01:44', '2021-06-14 15:13:28', 'ABDOMEN / PELVIS', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('45', '1.2.826.0.1.3680043.2.876.17702.1.3.20210219144701.0.4', '172bb62787e', 'waiting', null, null, null, null, '2021-02-19 11:25:12', '2021-06-15 12:00:43', 'UPPER LEG WITH KNEE AP, 19.02.2021', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('46', '1.2.826.0.1.3680043.2.876.15280.1.8910.20210615134139.0.197', '172eb02ca95', 'waiting', null, null, null, null, '2021-02-19 10:03:08', '2021-06-15 14:53:20', 'CHEST LAT', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('47', '1.2.826.0.1.3680043.2.876.15280.1.8910.20210615132453.0.141', '172eb02ca95', 'waiting', null, null, null, null, '2021-02-19 10:03:08', '2021-06-15 14:53:06', 'CHEST LAT', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('48', '1.2.826.0.1.3680043.2.876.15280.1.8910.20210615120138.0.105', '1705b87440f', 'waiting', null, null, null, null, '2020-02-19 10:33:44', '2021-06-15 14:54:02', 'PFOR.DR.H.ARI YUNANTO, SP.A(K)', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('49', '1.2.826.0.1.3680043.2.876.15280.1.8910.20210615133948.0.187', '17055cd6be6', 'waiting', null, null, null, null, '2020-02-18 07:56:22', '2021-06-15 14:53:46', 'DR.H.ABIMANYU,SPPD', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('50', '1.2.826.0.1.3680043.2.876.15280.1.8910.20210615120107.0.72', '1730855d47b', 'waiting', null, null, null, null, '2021-02-19 10:03:08', '2021-06-15 14:53:51', 'CHEST LAT', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('51', '1.2.826.0.1.3680043.2.876.15280.1.8910.20210615133525.0.157', '1705b87440f', 'waiting', null, null, null, null, '2020-02-19 10:33:44', '2021-06-15 14:53:33', 'PFOR.DR.H.ARI YUNANTO, SP.A(K)', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('52', '1.2.826.0.1.3680043.2.876.15280.1.8910.20210615152732.0.11', '17057d75be5', 'waiting', null, null, null, null, '2020-02-18 17:22:03', '2021-06-15 15:27:54', 'PROF.DR.DR.H.RUSLAN M,SP.A(K)', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('53', '1.2.826.0.1.3680043.2.876.15280.1.8910.20210615150320.0.29', '17057905b1b', 'waiting', null, null, null, null, '2020-02-18 15:48:10', '2021-06-15 15:42:09', 'DR.NANI ZAITUN,SPPD', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('54', '1.3.51.0.7.2006760244.13153.847.33178.30538.14027.11663', null, 'waiting', null, null, null, null, '2021-06-16 03:36:24', '2021-06-16 15:37:47', 'ABDOMEN', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('55', '1.3.51.0.7.1609908264.22091.19780.45635.21788.59976.37934', 'STAT', 'waiting', null, null, null, null, '2021-06-16 03:19:10', '2021-06-16 16:06:17', 'ABDOMEN', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('56', '1.3.51.0.7.1599143838.23070.30277.38123.16707.16091.64880', null, 'waiting', null, null, null, null, '2021-06-16 03:38:58', '2021-06-16 16:10:40', 'ABDOMEN', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('57', '1.2.826.0.1.3680043.2.876.15280.1.8910.20210618132020.0.1', '17a1dc86937', 'waiting', null, null, null, null, '2021-06-18 13:20:20', '2021-06-18 13:33:37', 'CHEST / SHOULDER GIRDLE', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('58', '1.3.51.0.7.12311578542.34129.62274.42946.21339.2885.26885', null, 'waiting', null, null, null, null, '2021-06-18 15:10:30', '2021-06-18 15:25:26', 'CHEST', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('59', '1.2.840.113564.10151014.20200828074430349200', '329203', 'waiting', null, null, null, null, '2020-08-28 07:45:14', '2021-09-22 10:59:04', 'IGD', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('60', '1.2.40.0.13.1.54739.21331142831.21331393158', '54739', 'waiting', null, null, null, null, '2021-03-31 12:56:59', '2021-09-22 10:59:05', 'IGD', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('61', '1.2.40.0.13.1.596979.20210921.118411', 'R.RJ-631/1', 'waiting', null, null, null, null, '2021-09-21 09:56:42', '2021-09-22 10:59:08', 'VERT. LUMBOSACRAL AP + LAT', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('62', '1.2.276.0.26.1.1.1.2.664243.20211001.118999', 'R.RJ-734/1', 'approved', 'Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal', '2023-09-22 13:37:36', null, '1', '2021-10-01 16:22:14', '2021-10-01 14:43:56', 'USG APPENDIX/ UROLOGI', 'normal', '1.2.276.0.26.1.1.1.2.664243.20211001.118999.png', '2023-09-22 13:37:36');
INSERT INTO `xray_workload` VALUES ('63', '1.2.392.200036.9116.6.18.17533305.1467.20230719224714568.1.2', null, 'waiting', null, null, null, null, '2023-07-20 07:47:14', '2023-07-20 10:49:48', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('64', '1.2.392.200036.9116.6.18.17533305.1467.20230719224714568.1.2', null, 'waiting', null, null, null, null, '2023-07-20 07:47:14', '2023-07-20 10:53:39', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('65', '1.2.392.200036.9116.6.18.17533305.1467.20230719224714568.1.2', null, 'waiting', null, null, null, null, '2023-07-20 07:47:14', '2023-07-20 10:54:27', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('66', '1.2.392.200036.9116.6.18.17533305.1467.20230719224714568.1.2', null, 'waiting', null, null, null, null, '2023-07-20 07:47:14', '2023-07-20 10:55:03', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('67', '1.2.276.0.7230010.3.1.2.3854932796.38272.1689826075.660', null, 'waiting', null, null, null, null, '2023-07-20 11:07:53', '2023-07-20 11:18:26', 'USG PARA ILLIACA', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('68', '1.2.276.0.7230010.3.1.2.3854932796.38272.1689826075.660', null, 'waiting', null, null, null, null, '2023-07-20 11:07:53', '2023-07-20 11:22:23', 'USG PARA ILLIACA', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('69', '1.2.392.200036.9116.6.18.17533305.1467.20230719224714568.1.2', null, 'waiting', null, null, null, null, '2023-07-20 07:47:14', '2023-07-20 11:22:23', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('70', '1.2.392.200036.9116.6.18.17533305.1467.20230719224714568.1.2', null, 'waiting', null, null, null, null, '2023-07-20 07:47:14', '2023-07-20 11:25:55', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('71', '1.2.276.0.7230010.3.1.2.3854932796.38272.1689826075.660', null, 'waiting', null, null, null, null, '2023-07-20 11:07:53', '2023-07-20 11:39:48', 'USG PARA ILLIACA', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('72', '1.2.276.0.7230010.3.1.2.3854932796.38272.1689826075.660', null, 'waiting', null, null, null, null, '2023-07-20 11:07:53', '2023-07-20 12:05:55', 'USG PARA ILLIACA', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('73', '1.2.276.0.7230010.3.0.3.5.1.13882163.3310729256', 'DX000001', 'waiting', null, null, null, null, '2023-07-24 14:04:58', '2023-07-24 14:33:47', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('74', '1.2.276.0.7230010.3.0.3.5.1.13882255.1425595246', 'DX000002', 'approved', '<strong>Teknik: Pemeriksaan radiografi Toraks proyeksi PA</strong><br />\r\n<strong>Deskripsi:</strong><br />\r\nJantung tidak membesar, CTR &lt; 50%.<br />\r\nAorta dan mediastinum superior tidak melebar.<br />\r\nTrakea di tengah. Kedua hilus tidak menebal.<br />\r\nCorakan bronkovaskular kedua paru baik.<br />\r\nTidak tampak infiltrat maupun nodul di kedua paru.<br />\r\nKedua hemidiafragma licin. Kedua sinus kostofrenikus lancip.<br />\r\nTulang-tulang yang tervisualisasi optimal kesan intak.<br />\r\n&nbsp;<br />\r\n<strong>Kesan:</strong><br />\r\nTidak tampak infiltrat maupun nodul di kedua paru.<br />\r\nJantung tidak membesar.<br />\r\n&nbsp;', '2023-08-29 13:59:10', null, '1', '2023-07-24 14:04:58', '2023-07-24 15:18:54', null, 'normal', '1.2.276.0.7230010.3.0.3.5.1.13882255.1425595246.png', '2023-08-29 13:59:10');
INSERT INTO `xray_workload` VALUES ('75', '1.2.276.0.7230010.3.0.3.5.1.13882268.1707769125', 'DX000003', 'waiting', null, null, null, null, '2023-07-24 14:04:58', '2023-07-24 15:26:02', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('76', '1.2.276.0.7230010.3.0.3.5.1.13882271.1823960096', 'DX000004', 'waiting', null, null, null, null, '2023-07-24 14:04:58', '2023-07-24 15:27:27', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('77', '1.2.276.0.7230010.3.0.3.5.1.13882276.2563500696', 'DX000005', 'waiting', null, null, null, null, '2023-07-24 14:04:58', '2023-07-24 15:32:38', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('78', '1.2.276.0.7230010.3.0.3.5.1.13882278.3835618386', 'DX000006', 'waiting', null, null, null, null, '2023-07-24 14:04:58', '2023-07-24 15:34:57', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('79', '1.2.276.0.7230010.3.0.3.5.1.13882280.2989917407', 'DX000007', 'waiting', null, null, null, null, '2023-07-24 14:04:58', '2023-07-24 15:36:27', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('80', '1.2.276.0.7230010.3.0.3.5.1.13882282.4028548782', 'DX000008', 'waiting', null, null, null, null, '2023-07-24 14:04:58', '2023-07-24 15:38:49', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('81', '1.2.276.0.7230010.3.0.3.5.1.13882283.580648113', 'DX000009', 'waiting', null, null, null, null, '2023-07-24 14:04:58', '2023-07-24 15:40:04', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('82', '1.2.276.0.7230010.3.0.3.5.1.13882286.3849256137', 'DX000010', 'waiting', null, null, null, null, '2023-07-24 14:04:58', '2023-07-24 15:44:04', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('83', '1.2.276.0.7230010.3.0.3.5.1.13882289.2871479221', 'DX000011', 'waiting', null, null, null, null, '2023-07-24 14:04:58', '2023-07-24 15:45:59', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('84', '1.2.276.0.7230010.3.0.3.5.1.13882293.2887427630', 'DX000012', 'waiting', null, null, null, null, '2023-07-24 14:04:58', '2023-07-24 15:49:30', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('85', '1.2.276.0.7230010.3.0.3.5.1.13882296.4027184491', 'DX000013', 'waiting', null, null, null, null, '2023-07-24 14:04:58', '2023-07-24 15:53:03', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('86', '1.2.276.0.7230010.3.0.3.5.1.13882299.2216591471', 'DX000014', 'waiting', null, null, null, null, '2023-07-24 14:04:58', '2023-07-24 15:56:41', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('87', '1.2.276.0.7230010.3.0.3.5.1.13882303.502673155', 'DX000015', 'waiting', null, null, null, null, '2023-07-24 14:04:58', '2023-07-24 16:00:13', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('88', '1.2.276.0.7230010.3.0.3.5.1.13882305.1336909048', 'DX000016', 'waiting', null, null, null, null, '2023-07-24 14:04:58', '2023-07-24 16:02:05', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('89', '1.2.276.0.7230010.3.0.3.5.1.13884017.435640839', 'DX000002', 'waiting', null, null, null, null, '2023-07-25 10:25:10', '2023-07-25 10:32:37', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('90', '1.2.276.0.7230010.3.0.3.5.1.13898530.1921374246', 'DX000028', 'waiting', null, null, null, null, '2023-08-01 13:22:56', '2023-08-01 13:39:53', 'OKTA DESKRIP', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('91', '1.2.276.0.7230010.3.0.3.5.1.13898554.1906054787', 'DX000029', 'approved', 'Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal<br />\r\n<br />\r\n<br />\r\n<br />\r\nbaru test<br />\r\n<br />\r\nbaru test 2', '2023-08-07 14:14:30', '2023-08-23 11:25:20', '1', '2023-08-01 13:46:13', '2023-08-01 13:50:42', 'TES', 'normal', '1.2.276.0.7230010.3.0.3.5.1.13898554.1906054787.png', '2023-08-23 11:25:20');
INSERT INTO `xray_workload` VALUES ('92', '1.2.826.0.1.3680043.2.876.1.1.81020.20230811145549.0.6', '189e3a55009', 'waiting', null, null, null, null, '2023-08-11 14:55:49', '2023-08-15 11:17:25', 'CHEST / SHOULDER GIRDLE', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('93', '1.2.826.0.1.3680043.2.876.1.1.81020.20230623090425.0.1', '188e6074122', 'waiting', null, null, null, null, '2023-06-23 09:04:25', '2023-08-15 11:32:41', 'CHEST / SHOULDER GIRDLE', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('94', '1.2.826.0.1.3680043.2.876.23284.1.81020.20230815114824.0.101', '188e6074122', 'waiting', null, null, null, null, '2023-06-23 09:04:25', '2023-08-15 11:47:55', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('95', '1.2.826.0.1.3680043.2.876.23284.1.81020.20230815115141.0.144', '188e6074122', 'waiting', null, null, null, null, '2023-08-11 14:55:49', '2023-08-22 09:10:24', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('96', '1.2.276.0.7230010.3.0.3.5.1.13937494.2546246313', 'DX000015', 'approved', 'Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal', '2023-08-29 13:57:53', null, '1', '2023-08-15 14:23:31', '2023-08-24 11:37:52', 'TES LAGI', 'normal', '1.2.276.0.7230010.3.0.3.5.1.13937494.2546246313.png', '2023-08-29 13:57:53');
INSERT INTO `xray_workload` VALUES ('97', '1.2.826.0.1.3680043.2.876.15656.1.8910.20230824140818.0.47', '18a266128cc', 'waiting', 'USG Whole Abdomen&nbsp;\r\n<div><br />\r\nTelah dilakukan pemeriksaan USG abdomen dengan transducer kurvilinear 5-7 MHz.</div>\r\n\r\n<div><br />\r\nHepar : Bentuk dan ukuran normal, dimensi craniocaudal sekitar &hellip; cm, permukaan reguler. Ekhostruktur parenkim homogen. Sistem bilier dan vaskuler intrahepatik tidak melebar. Tidak tampak nodul maupun SOL.&nbsp;</div>\r\n\r\n<div>Tidak tampak efusi pleura maupun asites.</div>\r\n\r\n<div>Kandung empedu : Bentuk dan ukuran normal. Dinding tidak menebal. Tidak tampak batu maupun sludge intralumen kandung empedu.&nbsp;</div>\r\n\r\n<div>Pankreas : Bentuk dan ukuran normal. Tidak tampak lesi fokal maupun SOL.</div>\r\n\r\n<div>Lien : Bentuk dan ukuran normal. Tidak tampak lesi fokal maupun SOL.</div>\r\n\r\n<div>Ginjal kanan: Bentuk normal, ukuran sekitar &hellip; x &hellip; x &hellip; cm, tebal parenkim sekitar &hellip; cm (N = 15-20 mm, tebal korteks N &gt;= 6 mm), diferensiasi korteks-medulla jelas. Sistem pelviokalises tidak melebar. Tidak tampak batu maupun SOL.</div>\r\n\r\n<div>Ginjal kiri: Bentuk normal, ukuran sekitar &hellip; x &hellip; x &hellip; cm, tebal parenkim sekitar &hellip; cm (N = 15-20 mm, tebal korteks N &gt;= 6 mm), diferensiasi korteks-medulla jelas. Sistem pelviokalises tidak melebar. Tidak tampak batu maupun SOL.</div>\r\n\r\n<div>Aorta abdominalis : Kaliber normal, tidak tampak pembesaran kelenjar limfe paraaorta.</div>\r\n\r\n<div>Vesika urinaria : Besar dan bentuk baik. Dinding tidak menebal (sekitar &hellip; cm). Tidak tampak batu, SOL, maupun debris intralumen.</div>\r\n\r\n<div>Uterus: besar dan bentuk baik, tidak tampak lesi fokal pada uterus dan adnexa bilateral.</div>\r\n\r\n<div>Prostat: Bentuk dan ukuran baik, estimasi volume sekitar &hellip; ml, tidak tampak lesi fokal maupun kalsifikasi intraparenkim.</div>\r\n\r\n<div><br />\r\nKesan:</div>\r\n\r\n<div>&hellip;</div>\r\n\r\n<div>Tidak tampak kelainan pada organ intraabdomen lainnya yang tervisualisasi di atas.</div>\r\n\r\n<div><br />\r\n&nbsp;</div>\r\n', null, null, null, '2023-08-24 14:08:18', '2023-08-24 16:33:28', 'CHEST / SHOULDER GIRDLE', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('98', '1.2.826.0.1.3680043.2.876.15656.1.8910.20230824135954.0.32', '18a265a939e', 'waiting', null, null, null, '1', '2023-08-24 13:59:54', '2023-08-24 16:34:58', 'CHEST / SHOULDER GIRDLE', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('99', '1.2.826.0.1.3680043.2.876.15656.1.8910.20230824133811.0.1', '18a2647667a', 'waiting', null, null, null, null, '2023-08-24 13:38:11', '2023-08-24 16:43:05', 'CHEST / SHOULDER GIRDLE', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('100', '1.2.826.0.1.3680043.2.876.15656.1.8910.20230825095914.0.194', '18a2aa296b9', 'approved', '<strong>Foto BNO : AP, kondisi cukup, persiapan kurang, hasil :</strong><br />\r\n- Pre peritoneal fat line dextra et sinistra tegas<br />\r\n- Distribusi udara usus merata, dengan fecal material prominent<br />\r\n- Renal outline dextra et sinistra tegas<br />\r\n- Psoas line dextra et sinistra tegas<br />\r\n- Tampak lesi opaque di setinggi proyeksi paravertebra setinggi VL2 dextra, soliter, bentuk bulat, batas tegas, tepi licin, diameter <u>+</u> 1,5 cm<br />\r\n- Sistema tulang yg tervisualisasi intak<br />\r\n<br />\r\n<strong>Kesan :</strong><br />\r\n- Suspek ureterolithiasis dextra<br />\r\n- Sistema tulang yg tervisualisasi intak', '2023-08-29 09:48:40', '2023-10-27 15:37:58', '1', '2023-08-25 09:59:14', '2023-08-25 11:19:07', 'CHEST / SHOULDER GIRDLE', 'normal', '1.2.826.0.1.3680043.2.876.15656.1.8910.20230825095914.0.194.png', '2023-10-27 15:37:58');
INSERT INTO `xray_workload` VALUES ('101', '1.2.826.0.1.3680043.2.876.15656.1.8910.20230825095516.0.184', '18a2a9fe35b', 'approved', 'Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal', '2023-08-29 09:54:57', null, '1', '2023-08-25 09:55:16', '2023-08-25 11:19:35', 'CHEST / SHOULDER GIRDLE', 'normal', '1.2.826.0.1.3680043.2.876.15656.1.8910.20230825095516.0.184.png', '2023-08-29 09:54:57');
INSERT INTO `xray_workload` VALUES ('102', '1.2.826.0.1.3680043.2.876.15656.1.8910.20230825095309.0.178', '18a2a9d11f6', 'approved', 'Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal', '2023-08-29 13:33:33', null, '1', '2023-08-25 09:53:09', '2023-08-25 11:19:59', 'CHEST / SHOULDER GIRDLE', 'normal', '1.2.826.0.1.3680043.2.876.15656.1.8910.20230825095309.0.178.png', '2023-08-29 13:33:33');
INSERT INTO `xray_workload` VALUES ('103', '1.2.826.0.1.3680043.2.876.15656.1.8910.20230825095007.0.170', '18a2a9a30c1', 'approved', 'Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal', '2023-08-29 13:58:31', null, '1', '2023-08-25 09:50:07', '2023-08-25 11:20:27', 'CHEST / SHOULDER GIRDLE', 'normal', '1.2.826.0.1.3680043.2.876.15656.1.8910.20230825095007.0.170.png', '2023-08-29 13:58:31');
INSERT INTO `xray_workload` VALUES ('104', '1.2.826.0.1.3680043.2.876.15656.1.8910.20230825100054.0.201', '18a2aa721a2', 'approved', 'testesfsfesfsed', '2023-09-19 10:06:39', '2023-09-26 10:29:51', '', '2023-08-25 10:00:54', '2023-09-01 10:57:22', 'CHEST / SHOULDER GIRDLE', 'normal', '1.2.826.0.1.3680043.2.876.15656.1.8910.20230825100054.0.201.png', '2023-09-26 10:29:51');
INSERT INTO `xray_workload` VALUES ('105', '1.2.392.200036.9125.2.3200193198.6547141259.7664375', '7879', 'waiting', null, null, null, null, '2023-09-25 10:20:59', '2023-10-04 10:16:28', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('106', '1.2.392.200036.9125.2.3200193198.6547141002.7664352', '7878', 'waiting', null, null, null, null, '2023-09-25 10:16:42', '2023-10-04 10:16:29', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('107', '1.2.392.200036.9125.2.3200193198.6547141588.7664398', '7880', 'waiting', null, null, null, null, '2023-09-25 10:26:28', '2023-10-04 10:16:30', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('108', '1.2.392.200036.9125.2.22476540144.6547143281.157652', '7884', 'waiting', null, null, null, null, '2023-09-25 10:54:41', '2023-10-04 10:16:31', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('109', '1.2.392.200036.9125.2.3200193198.6547140766.7664336', '7877', 'waiting', null, null, null, null, '2023-09-25 10:12:46', '2023-10-04 10:16:31', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('110', '1.2.392.200036.9125.2.3200193198.6547140459.7664320', '7876', 'waiting', null, null, null, null, '2023-09-25 10:07:40', '2023-10-04 10:16:31', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('111', '1.2.392.200036.9125.2.3200193198.6547142137.7664435', '7881', 'waiting', null, null, null, null, '2023-09-25 10:35:37', '2023-10-04 10:16:32', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('112', '1.2.392.200036.9125.2.3200193198.6547142861.7664451', '7882', 'waiting', null, null, null, null, '2023-09-25 10:47:41', '2023-10-04 10:16:32', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('113', '1.2.392.200036.9125.2.22476540144.6547142568.15768', '7882', 'waiting', null, null, null, null, '2023-09-25 10:42:48', '2023-10-04 10:16:32', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('114', '1.2.392.200036.9125.2.3200193198.6547144755.7664474', '7885', 'waiting', null, null, null, null, '2023-09-25 11:19:16', '2023-10-04 10:16:33', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('115', '1.2.392.200036.9125.2.3200193198.6547145703.7664490', null, 'waiting', null, null, null, null, '2023-09-25 11:35:03', '2023-10-04 10:16:34', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('116', '1.2.392.200036.9125.2.3200193198.6547148492.7664522', '2643', 'waiting', null, null, null, null, '2023-09-25 12:21:32', '2023-10-04 10:16:34', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('117', '1.2.392.200036.9125.2.3200193198.6547149508.7664538', '7856', 'waiting', null, null, null, null, '2023-09-25 12:38:28', '2023-10-04 10:16:34', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('118', '1.2.392.200036.9125.2.3200193198.6547148094.7664506', '7887', 'waiting', null, null, null, null, '2023-09-25 12:14:54', '2023-10-04 10:16:34', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('119', '1.2.392.200036.9125.2.22476540144.6547151444.157668', '7694', 'waiting', null, null, null, null, '2023-09-25 13:10:44', '2023-10-04 10:16:34', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('120', '1.2.392.200036.9125.2.3200193198.6547153704.124024', '7888', 'waiting', null, null, null, null, '2023-09-25 13:48:24', '2023-10-04 10:16:35', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('121', '1.3.6.1.4.1.50093.10.95020.7489295829171152', '1', 'waiting', null, null, null, null, '2023-09-25 14:52:14', '2023-10-04 10:16:35', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('122', '1.3.6.1.4.1.50093.10.95020.7489204596428570', '1', 'waiting', null, null, null, null, '2023-09-25 14:52:20', '2023-10-04 10:16:36', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('123', '1.3.6.1.4.1.50093.10.95020.7489203017240559', '1', 'waiting', null, null, null, null, '2023-09-25 14:52:34', '2023-10-04 10:16:37', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('124', '1.3.6.1.4.1.50093.10.95020.7489204000664566', '1', 'waiting', null, null, null, null, '2023-09-25 14:52:30', '2023-10-04 10:16:38', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('125', '1.3.6.1.4.1.50093.10.95020.7489202204168554', '1', 'waiting', null, null, null, null, '2023-09-25 14:52:41', '2023-10-04 10:16:39', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('126', '1.3.6.1.4.1.50093.10.95020.7489201319648549', '1', 'waiting', null, null, null, null, '2023-09-25 14:52:47', '2023-10-04 10:16:39', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('127', '1.2.392.200036.9125.2.22476540144.6547160383.72928', '7892', 'waiting', null, null, null, null, '2023-09-25 15:39:44', '2023-10-04 10:16:41', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('128', '1.2.392.200036.9125.2.3200193198.6547158291.124047', '7889', 'waiting', null, null, null, null, '2023-09-25 15:04:51', '2023-10-04 10:16:41', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('129', '1.2.392.200036.9125.2.3200193198.6547159241.56608', '7890', 'waiting', null, null, null, null, '2023-09-25 15:20:42', '2023-10-04 10:16:41', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('130', '1.3.6.1.4.1.50093.10.65614.7489369950184156', '1', 'waiting', null, null, null, null, '2023-09-25 16:09:33', '2023-10-04 10:16:41', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('131', '1.2.392.200036.9125.2.3200193198.6547159448.566024', '7891', 'waiting', null, null, null, null, '2023-09-25 15:29:24', '2023-10-04 10:16:42', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('132', '1.2.392.200036.9125.2.224761041219.6547163132.44448', '7893', 'waiting', null, null, null, null, '2023-09-25 16:25:32', '2023-10-04 10:16:43', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('133', '1.3.6.1.4.1.50093.10.65614.7489366666852135', '1', 'waiting', null, null, null, '2', '2023-09-25 16:52:05', '2023-10-04 10:16:43', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('134', '1.2.392.200036.9125.2.22476540144.6547162827.729224', '7894', 'waiting', null, null, null, null, '2023-09-25 16:23:16', '2023-10-04 10:16:43', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('135', '1.2.392.200036.9125.2.224761041219.6547169588.444456', '7896', 'waiting', null, null, null, '1', '2023-09-25 18:13:08', '2023-10-04 10:16:44', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('136', '1.2.392.200036.9125.2.224761041219.6547168565.444433', '7895', 'waiting', null, null, null, null, '2023-09-25 17:56:05', '2023-10-04 10:16:45', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('137', '1.2.392.200036.9125.2.3200193198.6547111113.7424189', '7864', 'waiting', null, null, null, null, '2023-09-25 01:58:33', '2023-10-04 10:16:45', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('138', '1.2.392.200036.9125.2.3200193198.6547114543.7424205', '7865', 'waiting', null, null, null, null, '2023-09-25 02:55:43', '2023-10-04 10:16:45', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('139', '1.2.392.200036.9125.2.3200193198.6547116722.7424221', '7860', 'waiting', null, null, null, null, '2023-09-25 03:32:02', '2023-10-04 10:16:46', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('140', '1.2.392.200036.9125.2.3200193198.6547116894.7424237', '7867', 'waiting', null, null, null, null, '2023-09-25 03:34:55', '2023-10-04 10:16:46', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('141', '1.2.392.200036.9125.2.3200193198.6547132198.76648', '7868', 'waiting', null, null, null, null, '2023-09-25 07:49:59', '2023-10-04 10:16:46', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('142', '1.2.392.200036.9125.2.3200193198.6547133719.766463', '6349', 'waiting', null, null, null, null, '2023-09-25 08:15:19', '2023-10-04 10:16:46', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('143', '1.2.392.200036.9125.2.3200193198.6547133325.766447', '7869', 'waiting', null, null, null, null, '2023-09-25 08:08:45', '2023-10-04 10:16:47', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('144', '1.2.392.200036.9125.2.3200193198.6547135701.7664111', '7870', 'waiting', null, null, null, null, '2023-09-25 08:48:21', '2023-10-04 10:16:47', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('145', '1.2.392.200036.9125.2.3200193198.6547132455.766424', '7850', 'waiting', null, null, null, null, '2023-09-25 07:54:16', '2023-10-04 10:16:47', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('146', '1.2.392.200036.9125.2.3200193198.6547135214.766495', '6851', 'waiting', null, null, null, null, '2023-09-25 08:40:14', '2023-10-04 10:16:48', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('147', '1.2.392.200036.9125.2.3200193198.6547136015.7664134', '7343', 'waiting', null, null, null, null, '2023-09-25 08:53:35', '2023-10-04 10:16:48', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('148', '1.2.392.200036.9125.2.3200193198.6547137158.7664210', '7873', 'waiting', null, null, null, null, '2023-09-25 09:12:38', '2023-10-04 10:16:49', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('149', '1.2.392.200036.9125.2.3200193198.6547136403.7664171', '7871', 'waiting', null, null, null, null, '2023-09-25 09:00:03', '2023-10-04 10:16:49', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('150', '1.2.392.200036.9125.2.3200193198.6547138675.7664242', '6499', 'waiting', null, null, null, null, '2023-09-25 09:37:55', '2023-10-04 10:16:49', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('151', '1.2.392.200036.9125.2.3200193198.6547137484.7664226', '7874', 'waiting', null, null, null, null, '2023-09-25 09:18:04', '2023-10-04 10:16:50', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('152', '1.2.392.200036.9125.2.3200193198.6547136743.7664187', '7872', 'waiting', null, null, null, null, '2023-09-25 09:05:44', '2023-10-04 10:16:50', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('153', '1.2.392.200036.9125.2.3200193198.6547139127.7664265', '7875', 'waiting', null, null, null, null, '2023-09-25 09:45:27', '2023-10-04 10:16:51', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('154', '1.2.392.200036.9125.2.3200193198.6547139424.7664281', '4630', 'waiting', null, null, null, null, '2023-09-25 09:50:24', '2023-10-04 10:16:51', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('155', '1.2.392.200036.9125.2.3200193198.6547139812.7664304', '7797', 'waiting', null, null, null, null, '2023-09-25 09:56:53', '2023-10-04 10:16:51', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('156', '1.2.392.200036.9125.2.224761041219.6547192640.4444111', '7896', 'waiting', null, null, null, null, '2023-09-26 00:37:20', '2023-10-04 11:07:07', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('157', '1.2.392.200036.9125.2.224761041219.6547227046.577647', '7460', 'waiting', null, null, null, null, '2023-09-26 10:10:46', '2023-10-04 11:07:08', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('158', '1.2.392.200036.9125.2.224761041219.6547225798.577624', '7905', 'waiting', null, null, null, null, '2023-09-26 09:49:58', '2023-10-04 11:07:08', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('159', '1.3.6.1.4.1.50093.10.80309.7490041255096515', '1', 'waiting', null, null, null, null, '2023-09-26 10:51:04', '2023-10-04 11:07:08', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('160', '1.2.392.200036.9125.2.224761041219.6547230807.577663', '7906', 'waiting', null, null, null, null, '2023-09-26 11:13:27', '2023-10-04 11:07:10', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('161', '1.3.6.1.4.1.50093.10.80309.7490082809310781', '1', 'waiting', null, null, null, null, '2023-09-26 11:14:17', '2023-10-04 11:07:10', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('162', '1.2.392.200036.9125.2.224761041219.6547233780.577679', '7907', 'waiting', null, null, null, null, '2023-09-26 12:03:00', '2023-10-04 11:07:11', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('163', '1.2.392.200036.9125.2.249636151126103.6547238248.62248', '7908', 'waiting', null, null, null, null, '2023-09-26 13:17:29', '2023-10-04 11:07:12', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('164', '1.3.6.1.4.1.50093.10.80309.7490155348011246', '1', 'waiting', null, null, null, null, '2023-09-26 13:24:39', '2023-10-04 11:07:12', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('165', '1.3.6.1.4.1.50093.10.80309.7490215894539620', '1', 'waiting', null, null, null, null, '2023-09-26 16:39:30', '2023-10-04 11:07:12', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('166', '1.3.6.1.4.1.50093.10.84287.7475579932205226', '1', 'waiting', null, null, null, null, '2023-09-26 16:35:07', '2023-10-04 11:07:13', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('167', '1.3.6.1.4.1.50093.10.80309.7490214311451610', '1', 'waiting', null, null, null, null, '2023-09-26 16:39:34', '2023-10-04 11:07:46', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('168', '1.3.6.1.4.1.50093.10.80309.7490267012875947', '1', 'waiting', null, null, null, null, '2023-09-26 16:39:23', '2023-10-04 11:07:47', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('169', '1.3.6.1.4.1.50093.10.80309.7490253594591862', '1', 'waiting', null, null, null, null, '2023-09-26 16:39:28', '2023-10-04 11:07:47', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('170', '1.3.6.1.4.1.50093.10.80309.7490215416087617', '1', 'waiting', null, null, null, null, '2023-09-26 16:39:32', '2023-10-04 11:07:47', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('171', '1.2.392.200036.9125.2.249636151126103.6547253980.622447', '7910', 'waiting', null, null, null, null, '2023-09-26 17:39:40', '2023-10-04 11:07:48', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('172', '1.2.392.200036.9125.2.249636151126103.6547253446.622431', '7909', 'waiting', null, null, null, null, '2023-09-26 17:30:46', '2023-10-04 11:07:48', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('173', '1.2.392.200036.9125.2.249636151126103.6547254317.622463', '7911', 'waiting', null, null, null, null, '2023-09-26 17:45:17', '2023-10-04 11:07:48', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('174', '1.2.392.200036.9125.2.249636151126103.6547259261.622479', '7912', 'waiting', null, null, null, null, '2023-09-26 19:07:41', '2023-10-04 11:07:49', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('175', '1.2.392.200036.9125.2.249636151126103.6547268806.6224111', '7914', 'waiting', null, null, null, null, '2023-09-26 21:46:47', '2023-10-04 11:07:49', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('176', '1.2.392.200036.9125.2.249636151126103.6547268020.622495', null, 'waiting', null, null, null, null, '2023-09-26 21:33:40', '2023-10-04 11:07:49', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('177', '1.2.392.200036.9125.2.22476540144.6547271140.129288', '54544', 'approved', 'test', '2023-10-06 14:29:50', null, '', '2023-09-26 22:25:41', '2023-10-04 11:07:49', null, 'normal', '1.2.392.200036.9125.2.22476540144.6547271140.129288.png', '2023-10-06 14:29:50');
INSERT INTO `xray_workload` VALUES ('178', '1.2.392.200036.9125.2.249636151126103.6547276210.6224127', '7915', 'waiting', null, null, null, '2', '2023-09-26 23:50:10', '2023-10-04 11:07:50', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('179', '1.2.392.200036.9125.2.224761041219.6547218532.69208', '5044', 'waiting', null, null, null, null, '2023-09-26 07:48:52', '2023-10-04 11:07:50', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('180', '1.2.392.200036.9125.2.224761041219.6547216190.4444127', '7172', 'waiting', null, null, null, null, '2023-09-26 07:09:51', '2023-10-04 11:07:50', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('181', '1.2.392.200036.9125.2.224761041219.6547217295.4444150', '7900', 'waiting', null, null, null, null, '2023-09-26 07:28:15', '2023-10-04 11:07:51', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('182', '1.2.392.200036.9125.2.224761041219.6547221481.692040', '7902', 'waiting', null, null, null, null, '2023-09-26 08:38:01', '2023-10-04 11:07:51', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('183', '1.2.392.200036.9125.2.224761041219.6547220180.692024', '2643', 'waiting', null, null, null, null, '2023-09-26 08:16:20', '2023-10-04 11:07:53', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('184', '1.2.392.200036.9125.2.224761041219.6547221958.692056', '7901', 'approved', '<strong>EDITED HASIL DUMMY CR&nbsp;<br />\r\nRadiografi abdomen 3 posisi (AP supine, AP erect, LLD):</strong><br />\r\n<br />\r\nLemak properitoneal masih baik.<br />\r\nPsoas line dan kontur kedua ginjal tertutup bayangan udara usus.<br />\r\nDistribusi udara usus mencapai distal dengan fecal material yang prominen.<br />\r\nTidak tampak dilatasi dan penebalan dinding usus.<br />\r\nTidak tampak multipel air-fluid level.<br />\r\nTidak tampak udara bebas ekstralumen.<br />\r\nTulang-tulang kesan intak.<br />\r\n<br />\r\nKesan:<br />\r\nTidak tampak ileus maupun pneumoperitoneum.<br />\r\n&nbsp;', '2023-12-12 13:59:56', '2023-12-12 14:05:43', '1', '2023-09-26 08:45:58', '2023-10-04 11:07:53', null, 'normal', '1.2.392.200036.9125.2.224761041219.6547221958.692056.png', '2023-12-12 14:05:43');
INSERT INTO `xray_workload` VALUES ('185', '1.2.392.200036.9125.2.224761041219.6547224892.57768', '7904', 'waiting', null, null, null, null, '2023-09-26 09:34:53', '2023-10-04 11:07:54', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('186', '1.2.392.200036.9125.2.224761041219.6547222964.692079', '7903', 'waiting', null, null, null, null, '2023-09-26 09:02:44', '2023-10-04 11:07:55', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('187', '1.2.392.200036.9125.2.224761041219.6547175446.444495', '7898', 'waiting', null, null, null, null, '2023-09-25 19:50:46', '2023-10-04 11:22:24', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('188', '1.2.392.200036.9125.2.224761041219.6547172916.444472', '7897', 'waiting', null, null, null, null, '2023-09-25 19:08:36', '2023-10-04 11:22:28', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('189', '1.3.6.1.4.1.50093.10.111759.7522823076306632', '0453966104044114', 'waiting', null, null, null, null, '2023-11-03 08:42:50', '2023-11-03 11:15:35', 'ABDOMEN UPPER LOWER', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('190', '1.3.51.0.7.1212260011.60876.45900.36723.36308.8458.2476', '119881', 'approved', '<strong>CONTOH HASIL EXPERTISE DUMMY</strong><br />\r\n<br />\r\nThorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal', '2023-11-22 11:29:08', null, '1', '2023-11-05 19:30:14', '2023-11-06 14:14:57', null, 'normal', '1.3.51.0.7.1212260011.60876.45900.36723.36308.8458.2476.png', '2023-11-22 11:29:08');
INSERT INTO `xray_workload` VALUES ('191', '1.3.51.0.7.1229795545.49227.40768.38098.29364.31755.49215', '1069052885', 'waiting', null, null, null, null, null, '2023-11-06 14:15:09', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('192', '1.3.51.0.7.3151329543.65485.10826.36752.30364.57743.60048', null, 'waiting', null, null, null, null, '2023-11-05 19:25:48', '2023-11-06 14:15:13', 'CHEST', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('193', '1.3.51.0.7.1165512687.14905.26690.41726.23381.22562.15030', '1068448247', 'waiting', null, null, null, null, '2023-10-30 17:24:09', '2023-11-06 14:30:37', 'CHEST', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('194', '1.3.51.0.7.1305497025.34737.39496.45245.35573.62461.25381', null, 'waiting', null, null, null, null, '2023-11-01 11:18:46', '2023-11-06 14:36:18', 'UPPER EXTREMITIES', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('195', '1.3.51.0.7.13587553622.30562.14656.35387.14403.2102.61829', null, 'waiting', null, null, null, null, null, '2023-11-06 14:55:19', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('196', '1.3.51.0.7.2374961542.41833.37959.42577.52434.40995.20117', null, 'waiting', null, null, null, null, '2023-11-05 19:20:45', '2023-11-06 15:04:02', 'CHEST', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('197', '1.3.51.0.7.1045157016.196.27714.46572.47582.17563.36480', '1069054391', 'waiting', null, null, null, null, null, '2023-11-06 15:05:10', null, 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('198', '1.3.51.0.7.11020318128.1836.16459.33558.63430.57744.63634', '1069059718', 'waiting', null, null, null, null, '2023-10-30 18:40:19', '2023-11-06 15:07:26', 'LOWER EXTREMITIES,UPPER EXTREMITIES', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('199', '1.2.156.112677.1000.101.20230829105343.1', '2023082910512901', 'approved', '<strong>HASIL DUMMY CR<br />\r\n<br />\r\nRadiografi vertebrae lumbosacral proyeksi AP dan lateral:</strong><br />\r\n<br />\r\nKelengkungan vertebra lumbosacral baik, kedudukan baik, tidak tampak listesis.<br />\r\nStruktur dan bentuk vertebra lumbosacral baik. Densitas vertebra lumbosacral baik.<br />\r\nPedikel intak. Tidak tampak tanda-tanda fraktur, destruksi, lesi litik maupun blastik.<br />\r\nTampak formasi osteofit marginal di vertebra &hellip;<br />\r\nTidak tampak penyempitan celah diskus intervertebralis.<br />\r\nSendi-sendi vertebra lumbosacral dan sacroiliaca bilateral terlihat baik.<br />\r\nJaringan lunak paravertebra lumbal tidak menebal.<br />\r\n<br />\r\nKesan:<br />\r\nTidak tampak fraktur maupun listesis pada vertebra lumbosacral.<br />\r\nTidak tampak lesi patologis pada vertebra lumbosacral.<br />\r\n&nbsp;', '2023-12-12 13:58:44', null, '1', '2023-08-29 10:53:43', '2023-11-07 10:19:18', 'STERNUM LAT + OBL, LEFT', 'normal', '1.2.156.112677.1000.101.20230829105343.1.png', '2023-12-12 13:58:44');
INSERT INTO `xray_workload` VALUES ('200', '1.2.826.0.1.3680043.2.876.17702.1.8910.20230917020528.0.1895', '18a9f6a5d1e', 'waiting', null, null, null, null, '2023-09-17 02:05:28', '2023-11-07 10:23:01', 'CHEST / SHOULDER GIRDLE', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('201', '1.2.826.0.1.3680043.2.876.17702.1.8910.20231009135759.0.5', '18b133c560e', 'waiting', null, null, null, null, '2023-10-09 13:57:59', '2023-11-27 16:49:30', 'CHEST / SHOULDER GIRDLE', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('202', '1.2.826.0.1.3680043.2.876.17702.1.8910.20231006155937.0.48', '18b0437e449', 'waiting', null, null, null, null, '2023-10-06 15:59:37', '2023-11-27 16:51:39', 'CHEST / SHOULDER GIRDLE', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('203', '1.2.276.0.7230010.3.1.2.1824805404.11976.1701917950.434', '2131241413', 'waiting', null, null, null, null, '2023-12-07 09:59:08', '2023-12-07 09:59:13', 'ABDOMEN COMPLETE 4 VIEWS', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('204', '1.2.40.0.13.1.00850922.20231031.045376610801205008012050781', '0453766108012050', 'waiting', null, null, null, null, '2023-10-31 08:27:19', '2023-12-28 13:41:36', 'THORAX DEWASA S', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('205', '1.3.6.1.4.1.5962.99.1.2786334768.1849416866.1385765836848.723.0', '48213468', 'waiting', null, null, null, null, '2002-01-01 00:00:00', '2024-01-05 15:19:12', 'RM SPALLA SN', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('206', '1.3.6.1.4.1.5962.1.1.0.0.0.1196527414.5534.0.1', '2', 'waiting', null, null, null, null, '2001-01-01 00:00:00', '2024-01-05 15:20:35', 'XR C SPINE COMP MIN 4 VIEWS', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('207', '1.3.6.1.4.1.5962.1.1.0.0.0.1196533885.18148.0.427', '428', 'waiting', null, null, null, null, '2003-05-05 05:07:43', '2024-01-05 15:21:37', 'CAROTIDS', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('208', '1.3.6.1.4.1.5962.1.1.0.0.0.1196533885.18148.0.133', '134', 'waiting', null, null, null, null, '2003-05-05 02:51:09', '2024-01-05 15:21:38', 'BRAIN', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('209', '1.3.6.1.4.1.5962.1.1.0.0.0.1196533885.18148.0.1', '2', 'waiting', null, null, null, null, '2003-05-05 04:53:57', '2024-01-05 15:21:38', 'BRAIN-MRA', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('210', '1.2.40.0.13.1.1576316.2411084246.2411195127', '2411195', 'waiting', null, null, null, null, '2024-01-10 08:43:27', '2024-01-10 09:37:31', 'THORAX', 'normal', null, null);
INSERT INTO `xray_workload` VALUES ('211', '1.3.51.0.7.230671363.40727.48458.47287.5754.65284.20038', '20827', 'waiting', null, null, null, null, null, '2024-01-10 09:39:41', null, 'normal', null, null);

-- ----------------------------
-- Table structure for xray_workload_bhp
-- ----------------------------
DROP TABLE IF EXISTS `xray_workload_bhp`;
CREATE TABLE `xray_workload_bhp` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) CHARACTER SET utf8 NOT NULL,
  `acc` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `film_small` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `film_medium` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `film_large` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `film_reject_small` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `film_reject_medium` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `film_reject_large` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `re_photo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `kv` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `mas` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE,
  KEY `acc` (`acc`) USING BTREE,
  KEY `film_small` (`film_small`) USING BTREE,
  KEY `film_medium` (`film_medium`) USING BTREE,
  KEY `film_large` (`film_large`) USING BTREE,
  KEY `film_reject_small` (`film_reject_small`) USING BTREE,
  KEY `film_reject_medium` (`film_reject_medium`) USING BTREE,
  KEY `film_reject_large` (`film_reject_large`) USING BTREE,
  KEY `re_photo` (`re_photo`) USING BTREE,
  KEY `kv` (`kv`) USING BTREE,
  KEY `mas` (`mas`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_workload_bhp
-- ----------------------------
INSERT INTO `xray_workload_bhp` VALUES ('1', '1.2.276.0.7230010.3.0.3.5.1.13898554.1906054787', 'DX000029', null, null, null, null, null, null, null, '100', '5', '2023-08-07 14:15:40', '2023-08-07 14:15:40');
INSERT INTO `xray_workload_bhp` VALUES ('2', '1.2.40.0.13.1.1379654.2323134941.2323326127', '01379654', null, null, null, null, null, null, null, '75', '6', '2023-08-07 14:17:43', '2023-08-07 14:17:43');
INSERT INTO `xray_workload_bhp` VALUES ('3', '1.3.51.0.7.1212260011.60876.45900.36723.36308.8458.2476', '119881', null, null, null, null, null, null, null, '1', '1', '2023-11-22 11:44:02', '2023-11-22 11:44:02');
INSERT INTO `xray_workload_bhp` VALUES ('4', '1.2.392.200036.9116.2.5.1.14.3338208259.1546404614.955983', '014416327698', null, null, null, null, null, null, null, '1', '1', '2023-11-22 11:46:08', '2023-11-22 11:46:08');

-- ----------------------------
-- Table structure for xray_workload_fill
-- ----------------------------
DROP TABLE IF EXISTS `xray_workload_fill`;
CREATE TABLE `xray_workload_fill` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) DEFAULT NULL,
  `pk_dokter_radiology` int(11) DEFAULT NULL,
  `dokradid` varchar(100) DEFAULT NULL,
  `dokrad_name` varchar(100) DEFAULT NULL,
  `fill` longtext,
  `is_default` smallint(6) DEFAULT NULL,
  `change_doctor_approved` smallint(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xray_workload_fill
-- ----------------------------
INSERT INTO `xray_workload_fill` VALUES ('1', '1.2.276.0.7230010.3.0.3.5.1.13898554.1906054787', '1', '1', 'sarah sari sp.rad ', 'Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal<br />\r\n<br />\r\n<br />\r\n<br />\r\nbaru test', '0', null, '2023-08-23 11:24:50', null, null);
INSERT INTO `xray_workload_fill` VALUES ('2', '1.2.276.0.7230010.3.0.3.5.1.13898554.1906054787', '1', '1', 'sarah sari sp.rad ', 'Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal<br />\r\n<br />\r\n<br />\r\n<br />\r\nbaru test<br />\r\n<br />\r\nbaru test 2', '1', null, '2023-08-23 11:25:20', null, null);
INSERT INTO `xray_workload_fill` VALUES ('3', '1.2.840.113619.2.398.3.2831165706.308.1566191555.472', '1', '1', 'sarah sari sp.rad ', '<strong>Teknik: Pemeriksaan radiografi Toraks proyeksi PA</strong><br />\r\n<strong>Deskripsi:</strong><br />\r\nJantung tidak membesar, CTR &lt; 50%.<br />\r\nAorta dan mediastinum superior tidak melebar.<br />\r\nTrakea di tengah. Kedua hilus tidak menebal.<br />\r\nCorakan bronkovaskular kedua paru baik.<br />\r\nTidak tampak infiltrat maupun nodul di kedua paru.<br />\r\nKedua hemidiafragma licin. Kedua sinus kostofrenikus lancip.<br />\r\nTulang-tulang yang tervisualisasi optimal kesan intak.<br />\r\n&nbsp;<br />\r\n<strong>Kesan:</strong><br />\r\nTidak tampak infiltrat maupun nodul di kedua paru.<br />\r\nJantung tidak membesar.<br />\r\n&nbsp;', '1', null, '2023-08-24 10:26:53', null, null);
INSERT INTO `xray_workload_fill` VALUES ('4', '1.2.392.200036.9116.2.5.1.14.3338208259.1546404614.955983', '1', '1', 'sarah sari sp.rad ', '<strong>Teknik: Pemeriksaan radiografi Toraks proyeksi PA</strong><br />\r\n<strong>Deskripsi:</strong><br />\r\nJantung tidak membesar, CTR &lt; 50%.<br />\r\nAorta dan mediastinum superior tidak melebar.<br />\r\nTrakea di tengah. Kedua hilus tidak menebal.<br />\r\nCorakan bronkovaskular kedua paru baik.<br />\r\nTidak tampak infiltrat maupun nodul di kedua paru.<br />\r\nKedua hemidiafragma licin. Kedua sinus kostofrenikus lancip.<br />\r\nTulang-tulang yang tervisualisasi optimal kesan intak.<br />\r\n&nbsp;<br />\r\n<strong>Kesan:</strong><br />\r\nTidak tampak infiltrat maupun nodul di kedua paru.<br />\r\nJantung tidak membesar.<br />\r\n&nbsp;', '1', null, '2023-08-24 10:29:18', null, null);
INSERT INTO `xray_workload_fill` VALUES ('5', '1.2.826.0.1.3680043.2.876.15656.1.8910.20230825095914.0.194', '1', '1', 'sarah sari sp.rad ', 'Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal', '0', null, '2023-08-29 09:48:40', null, null);
INSERT INTO `xray_workload_fill` VALUES ('6', '1.2.826.0.1.3680043.2.876.15656.1.8910.20230825095516.0.184', '1', '1', 'sarah sari sp.rad ', 'Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal', '1', null, '2023-08-29 09:54:57', null, null);
INSERT INTO `xray_workload_fill` VALUES ('7', '1.2.826.0.1.3680043.2.876.15656.1.8910.20230825095309.0.178', '1', '1', 'sarah sari sp.rad ', 'Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal', '1', null, '2023-08-29 13:33:33', null, null);
INSERT INTO `xray_workload_fill` VALUES ('8', '1.2.276.0.7230010.3.0.3.5.1.13937494.2546246313', '1', '1', 'dr. sarah sari.spRad', 'Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal', '1', null, '2023-08-29 13:57:53', null, null);
INSERT INTO `xray_workload_fill` VALUES ('9', '1.2.826.0.1.3680043.2.876.15656.1.8910.20230825095007.0.170', '1', '1', 'dr. sarah sari.spRad', 'Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal', '1', null, '2023-08-29 13:58:31', null, null);
INSERT INTO `xray_workload_fill` VALUES ('10', '1.2.276.0.7230010.3.0.3.5.1.13882255.1425595246', '1', '1', 'dr. sarah sari.spRad', '<strong>Teknik: Pemeriksaan radiografi Toraks proyeksi PA</strong><br />\r\n<strong>Deskripsi:</strong><br />\r\nJantung tidak membesar, CTR &lt; 50%.<br />\r\nAorta dan mediastinum superior tidak melebar.<br />\r\nTrakea di tengah. Kedua hilus tidak menebal.<br />\r\nCorakan bronkovaskular kedua paru baik.<br />\r\nTidak tampak infiltrat maupun nodul di kedua paru.<br />\r\nKedua hemidiafragma licin. Kedua sinus kostofrenikus lancip.<br />\r\nTulang-tulang yang tervisualisasi optimal kesan intak.<br />\r\n&nbsp;<br />\r\n<strong>Kesan:</strong><br />\r\nTidak tampak infiltrat maupun nodul di kedua paru.<br />\r\nJantung tidak membesar.<br />\r\n&nbsp;', '1', null, '2023-08-29 13:59:10', null, null);
INSERT INTO `xray_workload_fill` VALUES ('11', '1.2.826.0.1.3680043.2.876.15656.1.8910.20230825095914.0.194', '1', '1', 'dr. sarah sari.spRad', 'Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &gt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor tidak normal', '0', null, '2023-09-06 09:43:06', null, null);
INSERT INTO `xray_workload_fill` VALUES ('12', '1.2.276.0.26.1.1.1.2.664243.20211001.118999', '1', '1', 'dr. sarah sari.spRad', 'Thorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal', '1', null, '2023-09-22 13:37:36', null, null);
INSERT INTO `xray_workload_fill` VALUES ('13', '', null, null, null, null, '0', '1', '2023-09-27 10:27:54', null, null);
INSERT INTO `xray_workload_fill` VALUES ('14', '', null, null, null, null, '0', '1', '2023-09-27 10:28:00', null, null);
INSERT INTO `xray_workload_fill` VALUES ('15', '1.2.826.0.1.3680043.2.876.15656.1.8910.20230825095914.0.194', '1', '1', 'dr. sarah sari.spRad', '<strong>Foto BNO : AP, kondisi cukup, persiapan kurang, hasil :</strong><br />\r\n- Pre peritoneal fat line dextra et sinistra tegas<br />\r\n- Distribusi udara usus merata, dengan fecal material prominent<br />\r\n- Renal outline dextra et sinistra tegas<br />\r\n- Psoas line dextra et sinistra tegas<br />\r\n- Tampak lesi opaque di setinggi proyeksi paravertebra setinggi VL2 dextra, soliter, bentuk bulat, batas tegas, tepi licin, diameter <u>+</u> 1,5 cm<br />\r\n- Sistema tulang yg tervisualisasi intak<br />\r\n<br />\r\n<strong>Kesan :</strong><br />\r\n- Suspek ureterolithiasis dextra<br />\r\n- Sistema tulang yg tervisualisasi intak', '1', null, '2023-10-27 15:37:58', null, null);
INSERT INTO `xray_workload_fill` VALUES ('17', '1.2.392.200036.9116.2.5.1.14.3338208259.1546404614.955983', '1', '1', 'dr. sarah sari.spRad', '<strong>CONTOH HASIL EXPERTISE DUMMY<br />\r\n<br />\r\nTeknik : CT Scan abdomen tanpa kontras intravena</strong><br />\r\n<br />\r\n<strong>Deskripsi :</strong><br />\r\nHepar bentuk dan ukuran baik. Densitas parenkim homogen. Tidak tampak lesi fokal patologis yang jelas maupun kalsifikasi.<br />\r\nTak tampak asites maupun efusi pleura.<br />\r\nKandung empedu bentuk dan ukuran baik, tidak tampak batu.<br />\r\nPankreas bentuk dan ukuran baik, tidak tampak kalsifikasi.<br />\r\nLimpa bentuk dan ukuran baik, densitas homogen. Tidak tampak kalsifikasi.<br />\r\nKedua ginjal bentuk dan ukuran baik. Tidak tampak batu maupun kalsifikasi.<br />\r\nGaster dan usus-usus tidak tampak dilatasi patologis.<br />\r\nAorta kaliber baik, tidak tampak kalsifikasi.<br />\r\nKelenjar limfe paraaorta dan parailiaka sulit dinilai, kesan tidak membesar.<br />\r\nVesika urinaria bentuk dan ukuran baik, tak tampak batu.<br />\r\nKelenjar prostat / Uterus dan adnexa tidak tampak kalsifikasi.<br />\r\nTulang-tulang tak tampak kelainan.<br />\r\n<br />\r\nKesan:<br />\r\nTidak tampak kelainan radiologis di intra abdomen.<br />\r\n&nbsp;', '1', null, '2023-11-22 11:06:10', null, null);
INSERT INTO `xray_workload_fill` VALUES ('18', '1.3.51.0.7.1212260011.60876.45900.36723.36308.8458.2476', '1', '1', 'dr. sarah sari.spRad', '<strong>CONTOH HASIL EXPERTISE DUMMY</strong><br />\r\n<br />\r\nThorax : PA,erect, simetri,inspirasi dan kondisi cukup;<br />\r\nHasil :<br />\r\n- Corakan bronchovasculer normal<br />\r\n- Tak tampak penebalan pleura space<br />\r\n- Kedua sinus costofrenicus lancip<br />\r\n- Kedua diafragma licin<br />\r\n- Cor : CTR &lt; 0,5<br />\r\n- Tak tampak kelainan pada sistema tulang yang tevisualisasi<br />\r\nKesan:<br />\r\nPulmo dan besar cor normal', '1', null, '2023-11-22 11:29:08', null, null);
INSERT INTO `xray_workload_fill` VALUES ('27', '1.2.156.112677.1000.101.20230829105343.1', null, null, null, null, '0', '1', '2023-12-12 13:57:58', null, null);
INSERT INTO `xray_workload_fill` VALUES ('28', '1.2.156.112677.1000.101.20230829105343.1', '1', '1', 'dr. sarah sari.spRad', '<strong>HASIL DUMMY CR<br />\r\n<br />\r\nRadiografi vertebrae lumbosacral proyeksi AP dan lateral:</strong><br />\r\n<br />\r\nKelengkungan vertebra lumbosacral baik, kedudukan baik, tidak tampak listesis.<br />\r\nStruktur dan bentuk vertebra lumbosacral baik. Densitas vertebra lumbosacral baik.<br />\r\nPedikel intak. Tidak tampak tanda-tanda fraktur, destruksi, lesi litik maupun blastik.<br />\r\nTampak formasi osteofit marginal di vertebra &hellip;<br />\r\nTidak tampak penyempitan celah diskus intervertebralis.<br />\r\nSendi-sendi vertebra lumbosacral dan sacroiliaca bilateral terlihat baik.<br />\r\nJaringan lunak paravertebra lumbal tidak menebal.<br />\r\n<br />\r\nKesan:<br />\r\nTidak tampak fraktur maupun listesis pada vertebra lumbosacral.<br />\r\nTidak tampak lesi patologis pada vertebra lumbosacral.<br />\r\n&nbsp;', '1', null, '2023-12-12 13:58:44', null, null);
INSERT INTO `xray_workload_fill` VALUES ('29', '1.2.392.200036.9125.2.224761041219.6547221958.692056', '1', '1', 'dr. sarah sari.spRad', '<strong>HASIL DUMMY CR<br />\r\nRadiografi abdomen 3 posisi (AP supine, AP erect, LLD):</strong><br />\r\n<br />\r\nLemak properitoneal masih baik.<br />\r\nPsoas line dan kontur kedua ginjal tertutup bayangan udara usus.<br />\r\nDistribusi udara usus mencapai distal dengan fecal material yang prominen.<br />\r\nTidak tampak dilatasi dan penebalan dinding usus.<br />\r\nTidak tampak multipel air-fluid level.<br />\r\nTidak tampak udara bebas ekstralumen.<br />\r\nTulang-tulang kesan intak.<br />\r\n<br />\r\nKesan:<br />\r\nTidak tampak ileus maupun pneumoperitoneum.<br />\r\n&nbsp;', '0', null, '2023-12-12 13:59:56', null, null);
INSERT INTO `xray_workload_fill` VALUES ('30', '1.2.40.0.13.1.669124.20101410406.2114174143', '1', '1', 'dr. sarah sari.spRad', '<strong>HASIL DUMMY<br />\r\nTeknik: CT Scan thorax tanpa kontras intravena</strong><br />\r\n<br />\r\n<strong>Deskripsi:</strong><br />\r\nMediastinum superior tidak memperlihatkan kelainan.<br />\r\nTrakhea, bronkhus utama kanan-kiri terlihat baik.<br />\r\nTidak tampak pembesaran yang jelas pada kelenjar limfe mediastinum dan hilus.<br />\r\nJantung dan aorta kesan tidak membesar.<br />\r\nKedua paru tidak memperlihatkan adanya lesi patologis, nodul maupun infiltrat.<br />\r\nTak tampak penebalan pleura maupun efusi.<br />\r\nOrgan-organ abdomen atas yang tervisualisasi tidak memperlihatkan kelainan.<br />\r\nTulang-tulang kesan masih intak.<br />\r\n<br />\r\nKesan:<br />\r\nTidak tampak kelainan radiologis yang jelas di intra thorakal.<br />\r\n&nbsp;', '0', null, '2023-12-12 14:03:00', null, null);
INSERT INTO `xray_workload_fill` VALUES ('31', '1.2.40.0.13.1.669124.20101410406.2114174143', '1', '1', 'dr. sarah sari.spRad', '<strong>HASIL DUMMY EDITED<br />\r\nTeknik: CT Scan thorax tanpa kontras intravena</strong><br />\r\n<br />\r\n<strong>Deskripsi:</strong><br />\r\nMediastinum superior tidak memperlihatkan kelainan.<br />\r\nTrakhea, bronkhus utama kanan-kiri terlihat baik.<br />\r\nTidak tampak pembesaran yang jelas pada kelenjar limfe mediastinum dan hilus.<br />\r\nJantung dan aorta kesan tidak membesar.<br />\r\nKedua paru tidak memperlihatkan adanya lesi patologis, nodul maupun infiltrat.<br />\r\nTak tampak penebalan pleura maupun efusi.<br />\r\nOrgan-organ abdomen atas yang tervisualisasi tidak memperlihatkan kelainan.<br />\r\nTulang-tulang kesan masih intak.<br />\r\n<br />\r\nKesan:<br />\r\nTidak tampak kelainan radiologis yang jelas di intra thorakal.<br />\r\n&nbsp;', '1', null, '2023-12-12 14:05:31', null, null);
INSERT INTO `xray_workload_fill` VALUES ('32', '1.2.392.200036.9125.2.224761041219.6547221958.692056', '1', '1', 'dr. sarah sari.spRad', '<strong>EDITED HASIL DUMMY CR&nbsp;<br />\r\nRadiografi abdomen 3 posisi (AP supine, AP erect, LLD):</strong><br />\r\n<br />\r\nLemak properitoneal masih baik.<br />\r\nPsoas line dan kontur kedua ginjal tertutup bayangan udara usus.<br />\r\nDistribusi udara usus mencapai distal dengan fecal material yang prominen.<br />\r\nTidak tampak dilatasi dan penebalan dinding usus.<br />\r\nTidak tampak multipel air-fluid level.<br />\r\nTidak tampak udara bebas ekstralumen.<br />\r\nTulang-tulang kesan intak.<br />\r\n<br />\r\nKesan:<br />\r\nTidak tampak ileus maupun pneumoperitoneum.<br />\r\n&nbsp;', '1', null, '2023-12-12 14:05:43', null, null);
