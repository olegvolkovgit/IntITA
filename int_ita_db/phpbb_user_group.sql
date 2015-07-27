-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-27 18:23:29
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.phpbb_user_group
DROP TABLE IF EXISTS `phpbb_user_group`;
CREATE TABLE IF NOT EXISTS `phpbb_user_group` (
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_leader` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_pending` tinyint(1) unsigned NOT NULL DEFAULT '1',
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`),
  KEY `group_leader` (`group_leader`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_user_group: ~13 rows (approximately)
/*!40000 ALTER TABLE `phpbb_user_group` DISABLE KEYS */;
INSERT INTO `phpbb_user_group` (`group_id`, `user_id`, `group_leader`, `user_pending`) VALUES
	(1, 1, 0, 0),
	(2, 2, 0, 0),
	(4, 2, 0, 0),
	(5, 2, 1, 0),
	(2, 113, 0, 0),
	(2, 52, 0, 0),
	(2, 38, 0, 0),
	(2, 106, 0, 0),
	(2, 51, 0, 0),
	(2, 40, 0, 0),
	(2, 22, 0, 0),
	(2, 45, 0, 0),
	(2, 121, 0, 0);
/*!40000 ALTER TABLE `phpbb_user_group` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
