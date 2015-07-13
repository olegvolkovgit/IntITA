-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-13 17:03:53
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.task
DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_lecture` int(11) NOT NULL,
  `language` varchar(15) NOT NULL,
  `assignment` int(10) NOT NULL,
  `condition` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_task_lectures` (`id_lecture`),
  KEY `FK_task_teacher` (`author`),
  KEY `FK_task_lecture_element` (`condition`),
  CONSTRAINT `FK_task_lecture_element` FOREIGN KEY (`condition`) REFERENCES `lecture_element` (`id_block`),
  CONSTRAINT `FK_task_lectures` FOREIGN KEY (`id_lecture`) REFERENCES `lectures` (`id`),
  CONSTRAINT `FK_task_teacher` FOREIGN KEY (`author`) REFERENCES `teacher` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Lectures tasks.\r\n';

-- Dumping data for table int_ita_db.task: ~0 rows (approximately)
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
