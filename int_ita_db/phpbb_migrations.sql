-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-13 17:03:52
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.phpbb_migrations
DROP TABLE IF EXISTS `phpbb_migrations`;
CREATE TABLE IF NOT EXISTS `phpbb_migrations` (
  `migration_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `migration_depends_on` text COLLATE utf8_bin NOT NULL,
  `migration_schema_done` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `migration_data_done` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `migration_data_state` text COLLATE utf8_bin NOT NULL,
  `migration_start_time` int(11) unsigned NOT NULL DEFAULT '0',
  `migration_end_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`migration_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_migrations: ~157 rows (approximately)
/*!40000 ALTER TABLE `phpbb_migrations` DISABLE KEYS */;
INSERT INTO `phpbb_migrations` (`migration_name`, `migration_depends_on`, `migration_schema_done`, `migration_data_done`, `migration_data_state`, `migration_start_time`, `migration_end_time`) VALUES
	('\\phpbb\\db\\migration\\data\\v30x\\local_url_bbcode', 'a:1:{i:0;s:48:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_12_rc1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_0', 'a:0:{}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_1', 'a:1:{i:0;s:47:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_1_rc1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_10', 'a:1:{i:0;s:48:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_10_rc3";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_10_rc1', 'a:1:{i:0;s:43:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_10_rc2', 'a:1:{i:0;s:48:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_10_rc1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_10_rc3', 'a:1:{i:0;s:48:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_10_rc2";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11', 'a:1:{i:0;s:48:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11_rc2";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11_rc1', 'a:1:{i:0;s:44:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_10";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11_rc2', 'a:1:{i:0;s:48:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11_rc1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_12', 'a:1:{i:0;s:48:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_12_rc3";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_12_rc1', 'a:1:{i:0;s:44:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_12_rc2', 'a:1:{i:0;s:48:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_12_rc1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_12_rc3', 'a:1:{i:0;s:48:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_12_rc2";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_13', 'a:1:{i:0;s:48:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_13_rc1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_13_pl1', 'a:1:{i:0;s:44:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_13";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_13_rc1', 'a:1:{i:0;s:44:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_12";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_14', 'a:1:{i:0;s:48:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_14_rc1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_14_rc1', 'a:1:{i:0;s:44:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_13";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_1_rc1', 'a:1:{i:0;s:43:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_0";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_2', 'a:1:{i:0;s:47:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_2_rc2";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_2_rc1', 'a:1:{i:0;s:43:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_2_rc2', 'a:1:{i:0;s:47:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_2_rc1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_3', 'a:1:{i:0;s:47:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_3_rc1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_3_rc1', 'a:1:{i:0;s:43:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_2";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_4', 'a:1:{i:0;s:47:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_4_rc1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_4_rc1', 'a:1:{i:0;s:43:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_3";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_5', 'a:1:{i:0;s:52:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_5_rc1part2";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_5_rc1', 'a:1:{i:0;s:43:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_4";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_5_rc1part2', 'a:1:{i:0;s:47:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_5_rc1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6', 'a:1:{i:0;s:47:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6_rc4";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6_rc1', 'a:1:{i:0;s:43:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_5";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6_rc2', 'a:1:{i:0;s:47:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6_rc1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6_rc3', 'a:1:{i:0;s:47:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6_rc2";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6_rc4', 'a:1:{i:0;s:47:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6_rc3";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_7', 'a:1:{i:0;s:47:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_7_rc2";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_7_pl1', 'a:1:{i:0;s:43:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_7";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_7_rc1', 'a:1:{i:0;s:43:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_7_rc2', 'a:1:{i:0;s:47:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_7_rc1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_8', 'a:1:{i:0;s:47:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_8_rc1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_8_rc1', 'a:1:{i:0;s:47:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_7_pl1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9', 'a:1:{i:0;s:47:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9_rc4";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9_rc1', 'a:1:{i:0;s:43:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_8";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9_rc2', 'a:1:{i:0;s:47:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9_rc1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9_rc3', 'a:1:{i:0;s:47:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9_rc2";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9_rc4', 'a:1:{i:0;s:47:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9_rc3";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\acp_prune_users_module', 'a:1:{i:0;s:35:"\\phpbb\\db\\migration\\data\\v310\\beta1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\acp_style_components_module', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\allow_cdn', 'a:1:{i:0;s:43:"\\phpbb\\db\\migration\\data\\v310\\jquery_update";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\alpha1', 'a:18:{i:0;s:46:"\\phpbb\\db\\migration\\data\\v30x\\local_url_bbcode";i:1;s:44:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_12";i:2;s:57:"\\phpbb\\db\\migration\\data\\v310\\acp_style_components_module";i:3;s:39:"\\phpbb\\db\\migration\\data\\v310\\allow_cdn";i:4;s:49:"\\phpbb\\db\\migration\\data\\v310\\auth_provider_oauth";i:5;s:37:"\\phpbb\\db\\migration\\data\\v310\\avatars";i:6;s:40:"\\phpbb\\db\\migration\\data\\v310\\boardindex";i:7;s:44:"\\phpbb\\db\\migration\\data\\v310\\config_db_text";i:8;s:45:"\\phpbb\\db\\migration\\data\\v310\\forgot_password";i:9;s:41:"\\phpbb\\db\\migration\\data\\v310\\mod_rewrite";i:10;s:49:"\\phpbb\\db\\migration\\data\\v310\\mysql_fulltext_drop";i:11;s:40:"\\phpbb\\db\\migration\\data\\v310\\namespaces";i:12;s:48:"\\phpbb\\db\\migration\\data\\v310\\notifications_cron";i:13;s:60:"\\phpbb\\db\\migration\\data\\v310\\notification_options_reconvert";i:14;s:38:"\\phpbb\\db\\migration\\data\\v310\\plupload";i:15;s:51:"\\phpbb\\db\\migration\\data\\v310\\signature_module_auth";i:16;s:52:"\\phpbb\\db\\migration\\data\\v310\\softdelete_mcp_modules";i:17;s:38:"\\phpbb\\db\\migration\\data\\v310\\teampage";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\alpha2', 'a:2:{i:0;s:36:"\\phpbb\\db\\migration\\data\\v310\\alpha1";i:1;s:51:"\\phpbb\\db\\migration\\data\\v310\\notifications_cron_p2";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\alpha3', 'a:4:{i:0;s:36:"\\phpbb\\db\\migration\\data\\v310\\alpha2";i:1;s:42:"\\phpbb\\db\\migration\\data\\v310\\avatar_types";i:2;s:39:"\\phpbb\\db\\migration\\data\\v310\\passwords";i:3;s:48:"\\phpbb\\db\\migration\\data\\v310\\profilefield_types";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\auth_provider_oauth', 'a:0:{}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\auth_provider_oauth2', 'a:1:{i:0;s:49:"\\phpbb\\db\\migration\\data\\v310\\auth_provider_oauth";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\avatar_types', 'a:2:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";i:1;s:37:"\\phpbb\\db\\migration\\data\\v310\\avatars";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\avatars', 'a:1:{i:0;s:44:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\beta1', 'a:7:{i:0;s:36:"\\phpbb\\db\\migration\\data\\v310\\alpha3";i:1;s:42:"\\phpbb\\db\\migration\\data\\v310\\passwords_p2";i:2;s:52:"\\phpbb\\db\\migration\\data\\v310\\postgres_fulltext_drop";i:3;s:63:"\\phpbb\\db\\migration\\data\\v310\\profilefield_change_load_settings";i:4;s:51:"\\phpbb\\db\\migration\\data\\v310\\profilefield_location";i:5;s:54:"\\phpbb\\db\\migration\\data\\v310\\soft_delete_mod_convert2";i:6;s:48:"\\phpbb\\db\\migration\\data\\v310\\ucp_popuppm_module";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\beta2', 'a:3:{i:0;s:35:"\\phpbb\\db\\migration\\data\\v310\\beta1";i:1;s:52:"\\phpbb\\db\\migration\\data\\v310\\acp_prune_users_module";i:2;s:59:"\\phpbb\\db\\migration\\data\\v310\\profilefield_location_cleanup";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\beta3', 'a:6:{i:0;s:35:"\\phpbb\\db\\migration\\data\\v310\\beta2";i:1;s:50:"\\phpbb\\db\\migration\\data\\v310\\auth_provider_oauth2";i:2;s:48:"\\phpbb\\db\\migration\\data\\v310\\board_contact_name";i:3;s:44:"\\phpbb\\db\\migration\\data\\v310\\jquery_update2";i:4;s:50:"\\phpbb\\db\\migration\\data\\v310\\live_searches_config";i:5;s:49:"\\phpbb\\db\\migration\\data\\v310\\prune_shadow_topics";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\beta4', 'a:3:{i:0;s:35:"\\phpbb\\db\\migration\\data\\v310\\beta3";i:1;s:69:"\\phpbb\\db\\migration\\data\\v310\\extensions_version_check_force_unstable";i:2;s:58:"\\phpbb\\db\\migration\\data\\v310\\reset_missing_captcha_plugin";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\board_contact_name', 'a:1:{i:0;s:35:"\\phpbb\\db\\migration\\data\\v310\\beta2";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\boardindex', 'a:0:{}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\bot_update', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\rc6";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\captcha_plugins', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\rc2";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\config_db_text', 'a:1:{i:0;s:44:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\contact_admin_acp_module', 'a:0:{}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\contact_admin_form', 'a:1:{i:0;s:44:"\\phpbb\\db\\migration\\data\\v310\\config_db_text";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\dev', 'a:5:{i:0;s:40:"\\phpbb\\db\\migration\\data\\v310\\extensions";i:1;s:45:"\\phpbb\\db\\migration\\data\\v310\\style_update_p2";i:2;s:41:"\\phpbb\\db\\migration\\data\\v310\\timezone_p2";i:3;s:52:"\\phpbb\\db\\migration\\data\\v310\\reported_posts_display";i:4;s:46:"\\phpbb\\db\\migration\\data\\v310\\migrations_table";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\extensions', 'a:1:{i:0;s:44:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\extensions_version_check_force_unstable', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\forgot_password', 'a:1:{i:0;s:44:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\gold', 'a:2:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\rc6";i:1;s:40:"\\phpbb\\db\\migration\\data\\v310\\bot_update";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\jquery_update', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\jquery_update2', 'a:1:{i:0;s:43:"\\phpbb\\db\\migration\\data\\v310\\jquery_update";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\live_searches_config', 'a:0:{}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\migrations_table', 'a:0:{}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\mod_rewrite', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\mysql_fulltext_drop', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\namespaces', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\notification_options_reconvert', 'a:1:{i:0;s:54:"\\phpbb\\db\\migration\\data\\v310\\notifications_schema_fix";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\notifications', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\notifications_cron', 'a:1:{i:0;s:43:"\\phpbb\\db\\migration\\data\\v310\\notifications";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\notifications_cron_p2', 'a:1:{i:0;s:48:"\\phpbb\\db\\migration\\data\\v310\\notifications_cron";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\notifications_schema_fix', 'a:1:{i:0;s:43:"\\phpbb\\db\\migration\\data\\v310\\notifications";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\notifications_use_full_name', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\rc3";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\passwords', 'a:1:{i:0;s:44:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\passwords_convert_p1', 'a:1:{i:0;s:42:"\\phpbb\\db\\migration\\data\\v310\\passwords_p2";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\passwords_convert_p2', 'a:1:{i:0;s:50:"\\phpbb\\db\\migration\\data\\v310\\passwords_convert_p1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\passwords_p2', 'a:1:{i:0;s:39:"\\phpbb\\db\\migration\\data\\v310\\passwords";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\plupload', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\postgres_fulltext_drop', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_aol', 'a:1:{i:0;s:56:"\\phpbb\\db\\migration\\data\\v310\\profilefield_yahoo_cleanup";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_aol_cleanup', 'a:1:{i:0;s:46:"\\phpbb\\db\\migration\\data\\v310\\profilefield_aol";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_change_load_settings', 'a:1:{i:0;s:54:"\\phpbb\\db\\migration\\data\\v310\\profilefield_aol_cleanup";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_cleanup', 'a:2:{i:0;s:52:"\\phpbb\\db\\migration\\data\\v310\\profilefield_interests";i:1;s:53:"\\phpbb\\db\\migration\\data\\v310\\profilefield_occupation";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_contact_field', 'a:1:{i:0;s:56:"\\phpbb\\db\\migration\\data\\v310\\profilefield_on_memberlist";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_facebook', 'a:3:{i:0;s:56:"\\phpbb\\db\\migration\\data\\v310\\profilefield_contact_field";i:1;s:55:"\\phpbb\\db\\migration\\data\\v310\\profilefield_show_novalue";i:2;s:48:"\\phpbb\\db\\migration\\data\\v310\\profilefield_types";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_field_validation_length', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\rc3";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_googleplus', 'a:3:{i:0;s:56:"\\phpbb\\db\\migration\\data\\v310\\profilefield_contact_field";i:1;s:55:"\\phpbb\\db\\migration\\data\\v310\\profilefield_show_novalue";i:2;s:48:"\\phpbb\\db\\migration\\data\\v310\\profilefield_types";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_icq', 'a:1:{i:0;s:56:"\\phpbb\\db\\migration\\data\\v310\\profilefield_contact_field";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_icq_cleanup', 'a:1:{i:0;s:46:"\\phpbb\\db\\migration\\data\\v310\\profilefield_icq";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_interests', 'a:2:{i:0;s:48:"\\phpbb\\db\\migration\\data\\v310\\profilefield_types";i:1;s:55:"\\phpbb\\db\\migration\\data\\v310\\profilefield_show_novalue";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_location', 'a:2:{i:0;s:48:"\\phpbb\\db\\migration\\data\\v310\\profilefield_types";i:1;s:56:"\\phpbb\\db\\migration\\data\\v310\\profilefield_on_memberlist";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_location_cleanup', 'a:1:{i:0;s:51:"\\phpbb\\db\\migration\\data\\v310\\profilefield_location";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_occupation', 'a:1:{i:0;s:52:"\\phpbb\\db\\migration\\data\\v310\\profilefield_interests";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_on_memberlist', 'a:1:{i:0;s:50:"\\phpbb\\db\\migration\\data\\v310\\profilefield_cleanup";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_show_novalue', 'a:1:{i:0;s:48:"\\phpbb\\db\\migration\\data\\v310\\profilefield_types";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_skype', 'a:3:{i:0;s:56:"\\phpbb\\db\\migration\\data\\v310\\profilefield_contact_field";i:1;s:55:"\\phpbb\\db\\migration\\data\\v310\\profilefield_show_novalue";i:2;s:48:"\\phpbb\\db\\migration\\data\\v310\\profilefield_types";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_twitter', 'a:3:{i:0;s:56:"\\phpbb\\db\\migration\\data\\v310\\profilefield_contact_field";i:1;s:55:"\\phpbb\\db\\migration\\data\\v310\\profilefield_show_novalue";i:2;s:48:"\\phpbb\\db\\migration\\data\\v310\\profilefield_types";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_types', 'a:1:{i:0;s:36:"\\phpbb\\db\\migration\\data\\v310\\alpha2";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_website', 'a:2:{i:0;s:56:"\\phpbb\\db\\migration\\data\\v310\\profilefield_on_memberlist";i:1;s:54:"\\phpbb\\db\\migration\\data\\v310\\profilefield_icq_cleanup";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_website_cleanup', 'a:1:{i:0;s:50:"\\phpbb\\db\\migration\\data\\v310\\profilefield_website";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_wlm', 'a:1:{i:0;s:58:"\\phpbb\\db\\migration\\data\\v310\\profilefield_website_cleanup";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_wlm_cleanup', 'a:1:{i:0;s:46:"\\phpbb\\db\\migration\\data\\v310\\profilefield_wlm";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_yahoo', 'a:1:{i:0;s:54:"\\phpbb\\db\\migration\\data\\v310\\profilefield_wlm_cleanup";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_yahoo_cleanup', 'a:1:{i:0;s:48:"\\phpbb\\db\\migration\\data\\v310\\profilefield_yahoo";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\profilefield_youtube', 'a:3:{i:0;s:56:"\\phpbb\\db\\migration\\data\\v310\\profilefield_contact_field";i:1;s:55:"\\phpbb\\db\\migration\\data\\v310\\profilefield_show_novalue";i:2;s:48:"\\phpbb\\db\\migration\\data\\v310\\profilefield_types";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\prune_shadow_topics', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\rc1', 'a:9:{i:0;s:35:"\\phpbb\\db\\migration\\data\\v310\\beta4";i:1;s:54:"\\phpbb\\db\\migration\\data\\v310\\contact_admin_acp_module";i:2;s:48:"\\phpbb\\db\\migration\\data\\v310\\contact_admin_form";i:3;s:50:"\\phpbb\\db\\migration\\data\\v310\\passwords_convert_p2";i:4;s:51:"\\phpbb\\db\\migration\\data\\v310\\profilefield_facebook";i:5;s:53:"\\phpbb\\db\\migration\\data\\v310\\profilefield_googleplus";i:6;s:48:"\\phpbb\\db\\migration\\data\\v310\\profilefield_skype";i:7;s:50:"\\phpbb\\db\\migration\\data\\v310\\profilefield_twitter";i:8;s:50:"\\phpbb\\db\\migration\\data\\v310\\profilefield_youtube";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\rc2', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\rc1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\rc3', 'a:5:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\rc2";i:1;s:45:"\\phpbb\\db\\migration\\data\\v310\\captcha_plugins";i:2;s:53:"\\phpbb\\db\\migration\\data\\v310\\rename_too_long_indexes";i:3;s:41:"\\phpbb\\db\\migration\\data\\v310\\search_type";i:4;s:49:"\\phpbb\\db\\migration\\data\\v310\\topic_sort_username";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\rc4', 'a:2:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\rc3";i:1;s:57:"\\phpbb\\db\\migration\\data\\v310\\notifications_use_full_name";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\rc5', 'a:3:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\rc4";i:1;s:66:"\\phpbb\\db\\migration\\data\\v310\\profilefield_field_validation_length";i:2;s:53:"\\phpbb\\db\\migration\\data\\v310\\remove_acp_styles_cache";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\rc6', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\rc5";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\remove_acp_styles_cache', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\rc4";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\rename_too_long_indexes', 'a:1:{i:0;s:43:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_0";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\reported_posts_display', 'a:1:{i:0;s:44:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\reset_missing_captcha_plugin', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\search_type', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\signature_module_auth', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\soft_delete_mod_convert', 'a:1:{i:0;s:36:"\\phpbb\\db\\migration\\data\\v310\\alpha3";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\soft_delete_mod_convert2', 'a:1:{i:0;s:53:"\\phpbb\\db\\migration\\data\\v310\\soft_delete_mod_convert";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\softdelete_mcp_modules', 'a:2:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";i:1;s:43:"\\phpbb\\db\\migration\\data\\v310\\softdelete_p2";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\softdelete_p1', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\softdelete_p2', 'a:2:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";i:1;s:43:"\\phpbb\\db\\migration\\data\\v310\\softdelete_p1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\style_update_p1', 'a:1:{i:0;s:44:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\style_update_p2', 'a:1:{i:0;s:45:"\\phpbb\\db\\migration\\data\\v310\\style_update_p1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\teampage', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\timezone', 'a:1:{i:0;s:44:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\timezone_p2', 'a:1:{i:0;s:38:"\\phpbb\\db\\migration\\data\\v310\\timezone";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\topic_sort_username', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v310\\ucp_popuppm_module', 'a:1:{i:0;s:33:"\\phpbb\\db\\migration\\data\\v310\\dev";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v31x\\m_softdelete_global', 'a:1:{i:0;s:34:"\\phpbb\\db\\migration\\data\\v31x\\v311";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v31x\\plupload_last_gc_dynamic', 'a:1:{i:0;s:34:"\\phpbb\\db\\migration\\data\\v31x\\v312";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v31x\\profilefield_remove_underscore_from_alpha', 'a:1:{i:0;s:34:"\\phpbb\\db\\migration\\data\\v31x\\v311";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v31x\\profilefield_yahoo_update_url', 'a:1:{i:0;s:34:"\\phpbb\\db\\migration\\data\\v31x\\v312";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v31x\\style_update', 'a:1:{i:0;s:34:"\\phpbb\\db\\migration\\data\\v310\\gold";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v31x\\update_custom_bbcodes_with_idn', 'a:1:{i:0;s:34:"\\phpbb\\db\\migration\\data\\v31x\\v312";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v31x\\v311', 'a:2:{i:0;s:34:"\\phpbb\\db\\migration\\data\\v310\\gold";i:1;s:42:"\\phpbb\\db\\migration\\data\\v31x\\style_update";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v31x\\v312', 'a:1:{i:0;s:37:"\\phpbb\\db\\migration\\data\\v31x\\v312rc1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v31x\\v312rc1', 'a:2:{i:0;s:34:"\\phpbb\\db\\migration\\data\\v31x\\v311";i:1;s:49:"\\phpbb\\db\\migration\\data\\v31x\\m_softdelete_global";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v31x\\v313', 'a:1:{i:0;s:37:"\\phpbb\\db\\migration\\data\\v31x\\v313rc2";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v31x\\v313rc1', 'a:5:{i:0;s:48:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_13_rc1";i:1;s:54:"\\phpbb\\db\\migration\\data\\v31x\\plupload_last_gc_dynamic";i:2;s:71:"\\phpbb\\db\\migration\\data\\v31x\\profilefield_remove_underscore_from_alpha";i:3;s:59:"\\phpbb\\db\\migration\\data\\v31x\\profilefield_yahoo_update_url";i:4;s:60:"\\phpbb\\db\\migration\\data\\v31x\\update_custom_bbcodes_with_idn";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v31x\\v313rc2', 'a:2:{i:0;s:48:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_13_pl1";i:1;s:37:"\\phpbb\\db\\migration\\data\\v31x\\v313rc1";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v31x\\v314', 'a:2:{i:0;s:44:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_14";i:1;s:37:"\\phpbb\\db\\migration\\data\\v31x\\v314rc2";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v31x\\v314rc1', 'a:1:{i:0;s:34:"\\phpbb\\db\\migration\\data\\v31x\\v313";}', 1, 1, '', 1431076934, 1431076934),
	('\\phpbb\\db\\migration\\data\\v31x\\v314rc2', 'a:2:{i:0;s:48:"\\phpbb\\db\\migration\\data\\v30x\\release_3_0_14_rc1";i:1;s:37:"\\phpbb\\db\\migration\\data\\v31x\\v314rc1";}', 1, 1, '', 1431076934, 1431076934);
/*!40000 ALTER TABLE `phpbb_migrations` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
