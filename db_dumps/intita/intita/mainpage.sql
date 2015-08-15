-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-15 11:35:05
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table intita.mainpage
DROP TABLE IF EXISTS `mainpage`;
CREATE TABLE IF NOT EXISTS `mainpage` (
  `id` int(11) NOT NULL,
  `sliderTextureURL` varchar(255) NOT NULL,
  `sliderLineURL` varchar(255) NOT NULL,
  `subLineImage` varchar(255) NOT NULL,
  `hexagon` varchar(255) NOT NULL,
  `imageNetwork` varchar(255) NOT NULL,
  `formFon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table intita.mainpage: ~1 rows (approximately)
/*!40000 ALTER TABLE `mainpage` DISABLE KEYS */;
INSERT INTO `mainpage` (`id`, `sliderTextureURL`, `sliderLineURL`, `subLineImage`, `hexagon`, `imageNetwork`, `formFon`) VALUES
	(0, '/css/images/slider_img/texture.png', '/css/images/slider_img/line.png', 'line1.png', 'hexagon.png', 'networking.png', 'formFon.png');
/*!40000 ALTER TABLE `mainpage` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
