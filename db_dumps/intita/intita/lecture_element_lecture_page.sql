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

-- Dumping structure for table intita.lecture_element_lecture_page
DROP TABLE IF EXISTS `lecture_element_lecture_page`;
CREATE TABLE IF NOT EXISTS `lecture_element_lecture_page` (
  `element` int(10) NOT NULL,
  `page` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table intita.lecture_element_lecture_page: ~46 rows (approximately)
/*!40000 ALTER TABLE `lecture_element_lecture_page` DISABLE KEYS */;
INSERT INTO `lecture_element_lecture_page` (`element`, `page`) VALUES
	(317, 1),
	(306, 1),
	(393, 1),
	(310, 2),
	(312, 3),
	(314, 4),
	(316, 5),
	(319, 6),
	(323, 7),
	(322, 7),
	(326, 8),
	(325, 8),
	(329, 9),
	(328, 9),
	(331, 10),
	(332, 10),
	(334, 11),
	(335, 11),
	(337, 12),
	(338, 12),
	(727, 13),
	(730, 14),
	(731, 14),
	(734, 15),
	(735, 15),
	(738, 16),
	(741, 17),
	(742, 17),
	(745, 18),
	(746, 18),
	(749, 19),
	(753, 20),
	(756, 21),
	(759, 22),
	(761, 22),
	(763, 23),
	(764, 23),
	(767, 24),
	(768, 24),
	(771, 25),
	(772, 25),
	(775, 26),
	(778, 27),
	(779, 27),
	(782, 28),
	(785, 29);
/*!40000 ALTER TABLE `lecture_element_lecture_page` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
