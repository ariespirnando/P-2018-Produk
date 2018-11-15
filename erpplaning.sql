-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24-0ubuntu0.18.04.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for erp_produk
CREATE DATABASE IF NOT EXISTS `erp_produk` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `erp_produk`;

-- Dumping structure for table erp_produk.master_buyer
CREATE TABLE IF NOT EXISTS `master_buyer` (
  `imaster_buyer` int(11) NOT NULL AUTO_INCREMENT,
  `nama_buyer` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`imaster_buyer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table erp_produk.master_buyer: ~0 rows (approximately)
/*!40000 ALTER TABLE `master_buyer` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_buyer` ENABLE KEYS */;

-- Dumping structure for table erp_produk.master_jenis
CREATE TABLE IF NOT EXISTS `master_jenis` (
  `imaster_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `itipe` int(11) NOT NULL DEFAULT '0' COMMENT '0 = gudang, 1= sortir, 2 = jual',
  `nama_jenis` varchar(50) DEFAULT NULL,
  `harga_beli` float DEFAULT '0',
  `harga_jual` float DEFAULT '0',
  `harga_sortir` float DEFAULT '0',
  `harga_giling` float DEFAULT '0',
  PRIMARY KEY (`imaster_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table erp_produk.master_jenis: ~5 rows (approximately)
/*!40000 ALTER TABLE `master_jenis` DISABLE KEYS */;
INSERT INTO `master_jenis` (`imaster_jenis`, `itipe`, `nama_jenis`, `harga_beli`, `harga_jual`, `harga_sortir`, `harga_giling`) VALUES
	(1, 0, 'ALE-ALE', 4500, 0, 0, 0),
	(2, 0, 'PPS', 5300, 0, 0, 0),
	(3, 0, 'KALENG', 2100, 0, 0, 0),
	(4, 0, 'KABEL', 3900, 0, 0, 0),
	(5, 0, 'BOTOL', 5400, 0, 0, 0);
/*!40000 ALTER TABLE `master_jenis` ENABLE KEYS */;

-- Dumping structure for table erp_produk.master_suplier
CREATE TABLE IF NOT EXISTS `master_suplier` (
  `imaster_suplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama_suplier` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`imaster_suplier`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table erp_produk.master_suplier: ~3 rows (approximately)
/*!40000 ALTER TABLE `master_suplier` DISABLE KEYS */;
INSERT INTO `master_suplier` (`imaster_suplier`, `nama_suplier`) VALUES
	(5, 'IWAN BOPENG'),
	(6, 'CECENG SUJANA'),
	(7, 'SANDIAGA UNO'),
	(9, 'AINI RAHMAYANTI');
/*!40000 ALTER TABLE `master_suplier` ENABLE KEYS */;

-- Dumping structure for table erp_produk.pembelian
CREATE TABLE IF NOT EXISTS `pembelian` (
  `ipembelian` int(11) NOT NULL AUTO_INCREMENT,
  `cNomor_pembelian` varchar(50) DEFAULT NULL,
  `tanggal_pembelian` datetime DEFAULT NULL,
  `pic_pembelian` varchar(50) DEFAULT NULL,
  `total_all` float DEFAULT NULL,
  `imaster_suplier` int(11) DEFAULT NULL,
  `istatus_hapus` int(11) DEFAULT '0',
  `keterangan_hapus` text,
  `pic_hapus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ipembelian`),
  KEY `pic_pembelian` (`pic_pembelian`),
  KEY `imaster_suplier` (`imaster_suplier`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table erp_produk.pembelian: ~8 rows (approximately)
/*!40000 ALTER TABLE `pembelian` DISABLE KEYS */;
INSERT INTO `pembelian` (`ipembelian`, `cNomor_pembelian`, `tanggal_pembelian`, `pic_pembelian`, `total_all`, `imaster_suplier`, `istatus_hapus`, `keterangan_hapus`, `pic_hapus`) VALUES
	(1, 'PMB00001', '2018-11-14 10:05:07', 'KRY00017', 600000, 5, 1, 'sad', 'KRY00017'),
	(2, 'PMB00002', '2018-11-14 10:09:07', 'KRY00017', 6576000, 5, 1, '', 'KRY00017'),
	(3, 'PMB00003', '2018-11-14 10:43:32', 'KRY00017', 530000, 9, 1, '', 'KRY00017'),
	(4, 'PMB00004', '2018-11-14 11:00:05', 'KRY00017', 42000, 9, 1, 'sadad', 'KRY00017'),
	(5, 'PMB00005', '2018-11-14 11:00:33', 'KRY00017', 26500000, 7, 1, 'hapus', 'KRY00017'),
	(6, 'PMB00006', '2018-11-14 11:00:45', 'KRY00017', 106000, 7, 1, '', 'KRY00017'),
	(7, 'PMB00007', '2018-11-14 11:04:17', 'KRY00017', 264000, 5, 1, '', 'KRY00017'),
	(8, 'PMB00008', '2018-11-14 16:30:35', 'KRY00017', 5300000, 5, 1, '', 'KRY00017'),
	(9, 'PMB00009', '2018-11-15 16:15:04', 'KRY00017', 2333100, 5, 1, 'hapus', 'KRY00017');
/*!40000 ALTER TABLE `pembelian` ENABLE KEYS */;

-- Dumping structure for table erp_produk.pembelian_detail
CREATE TABLE IF NOT EXISTS `pembelian_detail` (
  `ipembelian_detail` int(11) NOT NULL AUTO_INCREMENT,
  `ipembelian` int(11) NOT NULL,
  `imaster_jenis` int(11) NOT NULL,
  `total_harga` float NOT NULL DEFAULT '0',
  `harga_beli` float NOT NULL DEFAULT '0',
  `total_kg` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`ipembelian_detail`),
  KEY `ipembelian` (`ipembelian`),
  KEY `imaster_jenis` (`imaster_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table erp_produk.pembelian_detail: ~11 rows (approximately)
/*!40000 ALTER TABLE `pembelian_detail` DISABLE KEYS */;
INSERT INTO `pembelian_detail` (`ipembelian_detail`, `ipembelian`, `imaster_jenis`, `total_harga`, `harga_beli`, `total_kg`) VALUES
	(1, 1, 1, 420000, 4500, 200),
	(2, 1, 1, 180000, 4500, 40),
	(3, 2, 1, 4050000, 4500, 900),
	(4, 2, 2, 636000, 5300, 120),
	(5, 2, 3, 1890000, 2100, 900),
	(6, 3, 2, 530000, 5300, 100),
	(7, 4, 3, 42000, 2100, 20),
	(8, 5, 2, 26500000, 5300, 5000),
	(9, 6, 2, 106000, 5300, 20),
	(10, 7, 2, 159000, 5300, 30),
	(11, 7, 3, 105000, 2100, 50),
	(12, 8, 2, 5300000, 5300, 1000),
	(13, 9, 3, 2333100, 2100, 1111);
/*!40000 ALTER TABLE `pembelian_detail` ENABLE KEYS */;

-- Dumping structure for table erp_produk.sortir
CREATE TABLE IF NOT EXISTS `sortir` (
  `isortir` int(11) NOT NULL AUTO_INCREMENT,
  `cNomor_sortir` varchar(50) DEFAULT NULL,
  `tanggal_sortir` datetime DEFAULT NULL,
  `capp_employee` varchar(50) DEFAULT NULL COMMENT 'Join ERPLANING APP_EMPLOYEE',
  `total_all` float DEFAULT NULL,
  `imaster_suplier` int(11) DEFAULT NULL,
  `istatus_hapus` int(11) DEFAULT '0',
  `keterangan_hapus` text,
  `pic_hapus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`isortir`),
  KEY `pic_pembelian` (`capp_employee`),
  KEY `imaster_suplier` (`imaster_suplier`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table erp_produk.sortir: ~9 rows (approximately)
/*!40000 ALTER TABLE `sortir` DISABLE KEYS */;
INSERT INTO `sortir` (`isortir`, `cNomor_sortir`, `tanggal_sortir`, `capp_employee`, `total_all`, `imaster_suplier`, `istatus_hapus`, `keterangan_hapus`, `pic_hapus`) VALUES
	(1, 'PMB00001', '2018-11-14 10:05:07', 'KRY00017', 600000, 5, 1, 'sad', 'KRY00017'),
	(2, 'PMB00002', '2018-11-14 10:09:07', 'KRY00017', 6576000, 5, 1, '', 'KRY00017'),
	(3, 'PMB00003', '2018-11-14 10:43:32', 'KRY00017', 530000, 9, 1, '', 'KRY00017'),
	(4, 'PMB00004', '2018-11-14 11:00:05', 'KRY00017', 42000, 9, 1, 'sadad', 'KRY00017'),
	(5, 'PMB00005', '2018-11-14 11:00:33', 'KRY00017', 26500000, 7, 1, 'hapus', 'KRY00017'),
	(6, 'PMB00006', '2018-11-14 11:00:45', 'KRY00017', 106000, 7, 1, '', 'KRY00017'),
	(7, 'PMB00007', '2018-11-14 11:04:17', 'KRY00017', 264000, 5, 1, '', 'KRY00017'),
	(8, 'PMB00008', '2018-11-14 16:30:35', 'KRY00017', 5300000, 5, 1, '', 'KRY00017'),
	(9, 'PMB00009', '2018-11-15 16:15:04', 'KRY00017', 2333100, 5, 1, 'hapus', 'KRY00017');
/*!40000 ALTER TABLE `sortir` ENABLE KEYS */;

-- Dumping structure for table erp_produk.sortir_detail
CREATE TABLE IF NOT EXISTS `sortir_detail` (
  `isortir_detail` int(11) NOT NULL AUTO_INCREMENT,
  `isortir` int(11) NOT NULL,
  `imaster_jenis` int(11) NOT NULL,
  `total_kg` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`isortir_detail`),
  KEY `ipembelian` (`isortir`),
  KEY `imaster_jenis` (`imaster_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table erp_produk.sortir_detail: ~13 rows (approximately)
/*!40000 ALTER TABLE `sortir_detail` DISABLE KEYS */;
INSERT INTO `sortir_detail` (`isortir_detail`, `isortir`, `imaster_jenis`, `total_kg`) VALUES
	(1, 1, 1, 200),
	(2, 1, 1, 40),
	(3, 2, 1, 900),
	(4, 2, 2, 120),
	(5, 2, 3, 900),
	(6, 3, 2, 100),
	(7, 4, 3, 20),
	(8, 5, 2, 5000),
	(9, 6, 2, 20),
	(10, 7, 2, 30),
	(11, 7, 3, 50),
	(12, 8, 2, 1000),
	(13, 9, 3, 1111);
/*!40000 ALTER TABLE `sortir_detail` ENABLE KEYS */;


-- Dumping database structure for erplaning
CREATE DATABASE IF NOT EXISTS `erplaning` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `erplaning`;

-- Dumping structure for table erplaning.app_employee
CREATE TABLE IF NOT EXISTS `app_employee` (
  `iapp_employee` int(11) NOT NULL AUTO_INCREMENT,
  `capp_employee` varchar(50) DEFAULT NULL,
  `cnama` varchar(50) DEFAULT NULL,
  `tipe` int(11) DEFAULT NULL COMMENT 'tetap/lepas',
  `din` date DEFAULT NULL,
  `dout` date DEFAULT NULL,
  `vpassword` varchar(50) DEFAULT NULL,
  `vusername` varchar(50) DEFAULT NULL,
  `iactivied` int(11) DEFAULT NULL COMMENT '1/ tidak aktif',
  PRIMARY KEY (`iapp_employee`),
  KEY `capp_employee` (`capp_employee`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table erplaning.app_employee: ~18 rows (approximately)
/*!40000 ALTER TABLE `app_employee` DISABLE KEYS */;
INSERT INTO `app_employee` (`iapp_employee`, `capp_employee`, `cnama`, `tipe`, `din`, `dout`, `vpassword`, `vusername`, `iactivied`) VALUES
	(1, 'KRY00001', 'ACHMAD ARIES PIRNANDO', 1, '2018-11-06', NULL, 'fd92a088a6de70c5eecfa6ee4963a224', 'aries', NULL),
	(2, 'KRY00002', 'AINI RAHMAYATI', 1, '2018-11-06', NULL, 'cd5caf97b65059382633fd9f67eb9beb', 'KRY00002', NULL),
	(3, 'KRY00003', 'NOVYAN SAPUTRA', 0, '2018-11-06', NULL, 'bb406248f82da27f59b7e31643a0a6ce', 'KRY00003', NULL),
	(4, 'KRY00004', 'MAHATIR MOHAMAD', 0, '2018-11-06', '2018-11-30', '270b55174b27f84312fc69257b9bc150', 'KRY00004', 1),
	(5, 'KRY00005', 'GALIH PERMADI', 0, '2018-11-06', NULL, '51517ae0ffa24028f74003d43aa675cb', 'KRY00005', NULL),
	(6, 'KRY00006', 'IHSAN MAULANA', 0, '2018-11-06', NULL, '6bb41656d489a5294e882dcc654cd2d6', 'KRY00006', NULL),
	(7, 'KRY00007', 'POPPY CALVINA NURLISARI', 0, '2018-11-06', NULL, '2e9e0b168005796b73e017009b1bba37', 'KRY00007', NULL),
	(8, 'KRY00008', 'EKA YUNI SRIYANTI', 0, '2018-11-06', NULL, '10ec7a4fbaa47cb70732703b806141c9', 'KRY00008', NULL),
	(9, 'KRY00009', 'GABRIELA SUDIRMAN', 0, '2018-11-06', NULL, 'de55ce088c4a274b2f847a0dd96615b7', 'KRY00009', NULL),
	(10, 'KRY00010', 'AHMAD SUTEJA', 0, '2018-11-06', NULL, '5278edf2d3497d3cfc92a599a0173dda', 'KRY00010', NULL),
	(11, 'KRY00011', 'NISA KHOIRUNISA', 0, '2018-11-06', NULL, 'd3937afc10805c9bdeef77d607d29359', 'KRY00011', NULL),
	(12, 'KRY00012', 'SUPRIYADI', 0, '2018-11-06', NULL, '1e26c6b453668d6c49174441d67e3980', 'KRY00012', NULL),
	(13, 'KRY00013', 'PANCA HADI SAPUTRA', 0, '2018-11-06', NULL, 'd91f4febf07f8c0d20278544778f0c05', 'KRY00013', NULL),
	(14, 'KRY00014', 'NUR SARTI', 0, '2018-11-06', NULL, '993d0039edfb153a93b56f9d9593804a', 'KRY00014', NULL),
	(15, 'KRY00015', 'HELENA MARLIANA', 0, '2018-11-06', NULL, 'ff6835f8573e594cb46d205ae8b8b13b', 'KRY00015', NULL),
	(16, 'KRY00016', 'ROY LEMBONG', 0, '2018-11-07', NULL, '7945145db69548bccc9a2743a103995f', 'KRY00016', NULL),
	(17, 'KRY00017', 'TANTO HARSONO', 1, '2018-11-09', NULL, '81dc9bdb52d04dc20036dbd8313ed055', 'tanto', NULL),
	(18, 'KRY00018', 'BAYU MEGANTORO', 1, '2018-11-09', NULL, 'f0d75e11c3d6e7f86a80a6e519617a95', 'KRY00018', NULL);
/*!40000 ALTER TABLE `app_employee` ENABLE KEYS */;

-- Dumping structure for table erplaning.app_erpgroup
CREATE TABLE IF NOT EXISTS `app_erpgroup` (
  `iiapp_erpgroup` int(11) NOT NULL AUTO_INCREMENT,
  `iapp_erpmodule` int(11) NOT NULL DEFAULT '0',
  `vgroup` text,
  `dcreate` date DEFAULT NULL,
  PRIMARY KEY (`iiapp_erpgroup`),
  KEY `iapp_erpmodule` (`iapp_erpmodule`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table erplaning.app_erpgroup: ~9 rows (approximately)
/*!40000 ALTER TABLE `app_erpgroup` DISABLE KEYS */;
INSERT INTO `app_erpgroup` (`iiapp_erpgroup`, `iapp_erpmodule`, `vgroup`, `dcreate`) VALUES
	(17, 5, 'Super Admin', NULL),
	(20, 2, 'Admin', '2018-11-07'),
	(21, 2, 'Super Admin', '2018-11-07'),
	(22, 1, 'Super User', '2018-11-07'),
	(24, 5, 'Admin', '2018-11-09'),
	(25, 2, NULL, '2018-11-09'),
	(26, 5, NULL, '2018-11-09'),
	(27, 6, 'Admin', '2018-11-10'),
	(28, 7, 'SuperAdmin', '2018-11-10');
/*!40000 ALTER TABLE `app_erpgroup` ENABLE KEYS */;

-- Dumping structure for table erplaning.app_erpgroup_config
CREATE TABLE IF NOT EXISTS `app_erpgroup_config` (
  `iapp_erpgroup_config` int(11) NOT NULL AUTO_INCREMENT,
  `iiapp_erpgroup` int(11) NOT NULL,
  `iapp_erpmodule` int(11) NOT NULL,
  `iapp_erpmoduldetail` int(11) DEFAULT NULL,
  `iview` int(11) DEFAULT '0',
  `iedit` int(11) DEFAULT '0',
  `idelete` int(11) DEFAULT '0',
  `iadd` int(11) DEFAULT '0',
  `dcreate` date DEFAULT NULL,
  PRIMARY KEY (`iapp_erpgroup_config`),
  KEY `iapp_erpmodule` (`iapp_erpmodule`),
  KEY `iiapp_erpgroup` (`iiapp_erpgroup`),
  KEY `iapp_erpmoduldetail` (`iapp_erpmoduldetail`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table erplaning.app_erpgroup_config: ~42 rows (approximately)
/*!40000 ALTER TABLE `app_erpgroup_config` DISABLE KEYS */;
INSERT INTO `app_erpgroup_config` (`iapp_erpgroup_config`, `iiapp_erpgroup`, `iapp_erpmodule`, `iapp_erpmoduldetail`, `iview`, `iedit`, `idelete`, `iadd`, `dcreate`) VALUES
	(1, 18, 5, 22, 1, 0, 0, 0, '2018-11-09'),
	(2, 21, 2, 15, 1, 1, 1, 1, '2018-11-08'),
	(3, 21, 2, 14, 1, 1, 1, 0, '2018-11-08'),
	(4, 21, 2, 13, 1, 1, 1, 0, '2018-11-08'),
	(5, 21, 2, 12, 1, 1, 1, 0, '2018-11-08'),
	(6, 21, 2, 11, 1, 1, 1, 0, '2018-11-08'),
	(7, 21, 2, 10, 1, 1, 1, 1, '2018-11-08'),
	(8, 21, 2, 9, 1, 1, 1, 1, '2018-11-08'),
	(9, 21, 2, 8, 1, 0, 0, 0, '2018-11-08'),
	(10, 21, 2, 7, 1, 0, 0, 0, '2018-11-08'),
	(11, 21, 2, 6, 1, 0, 0, 0, '2018-11-08'),
	(12, 20, 2, 8, 1, 0, 0, 0, '2018-11-08'),
	(13, 20, 2, 7, 1, 0, 0, 0, '2018-11-08'),
	(14, 20, 2, 6, 1, 0, 0, 0, '2018-11-08'),
	(15, 20, 2, 15, 1, 0, 1, 1, '2018-11-10'),
	(16, 20, 2, 14, 1, 0, 1, 1, '2018-11-10'),
	(17, 20, 2, 13, 1, 0, 1, 1, '2018-11-10'),
	(18, 20, 2, 12, 1, 0, 1, 1, '2018-11-10'),
	(19, 20, 2, 11, 1, 0, 1, 0, '2018-11-10'),
	(20, 20, 2, 10, 1, 0, 1, 0, '2018-11-10'),
	(21, 20, 2, 9, 1, 1, 1, 0, '2018-11-10'),
	(22, 19, 2, 15, 1, 1, 0, 1, '2018-11-08'),
	(23, 19, 2, 14, 1, 1, 0, 1, '2018-11-08'),
	(24, 19, 2, 13, 1, 1, 0, 1, '2018-11-08'),
	(25, 19, 2, 12, 1, 1, 0, 1, '2018-11-08'),
	(26, 19, 2, 11, 1, 1, 0, 1, '2018-11-08'),
	(27, 19, 2, 8, 1, 0, 0, 0, '2018-11-08'),
	(28, 19, 2, 9, 1, 1, 0, 1, '2018-11-09'),
	(29, 19, 2, 10, 1, 1, 0, 1, '2018-11-08'),
	(30, 19, 2, 6, 1, 0, 0, 0, '2018-11-08'),
	(31, 19, 2, 7, 1, 0, 0, 0, '2018-11-08'),
	(32, 22, 1, 1, 1, 0, 0, 0, '2018-11-08'),
	(33, 17, 5, 22, 1, 0, 0, 0, '2018-11-08'),
	(34, 16, 5, 22, 1, 0, 0, 0, '2018-11-08'),
	(35, 24, 5, 22, 1, 0, 0, 0, '2018-11-09'),
	(36, 27, 6, 23, 1, 0, 0, 0, '2018-11-10'),
	(37, 28, 7, 25, 1, 0, 0, 0, '2018-11-10'),
	(38, 28, 7, 24, 1, 0, 0, 0, '2018-11-10'),
	(39, 20, 2, 26, 1, 0, 1, 1, '2018-11-10'),
	(40, 20, 2, 27, 1, 0, 1, 1, '2018-11-10'),
	(41, 21, 2, 26, 1, 1, 1, 1, '2018-11-10'),
	(42, 21, 2, 27, 1, 1, 1, 1, '2018-11-10');
/*!40000 ALTER TABLE `app_erpgroup_config` ENABLE KEYS */;

-- Dumping structure for table erplaning.app_erpgroup_user
CREATE TABLE IF NOT EXISTS `app_erpgroup_user` (
  `iapp_erpgroup_user` int(11) NOT NULL AUTO_INCREMENT,
  `iiapp_erpgroup` int(11) NOT NULL,
  `capp_employee` varchar(50) NOT NULL,
  `iapp_erpmodule` int(11) NOT NULL DEFAULT '0',
  `dcreate` date DEFAULT NULL,
  PRIMARY KEY (`iapp_erpgroup_user`),
  KEY `iapp_erpmodule` (`iapp_erpmodule`),
  KEY `iiapp_erpgroup` (`iiapp_erpgroup`),
  KEY `capp_employee` (`capp_employee`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table erplaning.app_erpgroup_user: ~9 rows (approximately)
/*!40000 ALTER TABLE `app_erpgroup_user` DISABLE KEYS */;
INSERT INTO `app_erpgroup_user` (`iapp_erpgroup_user`, `iiapp_erpgroup`, `capp_employee`, `iapp_erpmodule`, `dcreate`) VALUES
	(5, 18, 'KRY00001', 5, '2018-11-09'),
	(6, 22, 'KRY00001', 1, '2018-11-09'),
	(7, 20, 'KRY00001', 2, '2018-11-09'),
	(8, 21, 'KRY00017', 2, '2018-11-09'),
	(9, 27, 'KRY00017', 6, '2018-11-10'),
	(10, 27, 'KRY00001', 6, '2018-11-10'),
	(11, 28, 'KRY00017', 7, '2018-11-10'),
	(12, 17, 'KRY00017', 5, '2018-11-10'),
	(13, 22, 'KRY00017', 1, '2018-11-10');
/*!40000 ALTER TABLE `app_erpgroup_user` ENABLE KEYS */;

-- Dumping structure for table erplaning.app_erpmoduldetail
CREATE TABLE IF NOT EXISTS `app_erpmoduldetail` (
  `iapp_erpmoduldetail` int(11) NOT NULL AUTO_INCREMENT,
  `turl` text NOT NULL,
  `iactived` int(11) NOT NULL DEFAULT '0',
  `iparent` int(11) NOT NULL,
  `tparenturl` text NOT NULL,
  `itipe` int(11) DEFAULT NULL,
  `tnamedetail` text,
  `iapp_erpmodule` int(11) DEFAULT NULL,
  PRIMARY KEY (`iapp_erpmoduldetail`),
  KEY `iapp_erpmodule` (`iapp_erpmodule`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Dumping data for table erplaning.app_erpmoduldetail: ~17 rows (approximately)
/*!40000 ALTER TABLE `app_erpmoduldetail` DISABLE KEYS */;
INSERT INTO `app_erpmoduldetail` (`iapp_erpmoduldetail`, `turl`, `iactived`, `iparent`, `tparenturl`, `itipe`, `tnamedetail`, `iapp_erpmodule`) VALUES
	(1, 'm_application', 0, 0, '', 1, 'Application', 1),
	(6, 'master', 0, 0, '', 1, 'Master', 2),
	(7, 'transaksi', 0, 0, '', 1, 'Transaksi', 2),
	(8, 'report', 0, 0, '', 1, 'Report', 2),
	(9, 'buyer', 0, 6, 'master', 2, 'Buyer', 2),
	(10, 'suplier', 0, 6, 'master', 2, 'Supplier', 2),
	(11, 'jenis', 0, 6, 'master', 2, 'Jenis', 2),
	(12, 'pembelian', 0, 7, 'transaksi', 2, 'Pembelian', 2),
	(13, 'sortir', 0, 7, 'transaksi', 2, 'Sortir', 2),
	(14, 'timbang', 0, 7, 'transaksi', 2, 'Timbang', 2),
	(15, 'penjaualan', 0, 7, 'transaksi', 2, 'Penjualan', 2),
	(22, 'm_karyawan', 0, 0, '', 1, 'Master Karyawan', 5),
	(23, 'warehouse', 0, 0, '', 1, 'Warehouse', 6),
	(24, 'generate', 0, 0, '', 1, 'Generate Gaji', 7),
	(25, 'historygaji', 0, 0, '', 1, 'History', 7),
	(26, 'gudang', 0, 8, 'report', 2, 'Gudang', 2),
	(27, 'penjualan_pembelian', 0, 8, 'report', 2, 'Penjualan & Pembelian', 2);
/*!40000 ALTER TABLE `app_erpmoduldetail` ENABLE KEYS */;

-- Dumping structure for table erplaning.app_erpmodule
CREATE TABLE IF NOT EXISTS `app_erpmodule` (
  `iapp_erpmodule` int(11) NOT NULL AUTO_INCREMENT,
  `iactivied` int(11) NOT NULL DEFAULT '0',
  `vmodule` text,
  `dcreate` date DEFAULT NULL,
  PRIMARY KEY (`iapp_erpmodule`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table erplaning.app_erpmodule: ~4 rows (approximately)
/*!40000 ALTER TABLE `app_erpmodule` DISABLE KEYS */;
INSERT INTO `app_erpmodule` (`iapp_erpmodule`, `iactivied`, `vmodule`, `dcreate`) VALUES
	(1, 0, 'Privilages ', '2018-11-07'),
	(2, 0, 'Produk', '2018-11-10'),
	(5, 0, 'SDM', '2018-11-10'),
	(7, 0, 'Payroll', '2018-11-10');
/*!40000 ALTER TABLE `app_erpmodule` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
