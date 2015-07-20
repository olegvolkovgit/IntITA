-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-20 16:13:47
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.task
DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `language` varchar(15) DEFAULT NULL,
  `assignment` int(10) DEFAULT NULL,
  `condition` int(11) NOT NULL,
  `author` int(11) DEFAULT NULL,
  `table` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  CONSTRAINT `FK_task_teacher` FOREIGN KEY (`author`) REFERENCES `teacher` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COMMENT='Lectures tasks.\r\n';

-- Dumping data for table int_ita_db.task: ~17 rows (approximately)
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` (`id`, `language`, `assignment`, `condition`, `author`, `table`) VALUES
	(50, 'c++', 1, 100, 1, 'assignment_cpp'),
	(51, 'c++', 2, 159, 1, 'assignment_cpp'),
	(52, 'c++', 3, 160, 1, 'assignment_cpp'),
	(53, 'c++', 1, 100, 1, 'assignment_cpp'),
	(54, 'c++', 1, 100, 1, 'assignment_cpp'),
	(55, 'c++', 1, 111, 1, 'assignment_cpp'),
	(56, 'c++', 1, 135, 1, 'assignment_cpp'),
	(57, 'c++', 1, 153, 2, 'assignment_cpp'),
	(58, 'c++', 1, 157, 3, 'assignment_cpp'),
	(59, 'c++', 1, 175, 5, 'assignment_cpp'),
	(60, 'c++', 1, 195, 5, 'assignment_cpp'),
	(61, 'c++', 1, 197, 2, 'assignment_cpp'),
	(62, 'c++', 1, 208, 2, 'assignment_cpp'),
	(63, 'c++', 1, 209, 5, 'assignment_cpp'),
	(64, 'c++', 1, 220, 5, 'assignment_cpp'),
	(65, 'c++', 1, 224, 5, 'assignment_cpp'),
	(66, 'c++', 1, 250, 4, 'assignment_cpp');
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
