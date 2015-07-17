-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-17 18:30:19
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.phpbb_bots
DROP TABLE IF EXISTS `phpbb_bots`;
CREATE TABLE IF NOT EXISTS `phpbb_bots` (
  `bot_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `bot_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `bot_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `bot_agent` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bot_ip` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`bot_id`),
  KEY `bot_active` (`bot_active`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_bots: ~45 rows (approximately)
/*!40000 ALTER TABLE `phpbb_bots` DISABLE KEYS */;
INSERT INTO `phpbb_bots` (`bot_id`, `bot_active`, `bot_name`, `user_id`, `bot_agent`, `bot_ip`) VALUES
	(1, 1, 'AdsBot [Google]', 3, 'AdsBot-Google', ''),
	(2, 1, 'Alexa [Bot]', 4, 'ia_archiver', ''),
	(3, 1, 'Alta Vista [Bot]', 5, 'Scooter/', ''),
	(4, 1, 'Ask Jeeves [Bot]', 6, 'Ask Jeeves', ''),
	(5, 1, 'Baidu [Spider]', 7, 'Baiduspider', ''),
	(6, 1, 'Bing [Bot]', 8, 'bingbot/', ''),
	(7, 1, 'Exabot [Bot]', 9, 'Exabot', ''),
	(8, 1, 'FAST Enterprise [Crawler]', 10, 'FAST Enterprise Crawler', ''),
	(9, 1, 'FAST WebCrawler [Crawler]', 11, 'FAST-WebCrawler/', ''),
	(10, 1, 'Francis [Bot]', 12, 'http://www.neomo.de/', ''),
	(11, 1, 'Gigabot [Bot]', 13, 'Gigabot/', ''),
	(12, 1, 'Google Adsense [Bot]', 14, 'Mediapartners-Google', ''),
	(13, 1, 'Google Desktop', 15, 'Google Desktop', ''),
	(14, 1, 'Google Feedfetcher', 16, 'Feedfetcher-Google', ''),
	(15, 1, 'Google [Bot]', 17, 'Googlebot', ''),
	(16, 1, 'Heise IT-Markt [Crawler]', 18, 'heise-IT-Markt-Crawler', ''),
	(17, 1, 'Heritrix [Crawler]', 19, 'heritrix/1.', ''),
	(18, 1, 'IBM Research [Bot]', 20, 'ibm.com/cs/crawler', ''),
	(19, 1, 'ICCrawler - ICjobs', 21, 'ICCrawler - ICjobs', ''),
	(20, 1, 'ichiro [Crawler]', 22, 'ichiro/', ''),
	(21, 1, 'Majestic-12 [Bot]', 23, 'MJ12bot/', ''),
	(22, 1, 'Metager [Bot]', 24, 'MetagerBot/', ''),
	(23, 1, 'MSN NewsBlogs', 25, 'msnbot-NewsBlogs/', ''),
	(24, 1, 'MSN [Bot]', 26, 'msnbot/', ''),
	(25, 1, 'MSNbot Media', 27, 'msnbot-media/', ''),
	(26, 1, 'Nutch [Bot]', 28, 'http://lucene.apache.org/nutch/', ''),
	(27, 1, 'Online link [Validator]', 29, 'online link validator', ''),
	(28, 1, 'psbot [Picsearch]', 30, 'psbot/0', ''),
	(29, 1, 'Sensis [Crawler]', 31, 'Sensis Web Crawler', ''),
	(30, 1, 'SEO Crawler', 32, 'SEO search Crawler/', ''),
	(31, 1, 'Seoma [Crawler]', 33, 'Seoma [SEO Crawler]', ''),
	(32, 1, 'SEOSearch [Crawler]', 34, 'SEOsearch/', ''),
	(33, 1, 'Snappy [Bot]', 35, 'Snappy/1.1 ( http://www.urltrends.com/ )', ''),
	(34, 1, 'Steeler [Crawler]', 36, 'http://www.tkl.iis.u-tokyo.ac.jp/~crawler/', ''),
	(35, 1, 'Telekom [Bot]', 37, 'crawleradmin.t-info@telekom.de', ''),
	(36, 1, 'TurnitinBot [Bot]', 38, 'TurnitinBot/', ''),
	(37, 1, 'Voyager [Bot]', 39, 'voyager/', ''),
	(38, 1, 'W3 [Sitesearch]', 40, 'W3 SiteSearch Crawler', ''),
	(39, 1, 'W3C [Linkcheck]', 41, 'W3C-checklink/', ''),
	(40, 1, 'W3C [Validator]', 42, 'W3C_Validator', ''),
	(41, 1, 'YaCy [Bot]', 43, 'yacybot', ''),
	(42, 1, 'Yahoo MMCrawler [Bot]', 44, 'Yahoo-MMCrawler/', ''),
	(43, 1, 'Yahoo Slurp [Bot]', 45, 'Yahoo! DE Slurp', ''),
	(44, 1, 'Yahoo [Bot]', 46, 'Yahoo! Slurp', ''),
	(45, 1, 'YahooSeeker [Bot]', 47, 'YahooSeeker/', '');
/*!40000 ALTER TABLE `phpbb_bots` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
