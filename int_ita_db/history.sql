-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-01 19:12:27
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.history
DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) DEFAULT NULL,
  `code` varchar(512) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=298 DEFAULT CHARSET=latin1;

-- Dumping data for table int_ita_db.history: ~57 rows (approximately)
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` (`ID`, `ip`, `code`, `date_time`) VALUES
	(1, '123', '123', '2015-06-02 00:00:00'),
	(242, '127.0.0.1', 'std::cout << "Hello World!" << std::endl;', '2015-06-23 21:22:22'),
	(243, '127.0.0.1', 'std::cout << "Hello World!" << std::endl;', '2015-06-23 21:26:37'),
	(244, '127.0.0.1', 'System.out.println("Hello World!");', '2015-06-23 21:28:13'),
	(245, '127.0.0.1', 'System.out.println("Hello World!");', '2015-06-23 21:57:14'),
	(246, '127.0.0.1', 'System.out.println("Hello World!");', '2015-06-23 21:57:35'),
	(247, '127.0.0.1', 'std::cout << "Hello World!" << std::endl;', '2015-06-24 19:02:44'),
	(248, '127.0.0.1', 'std::cout << "Hello World!" << std::endl;', '2015-06-24 19:12:01'),
	(249, '127.0.0.1', 'System.out.println("Hello World!");', '2015-06-24 19:21:22'),
	(250, '127.0.0.1', 'System.out.println("Hello World!");', '2015-06-24 19:29:31'),
	(251, '127.0.0.1', 'System.out.println("Hello World!");', '2015-06-24 19:29:58'),
	(252, '127.0.0.1', ' System.out.println("Hello World!");   std::cout << "Hello World!" << std::endl;', '2015-06-25 15:23:59'),
	(253, '127.0.0.1', ' System.out.println("Hello World!");   std::cout << "Hello World!" << std::endl;', '2015-06-25 15:28:13'),
	(254, '127.0.0.1', ' System.out.println("Hello World!");   std::cout << "Hello World!" << std::endl;', '2015-06-25 15:28:23'),
	(255, '127.0.0.1', ' System.out.println("Hello World!");   std::cout << "Hello World!" << std::endl;', '2015-06-25 15:28:27'),
	(256, '127.0.0.1', ' System.out.println("Hello World!");   std::cout << "Hello World!" << std::endl;', '2015-06-25 15:28:28'),
	(257, '127.0.0.1', ' System.out.println("Hello World!");   std::cout << "Hello World!" << std::endl;', '2015-06-25 15:28:29'),
	(258, '127.0.0.1', ' System.out.println("Hello World!");   std::cout << "Hello World!" << std::endl;', '2015-06-25 15:28:29'),
	(259, '127.0.0.1', ' System.out.println("Hello World!");   std::cout << "Hello World!" << std::endl;', '2015-06-25 15:28:30'),
	(260, '127.0.0.1', ' System.out.println("Hello World!");   std::cout << "Hello World!" << std::endl;', '2015-06-25 15:28:31'),
	(261, '127.0.0.1', ' System.out.println("Hello World!");   std::cout << "Hello World!" << std::endl;', '2015-06-25 15:28:31'),
	(262, '127.0.0.1', ' System.out.println("Hello World!");   std::cout << "Hello World!" << std::endl;', '2015-06-25 15:28:32'),
	(263, '127.0.0.1', ' System.out.println("Hello World!");   std::cout << "Hello World!" << std::endl;', '2015-06-25 15:28:33'),
	(264, '127.0.0.1', ' System.out.println("Hello World!");   std::cout << "Hello World!" << std::endl;', '2015-06-25 15:28:33'),
	(265, '127.0.0.1', ' System.out.println("Hello World!");   std::cout << "Hello World!" << std::endl;', '2015-06-25 15:28:34'),
	(266, '127.0.0.1', ' System.out.println("Hello World!");   std::cout << "Hello World!" << std::endl;', '2015-06-25 15:28:35'),
	(267, '127.0.0.1', 'std::cout << "Hello World!" << std::endl; //System.out.println("Hello World!");  ', '2015-06-25 15:31:50'),
	(268, '127.0.0.1', ' System.out.println("Hello World!");   std::cout << "Hello World!" << std::endl;', '2015-06-25 15:33:05'),
	(269, '127.0.0.1', ' System.out.println("Hello World!");   std::cout << "Hello World!" << std::endl;', '2015-06-25 15:43:34'),
	(270, '127.0.0.1', ' System.out.println("Hello World!");   std::cout << "Hello World!" << std::endl;', '2015-06-25 15:46:26'),
	(271, '127.0.0.1', ' System.out.println("Hello World!");   ', '2015-06-25 15:49:04'),
	(272, '127.0.0.1', ' System.out.println("Hello World!"); 34  ', '2015-06-25 15:51:05'),
	(273, '127.0.0.1', ' System.out.println("Hello World!"); 34  ', '2015-06-25 15:52:25'),
	(274, '127.0.0.1', ' System.out.println("Hello World!"); 34  ', '2015-06-25 15:52:27'),
	(275, '127.0.0.1', ' System.out.println("Hello World!"); 34  ', '2015-06-25 15:52:30'),
	(276, '127.0.0.1', ' std::cout << "Hello World!" << std::endl;', '2015-06-25 15:54:34'),
	(277, '127.0.0.1', ' std::cout << "Hello World!" << std::endl;', '2015-06-25 15:56:12'),
	(278, '127.0.0.1', ' std::cout << "Hello World!" << std::endl;', '2015-06-25 15:56:14'),
	(279, '127.0.0.1', ' std::cout << "Hello World!" << std::endl;', '2015-06-25 15:56:16'),
	(280, '127.0.0.1', ' std::cout << "Hello World!" << std::endl;', '2015-06-25 15:56:17'),
	(281, '127.0.0.1', ' std::cout << "Hello World!" << std::endl;', '2015-06-25 15:56:19'),
	(282, '127.0.0.1', ' std::cout << "Hello World!" << std::endl;', '2015-06-25 15:56:26'),
	(283, '127.0.0.1', ' std::cout << "Hello World!" << std::endl;', '2015-06-25 15:56:27'),
	(284, '127.0.0.1', ' std::cout << "Hello World!" << std::endl;', '2015-06-25 15:56:29'),
	(285, '127.0.0.1', ' std::cout << "Hello World!" << std::endl;', '2015-06-25 15:56:30'),
	(286, '127.0.0.1', ' std::cout << "Hello World!" << std::endl;', '2015-06-25 16:09:14'),
	(287, '127.0.0.1', ' std::cout << "Hello World!" << std::endl;', '2015-06-25 16:09:23'),
	(288, '127.0.0.1', ' std::cout << "Hello World!" << std::endl;', '2015-06-25 16:09:25'),
	(289, '127.0.0.1', ' std::cout << "Hello Worlda!" << std::endl;', '2015-06-25 16:09:37'),
	(290, '127.0.0.1', ' System.out.println("Hello World!"); ', '2015-06-25 16:09:52'),
	(291, '127.0.0.1', ' std::cout << "Hello Worlda!" << std::endl;', '2015-06-25 16:10:13'),
	(292, '127.0.0.1', ' std::cout << "Hello Worlda!" << std::endl;', '2015-06-25 16:13:42'),
	(293, '127.0.0.1', ' std::cout << "Hello Worlda!" << std::endl;', '2015-06-25 16:13:44'),
	(294, '127.0.0.1', ' std::cout << "Hello Worlda!" << std::endl;', '2015-06-25 16:13:45'),
	(295, '127.0.0.1', ' std::cout << "Hello Worlda!" << std::endl;', '2015-06-25 16:20:26'),
	(296, '81.30.164.98', 'cout << "Hello, world!" << endl;', '2015-06-27 08:10:32'),
	(297, '81.30.164.98', 'cout << "Hello, world!" << endl;', '2015-06-27 08:17:35');
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
