-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-17 18:30:18
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.pay_courses
DROP TABLE IF EXISTS `pay_courses`;
CREATE TABLE IF NOT EXISTS `pay_courses` (
  `id_user` int(10) NOT NULL,
  `id_course` int(10) NOT NULL,
  `rights` tinyint(10) NOT NULL,
  KEY `FK_pay_course_user` (`id_user`),
  KEY `FK_pay_course_course` (`id_course`),
  CONSTRAINT `FK_pay_course_course` FOREIGN KEY (`id_course`) REFERENCES `course` (`course_ID`),
  CONSTRAINT `FK_pay_course_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User rights for courses: TINYINT(10) \r\n0 - read\r\n1 - edit\r\n2 - create\r\n3 - delete  ';

-- Dumping data for table int_ita_db.pay_courses: ~4 rows (approximately)
/*!40000 ALTER TABLE `pay_courses` DISABLE KEYS */;
INSERT INTO `pay_courses` (`id_user`, `id_course`, `rights`) VALUES
	(38, 1, 1),
	(46, 6, 1),
	(51, 4, 1),
	(22, 3, 1);
/*!40000 ALTER TABLE `pay_courses` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
