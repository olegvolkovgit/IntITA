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

-- Dumping structure for table mibew.threadstatistics
DROP TABLE IF EXISTS `threadstatistics`;
CREATE TABLE IF NOT EXISTS `threadstatistics` (
  `statid` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL DEFAULT '0',
  `threads` int(11) NOT NULL DEFAULT '0',
  `missedthreads` int(11) NOT NULL DEFAULT '0',
  `sentinvitations` int(11) NOT NULL DEFAULT '0',
  `acceptedinvitations` int(11) NOT NULL DEFAULT '0',
  `rejectedinvitations` int(11) NOT NULL DEFAULT '0',
  `ignoredinvitations` int(11) NOT NULL DEFAULT '0',
  `operatormessages` int(11) NOT NULL DEFAULT '0',
  `usermessages` int(11) NOT NULL DEFAULT '0',
  `averagewaitingtime` float(10,1) NOT NULL DEFAULT '0.0',
  `averagechattime` float(10,1) NOT NULL DEFAULT '0.0',
  PRIMARY KEY (`statid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mibew.threadstatistics: ~0 rows (approximately)
/*!40000 ALTER TABLE `threadstatistics` DISABLE KEYS */;
/*!40000 ALTER TABLE `threadstatistics` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
