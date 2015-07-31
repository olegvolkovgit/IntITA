-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-31 18:15:54
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.leader_modules
DROP TABLE IF EXISTS `leader_modules`;
CREATE TABLE IF NOT EXISTS `leader_modules` (
  `leader` int(10) NOT NULL,
  `module` int(10) NOT NULL,
  KEY `FK_leader_modules_teacher` (`leader`),
  KEY `FK_leader_modules_module` (`module`),
  CONSTRAINT `FK_leader_modules_module` FOREIGN KEY (`module`) REFERENCES `module` (`module_ID`),
  CONSTRAINT `FK_leader_modules_teacher` FOREIGN KEY (`leader`) REFERENCES `teacher` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.leader_modules: ~7 rows (approximately)
/*!40000 ALTER TABLE `leader_modules` DISABLE KEYS */;
INSERT INTO `leader_modules` (`leader`, `module`) VALUES
	(5, 54),
	(5, 18),
	(5, 56),
	(6, 7),
	(6, 56),
	(6, 54),
	(6, 16);
/*!40000 ALTER TABLE `leader_modules` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
