-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-23 17:46:17
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.phpbb_search_wordmatch
DROP TABLE IF EXISTS `phpbb_search_wordmatch`;
CREATE TABLE IF NOT EXISTS `phpbb_search_wordmatch` (
  `post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `word_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title_match` tinyint(1) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `un_mtch` (`word_id`,`post_id`,`title_match`),
  KEY `word_id` (`word_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_search_wordmatch: ~70 rows (approximately)
/*!40000 ALTER TABLE `phpbb_search_wordmatch` DISABLE KEYS */;
INSERT INTO `phpbb_search_wordmatch` (`post_id`, `word_id`, `title_match`) VALUES
	(1, 1, 0),
	(1, 2, 0),
	(1, 3, 0),
	(1, 4, 0),
	(1, 4, 1),
	(1, 5, 0),
	(1, 6, 0),
	(1, 7, 0),
	(1, 8, 0),
	(1, 9, 0),
	(1, 10, 0),
	(1, 11, 0),
	(1, 12, 0),
	(1, 13, 0),
	(1, 14, 0),
	(1, 15, 0),
	(1, 16, 0),
	(1, 17, 0),
	(1, 18, 0),
	(1, 19, 0),
	(1, 20, 0),
	(1, 21, 0),
	(1, 22, 0),
	(1, 23, 0),
	(1, 24, 0),
	(1, 25, 0),
	(1, 26, 0),
	(1, 27, 0),
	(1, 28, 0),
	(1, 29, 0),
	(1, 30, 0),
	(1, 31, 0),
	(1, 32, 0),
	(1, 33, 0),
	(1, 34, 0),
	(1, 35, 0),
	(1, 36, 0),
	(1, 37, 0),
	(1, 38, 0),
	(1, 39, 0),
	(1, 40, 0),
	(1, 41, 0),
	(1, 42, 0),
	(1, 43, 0),
	(1, 44, 0),
	(1, 45, 0),
	(1, 46, 0),
	(1, 47, 0),
	(1, 48, 0),
	(1, 49, 0),
	(1, 50, 0),
	(1, 51, 0),
	(1, 52, 0),
	(1, 53, 0),
	(1, 54, 0),
	(1, 55, 0),
	(1, 56, 0),
	(1, 57, 0),
	(1, 58, 0),
	(1, 59, 0),
	(1, 60, 0),
	(1, 61, 0),
	(1, 62, 0),
	(1, 63, 1),
	(1, 64, 1),
	(2, 65, 0),
	(2, 66, 0),
	(2, 67, 0),
	(2, 68, 0),
	(2, 69, 1),
	(3, 70, 0),
	(3, 71, 0),
	(3, 72, 0),
	(3, 72, 1),
	(4, 72, 1),
	(3, 73, 0),
	(3, 74, 0);
/*!40000 ALTER TABLE `phpbb_search_wordmatch` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
