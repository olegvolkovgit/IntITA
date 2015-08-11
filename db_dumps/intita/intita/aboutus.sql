-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-06 16:18:21
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table intita.aboutus
DROP TABLE IF EXISTS `aboutus`;
CREATE TABLE IF NOT EXISTS `aboutus` (
  `blockID` int(11) NOT NULL AUTO_INCREMENT,
  `iconImage` varchar(255) NOT NULL,
  `linkAddress` varchar(255) NOT NULL,
  PRIMARY KEY (`blockID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table intita.aboutus: ~6 rows (approximately)
/*!40000 ALTER TABLE `aboutus` DISABLE KEYS */;
INSERT INTO `aboutus` (`blockID`, `iconImage`, `linkAddress`) VALUES
	(1, 'image1.png', '/index.php?r=aboutus/index&id=1'),
	(2, 'image2.png', '/index.php?r=aboutus/index&id=2'),
	(3, 'image3.png', '/index.php?r=aboutus/index&id=3'),
	(4, 'image1.png', '/index.php?r=aboutus/index&id=1'),
	(5, 'image2.png', '/index.php?r=aboutus/index&id=2'),
	(6, 'image3.png', '/index.php?r=aboutus/index&id=3');
/*!40000 ALTER TABLE `aboutus` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
