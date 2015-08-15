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

-- Dumping structure for table mibew.requestcallback
DROP TABLE IF EXISTS `requestcallback`;
CREATE TABLE IF NOT EXISTS `requestcallback` (
  `callbackid` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(64) NOT NULL DEFAULT '',
  `function` varchar(64) NOT NULL,
  `arguments` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`callbackid`),
  KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mibew.requestcallback: ~0 rows (approximately)
/*!40000 ALTER TABLE `requestcallback` DISABLE KEYS */;
/*!40000 ALTER TABLE `requestcallback` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
