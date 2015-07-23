-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-22 19:38:55
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.phpbb_config
DROP TABLE IF EXISTS `phpbb_config`;
CREATE TABLE IF NOT EXISTS `phpbb_config` (
  `config_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `config_value` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `is_dynamic` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`config_name`),
  KEY `is_dynamic` (`is_dynamic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_config: ~296 rows (approximately)
/*!40000 ALTER TABLE `phpbb_config` DISABLE KEYS */;
INSERT INTO `phpbb_config` (`config_name`, `config_value`, `is_dynamic`) VALUES
	('active_sessions', '0', 0),
	('allow_attachments', '1', 0),
	('allow_autologin', '1', 0),
	('allow_avatar', '1', 0),
	('allow_avatar_gravatar', '0', 0),
	('allow_avatar_local', '0', 0),
	('allow_avatar_remote', '0', 0),
	('allow_avatar_remote_upload', '0', 0),
	('allow_avatar_upload', '1', 0),
	('allow_bbcode', '1', 0),
	('allow_birthdays', '1', 0),
	('allow_bookmarks', '1', 0),
	('allow_cdn', '0', 0),
	('allow_emailreuse', '0', 0),
	('allow_forum_notify', '1', 0),
	('allow_live_searches', '1', 0),
	('allow_mass_pm', '1', 0),
	('allow_name_chars', 'USERNAME_CHARS_ANY', 0),
	('allow_namechange', '0', 0),
	('allow_nocensors', '0', 0),
	('allow_password_reset', '1', 0),
	('allow_pm_attach', '0', 0),
	('allow_pm_report', '1', 0),
	('allow_post_flash', '1', 0),
	('allow_post_links', '1', 0),
	('allow_privmsg', '1', 0),
	('allow_quick_reply', '1', 0),
	('allow_sig', '1', 0),
	('allow_sig_bbcode', '1', 0),
	('allow_sig_flash', '0', 0),
	('allow_sig_img', '1', 0),
	('allow_sig_links', '1', 0),
	('allow_sig_pm', '1', 0),
	('allow_sig_smilies', '1', 0),
	('allow_smilies', '1', 0),
	('allow_topic_notify', '1', 0),
	('assets_version', '1', 0),
	('attachment_quota', '52428800', 0),
	('auth_bbcode_pm', '1', 0),
	('auth_flash_pm', '0', 0),
	('auth_img_pm', '1', 0),
	('auth_method', 'db', 0),
	('auth_smilies_pm', '1', 0),
	('avatar_filesize', '6144', 0),
	('avatar_gallery_path', 'images/avatars/gallery', 0),
	('avatar_max_height', '90', 0),
	('avatar_max_width', '90', 0),
	('avatar_min_height', '20', 0),
	('avatar_min_width', '20', 0),
	('avatar_path', 'images/avatars/upload', 0),
	('avatar_salt', '3fb48adc0dd274aaf401e3442d2697a0', 0),
	('board_contact', 'intita.hr@gmail.com', 0),
	('board_contact_name', '', 0),
	('board_disable', '0', 0),
	('board_disable_msg', '', 0),
	('board_email', 'intita.hr@gmail.com', 0),
	('board_email_form', '0', 0),
	('board_email_sig', 'Дякуємо, Адміністрація', 0),
	('board_hide_emails', '1', 0),
	('board_index_text', '', 0),
	('board_startdate', '1431076924', 0),
	('board_timezone', 'UTC', 0),
	('browser_check', '1', 0),
	('bump_interval', '10', 0),
	('bump_type', 'd', 0),
	('cache_gc', '7200', 0),
	('cache_last_gc', '1436270582', 1),
	('captcha_gd', '1', 0),
	('captcha_gd_3d_noise', '1', 0),
	('captcha_gd_fonts', '1', 0),
	('captcha_gd_foreground_noise', '0', 0),
	('captcha_gd_wave', '0', 0),
	('captcha_gd_x_grid', '25', 0),
	('captcha_gd_y_grid', '25', 0),
	('captcha_plugin', 'core.captcha.plugins.gd', 0),
	('check_attachment_content', '1', 0),
	('check_dnsbl', '0', 0),
	('chg_passforce', '0', 0),
	('confirm_refresh', '1', 0),
	('contact_admin_form_enable', '1', 0),
	('cookie_domain', 'intita', 0),
	('cookie_name', 'phpbb3_6vpfb', 0),
	('cookie_path', '/', 0),
	('cookie_secure', '0', 0),
	('coppa_enable', '0', 0),
	('coppa_fax', '', 0),
	('coppa_mail', '', 0),
	('cron_lock', '0', 1),
	('database_gc', '604800', 0),
	('database_last_gc', '1436982166', 1),
	('dbms_version', '5.5.41-log', 0),
	('default_dateformat', 'D M d, Y g:i a', 0),
	('default_lang', 'uk', 0),
	('default_style', '1', 0),
	('delete_time', '0', 0),
	('display_last_edited', '1', 0),
	('display_last_subject', '1', 0),
	('display_order', '0', 0),
	('edit_time', '0', 0),
	('email_check_mx', '1', 0),
	('email_enable', '1', 0),
	('email_function_name', 'mail', 0),
	('email_max_chunk_size', '50', 0),
	('email_package_size', '20', 0),
	('enable_confirm', '1', 0),
	('enable_mod_rewrite', '0', 0),
	('enable_pm_icons', '1', 0),
	('enable_post_confirm', '1', 0),
	('extension_force_unstable', '0', 0),
	('feed_enable', '1', 0),
	('feed_forum', '1', 0),
	('feed_http_auth', '0', 0),
	('feed_item_statistics', '1', 0),
	('feed_limit_post', '15', 0),
	('feed_limit_topic', '10', 0),
	('feed_overall', '1', 0),
	('feed_overall_forums', '0', 0),
	('feed_topic', '1', 0),
	('feed_topics_active', '0', 0),
	('feed_topics_new', '1', 0),
	('flood_interval', '15', 0),
	('force_server_vars', '0', 0),
	('form_token_lifetime', '7200', 0),
	('form_token_mintime', '0', 0),
	('form_token_sid_guests', '1', 0),
	('forward_pm', '1', 0),
	('forwarded_for_check', '0', 0),
	('full_folder_action', '2', 0),
	('fulltext_mysql_max_word_len', '254', 0),
	('fulltext_mysql_min_word_len', '4', 0),
	('fulltext_native_common_thres', '5', 0),
	('fulltext_native_load_upd', '1', 0),
	('fulltext_native_max_chars', '14', 0),
	('fulltext_native_min_chars', '3', 0),
	('fulltext_postgres_max_word_len', '254', 0),
	('fulltext_postgres_min_word_len', '4', 0),
	('fulltext_postgres_ts_name', 'simple', 0),
	('fulltext_sphinx_indexer_mem_limit', '512', 0),
	('fulltext_sphinx_stopwords', '0', 0),
	('gzip_compress', '0', 0),
	('hot_threshold', '25', 0),
	('icons_path', 'images/icons', 0),
	('img_create_thumbnail', '0', 0),
	('img_display_inlined', '1', 0),
	('img_imagick', 'd:/openserver/modules/imagemagick', 0),
	('img_link_height', '0', 0),
	('img_link_width', '0', 0),
	('img_max_height', '0', 0),
	('img_max_thumb_width', '400', 0),
	('img_max_width', '0', 0),
	('img_min_thumb_filesize', '12000', 0),
	('ip_check', '3', 0),
	('ip_login_limit_max', '50', 0),
	('ip_login_limit_time', '21600', 0),
	('ip_login_limit_use_forwarded', '0', 0),
	('jab_enable', '0', 0),
	('jab_host', '', 0),
	('jab_package_size', '20', 0),
	('jab_password', '', 0),
	('jab_port', '5222', 0),
	('jab_use_ssl', '0', 0),
	('jab_username', '', 0),
	('last_queue_run', '0', 1),
	('ldap_base_dn', '', 0),
	('ldap_email', '', 0),
	('ldap_password', '', 0),
	('ldap_port', '', 0),
	('ldap_server', '', 0),
	('ldap_uid', '', 0),
	('ldap_user', '', 0),
	('ldap_user_filter', '', 0),
	('legend_sort_groupname', '0', 0),
	('limit_load', '0', 0),
	('limit_search_load', '0', 0),
	('load_anon_lastread', '0', 0),
	('load_birthdays', '1', 0),
	('load_cpf_memberlist', '1', 0),
	('load_cpf_pm', '1', 0),
	('load_cpf_viewprofile', '1', 0),
	('load_cpf_viewtopic', '1', 0),
	('load_db_lastread', '1', 0),
	('load_db_track', '1', 0),
	('load_jquery_url', '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', 0),
	('load_jumpbox', '1', 0),
	('load_moderators', '1', 0),
	('load_notifications', '1', 0),
	('load_online', '1', 0),
	('load_online_guests', '1', 0),
	('load_online_time', '5', 0),
	('load_onlinetrack', '1', 0),
	('load_search', '1', 0),
	('load_tplcompile', '0', 0),
	('load_unreads_search', '1', 0),
	('load_user_activity', '1', 0),
	('max_attachments', '3', 0),
	('max_attachments_pm', '1', 0),
	('max_autologin_time', '0', 0),
	('max_filesize', '262144', 0),
	('max_filesize_pm', '262144', 0),
	('max_login_attempts', '3', 0),
	('max_name_chars', '20', 0),
	('max_num_search_keywords', '10', 0),
	('max_pass_chars', '100', 0),
	('max_poll_options', '10', 0),
	('max_post_chars', '60000', 0),
	('max_post_font_size', '200', 0),
	('max_post_img_height', '0', 0),
	('max_post_img_width', '0', 0),
	('max_post_smilies', '0', 0),
	('max_post_urls', '0', 0),
	('max_quote_depth', '3', 0),
	('max_reg_attempts', '5', 0),
	('max_sig_chars', '255', 0),
	('max_sig_font_size', '200', 0),
	('max_sig_img_height', '0', 0),
	('max_sig_img_width', '0', 0),
	('max_sig_smilies', '0', 0),
	('max_sig_urls', '5', 0),
	('mime_triggers', 'body|head|html|img|plaintext|a href|pre|script|table|title', 0),
	('min_name_chars', '3', 0),
	('min_pass_chars', '6', 0),
	('min_post_chars', '1', 0),
	('min_search_author_chars', '3', 0),
	('new_member_group_default', '0', 0),
	('new_member_post_limit', '3', 0),
	('newest_user_colour', '', 1),
	('newest_user_id', '48', 1),
	('newest_username', 'Ivanna', 1),
	('num_files', '0', 1),
	('num_posts', '3', 1),
	('num_topics', '3', 1),
	('num_users', '2', 1),
	('override_user_style', '0', 0),
	('pass_complex', 'PASS_TYPE_ANY', 0),
	('plupload_last_gc', '0', 1),
	('plupload_salt', '817854cf7a4792286ce9f1c9f42f593c', 0),
	('pm_edit_time', '0', 0),
	('pm_max_boxes', '4', 0),
	('pm_max_msgs', '50', 0),
	('pm_max_recipients', '0', 0),
	('posts_per_page', '10', 0),
	('print_pm', '1', 0),
	('questionnaire_unique_id', '793ec7662bd4d575', 0),
	('queue_interval', '60', 0),
	('rand_seed', '9aa712350dc3b357c95438602d2d37f6', 1),
	('rand_seed_last_update', '1436982164', 1),
	('ranks_path', 'images/ranks', 0),
	('read_notification_expire_days', '30', 0),
	('read_notification_gc', '86400', 0),
	('read_notification_last_gc', '1436270595', 1),
	('record_online_date', '1431077095', 1),
	('record_online_users', '2', 1),
	('referer_validation', '1', 0),
	('require_activation', '0', 0),
	('script_path', '/forum', 0),
	('search_anonymous_interval', '0', 0),
	('search_block_size', '250', 0),
	('search_gc', '7200', 0),
	('search_indexing_state', '', 1),
	('search_interval', '0', 0),
	('search_last_gc', '1436270599', 1),
	('search_store_results', '1800', 0),
	('search_type', '\\phpbb\\search\\fulltext_native', 0),
	('secure_allow_deny', '1', 0),
	('secure_allow_empty_referer', '1', 0),
	('secure_downloads', '0', 0),
	('server_name', 'intita', 0),
	('server_port', '80', 0),
	('server_protocol', 'http://', 0),
	('session_gc', '3600', 0),
	('session_last_gc', '1436536453', 1),
	('session_length', '3600', 0),
	('site_desc', 'IT Академія', 0),
	('site_home_text', '', 0),
	('site_home_url', '', 0),
	('sitename', 'intita.itatests.com', 0),
	('smilies_path', 'images/smilies', 0),
	('smilies_per_page', '50', 0),
	('smtp_auth_method', 'PLAIN', 0),
	('smtp_delivery', '0', 0),
	('smtp_host', '', 0),
	('smtp_password', '', 0),
	('smtp_port', '25', 0),
	('smtp_username', '', 0),
	('teampage_forums', '1', 0),
	('teampage_memberships', '1', 0),
	('topics_per_page', '25', 0),
	('tpl_allow_php', '0', 0),
	('upload_dir_size', '0', 1),
	('upload_icons_path', 'images/upload_icons', 0),
	('upload_path', 'files', 0),
	('use_system_cron', '0', 0),
	('version', '3.1.4', 0),
	('warnings_expire_days', '90', 0),
	('warnings_gc', '14400', 0),
	('warnings_last_gc', '1436270572', 1);
/*!40000 ALTER TABLE `phpbb_config` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
