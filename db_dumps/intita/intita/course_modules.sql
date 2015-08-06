-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-06 16:18:21
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table intita.course_modules
DROP TABLE IF EXISTS `course_modules`;
CREATE TABLE IF NOT EXISTS `course_modules` (
  `id_course` int(10) NOT NULL,
  `id_module` int(10) NOT NULL,
  `order` int(10) NOT NULL,
  KEY `FK_course_modules_course` (`id_course`),
  KEY `FK_course_modules_module` (`id_module`),
  CONSTRAINT `FK_course_modules_course` FOREIGN KEY (`id_course`) REFERENCES `course` (`course_ID`),
  CONSTRAINT `FK_course_modules_module` FOREIGN KEY (`id_module`) REFERENCES `module` (`module_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table intita.course_modules: ~49 rows (approximately)
/*!40000 ALTER TABLE `course_modules` DISABLE KEYS */;
INSERT INTO `course_modules` (`id_course`, `id_module`, `order`) VALUES
	(1, 1, 1),
	(1, 2, 4),
	(1, 3, 2),
	(1, 4, 3),
	(1, 7, 5),
	(1, 9, 6),
	(1, 10, 7),
	(1, 11, 8),
	(1, 14, 10),
	(1, 16, 11),
	(1, 17, 13),
	(1, 18, 15),
	(1, 20, 14),
	(1, 22, 16),
	(1, 23, 17),
	(13, 54, 1),
	(13, 55, 2),
	(13, 56, 3),
	(14, 58, 1),
	(14, 59, 2),
	(14, 60, 3),
	(3, 1, 1),
	(3, 2, 2),
	(3, 3, 3),
	(1, 61, 19),
	(19, 82, 1),
	(19, 83, 2),
	(19, 84, 3),
	(19, 85, 4),
	(19, 86, 5),
	(19, 87, 6),
	(19, 88, 7),
	(19, 89, 8),
	(19, 90, 9),
	(19, 91, 10),
	(19, 92, 11),
	(19, 93, 12),
	(19, 94, 13),
	(19, 95, 14),
	(21, 96, 1),
	(21, 97, 2),
	(21, 98, 3),
	(20, 99, 1),
	(20, 100, 2),
	(20, 101, 3),
	(1, 121, 9),
	(1, 122, 12),
	(1, 123, 18),
	(1, 125, 20);
/*!40000 ALTER TABLE `course_modules` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
