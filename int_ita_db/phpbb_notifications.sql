-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-29 18:48:09
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.phpbb_notifications
DROP TABLE IF EXISTS `phpbb_notifications`;
CREATE TABLE IF NOT EXISTS `phpbb_notifications` (
  `notification_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notification_type_id` smallint(4) unsigned NOT NULL DEFAULT '0',
  `item_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `item_parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `notification_read` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `notification_time` int(11) unsigned NOT NULL DEFAULT '1',
  `notification_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`notification_id`),
  KEY `item_ident` (`notification_type_id`,`item_id`),
  KEY `user` (`user_id`,`notification_read`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_notifications: ~3 rows (approximately)
/*!40000 ALTER TABLE `phpbb_notifications` DISABLE KEYS */;
INSERT INTO `phpbb_notifications` (`notification_id`, `notification_type_id`, `item_id`, `item_parent_id`, `user_id`, `notification_read`, `notification_time`, `notification_data`) VALUES
	(2, 6, 4, 3, 48, 0, 1433430282, 'a:6:{s:12:"post_subject";s:18:"Re: 4 червня";s:9:"poster_id";s:2:"48";s:11:"topic_title";s:14:"4 червня";s:13:"post_username";s:0:"";s:8:"forum_id";s:1:"2";s:10:"forum_name";s:30:"Ваш перший форум";}'),
	(3, 3, 25, 5, 2, 0, 1437220140, 'a:6:{s:9:"poster_id";i:22;s:11:"topic_title";s:33:"Основи синтаксису";s:12:"post_subject";s:37:"Re: Основи синтаксису";s:13:"post_username";s:0:"";s:8:"forum_id";i:16;s:10:"forum_name";s:42:"Вступ до програмування";}'),
	(4, 3, 26, 5, 2, 0, 1437220304, 'a:6:{s:9:"poster_id";i:38;s:11:"topic_title";s:33:"Основи синтаксису";s:12:"post_subject";s:37:"Re: Основи синтаксису";s:13:"post_username";s:0:"";s:8:"forum_id";i:16;s:10:"forum_name";s:42:"Вступ до програмування";}');
/*!40000 ALTER TABLE `phpbb_notifications` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
