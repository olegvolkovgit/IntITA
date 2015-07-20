-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-21 00:41:29
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.graduate
DROP TABLE IF EXISTS `graduate`;
CREATE TABLE IF NOT EXISTS `graduate` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `graduate_date` date DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `work_place` varchar(255) DEFAULT NULL,
  `work_site` varchar(255) DEFAULT NULL,
  `courses` varchar(255) DEFAULT NULL,
  `courses_page` varchar(255) DEFAULT NULL,
  `history` varchar(255) DEFAULT NULL,
  `rate` tinyint(4) DEFAULT NULL,
  `recall` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.graduate: ~6 rows (approximately)
/*!40000 ALTER TABLE `graduate` DISABLE KEYS */;
INSERT INTO `graduate` (`id`, `first_name`, `last_name`, `avatar`, `graduate_date`, `position`, `work_place`, `work_site`, `courses`, `courses_page`, `history`, `rate`, `recall`) VALUES
	(1, 'Роксана', 'Соковита', 'Graduates.jpg', '2015-05-12', 'Інтернет-програміст, середнього рівня', 'Google Inc.', 'https://www.google.com/about/careers/', 'Інтернет програміст (РНР), сильний початківець', 'http://intita.itatests.com/course/index/1/', NULL, 1, 'Про академію, можна написати, що дала хороші базові знання в області програмування, що забезпечило швидке кар’єрне зростання, впевненість у колективі більш досвідчених програмістів та розуміння подальшого плану розвитку, як спеціаліста. Також спілкування з однодумцями в групі, робота в команді і т.п.'),
	(2, 'Роксана', 'Соковита', 'Graduates.jpg', '2015-05-12', 'Інтернет-програміст, середнього рівня', 'Google Inc.', 'https://www.google.com/about/careers/', 'Інтернет програміст (РНР), сильний початківець', 'http://intita.itatests.com/course/index/1/', NULL, 2, 'Про академію, можна написати, що дала хороші базові знання в області програмування, що забезпечило швидке кар’єрне зростання, впевненість у колективі більш досвідчених програмістів та розуміння подальшого плану розвитку, як спеціаліста. Також спілкування з однодумцями в групі, робота в команді і т.п.'),
	(3, 'Роксана', 'Соковита', 'Graduates.jpg', '2015-05-12', 'Інтернет-програміст, середнього рівня', 'Google Inc.', 'https://www.google.com/about/careers/', 'Інтернет програміст (РНР), сильний початківець', 'http://intita.itatests.com/course/index/1/', NULL, 3, 'Про академію, можна написати, що дала хороші базові знання в області програмування, що забезпечило швидке кар’єрне зростання, впевненість у колективі більш досвідчених програмістів та розуміння подальшого плану розвитку, як спеціаліста. Також спілкування з однодумцями в групі, робота в команді і т.п.'),
	(4, 'Роксана', 'Соковита', 'Graduates.jpg', '2015-05-12', 'Інтернет-програміст, середнього рівня', 'Google Inc.', 'https://www.google.com/about/careers/', 'Інтернет програміст (РНР), сильний початківець', 'http://intita.itatests.com/course/index/1/', NULL, 4, 'Про академію, можна написати, що дала хороші базові знання в області програмування, що забезпечило швидке кар’єрне зростання, впевненість у колективі більш досвідчених програмістів та розуміння подальшого плану розвитку, як спеціаліста. Також спілкування з однодумцями в групі, робота в команді і т.п.'),
	(5, 'Роксана', 'Соковита', 'Graduates.jpg', '2015-05-12', 'Інтернет-програміст, середнього рівня', 'Google Inc.', 'https://www.google.com/about/careers/', 'Інтернет програміст (РНР), сильний початківець', 'http://intita.itatests.com/course/index/1/', NULL, 5, 'Про академію, можна написати, що дала хороші базові знання в області програмування, що забезпечило швидке кар’єрне зростання, впевненість у колективі більш досвідчених програмістів та розуміння подальшого плану розвитку, як спеціаліста. Також спілкування з однодумцями в групі, робота в команді і т.п.'),
	(6, 'Роксана', 'Соковита', 'Graduates.jpg', '2015-05-12', 'Інтернет-програміст, середнього рівня', 'Google Inc.', 'https://www.google.com/about/careers/', 'Інтернет програміст (РНР), сильний початківець', 'http://intita.itatests.com/course/index/1/', NULL, 6, 'Про академію, можна написати, що дала хороші базові знання в області програмування, що забезпечило швидке кар’єрне зростання, впевненість у колективі більш досвідчених програмістів та розуміння подальшого плану розвитку, як спеціаліста. Також спілкування з однодумцями в групі, робота в команді і т.п.');
/*!40000 ALTER TABLE `graduate` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
