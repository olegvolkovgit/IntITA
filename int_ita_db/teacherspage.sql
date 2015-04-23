-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-04-22 09:15:00
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.teacherspage
DROP TABLE IF EXISTS `teacherspage`;
CREATE TABLE IF NOT EXISTS `teacherspage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(6) NOT NULL,
  `header` varchar(50) NOT NULL,
  `courses` varchar(50) NOT NULL,
  `link1` varchar(100) NOT NULL,
  `link2` varchar(100) NOT NULL,
  `BCmain` varchar(30) NOT NULL,
  `BCteachers` varchar(30) NOT NULL,
  `title` varchar(50) NOT NULL,
  `profile` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.teacherspage: ~2 rows (approximately)
/*!40000 ALTER TABLE `teacherspage` DISABLE KEYS */;
INSERT INTO `teacherspage` (`id`, `lang`, `header`, `courses`, `link1`, `link2`, `BCmain`, `BCteachers`, `title`, `profile`) VALUES
	(1, 'UA', 'Our teachers', 'Веде курси:', 'Читати повністю', 'Відгуки про викладача', 'Головна', 'Викладачі', 'ІНТІТА - Викладачі', 'Персональна сторінка'),
	(2, 'RU', 'Наши преподаватели', 'Ведет курсы:', 'Читать полностью', 'Отзывы о преподавателе', 'Главная', 'Преподаватели', 'ИНТИТА - Преподаватели', 'Персональная страница');
/*!40000 ALTER TABLE `teacherspage` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
