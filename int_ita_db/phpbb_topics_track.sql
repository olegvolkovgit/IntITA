-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-24 18:27:55
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.phpbb_topics_track
DROP TABLE IF EXISTS `phpbb_topics_track`;
CREATE TABLE IF NOT EXISTS `phpbb_topics_track` (
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `mark_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_topics_track: ~16 rows (approximately)
/*!40000 ALTER TABLE `phpbb_topics_track` DISABLE KEYS */;
INSERT INTO `phpbb_topics_track` (`user_id`, `topic_id`, `forum_id`, `mark_time`) VALUES
	(2, 5, 16, 1437055279),
	(22, 4, 16, 1437166713),
	(22, 5, 16, 1437220304),
	(22, 8, 15, 1437125835),
	(38, 5, 16, 1437220304),
	(38, 6, 16, 1437389787),
	(38, 16, 36, 1437732959),
	(40, 4, 16, 1437054417),
	(40, 6, 16, 1437219404),
	(40, 7, 16, 1437054945),
	(40, 9, 34, 1437203610),
	(40, 15, 35, 1437204004),
	(45, 5, 16, 1437389655),
	(45, 6, 16, 1437389787),
	(51, 4, 16, 1437054093),
	(121, 16, 36, 1437554649);
/*!40000 ALTER TABLE `phpbb_topics_track` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
