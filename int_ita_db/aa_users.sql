-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-04-22 15:37:34
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.aa_users
DROP TABLE IF EXISTS `aa_users`;
CREATE TABLE IF NOT EXISTS `aa_users` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `level` enum('root','admin','user') NOT NULL DEFAULT 'user',
  `login` varchar(21) NOT NULL,
  `password` varchar(32) NOT NULL,
  `interface_level` tinyint(4) NOT NULL DEFAULT '1',
  `email` varchar(40) NOT NULL,
  `surname` varchar(21) NOT NULL,
  `firstname` varchar(21) NOT NULL,
  `middlename` varchar(21) DEFAULT NULL,
  `regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info` tinytext,
  `salt` varchar(8) DEFAULT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table int_ita_db.aa_users: ~2 rows (approximately)
/*!40000 ALTER TABLE `aa_users` DISABLE KEYS */;
INSERT INTO `aa_users` (`id`, `level`, `login`, `password`, `interface_level`, `email`, `surname`, `firstname`, `middlename`, `regdate`, `info`, `salt`, `disabled`) VALUES
	(2, 'root', 'root', '63a9f0ea7bb98050796b649e85481845', 1, 'root', 'root', 'root', 'root', '2015-03-02 15:33:13', NULL, NULL, 0),
	(3, 'user', 'User', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 'user', 'Surname', 'Name', 'Middle name', '2015-03-02 15:43:00', NULL, NULL, 0);
/*!40000 ALTER TABLE `aa_users` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
