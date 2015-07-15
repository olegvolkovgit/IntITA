-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-15 17:37:18
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
  PRIMARY KEY (`id`),
  KEY `FK_task_lecture_element` (`condition`),
  KEY `FK_task_teacher` (`author`),
  CONSTRAINT `FK_task_teacher` FOREIGN KEY (`author`) REFERENCES `teacher` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='Lectures tasks.\r\n';

-- Dumping data for table int_ita_db.task: ~8 rows (approximately)
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` (`id`, `language`, `assignment`, `condition`, `author`) VALUES
	(18, 'c++', 0, 115, 1),
	(19, 'c++', 0, 116, 1),
	(20, 'c++', 0, 118, 1),
	(21, 'c++', 0, 119, 1),
	(22, 'c++', 0, 120, 1),
	(23, 'c++', 0, 121, 1),
	(24, 'c++', 10, 124, 1),
	(25, 'c++', 10, 125, 1);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
