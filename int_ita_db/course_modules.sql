-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-23 17:46:13
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.course_modules
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

-- Dumping data for table int_ita_db.course_modules: ~25 rows (approximately)
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
	(1, 14, 9),
	(1, 16, 10),
	(1, 17, 11),
	(1, 18, 13),
	(1, 20, 12),
	(1, 22, 14),
	(1, 23, 15),
	(13, 54, 1),
	(13, 55, 2),
	(13, 56, 3),
	(14, 58, 1),
	(14, 59, 2),
	(14, 60, 3),
	(3, 1, 1),
	(3, 2, 2),
	(3, 3, 3),
	(1, 61, 16),
	(5, 82, 1);
/*!40000 ALTER TABLE `course_modules` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
