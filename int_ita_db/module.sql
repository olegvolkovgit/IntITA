-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-06-30 15:31:51
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.module
DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `module_ID` int(11) NOT NULL AUTO_INCREMENT,
  `course` int(11) NOT NULL,
  `order` int(11) NOT NULL,
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
  UNIQUE KEY `module_ID` (`module_ID`),
  KEY `course` (`course`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.module: ~25 rows (approximately)
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` (`module_ID`, `course`, `order`, `module_name`, `alias`, `language`, `module_duration_hours`, `module_duration_days`, `lesson_count`, `module_price`, `for_whom`, `what_you_learn`, `what_you_get`, `module_img`, `about_module`, `owners`, `level`, `hours_in_day`, `days_in_week`, `rating`) VALUES
	(1, 1, 1, 'Вступ до програмування', 'module1', 'ua', 313, 20, 15, 6500, 'для менеджерів проектів і тих, хто відповідає за постановку завдань на розробку;для дизайнерів, які готові почати не просто малювати красиві картинки, а й навчитися тому, як створювати працюючі і зручні інтерфейси;для розробників, які хочуть самостійно створити або змінити свій проект;', 'Ви навчитеся писати чистий код;Користуватися системами контролю версій;Дізнаєтеся, з чого складається сучасний додаток;Для чого потрібен безперервна інтеграція (СІ) сервер;Чому потрібно тестувати свої програми і як це робити;', 'Відеозаписи та текстові матеріали всіх онлайн-занять;Спілкування з розумними одногрупниками;Сертифікат про закінчення навчання;Прилаштованість на робоче місце в силіконовій долині;', 'courseimg1.png', NULL, '1;2;3;4;', 'strong junior', 4, 6, NULL),
	(2, 1, 4, 'Елементарна математика', 'module2', 'ua', 30, 15, 3, 3200, NULL, NULL, NULL, 'courseimg1.png', NULL, '3;4;', 'junior', 3, 3, NULL),
	(3, 1, 2, 'Алгоритмізація і програмування на мові С', 'module3', 'ua', 60, 30, 3, 3500, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;4;5;', 'junior', 3, 3, NULL),
	(4, 1, 3, 'Елементи вищої математики', 'module4', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '4;', 'junior', 3, 3, NULL),
	(7, 1, 5, 'Комп\'ютерні мережі', 'module5', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;2;', 'junior', 3, 3, NULL),
	(9, 1, 6, 'Розробка та аналіз алгоритмів. Комбінаторні алгоритми.', 'module6', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '3;4;', 'junior', 3, 3, NULL),
	(10, 1, 7, 'Дискретна математика', 'module7', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;4;', 'junior', 3, 3, NULL),
	(11, 1, 8, 'Бази даних', 'module8', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;3;', 'junior', 3, 3, NULL),
	(14, 1, 9, 'Англійська мова', 'module9', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '4;5;6;', 'junior', 3, 3, NULL),
	(16, 1, 10, 'Програмування на PHP (Частина 1)', 'module10', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '6;', 'junior', 3, 3, NULL),
	(17, 1, 11, 'Програмування на PHP (Частина 2)', 'module11', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '5;6;', 'junior', 3, 3, NULL),
	(18, 1, 13, 'Верстка на HTML, CSS', 'module12', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;', 'junior', 3, 3, NULL),
	(20, 1, 12, 'Програмування на JavaScript', 'module13', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;5;6;', 'junior', 3, 3, NULL),
	(22, 1, 14, 'Сучасні технології розробки програм', 'module14', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '5;4;6;', 'junior', 3, 3, NULL),
	(23, 1, 15, 'Командний дипломний проект', 'module15', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;4;', 'junior', 3, 3, NULL),
	(54, 13, 1, 'For beginners', 'module1', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(55, 13, 2, 'Pre Intermediate', 'module2', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(56, 13, 3, 'Intermediate', 'module3', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(58, 14, 1, 'Побудова індивідуального плану успішної ІТ кар єри.', 'module2', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(59, 14, 2, 'Ефективне працевлаштування', 'module2', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(60, 14, 3, 'Психологія успіху', 'module3', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(61, 1, 16, 'New module', 'module16', 'ua', 0, 0, 1, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL);
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
