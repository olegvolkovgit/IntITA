-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-17 18:30:20
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.task_marks
DROP TABLE IF EXISTS `task_marks`;
CREATE TABLE IF NOT EXISTS `task_marks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `id_task` int(10) NOT NULL,
  `mark` tinyint(1) NOT NULL,
  `result` varchar(255) NOT NULL,
  `warning` varchar(255) NOT NULL,
  `date` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_task_marks_user` (`id_user`),
  KEY `FK_task_marks_task` (`id_task`),
  CONSTRAINT `FK_task_marks_task` FOREIGN KEY (`id_task`) REFERENCES `task` (`id`),
  CONSTRAINT `FK_task_marks_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='mark : 0 - failed, 1 - done ';

-- Dumping data for table int_ita_db.task_marks: ~0 rows (approximately)
/*!40000 ALTER TABLE `task_marks` DISABLE KEYS */;
/*!40000 ALTER TABLE `task_marks` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
