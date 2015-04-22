-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-04-22 15:37:34
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.lectures
DROP TABLE IF EXISTS `lectures`;
CREATE TABLE IF NOT EXISTS `lectures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `alias` varchar(10) NOT NULL,
  `language` varchar(6) NOT NULL,
  `idModule` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `idType` int(11) NOT NULL,
  `durationInMinutes` int(11) NOT NULL,
  `maxNumber` int(11) NOT NULL,
  `iconIsDone` varchar(255) NOT NULL,
  `preLecture` int(11) NOT NULL,
  `nextLecture` int(11) NOT NULL,
  `idTeacher` varchar(50) NOT NULL,
  `lectureUnwatchedImage` varchar(255) NOT NULL,
  `lectureOverlookedImage` varchar(255) NOT NULL,
  `lectureTimeImage` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.lectures: ~3 rows (approximately)
/*!40000 ALTER TABLE `lectures` DISABLE KEYS */;
INSERT INTO `lectures` (`id`, `image`, `alias`, `language`, `idModule`, `order`, `title`, `idType`, `durationInMinutes`, `maxNumber`, `iconIsDone`, `preLecture`, `nextLecture`, `idTeacher`, `lectureUnwatchedImage`, `lectureOverlookedImage`, `lectureTimeImage`) VALUES
	(1, '/css/images/lectureImage.png', 'lecture1', 'UA', 1, 3, 'Змінні та типи даних в PHP', 1, 40, 6, '/css/images/medalIcoFalse.png', 2, 4, '2', '/css/images/ratIco0.png', '/css/images/ratIco1.png', '/css/images/timeIco.png'),
	(2, '/css/images/lectureImage.png', 'lecture2', 'UA', 1, 2, 'Змінні та типи даних в PHP', 1, 50, 6, '/css/images/medalIcoFalse.png', 1, 3, '2', '/css/images/ratIco0.png', '/css/images/ratIco1.png', '/css/images/timeIco.png'),
	(3, '/css/images/lectureImage.png', 'lecture3', 'UA', 1, 4, 'Змінні та типи даних в PHP', 1, 60, 6, '/css/images/medalIcoFalse.png', 3, 5, '3', '/css/images/ratIco0.png', '/css/images/ratIco1.png', '/css/images/timeIco.png');
/*!40000 ALTER TABLE `lectures` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
