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

-- Dumping structure for table mibew.cannedmessage
DROP TABLE IF EXISTS `cannedmessage`;
CREATE TABLE IF NOT EXISTS `cannedmessage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(8) DEFAULT NULL,
  `groupid` int(11) DEFAULT NULL,
  `vctitle` varchar(100) NOT NULL DEFAULT '',
  `vcvalue` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table mibew.cannedmessage: ~10 rows (approximately)
/*!40000 ALTER TABLE `cannedmessage` DISABLE KEYS */;
INSERT INTO `cannedmessage` (`id`, `locale`, `groupid`, `vctitle`, `vcvalue`) VALUES
	(1, 'en', NULL, 'Hello. How may I help you?', 'Hello. How may I help you?'),
	(2, 'en', NULL, 'Hello! Welcome to our support. How may I help you?', 'Hello! Welcome to our support. How may I help you?'),
	(3, 'ru', NULL, 'Здравствуйте! Чем я могу Вам помочь?', 'Здравствуйте! Чем я могу Вам помочь?'),
	(4, 'ru', NULL, 'Подождите секунду, я переключу Вас на другого...', 'Подождите секунду, я переключу Вас на другого оператора.'),
	(5, 'ru', NULL, 'Вы не могли бы уточнить, что Вы имеете ввиду...', 'Вы не могли бы уточнить, что Вы имеете ввиду...'),
	(6, 'ru', NULL, 'Удачи, до свиданья!', 'Удачи, до свиданья!'),
	(7, 'ua', NULL, 'Вітаю! Чим я можу Вам допомогти?', 'Вітаю! Чим я можу Вам допомогти?'),
	(8, 'ua', NULL, 'Зачекайте секунду, я спробую переключити Вас на...', 'Зачекайте секунду, я спробую переключити Вас на іншого опретора.'),
	(9, 'ua', NULL, 'Ви не могли б уточнити , що Ви маєте на увазі...', 'Ви не могли б уточнити , що Ви маєте на увазі...'),
	(10, 'ua', NULL, 'Хай щастить, до побачення!', 'Хай щастить, до побачення!');
/*!40000 ALTER TABLE `cannedmessage` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
