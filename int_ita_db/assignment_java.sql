-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-13 17:03:50
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.assignment_java
DROP TABLE IF EXISTS `assignment_java`;
CREATE TABLE IF NOT EXISTS `assignment_java` (
  `ID` int(11) NOT NULL DEFAULT '0',
  `name` varchar(20) DEFAULT NULL,
  `header` varchar(512) DEFAULT NULL,
  `etalon` varchar(512) DEFAULT NULL,
  `footer` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table int_ita_db.assignment_java: ~2 rows (approximately)
/*!40000 ALTER TABLE `assignment_java` DISABLE KEYS */;
INSERT INTO `assignment_java` (`ID`, `name`, `header`, `etalon`, `footer`) VALUES
	(0, 'hello wordl', 'class Main#NUM#\r\n{\r\npublic static void main(String args[])\r\n{', 'System.out.println("Hello World!");', '}\r\n}'),
	(7, 'javaDefault', 'class Main#NUM# \r\n{ \r\n    public static void main (String[] args)  \r\n   {  ', ' System.out.println ("Hello, world.");', '}}');
/*!40000 ALTER TABLE `assignment_java` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
