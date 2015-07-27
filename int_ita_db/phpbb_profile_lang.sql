-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-27 18:55:16
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.phpbb_profile_lang
DROP TABLE IF EXISTS `phpbb_profile_lang`;
CREATE TABLE IF NOT EXISTS `phpbb_profile_lang` (
  `field_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `lang_explain` text COLLATE utf8_bin NOT NULL,
  `lang_default_value` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`field_id`,`lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_profile_lang: ~26 rows (approximately)
/*!40000 ALTER TABLE `phpbb_profile_lang` DISABLE KEYS */;
INSERT INTO `phpbb_profile_lang` (`field_id`, `lang_id`, `lang_name`, `lang_explain`, `lang_default_value`) VALUES
	(1, 1, 'LOCATION', '', ''),
	(1, 2, 'LOCATION', '', ''),
	(2, 1, 'WEBSITE', '', ''),
	(2, 2, 'WEBSITE', '', ''),
	(3, 1, 'INTERESTS', '', ''),
	(3, 2, 'INTERESTS', '', ''),
	(4, 1, 'OCCUPATION', '', ''),
	(4, 2, 'OCCUPATION', '', ''),
	(5, 1, 'AOL', '', ''),
	(5, 2, 'AOL', '', ''),
	(6, 1, 'ICQ', '', ''),
	(6, 2, 'ICQ', '', ''),
	(7, 1, 'WLM', '', ''),
	(7, 2, 'WLM', '', ''),
	(8, 1, 'YAHOO', '', ''),
	(8, 2, 'YAHOO', '', ''),
	(9, 1, 'FACEBOOK', '', ''),
	(9, 2, 'FACEBOOK', '', ''),
	(10, 1, 'TWITTER', '', ''),
	(10, 2, 'TWITTER', '', ''),
	(11, 1, 'SKYPE', '', ''),
	(11, 2, 'SKYPE', '', ''),
	(12, 1, 'YOUTUBE', '', ''),
	(12, 2, 'YOUTUBE', '', ''),
	(13, 1, 'GOOGLEPLUS', '', ''),
	(13, 2, 'GOOGLEPLUS', '', '');
/*!40000 ALTER TABLE `phpbb_profile_lang` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
