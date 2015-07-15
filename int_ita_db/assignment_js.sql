-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-15 17:37:16
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.assignment_js
DROP TABLE IF EXISTS `assignment_js`;
CREATE TABLE IF NOT EXISTS `assignment_js` (
  `ID` int(11) NOT NULL DEFAULT '0',
  `name` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `header` varchar(512) CHARACTER SET latin1 DEFAULT NULL,
  `etalon` varchar(512) CHARACTER SET latin1 DEFAULT NULL,
  `footer` varchar(512) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

-- Dumping data for table int_ita_db.assignment_js: ~5 rows (approximately)
/*!40000 ALTER TABLE `assignment_js` DISABLE KEYS */;
INSERT INTO `assignment_js` (`ID`, `name`, `header`, `etalon`, `footer`) VALUES
	(0, 'hello wordl', 'class Main#NUM#\r\n{\r\npublic static void main(String args[])\r\n{', 'System.out.println("Hello World!");', '}\r\n}'),
	(7, 'javaDefault', 'class Main#NUM# \r\n{ \r\n    public static void main (String[] args)  \r\n   {  ', ' System.out.println ("Hello, world.");', '}}'),
	(2, 'k', NULL, NULL, NULL),
	(0, '127.0.0.1', ' console.log("hh");', '2015-7-1 16:16:13', NULL),
	(0, '127.0.0.1', ' console.log("hi");', '2015-7-1 17:26:26', NULL);
/*!40000 ALTER TABLE `assignment_js` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
