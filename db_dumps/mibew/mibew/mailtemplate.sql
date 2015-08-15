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

-- Dumping structure for table mibew.mailtemplate
DROP TABLE IF EXISTS `mailtemplate`;
CREATE TABLE IF NOT EXISTS `mailtemplate` (
  `templateid` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(5) NOT NULL,
  `name` varchar(256) NOT NULL,
  `subject` varchar(1024) NOT NULL,
  `body` text,
  PRIMARY KEY (`templateid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table mibew.mailtemplate: ~9 rows (approximately)
/*!40000 ALTER TABLE `mailtemplate` DISABLE KEYS */;
INSERT INTO `mailtemplate` (`templateid`, `locale`, `name`, `subject`, `body`) VALUES
	(1, 'en', 'user_history', 'Mibew: dialog history', 'Hello {0}!\n\nYour chat history: \n\n{1}\n--- \nRegards,\n{2} and Mibew\n{3}'),
	(2, 'en', 'password_recovery', 'Reset your Mibew password', 'Hi, {0}\n\nPlease click on the link below or copy and paste the URL into your browser:\n{1}\n\nThis will let you choose another password.\n\nRegards,\nMibew'),
	(3, 'en', 'leave_message', 'Question from {0}', 'Your have a message from {0}:\n\n{2}\n\nHis email: {1}\n{3}\n--- \nRegards,\nMibew'),
	(4, 'ru', 'user_history', 'Мессенджер: история диалога', 'Здраствуйте, {0}!\n\nПо Вашему запросу, высылаем историю диалога с менеджером компании {2}: \n\n{1}\n--- \nС уважением,\n{2} и Mibew Мессенджер\n{3}'),
	(5, 'ru', 'password_recovery', 'Сброс вашего пароля от Mibew', 'Здравствуйте, {0}\n\nПожалуйста перейдите по ссылке, расположенной ниже, или скопируйте URL в адресную строку вашего браузера:\n{1}\n\nЭто позволит вам выбрать другой пароль.\n\nС уважением,\nMibew'),
	(6, 'ru', 'leave_message', 'Вопрос от {0}', 'Ваш посетитель \'{0}\' оставил сообщение:\n\n{2}\n\nЕmail: {1}\n{3}\n--- \nС уважением,\nВаш Веб Мессенджер'),
	(7, 'ua', 'user_history', 'Месенджер: історія діалогу', 'Доброго дня, {0}!\n\nЗгідно Вашого запиту, висилаємо історію: \n\n{1}\n--- \nЗ повагою,\nMibew Месенджер'),
	(8, 'ua', 'password_recovery', 'Reset your Mibew password', 'Hi, {0}\n\nPlease click on the link below or copy and paste the URL into your browser:\n{1}\n\nThis will let you choose another password.\n\nRegards,\nMibew'),
	(9, 'ua', 'leave_message', 'Запитання від {0}', 'Ваш відвідувач {0} залишив повідомлення:\n\n{2}\n\nЙого email: {1}\n{3}\n--- \nЗ повагою,\nВаш веб-месенджер');
/*!40000 ALTER TABLE `mailtemplate` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
