-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-15 11:35:06
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table intita.project_student
DROP TABLE IF EXISTS `project_student`;
CREATE TABLE IF NOT EXISTS `project_student` (
  `project` int(10) NOT NULL,
  `student` int(10) NOT NULL,
  KEY `FK_project_student_project` (`project`),
  KEY `FK_project_student_user` (`student`),
  CONSTRAINT `FK_project_student_project` FOREIGN KEY (`project`) REFERENCES `project` (`id`),
  CONSTRAINT `FK_project_student_user` FOREIGN KEY (`student`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table intita.project_student: ~7 rows (approximately)
/*!40000 ALTER TABLE `project_student` DISABLE KEYS */;
INSERT INTO `project_student` (`project`, `student`) VALUES
	(1, 51),
	(2, 52),
	(4, 55),
	(4, 53),
	(5, 53),
	(6, 55),
	(7, 54);
/*!40000 ALTER TABLE `project_student` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
