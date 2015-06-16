-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-06-16 18:31:07
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.consultationscalendar
DROP TABLE IF EXISTS `consultationscalendar`;
CREATE TABLE IF NOT EXISTS `consultationscalendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lecture_id` int(11) DEFAULT NULL,
  `date_cons` date DEFAULT NULL,
  `start_cons` time DEFAULT NULL,
  `end_cons` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.consultationscalendar: ~22 rows (approximately)
/*!40000 ALTER TABLE `consultationscalendar` DISABLE KEYS */;
INSERT INTO `consultationscalendar` (`id`, `teacher_id`, `user_id`, `lecture_id`, `date_cons`, `start_cons`, `end_cons`) VALUES
	(1, 1, 1, 1, '2015-05-08', '12:20:00', '12:40:00'),
	(2, 1, 1, 1, '2015-05-07', '14:20:00', '14:40:00'),
	(3, 1, 1, 1, '2015-05-07', '16:00:00', '16:20:00'),
	(4, 1, 1, 1, '2015-05-07', '17:20:00', '17:40:00'),
	(5, 1, 1, 1, '2015-05-07', '18:40:00', '19:00:00'),
	(6, 1, 1, 1, '2015-05-07', '19:20:00', '19:40:00'),
	(7, 1, 1, 1, '2015-05-07', '17:20:00', '17:40:00'),
	(8, 1, 1, 1, '2015-05-07', '18:20:00', '18:40:00'),
	(9, 1, 1, 1, '2015-05-07', '19:20:00', '19:40:00'),
	(10, 2, 38, 1, '2015-05-05', '12:20:00', '12:40:00'),
	(11, 2, 38, 1, '2015-05-05', '13:00:00', '14:00:00'),
	(12, 2, 38, 1, '2015-05-05', '14:20:00', '14:40:00'),
	(13, 2, 38, 1, '2015-05-12', '12:00:00', '15:00:00'),
	(14, 2, 38, 1, '2015-05-12', '19:00:00', '21:00:00'),
	(15, 2, 38, 1, '2015-05-13', '14:20:00', '14:40:00'),
	(16, 2, 38, 1, '2015-05-13', '15:20:00', '15:40:00'),
	(17, 2, 38, 1, '2015-05-13', '17:20:00', '19:40:00'),
	(18, 2, 38, 1, '2015-05-12', '17:20:00', '17:40:00'),
	(19, 2, 1, 1, '2015-05-06', '11:20:00', '12:00:00'),
	(20, 2, 1, 1, '2015-05-06', '14:20:00', '14:40:00'),
	(21, 2, 1, 1, '2015-05-06', '15:20:00', '15:40:00'),
	(22, 2, 1, 1, '2015-05-06', '16:20:00', '16:40:00'),
	(23, 2, 1, 1, '2015-05-13', '21:00:00', '21:20:00'),
	(24, 2, 38, 1, '2015-05-14', '11:20:00', '11:40:00'),
	(25, 1, 49, 1, '2015-05-26', '11:20:00', '11:40:00'),
	(26, 1, 49, 1, '2015-05-27', '11:20:00', '11:40:00'),
	(27, 1, 22, 1, '2015-06-23', '11:20:00', '11:40:00'),
	(28, 1, 22, 1, '2015-06-23', '14:20:00', '14:40:00'),
	(29, 1, 22, 1, '2015-06-18', '10:00:00', '10:20:00');
/*!40000 ALTER TABLE `consultationscalendar` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
