-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-31 18:15:54
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.lectures
DROP TABLE IF EXISTS `lectures`;
CREATE TABLE IF NOT EXISTS `lectures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT 'lectureImage.png',
  `alias` varchar(10) NOT NULL,
  `language` varchar(6) DEFAULT NULL,
  `idModule` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `idType` int(11) DEFAULT '1',
  `durationInMinutes` int(11) DEFAULT '60',
  `idTeacher` varchar(50) DEFAULT NULL,
  `isFree` tinyint(1) NOT NULL DEFAULT '0',
  `rate` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8 COMMENT='isFree ( 0 - pay, 1 - demo lecture)';

-- Dumping data for table int_ita_db.lectures: ~75 rows (approximately)
/*!40000 ALTER TABLE `lectures` DISABLE KEYS */;
INSERT INTO `lectures` (`id`, `image`, `alias`, `language`, `idModule`, `order`, `title`, `idType`, `durationInMinutes`, `idTeacher`, `isFree`, `rate`) VALUES
	(22, 'lectureImage.png', 'lecture1', 'ua', 2, 1, 'Взаємодія PHP і XML', 1, 60, '1', 0, 4),
	(23, 'lectureImage.png', 'lecture2', 'ua', 2, 2, 'Приклади коду', 1, 60, '2', 0, 4),
	(24, 'lectureImage.png', 'lecture3', 'ua', 2, 3, 'Список літератури', 1, 60, '4', 0, 4),
	(50, 'lectureImage.png', 'lecture2', 'ua', 7, 2, 'Математический анализ', 1, 60, '5', 0, 4),
	(51, 'lectureImage.png', 'lecture3', 'ua', 7, 3, 'Дифференциальные уравнения', 1, 60, '5', 0, 4),
	(52, 'lectureImage.png', 'lecture4', 'ua', 7, 4, 'Математическая физика', 1, 60, '5', 0, 4),
	(53, 'lectureImage.png', 'lecture5', 'ua', 7, 5, 'Геометрия и топология', 1, 60, '5', 0, 4),
	(54, 'lectureImage.png', 'lecture6', 'ua', 7, 1, 'Теория вероятностей и математическая статистика', 1, 60, '5', 0, 4),
	(66, 'lectureImage.png', 'lecture1', 'ua', 11, 2, 'Занятие 1', 1, 60, '2', 0, 4),
	(67, 'lectureImage.png', 'lecture2', 'ua', 11, 1, 'Занятие 2,', 1, 60, '2', 0, 4),
	(68, 'lectureImage.png', 'lecture3', 'ua', 11, 3, 'Занятие 3.', 1, 60, '2', 0, 4),
	(69, 'lectureImage.png', 'lecture4', 'ua', 11, 4, 'Занятие 4;', 1, 60, '2', 0, 4),
	(70, 'lectureImage.png', 'lecture5', 'ua', 11, 5, 'Занятие 5:', 1, 60, '2', 0, 4),
	(72, 'lectureImage.png', 'lecture1', 'ua', 23, 1, 'аатара', 1, 60, '2', 0, 4),
	(73, 'lectureImage.png', 'lecture2', 'ua', 61, 1, 'gfggeg', 1, 60, '1', 0, 4),
	(78, 'lectureImage.png', 'lecture1', 'ua', 20, 1, 'rgdgjkj', 1, 60, '3', 0, 4),
	(79, 'lectureImage.png', 'lecture2', 'ua', 20, 2, 'hjhgjghgkg', 1, 60, '3', 0, 4),
	(88, 'lectureImage.png', 'lecture4', 'ua', 2, 4, 'Дроби', 1, 60, '10', 0, 4),
	(89, 'lectureImage.png', 'lecture5', 'ua', 2, 5, 'Нескінченний періодичний десятковий дріб', 1, 60, '10', 0, 4),
	(90, 'lectureImage.png', 'lecture6', 'ua', 2, 6, 'Одночлен і многочлени', 1, 60, '10', 0, 4),
	(91, 'lectureImage.png', 'lecture7', 'ua', 2, 7, 'Натуральні числа', 1, 60, '10', 0, 4),
	(98, 'lectureImage.png', 'lecture1', 'ua', 9, 1, '1', 1, 60, '3', 0, 4),
	(99, 'lectureImage.png', 'lecture3', 'ua', 20, 3, '!!!!!!', 1, 60, '1', 0, 4),
	(100, 'lectureImage.png', 'lecture8', 'ua', 3, 1, 'Основи мови С (частина 1)', 1, 60, '11', 0, 4),
	(101, 'lectureImage.png', 'lecture9', 'ua', 3, 2, 'Основи мови С (частина 2)', 1, 60, '11', 0, 4),
	(102, 'lectureImage.png', 'lecture3', 'ua', 3, 3, 'Процедури і функції', 1, 60, '11', 0, 4),
	(103, 'lectureImage.png', 'lecture4', 'ua', 3, 4, 'Покажчики та рекурсія', 1, 60, '11', 0, 4),
	(104, 'lectureImage.png', 'lecture5', 'ua', 3, 5, 'Символьні рядки', 1, 60, '11', 0, 4),
	(105, 'lectureImage.png', 'lecture6', 'ua', 3, 6, 'Текстові файли', 1, 60, '11', 0, 4),
	(106, 'lectureImage.png', 'lecture7', 'ua', 3, 7, 'Файли з довільним доступом', 1, 60, '11', 0, 4),
	(107, 'lectureImage.png', 'lecture8', 'ua', 3, 8, 'Типи даних, визначені користувачем (частина 1)', 1, 60, '11', 0, 4),
	(108, 'lectureImage.png', 'lecture9', 'ua', 3, 9, 'Типи даних, визначені користувачем (частина 2)', 1, 60, '11', 0, 4),
	(109, 'lectureImage.png', 'lecture10', 'ua', 3, 10, 'Динамічні структури даних (частина 1)', 1, 60, '11', 0, 4),
	(110, 'lectureImage.png', 'lecture11', 'ua', 3, 11, 'Динамічні структури даних (частина 2)', 1, 60, '11', 0, 4),
	(111, 'lectureImage.png', 'lecture12', 'ua', 3, 12, 'Налагодження і тестування', 1, 60, '11', 0, 4),
	(115, 'lectureImage.png', 'lecture1', 'ua', 18, 1, 'Тест занятие', 1, 60, '1', 0, 4),
	(116, 'lectureImage.png', 'lecture4', 'ua', 20, 4, 'тьмтсич', 1, 60, '1', 0, 4),
	(117, 'lectureImage.png', 'lecture5', 'ua', 1, 1, 'Етапи програмування. Парадигма програмування.', 1, 60, '9', 1, 4),
	(118, 'lectureImage.png', 'lecture6', 'ua', 1, 2, 'Функціонування комп\'ютера.', 1, 60, '9', 1, 4),
	(125, 'lectureImage.png', 'lecture13', 'ua', 1, 9, 'Технології програмування. Покоління', 1, 60, '9', 0, 4),
	(126, 'lectureImage.png', 'lecture14', 'ua', 1, 10, 'Розвиток мов програмування', 1, 60, '9', 0, 4),
	(127, 'lectureImage.png', 'lecture11', 'ua', 1, 3, 'Пристрої введення та виведення інформації.', 1, 60, '9', 0, 4),
	(129, 'lectureImage.png', 'lecture11', 'ua', 1, 5, 'Принципи фон Неймана. Що таке процесор.', 1, 60, '9', 0, 4),
	(130, 'lectureImage.png', 'lecture11', 'ua', 1, 6, 'Що таке операційна система.', 1, 60, '9', 0, 4),
	(131, 'lectureImage.png', 'lecture11', 'ua', 1, 4, 'Пам\'ять комп\'ютера. Програмне забезпечення', 1, 60, '9', 0, 4),
	(132, 'lectureImage.png', 'lecture11', 'ua', 1, 8, 'Що таке алгоритм.', 1, 60, '9', 0, 4),
	(133, 'lectureImage.png', 'lecture11', 'ua', 1, 7, 'Системи числення. Правила переведення.', 1, 60, '9', 0, 4),
	(135, 'lectureImage.png', 'lecture1', 'ua', 0, 0, '1', 1, 60, '1', 0, 4),
	(136, 'lectureImage.png', 'lecture3', 'ua', 61, 2, 'Test3', 1, 60, '1', 0, 4),
	(138, 'lectureImage.png', 'lecture2', 'ua', 0, 0, 'ghhkgjkjk', 1, 60, '1', 0, 4),
	(139, 'lectureImage.png', 'lecture3', 'ua', 0, 0, 'yfugg', 1, 60, '1', 0, 4),
	(140, 'lectureImage.png', 'lecture8', 'ua', 2, 8, 'Дроби', 1, 60, '10', 0, 4),
	(144, 'lectureImage.png', 'lecture4', 'ua', 61, 3, 'Test 4', 1, 60, '1', 0, 4),
	(145, 'lectureImage.png', 'lecture5', 'ua', 61, 4, 'test 5', 1, 60, '1', 0, 4),
	(156, 'lectureImage.png', 'lecture4', 'ua', 0, 0, 'ВоваТест', 1, 60, '1', 0, 4),
	(161, 'lectureImage.png', 'lecture6', 'ua', 7, 6, '6', 1, 60, '1', 0, 0),
	(162, 'lectureImage.png', 'lecture7', 'ua', 7, 7, '7', 1, 60, '1', 0, 0),
	(163, 'lectureImage.png', 'lecture8', 'ua', 7, 8, '8', 1, 60, '1', 0, 0),
	(164, 'lectureImage.png', 'lecture9', 'ua', 7, 9, '9', 1, 60, '1', 0, 0),
	(165, 'lectureImage.png', 'lecture10', 'ua', 7, 10, '10', 1, 60, '1', 0, 0),
	(172, 'lectureImage.png', 'lecture19', 'ua', 61, 5, '20', 1, 60, '1', 0, 0),
	(173, 'lectureImage.png', 'lecture1', 'ua', 14, 1, '1', 1, 60, '1', 0, 0),
	(174, 'lectureImage.png', 'lecture2', 'ua', 14, 2, '2', 1, 60, '1', 0, 0),
	(175, 'lectureImage.png', 'lecture3', 'ua', 14, 3, '3', 1, 60, '1', 0, 0),
	(176, 'lectureImage.png', 'lecture4', 'ua', 14, 4, '4', 1, 60, '1', 0, 0),
	(177, 'lectureImage.png', 'lecture20', 'ua', 61, 6, 'sdfdfdsf', 1, 60, '1', 0, 0),
	(178, 'lectureImage.png', 'lecture7', 'ua', 61, 7, 'ТестТестів', 1, 60, '1', 0, 0),
	(179, 'lectureImage.png', 'lecture8', 'ua', 61, 8, 'Test 8', 1, 60, '1', 0, 0),
	(180, 'lectureImage.png', 'lecture9', 'ua', 61, 9, 'Test 9', 1, 60, '1', 0, 0),
	(181, 'lectureImage.png', 'lecture10', 'ua', 61, 10, 'Test 10', 1, 60, '1', 0, 0),
	(182, 'lectureImage.png', 'lecture11', 'ua', 61, 11, 'test 11', 1, 60, '1', 0, 0),
	(183, 'lectureImage.png', 'lecture12', 'ua', 61, 12, 'test 12', 1, 60, '1', 0, 0),
	(184, 'lectureImage.png', 'lecture13', 'ua', 61, 13, 'test 13', 1, 60, '1', 0, 0),
	(185, 'lectureImage.png', 'lecture14', 'ua', 61, 14, 'test 14', 1, 60, '1', 0, 0),
	(192, 'lectureImage.png', 'lecture9', 'ua', 2, 9, 'Одночлени і многочлени', 1, 60, '10', 0, 0);
/*!40000 ALTER TABLE `lectures` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
