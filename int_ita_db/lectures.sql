-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-03 16:15:52
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
  `idModule` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `title_ua` varchar(255) NOT NULL,
  `title_ru` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `idType` int(11) DEFAULT '1',
  `durationInMinutes` int(11) DEFAULT '60',
  `idTeacher` varchar(50) DEFAULT NULL,
  `isFree` tinyint(1) NOT NULL DEFAULT '0',
  `rate` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8 COMMENT='isFree ( 0 - pay, 1 - demo lecture)';

-- Dumping data for table int_ita_db.lectures: ~73 rows (approximately)
/*!40000 ALTER TABLE `lectures` DISABLE KEYS */;
INSERT INTO `lectures` (`id`, `image`, `alias`, `idModule`, `order`, `title_ua`, `title_ru`, `title_en`, `idType`, `durationInMinutes`, `idTeacher`, `isFree`, `rate`) VALUES
	(22, 'lectureImage.png', 'lecture1', 2, 1, 'Взаємодія PHP і XML', '', '', 1, 60, '1', 0, 4),
	(23, 'lectureImage.png', 'lecture2', 2, 2, 'Приклади коду', '', '', 1, 60, '2', 0, 4),
	(24, 'lectureImage.png', 'lecture3', 2, 3, 'Список літератури', '', '', 1, 60, '4', 0, 4),
	(50, 'lectureImage.png', 'lecture2', 7, 2, 'Математический анализ', '', '', 1, 60, '5', 0, 4),
	(51, 'lectureImage.png', 'lecture3', 7, 3, 'Дифференциальные уравнения', '', '', 1, 60, '5', 0, 4),
	(52, 'lectureImage.png', 'lecture4', 7, 4, 'Математическая физика', '', '', 1, 60, '5', 0, 4),
	(53, 'lectureImage.png', 'lecture5', 7, 5, 'Геометрия и топология', '', '', 1, 60, '5', 0, 4),
	(54, 'lectureImage.png', 'lecture6', 7, 1, 'Теория вероятностей и математическая статистика', '', '', 1, 60, '5', 0, 4),
	(66, 'lectureImage.png', 'lecture1', 11, 2, 'Занятие 1', '', '', 1, 60, '2', 0, 4),
	(67, 'lectureImage.png', 'lecture2', 11, 1, 'Занятие 2,', '', '', 1, 60, '2', 0, 4),
	(68, 'lectureImage.png', 'lecture3', 11, 3, 'Занятие 3.', '', '', 1, 60, '2', 0, 4),
	(69, 'lectureImage.png', 'lecture4', 11, 4, 'Занятие 4;', '', '', 1, 60, '2', 0, 4),
	(70, 'lectureImage.png', 'lecture5', 11, 5, 'Занятие 5:', '', '', 1, 60, '2', 0, 4),
	(72, 'lectureImage.png', 'lecture1', 23, 1, 'аатара', '', '', 1, 60, '2', 0, 4),
	(73, 'lectureImage.png', 'lecture2', 61, 1, 'gfggeg', '', '', 1, 60, '1', 0, 4),
	(78, 'lectureImage.png', 'lecture1', 20, 1, 'rgdgjkj', '', '', 1, 60, '3', 0, 4),
	(79, 'lectureImage.png', 'lecture2', 20, 2, 'hjhgjghgkg', '', '', 1, 60, '3', 0, 4),
	(88, 'lectureImage.png', 'lecture4', 2, 4, 'Дроби', '', '', 1, 60, '10', 0, 4),
	(89, 'lectureImage.png', 'lecture5', 2, 5, 'Нескінченний періодичний десятковий дріб', '', '', 1, 60, '10', 0, 4),
	(90, 'lectureImage.png', 'lecture6', 2, 6, 'Одночлен і многочлени', '', '', 1, 60, '10', 0, 4),
	(91, 'lectureImage.png', 'lecture7', 2, 7, 'Натуральні числа', '', '', 1, 60, '10', 0, 4),
	(98, 'lectureImage.png', 'lecture1', 9, 1, '1', '', '', 1, 60, '3', 0, 4),
	(99, 'lectureImage.png', 'lecture3', 20, 3, '!!!!!!', '', '', 1, 60, '1', 0, 4),
	(100, 'lectureImage.png', 'lecture8', 3, 1, 'Основи мови С (частина 1)', '', '', 1, 60, '11', 0, 4),
	(101, 'lectureImage.png', 'lecture9', 3, 2, 'Основи мови С (частина 2)', '', '', 1, 60, '11', 0, 4),
	(102, 'lectureImage.png', 'lecture3', 3, 3, 'Процедури і функції', '', '', 1, 60, '11', 0, 4),
	(103, 'lectureImage.png', 'lecture4', 3, 4, 'Покажчики та рекурсія', '', '', 1, 60, '11', 0, 4),
	(104, 'lectureImage.png', 'lecture5', 3, 5, 'Символьні рядки', '', '', 1, 60, '11', 0, 4),
	(105, 'lectureImage.png', 'lecture6', 3, 6, 'Текстові файли', '', '', 1, 60, '11', 0, 4),
	(106, 'lectureImage.png', 'lecture7', 3, 7, 'Файли з довільним доступом', '', '', 1, 60, '11', 0, 4),
	(107, 'lectureImage.png', 'lecture8', 3, 8, 'Типи даних, визначені користувачем (частина 1)', '', '', 1, 60, '11', 0, 4),
	(108, 'lectureImage.png', 'lecture9', 3, 9, 'Типи даних, визначені користувачем (частина 2)', '', '', 1, 60, '11', 0, 4),
	(109, 'lectureImage.png', 'lecture10', 3, 10, 'Динамічні структури даних (частина 1)', '', '', 1, 60, '11', 0, 4),
	(110, 'lectureImage.png', 'lecture11', 3, 11, 'Динамічні структури даних (частина 2)', '', '', 1, 60, '11', 0, 4),
	(111, 'lectureImage.png', 'lecture12', 3, 12, 'Налагодження і тестування', '', '', 1, 60, '11', 0, 4),
	(115, 'lectureImage.png', 'lecture1', 18, 1, 'Тест занятие', '', '', 1, 60, '1', 0, 4),
	(116, 'lectureImage.png', 'lecture4', 20, 4, 'тьмтсич', '', '', 1, 60, '1', 0, 4),
	(117, 'lectureImage.png', 'lecture5', 1, 1, 'Етапи програмування. Парадигма програмування.', 'Этапы программирования. Парадигма программирования', 'Stages programming. The paradigm of programming.', 1, 60, '9', 1, 4),
	(118, 'lectureImage.png', 'lecture6', 1, 2, 'Функціонування комп\'ютера.', 'Функционирование компьютера.', 'Functioning of the computer.', 1, 60, '9', 1, 4),
	(125, 'lectureImage.png', 'lecture13', 1, 9, 'Технології програмування. Покоління', 'Технологии программирования. Поколения', 'Programming technologies. Generation', 1, 60, '9', 0, 4),
	(126, 'lectureImage.png', 'lecture14', 1, 10, 'Розвиток мов програмування', 'Развитие языков программирования', 'The development of programming languages', 1, 60, '9', 0, 4),
	(127, 'lectureImage.png', 'lecture11', 1, 3, 'Пристрої введення та виведення інформації.', 'Устройства ввода и вывода информации.', 'Devices of input and output data.', 1, 60, '9', 0, 4),
	(129, 'lectureImage.png', 'lecture11', 1, 5, 'Принципи фон Неймана. Що таке процесор.', 'Принципы фон Неймана. Что такое процессор.', 'The principles of von Neumann. What is a processor.', 1, 60, '9', 0, 4),
	(130, 'lectureImage.png', 'lecture11', 1, 6, 'Що таке операційна система.', 'Что такое операционная система.', 'What is a operating system.', 1, 60, '9', 0, 4),
	(131, 'lectureImage.png', 'lecture11', 1, 4, 'Пам\'ять комп\'ютера. Програмне забезпечення', 'Память компьютера. Программное обеспечение', 'Computer memory. Software', 1, 60, '9', 0, 4),
	(132, 'lectureImage.png', 'lecture11', 1, 8, 'Що таке алгоритм.', 'Что такое алгоритм.', 'What is a algorithm.', 1, 60, '9', 0, 4),
	(133, 'lectureImage.png', 'lecture11', 1, 7, 'Системи числення. Правила переведення.', 'Системы счисления. Правила перевода.', 'Number systems. Rules transfer.', 1, 60, '9', 0, 4),
	(136, 'lectureImage.png', 'lecture3', 61, 2, 'Test3', '', '', 1, 60, '1', 0, 4),
	(140, 'lectureImage.png', 'lecture8', 2, 8, 'Дроби', '', '', 1, 60, '10', 0, 4),
	(144, 'lectureImage.png', 'lecture4', 61, 3, 'Test 4', '', '', 1, 60, '1', 0, 4),
	(145, 'lectureImage.png', 'lecture5', 61, 4, 'test 5', '', '', 1, 60, '1', 0, 4),
	(161, 'lectureImage.png', 'lecture6', 7, 6, '6', '', '', 1, 60, '1', 0, 0),
	(162, 'lectureImage.png', 'lecture7', 7, 7, '7', '', '', 1, 60, '1', 0, 0),
	(163, 'lectureImage.png', 'lecture8', 7, 8, '8', '', '', 1, 60, '1', 0, 0),
	(164, 'lectureImage.png', 'lecture9', 7, 9, '9', '', '', 1, 60, '1', 0, 0),
	(165, 'lectureImage.png', 'lecture10', 7, 10, '10', '', '', 1, 60, '1', 0, 0),
	(172, 'lectureImage.png', 'lecture19', 61, 5, '20', '', '', 1, 60, '1', 0, 4),
	(173, 'lectureImage.png', 'lecture1', 14, 1, '1', '', '', 1, 60, '1', 0, 0),
	(174, 'lectureImage.png', 'lecture2', 14, 2, '2', '', '', 1, 60, '1', 0, 0),
	(175, 'lectureImage.png', 'lecture3', 14, 3, '3', '', '', 1, 60, '1', 0, 0),
	(176, 'lectureImage.png', 'lecture4', 14, 4, '4', '', '', 1, 60, '1', 0, 0),
	(177, 'lectureImage.png', 'lecture20', 61, 6, 'sdfdfdsf', '', '', 1, 60, '1', 0, 4),
	(178, 'lectureImage.png', 'lecture7', 61, 7, 'ТестТестів', '', '', 1, 60, '1', 0, 4),
	(179, 'lectureImage.png', 'lecture8', 61, 8, 'Test 8', '', '', 1, 60, '1', 0, 4),
	(180, 'lectureImage.png', 'lecture9', 61, 9, 'Test 9', '', '', 1, 60, '1', 0, 4),
	(181, 'lectureImage.png', 'lecture10', 61, 10, 'Test 10', '', '', 1, 60, '1', 0, 4),
	(182, 'lectureImage.png', 'lecture11', 61, 11, 'test 11', '', '', 1, 60, '1', 0, 4),
	(183, 'lectureImage.png', 'lecture12', 61, 12, 'test 12', '', '', 1, 60, '1', 0, 4),
	(184, 'lectureImage.png', 'lecture13', 61, 13, 'test 13', '', '', 1, 60, '1', 0, 4),
	(185, 'lectureImage.png', 'lecture14', 61, 14, 'test 14', '', '', 1, 60, '1', 0, 4),
	(192, 'lectureImage.png', 'lecture9', 2, 9, 'Одночлени і многочлени', '', '', 1, 60, '10', 0, 4),
	(193, 'lectureImage.png', 'lecture15', 61, 15, 'ua', 'ru', 'en', 1, 60, '1', 0, 0),
	(194, 'lectureImage.png', 'lecture16', 61, 16, 'ua', 'ru', 'en', 1, 60, '1', 0, 0);
/*!40000 ALTER TABLE `lectures` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
