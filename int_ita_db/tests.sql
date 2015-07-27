-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-27 18:55:19
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.tests
DROP TABLE IF EXISTS `tests`;
CREATE TABLE IF NOT EXISTS `tests` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `block_element` int(10) NOT NULL,
  `author` int(10) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.tests: ~49 rows (approximately)
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
INSERT INTO `tests` (`id`, `block_element`, `author`, `title`) VALUES
	(35, 310, 2, 'hystjhytw'),
	(36, 311, 2, 'i578ik57'),
	(37, 349, 1, 'тест 1'),
	(38, 350, 1, 'тест'),
	(39, 353, 1, 'jfjhjkgkg'),
	(40, 358, 1, 'ghghghghghg'),
	(41, 386, 1, 'Основы алгоритмизации и языки программирования'),
	(42, 387, 1, ''),
	(43, 388, 1, ''),
	(44, 389, 1, ''),
	(45, 390, 1, ''),
	(46, 391, 1, ''),
	(47, 392, 1, '1'),
	(48, 393, 1, ''),
	(49, 394, 1, ''),
	(50, 397, 1, ''),
	(51, 399, 1, ''),
	(52, 401, 1, ''),
	(53, 402, 1, ''),
	(54, 403, 1, ''),
	(55, 404, 1, ''),
	(56, 405, 1, ''),
	(57, 406, 1, 'dddd'),
	(58, 407, 1, 'bgfg'),
	(59, 408, 1, ''),
	(60, 409, 1, 'rertfert'),
	(61, 415, 1, ''),
	(62, 418, 1, ''),
	(63, 436, 1, 'тест'),
	(64, 454, 9, ''),
	(65, 455, 9, ''),
	(66, 456, 9, ''),
	(67, 457, 9, ''),
	(68, 458, 9, ''),
	(69, 459, 9, ''),
	(70, 460, 9, ''),
	(71, 461, 9, ''),
	(72, 484, 9, ''),
	(73, 493, 9, ''),
	(74, 498, 9, 'yjrkjir7k'),
	(75, 504, 1, 'test'),
	(76, 505, 1, 'efer'),
	(77, 509, 1, '1'),
	(78, 471, 1, 'test'),
	(79, 492, 1, 'bhjb'),
	(80, 515, 1, 'ьтиптипситясбп'),
	(81, 524, 1, 'тест'),
	(82, 525, 1, ''),
	(83, 528, 1, '');
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
