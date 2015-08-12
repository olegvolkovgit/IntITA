-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-10 17:27:19
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table intita.lecture_page
DROP TABLE IF EXISTS `lecture_page`;
CREATE TABLE IF NOT EXISTS `lecture_page` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_lecture` int(10) NOT NULL,
  `page_order` int(10) DEFAULT NULL,
  `video` int(10) DEFAULT NULL,
  `quiz` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Dumping data for table intita.lecture_page: ~29 rows (approximately)
/*!40000 ALTER TABLE `lecture_page` DISABLE KEYS */;
INSERT INTO `lecture_page` (`id`, `id_lecture`, `page_order`, `video`, `quiz`) VALUES
	(1, 117, 1, 340, 393),
	(2, 117, 2, 341, 394),
	(3, 117, 3, 395, NULL),
	(4, 117, 4, 396, 397),
	(5, 117, 5, 398, 400),
	(6, 118, 1, 449, 454),
	(7, 118, 2, 450, 455),
	(8, 118, 3, 451, 456),
	(9, 118, 4, 452, 457),
	(10, 118, 5, 453, 458),
	(11, 118, 6, 462, 459),
	(12, 118, 7, 472, 461),
	(13, 127, 1, NULL, 728),
	(14, 127, 2, NULL, 732),
	(15, 127, 3, NULL, 736),
	(16, 127, 4, NULL, 739),
	(17, 127, 5, NULL, 743),
	(18, 127, 6, NULL, 747),
	(19, 127, 7, NULL, 750),
	(20, 131, 1, NULL, 754),
	(21, 131, 2, NULL, 757),
	(22, 131, 3, NULL, 760),
	(23, 131, 4, NULL, 765),
	(24, 131, 5, NULL, 769),
	(25, 131, 6, NULL, 773),
	(26, 131, 7, NULL, 776),
	(27, 131, 8, NULL, 780),
	(28, 131, 9, NULL, 783),
	(29, 131, 10, NULL, NULL);
/*!40000 ALTER TABLE `lecture_page` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
