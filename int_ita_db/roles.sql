-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-20 16:13:47
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title_en` varchar(20) NOT NULL,
  `title_ru` varchar(20) NOT NULL,
  `title_ua` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='List of teachers roles.';

-- Dumping data for table int_ita_db.roles: ~15 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `title_en`, `title_ru`, `title_ua`, `description`) VALUES
	(1, 'Trainer', 'Тренер', 'Тренер', 'Trainer. Help student with simple and common problems.'),
	(2, 'Consultant', 'Консультант', 'Консультант', 'Online consultations'),
	(3, 'Leader', 'Руководитель проекта', 'Керівник проекта', 'Leader for single and team students projects'),
	(4, 'Author', 'Автор модуля', 'Автор модуля', 'Module owner'),
	(5, 'Admin', 'Админ', 'Адмін', 'Create and describe courses and modules.'),
	(6, '67u48u', 'ur7u7', 'uryru76r', 'j7j6r'),
	(7, 'gserg', 'grggeg', '11111', 'gegeg'),
	(8, 'rge5', 't4525', 'r42', 'wef524'),
	(9, 'rge5', 't4525', 'r42', 'wef524'),
	(10, 'rge5', 't4525', 'r42', 'wef524'),
	(11, 'rge5', 't4525', 'r42', 'wef524'),
	(12, 'rge5', 't4525', 'fser42', 'wef524'),
	(13, 'rge5', 't4525', 'fser42', 'wef524'),
	(14, 'rge5', 't4525', 'fser42', 'wef524'),
	(15, 'uikmy', 'hty', 'htdyh', 'hdty');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
