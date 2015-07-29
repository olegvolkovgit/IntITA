-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-29 20:33:48
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.phpbb_icons
DROP TABLE IF EXISTS `phpbb_icons`;
CREATE TABLE IF NOT EXISTS `phpbb_icons` (
  `icons_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `icons_url` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `icons_width` tinyint(4) NOT NULL DEFAULT '0',
  `icons_height` tinyint(4) NOT NULL DEFAULT '0',
  `icons_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `display_on_posting` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`icons_id`),
  KEY `display_on_posting` (`display_on_posting`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_icons: ~10 rows (approximately)
/*!40000 ALTER TABLE `phpbb_icons` DISABLE KEYS */;
INSERT INTO `phpbb_icons` (`icons_id`, `icons_url`, `icons_width`, `icons_height`, `icons_order`, `display_on_posting`) VALUES
	(1, 'misc/fire.gif', 16, 16, 1, 1),
	(2, 'smile/redface.gif', 16, 16, 9, 1),
	(3, 'smile/mrgreen.gif', 16, 16, 10, 1),
	(4, 'misc/heart.gif', 16, 16, 4, 1),
	(5, 'misc/star.gif', 16, 16, 2, 1),
	(6, 'misc/radioactive.gif', 16, 16, 3, 1),
	(7, 'misc/thinking.gif', 16, 16, 5, 1),
	(8, 'smile/info.gif', 16, 16, 8, 1),
	(9, 'smile/question.gif', 16, 16, 6, 1),
	(10, 'smile/alert.gif', 16, 16, 7, 1);
/*!40000 ALTER TABLE `phpbb_icons` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
