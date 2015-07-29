-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-29 20:33:48
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.phpbb_confirm
DROP TABLE IF EXISTS `phpbb_confirm`;
CREATE TABLE IF NOT EXISTS `phpbb_confirm` (
  `confirm_id` char(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_id` char(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `confirm_type` tinyint(3) NOT NULL DEFAULT '0',
  `code` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `seed` int(10) unsigned NOT NULL DEFAULT '0',
  `attempts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`,`confirm_id`),
  KEY `confirm_type` (`confirm_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_confirm: ~2 rows (approximately)
/*!40000 ALTER TABLE `phpbb_confirm` DISABLE KEYS */;
INSERT INTO `phpbb_confirm` (`confirm_id`, `session_id`, `confirm_type`, `code`, `seed`, `attempts`) VALUES
	('2830969b238dec10e357e095aa0e3320', 'a14607b99617416873efb27c4fdca3be', 3, 'SISHHIN', 2111714611, 0),
	('cc1671e64d6429a443fd35ab8022f2c9', 'a14607b99617416873efb27c4fdca3be', 3, '3BLU2UI', 1973978072, 0);
/*!40000 ALTER TABLE `phpbb_confirm` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
