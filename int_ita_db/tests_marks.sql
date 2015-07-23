-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-22 19:38:57
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.tests_marks
DROP TABLE IF EXISTS `tests_marks`;
CREATE TABLE IF NOT EXISTS `tests_marks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `id_test` int(10) NOT NULL,
  `mark` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tests_marks_user` (`id_user`),
  KEY `FK_tests_marks_tests` (`id_test`),
  CONSTRAINT `FK_tests_marks_tests` FOREIGN KEY (`id_test`) REFERENCES `tests` (`id`),
  CONSTRAINT `FK_tests_marks_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COMMENT='mark: 0 - failed, 1 - success';

-- Dumping data for table int_ita_db.tests_marks: ~38 rows (approximately)
/*!40000 ALTER TABLE `tests_marks` DISABLE KEYS */;
INSERT INTO `tests_marks` (`id`, `id_user`, `id_test`, `mark`) VALUES
	(14, 51, 35, 1),
	(15, 51, 35, 1),
	(16, 51, 35, 1),
	(17, 51, 35, 1),
	(18, 51, 35, 0),
	(19, 51, 35, 0),
	(20, 51, 35, 1),
	(21, 51, 35, 0),
	(22, 51, 35, 1),
	(23, 51, 36, 0),
	(24, 51, 36, 1),
	(25, 51, 36, 1),
	(26, 51, 36, 1),
	(27, 51, 36, 0),
	(28, 51, 36, 1),
	(29, 51, 36, 1),
	(30, 51, 36, 1),
	(31, 51, 36, 1),
	(32, 51, 36, 1),
	(33, 51, 36, 1),
	(34, 51, 36, 1),
	(35, 51, 36, 0),
	(36, 51, 36, 0),
	(37, 51, 36, 1),
	(38, 51, 35, 1),
	(39, 51, 35, 1),
	(40, 51, 35, 1),
	(41, 51, 35, 0),
	(42, 51, 36, 1),
	(43, 51, 35, 1),
	(44, 51, 35, 0),
	(45, 51, 36, 1),
	(46, 51, 35, 1),
	(47, 51, 35, 1),
	(48, 51, 35, 0),
	(49, 51, 35, 1),
	(50, 51, 36, 1),
	(51, 51, 36, 0);
/*!40000 ALTER TABLE `tests_marks` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
