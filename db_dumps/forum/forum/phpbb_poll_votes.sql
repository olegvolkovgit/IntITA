-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-06 16:17:55
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table forum.phpbb_poll_votes
DROP TABLE IF EXISTS `phpbb_poll_votes`;
CREATE TABLE IF NOT EXISTS `phpbb_poll_votes` (
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poll_option_id` tinyint(4) NOT NULL DEFAULT '0',
  `vote_user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `vote_user_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  KEY `topic_id` (`topic_id`),
  KEY `vote_user_id` (`vote_user_id`),
  KEY `vote_user_ip` (`vote_user_ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table forum.phpbb_poll_votes: ~1 rows (approximately)
/*!40000 ALTER TABLE `phpbb_poll_votes` DISABLE KEYS */;
INSERT INTO `phpbb_poll_votes` (`topic_id`, `poll_option_id`, `vote_user_id`, `vote_user_ip`) VALUES
	(15, 1, 54, '81.30.164.98');
/*!40000 ALTER TABLE `phpbb_poll_votes` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
