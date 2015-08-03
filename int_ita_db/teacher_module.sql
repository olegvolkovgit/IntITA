-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-04 01:53:55
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.teacher_module
DROP TABLE IF EXISTS `teacher_module`;
CREATE TABLE IF NOT EXISTS `teacher_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTeacher` int(11) NOT NULL,
  `idModule` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_teacher_module_teacher` (`idTeacher`),
  KEY `FK_teacher_module_module` (`idModule`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.teacher_module: ~33 rows (approximately)
/*!40000 ALTER TABLE `teacher_module` DISABLE KEYS */;
INSERT INTO `teacher_module` (`id`, `idTeacher`, `idModule`) VALUES
	(1, 1, 1),
	(2, 2, 1),
	(3, 3, 1),
	(5, 4, 1),
	(6, 3, 2),
	(7, 4, 2),
	(8, 1, 3),
	(9, 4, 3),
	(11, 4, 4),
	(14, 3, 9),
	(15, 4, 9),
	(17, 1, 10),
	(18, 4, 10),
	(19, 1, 7),
	(20, 5, 7),
	(34, 2, 11),
	(35, 1, 14),
	(36, 4, 16),
	(37, 3, 17),
	(38, 1, 18),
	(39, 3, 20),
	(40, 4, 22),
	(41, 2, 23),
	(44, 1, 20),
	(45, 2, 2),
	(46, 1, 61),
	(47, 9, 1),
	(48, 2, 14),
	(49, 10, 2),
	(50, 11, 3),
	(51, 11, 10),
	(53, 12, 11);
/*!40000 ALTER TABLE `teacher_module` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
