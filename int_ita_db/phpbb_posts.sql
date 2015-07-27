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

-- Dumping structure for table int_ita_db.phpbb_posts
DROP TABLE IF EXISTS `phpbb_posts`;
CREATE TABLE IF NOT EXISTS `phpbb_posts` (
  `post_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poster_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `icon_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poster_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_time` int(11) unsigned NOT NULL DEFAULT '0',
  `post_reported` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `enable_bbcode` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_smilies` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_magic_url` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_sig` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `post_username` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `post_text` mediumtext COLLATE utf8_bin NOT NULL,
  `post_checksum` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_attachment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `bbcode_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bbcode_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_postcount` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `post_edit_time` int(11) unsigned NOT NULL DEFAULT '0',
  `post_edit_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_edit_user` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `post_edit_count` smallint(4) unsigned NOT NULL DEFAULT '0',
  `post_edit_locked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `post_visibility` tinyint(3) NOT NULL DEFAULT '0',
  `post_delete_time` int(11) unsigned NOT NULL DEFAULT '0',
  `post_delete_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_delete_user` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`),
  KEY `poster_ip` (`poster_ip`),
  KEY `poster_id` (`poster_id`),
  KEY `tid_post_time` (`topic_id`,`post_time`),
  KEY `post_username` (`post_username`),
  KEY `post_visibility` (`post_visibility`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_posts: ~26 rows (approximately)
/*!40000 ALTER TABLE `phpbb_posts` DISABLE KEYS */;
INSERT INTO `phpbb_posts` (`post_id`, `topic_id`, `forum_id`, `poster_id`, `icon_id`, `poster_ip`, `post_time`, `post_reported`, `enable_bbcode`, `enable_smilies`, `enable_magic_url`, `enable_sig`, `post_username`, `post_subject`, `post_text`, `post_checksum`, `post_attachment`, `bbcode_bitfield`, `bbcode_uid`, `post_postcount`, `post_edit_time`, `post_edit_reason`, `post_edit_user`, `post_edit_count`, `post_edit_locked`, `post_visibility`, `post_delete_time`, `post_delete_reason`, `post_delete_user`) VALUES
	(5, 4, 16, 2, 0, '81.30.164.98', 1437053884, 0, 1, 1, 1, 1, '', 'Змінні та типи даних в PHP', 'Обговорення заняття &quot;Змінні та типи даних в PHP&quot;', '2be39cb02525d1caaab1a88ebcb9458b', 0, '', '3i5zo1rl', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(6, 5, 16, 2, 0, '81.30.164.98', 1437053934, 0, 1, 1, 1, 1, '', 'Основи синтаксису', 'Обговорення заняття &quot;Основи синтаксису&quot;', '75aa5869f087c1ddf6f0a54cb6341a76', 0, '', 'l2ww0863', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(7, 6, 16, 2, 0, '81.30.164.98', 1437053968, 0, 1, 1, 1, 1, '', 'Обробка запитів з допомогою PHP', 'Обговорення заняття &quot;Обробка запитів з допомогою PHP&quot;', '091a96ff55a24aaa2a022020e2e4538f', 0, '', '3s6bmpnq', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(8, 4, 16, 51, 0, '81.30.164.98', 1437054093, 0, 1, 1, 1, 1, '', 'Re: Змінні та типи даних в PHP', 'Змінні змінюються, а типи даних типові', 'bbdcb004785fecdd423dda8ddfe6328c', 0, '', '2l451cjg', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(9, 4, 16, 40, 0, '81.30.164.98', 1437054417, 0, 1, 1, 1, 1, '', 'Re: Змінні та типи даних в PHP', '[quote=&quot;Student 1 &quot;:29rz82h6]Змінні змінюються, а типи даних типові[/quote:29rz82h6]\nДуже дотепно...', 'a2423356e1a66f9a2076ccc21a5c9182', 0, 'gA==', '29rz82h6', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(10, 7, 16, 40, 0, '81.30.164.98', 1437054945, 0, 1, 1, 1, 1, '', '784', 'jhbhb', '0c7ecd59838f6f5cce5c580816ff1e09', 0, '', '3rmxb4fy', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(11, 5, 16, 2, 0, '81.30.164.98', 1437055279, 0, 1, 1, 1, 1, '', 'Re: Основи синтаксису', 'Мається на увазі синтаксис PHP', 'cbc21ad778130402bd5a4371a9381dfe', 0, '', 'dpwzvtk0', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(12, 8, 15, 22, 0, '178.92.66.110', 1437125835, 0, 1, 1, 1, 1, '', 'Нова тема', 'Нова тема Нова тема Нова тема Нова тема Нова тема Нова тема <!-- s:) --><img src="{SMILIES_PATH}/icon_e_smile.gif" alt=":)" title="Посмішка" /><!-- s:) -->', 'd16266dec3dcf14fb23e1fe7714f470a', 0, 'Aw==', '1tttosjo', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(13, 4, 16, 22, 0, '178.94.36.25', 1437166114, 0, 1, 1, 1, 1, '', 'Re: Змінні та типи даних в PHP', 'ребететптпааопрыврпьап\n[b:1yjudgep][u:1yjudgep]амтавлопра[/u:1yjudgep][/b:1yjudgep]', '5048d166c37885cec52a087d911dea91', 0, 'QQ==', '1yjudgep', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(14, 4, 16, 22, 0, '178.94.36.25', 1437166713, 0, 1, 1, 1, 1, '', 'Re: Змінні та типи даних в PHP', 'итьтьбь бтьбьтьбтстит', '72ac05d63003aa93ac7892ec0651c12b', 0, '', 'px545m96', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(15, 9, 34, 40, 0, '81.30.164.98', 1437203534, 0, 1, 1, 1, 1, '', 'Тема Тема', 'бази даних (частина 1)', '67721082f32d58a78439491292e48f95', 0, '', '3gh3trn0', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(16, 9, 34, 40, 0, '81.30.164.98', 1437203610, 0, 1, 1, 1, 1, '', 'Re: Тема Тема', 'оллорло', '566a9f75fdff3d0053c9b68dfd1e5750', 0, '', '3cgrgldu', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(17, 10, 35, 40, 0, '81.30.164.98', 1437203686, 0, 1, 1, 1, 1, '', 'Тема 2', 'апаорпаврпалврпл\nвоарвлрааларплап\nваороарллварварпа\nывораларлалпрапр\nыравларавларвлав\nырлрлырпапарпаа\nылвраварварвааов\nывраварвававваор\nворварварварвалр\nваварвоарвоарвав', '532824da0fc562dd231852bb2958fad1', 0, '', '185wbypb', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(18, 10, 35, 40, 0, '81.30.164.98', 1437203752, 0, 1, 1, 1, 1, '', '', 'вапвапавпа\nвавравраврал', '0efec0579dfde51d145c213fc290ef1d', 0, '', '19ogidkc', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(19, 11, 35, 40, 0, '81.30.164.98', 1437203781, 0, 1, 1, 1, 1, '', 'Тема 3', 'апапавп', 'b1c208493b83667e7e3e147897fbdf17', 0, '', '2rafv5qz', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(20, 12, 35, 40, 0, '81.30.164.98', 1437203808, 0, 1, 1, 1, 1, '', 'Тема 4', 'авав', '5ee5c0c049101d073fd016c0e0055c9c', 0, '', 'i095sbk0', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(21, 13, 35, 40, 0, '81.30.164.98', 1437203836, 0, 1, 1, 1, 1, '', 'Тема 5', 'ролплол', 'bf0648dfb1c0d26774170067c1339067', 0, '', '1v3o8emw', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(22, 14, 35, 40, 0, '81.30.164.98', 1437203856, 0, 1, 1, 1, 1, '', 'тема 6', 'апапва', '2916be4695d93bdb648b2840d87d8c33', 0, '', '26d90h3x', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(23, 15, 35, 40, 0, '81.30.164.98', 1437204004, 0, 1, 1, 1, 1, '', 'тема 7', 'тема7', 'b365dc48c1c291f2f9554d4a2f5b7ff9', 0, '', 'v0nuql9m', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(24, 6, 16, 40, 0, '81.30.164.98', 1437219397, 0, 1, 1, 1, 1, '', 'Re: Обробка запитів з допомогою PHP', 'dghyrturyjfyhjfnhjh', '2a42b256cdf1467746177c380f02a9e4', 0, '', '1oauph5i', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(25, 5, 16, 22, 0, '81.30.164.98', 1437220140, 0, 1, 1, 1, 1, '', 'Re: Основи синтаксису', '[quote=&quot;intita&quot;:3c33cwdc]Мається на увазі синтаксис PHP[/quote:3c33cwdc]\nДякую, кеп!', 'b01924ba6692ee146c3f5039461f3276', 0, 'gA==', '3c33cwdc', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(26, 5, 16, 38, 0, '81.30.164.98', 1437220304, 0, 1, 1, 1, 1, '', 'Re: Основи синтаксису', '[quote=&quot;intita&quot;:t0l6jgja]Мається на увазі синтаксис PHP[/quote:t0l6jgja]\nndsdafhgdsf\nfjdsfgdshfgds', 'f12f2d8fbb7d639b1d55f61bf7048f20', 0, 'gA==', 't0l6jgja', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(27, 5, 16, 45, 0, '81.30.164.98', 1437389655, 0, 1, 1, 1, 1, '', 'Re: Основи синтаксису', 'добре', 'bd324daa894d5317a64ab73f376e65dc', 0, '', '2dlujva1', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(28, 6, 16, 45, 0, '81.30.164.98', 1437389787, 0, 1, 1, 1, 1, '', 'Re: Обробка запитів з допомогою PHP', 'добре', 'bd324daa894d5317a64ab73f376e65dc', 0, '', 'ea4liott', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(29, 16, 36, 121, 0, '94.179.33.38', 1437554649, 0, 1, 1, 1, 1, '', 'иьмтьитьиь', 'сьтмьтбьбт бт', 'e5bae6257463743eac9293cfd2d8f1e7', 0, '', 'hvtacvqr', 1, 0, '', 0, 0, 0, 1, 0, '', 0),
	(30, 16, 36, 38, 0, '80.91.174.90', 1437732959, 0, 1, 1, 1, 1, '', 'Re: иьмтьитьиь', 'asdfgdsfnhgqqqqqqqqqqqqqqqqqqqqqqqqqqqqq', '739d72a94660d6e744c799d539159f38', 0, '', '2s49ns92', 1, 0, '', 0, 0, 0, 1, 0, '', 0);
/*!40000 ALTER TABLE `phpbb_posts` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
