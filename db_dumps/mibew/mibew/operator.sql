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

-- Dumping structure for table mibew.operator
DROP TABLE IF EXISTS `operator`;
CREATE TABLE IF NOT EXISTS `operator` (
  `operatorid` int(11) NOT NULL AUTO_INCREMENT,
  `vclogin` varchar(64) NOT NULL,
  `vcpassword` varchar(64) NOT NULL,
  `vclocalename` varchar(64) NOT NULL,
  `vccommonname` varchar(64) NOT NULL,
  `vcemail` varchar(64) DEFAULT NULL,
  `dtmlastvisited` int(11) NOT NULL DEFAULT '0',
  `istatus` int(11) DEFAULT '0',
  `idisabled` int(11) DEFAULT '0',
  `vcavatar` varchar(255) DEFAULT NULL,
  `iperm` int(11) DEFAULT '0',
  `dtmrestore` int(11) NOT NULL DEFAULT '0',
  `vcrestoretoken` varchar(64) DEFAULT NULL,
  `code` varchar(64) DEFAULT '',
  PRIMARY KEY (`operatorid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table mibew.operator: ~2 rows (approximately)
/*!40000 ALTER TABLE `operator` DISABLE KEYS */;
INSERT INTO `operator` (`operatorid`, `vclogin`, `vcpassword`, `vclocalename`, `vccommonname`, `vcemail`, `dtmlastvisited`, `istatus`, `idisabled`, `vcavatar`, `iperm`, `dtmrestore`, `vcrestoretoken`, `code`) VALUES
	(1, 'admin', '$2y$08$6GAj8LdLdOR1WIcCGc.TkufenfctYZ1Q9g05U.ofYOpwNL5eI.HwW', 'Administrator', 'Administrator', '', 1437742396, 0, 0, '', 65535, 0, NULL, ''),
	(2, 'oleksii', '$2y$08$ABIvbK1bxpJdZMzAhZ1P2u8JOn.pdNG8PmsnbfEI1FIwFqDW19Aym', 'Oleksii ', 'Oleksii The Great', 'alterego4@gmail.com', 1436621461, 0, 0, '', 15, 0, NULL, '36');
/*!40000 ALTER TABLE `operator` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
