-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.36-MariaDB - Source distribution
-- Server OS:                    Linux
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for erplaning
DROP DATABASE IF EXISTS `erplaning`;
CREATE DATABASE IF NOT EXISTS `erplaning` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `erplaning`;

-- Dumping structure for table erplaning.app_employee
DROP TABLE IF EXISTS `app_employee`;
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

-- Data exporting was unselected.
-- Dumping structure for table erplaning.app_erpgroup
DROP TABLE IF EXISTS `app_erpgroup`;
CREATE TABLE IF NOT EXISTS `app_erpgroup` (
  `iiapp_erpgroup` int(11) NOT NULL AUTO_INCREMENT,
  `iapp_erpmodule` int(11) NOT NULL DEFAULT '0',
  `vgroup` text,
  `dcreate` date DEFAULT NULL,
  PRIMARY KEY (`iiapp_erpgroup`),
  KEY `iapp_erpmodule` (`iapp_erpmodule`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table erplaning.app_erpgroup_config
DROP TABLE IF EXISTS `app_erpgroup_config`;
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table erplaning.app_erpgroup_user
DROP TABLE IF EXISTS `app_erpgroup_user`;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table erplaning.app_erpmoduldetail
DROP TABLE IF EXISTS `app_erpmoduldetail`;
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table erplaning.app_erpmodule
DROP TABLE IF EXISTS `app_erpmodule`;
CREATE TABLE IF NOT EXISTS `app_erpmodule` (
  `iapp_erpmodule` int(11) NOT NULL AUTO_INCREMENT,
  `iactivied` int(11) NOT NULL DEFAULT '0',
  `vmodule` text,
  `dcreate` date DEFAULT NULL,
  PRIMARY KEY (`iapp_erpmodule`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
