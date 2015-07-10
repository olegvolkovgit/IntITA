-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-10 16:41:41
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.phpbb_acl_groups
DROP TABLE IF EXISTS `phpbb_acl_groups`;
CREATE TABLE IF NOT EXISTS `phpbb_acl_groups` (
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_option_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_role_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_setting` tinyint(2) NOT NULL DEFAULT '0',
  KEY `group_id` (`group_id`),
  KEY `auth_opt_id` (`auth_option_id`),
  KEY `auth_role_id` (`auth_role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_acl_groups: ~22 rows (approximately)
/*!40000 ALTER TABLE `phpbb_acl_groups` DISABLE KEYS */;
INSERT INTO `phpbb_acl_groups` (`group_id`, `forum_id`, `auth_option_id`, `auth_role_id`, `auth_setting`) VALUES
	(1, 0, 88, 0, 1),
	(1, 0, 97, 0, 1),
	(1, 0, 115, 0, 1),
	(5, 0, 0, 5, 0),
	(5, 0, 0, 1, 0),
	(2, 0, 0, 6, 0),
	(3, 0, 0, 6, 0),
	(4, 0, 0, 5, 0),
	(4, 0, 0, 10, 0),
	(1, 1, 0, 17, 0),
	(2, 1, 0, 17, 0),
	(3, 1, 0, 17, 0),
	(6, 1, 0, 17, 0),
	(1, 2, 0, 17, 0),
	(2, 2, 0, 15, 0),
	(3, 2, 0, 15, 0),
	(4, 2, 0, 21, 0),
	(5, 2, 0, 14, 0),
	(5, 2, 0, 10, 0),
	(6, 2, 0, 19, 0),
	(7, 0, 0, 23, 0),
	(7, 2, 0, 24, 0);
/*!40000 ALTER TABLE `phpbb_acl_groups` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
