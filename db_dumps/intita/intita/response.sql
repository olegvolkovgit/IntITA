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

-- Dumping structure for table intita.response
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
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COMMENT='Responses for teachers';

-- Dumping data for table intita.response: ~72 rows (approximately)
/*!40000 ALTER TABLE `response` DISABLE KEYS */;
INSERT INTO `response` (`id`, `who`, `about`, `date`, `text`, `rate`, `who_ip`, `knowledge`, `behavior`, `motivation`) VALUES
	(1, 22, 38, '2015-06-24 15:07:16', 'iubl,ugl', 6, '::1', 8, 5, 5),
	(2, 22, 38, '2015-06-24 15:07:26', 'luu;;', 4, '::1', 2, 2, 7),
	(3, 22, 38, '2015-06-24 15:07:36', 'liugl', NULL, '::1', 7, 7, 7),
	(4, 22, 38, '2015-06-24 15:22:00', 'loyilyl', NULL, '::1', 7, 9, 7),
	(5, 22, 47, '2015-07-04 09:08:57', 'мрлор  дрлд рлжожлмиижщзжгщхгпщн8щшзагзг9згзг', 5, '81.30.164.98', 8, 6, 2),
	(6, 22, 39, '2015-07-04 09:09:16', 'н8щшздм', 2, '81.30.164.98', 2, 2, 2),
	(7, 22, 39, '2015-07-04 09:09:30', 'пртпьртвяртвопртпвороап\r\nалповаьропоропопврдпапро\r\nывлпоаыпропорпорплрпоп\r\nывлпоавопрропрполрпрп\r\nалптвоапрорпоропорпропроп', 8, '81.30.164.98', 6, 10, 7),
	(8, 22, 39, '2015-07-04 09:09:43', 'анашнрлполролрлдю\r\nплоплолдллддлдлд\r\nапорнноророророс\r\nрорлобобоололол', 8, '81.30.164.98', 6, 10, 7),
	(9, 22, 39, '2015-07-04 09:10:11', 'првлоправ\r\nалповлрп\r\nадпрваолрпл\r\nыалпоаорпр\r\nыоапрловрпл\r\nлоярплярлепрвлпа\r\nвлапоаралорпрлп\r\nяваьрпапдродпр\r\nпояапдлропдлро\r\nвлапрплорпл\r\nыпрваолпрларп\r\nыдвпрлапрларлп\r\nаолрпалрплрп\r\nвклповдор\r\nкопеврореолрелр', 8, '81.30.164.98', 6, 10, 7),
	(10, 22, 39, '2015-07-06 09:36:16', ' nvbnvbnbv', NULL, '94.179.108.235', 4, 4, 4),
	(11, 22, 39, '2015-07-06 09:36:25', 'bbbb', NULL, '94.179.108.235', 1, 1, 1),
	(12, 22, 39, '2015-07-06 09:36:41', 'bbbncnbnbnxbnvbnbvvnbcxbnvbnxnvbnbnvvn', NULL, '94.179.108.235', 2, 2, 2),
	(13, 22, 43, '2015-07-06 10:31:37', '                              ', 1, '94.179.108.235', 1, 1, 1),
	(14, 22, 42, '2015-07-08 16:59:33', 'rydtuyfigkjgkgjkhghgjhjh', 1, '81.30.164.98', 1, 1, 1),
	(15, 22, 42, '2015-07-08 17:00:12', 'itritrhfjgfhgkjjfhgfkjghfkjj\r\ndkfjkghfdjkghkjhkjfhfdkjhfkjgfd\r\nkkjxgkjghjkdghbkjbhfkjbhv\r\nxkhjghfdjfhdkjfdhkjfhgjfdk\r\nxxkvjxfjghjghgjhgkjkghjghgk\r\nckvhfdgjhfgjkfdhgkjfdghkjf\r\ncvhfkjhgdkjkghfjjdfhgkjf\r\ngkkfgjdghgjkhjgkhjgjhghjkhl\r\ndkfgjfjghgjhghjghjghjgjhgjhjg\\\r\nrtyrryytyuyuuuuuuuuuuuuuu\r\ntyryyuyuyuyuytyuuyiuiiiuituiu\r\ntyuytuutiuiuyiuyiuyiuiuiuiii', 10, '81.30.164.98', 10, 10, 10),
	(16, 22, 42, '2015-07-08 17:00:40', 'jhthyutyiuyuty\r\njhtjyhtyhtyjthy\r\njrjthyjthyjtyhtjy\r\njhtjthyjtyhtyjthjt\r\nrhyhhjhhjhjhjjjj\r\nghghffhjhjjhjhj\r\nyyjtkytyjgjhgjhfkgh\r\n', NULL, '81.30.164.98', 1, 1, 1),
	(17, 22, 38, '2015-07-09 14:30:39', 'jggkhj,l', NULL, '178.94.6.7', NULL, NULL, NULL),
	(18, 22, 47, '2015-07-10 10:16:05', 'рьплопло', NULL, '94.179.47.46', NULL, NULL, NULL),
	(19, 22, 42, '2015-07-10 10:21:27', 'чарпорлол', NULL, '94.179.47.46', NULL, NULL, NULL),
	(20, 22, 42, '2015-07-10 10:21:40', 'аоырпоа\r\nвраыпор\r\nыварыаплоа\r\nварпор\r\nвраопра\r\nялмрыоапраэв\r\nварыалопралп', NULL, '94.179.47.46', NULL, NULL, NULL),
	(21, 22, 42, '2015-07-10 10:21:46', 'мтмтбь', NULL, '94.179.47.46', NULL, NULL, NULL),
	(22, 22, 38, '2015-07-10 10:23:00', 'ччиист', NULL, '94.179.47.46', NULL, NULL, NULL),
	(23, 22, 42, '2015-07-10 10:23:57', 'миьб', NULL, '94.179.47.46', NULL, NULL, NULL),
	(24, 45, 109, '2015-07-10 14:06:09', 'qq', 10, '178.95.152.124', 10, 10, 9),
	(25, 45, 109, '2015-07-10 14:06:33', 'wedqw', NULL, '178.95.152.124', NULL, NULL, NULL),
	(26, 45, 109, '2015-07-10 14:06:46', 'aaaa', NULL, '178.95.152.124', NULL, NULL, NULL),
	(27, 22, 109, '2015-07-11 13:33:32', 'bffhtityjjohtjhoyhouhoyt\r\n', 8, '81.30.164.98', 10, 4, 10),
	(28, 22, 109, '2015-07-11 13:33:39', 'tyuytutyutyuyttituu', NULL, '81.30.164.98', NULL, NULL, NULL),
	(29, 22, 109, '2015-07-11 13:33:44', 'tyuytu', NULL, '81.30.164.98', NULL, NULL, NULL),
	(30, 22, 47, '2015-07-11 13:37:51', 'bjhgffh', NULL, '81.30.164.98', NULL, NULL, NULL),
	(31, 45, 109, '2015-07-13 18:26:40', 'vcbnmcvbmnb,nb,n', NULL, '178.93.134.134', NULL, NULL, NULL),
	(32, 106, 40, '2015-07-15 15:17:36', 'имм', 5, '178.94.53.78', 5, 7, 4),
	(33, 106, 110, '2015-07-15 15:30:45', 'в', 1, '178.94.53.78', 1, 1, 1),
	(34, 106, 110, '2015-07-15 15:30:50', 'ы', NULL, '178.94.53.78', NULL, NULL, NULL),
	(35, 22, 38, '2015-07-15 17:04:22', 'r6uyuytiui', NULL, '81.30.164.98', NULL, NULL, NULL),
	(36, 22, 38, '2015-07-15 17:05:27', 'rfjhrghkhgt\r\nrktgjhghjgj\r\ndjfgghghjgj\r\nfkjfjghfjhggjh\r\njhghghghghg\r\nfjghgghgjh\r\nfgjfghfjg\r\nfgfgfggggggg\r\nfkgjfhghggjh\r\nfhfhggkgkg\r\nkcjfjglfjglgflkg\r\nkjgkhjghjgh\r\nfgjgkjghj\r\nflgggh\r\nkfjgkfjgfgj\r\nfgfghhghggkh\r\nfkgjfgjjhkjjhkh\r\nfgjfjgjghjghjlg\r\nfkjgkjkghjghjlg\r\nfkjggkghjgkhjgl\r\nghkjghjglh]\r\ngjglhjgfhjglhg\r\nglhjglhjglhjglh\r\nf;gjgkhjgkhjglhjg\r\ndfkjhgkjhgkhjgl\'\r\nfjglhjghgjhlgjhg\r\nflgkjfgjfhljghlgj\r\n', NULL, '81.30.164.98', NULL, NULL, NULL),
	(37, 106, 41, '2015-07-16 07:16:07', 'bmb,m', 3, '178.94.89.86', 4, 2, 4),
	(38, 45, 117, '2015-07-20 11:09:29', 'птовпрбароюброю', 9, '81.30.164.98', 9, 9, 9),
	(39, 45, 108, '2015-07-20 11:21:48', 'кіеопальпрьч', 9, '81.30.164.98', 10, 8, 8),
	(40, 22, 41, '2015-07-20 14:20:53', '        jhv', 3, '178.92.81.45', 3, 2, 5),
	(41, 22, 39, '2015-07-21 09:03:04', 'reer', NULL, '94.179.58.220', NULL, NULL, NULL),
	(42, 52, 38, '2015-07-21 09:07:33', ' cncbvxbx', 1, '94.179.58.220', 1, 1, 1),
	(43, 52, 38, '2015-07-21 09:07:43', 'khgghdfsh', NULL, '94.179.58.220', NULL, NULL, NULL),
	(44, 52, 38, '2015-07-21 09:07:51', 'mfjgfjdhf', NULL, '94.179.58.220', NULL, NULL, NULL),
	(45, 45, 117, '2015-07-21 15:17:28', 'кккккккккккккккк', NULL, '81.30.164.98', NULL, NULL, NULL),
	(46, 121, 42, '2015-07-22 08:26:18', 'рмапввыаи', 5, '94.179.33.38', 4, 8, 3),
	(47, 121, 42, '2015-07-22 08:26:32', 'п445464863', NULL, '94.179.33.38', NULL, NULL, NULL),
	(48, 121, 108, '2015-07-22 08:44:58', 'иьть', 10, '94.179.33.38', 10, 10, 10),
	(49, 121, 108, '2015-07-22 08:45:08', 'пторь', NULL, '94.179.33.38', NULL, NULL, NULL),
	(50, 45, 108, '2015-07-22 08:53:10', 'qfwgvadsv', NULL, '81.30.164.98', NULL, NULL, NULL),
	(51, 45, 109, '2015-07-22 08:53:33', 'rsthnsfgn', NULL, '81.30.164.98', NULL, NULL, NULL),
	(52, 121, 43, '2015-07-24 09:24:59', 'вмірувяепо', 4, '94.179.32.251', 2, 8, 2),
	(53, 121, 43, '2015-07-24 09:25:18', 'акнгнгонгоікьнікн\r\nнгінгегнг\r\nкнгінкгнкгн\r\nкгннгнгнгнгн\r\nоеенге', NULL, '94.179.32.251', NULL, NULL, NULL),
	(54, 22, 38, '2015-07-27 10:13:36', 'mkmmknmbn', NULL, '94.179.88.43', NULL, NULL, NULL),
	(55, 121, 38, '2015-07-27 13:48:11', 'fyudg', 10, '94.179.88.43', 9, 10, 10),
	(56, 22, 41, '2015-07-28 19:12:07', 'яапяваряпврвпрявпрвпрвпрп', NULL, '178.94.43.154', NULL, NULL, NULL),
	(57, 129, 42, '2015-07-29 10:53:23', 'кккнкн!крр;м\r\nрлоаист.%лор\r\n\r\nдл\r\nоплр', 9, '94.179.103.214', 8, 9, 9),
	(58, 22, 117, '2015-08-10 15:04:10', 'hgjfj', 4, '81.30.164.98', 5, 4, 4),
	(59, 22, 38, '2015-08-10 15:47:05', ' ьть', NULL, '81.30.164.98', NULL, NULL, NULL),
	(60, 22, 40, '2015-08-11 17:56:42', ' иьть ', 8, '94.179.97.196', 8, 6, 9),
	(61, 22, 40, '2015-08-12 13:43:11', 'dhfgzjfjxfhjfhj', NULL, '81.30.164.98', NULL, NULL, NULL),
	(62, 22, 40, '2015-08-12 13:43:30', 'jkltjhlksjhfljhlfhj\r\nkgjhgjhlkkgfhfgl\r\nsdjfdfgsdfgd\r\nmdhgfdfgdjd', NULL, '81.30.164.98', NULL, NULL, NULL),
	(63, 44, 39, '2015-08-12 14:17:02', 'вап', 5, '80.91.174.90', 8, 5, 2),
	(64, 44, 117, '2015-08-12 14:18:58', 'йййййййййййййййййййй', 9, '80.91.174.90', 10, 9, 9),
	(65, 52, 40, '2015-08-12 14:54:27', 'ааоаоаро', 7, '81.30.164.98', 8, 4, 8),
	(66, 52, 40, '2015-08-12 14:54:43', 'прапрпарпрап', NULL, '81.30.164.98', NULL, NULL, NULL),
	(67, 45, 130, '2015-08-12 18:49:28', 'sdfghfgmgh,.jm.', 9, '37.54.6.244', 9, 9, 9),
	(68, 45, 109, '2015-08-13 08:14:34', 'ссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссс\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссс\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссс???????????????????????????\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n?????????????????????????????????????????????77', NULL, '81.30.164.98', NULL, NULL, NULL),
	(69, 51, 43, '2015-08-14 15:13:16', '1', 2, '81.30.164.98', 2, 2, 2),
	(70, 51, 43, '2015-08-14 15:13:19', '1', NULL, '81.30.164.98', NULL, NULL, NULL),
	(71, 51, 43, '2015-08-14 15:13:22', '1', NULL, '81.30.164.98', NULL, NULL, NULL),
	(72, 45, 130, '2015-08-14 19:03:15', 'ццццццццццццццццццццццццццццццццццццццццццццццццццццццццццц\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nцццццццццццццццццццццццццццццццццццццццц\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nццццццццццццццццццццццц', NULL, '37.54.4.76', NULL, NULL, NULL);
/*!40000 ALTER TABLE `response` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
