-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-30 14:46:10
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.results
DROP TABLE IF EXISTS `results`;
CREATE TABLE IF NOT EXISTS `results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session` varchar(255) NOT NULL,
  `jobid` int(11) NOT NULL,
  `status` text NOT NULL,
  `date` date NOT NULL,
  `result` text NOT NULL,
  `warning` text NOT NULL,
  PRIMARY KEY (`id`,`session`(100)),
  UNIQUE KEY `SECONDY` (`session`,`jobid`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=latin1;

-- Dumping data for table int_ita_db.results: ~7 rows (approximately)
/*!40000 ALTER TABLE `results` DISABLE KEYS */;
INSERT INTO `results` (`id`, `session`, `jobid`, `status`, `date`, `result`, `warning`) VALUES
	(134, '1241q223f4f2341', 11212, 'done', '2015-07-17', '64\n??????2343VM: 11892; RSS: 980\n', ''),
	(135, '1241q223f4f2341', 38, 'done', '2015-07-17', '64\n??????2343VM: 11892; RSS: 984\n', ''),
	(136, '1241q223f4f2341', 51, 'done', '2015-07-17', 'Hello World!\nVM: 11888; RSS: 980\n', ''),
	(137, '1241q223f4f2341', 12212, 'done', '2015-07-17', '\nVM: 11888; RSS: 984\n', ''),
	(138, '1241q223f4f2341', 56, 'failed', '2015-07-22', '', ''),
	(139, '1241q223f4f2341', 121, 'failed', '2015-07-23', '', ''),
	(140, '1241q223f4f2341', 122125, 'done', '2015-07-24', '\nVM: 11888; RSS: 980\n', '');
/*!40000 ALTER TABLE `results` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
