-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-05 00:14:34
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.phpbb_extension_groups
DROP TABLE IF EXISTS `phpbb_extension_groups`;
CREATE TABLE IF NOT EXISTS `phpbb_extension_groups` (
  `group_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `cat_id` tinyint(2) NOT NULL DEFAULT '0',
  `allow_group` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `download_mode` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `upload_icon` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `max_filesize` int(20) unsigned NOT NULL DEFAULT '0',
  `allowed_forums` text COLLATE utf8_bin NOT NULL,
  `allow_in_pm` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_extension_groups: ~9 rows (approximately)
/*!40000 ALTER TABLE `phpbb_extension_groups` DISABLE KEYS */;
INSERT INTO `phpbb_extension_groups` (`group_id`, `group_name`, `cat_id`, `allow_group`, `download_mode`, `upload_icon`, `max_filesize`, `allowed_forums`, `allow_in_pm`) VALUES
	(1, 'IMAGES', 1, 1, 1, '', 0, '', 0),
	(2, 'ARCHIVES', 0, 1, 1, '', 0, '', 0),
	(3, 'PLAIN_TEXT', 0, 0, 1, '', 0, '', 0),
	(4, 'DOCUMENTS', 0, 0, 1, '', 0, '', 0),
	(5, 'REAL_MEDIA', 3, 0, 1, '', 0, '', 0),
	(6, 'WINDOWS_MEDIA', 2, 0, 1, '', 0, '', 0),
	(7, 'FLASH_FILES', 5, 0, 1, '', 0, '', 0),
	(8, 'QUICKTIME_MEDIA', 6, 0, 1, '', 0, '', 0),
	(9, 'DOWNLOADABLE_FILES', 0, 0, 1, '', 0, '', 0);
/*!40000 ALTER TABLE `phpbb_extension_groups` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
