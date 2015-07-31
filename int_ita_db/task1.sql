-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-31 18:15:55
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.task1
DROP TABLE IF EXISTS `task1`;
CREATE TABLE IF NOT EXISTS `task1` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `language` varchar(15) DEFAULT NULL,
  `assignment` int(10) DEFAULT NULL,
  `condition` int(11) NOT NULL,
  `author` int(11) DEFAULT NULL,
  `table` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  CONSTRAINT `FK_task1_teacher` FOREIGN KEY (`author`) REFERENCES `teacher` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8 COMMENT='Lectures tasks.';

-- Dumping data for table int_ita_db.task1: ~46 rows (approximately)
/*!40000 ALTER TABLE `task1` DISABLE KEYS */;
INSERT INTO `task1` (`id`, `language`, `assignment`, `condition`, `author`, `table`) VALUES
	(50, 'c++', 1, 100, 1, 'assignment_cpp'),
	(51, 'c++', 2, 159, 1, 'assignment_cpp'),
	(52, 'c++', 3, 160, 1, 'assignment_cpp'),
	(53, 'c++', 1, 100, 1, 'assignment_cpp'),
	(54, 'c++', 1, 100, 1, 'assignment_cpp'),
	(55, 'c++', 1, 111, 1, 'assignment_cpp'),
	(56, 'c++', 1, 135, 1, 'assignment_cpp'),
	(58, 'c++', 1, 157, 3, 'assignment_cpp'),
	(59, 'c++', 1, 175, 5, 'assignment_cpp'),
	(60, 'c++', 1, 195, 5, 'assignment_cpp'),
	(61, 'c++', 1, 197, 2, 'assignment_cpp'),
	(62, 'c++', 1, 208, 2, 'assignment_cpp'),
	(63, 'c++', 1, 209, 5, 'assignment_cpp'),
	(64, 'c++', 1, 220, 5, 'assignment_cpp'),
	(65, 'c++', 1, 224, 5, 'assignment_cpp'),
	(66, 'c++', 1, 250, 4, 'assignment_cpp'),
	(67, 'c++', 1, 233, 4, 'assignment_cpp'),
	(68, 'c++', 14, 302, 1, 'assignment_cpp'),
	(72, 'c++', 1, 230, 1, 'assignment_cpp'),
	(73, 'c++', 1, 229, 1, 'assignment_cpp'),
	(74, 'c++', 1, 230, 1, 'assignment_cpp'),
	(75, 'c++', 1, 229, 1, 'assignment_cpp'),
	(76, 'c++', 1, 236, 1, 'assignment_cpp'),
	(77, 'c++', 1, 400, 1, 'assignment_cpp'),
	(78, 'c++', 1, 377, 1, 'assignment_cpp'),
	(79, 'c++', 1, 385, 1, 'assignment_cpp'),
	(80, 'c++', 1, 90, 1, 'assignment_cpp'),
	(81, 'c++', 1, 112, 1, 'assignment_cpp'),
	(82, 'c++', 1, 256, 1, 'assignment_cpp'),
	(83, 'c++', 1, 279, 1, 'assignment_cpp'),
	(85, 'c++', 22, 438, 1, 'assignment_cpp'),
	(88, 'c++', 22, 442, 9, 'assignment_cpp'),
	(89, 'c++', 25, 448, 1, 'assignment_cpp'),
	(90, 'c++', 26, 474, 1, 'assignment_cpp'),
	(91, 'c++', 27, 476, 1, 'assignment_cpp'),
	(92, 'c++', 28, 477, 1, 'assignment_cpp'),
	(93, 'c++', 29, 478, 1, 'assignment_cpp'),
	(94, 'c++', 30, 479, 1, 'assignment_cpp'),
	(95, 'c++', 31, 481, 1, 'assignment_cpp'),
	(96, 'c++', 32, 482, 1, 'assignment_cpp'),
	(97, 'java', 33, 483, 1, 'assignment_cpp'),
	(98, 'c++', 35, 485, 1, 'assignment_cpp'),
	(99, 'c++', 39, 486, 1, 'assignment_cpp'),
	(100, 'c++', 40, 497, 1, 'assignment_cpp'),
	(101, 'c++', 1, 473, 1, 'assignment_cpp'),
	(102, 'с++', 1, 526, 1, 'assignment_cpp');
/*!40000 ALTER TABLE `task1` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
