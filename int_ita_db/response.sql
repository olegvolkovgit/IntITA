-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-06-24 19:16:25
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.response
DROP TABLE IF EXISTS `response`;
CREATE TABLE IF NOT EXISTS `response` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `who` int(11) NOT NULL,
  `about` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `text` text NOT NULL,
  `rate` int(2) DEFAULT NULL,
  `who_ip` varchar(40) NOT NULL,
  `knowledge` int(2) DEFAULT NULL,
  `behavior` int(2) DEFAULT NULL,
  `motivation` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__user` (`who`),
  KEY `FK__user_2` (`about`),
  CONSTRAINT `FK__user` FOREIGN KEY (`who`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__user_2` FOREIGN KEY (`about`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Responses for teachers';

-- Dumping data for table int_ita_db.response: ~4 rows (approximately)
/*!40000 ALTER TABLE `response` DISABLE KEYS */;
INSERT INTO `response` (`id`, `who`, `about`, `date`, `text`, `rate`, `who_ip`, `knowledge`, `behavior`, `motivation`) VALUES
	(1, 22, 38, '2015-06-24 15:07:16', 'iubl,ugl', 8, '::1', 7, 9, 7),
	(2, 22, 38, '2015-06-24 15:07:26', 'luu;;', 4, '::1', 2, 2, 7),
	(3, 22, 38, '2015-06-24 15:07:36', 'liugl', NULL, '::1', 7, 7, 7),
	(4, 22, 38, '2015-06-24 15:22:00', 'loyilyl', NULL, '::1', 7, 9, 7);
/*!40000 ALTER TABLE `response` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
