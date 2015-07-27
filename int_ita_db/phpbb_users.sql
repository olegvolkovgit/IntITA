-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-27 18:23:29
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.phpbb_users
DROP TABLE IF EXISTS `phpbb_users`;
CREATE TABLE IF NOT EXISTS `phpbb_users` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` tinyint(2) NOT NULL DEFAULT '0',
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '3',
  `user_permissions` mediumtext COLLATE utf8_bin NOT NULL,
  `user_perm_from` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_regdate` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `username_clean` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_password` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_passchg` int(11) unsigned NOT NULL DEFAULT '0',
  `user_email` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_email_hash` bigint(20) NOT NULL DEFAULT '0',
  `user_birthday` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_lastvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `user_lastmark` int(11) unsigned NOT NULL DEFAULT '0',
  `user_lastpost_time` int(11) unsigned NOT NULL DEFAULT '0',
  `user_lastpage` varchar(200) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_last_confirm_key` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_last_search` int(11) unsigned NOT NULL DEFAULT '0',
  `user_warnings` tinyint(4) NOT NULL DEFAULT '0',
  `user_last_warning` int(11) unsigned NOT NULL DEFAULT '0',
  `user_login_attempts` tinyint(4) NOT NULL DEFAULT '0',
  `user_inactive_reason` tinyint(2) NOT NULL DEFAULT '0',
  `user_inactive_time` int(11) unsigned NOT NULL DEFAULT '0',
  `user_posts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_lang` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_timezone` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_dateformat` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT 'd M Y H:i',
  `user_style` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_rank` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_new_privmsg` int(4) NOT NULL DEFAULT '0',
  `user_unread_privmsg` int(4) NOT NULL DEFAULT '0',
  `user_last_privmsg` int(11) unsigned NOT NULL DEFAULT '0',
  `user_message_rules` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_full_folder` int(11) NOT NULL DEFAULT '-3',
  `user_emailtime` int(11) unsigned NOT NULL DEFAULT '0',
  `user_topic_show_days` smallint(4) unsigned NOT NULL DEFAULT '0',
  `user_topic_sortby_type` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 't',
  `user_topic_sortby_dir` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'd',
  `user_post_show_days` smallint(4) unsigned NOT NULL DEFAULT '0',
  `user_post_sortby_type` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 't',
  `user_post_sortby_dir` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'a',
  `user_notify` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_notify_pm` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_notify_type` tinyint(4) NOT NULL DEFAULT '0',
  `user_allow_pm` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_allow_viewonline` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_allow_viewemail` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_allow_massemail` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_options` int(11) unsigned NOT NULL DEFAULT '230271',
  `user_avatar` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_avatar_type` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_avatar_width` smallint(4) unsigned NOT NULL DEFAULT '0',
  `user_avatar_height` smallint(4) unsigned NOT NULL DEFAULT '0',
  `user_sig` mediumtext COLLATE utf8_bin NOT NULL,
  `user_sig_bbcode_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_sig_bbcode_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_jabber` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_actkey` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_newpasswd` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_form_salt` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_new` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_reminded` tinyint(4) NOT NULL DEFAULT '0',
  `user_reminded_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_clean` (`username_clean`),
  KEY `user_birthday` (`user_birthday`),
  KEY `user_email_hash` (`user_email_hash`),
  KEY `user_type` (`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_users: ~11 rows (approximately)
/*!40000 ALTER TABLE `phpbb_users` DISABLE KEYS */;
INSERT INTO `phpbb_users` (`user_id`, `user_type`, `group_id`, `user_permissions`, `user_perm_from`, `user_ip`, `user_regdate`, `username`, `username_clean`, `user_password`, `user_passchg`, `user_email`, `user_email_hash`, `user_birthday`, `user_lastvisit`, `user_lastmark`, `user_lastpost_time`, `user_lastpage`, `user_last_confirm_key`, `user_last_search`, `user_warnings`, `user_last_warning`, `user_login_attempts`, `user_inactive_reason`, `user_inactive_time`, `user_posts`, `user_lang`, `user_timezone`, `user_dateformat`, `user_style`, `user_rank`, `user_colour`, `user_new_privmsg`, `user_unread_privmsg`, `user_last_privmsg`, `user_message_rules`, `user_full_folder`, `user_emailtime`, `user_topic_show_days`, `user_topic_sortby_type`, `user_topic_sortby_dir`, `user_post_show_days`, `user_post_sortby_type`, `user_post_sortby_dir`, `user_notify`, `user_notify_pm`, `user_notify_type`, `user_allow_pm`, `user_allow_viewonline`, `user_allow_viewemail`, `user_allow_massemail`, `user_options`, `user_avatar`, `user_avatar_type`, `user_avatar_width`, `user_avatar_height`, `user_sig`, `user_sig_bbcode_uid`, `user_sig_bbcode_bitfield`, `user_jabber`, `user_actkey`, `user_newpasswd`, `user_form_salt`, `user_new`, `user_reminded`, `user_reminded_time`) VALUES
	(1, 2, 1, '00000000000w27wrgg\n\n\n\n\n\n\n\n\n\n\n\n\n\n\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\n\n\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000\ni1cjyo000000', 0, '', 1431076924, 'Anonymous', 'anonymous', '', 0, '', 0, '', 0, 0, 0, '', '2F4M64ETS4', 1437402761, 0, 0, 0, 0, 0, 0, 'uk', 'Europe/Kiev', 'd M Y H:i', 1, 0, '', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 0, 230271, '', '', 0, 0, '', '', '', '', '', '', 'a3008bec58a33e7f', 1, 0, 0),
	(2, 3, 5, 'zik0zjzik0zjzik0zc\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\n\n\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000\nzik0zj000000', 0, '127.0.0.1', 1431076924, 'intita', 'intita', '$2y$10$G.aeTtUTb6qI44QQuAOgh.P5fP9mw3.6/WzPVzB53z5TM5i3mBdra', 0, 'intita.hr@gmail.com', 144972273819, '', 1437140101, 0, 1437055279, 'index.php?transition=false', '3IF0CVYBS4', 0, 0, 0, 0, 0, 0, 4, 'uk', 'Europe/Kiev', 'd M Y H:i', 1, 1, 'AA0000', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 230271, '', '', 0, 0, '', '', '', '', '', '', '5e79e054a6e4eacd', 0, 0, 0),
	(22, 0, 3, '00000000001qh78puw\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\n\n\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000', 0, '', 0, 'Student ', 'Student ', '', 0, '', 0, '', 1437221780, 1437123064, 1437220140, 'posting.php?f=16&mode=reply&t=5', '3N68T27D96', 1437166212, 0, 0, 0, 0, 0, 4, '', 'Europe/Kiev', 'd M Y H:i', 1, 0, '', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 230271, '', '', 0, 0, '', '', '', '', '', '', '', 0, 0, 0),
	(38, 0, 3, '00000000001qh78puw\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\n\n\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000', 0, '', 1431076924, 'teacher ', 'teacher ', '', 0, '', 0, '', 1437732968, 0, 1437732959, 'viewforum.php?f=15', '', 0, 0, 0, 0, 0, 0, 2, '', 'Europe/Kiev', 'd M Y H:i', 1, 0, '', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 230271, '', '', 0, 0, '', '', '', '', '', '', '', 1, 0, 0),
	(40, 0, 3, '00000000001qh78puw\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\n\n\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000', 0, '', 1431076924, 'teacher3@gmail.com', 'teacher3@gmail.com', '', 0, '', 0, '', 1437215252, 0, 1437219397, 'index.php?transition=false', '3JEJLYLZU4', 1437054456, 0, 0, 0, 0, 0, 12, '', 'Europe/Kiev', 'd M Y H:i', 1, 0, '', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 230271, '', '', 0, 0, '', '', '', '', '', '', '', 0, 0, 0),
	(45, 0, 3, '00000000001qh78puw\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\n\n\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000', 0, '', 0, 'Roman Melnyk', 'Roman Melnyk', '', 0, '', 0, '', 1437723594, 0, 1437389787, 'viewtopic.php?f=15&t=8', '', 0, 0, 0, 0, 0, 0, 2, '', 'Europe/Kiev', 'd M Y H:i', 1, 0, '', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 230271, '', '', 0, 0, '', '', '', '', '', '', '', 1, 0, 0),
	(51, 0, 3, '00000000001qh78puw\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\n\n\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000', 0, '', 1431076924, 'Student 1 ', 'Student 1 ', '', 0, '', 0, '', 1437054125, 0, 1437054093, '', '', 0, 0, 0, 0, 0, 0, 1, '', 'Europe/Kiev', 'd M Y H:i', 1, 0, '', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 230271, '', '', 0, 0, '', '', '', '', '', '', '', 1, 0, 0),
	(52, 0, 3, '00000000001qh78puw\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\n\n\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000', 0, '', 1431076924, 'Student 2 ', 'Student 2 ', '', 0, '', 0, '', 1437469749, 0, 0, 'index.php?transition=false', '', 0, 0, 0, 0, 0, 0, 0, '', 'Europe/Kiev', 'd M Y H:i', 1, 0, '', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 230271, '', '', 0, 0, '', '', '', '', '', '', '', 1, 0, 0),
	(106, 0, 3, '', 0, '', 1431076924, 'nnn.badyora2015@gmail.com', 'nnn.badyora2015@gmail.com', '', 0, '', 0, '', 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', 'Europe/Kiev', 'd M Y H:i', 0, 0, '', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 230271, '', '', 0, 0, '', '', '', '', '', '', '', 1, 0, 0),
	(113, 0, 3, '', 0, '', 1431076924, 'Олександр Бохан', 'Олександр Бохан', '', 0, '', 0, '', 1436971163, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', 'Europe/Kiev', 'd M Y H:i', 1, 0, '', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 230271, '', '', 0, 0, '', '', '', '', '', '', '', 1, 0, 0),
	(121, 0, 3, '00000000001qh78puw\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\n\n\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000\nkgzahh000000', 0, '', 0, 'genius ', 'genius ', '', 0, '', 0, '', 0, 0, 1437554649, '', '1C98QMWW3P', 0, 0, 0, 0, 0, 0, 1, '', 'Europe/Kiev', 'd M Y H:i', 1, 0, '', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 230271, '', '', 0, 0, '', '', '', '', '', '', '', 1, 0, 0);
/*!40000 ALTER TABLE `phpbb_users` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
