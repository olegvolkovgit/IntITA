-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-15 11:35:27
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table mibew.message
DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `messageid` int(11) NOT NULL AUTO_INCREMENT,
  `threadid` int(11) NOT NULL,
  `ikind` int(11) NOT NULL,
  `agentid` int(11) NOT NULL DEFAULT '0',
  `tmessage` text NOT NULL,
  `plugin` varchar(256) NOT NULL DEFAULT '',
  `data` text,
  `dtmcreated` int(11) NOT NULL DEFAULT '0',
  `tname` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`messageid`),
  KEY `idx_agentid` (`agentid`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

-- Dumping data for table mibew.message: ~83 rows (approximately)
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` (`messageid`, `threadid`, `ikind`, `agentid`, `tmessage`, `plugin`, `data`, `dtmcreated`, `tname`) VALUES
	(1, 1, 3, 0, 'Vistor came from page http://localhost/IntITA/lesson', '', 'a:0:{}', 1428579355, NULL),
	(2, 1, 3, 0, 'E-Mail: vnnchkh@gmail.com', '', 'a:0:{}', 1428579355, NULL),
	(3, 1, 1, 0, 'Hello!', '', 'a:0:{}', 1428579355, 'Guest'),
	(4, 2, 3, 0, 'Vistor came from page http://intita.itatests.com/lesson\nhttp://intita.itatests.com/module', '', 'a:0:{}', 1428776630, NULL),
	(5, 2, 3, 0, 'E-Mail: q@R.COM', '', 'a:0:{}', 1428776630, NULL),
	(6, 2, 1, 0, 'q', '', 'a:0:{}', 1428776630, 'Guest'),
	(7, 3, 3, 0, 'Vistor came from page http://intita.itatests.com/lesson#\nhttp://intita.itatests.com/module', '', 'a:0:{}', 1429116539, NULL),
	(8, 3, 3, 0, 'E-Mail: cdfcfgj@reger.com', '', 'a:0:{}', 1429116539, NULL),
	(9, 3, 1, 0, 'cfjcfjcfgjcfg', '', 'a:0:{}', 1429116539, 'Guest'),
	(10, 4, 3, 0, 'Vistor came from page http://intita.itatests.com/lesson\nhttp://intita.itatests.com/module/', '', 'a:0:{}', 1430576375, NULL),
	(11, 4, 3, 0, 'E-Mail: e4tw4wtee44t3@erjf.kjdfb', '', 'a:0:{}', 1430576375, NULL),
	(12, 4, 1, 0, '43t234t324t', '', 'a:0:{}', 1430576375, 'Guest'),
	(13, 5, 3, 0, 'Vistor came from page http://intita.itatests.com/lesson\nhttp://intita.itatests.com/module/', '', 'a:0:{}', 1430576710, NULL),
	(14, 5, 4, 0, 'Thank you for contacting us. An operator will be with you shortly.', '', 'a:0:{}', 1430576710, NULL),
	(15, 5, 6, 0, 'Operator Administrator joined the chat', '', 'a:0:{}', 1430576721, NULL),
	(16, 5, 2, 1, 't34litlh34ltnl3k4tn', '', 'a:0:{}', 1430576727, 'Administrator'),
	(17, 5, 1, 0, 'dg34g34gg', '', 'a:0:{}', 1430576731, 'Guest'),
	(18, 5, 1, 0, 'ekjgewkrgeng kejgkjer', '', 'a:0:{}', 1430576764, 'Guest'),
	(19, 5, 1, 0, '4v5tytytd', '', 'a:0:{}', 1430577718, 'Guest'),
	(20, 5, 2, 1, 'wefwqrgebew gtb', '', 'a:0:{}', 1430577738, 'Administrator'),
	(21, 5, 1, 0, 'fioergoweirgh', '', 'a:0:{}', 1430577832, 'Guest'),
	(22, 5, 3, 0, 'Visitor closed chat window', '', 'a:0:{}', 1430577877, NULL),
	(23, 6, 3, 0, 'Відвідувач прийшов зі сторінки http://intita.itatests.com/lesson/index/5/\nhttp://intita.itatests.com/lesson/index/5/', '', 'a:0:{}', 1434637791, NULL),
	(24, 6, 3, 0, 'E-Mail: nover2579@yandex.ru', '', 'a:0:{}', 1434637791, NULL),
	(25, 6, 1, 0, 'jkfg', '', 'a:0:{}', 1434637791, 'Відвідувач'),
	(26, 7, 3, 0, 'Відвідувач прийшов зі сторінки http://intita.itatests.com/lesson/index/1/?idCourse=1\nhttp://intita.itatests.com/module/index/?idModule=1&idCourse=1', '', 'a:0:{}', 1436258640, NULL),
	(27, 7, 3, 0, 'E-Mail: yjhj@gmail.com', '', 'a:0:{}', 1436258640, NULL),
	(28, 7, 1, 0, 'fggh', '', 'a:0:{}', 1436258640, 'Відвідувач'),
	(29, 8, 3, 0, 'Відвідувач прийшов зі сторінки http://intita.itatests.com/lesson/index/80/?idCourse=1\nhttp://intita.itatests.com/module/index/?idModule=1&idCourse=1', '', 'a:0:{}', 1436547923, NULL),
	(30, 8, 3, 0, 'E-Mail: romcom77@gmail.com', '', 'a:0:{}', 1436547923, NULL),
	(31, 8, 1, 0, 'ййййййййййййййййййййййййййййййййййййййййййййкккккккккккккккккккккккккккккккккккккккклллллллллллллмммммммнннннннннннннн', '', 'a:0:{}', 1436547923, 'рррр'),
	(32, 9, 3, 0, 'Відвідувач прийшов зі сторінки http://intita.itatests.com/lesson/index/1/?idCourse=3\nhttp://intita.itatests.com/lesson/index/2/?idCourse=3', '', 'a:0:{}', 1436621254, NULL),
	(33, 9, 4, 0, 'Будь-ласка, почекайте, до Вас приєднається оператор..', '', 'a:0:{}', 1436621254, NULL),
	(34, 9, 6, 0, 'Оператор Oleksii The Great включився в розмову', '', 'a:0:{}', 1436621264, NULL),
	(35, 9, 2, 2, 'nlkn', '', 'a:0:{}', 1436621269, 'Oleksii The Great'),
	(36, 9, 2, 2, 'kljnbkrtengrtnb;', '', 'a:0:{}', 1436621272, 'Oleksii The Great'),
	(37, 10, 3, 0, 'Відвідувач прийшов зі сторінки http://intita.itatests.com/lesson/index/1/?idCourse=1\nhttp://intita.itatests.com/module/index/?idModule=1&idCourse=1', '', 'a:0:{}', 1436621298, NULL),
	(38, 10, 4, 0, 'Будь-ласка, почекайте, до Вас приєднається оператор..', '', 'a:0:{}', 1436621298, NULL),
	(39, 11, 3, 0, 'Відвідувач прийшов зі сторінки http://intita.itatests.com/lesson/index/27/?idCourse=1\nhttp://intita.itatests.com/lesson/index/27/?idCourse=1', '', 'a:0:{}', 1436621299, NULL),
	(40, 11, 4, 0, 'Будь-ласка, почекайте, до Вас приєднається оператор..', '', 'a:0:{}', 1436621299, NULL),
	(41, 10, 1, 0, 'xdfhjngh', '', 'a:0:{}', 1436621303, 'Відвідувач'),
	(42, 10, 6, 0, 'Оператор Oleksii The Great включився в розмову', '', 'a:0:{}', 1436621306, NULL),
	(43, 11, 1, 0, 'yuukililjgoj;go;ioo;pgio', '', 'a:0:{}', 1436621310, 'Відвідувач'),
	(44, 10, 2, 2, 'sthkjjj erohjrrphkekjpemjpoerjmpoer j poej', '', 'a:0:{}', 1436621311, 'Oleksii The Great'),
	(45, 10, 2, 2, 'kiwkdskisj  o', '', 'a:0:{}', 1436621316, 'Oleksii The Great'),
	(46, 11, 1, 0, 'gyjgjlhk;vjl;\'k;\'k;\';l\'', '', 'a:0:{}', 1436621316, 'Відвідувач'),
	(47, 11, 6, 0, 'Оператор Oleksii The Great включився в розмову', '', 'a:0:{}', 1436621319, NULL),
	(48, 11, 1, 0, 'thtekjerhkrhrktr', '', 'a:0:{}', 1436621319, 'Відвідувач'),
	(49, 11, 2, 2, 'Щас', '', 'a:0:{}', 1436621324, 'Oleksii The Great'),
	(50, 10, 2, 2, 'вен8ет7щдьнззэ', '', 'a:0:{}', 1436621333, 'Oleksii The Great'),
	(51, 10, 2, 2, 'Рома', '', 'a:0:{}', 1436621357, 'Oleksii The Great'),
	(52, 11, 2, 2, 'Наташа', '', 'a:0:{}', 1436621361, 'Oleksii The Great'),
	(53, 11, 6, 0, 'Відвідувач Відвідувач залишив діалог', '', 'a:0:{}', 1436621365, NULL),
	(54, 10, 5, 0, 'В оператора виникли проблеми зі зв\'язком, ми тимчасово перевели Вас в пріоритетну чергу.', '', 'a:0:{}', 1436621405, NULL),
	(55, 9, 5, 0, 'В оператора виникли проблеми зі зв\'язком, ми тимчасово перевели Вас в пріоритетну чергу.', '', 'a:0:{}', 1436621407, NULL),
	(56, 10, 6, 0, 'Оператор Oleksii The Great повернувся до діалогу', '', 'a:0:{}', 1436621420, NULL),
	(57, 10, 2, 2, 'лоорлоид', '', 'a:0:{}', 1436621424, 'Oleksii The Great'),
	(58, 12, 3, 0, 'Відвідувач прийшов зі сторінки http://intita.itatests.com/lesson/index/27/?idCourse=1\nhttp://intita.itatests.com/lesson/index/27/?idCourse=1', '', 'a:0:{}', 1436621428, NULL),
	(59, 12, 4, 0, 'Будь-ласка, почекайте, до Вас приєднається оператор..', '', 'a:0:{}', 1436621428, NULL),
	(60, 10, 1, 0, 'всьо пропало', '', 'a:0:{}', 1436621428, 'Відвідувач'),
	(61, 12, 1, 0, '1', '', 'a:0:{}', 1436621443, 'Відвідувач'),
	(62, 10, 2, 2, 'Все на місці ', '', 'a:0:{}', 1436621445, 'Oleksii The Great'),
	(63, 12, 6, 0, 'Відвідувач Відвідувач залишив діалог', '', 'a:0:{}', 1436621457, NULL),
	(64, 9, 6, 0, 'Відвідувач JEEJEJEJEJ залишив діалог', '', 'a:0:{}', 1436621508, NULL),
	(65, 10, 5, 0, 'В оператора виникли проблеми зі зв\'язком, ми тимчасово перевели Вас в пріоритетну чергу.', '', 'a:0:{}', 1436621527, NULL),
	(66, 13, 3, 0, 'Відвідувач прийшов зі сторінки http://intita.itatests.com/lesson/index/101/?idCourse=1\nhttp://intita.itatests.com/module/index/?idModule=3&idCourse=1', '', 'a:0:{}', 1437490863, NULL),
	(67, 13, 3, 0, 'E-Mail: romcom77@gmail.com', '', 'a:0:{}', 1437490863, NULL),
	(68, 13, 1, 0, 'ііііііііііііііііііііііііііііііііііііііііііііііііііііііііііііііііііііііііііііііііііііі', '', 'a:0:{}', 1437490863, 'Ро'),
	(69, 14, 3, 0, 'Відвідувач прийшов зі сторінки http://intita.itatests.com/lesson/index/100/?idCourse=1\nhttp://intita.itatests.com/consultationscalendar/index/?lectureId=100&idCourse=1', '', 'a:0:{}', 1437729971, NULL),
	(70, 14, 3, 0, 'E-Mail: kjlrgtlerghk@gmail.com', '', 'a:0:{}', 1437729971, NULL),
	(71, 14, 1, 0, 'рочрьпьчпчо', '', 'a:0:{}', 1437729971, 'Відвідувач'),
	(72, 15, 3, 0, 'Відвідувач прийшов зі сторінки http://intita.itatests.com/lesson/index/117/?idCourse=1\nhttp://intita.itatests.com/module/index/?idModule=1&idCourse=1', '', 'a:0:{}', 1437736068, NULL),
	(73, 15, 3, 0, 'E-Mail: wizlightdragon@gmail.com', '', 'a:0:{}', 1437736068, NULL),
	(74, 15, 1, 0, 'апрарпа', '', 'a:0:{}', 1437736068, 'Відвідувач'),
	(75, 16, 3, 0, 'Відвідувач прийшов зі сторінки http://intita.itatests.com/lesson/index/101/?idCourse=1\nhttp://intita.itatests.com/lesson/index/100/?idCourse=1', '', 'a:0:{}', 1438197245, NULL),
	(76, 16, 3, 0, 'E-Mail: romcom77@gmail.com', '', 'a:0:{}', 1438197245, NULL),
	(77, 16, 1, 0, 'Qwerty', '', 'a:0:{}', 1438197245, 'Roman'),
	(78, 17, 3, 0, 'Відвідувач прийшов зі сторінки http://intita.itatests.com/lesson/index/117/?idCourse=1\nhttp://intita.itatests.com/lesson/index/117/?idCourse=1', '', 'a:0:{}', 1438284058, NULL),
	(79, 17, 3, 0, 'E-Mail: romcom77@gmail.com', '', 'a:0:{}', 1438284058, NULL),
	(80, 17, 1, 0, 'Рррооол', '', 'a:0:{}', 1438284058, 'Roman'),
	(81, 18, 3, 0, 'Відвідувач прийшов зі сторінки http://intita.itatests.com/lesson/index/140/?idCourse=1\nhttp://intita.itatests.com/module/index/?idModule=2&idCourse=1', '', 'a:0:{}', 1438332923, NULL),
	(82, 18, 3, 0, 'E-Mail: teacher1@gmail.com', '', 'a:0:{}', 1438332923, NULL),
	(83, 18, 1, 0, '1', '', 'a:0:{}', 1438332923, 'teacher');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
