-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-27 18:55:16
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.phpbb_forums
DROP TABLE IF EXISTS `phpbb_forums`;
CREATE TABLE IF NOT EXISTS `phpbb_forums` (
  `forum_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `left_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `right_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_parents` mediumtext COLLATE utf8_bin NOT NULL,
  `forum_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_desc` text COLLATE utf8_bin NOT NULL,
  `forum_desc_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_desc_options` int(11) unsigned NOT NULL DEFAULT '7',
  `forum_desc_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_link` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_password` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_style` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_image` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_rules` text COLLATE utf8_bin NOT NULL,
  `forum_rules_link` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_rules_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_rules_options` int(11) unsigned NOT NULL DEFAULT '7',
  `forum_rules_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_topics_per_page` tinyint(4) NOT NULL DEFAULT '0',
  `forum_type` tinyint(4) NOT NULL DEFAULT '0',
  `forum_status` tinyint(4) NOT NULL DEFAULT '0',
  `forum_last_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_last_poster_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_last_post_subject` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_last_post_time` int(11) unsigned NOT NULL DEFAULT '0',
  `forum_last_poster_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_last_poster_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_flags` tinyint(4) NOT NULL DEFAULT '32',
  `display_on_index` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_indexing` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_icons` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_prune` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `prune_next` int(11) unsigned NOT NULL DEFAULT '0',
  `prune_days` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `prune_viewed` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `prune_freq` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `display_subforum_list` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `forum_options` int(20) unsigned NOT NULL DEFAULT '0',
  `enable_shadow_prune` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `prune_shadow_days` mediumint(8) unsigned NOT NULL DEFAULT '7',
  `prune_shadow_freq` mediumint(8) unsigned NOT NULL DEFAULT '1',
  `prune_shadow_next` int(11) NOT NULL DEFAULT '0',
  `forum_posts_approved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_posts_unapproved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_posts_softdeleted` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_topics_approved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_topics_unapproved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_topics_softdeleted` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`forum_id`),
  KEY `left_right_id` (`left_id`,`right_id`),
  KEY `forum_lastpost_id` (`forum_last_post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_forums: ~32 rows (approximately)
/*!40000 ALTER TABLE `phpbb_forums` DISABLE KEYS */;
INSERT INTO `phpbb_forums` (`forum_id`, `parent_id`, `left_id`, `right_id`, `forum_parents`, `forum_name`, `forum_desc`, `forum_desc_bitfield`, `forum_desc_options`, `forum_desc_uid`, `forum_link`, `forum_password`, `forum_style`, `forum_image`, `forum_rules`, `forum_rules_link`, `forum_rules_bitfield`, `forum_rules_options`, `forum_rules_uid`, `forum_topics_per_page`, `forum_type`, `forum_status`, `forum_last_post_id`, `forum_last_poster_id`, `forum_last_post_subject`, `forum_last_post_time`, `forum_last_poster_name`, `forum_last_poster_colour`, `forum_flags`, `display_on_index`, `enable_indexing`, `enable_icons`, `enable_prune`, `prune_next`, `prune_days`, `prune_viewed`, `prune_freq`, `display_subforum_list`, `forum_options`, `enable_shadow_prune`, `prune_shadow_days`, `prune_shadow_freq`, `prune_shadow_next`, `forum_posts_approved`, `forum_posts_unapproved`, `forum_posts_softdeleted`, `forum_topics_approved`, `forum_topics_unapproved`, `forum_topics_softdeleted`) VALUES
	(15, 0, 1, 34, '', 'Інтернет програміст (РНР)', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 12, 22, 'Нова тема', 1437125835, 'Student ', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 1, 0, 0, 1, 0, 0),
	(16, 15, 2, 3, 'a:1:{i:15;a:2:{i:0;s:46:"Інтернет програміст (РНР)";i:1;i:1;}}', 'Вступ до програмування', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 28, 45, 'Re: Обробка запитів з допомогою PHP', 1437389787, 'Roman Melnyk', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 14, 0, 0, 4, 0, 0),
	(17, 15, 6, 7, 'a:1:{i:15;a:2:{i:0;s:46:"Інтернет програміст (РНР)";i:1;i:1;}}', 'Алгоритмізація і програмування на мові С', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(18, 0, 35, 36, '', 'Програміст (Java)', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(19, 0, 37, 38, '', 'Програміст (С++)', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(20, 0, 39, 46, '', 'Англійська мова для ІТ', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(21, 0, 47, 54, '', 'Побудова успішної ІТ кар’єри', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(24, 0, 55, 56, '', 'Тестувальник (QA)', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(25, 0, 57, 58, '', 'Програміст (C#)', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(26, 0, 59, 60, '', 'Тестувальник (QA)', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(27, 0, 61, 62, '', 'Програміст (Objective С)', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(28, 0, 63, 64, '', 'Верстальник сайтів (HTML, CSS)', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(29, 15, 4, 5, 'a:1:{i:15;a:2:{i:0;s:46:"Інтернет програміст (РНР)";i:1;i:1;}}', 'Елементарна математика', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(30, 15, 8, 9, 'a:1:{i:15;a:2:{i:0;s:46:"Інтернет програміст (РНР)";i:1;i:1;}}', 'Елементи вищої математики', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(31, 15, 10, 11, 'a:1:{i:15;a:2:{i:0;s:46:"Інтернет програміст (РНР)";i:1;i:1;}}', 'Комп\'ютерні мережі', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(32, 15, 12, 13, 'a:1:{i:15;a:2:{i:0;s:46:"Інтернет програміст (РНР)";i:1;i:1;}}', 'Розробка та аналіз алгоритмів. Комбінаторні алгоритми', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(33, 15, 14, 15, 'a:1:{i:15;a:2:{i:0;s:46:"Інтернет програміст (РНР)";i:1;i:1;}}', 'Дискретна математика', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(34, 15, 16, 17, 'a:1:{i:15;a:2:{i:0;s:46:"Інтернет програміст (РНР)";i:1;i:1;}}', 'Бази даних ( Частина 1)', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 16, 40, 'Re: Тема Тема', 1437203610, 'teacher3@gmail.com', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 2, 0, 0, 1, 0, 0),
	(35, 15, 18, 19, 'a:1:{i:15;a:2:{i:0;s:46:"Інтернет програміст (РНР)";i:1;i:1;}}', 'Бази даних ( Частина 2)', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 23, 40, 'тема 7', 1437204004, 'teacher3@gmail.com', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 7, 0, 0, 6, 0, 0),
	(36, 15, 20, 21, 'a:1:{i:15;a:2:{i:0;s:46:"Інтернет програміст (РНР)";i:1;i:1;}}', 'Програмування на PHP (Частина 1)', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 30, 38, 'Re: иьмтьитьиь', 1437732959, 'teacher ', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 2, 0, 0, 1, 0, 0),
	(37, 15, 22, 23, 'a:1:{i:15;a:2:{i:0;s:46:"Інтернет програміст (РНР)";i:1;i:1;}}', 'Регулярні вирази', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(38, 15, 24, 25, 'a:1:{i:15;a:2:{i:0;s:46:"Інтернет програміст (РНР)";i:1;i:1;}}', 'Програмування на PHP (Частина 2)', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(39, 15, 26, 27, 'a:1:{i:15;a:2:{i:0;s:46:"Інтернет програміст (РНР)";i:1;i:1;}}', 'Верстка на HTML, CSS', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(40, 15, 28, 29, 'a:1:{i:15;a:2:{i:0;s:46:"Інтернет програміст (РНР)";i:1;i:1;}}', 'Програмування на JavaScript', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(41, 15, 30, 31, 'a:1:{i:15;a:2:{i:0;s:46:"Інтернет програміст (РНР)";i:1;i:1;}}', 'Сучасні технології розробки програм', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(42, 15, 32, 33, 'a:1:{i:15;a:2:{i:0;s:46:"Інтернет програміст (РНР)";i:1;i:1;}}', 'Командний дипломний проект', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(43, 20, 40, 41, 'a:1:{i:20;a:2:{i:0;s:41:"Англійська мова для ІТ";i:1;i:1;}}', 'For beginners', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(44, 20, 42, 43, 'a:1:{i:20;a:2:{i:0;s:41:"Англійська мова для ІТ";i:1;i:1;}}', 'Pre Intermediate', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(45, 20, 44, 45, 'a:1:{i:20;a:2:{i:0;s:41:"Англійська мова для ІТ";i:1;i:1;}}', 'Intermediate', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(46, 21, 48, 49, 'a:1:{i:21;a:2:{i:0;s:54:"Побудова успішної ІТ кар’єри";i:1;i:1;}}', 'Побудова індивідуального плану успішної ІТ кар’єри.', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(47, 21, 50, 51, 'a:1:{i:21;a:2:{i:0;s:54:"Побудова успішної ІТ кар’єри";i:1;i:1;}}', 'Ефективне працевлаштування.', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0),
	(48, 21, 52, 53, 'a:1:{i:21;a:2:{i:0;s:54:"Побудова успішної ІТ кар’єри";i:1;i:1;}}', 'Психологія успіху', '', '', 7, '', '', '', 0, '', '', '', '', 7, '', 0, 1, 0, 0, 0, '', 0, '', '', 48, 0, 1, 0, 0, 0, 7, 7, 1, 1, 0, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0);
/*!40000 ALTER TABLE `phpbb_forums` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
