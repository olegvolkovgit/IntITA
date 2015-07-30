-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-30 17:06:26
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.consultant_modules
DROP TABLE IF EXISTS `consultant_modules`;
CREATE TABLE IF NOT EXISTS `consultant_modules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `consultant` int(10) NOT NULL,
  `module` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__teacher` (`consultant`),
  KEY `FK__module` (`module`),
  CONSTRAINT `FK__module` FOREIGN KEY (`module`) REFERENCES `module` (`module_ID`),
  CONSTRAINT `FK__teacher` FOREIGN KEY (`consultant`) REFERENCES `teacher` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.consultant_modules: ~6 rows (approximately)
/*!40000 ALTER TABLE `consultant_modules` DISABLE KEYS */;
INSERT INTO `consultant_modules` (`id`, `consultant`, `module`) VALUES
	(1, 1, 1),
	(2, 2, 1),
	(3, 3, 1),
	(4, 4, 2),
	(5, 5, 4),
	(6, 6, 3);
/*!40000 ALTER TABLE `consultant_modules` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
