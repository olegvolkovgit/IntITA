-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-04-22 15:37:34
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.element_type
DROP TABLE IF EXISTS `element_type`;
CREATE TABLE IF NOT EXISTS `element_type` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `type` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='Types of lecture elements.';

-- Dumping data for table int_ita_db.element_type: ~8 rows (approximately)
/*!40000 ALTER TABLE `element_type` DISABLE KEYS */;
INSERT INTO `element_type` (`id`, `type`) VALUES
	(1, 'text'),
	(2, 'video'),
	(3, 'code'),
	(4, 'example'),
	(5, 'task'),
	(6, 'final task'),
	(7, 'instruction'),
	(8, 'label');
/*!40000 ALTER TABLE `element_type` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
