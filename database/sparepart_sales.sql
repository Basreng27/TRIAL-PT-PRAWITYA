/*
 Navicat Premium Data Transfer

 Source Server         : MARIADB
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : sparepart_sales

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 08/09/2024 11:27:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for master_barang
-- ----------------------------
DROP TABLE IF EXISTS `master_barang`;
CREATE TABLE `master_barang`  (
  `kode_barang` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `nama_barang` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `harga_jual` decimal(10, 2) NOT NULL,
  `harga_beli` decimal(10, 2) NOT NULL,
  `satuan` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `kategori` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`kode_barang`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_barang
-- ----------------------------
INSERT INTO `master_barang` VALUES ('BRG001', 'Oli Mesin', 50000.00, 45000.00, 'Botol', 'Pelumas');
INSERT INTO `master_barang` VALUES ('BRG002', 'Filter Udara', 75000.00, 70000.00, 'Pcs', 'Suku Cadang');
INSERT INTO `master_barang` VALUES ('BRG003', 'Busi', 30000.00, 25000.00, 'Pcs', 'Suku Cadang');

-- ----------------------------
-- Table structure for penjualan
-- ----------------------------
DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan`  (
  `id_penjualan` int NOT NULL AUTO_INCREMENT,
  `tgl_faktur` date NOT NULL,
  `no_faktur` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `nama_konsumen` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `kode_barang` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `jumlah` int NOT NULL,
  `harga_satuan` decimal(10, 2) NOT NULL,
  `harga_total` decimal(10, 2) NOT NULL,
  PRIMARY KEY (`id_penjualan`) USING BTREE,
  INDEX `kode_barang`(`kode_barang` ASC) USING BTREE,
  CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `master_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penjualan
-- ----------------------------
INSERT INTO `penjualan` VALUES (2, '2024-09-08', '001', 'Ray', 'BRG003', 4, 30000.00, 120000.00);

SET FOREIGN_KEY_CHECKS = 1;
