-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-15 11:35:27
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table mibew.config
DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vckey` varchar(255) DEFAULT NULL,
  `vcvalue` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- Dumping data for table mibew.config: ~31 rows (approximately)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`id`, `vckey`, `vcvalue`) VALUES
	(1, 'dbversion', '2.0.0-beta.5'),
	(2, '_threads_close_old_lock_time', '0'),
	(3, 'email', ''),
	(4, 'title', 'INTITA'),
	(5, 'logo', 'http://intita.itatests.com/images/mainpage/hamburgerlogo.png'),
	(6, 'hosturl', 'http://intita.itatests.com'),
	(7, 'usernamepattern', '{name}'),
	(8, 'chattitle', 'Live Support'),
	(9, 'geolink', 'http://api.hostip.info/get_html.php?ip={ip}'),
	(10, 'geolinkparams', 'width=440,height=100,toolbar=0,scrollbars=0,location=0,status=1,menubar=0,resizable=1'),
	(11, 'cron_key', '8f27403ab455807551296c93ff44843b'),
	(12, 'sendmessagekey', 'enter'),
	(13, 'left_messages_locale', 'ua'),
	(14, 'chat_style', 'default'),
	(15, 'page_style', 'default'),
	(16, 'enableban', '0'),
	(17, 'usercanchangename', '1'),
	(18, 'enablegroups', '0'),
	(19, 'enablegroupsisolation', '0'),
	(20, 'enablestatistics', '1'),
	(21, 'enabletracking', '0'),
	(22, 'enablessl', '0'),
	(23, 'forcessl', '0'),
	(24, 'enablepresurvey', '1'),
	(25, 'surveyaskmail', '0'),
	(26, 'surveyaskgroup', '1'),
	(27, 'surveyaskmessage', '0'),
	(28, 'enablepopupnotification', '0'),
	(29, 'showonlineoperators', '0'),
	(30, 'enablecaptcha', '0'),
	(31, 'trackoperators', '0');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
