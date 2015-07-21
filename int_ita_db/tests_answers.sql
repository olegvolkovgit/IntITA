-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-21 01:00:40
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.tests_answers
DROP TABLE IF EXISTS `tests_answers`;
CREATE TABLE IF NOT EXISTS `tests_answers` (
  `id` int(10) NOT NULL,
  `id_test` int(10) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `is_valid` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tests_answers_tests` (`id_test`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.tests_answers: ~0 rows (approximately)
/*!40000 ALTER TABLE `tests_answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `tests_answers` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
