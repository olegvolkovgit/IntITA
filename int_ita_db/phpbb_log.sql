-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-03 15:51:20
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.phpbb_log
DROP TABLE IF EXISTS `phpbb_log`;
CREATE TABLE IF NOT EXISTS `phpbb_log` (
  `log_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `log_type` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `reportee_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `log_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `log_time` int(11) unsigned NOT NULL DEFAULT '0',
  `log_operation` text COLLATE utf8_bin NOT NULL,
  `log_data` mediumtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `log_type` (`log_type`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`),
  KEY `reportee_id` (`reportee_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_log: ~4 rows (approximately)
/*!40000 ALTER TABLE `phpbb_log` DISABLE KEYS */;
INSERT INTO `phpbb_log` (`log_id`, `log_type`, `user_id`, `forum_id`, `topic_id`, `reportee_id`, `log_ip`, `log_time`, `log_operation`, `log_data`) VALUES
	(1, 0, 2, 0, 0, 0, '127.0.0.1', 1431076934, 'LOG_INSTALL_INSTALLED', 'a:1:{i:0;s:5:"3.1.4";}'),
	(2, 2, 1, 0, 0, 0, '::1', 1431693780, 'LOG_GENERAL_ERROR', 'a:2:{i:0;s:13:"General Error";i:1;s:1513:"SQL ERROR [ mysqli ]<br /><br />Table \'int_ita_db.phpbb_acl_groups\' doesn\'t exist [1146]<br /><br />SQL<br /><br />DELETE FROM phpbb_acl_groups\r\n		WHERE forum_id NOT IN (0, \'1\', \'2\')<br /><br />BACKTRACE<br /><div style="font-family: monospace;"><br /><b>FILE:</b> (not given by php)<br /><b>LINE:</b> (not given by php)<br /><b>CALL:</b> msg_handler()<br /><br /><b>FILE:</b> [ROOT]/phpbb/db/driver/driver.php<br /><b>LINE:</b> 855<br /><b>CALL:</b> trigger_error()<br /><br /><b>FILE:</b> [ROOT]/phpbb/db/driver/mysqli.php<br /><b>LINE:</b> 193<br /><b>CALL:</b> phpbb\\db\\driver\\driver-&gt;sql_error()<br /><br /><b>FILE:</b> [ROOT]/phpbb/db/driver/factory.php<br /><b>LINE:</b> 329<br /><b>CALL:</b> phpbb\\db\\driver\\mysqli-&gt;sql_query()<br /><br /><b>FILE:</b> [ROOT]/includes/functions_admin.php<br /><b>LINE:</b> 3113<br /><b>CALL:</b> phpbb\\db\\driver\\factory-&gt;sql_query()<br /><br /><b>FILE:</b> [ROOT]/phpbb/cron/task/core/tidy_database.php<br /><b>LINE:</b> 50<br /><b>CALL:</b> tidy_database()<br /><br /><b>FILE:</b> (not given by php)<br /><b>LINE:</b> (not given by php)<br /><b>CALL:</b> phpbb\\cron\\task\\core\\tidy_database-&gt;run()<br /><br /><b>FILE:</b> [ROOT]/phpbb/cron/task/wrapper.php<br /><b>LINE:</b> 104<br /><b>CALL:</b> call_user_func_array()<br /><br /><b>FILE:</b> [ROOT]/cron.php<br /><b>LINE:</b> 64<br /><b>CALL:</b> phpbb\\cron\\task\\wrapper-&gt;__call()<br /><br /><b>FILE:</b> [ROOT]/cron.php<br /><b>LINE:</b> 64<br /><b>CALL:</b> phpbb\\cron\\task\\wrapper-&gt;run()<br /></div>";}'),
	(3, 2, 1, 0, 0, 0, '::1', 1433429455, 'LOG_GENERAL_ERROR', 'a:2:{i:0;s:13:"General Error";i:1;s:1513:"SQL ERROR [ mysqli ]<br /><br />Table \'int_ita_db.phpbb_acl_groups\' doesn\'t exist [1146]<br /><br />SQL<br /><br />DELETE FROM phpbb_acl_groups\r\n		WHERE forum_id NOT IN (0, \'1\', \'2\')<br /><br />BACKTRACE<br /><div style="font-family: monospace;"><br /><b>FILE:</b> (not given by php)<br /><b>LINE:</b> (not given by php)<br /><b>CALL:</b> msg_handler()<br /><br /><b>FILE:</b> [ROOT]/phpbb/db/driver/driver.php<br /><b>LINE:</b> 855<br /><b>CALL:</b> trigger_error()<br /><br /><b>FILE:</b> [ROOT]/phpbb/db/driver/mysqli.php<br /><b>LINE:</b> 193<br /><b>CALL:</b> phpbb\\db\\driver\\driver-&gt;sql_error()<br /><br /><b>FILE:</b> [ROOT]/phpbb/db/driver/factory.php<br /><b>LINE:</b> 329<br /><b>CALL:</b> phpbb\\db\\driver\\mysqli-&gt;sql_query()<br /><br /><b>FILE:</b> [ROOT]/includes/functions_admin.php<br /><b>LINE:</b> 3113<br /><b>CALL:</b> phpbb\\db\\driver\\factory-&gt;sql_query()<br /><br /><b>FILE:</b> [ROOT]/phpbb/cron/task/core/tidy_database.php<br /><b>LINE:</b> 50<br /><b>CALL:</b> tidy_database()<br /><br /><b>FILE:</b> (not given by php)<br /><b>LINE:</b> (not given by php)<br /><b>CALL:</b> phpbb\\cron\\task\\core\\tidy_database-&gt;run()<br /><br /><b>FILE:</b> [ROOT]/phpbb/cron/task/wrapper.php<br /><b>LINE:</b> 104<br /><b>CALL:</b> call_user_func_array()<br /><br /><b>FILE:</b> [ROOT]/cron.php<br /><b>LINE:</b> 64<br /><b>CALL:</b> phpbb\\cron\\task\\wrapper-&gt;__call()<br /><br /><b>FILE:</b> [ROOT]/cron.php<br /><b>LINE:</b> 64<br /><b>CALL:</b> phpbb\\cron\\task\\wrapper-&gt;run()<br /></div>";}'),
	(4, 1, 2, 2, 3, 0, '::1', 1433430282, 'LOG_POST_APPROVED', 'a:1:{i:0;s:18:"Re: 4 червня";}');
/*!40000 ALTER TABLE `phpbb_log` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
