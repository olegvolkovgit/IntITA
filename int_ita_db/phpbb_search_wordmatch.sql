-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-30 17:06:31
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

-- Dumping data for table int_ita_db.phpbb_search_wordmatch: ~224 rows (approximately)
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
	(3, 74, 0),
	(5, 75, 0),
	(6, 75, 0),
	(7, 75, 0),
	(5, 76, 0),
	(6, 76, 0),
	(7, 76, 0),
	(5, 77, 0),
	(5, 77, 1),
	(8, 77, 0),
	(8, 77, 1),
	(9, 77, 0),
	(9, 77, 1),
	(13, 77, 1),
	(14, 77, 1),
	(31, 77, 1),
	(5, 78, 0),
	(5, 78, 1),
	(8, 78, 0),
	(8, 78, 1),
	(9, 78, 0),
	(9, 78, 1),
	(13, 78, 1),
	(14, 78, 1),
	(31, 78, 1),
	(5, 79, 0),
	(5, 79, 1),
	(8, 79, 0),
	(8, 79, 1),
	(9, 79, 0),
	(9, 79, 1),
	(13, 79, 1),
	(14, 79, 1),
	(15, 79, 0),
	(31, 79, 1),
	(5, 80, 0),
	(5, 80, 1),
	(7, 80, 0),
	(7, 80, 1),
	(8, 80, 1),
	(9, 80, 1),
	(11, 80, 0),
	(13, 80, 1),
	(14, 80, 1),
	(24, 80, 1),
	(25, 80, 0),
	(26, 80, 0),
	(28, 80, 1),
	(31, 80, 1),
	(32, 80, 1),
	(6, 81, 0),
	(6, 81, 1),
	(11, 81, 1),
	(25, 81, 1),
	(26, 81, 1),
	(27, 81, 1),
	(6, 82, 0),
	(6, 82, 1),
	(11, 82, 1),
	(25, 82, 1),
	(26, 82, 1),
	(27, 82, 1),
	(7, 83, 0),
	(7, 83, 1),
	(24, 83, 1),
	(28, 83, 1),
	(32, 83, 1),
	(7, 84, 0),
	(7, 84, 1),
	(24, 84, 1),
	(28, 84, 1),
	(32, 84, 0),
	(32, 84, 1),
	(7, 85, 0),
	(7, 85, 1),
	(24, 85, 1),
	(28, 85, 1),
	(32, 85, 1),
	(8, 86, 0),
	(9, 86, 0),
	(8, 87, 0),
	(9, 87, 0),
	(9, 88, 0),
	(9, 89, 0),
	(10, 90, 0),
	(10, 91, 1),
	(11, 92, 0),
	(25, 92, 0),
	(26, 92, 0),
	(11, 93, 0),
	(25, 93, 0),
	(26, 93, 0),
	(11, 94, 0),
	(25, 94, 0),
	(26, 94, 0),
	(12, 95, 0),
	(12, 95, 1),
	(12, 96, 0),
	(12, 96, 1),
	(15, 96, 1),
	(16, 96, 1),
	(17, 96, 1),
	(19, 96, 1),
	(20, 96, 1),
	(21, 96, 1),
	(22, 96, 1),
	(23, 96, 1),
	(13, 97, 0),
	(13, 98, 0),
	(14, 99, 0),
	(14, 100, 0),
	(15, 101, 0),
	(15, 102, 0),
	(16, 103, 0),
	(17, 104, 0),
	(17, 105, 0),
	(17, 106, 0),
	(17, 107, 0),
	(17, 108, 0),
	(17, 109, 0),
	(17, 110, 0),
	(17, 111, 0),
	(17, 112, 0),
	(17, 113, 0),
	(18, 114, 0),
	(18, 115, 0),
	(19, 116, 0),
	(20, 117, 0),
	(21, 118, 0),
	(22, 119, 0),
	(23, 120, 0),
	(24, 121, 0),
	(25, 122, 0),
	(25, 123, 0),
	(26, 124, 0),
	(26, 125, 0),
	(27, 126, 0),
	(28, 126, 0),
	(29, 127, 0),
	(29, 128, 1),
	(30, 128, 1),
	(30, 129, 0),
	(31, 130, 0),
	(32, 131, 0),
	(32, 132, 0),
	(32, 133, 0),
	(33, 134, 0),
	(33, 135, 1);
/*!40000 ALTER TABLE `phpbb_search_wordmatch` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
