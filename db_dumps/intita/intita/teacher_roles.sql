-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-15 11:35:06
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table intita.teacher_roles
DROP TABLE IF EXISTS `teacher_roles`;
CREATE TABLE IF NOT EXISTS `teacher_roles` (
  `teacher` int(10) NOT NULL,
  `role` int(10) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  KEY `FK_teacher_roles_teacher` (`teacher`),
  KEY `FK_teacher_roles_roles` (`role`),
  CONSTRAINT `FK_teacher_roles_roles` FOREIGN KEY (`role`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_teacher_roles_teacher` FOREIGN KEY (`teacher`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table intita.teacher_roles: ~26 rows (approximately)
/*!40000 ALTER TABLE `teacher_roles` DISABLE KEYS */;
INSERT INTO `teacher_roles` (`teacher`, `role`, `start_date`, `end_date`) VALUES
	(1, 4, '0000-00-00', '0000-00-00'),
	(1, 1, '0000-00-00', '0000-00-00'),
	(2, 2, '0000-00-00', '0000-00-00'),
	(5, 4, '0000-00-00', '0000-00-00'),
	(6, 2, '0000-00-00', '0000-00-00'),
	(3, 3, '0000-00-00', '0000-00-00'),
	(4, 3, '0000-00-00', '0000-00-00'),
	(3, 4, '0000-00-00', '0000-00-00'),
	(3, 2, '0000-00-00', '0000-00-00'),
	(2, 1, '0000-00-00', '0000-00-00'),
	(3, 1, '0000-00-00', '0000-00-00'),
	(4, 1, '0000-00-00', '0000-00-00'),
	(6, 1, '0000-00-00', '0000-00-00'),
	(1, 3, '0000-00-00', '0000-00-00'),
	(2, 3, '0000-00-00', '0000-00-00'),
	(5, 3, '2015-06-24', '0000-00-00'),
	(6, 3, '0000-00-00', '0000-00-00'),
	(5, 1, '2015-06-24', '0000-00-00'),
	(4, 2, '2015-06-24', '0000-00-00'),
	(5, 2, '2015-06-24', '0000-00-00'),
	(1, 2, '2015-06-24', '0000-00-00'),
	(1, 4, '2015-06-24', '0000-00-00'),
	(2, 4, '2015-06-24', '0000-00-00'),
	(4, 4, '2015-06-24', '0000-00-00'),
	(5, 4, '2015-06-24', '0000-00-00'),
	(6, 4, '2015-06-24', '0000-00-00');
/*!40000 ALTER TABLE `teacher_roles` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
