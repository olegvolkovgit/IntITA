-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-06 15:12:49
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.lecture_element_lecture_page
DROP TABLE IF EXISTS `lecture_element_lecture_page`;
CREATE TABLE IF NOT EXISTS `lecture_element_lecture_page` (
  `element` int(10) NOT NULL,
  `page` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table int_ita_db.lecture_element_lecture_page: ~4 rows (approximately)
/*!40000 ALTER TABLE `lecture_element_lecture_page` DISABLE KEYS */;
INSERT INTO `lecture_element_lecture_page` (`element`, `page`) VALUES
	(317, 1),
	(306, 1),
	(393, 1);
/*!40000 ALTER TABLE `lecture_element_lecture_page` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
