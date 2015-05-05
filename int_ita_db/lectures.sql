-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-05-06 00:46:28
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.lectures
DROP TABLE IF EXISTS `lectures`;
CREATE TABLE IF NOT EXISTS `lectures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `alias` varchar(10) NOT NULL,
  `language` varchar(6) DEFAULT NULL,
  `idModule` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `idType` int(11) DEFAULT NULL,
  `durationInMinutes` int(11) DEFAULT NULL,
  `maxNumber` int(11) DEFAULT NULL,
  `iconIsDone` varchar(255) DEFAULT NULL,
  `preLecture` int(11) DEFAULT NULL,
  `nextLecture` int(11) DEFAULT NULL,
  `idTeacher` varchar(50) DEFAULT NULL,
  `lectureUnwatchedImage` varchar(255) DEFAULT NULL,
  `lectureOverlookedImage` varchar(255) DEFAULT NULL,
  `lectureTimeImage` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.lectures: ~15 rows (approximately)
/*!40000 ALTER TABLE `lectures` DISABLE KEYS */;
INSERT INTO `lectures` (`id`, `image`, `alias`, `language`, `idModule`, `order`, `title`, `idType`, `durationInMinutes`, `maxNumber`, `iconIsDone`, `preLecture`, `nextLecture`, `idTeacher`, `lectureUnwatchedImage`, `lectureOverlookedImage`, `lectureTimeImage`) VALUES
	(1, '/css/images/lectureImage.png', 'lecture1', 'ua', 1, 2, 'Змінні та типи даних в PHP', 1, 40, 6, '/css/images/medalIcoFalse.png', 2, 4, '2', '/css/images/ratIco0.png', '/css/images/ratIco1.png', '/css/images/timeIco.png'),
	(2, '/css/images/lectureImage.png', 'lecture2', 'ua', 1, 6, 'Основи синтаксису', 1, 50, 6, '/css/images/medalIcoFalse.png', 1, 3, '2', '/css/images/ratIco0.png', '/css/images/ratIco1.png', '/css/images/timeIco.png'),
	(3, '/css/images/lectureImage.png', 'lecture3', 'ua', 1, 1, 'Обробка запитів з допомогою PHP', 1, 60, 6, '/css/images/medalIcoFalse.png', 3, 5, '3', '/css/images/ratIco0.png', '/css/images/ratIco1.png', '/css/images/timeIco.png'),
	(5, '/css/images/lectureImage.png', 'lecture4', 'ua', 0, 0, 'Функції в PHP', 1, 60, NULL, NULL, NULL, NULL, NULL, '/css/images/ratIco0.png', '/css/images/ratIco1.png', '/css/images/timeIco.png'),
	(14, '/css/images/lectureImage.png', 'lecture5', 'ua', 0, 0, 'Об\'єкти і класи PHP', 1, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(15, '/css/images/lectureImage.png', 'lecture6', 'ua', 1, 3, 'Робота з масивами даних', 1, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(16, '/css/images/lectureImage.png', 'lecture7', 'ua', 1, 4, 'Робота з стрічками', 1, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(17, '/css/images/lectureImage.png', 'lecture8', 'ua', 1, 5, 'Робота з файловою системою', 1, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(18, '/css/images/lectureImage.png', 'lecture9', 'ua', 1, 7, 'Бази даних і СУБД. Введення в SQL', 1, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(19, '/css/images/lectureImage.png', 'lecture10', 'ua', 1, 10, 'Взаємодія PHP і MySQL', 1, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(20, '/css/images/lectureImage.png', 'lecture11', 'ua', 1, 11, 'Авторизація доступу з допомогою сесій', 1, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(21, '/css/images/lectureImage.png', 'lecture12', 'ua', 1, 12, 'Регулярні вирази', 1, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(22, NULL, 'lecture13', 'ua', 1, 13, 'Взаємодія PHP і XML', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(23, NULL, 'lecture14', 'ua', 0, 0, 'Приклади коду', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(24, NULL, 'lecture15', 'ua', 0, 0, 'Список літератури', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `lectures` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
