-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-31 18:15:54
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

-- Dumping data for table int_ita_db.pay_modules: ~58 rows (approximately)
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
	(22, 1, 1),
	(22, 23, 1),
	(22, 7, 1),
	(11, 3, 1),
	(39, 61, 1),
	(22, 55, 1),
	(109, 1, 3),
	(39, 14, 3),
	(22, 2, 1),
	(108, 2, 3),
	(115, 2, 1),
	(106, 2, 1),
	(117, 3, 3),
	(117, 10, 3),
	(38, 23, 1),
	(38, 100, 1),
	(38, 101, 1),
	(51, 22, 1),
	(52, 1, 1),
	(52, 2, 1),
	(121, 1, 1),
	(121, 23, 1),
	(1, 61, 1),
	(1, 2, 1),
	(129, 1, 1),
	(129, 3, 1),
	(1, 7, 1),
	(129, 7, 1),
	(129, 61, 1),
	(130, 11, 3);
/*!40000 ALTER TABLE `pay_modules` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
