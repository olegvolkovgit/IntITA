-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-06 16:18:22
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table intita.module_languages
DROP TABLE IF EXISTS `module_languages`;
CREATE TABLE IF NOT EXISTS `module_languages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lang_ua` int(10) NOT NULL,
  `lang_ru` int(10) NOT NULL,
  `lang_en` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_module_languages_course` (`lang_ua`),
  KEY `FK_module_languages_course_2` (`lang_ru`),
  CONSTRAINT `FK_module_languages_course` FOREIGN KEY (`lang_ua`) REFERENCES `module` (`module_ID`),
  CONSTRAINT `FK_module_languages_course_2` FOREIGN KEY (`lang_ru`) REFERENCES `module` (`module_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table intita.module_languages: ~10 rows (approximately)
/*!40000 ALTER TABLE `module_languages` DISABLE KEYS */;
INSERT INTO `module_languages` (`id`, `lang_ua`, `lang_ru`, `lang_en`) VALUES
	(1, 1, 62, 0),
	(2, 2, 63, 0),
	(3, 3, 64, 0),
	(5, 4, 65, 0),
	(6, 7, 66, 0),
	(7, 18, 72, 0),
	(8, 55, 77, 0),
	(9, 54, 76, 0),
	(10, 56, 78, 0),
	(11, 10, 68, 0);
/*!40000 ALTER TABLE `module_languages` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
