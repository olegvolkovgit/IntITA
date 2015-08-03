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

-- Dumping structure for table int_ita_db.task_marks
DROP TABLE IF EXISTS `task_marks`;
CREATE TABLE IF NOT EXISTS `task_marks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `id_task` int(10) NOT NULL,
  `mark` tinyint(1) NOT NULL,
  `comment` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_task_marks_user` (`id_user`),
  CONSTRAINT `FK_task_marks_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='mark : 0 - failed, 1 - success ';

-- Dumping data for table int_ita_db.task_marks: ~0 rows (approximately)
/*!40000 ALTER TABLE `task_marks` DISABLE KEYS */;
INSERT INTO `task_marks` (`id`, `id_user`, `id_task`, `mark`, `comment`) VALUES
	(1, 51, 77, 1, '');
/*!40000 ALTER TABLE `task_marks` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
