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

-- Dumping structure for table mibew.opgroup
DROP TABLE IF EXISTS `opgroup`;
CREATE TABLE IF NOT EXISTS `opgroup` (
  `groupid` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `vcemail` varchar(64) DEFAULT NULL,
  `vclocalname` varchar(64) NOT NULL,
  `vccommonname` varchar(64) NOT NULL,
  `vclocaldescription` varchar(1024) NOT NULL,
  `vccommondescription` varchar(1024) NOT NULL,
  `iweight` int(11) NOT NULL DEFAULT '0',
  `vctitle` varchar(255) DEFAULT '',
  `vcchattitle` varchar(255) DEFAULT '',
  `vclogo` varchar(255) DEFAULT '',
  `vchosturl` varchar(255) DEFAULT '',
  PRIMARY KEY (`groupid`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mibew.opgroup: ~0 rows (approximately)
/*!40000 ALTER TABLE `opgroup` DISABLE KEYS */;
/*!40000 ALTER TABLE `opgroup` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
