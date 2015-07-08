-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-08 19:13:00
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.phpbb_smilies
DROP TABLE IF EXISTS `phpbb_smilies`;
CREATE TABLE IF NOT EXISTS `phpbb_smilies` (
  `smiley_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `emotion` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `smiley_url` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `smiley_width` smallint(4) unsigned NOT NULL DEFAULT '0',
  `smiley_height` smallint(4) unsigned NOT NULL DEFAULT '0',
  `smiley_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `display_on_posting` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`smiley_id`),
  KEY `display_on_post` (`display_on_posting`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_smilies: ~42 rows (approximately)
/*!40000 ALTER TABLE `phpbb_smilies` DISABLE KEYS */;
INSERT INTO `phpbb_smilies` (`smiley_id`, `code`, `emotion`, `smiley_url`, `smiley_width`, `smiley_height`, `smiley_order`, `display_on_posting`) VALUES
	(1, ':D', 'Дуже щасливий', 'icon_e_biggrin.gif', 15, 17, 1, 1),
	(2, ':-D', 'Дуже щасливий', 'icon_e_biggrin.gif', 15, 17, 2, 1),
	(3, ':grin:', 'Дуже щасливий', 'icon_e_biggrin.gif', 15, 17, 3, 1),
	(4, ':)', 'Посмішка', 'icon_e_smile.gif', 15, 17, 4, 1),
	(5, ':-)', 'Посмішка', 'icon_e_smile.gif', 15, 17, 5, 1),
	(6, ':smile:', 'Посмішка', 'icon_e_smile.gif', 15, 17, 6, 1),
	(7, ';)', 'Підморгує', 'icon_e_wink.gif', 15, 17, 7, 1),
	(8, ';-)', 'Підморгує', 'icon_e_wink.gif', 15, 17, 8, 1),
	(9, ':wink:', 'Підморгує', 'icon_e_wink.gif', 15, 17, 9, 1),
	(10, ':(', 'Сумний', 'icon_e_sad.gif', 15, 17, 10, 1),
	(11, ':-(', 'Сумний', 'icon_e_sad.gif', 15, 17, 11, 1),
	(12, ':sad:', 'Сумний', 'icon_e_sad.gif', 15, 17, 12, 1),
	(13, ':o', 'Здивований', 'icon_e_surprised.gif', 15, 17, 13, 1),
	(14, ':-o', 'Здивований', 'icon_e_surprised.gif', 15, 17, 14, 1),
	(15, ':eek:', 'Здивований', 'icon_e_surprised.gif', 15, 17, 15, 1),
	(16, ':shock:', 'Шокований', 'icon_eek.gif', 15, 17, 16, 1),
	(17, ':?', 'Спантеличений', 'icon_e_confused.gif', 15, 17, 17, 1),
	(18, ':-?', 'Спантеличений', 'icon_e_confused.gif', 15, 17, 18, 1),
	(19, ':???:', 'Спантеличений', 'icon_e_confused.gif', 15, 17, 19, 1),
	(20, '8-)', 'Кльво', 'icon_cool.gif', 15, 17, 20, 1),
	(21, ':cool:', 'Кльво', 'icon_cool.gif', 15, 17, 21, 1),
	(22, ':lol:', 'Сміється', 'icon_lol.gif', 15, 17, 22, 1),
	(23, ':x', 'Божевільний', 'icon_mad.gif', 15, 17, 23, 1),
	(24, ':-x', 'Божевільний', 'icon_mad.gif', 15, 17, 24, 1),
	(25, ':mad:', 'Божевільний', 'icon_mad.gif', 15, 17, 25, 1),
	(26, ':P', 'Глузує', 'icon_razz.gif', 15, 17, 26, 1),
	(27, ':-P', 'Глузує', 'icon_razz.gif', 15, 17, 27, 1),
	(28, ':razz:', 'Глузує', 'icon_razz.gif', 15, 17, 28, 1),
	(29, ':oops:', 'Збентежений', 'icon_redface.gif', 15, 17, 29, 1),
	(30, ':cry:', 'Плаче або дуже сердитий', 'icon_cry.gif', 15, 17, 30, 1),
	(31, ':evil:', 'Злий або дуже роздратований', 'icon_evil.gif', 15, 17, 31, 1),
	(32, ':twisted:', 'Дуже злий', 'icon_twisted.gif', 15, 17, 32, 1),
	(33, ':roll:', 'Закочує очі', 'icon_rolleyes.gif', 15, 17, 33, 1),
	(34, ':!:', 'Увага', 'icon_exclaim.gif', 15, 17, 34, 1),
	(35, ':?:', 'Питання', 'icon_question.gif', 15, 17, 35, 1),
	(36, ':idea:', 'Ідея', 'icon_idea.gif', 15, 17, 36, 1),
	(37, ':arrow:', 'Стрілка', 'icon_arrow.gif', 15, 17, 37, 1),
	(38, ':|', 'Нейтральний', 'icon_neutral.gif', 15, 17, 38, 1),
	(39, ':-|', 'Нейтральний', 'icon_neutral.gif', 15, 17, 39, 1),
	(40, ':mrgreen:', 'Зелений', 'icon_mrgreen.gif', 15, 17, 40, 1),
	(41, ':geek:', 'Ботанік', 'icon_e_geek.gif', 17, 17, 41, 1),
	(42, ':ugeek:', 'Конкретний ботанік', 'icon_e_ugeek.gif', 17, 18, 42, 1);
/*!40000 ALTER TABLE `phpbb_smilies` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
