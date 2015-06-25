-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-06-25 14:06:55
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.role_attribute
DROP TABLE IF EXISTS `role_attribute`;
CREATE TABLE IF NOT EXISTS `role_attribute` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `role` int(10) NOT NULL,
  `type` varchar(50) NOT NULL,
  `name_ru` varchar(30) NOT NULL,
  `name_ua` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role` (`role`),
  CONSTRAINT `FK_role_attribute_roles` FOREIGN KEY (`role`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='1 - capacity: number of students\r\n2 - students list: trainer''s students\r\n3 - modules list: leader''s modules\r\n4 - projects list: leader''s projects\r\n5 - modules_consultant';

-- Dumping data for table int_ita_db.role_attribute: ~8 rows (approximately)
/*!40000 ALTER TABLE `role_attribute` DISABLE KEYS */;
INSERT INTO `role_attribute` (`id`, `name`, `role`, `type`, `name_ru`, `name_ua`) VALUES
	(1, 'capacity', 1, 'int', 'Количество студентов', 'Кількість студентів'),
	(2, 'students_list', 1, 'int', 'Список студентов', 'Список студентів'),
	(3, 'modules_list', 2, 'int', 'Список модулей', 'Список модулів'),
	(4, 'projects_list', 3, 'int', 'Проекты', 'Проекти'),
	(5, 'shedule', 2, 'int', 'Расписание', 'Розклад'),
	(6, 'modules_list', 4, 'int', 'Список модулей', 'Список модулів'),
	(7, 'modules_list', 3, 'int', 'Список модулей', 'Список модулів'),
	(8, 'capacity', 3, 'int', 'Количество студентов', 'Кількість студентів');
/*!40000 ALTER TABLE `role_attribute` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
