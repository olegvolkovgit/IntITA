-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-04-22 09:15:00
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id_user` int(11) NOT NULL,
  `id_resource` int(11) NOT NULL,
  `rights` tinyint(10) NOT NULL,
  PRIMARY KEY (`id_user`,`id_resource`),
  KEY `FK_permissions_lectures` (`id_resource`),
  CONSTRAINT `FK_permissions_lectures` FOREIGN KEY (`id_resource`) REFERENCES `lectures` (`id`),
  CONSTRAINT `FK_permissions_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User rights for lectures: BIT (32) \r\n0 - read\r\n1 - edit\r\n2 - create\r\n3 - delete  ';

-- Dumping data for table int_ita_db.permissions: ~3 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id_user`, `id_resource`, `rights`) VALUES
	(1, 1, 15),
	(11, 1, 15),
	(22, 1, 15);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
