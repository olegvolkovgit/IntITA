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

-- Dumping structure for table int_ita_db.module
DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `module_ID` int(11) NOT NULL AUTO_INCREMENT,
  `title_ru` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_ua` varchar(255) NOT NULL,
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
  PRIMARY KEY (`module_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.module: ~66 rows (approximately)
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` (`module_ID`, `title_ru`, `title_en`, `title_ua`, `alias`, `language`, `module_duration_hours`, `module_duration_days`, `lesson_count`, `module_price`, `for_whom`, `what_you_learn`, `what_you_get`, `module_img`, `about_module`, `owners`, `level`, `hours_in_day`, `days_in_week`, `rating`) VALUES
	(1, 'Введение в программирование', 'Intro to Programming ', 'Вступ до програмування', 'module1', 'ua', 313, 20, 10, 6500, 'для менеджерів проектів і тих, хто відповідає за постановку завдань на розробку;для дизайнерів, які готові почати не просто малювати красиві картинки, а й навчитися тому, як створювати працюючі і зручні інтерфейси;для розробників, які хочуть самостійно створити або змінити свій проект;', 'Ви навчитеся писати чистий код;Користуватися системами контролю версій;Дізнаєтеся, з чого складається сучасний додаток;Для чого потрібен безперервна інтеграція (СІ) сервер;Чому потрібно тестувати свої програми і як це робити;', 'Відеозаписи та текстові матеріали всіх онлайн-занять;Спілкування з розумними одногрупниками;Сертифікат про закінчення навчання;Прилаштованість на робоче місце в силіконовій долині;', 'courseimg1.png', NULL, '1;2;3;4;', 'strong junior', 4, 6, NULL),
	(2, 'Элементарная математика', 'Elementary math', 'Елементарна математика', 'module2', 'ua', 30, 15, 9, 3200, NULL, NULL, NULL, 'courseimg1.png', NULL, '3;4;', 'junior', 3, 3, NULL),
	(3, 'Алгоритмизация и программирование на С', 'C  language programming and algorithmization', 'Алгоритмізація і програмування на мові С', 'module3', 'ua', 60, 30, 12, 3500, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;4;5;', 'junior', 3, 3, NULL),
	(4, 'Элементы высшей математики', 'Higher Math elements', 'Елементи вищої математики', 'module4', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '4;', 'junior', 3, 3, NULL),
	(7, 'Компьютерные сети. Основы', 'Computer networks', 'Комп\'ютерні мережі. Основи', 'module5', 'ua', 60, 0, 10, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;2;', 'junior', 3, 3, NULL),
	(9, 'Разработка и анализ алгоритмов. Комбинаторные алгоритмы', 'Algorithms processing and analyses.Combinatorial algorithms', 'Розробка та аналіз алгоритмів. Комбінаторні алгоритми.', 'module6', 'ua', 60, 0, 1, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '3;4;', 'junior', 3, 3, NULL),
	(10, 'Дискретная математика', 'Discrete Math', 'Дискретна математика', 'module7', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;4;', 'junior', 3, 3, NULL),
	(11, 'Базы данных. Основы', 'Databases', 'Бази даних. Основи', 'module8', 'ua', 60, 0, 5, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;3;', 'junior', 3, 3, NULL),
	(14, 'Английский язык', 'English', 'Англійська мова', 'module9', 'ua', 60, 0, 4, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '4;5;6;', 'junior', 3, 3, NULL),
	(16, 'Программирование на РНР. Основы', 'PHP web programming (Part 1)', 'Програмування на PHP. Основи', 'module10', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '6;', 'junior', 3, 3, NULL),
	(17, 'Программирование на РНР (Часть 2)', 'PHP web programming (Part 2)', 'Програмування на PHP (Частина 2)', 'module11', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '5;6;', 'junior', 3, 3, NULL),
	(18, 'Верстка на HTML, CSS', 'HTML, CSS Website layout', 'Верстка на HTML, CSS', 'module12', 'ua', 60, 0, 1, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;', 'junior', 3, 3, NULL),
	(20, 'Программирование на JavaScript', 'JavaScript Programming', 'Програмування на JavaScript', 'module13', 'ua', 60, 0, 4, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;5;6;', 'junior', 3, 3, NULL),
	(22, 'Современные технологии разработки программ', 'Modern Technologies of Software Development', 'Сучасні технології розробки програм', 'module14', 'ua', 60, 0, 0, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '5;4;6;', 'junior', 3, 3, NULL),
	(23, 'Командный дипломный проект', 'Diploma team project', 'Командний дипломний проект', 'module15', 'ua', 60, 0, 1, 3000, NULL, NULL, NULL, 'courseimg1.png', NULL, '1;4;', 'junior', 3, 3, NULL),
	(54, 'For beginners', 'For beginners', 'For beginners', 'module1', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(55, 'Pre Intermediate', 'Pre Intermediate', 'Pre Intermediate', 'module2', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(56, 'Intermediate', 'Intermediate', 'Intermediate', 'module3', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(58, 'Построение индивидуального плана успешной ИТ карьеры.', 'How to build a  successful career in IT-high level', 'Побудова індивідуального плану успішної ІТ кар’єри', 'module2', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(59, 'Эффективное трудоустройство', 'Effective employment', 'Ефективне працевлаштування', 'module2', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(60, 'Психология успеха', 'The psychology of success', 'Психологія успіху', 'module3', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(61, 'New module', 'New module', 'New module', 'module16', 'ua', 0, 0, 16, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(62, 'Введение в программирование', 'Intro to Programming ', 'Вступ до програмування', 'module1', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(63, 'Элементарная математика', 'Elementary math', 'Елементарна математика', 'module2', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(64, 'Алгоритмизация и программирование на С', 'C  language programming and algorithmization', 'Алгоритмізація і програмування на мові С', 'module3', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(65, 'Элементы высшей математики', 'Higher Math elements', 'Елементи вищої математики', 'module4', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(66, 'Компьютерные сети. Основы', 'Computer networks', 'Комп\'ютерні мережі. Основи', 'module5', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(67, 'Разработка и анализ алгоритмов. Комбинаторные алгоритмы', 'Algorithms processing and analyses.Combinatorial algorithms', 'Розробка та аналіз алгоритмів. Комбінаторні алгоритми.', 'module6', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(68, 'Дискретная математика', 'Discrete Math', 'Дискретна математика', 'module7', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(69, 'Базы данных. Основы', 'Databases', 'Бази даних. Основи', 'module8', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(70, 'Программирование на РНР. Основы', 'PHP web programming (Part 1)', 'Програмування на PHP. Основи', 'module9', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(71, 'Программирование на РНР (Часть 2)', 'PHP web programming (Part 2)', 'Програмування на PHP (Частина 2)', 'module10', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(72, 'Верстка на HTML, CSS', 'HTML, CSS Website layout', 'Верстка на HTML, CSS', 'module11', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(73, 'Программирование на JavaScript', 'JavaScript Programming', 'Програмування на JavaScript', 'module12', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(74, 'Современные технологии разработки программ', 'Modern Technologies of Software Development', 'Сучасні технології розробки програм', 'module13', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(75, 'Командный дипломный проект', 'Diploma team project', 'Командний дипломний проект', 'module14', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'strong junior', 3, 3, NULL),
	(76, 'For beginners', 'For beginners', 'For beginners', 'module1', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'middle', 3, 3, NULL),
	(77, 'Pre Intermediate', 'Pre Intermediate', 'Pre Intermediate', 'module2', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'middle', 3, 3, NULL),
	(78, 'Intermediate', 'Intermediate', 'Intermediate', 'module3', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'middle', 3, 3, NULL),
	(79, 'Построение индивидуального плана успешной ИТ карьеры.', 'How to build a  successful career in IT-high level', 'Побудова індивідуального плану успішної ІТ кар’єри', 'module1', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'senior', 3, 3, NULL),
	(80, 'Эффективное трудоустройство', 'Effective employment', 'Ефективне працевлаштування', 'module2', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'senior', 3, 3, NULL),
	(81, 'Психология успеха', 'The psychology of success', 'Психологія успіху', 'module3', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, 'senior', 3, 3, NULL),
	(82, 'Введение в программирование', 'Intro to Programming ', 'Вступ до програмування', 'module1', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(83, 'Элементарная математика', 'Elementary math', 'Елементарна математика', 'module2', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(84, 'Алгоритмизация и программирование на С', 'C  language programming and algorithmization', 'Алгоритмізація і програмування на мові С', 'module3', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(85, 'Элементы высшей математики', 'Higher Math elements', 'Елементи вищої математики', 'module4', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(86, 'Компьютерные сети. Основы', 'Computer networks', 'Комп\'ютерні мережі. Основи', 'module5', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(87, 'Разработка и анализ алгоритмов. Комбинаторные алгоритмы', 'Algorithms processing and analyses.Combinatorial algorithms', 'Розробка та аналіз алгоритмів. Комбінаторні алгоритми.', 'module6', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(88, 'Дискретная математика', 'Discrete Math', 'Дискретна математика', 'module7', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(89, 'Базы данных. Основы', 'Databases', 'Бази даних. Основи', 'module8', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(90, 'Программирование на РНР. Основы', 'PHP web programming (Part 1)', 'Програмування на PHP. Основи', 'module9', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(91, 'Программирование на РНР (Часть 2)', 'PHP web programming (Part 2)', 'Програмування на PHP (Частина 2)', 'module10', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(92, 'Верстка на HTML, CSS', 'HTML, CSS Website layout', 'Верстка на HTML, CSS', 'module11', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(93, 'Программирование на JavaScript', 'JavaScript Programming', 'Програмування на JavaScript', 'module12', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(94, 'Современные технологии разработки программ', 'Modern Technologies of Software Development', 'Сучасні технології розробки програм', 'module13', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(95, 'Командный дипломный проект', 'Diploma team project', 'Командний дипломний проект', 'module14', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(96, 'Построение индивидуального плана успешной ИТ карьеры.', 'How to build a  successful career in IT-high level', 'Побудова індивідуального плану успішної ІТ кар’єри', 'module1', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(97, 'Эффективное трудоустройство', 'Effective employment', 'Ефективне працевлаштування', 'module2', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(98, 'Психология успеха', 'The psychology of success', 'Психологія успіху', 'module3', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(99, 'For beginners', 'For beginners', 'For beginners', 'module1', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(100, 'Pre Intermediate', 'Pre Intermediate', 'Pre Intermediate', 'module2', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(101, 'Intermediate', 'Intermediate', 'Intermediate', 'module3', 'ru', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(121, 'Базы данных для интернет-программистов', 'Databases for web developers', 'Бази даних для інтернет-програмістів', 'module17', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(122, 'Регулярные выражения', 'Regular expressions', 'Регулярні вирази', 'module18', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(123, 'Стажировка', 'Traineeship', 'Стажування', 'module19', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL),
	(125, 'Російською', 'Англійською', 'Українською', 'module20', 'ua', 0, 0, 0, 0, NULL, NULL, NULL, 'courseimg1.png', NULL, NULL, NULL, 3, 3, NULL);
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
