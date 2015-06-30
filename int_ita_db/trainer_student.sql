-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-06-30 16:46:50
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.trainer_student
DROP TABLE IF EXISTS `trainer_student`;
CREATE TABLE IF NOT EXISTS `trainer_student` (
  `trainer` int(10) NOT NULL,
  `student` int(10) NOT NULL,
  KEY `FK_trainer_student_teacher` (`trainer`),
  KEY `FK_trainer_student_user` (`student`),
  CONSTRAINT `FK_trainer_student_teacher` FOREIGN KEY (`trainer`) REFERENCES `teacher` (`teacher_id`),
  CONSTRAINT `FK_trainer_student_user` FOREIGN KEY (`student`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.trainer_student: ~7 rows (approximately)
/*!40000 ALTER TABLE `trainer_student` DISABLE KEYS */;
INSERT INTO `trainer_student` (`trainer`, `student`) VALUES
	(1, 55),
	(1, 51),
	(2, 52),
	(3, 54),
	(4, 11),
	(5, 54),
	(6, 22);
/*!40000 ALTER TABLE `trainer_student` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
