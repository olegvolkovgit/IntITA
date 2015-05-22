-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-05-22 17:58:52
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
  KEY `FK_teacher_module_module` (`idModule`),
  CONSTRAINT `FK_teacher_module_module` FOREIGN KEY (`idModule`) REFERENCES `module` (`module_ID`),
  CONSTRAINT `FK_teacher_module_teacher` FOREIGN KEY (`idTeacher`) REFERENCES `teacher` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.teacher_module: ~16 rows (approximately)
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
	(10, 5, 3),
	(11, 4, 4),
	(12, 1, 7),
	(13, 2, 7),
	(14, 3, 9),
	(15, 4, 9),
	(17, 1, 10),
	(18, 4, 10);
/*!40000 ALTER TABLE `teacher_module` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
