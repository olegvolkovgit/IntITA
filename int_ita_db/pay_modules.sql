-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-13 17:03:51
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.pay_modules
DROP TABLE IF EXISTS `pay_modules`;
CREATE TABLE IF NOT EXISTS `pay_modules` (
  `id_user` int(10) NOT NULL,
  `id_module` int(10) NOT NULL,
  `rights` tinyint(10) NOT NULL,
  KEY `FK_pay_modules_user` (`id_user`),
  KEY `FK_pay_modules_module` (`id_module`),
  CONSTRAINT `FK_pay_modules_module` FOREIGN KEY (`id_module`) REFERENCES `module` (`module_ID`),
  CONSTRAINT `FK_pay_modules_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User rights for modules: TINYINT(10) \r\n0 - read\r\n1 - edit\r\n2 - create\r\n3 - delete  ';

-- Dumping data for table int_ita_db.pay_modules: ~27 rows (approximately)
/*!40000 ALTER TABLE `pay_modules` DISABLE KEYS */;
INSERT INTO `pay_modules` (`id_user`, `id_module`, `rights`) VALUES
	(38, 1, 3),
	(38, 61, 3),
	(38, 1, 3),
	(39, 1, 3),
	(40, 1, 3),
	(41, 1, 3),
	(40, 2, 3),
	(41, 2, 3),
	(38, 3, 3),
	(41, 3, 3),
	(41, 4, 3),
	(40, 9, 3),
	(41, 9, 3),
	(38, 10, 3),
	(41, 10, 3),
	(38, 7, 3),
	(42, 7, 3),
	(39, 11, 3),
	(38, 14, 3),
	(41, 16, 3),
	(40, 17, 3),
	(38, 18, 3),
	(40, 20, 3),
	(41, 22, 3),
	(39, 23, 3),
	(38, 20, 3),
	(39, 2, 3),
	(22, 3, 1),
	(38, 82, 3);
/*!40000 ALTER TABLE `pay_modules` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
