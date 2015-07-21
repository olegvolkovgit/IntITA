-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-21 01:00:40
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.phpbb_zebra
DROP TABLE IF EXISTS `phpbb_zebra`;
CREATE TABLE IF NOT EXISTS `phpbb_zebra` (
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `zebra_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `friend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `foe` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`zebra_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_zebra: ~0 rows (approximately)
/*!40000 ALTER TABLE `phpbb_zebra` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_zebra` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
