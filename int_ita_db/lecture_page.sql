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

-- Dumping structure for table int_ita_db.lecture_page
DROP TABLE IF EXISTS `lecture_page`;
CREATE TABLE IF NOT EXISTS `lecture_page` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_lecture` int(10) NOT NULL,
  `page_order` int(10) DEFAULT NULL,
  `video` int(10) DEFAULT NULL,
  `quiz` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table int_ita_db.lecture_page: ~0 rows (approximately)
/*!40000 ALTER TABLE `lecture_page` DISABLE KEYS */;
INSERT INTO `lecture_page` (`id`, `id_lecture`, `page_order`, `video`, `quiz`) VALUES
	(1, 117, 1, 340, 393);
/*!40000 ALTER TABLE `lecture_page` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
