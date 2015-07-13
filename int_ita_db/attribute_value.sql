-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-13 17:03:50
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.attribute_value
DROP TABLE IF EXISTS `attribute_value`;
CREATE TABLE IF NOT EXISTS `attribute_value` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `teacher` int(10) NOT NULL,
  `attribute` int(10) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_attribute_value_role_attribute` (`attribute`),
  KEY `FK_attribute_value_roles` (`teacher`),
  CONSTRAINT `FK_attribute_value_role_attribute` FOREIGN KEY (`attribute`) REFERENCES `role_attribute` (`id`),
  CONSTRAINT `FK_attribute_value_roles` FOREIGN KEY (`teacher`) REFERENCES `teacher` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.attribute_value: ~38 rows (approximately)
/*!40000 ALTER TABLE `attribute_value` DISABLE KEYS */;
INSERT INTO `attribute_value` (`id`, `teacher`, `attribute`, `value`) VALUES
	(2, 1, 1, '5'),
	(3, 2, 1, '12'),
	(4, 3, 1, '23'),
	(6, 4, 1, '5'),
	(8, 6, 1, '14'),
	(10, 1, 2, '51'),
	(11, 2, 2, '52'),
	(13, 3, 2, '54'),
	(14, 6, 2, '22'),
	(15, 4, 2, '55'),
	(16, 6, 3, '1'),
	(17, 1, 3, '2'),
	(18, 2, 3, '5'),
	(19, 3, 4, '1'),
	(20, 5, 3, '5'),
	(32, 1, 4, '1'),
	(33, 2, 4, '2'),
	(34, 4, 4, '4'),
	(35, 5, 4, '5'),
	(37, 6, 4, '6'),
	(38, 1, 6, '1'),
	(39, 2, 6, '5'),
	(40, 3, 6, '14'),
	(41, 4, 6, '5'),
	(43, 5, 6, '4'),
	(44, 6, 6, '5'),
	(45, 1, 7, '1'),
	(46, 2, 7, '2'),
	(47, 3, 7, '123'),
	(48, 4, 7, '1'),
	(49, 5, 7, '1'),
	(50, 6, 7, '1'),
	(51, 1, 8, '1245'),
	(52, 2, 8, '4'),
	(53, 3, 8, '4'),
	(54, 4, 8, '5'),
	(55, 5, 8, '6'),
	(56, 6, 8, '2');
/*!40000 ALTER TABLE `attribute_value` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
