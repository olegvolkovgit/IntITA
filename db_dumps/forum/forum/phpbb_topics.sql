-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-06 16:17:56
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table forum.phpbb_topics
DROP TABLE IF EXISTS `phpbb_topics`;
CREATE TABLE IF NOT EXISTS `phpbb_topics` (
  `topic_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `icon_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_attachment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_reported` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `topic_poster` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_time_limit` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_status` tinyint(3) NOT NULL DEFAULT '0',
  `topic_type` tinyint(3) NOT NULL DEFAULT '0',
  `topic_first_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_first_poster_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `topic_first_poster_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_last_poster_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_last_poster_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_poster_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_post_subject` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_post_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_last_view_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_moved_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_bumped` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_bumper` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poll_title` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `poll_start` int(11) unsigned NOT NULL DEFAULT '0',
  `poll_length` int(11) unsigned NOT NULL DEFAULT '0',
  `poll_max_options` tinyint(4) NOT NULL DEFAULT '1',
  `poll_last_vote` int(11) unsigned NOT NULL DEFAULT '0',
  `poll_vote_change` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_visibility` tinyint(3) NOT NULL DEFAULT '0',
  `topic_delete_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_delete_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_delete_user` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_posts_approved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_posts_unapproved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_posts_softdeleted` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `forum_id_type` (`forum_id`,`topic_type`),
  KEY `last_post_time` (`topic_last_post_time`),
  KEY `fid_time_moved` (`forum_id`,`topic_last_post_time`,`topic_moved_id`),
  KEY `topic_visibility` (`topic_visibility`),
  KEY `forum_vis_last` (`forum_id`,`topic_visibility`,`topic_last_post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table forum.phpbb_topics: ~13 rows (approximately)
/*!40000 ALTER TABLE `phpbb_topics` DISABLE KEYS */;
INSERT INTO `phpbb_topics` (`topic_id`, `forum_id`, `icon_id`, `topic_attachment`, `topic_reported`, `topic_title`, `topic_poster`, `topic_time`, `topic_time_limit`, `topic_views`, `topic_status`, `topic_type`, `topic_first_post_id`, `topic_first_poster_name`, `topic_first_poster_colour`, `topic_last_post_id`, `topic_last_poster_id`, `topic_last_poster_name`, `topic_last_poster_colour`, `topic_last_post_subject`, `topic_last_post_time`, `topic_last_view_time`, `topic_moved_id`, `topic_bumped`, `topic_bumper`, `poll_title`, `poll_start`, `poll_length`, `poll_max_options`, `poll_last_vote`, `poll_vote_change`, `topic_visibility`, `topic_delete_time`, `topic_delete_reason`, `topic_delete_user`, `topic_posts_approved`, `topic_posts_unapproved`, `topic_posts_softdeleted`) VALUES
	(4, 16, 0, 0, 0, 'Змінні та типи даних в PHP', 2, 1437053884, 0, 40, 0, 0, 5, 'intita', 'AA0000', 31, 125, 'potap@gmail.com', '', 'Re: Змінні та типи даних в PHP', 1438014402, 1438196911, 0, 0, 0, '', 0, 0, 1, 0, 0, 1, 0, '', 0, 6, 0, 0),
	(5, 16, 0, 0, 0, 'Основи синтаксису', 2, 1437053934, 0, 37, 0, 0, 6, 'intita', 'AA0000', 27, 45, 'Roman Melnyk', '', 'Re: Основи синтаксису', 1437389655, 1438079930, 0, 0, 0, '', 0, 0, 1, 0, 0, 1, 0, '', 0, 5, 0, 0),
	(6, 16, 0, 0, 0, 'Обробка запитів з допомогою PHP', 2, 1437053968, 0, 47, 0, 0, 7, 'intita', 'AA0000', 32, 54, 'StudentFour ', '', 'Re: Обробка запитів з допомогою PHP', 1438016568, 1438247913, 0, 0, 0, '', 0, 0, 1, 0, 0, 1, 0, '', 0, 4, 0, 0),
	(8, 15, 0, 0, 0, 'Нова тема', 22, 1437125835, 0, 8, 0, 0, 12, 'Student ', '', 12, 22, 'Student ', '', 'Нова тема', 1437125835, 1438017947, 0, 0, 0, '', 0, 0, 1, 0, 0, 1, 0, '', 0, 1, 0, 0),
	(9, 34, 0, 0, 0, 'Тема Тема', 40, 1437203534, 0, 17, 0, 0, 15, 'teacher3@gmail.com', '', 16, 40, 'teacher3@gmail.com', '', 'Re: Тема Тема', 1437203610, 1438017838, 0, 0, 0, '', 0, 0, 1, 0, 0, 1, 0, '', 0, 2, 0, 0),
	(10, 35, 0, 0, 0, 'Тема 2', 40, 1437203686, 0, 18, 0, 0, 17, 'teacher3@gmail.com', '', 18, 40, 'teacher3@gmail.com', '', '', 1437203752, 1438017910, 0, 0, 0, '', 0, 0, 1, 0, 0, 1, 0, '', 0, 2, 0, 0),
	(11, 35, 0, 0, 0, 'Тема 3', 40, 1437203781, 0, 12, 0, 0, 19, 'teacher3@gmail.com', '', 19, 40, 'teacher3@gmail.com', '', 'Тема 3', 1437203781, 1438017900, 0, 0, 0, '', 0, 0, 1, 0, 0, 1, 0, '', 0, 1, 0, 0),
	(12, 35, 0, 0, 0, 'Тема 4', 40, 1437203808, 0, 10, 0, 0, 20, 'teacher3@gmail.com', '', 20, 40, 'teacher3@gmail.com', '', 'Тема 4', 1437203808, 1438017896, 0, 0, 0, '', 0, 0, 1, 0, 0, 1, 0, '', 0, 1, 0, 0),
	(13, 35, 0, 0, 0, 'Тема 5', 40, 1437203836, 0, 7, 0, 0, 21, 'teacher3@gmail.com', '', 21, 40, 'teacher3@gmail.com', '', 'Тема 5', 1437203836, 1438017892, 0, 0, 0, '', 0, 0, 1, 0, 0, 1, 0, '', 0, 1, 0, 0),
	(14, 35, 0, 0, 0, 'тема 6', 40, 1437203856, 0, 9, 0, 0, 22, 'teacher3@gmail.com', '', 22, 40, 'teacher3@gmail.com', '', 'тема 6', 1437203856, 1438017888, 0, 0, 0, '', 0, 0, 1, 0, 0, 1, 0, '', 0, 1, 0, 0),
	(15, 35, 0, 0, 0, 'тема 7', 40, 1437204004, 0, 15, 0, 0, 23, 'teacher3@gmail.com', '', 23, 40, 'teacher3@gmail.com', '', 'тема 7', 1437204004, 1438017928, 0, 0, 0, 'Кто выиграет Суперкубок Украины?', 1437204004, 0, 1, 1438017861, 0, 1, 0, '', 0, 1, 0, 0),
	(16, 36, 0, 0, 0, 'иьмтьитьиь', 121, 1437554649, 0, 6, 0, 0, 29, 'genius ', '', 30, 38, 'teacher ', '', 'Re: иьмтьитьиь', 1437732959, 1438079915, 0, 0, 0, '', 0, 0, 1, 0, 0, 1, 0, '', 0, 2, 0, 0),
	(17, 29, 0, 0, 0, 'аочропр', 39, 1438089493, 0, 3, 0, 0, 33, 'teacher2@gmail.com', '', 33, 39, 'teacher2@gmail.com', '', 'аочропр', 1438089493, 1438242107, 0, 0, 0, '', 0, 0, 1, 0, 0, 1, 0, '', 0, 1, 0, 0);
/*!40000 ALTER TABLE `phpbb_topics` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
