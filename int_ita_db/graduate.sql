-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-05-25 14:53:13
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.graduate
DROP TABLE IF EXISTS `graduate`;
CREATE TABLE IF NOT EXISTS `graduate` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `graduate_date` date DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `work_place` varchar(255) DEFAULT NULL,
  `courses` varchar(255) DEFAULT NULL,
  `history` varchar(255) DEFAULT NULL,
  `rate` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.graduate: ~7 rows (approximately)
/*!40000 ALTER TABLE `graduate` DISABLE KEYS */;
INSERT INTO `graduate` (`id`, `full_name`, `avatar`, `graduate_date`, `position`, `work_place`, `courses`, `history`, `rate`) VALUES
	(1, 'Роксана Остапівна Соковита', 'Graduates.jpg', '2015-05-12', 'Інтернет-програміст, junior', 'Google Inc.', 'Інтернет-программіст(PHP), початківець, та ще трохи', NULL, 6),
	(2, 'Роксана Остапівна Соковита', 'Graduates.jpg', '2015-05-12', 'Інтернет-програміст, junior', 'Google Inc.', 'Інтернет-программіст(PHP), початківець, та ще трохи', NULL, 7),
	(3, 'Роксана Остапівна Соковита', 'Graduates.jpg', '2015-05-12', 'Інтернет-програміст, junior', 'Google Inc.', 'Інтернет-программіст(PHP), початківець, та ще трохи', NULL, 8),
	(4, 'Роксана Остапівна Соковита', 'Graduates.jpg', '2015-05-12', 'Інтернет-програміст, junior', 'Google Inc.', 'Інтернет-программіст(PHP), початківець, та ще трохи', NULL, 7),
	(5, 'Роксана Остапівна Соковита', 'Graduates.jpg', '2015-05-12', 'Інтернет-програміст, junior', 'Google Inc.', 'Інтернет-программіст(PHP), початківець, та ще трохи', NULL, 7),
	(6, 'Роксана Остапівна Соковита', 'Graduates.jpg', '2015-05-12', 'Інтернет-програміст, junior', 'Google Inc.', 'Інтернет-программіст(PHP), початківець, та ще трохи', NULL, 7),
	(7, 'Роксана Остапівна Соковита', 'Graduates.jpg', '2015-05-12', 'Інтернет-програміст, junior', 'Google Inc.', 'Інтернет-программіст(PHP), початківець, та ще трохи', NULL, 7),
	(8, 'Роксана Остапівна Соковита', 'Graduates.jpg', '2015-05-12', 'Інтернет-програміст, junior', 'Google Inc.', 'Інтернет-программіст(PHP), початківець, та ще трохи', NULL, 7);
/*!40000 ALTER TABLE `graduate` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
