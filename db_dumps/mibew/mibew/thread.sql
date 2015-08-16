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

-- Dumping structure for table mibew.thread
DROP TABLE IF EXISTS `thread`;
CREATE TABLE IF NOT EXISTS `thread` (
  `threadid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `userid` varchar(255) DEFAULT NULL,
  `agentname` varchar(64) DEFAULT NULL,
  `agentid` int(11) NOT NULL DEFAULT '0',
  `dtmcreated` int(11) NOT NULL DEFAULT '0',
  `dtmchatstarted` int(11) NOT NULL DEFAULT '0',
  `dtmmodified` int(11) NOT NULL DEFAULT '0',
  `dtmclosed` int(11) NOT NULL DEFAULT '0',
  `lrevision` int(11) NOT NULL DEFAULT '0',
  `istate` int(11) NOT NULL DEFAULT '0',
  `invitationstate` int(11) NOT NULL DEFAULT '0',
  `ltoken` int(11) NOT NULL,
  `remote` varchar(255) DEFAULT NULL,
  `referer` text,
  `nextagent` int(11) NOT NULL DEFAULT '0',
  `locale` varchar(8) DEFAULT NULL,
  `lastpinguser` int(11) NOT NULL DEFAULT '0',
  `lastpingagent` int(11) NOT NULL DEFAULT '0',
  `usertyping` int(11) DEFAULT '0',
  `agenttyping` int(11) DEFAULT '0',
  `shownmessageid` int(11) NOT NULL DEFAULT '0',
  `useragent` varchar(255) DEFAULT NULL,
  `messagecount` varchar(16) DEFAULT NULL,
  `groupid` int(11) DEFAULT NULL,
  PRIMARY KEY (`threadid`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Dumping data for table mibew.thread: ~18 rows (approximately)
/*!40000 ALTER TABLE `thread` DISABLE KEYS */;
INSERT INTO `thread` (`threadid`, `username`, `userid`, `agentname`, `agentid`, `dtmcreated`, `dtmchatstarted`, `dtmmodified`, `dtmclosed`, `lrevision`, `istate`, `invitationstate`, `ltoken`, `remote`, `referer`, `nextagent`, `locale`, `lastpinguser`, `lastpingagent`, `usertyping`, `agenttyping`, `shownmessageid`, `useragent`, `messagecount`, `groupid`) VALUES
	(1, 'Guest', '552662a73468a2.63706330', NULL, 0, 1428579355, 0, 1428579355, 1428579355, 11, 5, 0, 10290837, '81.30.164.98', 'http://localhost/IntITA/lesson', 0, 'en', 0, 0, 0, 0, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36', '0', 0),
	(2, 'Guest', '55296684cec385.89301628', NULL, 0, 1428776630, 0, 1428776630, 1428776630, 29, 5, 0, 4960927, '195.5.15.88', 'http://intita.itatests.com/lesson\nhttp://intita.itatests.com/module', 0, 'en', 0, 0, 0, 0, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36', '0', 0),
	(3, 'Guest', '552662a73468a2.63706330', NULL, 0, 1429116539, 0, 1429116539, 1429116539, 36, 5, 0, 8626565, '81.30.164.98', 'http://intita.itatests.com/lesson#\nhttp://intita.itatests.com/module', 0, 'en', 0, 0, 0, 0, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36', '0', 0),
	(4, 'Guest', '5544dce63bed44.85570133', NULL, 0, 1430576375, 0, 1430576375, 1430576375, 1543, 5, 0, 1103245, '81.30.164.98', 'http://intita.itatests.com/lesson\nhttp://intita.itatests.com/module/', 0, 'en', 0, 0, 0, 0, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36', '0', 0),
	(5, 'Guest', '5544dce63bed44.85570133', 'Administrator', 1, 1430576710, 1430576720, 1434119106, 1434119106, 1699, 3, 0, 889720, '81.30.164.98', 'http://intita.itatests.com/lesson\nhttp://intita.itatests.com/module/', 0, 'en', 0, 1430577891, 0, 0, 17, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36', '0', 0),
	(6, 'Відвідувач', '5582d5cb0d71d7.90225917', NULL, 0, 1434637791, 0, 1434637791, 1434637791, 1702, 5, 0, 6028184, '94.179.14.26', 'http://intita.itatests.com/lesson/index/5/\nhttp://intita.itatests.com/lesson/index/5/', 0, 'ua', 0, 0, 0, 0, 0, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', '0', 0),
	(7, 'Відвідувач', '559b910eb57bc4.02074436', NULL, 0, 1436258639, 0, 1436258639, 1436258639, 1703, 5, 0, 8081158, '94.179.60.193', 'http://intita.itatests.com/lesson/index/1/?idCourse=1\nhttp://intita.itatests.com/module/index/?idModule=1&idCourse=1', 0, 'ua', 0, 0, 0, 0, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', '0', 0),
	(8, 'рррр', '559ffb33b82ba2.29718851', NULL, 0, 1436547923, 0, 1436547923, 1436547923, 1704, 5, 0, 3524352, '178.95.152.124', 'http://intita.itatests.com/lesson/index/80/?idCourse=1\nhttp://intita.itatests.com/module/index/?idModule=1&idCourse=1', 0, 'ua', 0, 0, 0, 0, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', '0', 0),
	(9, 'JEEJEJEJEJ', '55a11930cc23b8.78339539', 'Oleksii The Great', 2, 1436621254, 1436621264, 1436621508, 1436621508, 1824, 3, 0, 1400072, '81.30.164.98', 'http://intita.itatests.com/lesson/index/1/?idCourse=3\nhttp://intita.itatests.com/lesson/index/2/?idCourse=3', 0, 'ua', 1436621508, 0, 0, 0, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2438.3 Safari/537.36', '0', 0),
	(10, 'Відвідувач', '553891c9f1f682.96390592', 'Oleksii The Great', 2, 1436621298, 1436621306, 1437734947, 1437734947, 1845, 3, 0, 9729607, '81.30.164.98', 'http://intita.itatests.com/lesson/index/1/?idCourse=1\nhttp://intita.itatests.com/module/index/?idModule=1&idCourse=1', 0, 'ua', 1436623902, 0, 0, 0, 41, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.132 Safari/537.36', '0', 0),
	(11, 'Відвідувач', '5544dce63bed44.85570133', 'Oleksii The Great', 2, 1436621299, 1436621319, 1436621365, 1436621365, 1775, 3, 0, 12766813, '81.30.164.98', 'http://intita.itatests.com/lesson/index/27/?idCourse=1\nhttp://intita.itatests.com/lesson/index/27/?idCourse=1', 0, 'ua', 1436621365, 1436621372, 0, 0, 43, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.132 Safari/537.36', '3', 0),
	(12, 'Відвідувач', '5544dce63bed44.85570133', NULL, 0, 1436621428, 0, 1436621457, 1436621457, 1821, 3, 0, 13868146, '81.30.164.98', 'http://intita.itatests.com/lesson/index/27/?idCourse=1\nhttp://intita.itatests.com/lesson/index/27/?idCourse=1', 0, 'ua', 1436621457, 0, 0, 0, 61, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.132 Safari/537.36', '1', 0),
	(13, 'Ро', '553891c9f1f682.96390592', NULL, 0, 1437490863, 0, 1437490863, 1437490863, 1842, 5, 0, 2626046, '81.30.164.98', 'http://intita.itatests.com/lesson/index/101/?idCourse=1\nhttp://intita.itatests.com/module/index/?idModule=3&idCourse=1', 0, 'ua', 0, 0, 0, 0, 0, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.134 Safari/537.36', '0', 0),
	(14, 'Відвідувач', '55b20498bfc307.12312430', NULL, 0, 1437729971, 0, 1437729971, 1437729971, 1843, 5, 0, 14522548, '94.179.32.251', 'http://intita.itatests.com/lesson/index/100/?idCourse=1\nhttp://intita.itatests.com/consultationscalendar/index/?lectureId=100&idCourse=1', 0, 'ua', 0, 0, 0, 0, 0, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.134 Safari/537.36', '0', 0),
	(15, 'Відвідувач', '554b526aebc623.40279945', NULL, 0, 1437736068, 0, 1437736068, 1437736068, 1856, 5, 0, 2693956, '81.30.164.98', 'http://intita.itatests.com/lesson/index/117/?idCourse=1\nhttp://intita.itatests.com/module/index/?idModule=1&idCourse=1', 0, 'ua', 0, 0, 0, 0, 0, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.134 Safari/537.36', '0', 0),
	(16, 'Roman', '555e107d07bf33.22820440', NULL, 0, 1438197245, 0, 1438197245, 1438197245, 1866, 5, 0, 7708594, '178.94.166.76', 'http://intita.itatests.com/lesson/index/101/?idCourse=1\nhttp://intita.itatests.com/lesson/index/100/?idCourse=1', 0, 'ua', 0, 0, 0, 0, 0, 'Mozilla/5.0 (Linux; Android 5.0; K012 Build/LRX21V) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.109 Safari/537.36', '0', 0),
	(17, 'Roman', '555e107d07bf33.22820440', NULL, 0, 1438284058, 0, 1438284058, 1438284058, 1867, 5, 0, 15070104, '178.94.166.76', 'http://intita.itatests.com/lesson/index/117/?idCourse=1\nhttp://intita.itatests.com/lesson/index/117/?idCourse=1', 0, 'ua', 0, 0, 0, 0, 0, 'Mozilla/5.0 (Linux; Android 5.0; K012 Build/LRX21V) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.109 Safari/537.36', '0', 0),
	(18, 'teacher', '552d03c7ed2411.70410705', NULL, 0, 1438332922, 0, 1438332923, 1438332922, 1868, 5, 0, 4299995, '80.91.174.90', 'http://intita.itatests.com/lesson/index/140/?idCourse=1\nhttp://intita.itatests.com/module/index/?idModule=2&idCourse=1', 0, 'ua', 0, 0, 0, 0, 0, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', '0', 0);
/*!40000 ALTER TABLE `thread` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
