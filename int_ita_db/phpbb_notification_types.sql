-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-05 00:14:36
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.phpbb_notification_types
DROP TABLE IF EXISTS `phpbb_notification_types`;
CREATE TABLE IF NOT EXISTS `phpbb_notification_types` (
  `notification_type_id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `notification_type_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `notification_type_enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`notification_type_id`),
  UNIQUE KEY `type` (`notification_type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_notification_types: ~8 rows (approximately)
/*!40000 ALTER TABLE `phpbb_notification_types` DISABLE KEYS */;
INSERT INTO `phpbb_notification_types` (`notification_type_id`, `notification_type_name`, `notification_type_enabled`) VALUES
	(1, 'notification.type.topic', 1),
	(2, 'notification.type.approve_topic', 1),
	(3, 'notification.type.quote', 1),
	(4, 'notification.type.bookmark', 1),
	(5, 'notification.type.post', 1),
	(6, 'notification.type.approve_post', 1),
	(7, 'notification.type.group_request', 1),
	(8, 'notification.type.post_in_queue', 1);
/*!40000 ALTER TABLE `phpbb_notification_types` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
