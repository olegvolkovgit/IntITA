-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-03 16:15:51
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.course_languages
DROP TABLE IF EXISTS `course_languages`;
CREATE TABLE IF NOT EXISTS `course_languages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lang_ua` int(10) NOT NULL,
  `lang_ru` int(10) NOT NULL,
  `lang_en` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_course_languages_course_2` (`lang_ua`),
  KEY `FK_course_languages_course` (`lang_ru`),
  KEY `FK_course_languages_course_3` (`lang_en`),
  CONSTRAINT `FK_course_languages_course` FOREIGN KEY (`lang_ru`) REFERENCES `course` (`course_ID`),
  CONSTRAINT `FK_course_languages_course_2` FOREIGN KEY (`lang_ua`) REFERENCES `course` (`course_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Table for connecting similar courses on different languages.';

-- Dumping data for table int_ita_db.course_languages: ~3 rows (approximately)
/*!40000 ALTER TABLE `course_languages` DISABLE KEYS */;
INSERT INTO `course_languages` (`id`, `lang_ua`, `lang_ru`, `lang_en`) VALUES
	(3, 1, 19, 0),
	(4, 14, 21, 0),
	(6, 13, 20, 0);
/*!40000 ALTER TABLE `course_languages` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
