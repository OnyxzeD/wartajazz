/*
 Navicat Premium Data Transfer

 Source Server         : CyberdynE
 Source Server Type    : MySQL
 Source Server Version : 100119
 Source Host           : localhost:3306
 Source Schema         : tempat.in

 Target Server Type    : MySQL
 Target Server Version : 100119
 File Encoding         : 65001

 Date: 17/01/2019 00:04:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bank
-- ----------------------------
DROP TABLE IF EXISTS `bank`;
CREATE TABLE `bank`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(35) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of bank
-- ----------------------------
INSERT INTO `bank` VALUES (1, '008', 'PT. BANK MANDIRI');
INSERT INTO `bank` VALUES (2, '002', 'PT. BANK RAKYAT INDONESIA');
INSERT INTO `bank` VALUES (3, '009', 'PT. BANK NEGARA INDONESIA');
INSERT INTO `bank` VALUES (4, '014', 'PT. BANK BCA');
INSERT INTO `bank` VALUES (5, '441', 'PT. BANK BUKOPIN');
INSERT INTO `bank` VALUES (6, '022', 'PT. CIMB NIAGA');
INSERT INTO `bank` VALUES (7, '427', 'PT. BANK BNI SYARIAH');
INSERT INTO `bank` VALUES (8, '451', 'PT. BANK MANDIRI SYARIAH');
INSERT INTO `bank` VALUES (9, '011', 'PT. BANK DANAMON');
INSERT INTO `bank` VALUES (10, '426', 'PT. BANK MEGA');

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer`  (
  `Id_Customer` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Alamat` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Telp` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Saldo` int(11) NULL DEFAULT NULL,
  `Photo` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Customer`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('CS0001', 'Qwerty Asdfgh', NULL, '123456789012', 105000, NULL);
INSERT INTO `customer` VALUES ('CS0002', 'Luke Skywalker', NULL, '123456789012', 6000, NULL);
INSERT INTO `customer` VALUES ('CS0003', 'Ferrentino', NULL, '0896969', 10000, NULL);
INSERT INTO `customer` VALUES ('CS0004', 'Andromeda', NULL, '1234567890', NULL, NULL);
INSERT INTO `customer` VALUES ('CS0005', 'zxc', NULL, '1234567890', 10000, NULL);
INSERT INTO `customer` VALUES ('CS0006', 'sadf', NULL, '324234234324', 10000, NULL);
INSERT INTO `customer` VALUES ('CS0007', 'Luke Skywalker', NULL, '123456789012', 10000, NULL);
INSERT INTO `customer` VALUES ('CS0008', 'galihs', NULL, '09878129812', 10000, NULL);
INSERT INTO `customer` VALUES ('CS0009', 'ASDFGH', NULL, '123456789012', 10000, NULL);
INSERT INTO `customer` VALUES ('CS0010', 'Lyrae', NULL, '123456789012', 10000, NULL);
INSERT INTO `customer` VALUES ('CS0011', 'Hizkia Luke', NULL, '087859620736', 18000, NULL);
INSERT INTO `customer` VALUES ('CS0012', 'Bu Chaulina', NULL, '123456789012', 108000, NULL);

-- ----------------------------
-- Table structure for manager
-- ----------------------------
DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager`  (
  `Id_Manager` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Alamat` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Telp` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Outlet_Id` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Photo` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Manager`) USING BTREE,
  INDEX `FK_Manager`(`Outlet_Id`) USING BTREE,
  CONSTRAINT `FK_Manager` FOREIGN KEY (`Outlet_Id`) REFERENCES `outlet` (`ID_Outlet`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of manager
-- ----------------------------
INSERT INTO `manager` VALUES ('MGR0002', 'Soetikno', NULL, '123456789012', 'MKBR_1', NULL);
INSERT INTO `manager` VALUES ('MGR0003', 'Prayit', NULL, '123456789012', 'MKBR_2', NULL);
INSERT INTO `manager` VALUES ('MGR0004', 'Bimo Prakoso', NULL, '123456789012', 'GS_2', NULL);
INSERT INTO `manager` VALUES ('MGR0005', 'Hizkia Luke', NULL, '123456789012', 'NLNGS_2', NULL);
INSERT INTO `manager` VALUES ('MGR0006', 'Cobaan Dunia', NULL, '123456789012', 'NLNGS_3', NULL);
INSERT INTO `manager` VALUES ('MGR0007', 'Wawan Gendeng', NULL, '123456789012', 'NLNGS_4', 'wagendeng-incognito.png');

-- ----------------------------
-- Table structure for outlet
-- ----------------------------
DROP TABLE IF EXISTS `outlet`;
CREATE TABLE `outlet`  (
  `ID_Outlet` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Partner_Id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Alamat` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Telp` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Thumbnail` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Provinsi_Id` int(11) NULL DEFAULT NULL,
  `Kabkot_Id` int(11) NULL DEFAULT NULL,
  `Jumlah_Kursi` int(11) NULL DEFAULT NULL,
  `Kursi_Tersedia` int(11) NULL DEFAULT NULL,
  `Berdiri_Sejak` date NULL DEFAULT NULL,
  PRIMARY KEY (`ID_Outlet`) USING BTREE,
  INDEX `FK_Pemilik`(`Partner_Id`) USING BTREE,
  CONSTRAINT `FK_Pemilik` FOREIGN KEY (`Partner_Id`) REFERENCES `partner` (`ID_Partner`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of outlet
-- ----------------------------
INSERT INTO `outlet` VALUES ('GS_1', 'PT0007', 'Fukuoka Wonokromo', 'Malang', '0332166787', NULL, NULL, NULL, 50, 50, '2018-12-31');
INSERT INTO `outlet` VALUES ('GS_2', 'PT0007', 'Fukuoka Malang', 'Malang', '033431176', NULL, NULL, NULL, 50, 50, '2018-12-31');
INSERT INTO `outlet` VALUES ('MKBR_1', 'PT0005', 'Mie Kober Soehatt', 'Malang', '123456789012', NULL, NULL, NULL, 50, 50, '2018-12-31');
INSERT INTO `outlet` VALUES ('MKBR_2', 'PT0005', 'Mie Kober Bromo', 'Malang', '123456789012', NULL, NULL, NULL, 50, 50, '2018-12-31');
INSERT INTO `outlet` VALUES ('MOYN_1', 'PT0006', 'Mie Setan Bromo', 'Malang', '123456789021', NULL, NULL, NULL, 50, 50, '2018-12-31');
INSERT INTO `outlet` VALUES ('NLNGS_2', 'PT0001', 'Nelongso Sukun', 'Sukun', '123456789012', 'assets/landing/img/partners/thumb-nelongso.png', 35, 3573, 82, 82, '2018-12-31');
INSERT INTO `outlet` VALUES ('NLNGS_3', 'PT0001', 'Nelongso Dieng', 'Dieng', '123456789121', 'assets/landing/img/partners/thumb-nelongso.png', 35, 3573, 82, 80, '2018-12-31');
INSERT INTO `outlet` VALUES ('NLNGS_4', 'PT0001', 'Nelongso Ijen', 'Ijen', '342342342342', NULL, NULL, NULL, 50, 0, '2018-12-31');
INSERT INTO `outlet` VALUES ('NLNGS_5', 'PT0001', 'Nelongso Abujee', 'Abujee', '123456789012', NULL, NULL, NULL, 101, 1001, '2018-12-31');
INSERT INTO `outlet` VALUES ('PSTKF_1', 'PT0009', 'Post Koffie Nenjap', 'Kepanjen', '123456789021', NULL, NULL, NULL, 50, 50, '2018-12-31');
INSERT INTO `outlet` VALUES ('PSTKF_2', 'PT0009', 'Post Koffie Gadang', 'Gadang', '123456890123', NULL, NULL, NULL, 60, 60, '2018-12-31');
INSERT INTO `outlet` VALUES ('PSTKF_3', 'PT0009', 'Post Koffie Sukun', 'Sukun', '123456789012', NULL, NULL, NULL, 45, 45, '2019-01-16');
INSERT INTO `outlet` VALUES ('PT0002-OUT-1', 'PT0002', 'Kedai Dieng', 'Malang', '123456789012', NULL, NULL, NULL, 50, 50, '2018-12-31');
INSERT INTO `outlet` VALUES ('PT0002-OUT-2', 'PT0002', 'Kedai Tidar', 'Malang', '123456789012', NULL, NULL, NULL, 50, 50, '2018-12-31');
INSERT INTO `outlet` VALUES ('PT0003-OUT-1', 'PT0003', 'WSS Kawi', 'Malang', '123456789012', NULL, NULL, NULL, 50, 50, '2018-12-31');
INSERT INTO `outlet` VALUES ('PT0003-OUT-2', 'PT0003', 'WSS Soekarno-Hatta', 'Malang', '123456789012', NULL, NULL, NULL, 50, 48, '2018-12-31');
INSERT INTO `outlet` VALUES ('PT0004-OUT-1', 'PT0004', 'Upnormal Soekarno-Hatta', 'Malang', '087998667456', NULL, NULL, NULL, 50, 50, '2018-12-31');
INSERT INTO `outlet` VALUES ('PT0004-OUT-2', 'PT0004', 'Upnormal Dieng', 'Malang', '66700986764', NULL, NULL, NULL, 50, 50, '2018-12-31');
INSERT INTO `outlet` VALUES ('VLV_1', 'PT0008', 'Ichiraku Tokyo', 'Malang', '123456789012', NULL, NULL, NULL, 50, 50, '2018-12-31');

-- ----------------------------
-- Table structure for partner
-- ----------------------------
DROP TABLE IF EXISTS `partner`;
CREATE TABLE `partner`  (
  `ID_Partner` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Bentuk` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Jenis_Tempat` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Telp` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Provinsi_Id` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Kabkot_Id` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Alamat` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Jenis_Identitas` tinyint(4) NULL DEFAULT NULL,
  `No_Identitas` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Logo` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Kode_Bank` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Rekening` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Pemilik_Rekening` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `File_Identitas` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `File_Rekening` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Rating` double NULL DEFAULT NULL,
  `status` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`ID_Partner`) USING BTREE,
  INDEX `FK_Prov`(`Provinsi_Id`) USING BTREE,
  INDEX `FK_Kabkot`(`Kabkot_Id`) USING BTREE,
  CONSTRAINT `FK_Kabkot` FOREIGN KEY (`Kabkot_Id`) REFERENCES `wilayah_kabupaten` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_Prov` FOREIGN KEY (`Provinsi_Id`) REFERENCES `wilayah_provinsi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of partner
-- ----------------------------
INSERT INTO `partner` VALUES ('PT0001', 'Nelongso', 'Company', 'rt', '087859620736', '35', '3573', 'Jl. Tidar 100', 0, '1234567890123456', 'assets/landing/img/partners/site-nelongso.png', '008', '1122332211', 'firda canteks', NULL, NULL, 5, 1);
INSERT INTO `partner` VALUES ('PT0002', 'Coklat Klasik', 'Personal', 'cf', '123456789012', '35', '3520', 'Jl. TIdar 100', 0, '1234567890123456', 'assets/landing/img/partners/coklat-klasik.png', '008', '1122332211', 'Firda', NULL, NULL, 4.1, 1);
INSERT INTO `partner` VALUES ('PT0003', 'Waroeng Steak & Shake', 'Company', 'rt', '123456789012', '35', '3573', 'Jl. Tidar 100', 0, '1234567890123456', 'assets/landing/img/partners/waroeng.png', '014', '1122332211', 'firda canteks', NULL, NULL, 4.2, 1);
INSERT INTO `partner` VALUES ('PT0004', 'Upnormal', 'Company', 'cf', '089009887987', '35', '3509', 'jl jember no 112', 0, '3507190098898', 'assets/landing/img/partners/upnormal.png', '014', '567980669', 'Firda Rosa', NULL, NULL, 4.1, 1);
INSERT INTO `partner` VALUES ('PT0005', 'Mie Kober', 'Company', 'rt', '123456789012', '35', '3573', 'Astojim', 0, '1234567890123456', 'assets/landing/img/partners/bowl-of-ramen.jpg', '008', '1234567890123', 'Bahroedin', NULL, NULL, 4.5, 1);
INSERT INTO `partner` VALUES ('PT0006', 'Mie Setan', 'Personal', 'rt', '123456789012', '35', '3505', 'Sebeng', 0, '1234567891265498', 'assets/landing/img/partners/bowl-of-ramen.jpg', '008', '1234567890123', 'Bahroedin', 'assets/landing/img/identitas/mie_oyen-20181030183940.jpeg', 'assets/landing/img/rekening/mie_oyen-20181030183940.png', 4.5, 1);
INSERT INTO `partner` VALUES ('PT0007', 'Fukuoka Ramen', 'Company', 'rt', '081223445776', '33', '3317', 'Jl remabng no 121', 0, '3577619876009', 'assets/landing/img/partners/bowl-of-ramen.jpg', '008', '1234567890123', 'luke ', 'assets/landing/img/identitas/agasa-20181101094004.jpg', 'assets/landing/img/rekening/agasa-20181101094004.png', 4.5, 1);
INSERT INTO `partner` VALUES ('PT0008', 'Ichiraku Ramen', 'Company', 'rt', '123456789012', '11', '1101', 'Jl. Astojim manawiwe', 0, '1234567890123456', 'assets/landing/img/partners/bowl-of-ramen.jpg', '008', '1234567890123', 'Bahroedin', 'assets/landing/img/identitas/valve-20181113135311.jpg', 'assets/landing/img/rekening/valve-20181113135311.png', 4.5, 1);
INSERT INTO `partner` VALUES ('PT0009', 'Post Koffie', 'Personal', 'cf', '087859620736', '35', '3507', 'Kepanjen', 0, '1234567890123456', NULL, '014', '1234567890123', 'Badrun', 'assets/landing/img/identitas/post_koffie-20190116230325.png', 'assets/landing/img/rekening/post_koffie-20190116230325.png', NULL, NULL);

-- ----------------------------
-- Table structure for reservasi
-- ----------------------------
DROP TABLE IF EXISTS `reservasi`;
CREATE TABLE `reservasi`  (
  `Id_Reservasi` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Outlet_Id` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Customer_Id` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Orang` tinyint(4) NULL DEFAULT NULL,
  `Status` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `verified_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Reservasi`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of reservasi
-- ----------------------------
INSERT INTO `reservasi` VALUES ('RSV0001', 'NLNGS_2', 'CS0002', 2, 1, '2018-12-26 10:13:21', '2018-12-11 12:13:24');
INSERT INTO `reservasi` VALUES ('RSV0002', 'NLNGS_2', 'CS0002', 4, 1, '2018-12-26 16:21:00', '2018-12-26 16:21:00');
INSERT INTO `reservasi` VALUES ('RSV0003', 'NLNGS_3', 'CS0002', 3, 1, '2018-12-27 04:42:00', '2018-12-27 04:42:00');
INSERT INTO `reservasi` VALUES ('RSV0004', 'PT0003-OUT-1', 'CS0001', 2, 1, '2019-01-04 09:00:00', '2019-01-04 09:00:00');
INSERT INTO `reservasi` VALUES ('RSV0005', 'NLNGS_3', 'CS0011', 2, 1, '2019-01-14 18:30:00', '2019-01-14 18:30:00');
INSERT INTO `reservasi` VALUES ('RSV0006', 'NLNGS_2', 'CS0012', 3, 1, '2019-01-14 12:35:00', '2019-01-15 13:42:34');

-- ----------------------------
-- Table structure for topup
-- ----------------------------
DROP TABLE IF EXISTS `topup`;
CREATE TABLE `topup`  (
  `Id_Topup` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Id_Customer` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Nominal` int(11) NULL DEFAULT NULL,
  `Status` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Photo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Code` int(10) UNSIGNED NULL DEFAULT NULL,
  `Tgl_Transaksi` datetime(0) NULL DEFAULT NULL,
  `confirmed_at` datetime(0) NULL DEFAULT NULL,
  `verified_at` datetime(0) NULL DEFAULT NULL,
  INDEX `Topup_customer`(`Id_Customer`) USING BTREE,
  CONSTRAINT `Topup_customer` FOREIGN KEY (`Id_Customer`) REFERENCES `customer` (`Id_Customer`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of topup
-- ----------------------------
INSERT INTO `topup` VALUES ('T001', 'CS0002', 100000, '1', NULL, NULL, '2018-12-07 00:00:00', NULL, NULL);
INSERT INTO `topup` VALUES ('TOP0002', 'CS0001', 50000, '1', 'myfile.jpg', 173, '2019-01-14 21:33:40', '2019-01-14 21:33:44', '2019-01-14 21:58:13');
INSERT INTO `topup` VALUES ('TOP0003', 'CS0011', 10000, '1', 'GVSZFPYDAOmyfile.jpg', 744, '2019-01-14 22:41:50', '2019-01-14 22:42:18', '2019-01-14 22:44:41');
INSERT INTO `topup` VALUES ('TOP0004', 'CS0011', 20000, '0', NULL, 519, '2019-01-14 23:33:41', NULL, NULL);
INSERT INTO `topup` VALUES ('TOP0005', 'CS0001', 50000, '1', 'YXRXW3ADDEXDWL1myfile.jpg', 166, '2019-01-15 08:28:40', '2019-01-15 08:28:46', '2019-01-15 08:29:35');
INSERT INTO `topup` VALUES ('TOP0006', 'CS0012', 50000, '1', 'D3D70R1D5AQ1PA5myfile.jpg', 646, '2019-01-15 08:37:35', '2019-01-15 08:37:54', '2019-01-15 08:38:30');
INSERT INTO `topup` VALUES ('TOP0007', 'CS0012', 50000, '1', 'H7JTP6SUYVJGMSXmyfile.jpg', 576, '2019-01-15 13:37:28', '2019-01-15 13:37:37', '2019-01-15 13:38:10');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Type` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `Source_Id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Password` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Status` int(10) UNSIGNED NULL DEFAULT NULL,
  `Token` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'system', 'system@development.in', 0, NULL, '$2y$10$3Ou.dQjPFzeDZA6iCYzF2ODQFy2TxBRFvHxUb61yK1wDsgvDauc32', 1, NULL, NULL);
INSERT INTO `users` VALUES (2, 'nelongso', 'cs@nelongso.com', 1, 'PT0001', '$2y$10$YCyrBysCvxRse7.GrPB56Osj3E3d0sxFP/dUvM.OgSoB9WofkDdtC', 0, NULL, '2018-10-01 15:15:55');
INSERT INTO `users` VALUES (3, 'coklat_klasik', 'cs@rotiku.com', 1, 'PT0002', '$2y$10$FPaWPmuWg525yMSLDe9PBue/V4e5AZiK2SDJAEOS0VE7X66clAjf6', 0, NULL, '2018-10-01 15:36:16');
INSERT INTO `users` VALUES (5, 'waroengss', 'cs@recheese.com', 1, 'PT0003', '$2y$10$PtUrhj0Vw2l2y3Yin34y0uIkakLkyoy4H7eZOuS5tINgBvJkofriS', 0, NULL, '2018-10-01 15:36:16');
INSERT INTO `users` VALUES (6, 'upnormal', 'up@gmail.com', 1, 'PT0004', '$2y$10$dtCm64GKKdSIC2FI4zilBu9p.bqywrQdioIJuUEloPGzgxMFCGzOK', 0, NULL, '2018-10-08 15:24:43');
INSERT INTO `users` VALUES (7, 'qwerty', 'qwerty@system.com', 2, 'CS0001', '$2y$10$SHWAy0.PB6fELN.uWcsDw.l0IGVhKDNh4h4FtdcLUbq.7pQ5MzZUO', 1, NULL, '2018-10-15 14:53:36');
INSERT INTO `users` VALUES (8, 'luke', 'qwerty@system.com', 3, 'CS0002', '$2y$10$BNPOVv1mli69Eope2pjAOuJLEZos7uMJRFfVUbYgJTvc.4CxL21fK', 1, NULL, '2018-10-15 20:58:53');
INSERT INTO `users` VALUES (9, 'ferren', 'ferren@system.com', 3, 'CS0003', '$2y$10$2ZVKKqX9.toxulSyhwn8qu5PefrkMBC88GHQuyBVf2vlke/6nWzF.', 1, NULL, '2018-10-16 12:35:10');
INSERT INTO `users` VALUES (11, 'mie-kober', 'kober@system.co', 1, 'PT0005', '$2y$10$auFETSdhLC9GKr7hDJ/RTObriAiPaB5eRt/tORIBbcuEM5YcIpO4q', 0, NULL, '2018-10-22 22:31:17');
INSERT INTO `users` VALUES (12, 'kober-soehatt', 'soetik@kober.co', 2, 'MGR0002', '$2y$10$sPdQvf1OYsR19j1ufEvKPe9LEFO1A0SDTiGklsrASidKNWU.x3dJm', 1, NULL, '2018-10-22 22:38:39');
INSERT INTO `users` VALUES (13, 'kober-bromo', 'prayit@kober.co', 2, 'MGR0003', '$2y$10$hyOG.NZ4aWK91KK64GIFGuryoBLUcjebOZUObwrRG2eshBzfpvWTm', 1, NULL, '2018-10-22 22:39:11');
INSERT INTO `users` VALUES (14, 'mie-oyen', 'mie.oyen@gmail.com', 1, 'PT0006', '$2y$10$//6X3ypGli2mqbKGS6GxRe.ceVwLm2bbYtf6XHuSNTPVXo1wwaMAq', 0, NULL, '2018-10-30 18:39:40');
INSERT INTO `users` VALUES (15, 'agasa', 'agasa@gmail.com', 1, 'PT0007', '$2y$10$cC.ZR2x7iRQGZF12etEcnenzrC3UEXNz3Ovo1iIthX6aV/WtJOp/i', 0, NULL, '2018-11-01 09:40:04');
INSERT INTO `users` VALUES (16, 'bimo', 'bimo@agasa.com', 2, 'MGR0004', '$2y$10$fAw20Oz//gY46Bv3TAHYV.bOr3.2DfPN5Dp5EFvo.nPqm22hhnDhW', 1, NULL, '2018-11-01 09:41:02');
INSERT INTO `users` VALUES (17, 'hizkia', '161111044@mhs.stiki.ac.id', 2, 'MGR0005', '$2y$10$RgEy1eZAK7TT3FYlV5HVlO59WJc887WdpnbsySH1ADKOcD/NNLi1.', 1, NULL, '2018-11-06 11:47:51');
INSERT INTO `users` VALUES (18, 'cobaan', 'cs.tempati@gmail.com', 2, 'MGR0006', '$2y$10$nEE1EaR7lx2nW6iZaXkui.SR.rPezyAFE1mPfMq55AyEWSVusOx3S', 1, 'f902f09c48aac5fdbdc389271d704daa', '2018-11-13 13:34:15');
INSERT INTO `users` VALUES (19, 'valve', 'cs.tempati@gmail.com', 1, 'PT0008', '$2y$10$rl4OXduWBzc262bn3qjlTeDO6K2csAgkwb4.IGm7Qcv2h/6cSD4dK', 2, 'd6290b8d794ef655534893019447d118', '2018-11-13 13:53:11');
INSERT INTO `users` VALUES (20, 'android', 'android@dev.com', 3, 'CS0004', '$2y$10$pU7lOEy4UwC5PDhiZdYpkedNFotURD3vXENwPl0rprbxZylUv3tQ6', 0, '6a4c174e71ea1d7c905c3004c2216e95', '2018-11-14 20:45:59');
INSERT INTO `users` VALUES (22, 'asdfgh', 'asd@asd.asd', 3, 'CS0009', '$2y$10$CrT0pAEwHM4QVhynWusnfeNTGUbMEYHtwaalLTMUQrzjvZvIyoL.2', 0, 'dd6e83b6da55d90f5740e0dd3f3e5a13', '2018-12-17 17:54:17');
INSERT INTO `users` VALUES (23, 'lyrae', 'lyrae@gmail.com', 3, 'CS0010', '$2y$10$6I6usuRswSXjl3GVJh40POoMbYK/R7WPGuZLe9XxK2XgdZ8n6QDlC', 0, '918cf1aabacbe0e3ce8a6f2758b51e98', '2018-12-18 11:07:43');
INSERT INTO `users` VALUES (25, 'andik', 'omibalola@gmail.com', 2, 'MGR0008', '$2y$10$QM7glNQDhotmTd/BURLTfOSiN9CId7HiClpbsoox90FX1zLti/.sq', 0, '1507c3821047678b7bc0f0e281031633', '2018-12-18 11:25:56');
INSERT INTO `users` VALUES (26, 'onyxzed', 'onyxzed@gmail.com', 3, 'CS0011', '$2y$10$HGj1J3BIFwGnHCT4q08rgOoKV7NzwQmH1C6Xx6J10Vs9tqiivlDwe', 0, 'cc43cae8b2c9735749cb067be62f9311', '2019-01-14 22:31:32');
INSERT INTO `users` VALUES (28, 'chaulina', 'chaulina@stiki.ac.id', 3, 'CS0012', '$2y$10$OX2AVwfAHHov8Ug7NkUCb.qSHKfpTeskSXa0YgMQ3xGsRNFyhTosW', 0, '6a0724f1d3e80fd5f761cacb7efe8593', '2019-01-15 08:33:01');
INSERT INTO `users` VALUES (31, 'wagendeng', 'wagendeng@email.com', 2, 'MGR0007', '$2y$10$CP4wKTD7IOS1qh4bgbmz/ODDsYYwztQ1tsOEkYbruWD2qV6cEEZde', 0, '8581f83e347e1acf4ea5d8e6274a4550', '2019-01-16 21:07:10');
INSERT INTO `users` VALUES (32, 'post-koffie', 'cs_postkoffie@gmail.com', 1, 'PT0009', '$2y$10$qNbaTBWEkbai/pcgUMpYl.PLvCrIjXXHcp5ZEhwTzmJebn60sWjky', 0, 'da45a9f6abb62fa4cea5d90999429a0c', '2019-01-16 23:03:26');

-- ----------------------------
-- Table structure for wilayah_kabupaten
-- ----------------------------
DROP TABLE IF EXISTS `wilayah_kabupaten`;
CREATE TABLE `wilayah_kabupaten`  (
  `id` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `provinsi_id` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `nama` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of wilayah_kabupaten
-- ----------------------------
INSERT INTO `wilayah_kabupaten` VALUES ('1101', '11', 'Kab. Simeulue');
INSERT INTO `wilayah_kabupaten` VALUES ('1102', '11', 'Kab. Aceh Singkil');
INSERT INTO `wilayah_kabupaten` VALUES ('1103', '11', 'Kab. Aceh Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('1104', '11', 'Kab. Aceh Tenggara');
INSERT INTO `wilayah_kabupaten` VALUES ('1105', '11', 'Kab. Aceh Timur');
INSERT INTO `wilayah_kabupaten` VALUES ('1106', '11', 'Kab. Aceh Tengah');
INSERT INTO `wilayah_kabupaten` VALUES ('1107', '11', 'Kab. Aceh Barat');
INSERT INTO `wilayah_kabupaten` VALUES ('1108', '11', 'Kab. Aceh Besar');
INSERT INTO `wilayah_kabupaten` VALUES ('1109', '11', 'Kab. Pidie');
INSERT INTO `wilayah_kabupaten` VALUES ('1110', '11', 'Kab. Bireuen');
INSERT INTO `wilayah_kabupaten` VALUES ('1111', '11', 'Kab. Aceh Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('1112', '11', 'Kab. Aceh Barat Daya');
INSERT INTO `wilayah_kabupaten` VALUES ('1113', '11', 'Kab. Gayo Lues');
INSERT INTO `wilayah_kabupaten` VALUES ('1114', '11', 'Kab. Aceh Tamiang');
INSERT INTO `wilayah_kabupaten` VALUES ('1115', '11', 'Kab. Nagan Raya');
INSERT INTO `wilayah_kabupaten` VALUES ('1116', '11', 'Kab. Aceh Jaya');
INSERT INTO `wilayah_kabupaten` VALUES ('1117', '11', 'Kab. Bener Meriah');
INSERT INTO `wilayah_kabupaten` VALUES ('1118', '11', 'Kab. Pidie Jaya');
INSERT INTO `wilayah_kabupaten` VALUES ('1171', '11', 'Kota Banda Aceh');
INSERT INTO `wilayah_kabupaten` VALUES ('1172', '11', 'Kota Sabang');
INSERT INTO `wilayah_kabupaten` VALUES ('1173', '11', 'Kota Langsa');
INSERT INTO `wilayah_kabupaten` VALUES ('1174', '11', 'Kota Lhokseumawe');
INSERT INTO `wilayah_kabupaten` VALUES ('1175', '11', 'Kota Subulussalam');
INSERT INTO `wilayah_kabupaten` VALUES ('1201', '12', 'Kab. Nias');
INSERT INTO `wilayah_kabupaten` VALUES ('1202', '12', 'Kab. Mandailing Natal');
INSERT INTO `wilayah_kabupaten` VALUES ('1203', '12', 'Kab. Tapanuli Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('1204', '12', 'Kab. Tapanuli Tengah');
INSERT INTO `wilayah_kabupaten` VALUES ('1205', '12', 'Kab. Tapanuli Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('1206', '12', 'Kab. Toba Samosir');
INSERT INTO `wilayah_kabupaten` VALUES ('1207', '12', 'Kab. Labuhan Batu');
INSERT INTO `wilayah_kabupaten` VALUES ('1208', '12', 'Kab. Asahan');
INSERT INTO `wilayah_kabupaten` VALUES ('1209', '12', 'Kab. Simalungun');
INSERT INTO `wilayah_kabupaten` VALUES ('1210', '12', 'Kab. Dairi');
INSERT INTO `wilayah_kabupaten` VALUES ('1211', '12', 'Kab. Karo');
INSERT INTO `wilayah_kabupaten` VALUES ('1212', '12', 'Kab. Deli Serdang');
INSERT INTO `wilayah_kabupaten` VALUES ('1213', '12', 'Kab. Langkat');
INSERT INTO `wilayah_kabupaten` VALUES ('1214', '12', 'Kab. Nias Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('1215', '12', 'Kab. Humbang Hasundutan');
INSERT INTO `wilayah_kabupaten` VALUES ('1216', '12', 'Kab. Pakpak Bharat');
INSERT INTO `wilayah_kabupaten` VALUES ('1217', '12', 'Kab. Samosir');
INSERT INTO `wilayah_kabupaten` VALUES ('1218', '12', 'Kab. Serdang Bedagai');
INSERT INTO `wilayah_kabupaten` VALUES ('1219', '12', 'Kab. Batu Bara');
INSERT INTO `wilayah_kabupaten` VALUES ('1220', '12', 'Kab. Padang Lawas Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('1221', '12', 'Kab. Padang Lawas');
INSERT INTO `wilayah_kabupaten` VALUES ('1222', '12', 'Kab. Labuhan Batu Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('1223', '12', 'Kab. Labuhan Batu Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('1224', '12', 'Kab. Nias Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('1225', '12', 'Kab. Nias Barat');
INSERT INTO `wilayah_kabupaten` VALUES ('1271', '12', 'Kota Sibolga');
INSERT INTO `wilayah_kabupaten` VALUES ('1272', '12', 'Kota Tanjung Balai');
INSERT INTO `wilayah_kabupaten` VALUES ('1273', '12', 'Kota Pematang Siantar');
INSERT INTO `wilayah_kabupaten` VALUES ('1274', '12', 'Kota Tebing Tinggi');
INSERT INTO `wilayah_kabupaten` VALUES ('1275', '12', 'Kota Medan');
INSERT INTO `wilayah_kabupaten` VALUES ('1276', '12', 'Kota Binjai');
INSERT INTO `wilayah_kabupaten` VALUES ('1277', '12', 'Kota Padangsidimpuan');
INSERT INTO `wilayah_kabupaten` VALUES ('1278', '12', 'Kota Gunungsitoli');
INSERT INTO `wilayah_kabupaten` VALUES ('1301', '13', 'Kab. Kepulauan Mentawai');
INSERT INTO `wilayah_kabupaten` VALUES ('1302', '13', 'Kab. Pesisir Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('1303', '13', 'Kab. Solok');
INSERT INTO `wilayah_kabupaten` VALUES ('1304', '13', 'Kab. Sijunjung');
INSERT INTO `wilayah_kabupaten` VALUES ('1305', '13', 'Kab. Tanah Datar');
INSERT INTO `wilayah_kabupaten` VALUES ('1306', '13', 'Kab. Padang Pariaman');
INSERT INTO `wilayah_kabupaten` VALUES ('1307', '13', 'Kab. Agam');
INSERT INTO `wilayah_kabupaten` VALUES ('1308', '13', 'Kab. Lima Puluh Kota');
INSERT INTO `wilayah_kabupaten` VALUES ('1309', '13', 'Kab. Pasaman');
INSERT INTO `wilayah_kabupaten` VALUES ('1310', '13', 'Kab. Solok Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('1311', '13', 'Kab. Dharmasraya');
INSERT INTO `wilayah_kabupaten` VALUES ('1312', '13', 'Kab. Pasaman Barat');
INSERT INTO `wilayah_kabupaten` VALUES ('1371', '13', 'Kota Padang');
INSERT INTO `wilayah_kabupaten` VALUES ('1372', '13', 'Kota Solok');
INSERT INTO `wilayah_kabupaten` VALUES ('1373', '13', 'Kota Sawah Lunto');
INSERT INTO `wilayah_kabupaten` VALUES ('1374', '13', 'Kota Padang Panjang');
INSERT INTO `wilayah_kabupaten` VALUES ('1375', '13', 'Kota Bukittinggi');
INSERT INTO `wilayah_kabupaten` VALUES ('1376', '13', 'Kota Payakumbuh');
INSERT INTO `wilayah_kabupaten` VALUES ('1377', '13', 'Kota Pariaman');
INSERT INTO `wilayah_kabupaten` VALUES ('1401', '14', 'Kab. Kuantan Singingi');
INSERT INTO `wilayah_kabupaten` VALUES ('1402', '14', 'Kab. Indragiri Hulu');
INSERT INTO `wilayah_kabupaten` VALUES ('1403', '14', 'Kab. Indragiri Hilir');
INSERT INTO `wilayah_kabupaten` VALUES ('1404', '14', 'Kab. Pelalawan');
INSERT INTO `wilayah_kabupaten` VALUES ('1405', '14', 'Kab. S I A K');
INSERT INTO `wilayah_kabupaten` VALUES ('1406', '14', 'Kab. Kampar');
INSERT INTO `wilayah_kabupaten` VALUES ('1407', '14', 'Kab. Rokan Hulu');
INSERT INTO `wilayah_kabupaten` VALUES ('1408', '14', 'Kab. Bengkalis');
INSERT INTO `wilayah_kabupaten` VALUES ('1409', '14', 'Kab. Rokan Hilir');
INSERT INTO `wilayah_kabupaten` VALUES ('1410', '14', 'Kab. Kepulauan Meranti');
INSERT INTO `wilayah_kabupaten` VALUES ('1471', '14', 'Kota Pekanbaru');
INSERT INTO `wilayah_kabupaten` VALUES ('1473', '14', 'Kota D U M A I');
INSERT INTO `wilayah_kabupaten` VALUES ('1501', '15', 'Kab. Kerinci');
INSERT INTO `wilayah_kabupaten` VALUES ('1502', '15', 'Kab. Merangin');
INSERT INTO `wilayah_kabupaten` VALUES ('1503', '15', 'Kab. Sarolangun');
INSERT INTO `wilayah_kabupaten` VALUES ('1504', '15', 'Kab. Batang Hari');
INSERT INTO `wilayah_kabupaten` VALUES ('1505', '15', 'Kab. Muaro Jambi');
INSERT INTO `wilayah_kabupaten` VALUES ('1506', '15', 'Kab. Tanjung Jabung Timur');
INSERT INTO `wilayah_kabupaten` VALUES ('1507', '15', 'Kab. Tanjung Jabung Barat');
INSERT INTO `wilayah_kabupaten` VALUES ('1508', '15', 'Kab. Tebo');
INSERT INTO `wilayah_kabupaten` VALUES ('1509', '15', 'Kab. Bungo');
INSERT INTO `wilayah_kabupaten` VALUES ('1571', '15', 'Kota Jambi');
INSERT INTO `wilayah_kabupaten` VALUES ('1572', '15', 'Kota Sungai Penuh');
INSERT INTO `wilayah_kabupaten` VALUES ('1601', '16', 'Kab. Ogan Komering Ulu');
INSERT INTO `wilayah_kabupaten` VALUES ('1602', '16', 'Kab. Ogan Komering Ilir');
INSERT INTO `wilayah_kabupaten` VALUES ('1603', '16', 'Kab. Muara Enim');
INSERT INTO `wilayah_kabupaten` VALUES ('1604', '16', 'Kab. Lahat');
INSERT INTO `wilayah_kabupaten` VALUES ('1605', '16', 'Kab. Musi Rawas');
INSERT INTO `wilayah_kabupaten` VALUES ('1606', '16', 'Kab. Musi Banyuasin');
INSERT INTO `wilayah_kabupaten` VALUES ('1607', '16', 'Kab. Banyu Asin');
INSERT INTO `wilayah_kabupaten` VALUES ('1608', '16', 'Kab. Ogan Komering Ulu Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('1609', '16', 'Kab. Ogan Komering Ulu Timur');
INSERT INTO `wilayah_kabupaten` VALUES ('1610', '16', 'Kab. Ogan Ilir');
INSERT INTO `wilayah_kabupaten` VALUES ('1611', '16', 'Kab. Empat Lawang');
INSERT INTO `wilayah_kabupaten` VALUES ('1671', '16', 'Kota Palembang');
INSERT INTO `wilayah_kabupaten` VALUES ('1672', '16', 'Kota Prabumulih');
INSERT INTO `wilayah_kabupaten` VALUES ('1673', '16', 'Kota Pagar Alam');
INSERT INTO `wilayah_kabupaten` VALUES ('1674', '16', 'Kota Lubuklinggau');
INSERT INTO `wilayah_kabupaten` VALUES ('1701', '17', 'Kab. Bengkulu Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('1702', '17', 'Kab. Rejang Lebong');
INSERT INTO `wilayah_kabupaten` VALUES ('1703', '17', 'Kab. Bengkulu Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('1704', '17', 'Kab. Kaur');
INSERT INTO `wilayah_kabupaten` VALUES ('1705', '17', 'Kab. Seluma');
INSERT INTO `wilayah_kabupaten` VALUES ('1706', '17', 'Kab. Mukomuko');
INSERT INTO `wilayah_kabupaten` VALUES ('1707', '17', 'Kab. Lebong');
INSERT INTO `wilayah_kabupaten` VALUES ('1708', '17', 'Kab. Kepahiang');
INSERT INTO `wilayah_kabupaten` VALUES ('1709', '17', 'Kab. Bengkulu Tengah');
INSERT INTO `wilayah_kabupaten` VALUES ('1771', '17', 'Kota Bengkulu');
INSERT INTO `wilayah_kabupaten` VALUES ('1801', '18', 'Kab. Lampung Barat');
INSERT INTO `wilayah_kabupaten` VALUES ('1802', '18', 'Kab. Tanggamus');
INSERT INTO `wilayah_kabupaten` VALUES ('1803', '18', 'Kab. Lampung Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('1804', '18', 'Kab. Lampung Timur');
INSERT INTO `wilayah_kabupaten` VALUES ('1805', '18', 'Kab. Lampung Tengah');
INSERT INTO `wilayah_kabupaten` VALUES ('1806', '18', 'Kab. Lampung Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('1807', '18', 'Kab. Way Kanan');
INSERT INTO `wilayah_kabupaten` VALUES ('1808', '18', 'Kab. Tulangbawang');
INSERT INTO `wilayah_kabupaten` VALUES ('1809', '18', 'Kab. Pesawaran');
INSERT INTO `wilayah_kabupaten` VALUES ('1810', '18', 'Kab. Pringsewu');
INSERT INTO `wilayah_kabupaten` VALUES ('1811', '18', 'Kab. Mesuji');
INSERT INTO `wilayah_kabupaten` VALUES ('1812', '18', 'Kab. Tulang Bawang Barat');
INSERT INTO `wilayah_kabupaten` VALUES ('1813', '18', 'Kab. Pesisir Barat');
INSERT INTO `wilayah_kabupaten` VALUES ('1871', '18', 'Kota Bandar Lampung');
INSERT INTO `wilayah_kabupaten` VALUES ('1872', '18', 'Kota Metro');
INSERT INTO `wilayah_kabupaten` VALUES ('1901', '19', 'Kab. Bangka');
INSERT INTO `wilayah_kabupaten` VALUES ('1902', '19', 'Kab. Belitung');
INSERT INTO `wilayah_kabupaten` VALUES ('1903', '19', 'Kab. Bangka Barat');
INSERT INTO `wilayah_kabupaten` VALUES ('1904', '19', 'Kab. Bangka Tengah');
INSERT INTO `wilayah_kabupaten` VALUES ('1905', '19', 'Kab. Bangka Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('1906', '19', 'Kab. Belitung Timur');
INSERT INTO `wilayah_kabupaten` VALUES ('1971', '19', 'Kota Pangkal Pinang');
INSERT INTO `wilayah_kabupaten` VALUES ('2101', '21', 'Kab. Karimun');
INSERT INTO `wilayah_kabupaten` VALUES ('2102', '21', 'Kab. Bintan');
INSERT INTO `wilayah_kabupaten` VALUES ('2103', '21', 'Kab. Natuna');
INSERT INTO `wilayah_kabupaten` VALUES ('2104', '21', 'Kab. Lingga');
INSERT INTO `wilayah_kabupaten` VALUES ('2105', '21', 'Kab. Kepulauan Anambas');
INSERT INTO `wilayah_kabupaten` VALUES ('2171', '21', 'Kota B A T A M');
INSERT INTO `wilayah_kabupaten` VALUES ('2172', '21', 'Kota Tanjung Pinang');
INSERT INTO `wilayah_kabupaten` VALUES ('3101', '31', 'Kab. Kepulauan Seribu');
INSERT INTO `wilayah_kabupaten` VALUES ('3171', '31', 'Kota Jakarta Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('3172', '31', 'Kota Jakarta Timur');
INSERT INTO `wilayah_kabupaten` VALUES ('3173', '31', 'Kota Jakarta Pusat');
INSERT INTO `wilayah_kabupaten` VALUES ('3174', '31', 'Kota Jakarta Barat');
INSERT INTO `wilayah_kabupaten` VALUES ('3175', '31', 'Kota Jakarta Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('3201', '32', 'Kab. Bogor');
INSERT INTO `wilayah_kabupaten` VALUES ('3202', '32', 'Kab. Sukabumi');
INSERT INTO `wilayah_kabupaten` VALUES ('3203', '32', 'Kab. Cianjur');
INSERT INTO `wilayah_kabupaten` VALUES ('3204', '32', 'Kab. Bandung');
INSERT INTO `wilayah_kabupaten` VALUES ('3205', '32', 'Kab. Garut');
INSERT INTO `wilayah_kabupaten` VALUES ('3206', '32', 'Kab. Tasikmalaya');
INSERT INTO `wilayah_kabupaten` VALUES ('3207', '32', 'Kab. Ciamis');
INSERT INTO `wilayah_kabupaten` VALUES ('3208', '32', 'Kab. Kuningan');
INSERT INTO `wilayah_kabupaten` VALUES ('3209', '32', 'Kab. Cirebon');
INSERT INTO `wilayah_kabupaten` VALUES ('3210', '32', 'Kab. Majalengka');
INSERT INTO `wilayah_kabupaten` VALUES ('3211', '32', 'Kab. Sumedang');
INSERT INTO `wilayah_kabupaten` VALUES ('3212', '32', 'Kab. Indramayu');
INSERT INTO `wilayah_kabupaten` VALUES ('3213', '32', 'Kab. Subang');
INSERT INTO `wilayah_kabupaten` VALUES ('3214', '32', 'Kab. Purwakarta');
INSERT INTO `wilayah_kabupaten` VALUES ('3215', '32', 'Kab. Karawang');
INSERT INTO `wilayah_kabupaten` VALUES ('3216', '32', 'Kab. Bekasi');
INSERT INTO `wilayah_kabupaten` VALUES ('3217', '32', 'Kab. Bandung Barat');
INSERT INTO `wilayah_kabupaten` VALUES ('3218', '32', 'Kab. Pangandaran');
INSERT INTO `wilayah_kabupaten` VALUES ('3271', '32', 'Kota Bogor');
INSERT INTO `wilayah_kabupaten` VALUES ('3272', '32', 'Kota Sukabumi');
INSERT INTO `wilayah_kabupaten` VALUES ('3273', '32', 'Kota Bandung');
INSERT INTO `wilayah_kabupaten` VALUES ('3274', '32', 'Kota Cirebon');
INSERT INTO `wilayah_kabupaten` VALUES ('3275', '32', 'Kota Bekasi');
INSERT INTO `wilayah_kabupaten` VALUES ('3276', '32', 'Kota Depok');
INSERT INTO `wilayah_kabupaten` VALUES ('3277', '32', 'Kota Cimahi');
INSERT INTO `wilayah_kabupaten` VALUES ('3278', '32', 'Kota Tasikmalaya');
INSERT INTO `wilayah_kabupaten` VALUES ('3279', '32', 'Kota Banjar');
INSERT INTO `wilayah_kabupaten` VALUES ('3301', '33', 'Kab. Cilacap');
INSERT INTO `wilayah_kabupaten` VALUES ('3302', '33', 'Kab. Banyumas');
INSERT INTO `wilayah_kabupaten` VALUES ('3303', '33', 'Kab. Purbalingga');
INSERT INTO `wilayah_kabupaten` VALUES ('3304', '33', 'Kab. Banjarnegara');
INSERT INTO `wilayah_kabupaten` VALUES ('3305', '33', 'Kab. Kebumen');
INSERT INTO `wilayah_kabupaten` VALUES ('3306', '33', 'Kab. Purworejo');
INSERT INTO `wilayah_kabupaten` VALUES ('3307', '33', 'Kab. Wonosobo');
INSERT INTO `wilayah_kabupaten` VALUES ('3308', '33', 'Kab. Magelang');
INSERT INTO `wilayah_kabupaten` VALUES ('3309', '33', 'Kab. Boyolali');
INSERT INTO `wilayah_kabupaten` VALUES ('3310', '33', 'Kab. Klaten');
INSERT INTO `wilayah_kabupaten` VALUES ('3311', '33', 'Kab. Sukoharjo');
INSERT INTO `wilayah_kabupaten` VALUES ('3312', '33', 'Kab. Wonogiri');
INSERT INTO `wilayah_kabupaten` VALUES ('3313', '33', 'Kab. Karanganyar');
INSERT INTO `wilayah_kabupaten` VALUES ('3314', '33', 'Kab. Sragen');
INSERT INTO `wilayah_kabupaten` VALUES ('3315', '33', 'Kab. Grobogan');
INSERT INTO `wilayah_kabupaten` VALUES ('3316', '33', 'Kab. Blora');
INSERT INTO `wilayah_kabupaten` VALUES ('3317', '33', 'Kab. Rembang');
INSERT INTO `wilayah_kabupaten` VALUES ('3318', '33', 'Kab. Pati');
INSERT INTO `wilayah_kabupaten` VALUES ('3319', '33', 'Kab. Kudus');
INSERT INTO `wilayah_kabupaten` VALUES ('3320', '33', 'Kab. Jepara');
INSERT INTO `wilayah_kabupaten` VALUES ('3321', '33', 'Kab. Demak');
INSERT INTO `wilayah_kabupaten` VALUES ('3322', '33', 'Kab. Semarang');
INSERT INTO `wilayah_kabupaten` VALUES ('3323', '33', 'Kab. Temanggung');
INSERT INTO `wilayah_kabupaten` VALUES ('3324', '33', 'Kab. Kendal');
INSERT INTO `wilayah_kabupaten` VALUES ('3325', '33', 'Kab. Batang');
INSERT INTO `wilayah_kabupaten` VALUES ('3326', '33', 'Kab. Pekalongan');
INSERT INTO `wilayah_kabupaten` VALUES ('3327', '33', 'Kab. Pemalang');
INSERT INTO `wilayah_kabupaten` VALUES ('3328', '33', 'Kab. Tegal');
INSERT INTO `wilayah_kabupaten` VALUES ('3329', '33', 'Kab. Brebes');
INSERT INTO `wilayah_kabupaten` VALUES ('3371', '33', 'Kota Magelang');
INSERT INTO `wilayah_kabupaten` VALUES ('3372', '33', 'Kota Surakarta');
INSERT INTO `wilayah_kabupaten` VALUES ('3373', '33', 'Kota Salatiga');
INSERT INTO `wilayah_kabupaten` VALUES ('3374', '33', 'Kota Semarang');
INSERT INTO `wilayah_kabupaten` VALUES ('3375', '33', 'Kota Pekalongan');
INSERT INTO `wilayah_kabupaten` VALUES ('3376', '33', 'Kota Tegal');
INSERT INTO `wilayah_kabupaten` VALUES ('3401', '34', 'Kab. Kulon Progo');
INSERT INTO `wilayah_kabupaten` VALUES ('3402', '34', 'Kab. Bantul');
INSERT INTO `wilayah_kabupaten` VALUES ('3403', '34', 'Kab. Gunung Kidul');
INSERT INTO `wilayah_kabupaten` VALUES ('3404', '34', 'Kab. Sleman');
INSERT INTO `wilayah_kabupaten` VALUES ('3471', '34', 'Kota Yogyakarta');
INSERT INTO `wilayah_kabupaten` VALUES ('3501', '35', 'Kab. Pacitan');
INSERT INTO `wilayah_kabupaten` VALUES ('3502', '35', 'Kab. Ponorogo');
INSERT INTO `wilayah_kabupaten` VALUES ('3503', '35', 'Kab. Trenggalek');
INSERT INTO `wilayah_kabupaten` VALUES ('3504', '35', 'Kab. Tulungagung');
INSERT INTO `wilayah_kabupaten` VALUES ('3505', '35', 'Kab. Blitar');
INSERT INTO `wilayah_kabupaten` VALUES ('3506', '35', 'Kab. Kediri');
INSERT INTO `wilayah_kabupaten` VALUES ('3507', '35', 'Kab. Malang');
INSERT INTO `wilayah_kabupaten` VALUES ('3508', '35', 'Kab. Lumajang');
INSERT INTO `wilayah_kabupaten` VALUES ('3509', '35', 'Kab. Jember');
INSERT INTO `wilayah_kabupaten` VALUES ('3510', '35', 'Kab. Banyuwangi');
INSERT INTO `wilayah_kabupaten` VALUES ('3511', '35', 'Kab. Bondowoso');
INSERT INTO `wilayah_kabupaten` VALUES ('3512', '35', 'Kab. Situbondo');
INSERT INTO `wilayah_kabupaten` VALUES ('3513', '35', 'Kab. Probolinggo');
INSERT INTO `wilayah_kabupaten` VALUES ('3514', '35', 'Kab. Pasuruan');
INSERT INTO `wilayah_kabupaten` VALUES ('3515', '35', 'Kab. Sidoarjo');
INSERT INTO `wilayah_kabupaten` VALUES ('3516', '35', 'Kab. Mojokerto');
INSERT INTO `wilayah_kabupaten` VALUES ('3517', '35', 'Kab. Jombang');
INSERT INTO `wilayah_kabupaten` VALUES ('3518', '35', 'Kab. Nganjuk');
INSERT INTO `wilayah_kabupaten` VALUES ('3519', '35', 'Kab. Madiun');
INSERT INTO `wilayah_kabupaten` VALUES ('3520', '35', 'Kab. Magetan');
INSERT INTO `wilayah_kabupaten` VALUES ('3521', '35', 'Kab. Ngawi');
INSERT INTO `wilayah_kabupaten` VALUES ('3522', '35', 'Kab. Bojonegoro');
INSERT INTO `wilayah_kabupaten` VALUES ('3523', '35', 'Kab. Tuban');
INSERT INTO `wilayah_kabupaten` VALUES ('3524', '35', 'Kab. Lamongan');
INSERT INTO `wilayah_kabupaten` VALUES ('3525', '35', 'Kab. Gresik');
INSERT INTO `wilayah_kabupaten` VALUES ('3526', '35', 'Kab. Bangkalan');
INSERT INTO `wilayah_kabupaten` VALUES ('3527', '35', 'Kab. Sampang');
INSERT INTO `wilayah_kabupaten` VALUES ('3528', '35', 'Kab. Pamekasan');
INSERT INTO `wilayah_kabupaten` VALUES ('3529', '35', 'Kab. Sumenep');
INSERT INTO `wilayah_kabupaten` VALUES ('3571', '35', 'Kota Kediri');
INSERT INTO `wilayah_kabupaten` VALUES ('3572', '35', 'Kota Blitar');
INSERT INTO `wilayah_kabupaten` VALUES ('3573', '35', 'Kota Malang');
INSERT INTO `wilayah_kabupaten` VALUES ('3574', '35', 'Kota Probolinggo');
INSERT INTO `wilayah_kabupaten` VALUES ('3575', '35', 'Kota Pasuruan');
INSERT INTO `wilayah_kabupaten` VALUES ('3576', '35', 'Kota Mojokerto');
INSERT INTO `wilayah_kabupaten` VALUES ('3577', '35', 'Kota Madiun');
INSERT INTO `wilayah_kabupaten` VALUES ('3578', '35', 'Kota Surabaya');
INSERT INTO `wilayah_kabupaten` VALUES ('3579', '35', 'Kota Batu');
INSERT INTO `wilayah_kabupaten` VALUES ('3601', '36', 'Kab. Pandeglang');
INSERT INTO `wilayah_kabupaten` VALUES ('3602', '36', 'Kab. Lebak');
INSERT INTO `wilayah_kabupaten` VALUES ('3603', '36', 'Kab. Tangerang');
INSERT INTO `wilayah_kabupaten` VALUES ('3604', '36', 'Kab. Serang');
INSERT INTO `wilayah_kabupaten` VALUES ('3671', '36', 'Kota Tangerang');
INSERT INTO `wilayah_kabupaten` VALUES ('3672', '36', 'Kota Cilegon');
INSERT INTO `wilayah_kabupaten` VALUES ('3673', '36', 'Kota Serang');
INSERT INTO `wilayah_kabupaten` VALUES ('3674', '36', 'Kota Tangerang Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('5101', '51', 'Kab. Jembrana');
INSERT INTO `wilayah_kabupaten` VALUES ('5102', '51', 'Kab. Tabanan');
INSERT INTO `wilayah_kabupaten` VALUES ('5103', '51', 'Kab. Badung');
INSERT INTO `wilayah_kabupaten` VALUES ('5104', '51', 'Kab. Gianyar');
INSERT INTO `wilayah_kabupaten` VALUES ('5105', '51', 'Kab. Klungkung');
INSERT INTO `wilayah_kabupaten` VALUES ('5106', '51', 'Kab. Bangli');
INSERT INTO `wilayah_kabupaten` VALUES ('5107', '51', 'Kab. Karang Asem');
INSERT INTO `wilayah_kabupaten` VALUES ('5108', '51', 'Kab. Buleleng');
INSERT INTO `wilayah_kabupaten` VALUES ('5171', '51', 'Kota Denpasar');
INSERT INTO `wilayah_kabupaten` VALUES ('5201', '52', 'Kab. Lombok Barat');
INSERT INTO `wilayah_kabupaten` VALUES ('5202', '52', 'Kab. Lombok Tengah');
INSERT INTO `wilayah_kabupaten` VALUES ('5203', '52', 'Kab. Lombok Timur');
INSERT INTO `wilayah_kabupaten` VALUES ('5204', '52', 'Kab. Sumbawa');
INSERT INTO `wilayah_kabupaten` VALUES ('5205', '52', 'Kab. Dompu');
INSERT INTO `wilayah_kabupaten` VALUES ('5206', '52', 'Kab. Bima');
INSERT INTO `wilayah_kabupaten` VALUES ('5207', '52', 'Kab. Sumbawa Barat');
INSERT INTO `wilayah_kabupaten` VALUES ('5208', '52', 'Kab. Lombok Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('5271', '52', 'Kota Mataram');
INSERT INTO `wilayah_kabupaten` VALUES ('5272', '52', 'Kota Bima');
INSERT INTO `wilayah_kabupaten` VALUES ('5301', '53', 'Kab. Sumba Barat');
INSERT INTO `wilayah_kabupaten` VALUES ('5302', '53', 'Kab. Sumba Timur');
INSERT INTO `wilayah_kabupaten` VALUES ('5303', '53', 'Kab. Kupang');
INSERT INTO `wilayah_kabupaten` VALUES ('5304', '53', 'Kab. Timor Tengah Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('5305', '53', 'Kab. Timor Tengah Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('5306', '53', 'Kab. Belu');
INSERT INTO `wilayah_kabupaten` VALUES ('5307', '53', 'Kab. Alor');
INSERT INTO `wilayah_kabupaten` VALUES ('5308', '53', 'Kab. Lembata');
INSERT INTO `wilayah_kabupaten` VALUES ('5309', '53', 'Kab. Flores Timur');
INSERT INTO `wilayah_kabupaten` VALUES ('5310', '53', 'Kab. Sikka');
INSERT INTO `wilayah_kabupaten` VALUES ('5311', '53', 'Kab. Ende');
INSERT INTO `wilayah_kabupaten` VALUES ('5312', '53', 'Kab. Ngada');
INSERT INTO `wilayah_kabupaten` VALUES ('5313', '53', 'Kab. Manggarai');
INSERT INTO `wilayah_kabupaten` VALUES ('5314', '53', 'Kab. Rote Ndao');
INSERT INTO `wilayah_kabupaten` VALUES ('5315', '53', 'Kab. Manggarai Barat');
INSERT INTO `wilayah_kabupaten` VALUES ('5316', '53', 'Kab. Sumba Tengah');
INSERT INTO `wilayah_kabupaten` VALUES ('5317', '53', 'Kab. Sumba Barat Daya');
INSERT INTO `wilayah_kabupaten` VALUES ('5318', '53', 'Kab. Nagekeo');
INSERT INTO `wilayah_kabupaten` VALUES ('5319', '53', 'Kab. Manggarai Timur');
INSERT INTO `wilayah_kabupaten` VALUES ('5320', '53', 'Kab. Sabu Raijua');
INSERT INTO `wilayah_kabupaten` VALUES ('5371', '53', 'Kota Kupang');
INSERT INTO `wilayah_kabupaten` VALUES ('6101', '61', 'Kab. Sambas');
INSERT INTO `wilayah_kabupaten` VALUES ('6102', '61', 'Kab. Bengkayang');
INSERT INTO `wilayah_kabupaten` VALUES ('6103', '61', 'Kab. Landak');
INSERT INTO `wilayah_kabupaten` VALUES ('6104', '61', 'Kab. Pontianak');
INSERT INTO `wilayah_kabupaten` VALUES ('6105', '61', 'Kab. Sanggau');
INSERT INTO `wilayah_kabupaten` VALUES ('6106', '61', 'Kab. Ketapang');
INSERT INTO `wilayah_kabupaten` VALUES ('6107', '61', 'Kab. Sintang');
INSERT INTO `wilayah_kabupaten` VALUES ('6108', '61', 'Kab. Kapuas Hulu');
INSERT INTO `wilayah_kabupaten` VALUES ('6109', '61', 'Kab. Sekadau');
INSERT INTO `wilayah_kabupaten` VALUES ('6110', '61', 'Kab. Melawi');
INSERT INTO `wilayah_kabupaten` VALUES ('6111', '61', 'Kab. Kayong Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('6112', '61', 'Kab. Kubu Raya');
INSERT INTO `wilayah_kabupaten` VALUES ('6171', '61', 'Kota Pontianak');
INSERT INTO `wilayah_kabupaten` VALUES ('6172', '61', 'Kota Singkawang');
INSERT INTO `wilayah_kabupaten` VALUES ('6201', '62', 'Kab. Kotawaringin Barat');
INSERT INTO `wilayah_kabupaten` VALUES ('6202', '62', 'Kab. Kotawaringin Timur');
INSERT INTO `wilayah_kabupaten` VALUES ('6203', '62', 'Kab. Kapuas');
INSERT INTO `wilayah_kabupaten` VALUES ('6204', '62', 'Kab. Barito Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('6205', '62', 'Kab. Barito Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('6206', '62', 'Kab. Sukamara');
INSERT INTO `wilayah_kabupaten` VALUES ('6207', '62', 'Kab. Lamandau');
INSERT INTO `wilayah_kabupaten` VALUES ('6208', '62', 'Kab. Seruyan');
INSERT INTO `wilayah_kabupaten` VALUES ('6209', '62', 'Kab. Katingan');
INSERT INTO `wilayah_kabupaten` VALUES ('6210', '62', 'Kab. Pulang Pisau');
INSERT INTO `wilayah_kabupaten` VALUES ('6211', '62', 'Kab. Gunung Mas');
INSERT INTO `wilayah_kabupaten` VALUES ('6212', '62', 'Kab. Barito Timur');
INSERT INTO `wilayah_kabupaten` VALUES ('6213', '62', 'Kab. Murung Raya');
INSERT INTO `wilayah_kabupaten` VALUES ('6271', '62', 'Kota Palangka Raya');
INSERT INTO `wilayah_kabupaten` VALUES ('6301', '63', 'Kab. Tanah Laut');
INSERT INTO `wilayah_kabupaten` VALUES ('6302', '63', 'Kab. Kota Baru');
INSERT INTO `wilayah_kabupaten` VALUES ('6303', '63', 'Kab. Banjar');
INSERT INTO `wilayah_kabupaten` VALUES ('6304', '63', 'Kab. Barito Kuala');
INSERT INTO `wilayah_kabupaten` VALUES ('6305', '63', 'Kab. Tapin');
INSERT INTO `wilayah_kabupaten` VALUES ('6306', '63', 'Kab. Hulu Sungai Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('6307', '63', 'Kab. Hulu Sungai Tengah');
INSERT INTO `wilayah_kabupaten` VALUES ('6308', '63', 'Kab. Hulu Sungai Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('6309', '63', 'Kab. Tabalong');
INSERT INTO `wilayah_kabupaten` VALUES ('6310', '63', 'Kab. Tanah Bumbu');
INSERT INTO `wilayah_kabupaten` VALUES ('6311', '63', 'Kab. Balangan');
INSERT INTO `wilayah_kabupaten` VALUES ('6371', '63', 'Kota Banjarmasin');
INSERT INTO `wilayah_kabupaten` VALUES ('6372', '63', 'Kota Banjar Baru');
INSERT INTO `wilayah_kabupaten` VALUES ('6401', '64', 'Kab. Paser');
INSERT INTO `wilayah_kabupaten` VALUES ('6402', '64', 'Kab. Kutai Barat');
INSERT INTO `wilayah_kabupaten` VALUES ('6403', '64', 'Kab. Kutai Kartanegara');
INSERT INTO `wilayah_kabupaten` VALUES ('6404', '64', 'Kab. Kutai Timur');
INSERT INTO `wilayah_kabupaten` VALUES ('6405', '64', 'Kab. Berau');
INSERT INTO `wilayah_kabupaten` VALUES ('6409', '64', 'Kab. Penajam Paser Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('6471', '64', 'Kota Balikpapan');
INSERT INTO `wilayah_kabupaten` VALUES ('6472', '64', 'Kota Samarinda');
INSERT INTO `wilayah_kabupaten` VALUES ('6474', '64', 'Kota Bontang');
INSERT INTO `wilayah_kabupaten` VALUES ('6501', '65', 'Kab. Malinau');
INSERT INTO `wilayah_kabupaten` VALUES ('6502', '65', 'Kab. Bulungan');
INSERT INTO `wilayah_kabupaten` VALUES ('6503', '65', 'Kab. Tana Tidung');
INSERT INTO `wilayah_kabupaten` VALUES ('6504', '65', 'Kab. Nunukan');
INSERT INTO `wilayah_kabupaten` VALUES ('6571', '65', 'Kota Tarakan');
INSERT INTO `wilayah_kabupaten` VALUES ('7101', '71', 'Kab. Bolaang Mongondow');
INSERT INTO `wilayah_kabupaten` VALUES ('7102', '71', 'Kab. Minahasa');
INSERT INTO `wilayah_kabupaten` VALUES ('7103', '71', 'Kab. Kepulauan Sangihe');
INSERT INTO `wilayah_kabupaten` VALUES ('7104', '71', 'Kab. Kepulauan Talaud');
INSERT INTO `wilayah_kabupaten` VALUES ('7105', '71', 'Kab. Minahasa Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('7106', '71', 'Kab. Minahasa Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('7107', '71', 'Kab. Bolaang Mongondow Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('7108', '71', 'Kab. Siau Tagulandang Biaro');
INSERT INTO `wilayah_kabupaten` VALUES ('7109', '71', 'Kab. Minahasa Tenggara');
INSERT INTO `wilayah_kabupaten` VALUES ('7110', '71', 'Kab. Bolaang Mongondow Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('7111', '71', 'Kab. Bolaang Mongondow Timur');
INSERT INTO `wilayah_kabupaten` VALUES ('7171', '71', 'Kota Manado');
INSERT INTO `wilayah_kabupaten` VALUES ('7172', '71', 'Kota Bitung');
INSERT INTO `wilayah_kabupaten` VALUES ('7173', '71', 'Kota Tomohon');
INSERT INTO `wilayah_kabupaten` VALUES ('7174', '71', 'Kota Kotamobagu');
INSERT INTO `wilayah_kabupaten` VALUES ('7201', '72', 'Kab. Banggai Kepulauan');
INSERT INTO `wilayah_kabupaten` VALUES ('7202', '72', 'Kab. Banggai');
INSERT INTO `wilayah_kabupaten` VALUES ('7203', '72', 'Kab. Morowali');
INSERT INTO `wilayah_kabupaten` VALUES ('7204', '72', 'Kab. Poso');
INSERT INTO `wilayah_kabupaten` VALUES ('7205', '72', 'Kab. Donggala');
INSERT INTO `wilayah_kabupaten` VALUES ('7206', '72', 'Kab. Toli-toli');
INSERT INTO `wilayah_kabupaten` VALUES ('7207', '72', 'Kab. Buol');
INSERT INTO `wilayah_kabupaten` VALUES ('7208', '72', 'Kab. Parigi Moutong');
INSERT INTO `wilayah_kabupaten` VALUES ('7209', '72', 'Kab. Tojo Una-una');
INSERT INTO `wilayah_kabupaten` VALUES ('7210', '72', 'Kab. Sigi');
INSERT INTO `wilayah_kabupaten` VALUES ('7271', '72', 'Kota Palu');
INSERT INTO `wilayah_kabupaten` VALUES ('7301', '73', 'Kab. Kepulauan Selayar');
INSERT INTO `wilayah_kabupaten` VALUES ('7302', '73', 'Kab. Bulukumba');
INSERT INTO `wilayah_kabupaten` VALUES ('7303', '73', 'Kab. Bantaeng');
INSERT INTO `wilayah_kabupaten` VALUES ('7304', '73', 'Kab. Jeneponto');
INSERT INTO `wilayah_kabupaten` VALUES ('7305', '73', 'Kab. Takalar');
INSERT INTO `wilayah_kabupaten` VALUES ('7306', '73', 'Kab. Gowa');
INSERT INTO `wilayah_kabupaten` VALUES ('7307', '73', 'Kab. Sinjai');
INSERT INTO `wilayah_kabupaten` VALUES ('7308', '73', 'Kab. Maros');
INSERT INTO `wilayah_kabupaten` VALUES ('7309', '73', 'Kab. Pangkajene Dan Kepulauan');
INSERT INTO `wilayah_kabupaten` VALUES ('7310', '73', 'Kab. Barru');
INSERT INTO `wilayah_kabupaten` VALUES ('7311', '73', 'Kab. Bone');
INSERT INTO `wilayah_kabupaten` VALUES ('7312', '73', 'Kab. Soppeng');
INSERT INTO `wilayah_kabupaten` VALUES ('7313', '73', 'Kab. Wajo');
INSERT INTO `wilayah_kabupaten` VALUES ('7314', '73', 'Kab. Sidenreng Rappang');
INSERT INTO `wilayah_kabupaten` VALUES ('7315', '73', 'Kab. Pinrang');
INSERT INTO `wilayah_kabupaten` VALUES ('7316', '73', 'Kab. Enrekang');
INSERT INTO `wilayah_kabupaten` VALUES ('7317', '73', 'Kab. Luwu');
INSERT INTO `wilayah_kabupaten` VALUES ('7318', '73', 'Kab. Tana Toraja');
INSERT INTO `wilayah_kabupaten` VALUES ('7322', '73', 'Kab. Luwu Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('7325', '73', 'Kab. Luwu Timur');
INSERT INTO `wilayah_kabupaten` VALUES ('7326', '73', 'Kab. Toraja Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('7371', '73', 'Kota Makassar');
INSERT INTO `wilayah_kabupaten` VALUES ('7372', '73', 'Kota Parepare');
INSERT INTO `wilayah_kabupaten` VALUES ('7373', '73', 'Kota Palopo');
INSERT INTO `wilayah_kabupaten` VALUES ('7401', '74', 'Kab. Buton');
INSERT INTO `wilayah_kabupaten` VALUES ('7402', '74', 'Kab. Muna');
INSERT INTO `wilayah_kabupaten` VALUES ('7403', '74', 'Kab. Konawe');
INSERT INTO `wilayah_kabupaten` VALUES ('7404', '74', 'Kab. Kolaka');
INSERT INTO `wilayah_kabupaten` VALUES ('7405', '74', 'Kab. Konawe Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('7406', '74', 'Kab. Bombana');
INSERT INTO `wilayah_kabupaten` VALUES ('7407', '74', 'Kab. Wakatobi');
INSERT INTO `wilayah_kabupaten` VALUES ('7408', '74', 'Kab. Kolaka Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('7409', '74', 'Kab. Buton Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('7410', '74', 'Kab. Konawe Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('7471', '74', 'Kota Kendari');
INSERT INTO `wilayah_kabupaten` VALUES ('7472', '74', 'Kota Baubau');
INSERT INTO `wilayah_kabupaten` VALUES ('7501', '75', 'Kab. Boalemo');
INSERT INTO `wilayah_kabupaten` VALUES ('7502', '75', 'Kab. Gorontalo');
INSERT INTO `wilayah_kabupaten` VALUES ('7503', '75', 'Kab. Pohuwato');
INSERT INTO `wilayah_kabupaten` VALUES ('7504', '75', 'Kab. Bone Bolango');
INSERT INTO `wilayah_kabupaten` VALUES ('7505', '75', 'Kab. Gorontalo Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('7571', '75', 'Kota Gorontalo');
INSERT INTO `wilayah_kabupaten` VALUES ('7601', '76', 'Kab. Majene');
INSERT INTO `wilayah_kabupaten` VALUES ('7602', '76', 'Kab. Polewali Mandar');
INSERT INTO `wilayah_kabupaten` VALUES ('7603', '76', 'Kab. Mamasa');
INSERT INTO `wilayah_kabupaten` VALUES ('7604', '76', 'Kab. Mamuju');
INSERT INTO `wilayah_kabupaten` VALUES ('7605', '76', 'Kab. Mamuju Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('8101', '81', 'Kab. Maluku Tenggara Barat');
INSERT INTO `wilayah_kabupaten` VALUES ('8102', '81', 'Kab. Maluku Tenggara');
INSERT INTO `wilayah_kabupaten` VALUES ('8103', '81', 'Kab. Maluku Tengah');
INSERT INTO `wilayah_kabupaten` VALUES ('8104', '81', 'Kab. Buru');
INSERT INTO `wilayah_kabupaten` VALUES ('8105', '81', 'Kab. Kepulauan Aru');
INSERT INTO `wilayah_kabupaten` VALUES ('8106', '81', 'Kab. Seram Bagian Barat');
INSERT INTO `wilayah_kabupaten` VALUES ('8107', '81', 'Kab. Seram Bagian Timur');
INSERT INTO `wilayah_kabupaten` VALUES ('8108', '81', 'Kab. Maluku Barat Daya');
INSERT INTO `wilayah_kabupaten` VALUES ('8109', '81', 'Kab. Buru Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('8171', '81', 'Kota Ambon');
INSERT INTO `wilayah_kabupaten` VALUES ('8172', '81', 'Kota Tual');
INSERT INTO `wilayah_kabupaten` VALUES ('8201', '82', 'Kab. Halmahera Barat');
INSERT INTO `wilayah_kabupaten` VALUES ('8202', '82', 'Kab. Halmahera Tengah');
INSERT INTO `wilayah_kabupaten` VALUES ('8203', '82', 'Kab. Kepulauan Sula');
INSERT INTO `wilayah_kabupaten` VALUES ('8204', '82', 'Kab. Halmahera Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('8205', '82', 'Kab. Halmahera Utara');
INSERT INTO `wilayah_kabupaten` VALUES ('8206', '82', 'Kab. Halmahera Timur');
INSERT INTO `wilayah_kabupaten` VALUES ('8207', '82', 'Kab. Pulau Morotai');
INSERT INTO `wilayah_kabupaten` VALUES ('8271', '82', 'Kota Ternate');
INSERT INTO `wilayah_kabupaten` VALUES ('8272', '82', 'Kota Tidore Kepulauan');
INSERT INTO `wilayah_kabupaten` VALUES ('9101', '91', 'Kab. Fakfak');
INSERT INTO `wilayah_kabupaten` VALUES ('9102', '91', 'Kab. Kaimana');
INSERT INTO `wilayah_kabupaten` VALUES ('9103', '91', 'Kab. Teluk Wondama');
INSERT INTO `wilayah_kabupaten` VALUES ('9104', '91', 'Kab. Teluk Bintuni');
INSERT INTO `wilayah_kabupaten` VALUES ('9105', '91', 'Kab. Manokwari');
INSERT INTO `wilayah_kabupaten` VALUES ('9106', '91', 'Kab. Sorong Selatan');
INSERT INTO `wilayah_kabupaten` VALUES ('9107', '91', 'Kab. Sorong');
INSERT INTO `wilayah_kabupaten` VALUES ('9108', '91', 'Kab. Raja Ampat');
INSERT INTO `wilayah_kabupaten` VALUES ('9109', '91', 'Kab. Tambrauw');
INSERT INTO `wilayah_kabupaten` VALUES ('9110', '91', 'Kab. Maybrat');
INSERT INTO `wilayah_kabupaten` VALUES ('9171', '91', 'Kota Sorong');
INSERT INTO `wilayah_kabupaten` VALUES ('9401', '94', 'Kab. Merauke');
INSERT INTO `wilayah_kabupaten` VALUES ('9402', '94', 'Kab. Jayawijaya');
INSERT INTO `wilayah_kabupaten` VALUES ('9403', '94', 'Kab. Jayapura');
INSERT INTO `wilayah_kabupaten` VALUES ('9404', '94', 'Kab. Nabire');
INSERT INTO `wilayah_kabupaten` VALUES ('9408', '94', 'Kab. Kepulauan Yapen');
INSERT INTO `wilayah_kabupaten` VALUES ('9409', '94', 'Kab. Biak Numfor');
INSERT INTO `wilayah_kabupaten` VALUES ('9410', '94', 'Kab. Paniai');
INSERT INTO `wilayah_kabupaten` VALUES ('9411', '94', 'Kab. Puncak Jaya');
INSERT INTO `wilayah_kabupaten` VALUES ('9412', '94', 'Kab. Mimika');
INSERT INTO `wilayah_kabupaten` VALUES ('9413', '94', 'Kab. Boven Digoel');
INSERT INTO `wilayah_kabupaten` VALUES ('9414', '94', 'Kab. Mappi');
INSERT INTO `wilayah_kabupaten` VALUES ('9415', '94', 'Kab. Asmat');
INSERT INTO `wilayah_kabupaten` VALUES ('9416', '94', 'Kab. Yahukimo');
INSERT INTO `wilayah_kabupaten` VALUES ('9417', '94', 'Kab. Pegunungan Bintang');
INSERT INTO `wilayah_kabupaten` VALUES ('9418', '94', 'Kab. Tolikara');
INSERT INTO `wilayah_kabupaten` VALUES ('9419', '94', 'Kab. Sarmi');
INSERT INTO `wilayah_kabupaten` VALUES ('9420', '94', 'Kab. Keerom');
INSERT INTO `wilayah_kabupaten` VALUES ('9426', '94', 'Kab. Waropen');
INSERT INTO `wilayah_kabupaten` VALUES ('9427', '94', 'Kab. Supiori');
INSERT INTO `wilayah_kabupaten` VALUES ('9428', '94', 'Kab. Mamberamo Raya');
INSERT INTO `wilayah_kabupaten` VALUES ('9429', '94', 'Kab. Nduga');
INSERT INTO `wilayah_kabupaten` VALUES ('9430', '94', 'Kab. Lanny Jaya');
INSERT INTO `wilayah_kabupaten` VALUES ('9431', '94', 'Kab. Mamberamo Tengah');
INSERT INTO `wilayah_kabupaten` VALUES ('9432', '94', 'Kab. Yalimo');
INSERT INTO `wilayah_kabupaten` VALUES ('9433', '94', 'Kab. Puncak');
INSERT INTO `wilayah_kabupaten` VALUES ('9434', '94', 'Kab. Dogiyai');
INSERT INTO `wilayah_kabupaten` VALUES ('9435', '94', 'Kab. Intan Jaya');
INSERT INTO `wilayah_kabupaten` VALUES ('9436', '94', 'Kab. Deiyai');
INSERT INTO `wilayah_kabupaten` VALUES ('9471', '94', 'Kota Jayapura');

-- ----------------------------
-- Table structure for wilayah_provinsi
-- ----------------------------
DROP TABLE IF EXISTS `wilayah_provinsi`;
CREATE TABLE `wilayah_provinsi`  (
  `id` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of wilayah_provinsi
-- ----------------------------
INSERT INTO `wilayah_provinsi` VALUES ('11', 'Aceh');
INSERT INTO `wilayah_provinsi` VALUES ('12', 'Sumatera Utara');
INSERT INTO `wilayah_provinsi` VALUES ('13', 'Sumatera Barat');
INSERT INTO `wilayah_provinsi` VALUES ('14', 'Riau');
INSERT INTO `wilayah_provinsi` VALUES ('15', 'Jambi');
INSERT INTO `wilayah_provinsi` VALUES ('16', 'Sumatera Selatan');
INSERT INTO `wilayah_provinsi` VALUES ('17', 'Bengkulu');
INSERT INTO `wilayah_provinsi` VALUES ('18', 'Lampung');
INSERT INTO `wilayah_provinsi` VALUES ('19', 'Kepulauan Bangka Belitung');
INSERT INTO `wilayah_provinsi` VALUES ('21', 'Kepulauan Riau');
INSERT INTO `wilayah_provinsi` VALUES ('31', 'Dki Jakarta');
INSERT INTO `wilayah_provinsi` VALUES ('32', 'Jawa Barat');
INSERT INTO `wilayah_provinsi` VALUES ('33', 'Jawa Tengah');
INSERT INTO `wilayah_provinsi` VALUES ('34', 'Di Yogyakarta');
INSERT INTO `wilayah_provinsi` VALUES ('35', 'Jawa Timur');
INSERT INTO `wilayah_provinsi` VALUES ('36', 'Banten');
INSERT INTO `wilayah_provinsi` VALUES ('51', 'Bali');
INSERT INTO `wilayah_provinsi` VALUES ('52', 'Nusa Tenggara Barat');
INSERT INTO `wilayah_provinsi` VALUES ('53', 'Nusa Tenggara Timur');
INSERT INTO `wilayah_provinsi` VALUES ('61', 'Kalimantan Barat');
INSERT INTO `wilayah_provinsi` VALUES ('62', 'Kalimantan Tengah');
INSERT INTO `wilayah_provinsi` VALUES ('63', 'Kalimantan Selatan');
INSERT INTO `wilayah_provinsi` VALUES ('64', 'Kalimantan Timur');
INSERT INTO `wilayah_provinsi` VALUES ('65', 'Kalimantan Utara');
INSERT INTO `wilayah_provinsi` VALUES ('71', 'Sulawesi Utara');
INSERT INTO `wilayah_provinsi` VALUES ('72', 'Sulawesi Tengah');
INSERT INTO `wilayah_provinsi` VALUES ('73', 'Sulawesi Selatan');
INSERT INTO `wilayah_provinsi` VALUES ('74', 'Sulawesi Tenggara');
INSERT INTO `wilayah_provinsi` VALUES ('75', 'Gorontalo');
INSERT INTO `wilayah_provinsi` VALUES ('76', 'Sulawesi Barat');
INSERT INTO `wilayah_provinsi` VALUES ('81', 'Maluku');
INSERT INTO `wilayah_provinsi` VALUES ('82', 'Maluku Utara');
INSERT INTO `wilayah_provinsi` VALUES ('91', 'Papua Barat');
INSERT INTO `wilayah_provinsi` VALUES ('94', 'Papua');

SET FOREIGN_KEY_CHECKS = 1;
