-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-22 19:38:57
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.tests
DROP TABLE IF EXISTS `tests`;
CREATE TABLE IF NOT EXISTS `tests` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `block_element` int(10) NOT NULL,
  `author` int(10) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tests_teacher` (`author`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.tests: ~2 rows (approximately)
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
INSERT INTO `tests` (`id`, `block_element`, `author`, `title`) VALUES
	(35, 310, 2, 'hystjhytw'),
	(36, 311, 2, 'i578ik57');
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
