-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-20 16:13:47
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

-- Dumping data for table int_ita_db.phpbb_user_group: ~49 rows (approximately)
/*!40000 ALTER TABLE `phpbb_user_group` DISABLE KEYS */;
INSERT INTO `phpbb_user_group` (`group_id`, `user_id`, `group_leader`, `user_pending`) VALUES
	(1, 1, 0, 0),
	(2, 2, 0, 0),
	(4, 2, 0, 0),
	(5, 2, 1, 0),
	(6, 3, 0, 0),
	(6, 4, 0, 0),
	(6, 5, 0, 0),
	(6, 6, 0, 0),
	(6, 7, 0, 0),
	(6, 8, 0, 0),
	(6, 9, 0, 0),
	(6, 10, 0, 0),
	(6, 11, 0, 0),
	(6, 12, 0, 0),
	(6, 13, 0, 0),
	(6, 14, 0, 0),
	(6, 15, 0, 0),
	(6, 16, 0, 0),
	(6, 17, 0, 0),
	(6, 18, 0, 0),
	(6, 19, 0, 0),
	(6, 20, 0, 0),
	(6, 21, 0, 0),
	(6, 22, 0, 0),
	(6, 23, 0, 0),
	(6, 24, 0, 0),
	(6, 25, 0, 0),
	(6, 26, 0, 0),
	(6, 27, 0, 0),
	(6, 28, 0, 0),
	(6, 29, 0, 0),
	(6, 30, 0, 0),
	(6, 31, 0, 0),
	(6, 32, 0, 0),
	(6, 33, 0, 0),
	(6, 34, 0, 0),
	(6, 35, 0, 0),
	(6, 36, 0, 0),
	(6, 37, 0, 0),
	(6, 38, 0, 0),
	(6, 39, 0, 0),
	(6, 40, 0, 0),
	(6, 41, 0, 0),
	(6, 42, 0, 0),
	(6, 43, 0, 0),
	(6, 44, 0, 0),
	(6, 45, 0, 0),
	(6, 46, 0, 0),
	(6, 47, 0, 0),
	(2, 48, 0, 0),
	(7, 48, 0, 0);
/*!40000 ALTER TABLE `phpbb_user_group` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
