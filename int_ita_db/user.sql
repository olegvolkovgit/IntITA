-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-04-22 15:37:35
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
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `hash` varchar(20) NOT NULL,
  `address` text,
  `education` varchar(255) DEFAULT NULL,
  `educform` varchar(60) DEFAULT 'Не вибрано',
  `interests` text,
  `aboutUs` text,
  `aboutMy` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT '/css/images/avatars/noname.png',
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.user: ~30 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `firstName`, `identity`, `network`, `state`, `full_name`, `middleName`, `secondName`, `nickname`, `birthday`, `email`, `password`, `phone`, `hash`, `address`, `education`, `educform`, `interests`, `aboutUs`, `aboutMy`, `avatar`, `role`) VALUES
	(1, 'Вова', '', '', 0, '', 'Джа', 'Марля', 'Wizlight', '21/03/1997', 'Wizlightdragon@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '911', '', 'Ямайка', 'ВДПУ', 'Онлайн', 'Ковбаска, колобки, раста', 'Інтернет', 'Володію албанською. Люблю м\'ясо та до м\'яса. Розвожу королів. ', '/css/images/1id.jpg', ''),
	(5, 't54wy6wy@ferwg.gtrf', '', '', 0, '', NULL, NULL, NULL, NULL, 't54wy6wy@ferwg.gtrf', 'egrwhjet6', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
	(6, 'dfesafhe@fjgr.gfrje', '', '', 0, '', NULL, NULL, NULL, NULL, 'dfesafhe@fjgr.gfrje', 'fkrjgfrklfjrlk', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
	(7, 'fhsdgfh@deyg.gdehj', '', '', 0, '', NULL, NULL, NULL, NULL, 'fhsdgfh@deyg.gdehj', 'vfdvdf', NULL, '', NULL, NULL, 'Не вибрано', NULL, NULL, NULL, NULL, ''),
	(8, 'admin@EHJBF.SNDFS', '', '', 0, '', NULL, NULL, NULL, NULL, 'admin@EHJBF.SNDFS', 'd6877098041a8a30bc8bd8f9faeeb8e62afd682f', NULL, '', NULL, NULL, 'Не вибрано', NULL, NULL, NULL, NULL, ''),
	(9, 'gfvzdrgfregt', '', '', 0, '', NULL, '', '', '', 'gfsGFea@EFSF.DEW', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', 'Онлайн', '', '', '', NULL, '0'),
	(10, 'Wizlightdrago@gmail.com', '', '', 0, '', NULL, NULL, NULL, NULL, 'Wizlightdrago@gmail.com', '17ba0791499db908433b80f37c5fbc89b870084b', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
	(11, 'ivanna@yutr.rtr', '', '', 0, '', NULL, '', '', '', 'ivanna@yutr.rtr', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', NULL, '', '', '', '/css/images/avatars/ivanna@yutr.rtr.jpg', ''),
	(12, 'dawfawef@efew.rew', '', '', 0, '', NULL, NULL, NULL, NULL, 'dawfawef@efew.rew', '011c945f30ce2cbafc452f39840f025693339c42', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '/css/images/avatars/noname.png', ''),
	(13, 'gtsgrstg@fretf.gtr', '', '', 0, '', NULL, NULL, NULL, NULL, 'gtsgrstg@fretf.gtr', '011c945f30ce2cbafc452f39840f025693339c42', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '/css/images/avatars/noname.png', ''),
	(14, 'fsef@sg.tgf', '', '', 0, '', NULL, NULL, NULL, NULL, 'fsef@sg.tgf', '8eddb6bdf9a5139e587bd661994c33d59ab3320d', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '/css/images/avatars/noname.png', ''),
	(15, 'fsefsergfer', '', '', 0, '', NULL, '', '', '', 'rgdrgrtfg@fdr.uky', '12c6fc06c99a462375eeb3f43dfd832b08ca9e17', '', '', '', '', 'Онлайн', '', '', '', '/css/images/avatars/rgdrgrtfg@fdr.uky.jpg', '0'),
	(16, 'bdkjfvh', '', '', 0, '', NULL, '', '', '', 'bbbbbgg@bb.bb', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '', '', '', '', '', '', '', '', NULL, '0'),
	(17, 'fsdgdrhdh', '', '', 0, '', NULL, '', '', '', 'rgdrgjjrtfg@fdr.uky', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', 'Онлайн/Офлайн', '', '', '', NULL, '0'),
	(18, 'bdkjfvh', '', '', 0, '', NULL, '', '', '', 'bbbbhb@bb.bb', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', '', '', '', '', NULL, '0'),
	(19, 'rsysryyu', '', '', 0, '', NULL, '', '', '', 'tesys45y@yt.uy', '12c6fc06c99a462375eeb3f43dfd832b08ca9e17', '', '', '', '', 'Не вибрано', '', '', '', NULL, '0'),
	(20, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'hsvfhjs@dewj.few', '12c6fc06c99a462375eeb3f43dfd832b08ca9e17', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
	(21, 'kjhkohlnk', '', '', 0, '', NULL, '', '', '', 'hchh+5@opjuigbliy.gkyugf', '73bf9dfd2709e0dfc11bc4ce8cf259a347556dcb', '', '', '', '', 'Не вибрано', '', '', '', '/css/images/avatar/noname.png', '0'),
	(22, 'tttttt', '', '', 0, '', NULL, '', '', '', 'ttttt@tttt.com', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', 'Не вибрано', '', '', '', '/css/images/avatars/ttttt@tttt.com.jpg', '0'),
	(24, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'vhfvyh@ft.huh', 'f2c42640c920871074aea6971d71d038f95e8cf6', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '/noname.png', ''),
	(25, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'bjhbi@fyh.ji', 'b4aa1b38a0c42a0854f1a39b3f47171d48bd7887', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '/css/images/avatars/noname.png', ''),
	(26, '', '', '', 0, '', NULL, NULL, NULL, NULL, 'tttedtt@tttt.com', '70f615ab34448baae29eada2921932adf6eabdf0', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '/css/images/avatars/noname.png', ''),
	(27, 'Ivanna', '', '', 0, '', NULL, 'Bezpalko', NULL, NULL, 'vnnchkh@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '/css/images/avatars/noname.png', ''),
	(28, 'Иванна', '', '', 0, '', NULL, 'Безпалько', NULL, NULL, 'ivanna_sunny@ukr.net', '011c945f30ce2cbafc452f39840f025693339c42', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '/css/images/avatars/noname.png', ''),
	(29, ' n,jb,bhj,b', '', '', 0, '', NULL, '', '', '', 'vhvghvh@rw.dw', '17ba0791499db908433b80f37c5fbc89b870084b', '', '', '', '', 'Офлайн', '', '', '', '/css/images/avatars/noname.png', '0'),
	(30, 'dafse', '', '', 0, '', NULL, '', '', '', 'fsrgfe@rth.tr', '17ba0791499db908433b80f37c5fbc89b870084b', '', '', '', '', 'Офлайн', '', '', '', '/css/images/avatars/noname.png', '0'),
	(31, 'уцуфуафукп', '', '', 0, '', NULL, '', '', '', 'vdrgf@ferw.dwe', '17ba0791499db908433b80f37c5fbc89b870084b', '', '', '', '', 'Офлайн', '', '', '', '/css/images/avatars/noname.png', '0'),
	(32, 'ewerwrdw', '', '', 0, '', NULL, '', '', '', 'werfw@few.yjt', 'b6692ea5df920cad691c20319a6fffd7a4a766b8', '', '', '', '', 'Онлайн', '', '', '', '/css/images/avatars/noname.png', '0'),
	(33, 'rw3trw34', '', '', 0, '', NULL, '', '', '', 'erq3r@rfe.uky', '17ba0791499db908433b80f37c5fbc89b870084b', '', '', '', '', 'Не вибрано', '', '', '', '/css/images/avatars/noname.png', '0'),
	(34, 'fdsfdrfvd', '', '', 0, '', NULL, '', '', '', 'fesrfre@gtr.fre', '98fbc42faedc02492397cb5962ea3a3ffc0a9243', '', '', '', '', 'Не вибрано', '', '', '', '/css/images/avatars/noname.png', '0'),
	(35, 'вуацупацкп', '', '', 0, '', NULL, '', '', '', 'dnfj@fnek.fe', '17ba0791499db908433b80f37c5fbc89b870084b', '', '', '', '', 'Не вибрано', '', '', '', '/css/images/avatars/noname.png', '0'),
	(36, 'gerwggt', '', '', 0, '', NULL, '', '', '', 'fersrg@fe.yu', '17ba0791499db908433b80f37c5fbc89b870084b', '', '', '', '', 'Не вибрано', '', '', '', '/css/images/avatars/noname.png', '0'),
	(37, 'bdfwjednb', '', '', 0, '', NULL, '', '', '', 'dseafa@rew.ew', '17ba0791499db908433b80f37c5fbc89b870084b', '', '', '', '', 'Не вибрано', '', '', '', '/css/images/avatars/noname.png', '0');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
