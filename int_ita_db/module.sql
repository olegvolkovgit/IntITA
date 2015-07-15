-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-15 17:37:16
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.module
DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `module_ID` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) NOT NULL,
  `alias` varchar(10) NOT NULL,
  `language` varchar(6) NOT NULL,
  `module_duration_hours` int(11) NOT NULL,
  `module_duration_days` int(11) NOT NULL DEFAULT '0',
  `lesson_count` int(11) DEFAULT '0',
  `module_price` decimal(10,0) DEFAULT '0',
  `for_whom` text,
  `what_you_learn` text,
  `what_you_get` text,
  `module_img` varchar(255) DEFAULT 'courseimg1.png',
  `about_module` text,
  `owners` varchar(100) DEFAULT NULL,
  `level` enum('intern','junior','strong junior','middle','senior') DEFAULT NULL,
  `hours_in_day` int(11) DEFAULT '3',
  `days_in_week` int(11) DEFAULT '3',
  `rating` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`module_ID`),
  UNIQUE KEY `module_ID` (`module_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.module: ~43 rows (approximately)
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` (`module_ID`, `module_name`, `alias`, `language`, `module_duration_hours`, `module_duration_days`, `lesson_count`, `module_price`, `for_whom`, `what_you_learn`, `what_you_get`, `module_img`, `about_module`, `owners`, `level`, `hours_in_day`, `days_in_week`, `rating`) VALUES
	(1, 'Вступ до програмування', 'module1', 'ua', 313, 20, 15, 6500, 'для менеджерів проектів і тих, хто відповідає за постановку завдань на розробку;для дизайнерів, які готові почати не просто малювати красиві картинки, а й навчитися тому, як створювати працюючі і зручні інтерфейси;для розробників, які хочуть самостійно створити або змінити свій проект;', 'Ви навчитеся писати чистий код;Користуватися системами контролю версій;Дізнаєтеся, з чого складається сучасний додаток;Для чого потрібен безперервна інтеграція (СІ) сервер;Чому потрібно тестувати свої програми і як це робити;', 'Відеозаписи та текстові матеріали всіх онлайн-занять;Спілкування з розумними одногрупниками;Сертифікат про закінчення навчання;Прилаштованість на робоче місце в силіконовій долині;', 'courseimg1.png', NULL, '1;2;3;4;', 'strong junior', 4, 6, NULL),
	(2, 'Елементарна математика', 'module2', 'ua', 30, 15, 3, 3200, NULL, NULL, NULL, 'courseimg1.png', NULL, '3;4;', 'junior', 3, 3, NULL),
	(3, 'Алгоритмізація і програмування на мові С', 'module3', 'ua', 60, 30, 3, 3500, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;4;5;', 'junior', 3, 3, NULL),
	(4, 'Елементи вищої математики', 'module4', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '4;', 'junior', 3, 3, NULL),
	(7, 'Комп\'ютерні мережі', 'module5', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;2;', 'junior', 3, 3, NULL),
	(9, 'Розробка та аналіз алгоритмів. Комбінаторні алгоритми.', 'module6', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '3;4;', 'junior', 3, 3, NULL),
	(10, 'Дискретна математика', 'module7', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;4;', 'junior', 3, 3, NULL),
	(11, 'Бази даних', 'module8', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;3;', 'junior', 3, 3, NULL),
	(14, 'Англійська мова', 'module9', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '4;5;6;', 'junior', 3, 3, NULL),
	(16, 'Програмування на PHP (Частина 1)', 'module10', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '6;', 'junior', 3, 3, NULL),
	(17, 'Програмування на PHP (Частина 2)', 'module11', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '5;6;', 'junior', 3, 3, NULL),
	(18, 'Верстка на HTML, CSS', 'module12', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;', 'junior', 3, 3, NULL),
	(20, 'Програмування на JavaScript', 'module13', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;5;6;', 'junior', 3, 3, NULL),
	(22, 'Сучасні технології розробки програм', 'module14', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '5;4;6;', 'junior', 3, 3, NULL),
	(23, 'Командний дипломний проект', 'module15', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;4;', 'junior', 3, 3, NULL),
	(54, 'For beginners', 'module1', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(55, 'Pre Intermediate', 'module2', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(56, 'Intermediate', 'module3', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(58, 'Побудова індивідуального плану успішної ІТ кар єри.', 'module2', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(59, 'Ефективне працевлаштування', 'module2', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(60, 'Психологія успіху', 'module3', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(61, 'New module', 'module16', 'ua', 0, 0, 1, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(62, 'Введение в программирование', 'module1', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(63, 'Элементарная математика', 'module2', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(64, 'Алгоритмизация и программирование на С', 'module3', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(65, 'Элементы высшей математики', 'module4', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(66, 'Компьютерные сети', 'module5', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(67, 'Разработка и анализ алгоритмов. Комбинаторные алгоритмы', 'module6', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(68, 'Дискретная математика', 'module7', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(69, 'Базы данных', 'module8', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(70, 'Программирование на РНР (Часть 1)', 'module9', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(71, 'Программирование на РНР (Часть 2)', 'module10', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(72, 'Верстка на HTML, CSS', 'module11', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(73, 'Программирование на JavaScript', 'module12', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(74, 'Современные технологии разработки программ', 'module13', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(75, 'Командный дипломный проект', 'module14', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(76, 'For beginners', 'module1', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'middle', 3, 3, NULL),
	(77, 'Pre Intermediate', 'module2', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'middle', 3, 3, NULL),
	(78, 'Intermediate', 'module3', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'middle', 3, 3, NULL),
	(79, 'Построение индивидуального плана успешной ИТ карьеры.', 'module1', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'senior', 3, 3, NULL),
	(80, 'Эффективное трудоустройство', 'module2', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'senior', 3, 3, NULL),
	(81, 'Психология успеха', 'module3', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'senior', 3, 3, NULL),
	(82, 'Getting Started C++', 'module1', 'ua', 0, 0, 1, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL);
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
