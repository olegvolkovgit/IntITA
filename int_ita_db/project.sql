-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-06-25 17:31:59
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.project
DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_leader` int(10) NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `mark` tinyint(4) NOT NULL,
  `comment` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_project_teacher` (`id_leader`),
  CONSTRAINT `FK_project_teacher` FOREIGN KEY (`id_leader`) REFERENCES `teacher` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='is_completed (values : 0 - in develop, 1 - completed)';

-- Dumping data for table int_ita_db.project: ~6 rows (approximately)
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` (`id`, `id_leader`, `is_completed`, `title`, `start_date`, `mark`, `comment`) VALUES
	(1, 1, 1, 'Розробка інтернет-магазину', '2015-06-15', 5, 'Відмінно'),
	(2, 2, 0, 'Створення сайту Міноборони України', '2015-06-15', 0, ''),
	(4, 3, 0, 'Розробка СМS для інтернет-магазину', '2015-06-15', 0, ''),
	(5, 4, 1, 'Розробка БД для інтернет-магазину', '2015-06-08', 4, 'Добре'),
	(6, 5, 1, 'Дизайн для інтернет-магазину', '2015-06-12', 5, 'Відмінно'),
	(7, 6, 0, 'Верстка інтернет-магазину', '2015-05-25', 4, 'Добре');
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
