-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-10 17:27:19
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table intita.header
DROP TABLE IF EXISTS `header`;
CREATE TABLE IF NOT EXISTS `header` (
  `headerID` int(11) NOT NULL AUTO_INCREMENT,
  `logoURL` varchar(255) NOT NULL,
  `smallLogoURL` varchar(255) NOT NULL,
  `item1Link` varchar(255) NOT NULL,
  `item2Link` varchar(255) NOT NULL,
  `item3Link` varchar(255) NOT NULL,
  `item4Link` varchar(255) NOT NULL,
  PRIMARY KEY (`headerID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table intita.header: ~2 rows (approximately)
/*!40000 ALTER TABLE `header` DISABLE KEYS */;
INSERT INTO `header` (`headerID`, `logoURL`, `smallLogoURL`, `item1Link`, `item2Link`, `item3Link`, `item4Link`) VALUES
	(1, '/css/images/Logo_big.png', '/css/images/Logo_small.png', '/courses', '/teachers', '/forum', '/aboutus'),
	(2, '/css/images/Logo_big.png', '/css/images/Logo_small.png', '/courses', '/teachers', '/forum', '/aboutus');
/*!40000 ALTER TABLE `header` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
