-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-29 20:33:50
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
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
  `avatar` varchar(255) DEFAULT 'noname.png',
  `role` tinyint(2) NOT NULL DEFAULT '0',
  `token` varchar(150) DEFAULT NULL,
  `activkey_lifetime` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `reg_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.user: ~47 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `firstName`, `identity`, `network`, `state`, `full_name`, `middleName`, `secondName`, `nickname`, `birthday`, `email`, `password`, `facebook`, `googleplus`, `linkedin`, `vkontakte`, `twitter`, `phone`, `hash`, `address`, `education`, `educform`, `interests`, `aboutUs`, `aboutMy`, `avatar`, `role`, `token`, `activkey_lifetime`, `status`, `reg_time`) VALUES
	(1, 'Anonim', '', '', 0, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, NULL, NULL, 0, 0),
	(2, 'Administrator', '', '', 0, '', NULL, 'Forum', '', '', 'forum_admin@gmail.com', '20eabe5d64b0e216796e834f52d61fd0b70332fc', '', '', '', '', '', '', '', '', '', 'Онлайн', '', '', '', 'noname.png', 3, 'ef50a48e3132fb85a11a789529f45ca21e18e322', NULL, 1, 0),
	(11, 'ivannayutrrtr', '', '', 0, '', NULL, '', '', '', 'ivanna@yutr.rtr', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, '', '', '', '', 'Онлайн', '', '', '', 'noname.png', 1, NULL, NULL, 1, 0),
	(22, 'Student', '', '', 0, '', NULL, '', '', '01/02/2003', 'student@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', '', '+38(111)111111_', '', '', '', 'Онлайн', '', '', 'kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '55af62608fbde.jpg', 0, NULL, NULL, 1, 0),
	(38, 'teacher', '', '', 0, '', NULL, '', '', '11/11/2011', 'teacher1@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', '', '+38(000)0000000', '', '', '', 'Онлайн', '', '', '', 'noname.png', 1, '8f1f15efd7312a5795163d48402a727541c8ddc2', '2015-07-29 09:55:49', 1, 0),
	(39, '', '', '', 0, '', NULL, '', '', '', 'teacher2@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', '', '', '', '', '', 'Онлайн', '', '', '', 'noname.png', 1, NULL, NULL, 1, 0),
	(40, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'teacher3@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 1, NULL, NULL, 1, 0),
	(41, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'teacher4@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 1, NULL, NULL, 1, 0),
	(42, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'teacher5@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 1, NULL, NULL, 1, 0),
	(43, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'teacher6@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 1, NULL, NULL, 1, 0),
	(44, 'Vinnytsia', '', '', 0, '', NULL, 'ITAcademy', NULL, NULL, 'ita.in.ua.hr@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, NULL, NULL, 1, 0),
	(45, 'Roman', '', '', 0, '', NULL, 'Melnyk', 'Romcom', '', 'romcom77@gmail.com', '08de4459afb53dd6e8ab179fb42cdb93b0516185', '', '', '', '', '', '', '', '', '', 'Онлайн/Офлайн', '', '', '', '55acd1ce9411d.jpg', 0, NULL, NULL, 1, 0),
	(46, 'IT', '', '', 0, '', NULL, 'Academy', NULL, NULL, 'ita.in.ua@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, NULL, NULL, 1, 0),
	(47, 'Анонім', '', '', 0, '', NULL, '', '', '', 'tifjseihfuiw@tttt.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, '', '', '', '', 'Онлайн', '', '', '', 'noname.png', 1, NULL, NULL, 1, 0),
	(48, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'teac@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 1, NULL, NULL, 1, 0),
	(49, 'Admin', '', '', 0, '', NULL, NULL, NULL, NULL, 'vnnchkh@gmail.com', '20eabe5d64b0e216796e834f52d61fd0b70332fc', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 3, NULL, NULL, 1, 0),
	(50, 'Serhiy', '', '', 0, '', NULL, 'Kalinovsky', NULL, '19.11.1978', 'serhiy.kalinovsky@gmail.com', NULL, 'https://www.facebook.com/serhiy.kalinovsky', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 1, NULL, NULL, 1, 0),
	(51, 'StudentF', '', '', 0, '', NULL, NULL, NULL, NULL, 'student1@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, NULL, NULL, 1, 0),
	(52, 'Student ', '', '', 0, '', NULL, '', '', '', 'student2@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', '', '', '', '', '', 'Онлайн', '', '', '', '55af4627def0a.jpg', 0, NULL, NULL, 1, 0),
	(53, 'StudenT', '', '', 0, '', NULL, NULL, NULL, NULL, 'student3@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, NULL, NULL, 1, 0),
	(54, 'StudentFour', '', '', 0, '', NULL, NULL, NULL, NULL, 'student4@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, NULL, NULL, 1, 0),
	(55, 'StudentFive', '', '', 0, '', NULL, NULL, NULL, NULL, 'student5@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, NULL, NULL, 1, 0),
	(56, 'Вова', '', '', 0, '', 'Джа', 'Марля', 'Wizlight', '21/03/1997', 'Wizlightdragon@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', '', '+38(911)_______', '', 'Ямайка', 'ВДПУ', 'Онлайн', 'Ковбаска, колобки, раста', '', 'Володію албанською. Люблю м\'ясо та до м\'яса. Розвожу королів. ', '55a912c34baad.jpg', 0, NULL, NULL, 1, 0),
	(103, 'David', '', '', 0, '', NULL, 'Cameron', '', '', 'info@bonprix.ua', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '', '', '', '', '', '', '', '', '', 'Онлайн', '', '', '', 'noname.png', 0, 'bfbb9ee6d481be5934356ddde3f42861ae3dc2e0', NULL, 1, 0),
	(104, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'fbgf@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, 'c5f1a9722575671a9da8efe5cc32e26f76092818', NULL, 0, 0),
	(106, '\'', '', '', 0, '', NULL, '\'', '111', '11/11/2011', 'nnn.badyora2015@gmail.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '', '', '', '', '', '+38(111)1111111', '', '', '', 'Онлайн', '', '', '', 'noname.png', 0, NULL, NULL, 1, 0),
	(108, 'Sector', '', '', 0, '', NULL, 'Freedom', NULL, NULL, 'yaroslav.plaksii@gmail.com', NULL, 'http://www.facebook.com/100007943565992', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, '559f786580f41.jpg', 1, NULL, NULL, 1, 0),
	(109, '', '', '', 0, '', NULL, '', '', '', 'antongriadchenko@gmail.com', '5a7e4b28af86dc7f576692b97266fb445149ddee', '', '', '', '', '', '', '', '', '', 'Онлайн', '', '', '', 'noname.png', 1, NULL, NULL, 1, 0),
	(110, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'nover2579@yandex.ru', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 1, NULL, NULL, 1, 0),
	(111, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'nover2579@yandex.ru', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, NULL, NULL, 1, 0),
	(113, 'Олександр', '', '', 0, '', NULL, 'Бохан', NULL, NULL, 'bohanoleksandr@gmail.com', NULL, NULL, 'https://plus.google.com/108436464601398494495', NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, '55a4f757309bd.jpg', 0, NULL, NULL, 1, 0),
	(114, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'sdhfk@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, 'cfdd43635cc3655c739fe28d97ef59111c81f6b7', NULL, 0, 0),
	(115, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'nnn.basyora2015@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, '3c79de9b46fbbd2d1a58bd6f3b378c7fe019d9ed', NULL, 0, 0),
	(116, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'gfhjdkghfkghdkg@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, '00a07e16dabfafe4507b1751fc68407f3d6fbdbc', NULL, 0, 0),
	(117, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'permmemo@gmail.com', '33852ff90d1a0fcd5ec3806275ad5d19b20bc69a', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 1, NULL, NULL, 1, 0),
	(118, 'gjgkgkj', '', '', 0, '', NULL, 'hjghjggjgh', 'hjhjhjhj', '14/02/2012', 'gfhjd@gmail.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '', '', '', '', '', '+38(380)0387125', '', '', '', 'Онлайн/Офлайн', '', '', '', 'noname.png', 0, '8d5ab4dc6bfea2d3bdb64ffe0d82f55d069ea4a7', NULL, 0, 0),
	(119, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'fjghdfgkhdfgk@ghfkgh.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, '1cf6f858abe11ac03e10bc5257a22d49b2223424', NULL, 0, 0),
	(120, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'inderella9566cb@rumbler.ru', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, 'dcabda068f44b293f5f4111d0c7d010c11af5177', NULL, 0, 0),
	(121, '', '', '', 0, '', NULL, '', '', '', '22student55@mail.ua', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', '', '', '', '', '', 'Онлайн', '', '', '', '55af57a34461d.jpg', 0, NULL, NULL, 1, 0),
	(122, '', '', '', 0, '', NULL, NULL, NULL, NULL, '55sweet55@ukr.net', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, 'a9ab4b7c9d80eaf187d9c3e61833cdd576be1016', NULL, 0, 0),
	(123, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'datingstest2015@i.ua', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, NULL, NULL, 1, 0),
	(124, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'datingstest2015@meta.ua', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, NULL, NULL, 1, 0),
	(125, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'potap@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, '511f63a611a3c4af4a74705294750b458a30f716', NULL, 1, 1438013849),
	(126, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'fdghf@gmail.44', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, '73871ad16527d5492735ec0fb28d61f49b6ee3fb', NULL, 0, 1438062774),
	(127, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'ohnDoe@example.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, '152c6eb30316267b4955e076951ef7a55ba4c960', NULL, 0, 1438079401),
	(128, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'o.h.nDoe@example.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, 'noname.png', 0, 'dbee357fd9bcaf25080407179a113ce1fff64ef7', NULL, 0, 1438079467),
	(129, 'Наталья', '', '', 0, '', NULL, 'Бадёра', NULL, '20.04.1989', 'natasha-badora@yandex.ru', '011c945f30ce2cbafc452f39840f025693339c42', 'https://www.facebook.com/app_scoped_user_id/805219722881225/', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Онлайн', NULL, NULL, NULL, '55b8a44c268ca.jpg', 0, NULL, NULL, 1, 1438165651);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
