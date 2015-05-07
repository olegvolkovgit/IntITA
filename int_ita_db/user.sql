-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-05-07 15:19:00
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL DEFAULT 'Анонім',
  `identity` varchar(255) NOT NULL,
  `network` varchar(255) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `secondName` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `birthday` varchar(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `googleplus` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `vkontakte` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `hash` varchar(20) NOT NULL,
  `address` text,
  `education` varchar(255) DEFAULT NULL,
  `educform` varchar(60) DEFAULT 'Онлайн',
  `interests` text,
  `aboutUs` text,
  `aboutMy` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT '/avatars/noname.png',
  `role` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.user: ~13 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `firstName`, `identity`, `network`, `state`, `full_name`, `middleName`, `secondName`, `nickname`, `birthday`, `email`, `password`, `facebook`, `googleplus`, `linkedin`, `vkontakte`, `twitter`, `phone`, `hash`, `address`, `education`, `educform`, `interests`, `aboutUs`, `aboutMy`, `avatar`, `role`) VALUES
	(1, 'Вова', '', '', 0, '', 'Джа', 'Марля', 'Wizlight', '21/03/1997', 'Wizlightdragon@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', '', '+38(911)_______', '', 'Ямайка', 'ВДПУ', 'Онлайн', 'Ковбаска, колобки, раста', '', 'Володію албанською. Люблю м\'ясо та до м\'яса. Розвожу королів. ', '/css/images/1id.jpg', '0'),
	(11, 'ivanna@yutr.rtr', '', '', 0, '', NULL, '', '', '', 'ivanna@yutr.rtr', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, '', '', '', '', 'Онлайн', '', '', '', '/avatars/ivanna@yutr.rtr.jpg', '0'),
	(22, 'tttttt', '', '', 0, '', NULL, '', '', '', 'ttttt@tttt.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, '', '', '', '', 'Онлайн', '', '', '', '/avatars/ttttt@tttt.com.jpg', '0'),
	(38, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'teacher1@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, '/avatars/noname.png', '0'),
	(39, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'teacher2@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, '/avatars/noname.png', '0'),
	(40, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'teacher3@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, '/avatars/noname.png', '0'),
	(41, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'teacher4@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, '/avatars/noname.png', '0'),
	(42, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'teacher5@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, '/avatars/noname.png', '0'),
	(43, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'teacher6@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, '/avatars/noname.png', '0'),
	(44, 'Vinnytsia', '', '', 0, '', NULL, 'IT-Academy', NULL, NULL, 'ita.in.ua.hr@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, '/avatars/noname.png', '0'),
	(45, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'romcom77@gmail.com', '08de4459afb53dd6e8ab179fb42cdb93b0516185', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, '/avatars/noname.png', '0'),
	(46, 'IT', '', '', 0, '', NULL, 'Academy', NULL, NULL, 'ita.in.ua@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, '/avatars/noname.png', '0'),
	(47, 'Анонім', '', '', 0, '', NULL, '', '', '', 'tifjseihfuiw@tttt.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, '', '', '', '', 'Онлайн', '', '', '', '/avatars/5541133ea993f.jpg', '0');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
