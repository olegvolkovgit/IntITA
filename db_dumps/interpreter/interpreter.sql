-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-06 16:19:18
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for interpreter
CREATE DATABASE IF NOT EXISTS `interpreter` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `interpreter`;


-- Dumping structure for table interpreter.assignment_cpp
DROP TABLE IF EXISTS `assignment_cpp`;
CREATE TABLE IF NOT EXISTS `assignment_cpp` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `header` varchar(512) DEFAULT NULL,
  `etalon` varchar(512) DEFAULT NULL,
  `footer` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

-- Dumping data for table interpreter.assignment_cpp: ~39 rows (approximately)
/*!40000 ALTER TABLE `assignment_cpp` DISABLE KEYS */;
INSERT INTO `assignment_cpp` (`ID`, `name`, `header`, `etalon`, `footer`) VALUES
	(1, 'hello world', '#include <iostream> \r\n int main()\r\n {', 'std::cout << "Hello World!" << std::endl;', 'return 0;}'),
	(2, 'pcount(): reports th', '#include <strstream>\r\n#include <iostream>\r\nusing namespace std;\r\nint main()\r\n{', ' char str[80];ostrstream outs(str, sizeof(str));\r\n  outs << "abcdefg ";\r\n  outs << 27 << " "  << 890.23;\r\n  outs << ends;  // null terminate\r\n  cout << "chars in outs: "<< outs.pcount(); // \r\n  cout << " " << str;', ' return 0;}'),
	(3, 'cout: output hex', '#include <iostream>\r\n#include <iomanip>\r\nusing namespace std;\r\nint main() {', ' cout << hex << 100 << endl;  cout << setfill(\'?\') << setw(10) << 2343.0;', 'return 0;}'),
	(4, 'Set cout: hex and ba', '#include <iostream>\r\n#include <iomanip>\r\nusing namespace std;\r\nint main() {', 'cout.setf(ios::hex, ios::basefield);\r\n  cout << 100 << endl;                  // cout 100 in hex\r\n  cout.fill(\'?\');\r\n  cout.width(10);\r\n  cout << 2343.0;', 'return 0;}'),
	(5, 'cout: uppercase,show', '#include <iostream>\r\nusing namespace std;\r\nint main() {', 'cout.unsetf(ios::dec);\r\n  cout.setf(ios::uppercase | ios::showbase | ios::hex);\r\n  cout << 88 << \'\n\';\r\n  cout.unsetf(ios::uppercase);\r\n  cout << 88 << \'\n\';', 'return 0;}'),
	(6, 'Defines your own ter', '#include <iostream>\r\n#include <cstdlib>\r\n#include <exception>\r\nusing namespace std;\r\nvoid myTerminator() {\r\n  cout << "Your own terminate handler\n";\r\n  abort();\r\n}\r\nint main() {', 'set_terminate(myTerminator);   \r\n  try {\r\n    cout << "Inside try block.";\r\n    throw 100; \r\n  }\r\n  catch (double i) { }', 'return 0;}'),
	(7, 'javaDefault', 'class Main#NUM# \r\n{ \r\n    public static void main (String[] args)  \r\n   {  ', ' System.out.println ("Hello, world.");', '}}'),
	(9, 'name', 'header', 'etalon', 'footer'),
	(10, 'jjghgf', '', '', ''),
	(11, '', '', '', ''),
	(12, '', '', '', ''),
	(13, '?????', '', '', ''),
	(14, 'vbdkjfv', 'nfekfn', 'nfeqkfn', 'fnkqeq'),
	(15, '', 'qerw', 'qerwqrrqw', 'qwerwer'),
	(16, 'fksnj', 'nlkfvane', 'nwlfkn', 'nfkelfws'),
	(17, 'bkjsdvs', 'bvwsvbw', 'bvkjwr', 'nfqeio'),
	(18, 'title', 'header', 'etalon', 'footer'),
	(19, '?? ?', '????', '???', '???'),
	(20, '????', '?????', '1', '????'),
	(21, 'hdgg', 'fghghghg', '2', 'er'),
	(22, 'dfkjvdn', 'dkhjdbek', 'bdkjb', 'bwdk'),
	(23, 'ghgh', 'gfgfgfg', 'dfgdfgdfgfg', 'fgfgfgf'),
	(24, 'dgdg', 'zdg564hg4h6gh46gh', 'gh4g\nhg4h6\nghhgf', 'd5h4dg5hgh\n'),
	(25, 'nvdif', 'nfieqn', 'nfiseofnd', 'nfeiwn'),
	(26, '', '', '?????', ''),
	(27, '', '', '1) 42 - 27 = 15 (?? ?????? ? ??????? ?????)\n2) 15 - 4 = 11 (?? ?? ?????? ?????)\n3) 27 - 11 = 16 (?? ? ????? ?????)\n?????????: 27 - (42 - 27 - 4) = 16', ''),
	(28, '', '', '1) 42 - 27 = 15 (?? ?????? ? ??????? ?????)\n2) 15 - 4 = 11 (?? ?? ?????? ?????)\n3) 27 - 11 = 16 (?? ? ????? ?????)\n?????????: 27 - (42 - 27 - 4) = 16', ''),
	(29, '', '', '1) 16 + 9 = 25 (????? ?????? ?????? ????)\n2) 7 - 4 = 3 (??????????? ????? ?????? ????)\n3) 7 + 3 = 10 (????? ?????? ?????? ????)\n4) 25 + 10 = 35 (?????? ??????? ??????)\n5) 25 - 10 = 15 (?????? ?????? ????)\n?????: 35 ?????? ???? ? ???? ??????? ??????, ???? ?????? ?? 15 ?????? ?????? ??? ????.', ''),
	(30, '555555555555555', '', '12', ''),
	(31, '', '', '23', ''),
	(32, '', 'vhjvhmvh', 'vhmvhmh', 'bhkmbnkmb'),
	(33, 'vhh', 'vhmhvm', 'hmvm', 'hmkh v'),
	(34, '', '', '', ''),
	(35, '', '', '?', ''),
	(36, '', '', '', ''),
	(37, '???????', '', '', ''),
	(38, '???', '????', '????', '????'),
	(39, '', '', '', ''),
	(40, 'h5jiu57', 'hney', 'rynj', 'yhe6u');
/*!40000 ALTER TABLE `assignment_cpp` ENABLE KEYS */;


-- Dumping structure for table interpreter.assignment_java
DROP TABLE IF EXISTS `assignment_java`;
CREATE TABLE IF NOT EXISTS `assignment_java` (
  `ID` int(11) NOT NULL DEFAULT '0',
  `name` varchar(20) DEFAULT NULL,
  `header` varchar(512) DEFAULT NULL,
  `etalon` varchar(512) DEFAULT NULL,
  `footer` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table interpreter.assignment_java: ~2 rows (approximately)
/*!40000 ALTER TABLE `assignment_java` DISABLE KEYS */;
INSERT INTO `assignment_java` (`ID`, `name`, `header`, `etalon`, `footer`) VALUES
	(0, 'hello wordl', 'class Main#NUM#\r\n{\r\npublic static void main(String args[])\r\n{', 'System.out.println("Hello World!");', '}\r\n}'),
	(7, 'javaDefault', 'class Main#NUM# \r\n{ \r\n    public static void main (String[] args)  \r\n   {  ', ' System.out.println ("Hello, world.");', '}}');
/*!40000 ALTER TABLE `assignment_java` ENABLE KEYS */;


-- Dumping structure for table interpreter.assignment_js
DROP TABLE IF EXISTS `assignment_js`;
CREATE TABLE IF NOT EXISTS `assignment_js` (
  `ID` int(11) NOT NULL DEFAULT '0',
  `name` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `header` varchar(512) CHARACTER SET latin1 DEFAULT NULL,
  `etalon` varchar(512) CHARACTER SET latin1 DEFAULT NULL,
  `footer` varchar(512) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

-- Dumping data for table interpreter.assignment_js: ~2 rows (approximately)
/*!40000 ALTER TABLE `assignment_js` DISABLE KEYS */;
INSERT INTO `assignment_js` (`ID`, `name`, `header`, `etalon`, `footer`) VALUES
	(0, 'hello wordl', 'class Main#NUM#\r\n{\r\npublic static void main(String args[])\r\n{', 'System.out.println("Hello World!");', '}\r\n}'),
	(7, 'javaDefault', 'class Main#NUM# \r\n{ \r\n    public static void main (String[] args)  \r\n   {  ', ' System.out.println ("Hello, world.");', '}}');
/*!40000 ALTER TABLE `assignment_js` ENABLE KEYS */;


-- Dumping structure for table interpreter.history
DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) DEFAULT NULL,
  `code` varchar(512) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;

-- Dumping data for table interpreter.history: ~94 rows (approximately)
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` (`ID`, `ip`, `code`, `date_time`) VALUES
	(33, '81.30.164.98', ' cout << hex << 100 << endl;  cout << setfill(\'?\') << setw(10) << 2343.0;', '2015-07-17 12:59:19'),
	(34, '81.30.164.98', ' cout << hex << 100 << endl;  cout << setfill(\'?\') << setw(10) << 2343.0;', '2015-07-17 13:01:03'),
	(35, '81.30.164.98', ' cout << hex << 100 << endl;  cout << setfill(\'?\') << setw(10) << 2343.0;', '2015-07-17 13:01:45'),
	(36, '81.30.164.98', ' cout << hex << 100 << endl;  cout << setfill(\'?\') << setw(10) << 2343.0;', '2015-07-17 13:03:12'),
	(37, '81.30.164.98', ' cout << hex << 100 << endl;  cout << setfill(\'?\') << setw(10) << 2343.0;', '2015-07-17 13:05:59'),
	(38, '81.30.164.98', 'std::cout << "Hello World!" << std::endl;', '2015-07-17 13:45:14'),
	(39, '81.30.164.98', 'std::cout << "Hello World!" << std::endl;', '2015-07-17 13:45:30'),
	(40, '81.30.164.98', 'std::cout << "Hello World!" << std::endl;', '2015-07-17 13:45:43'),
	(41, '81.30.164.98', 'std::cout << "Hello World!" << std::endl;', '2015-07-17 13:49:44'),
	(42, '81.30.164.98', ' char str[80];ostrstream outs(str, sizeof(str));\n  outs << "abcdefg ";\n  outs << 27 << " "  << 890.23;\n  outs << ends;  // null terminate\n  cout << "chars in outs: "<< outs.pcount(); // \n  cout << " " << str;', '2015-07-17 13:53:25'),
	(43, '81.30.164.98', '<p><span class="highLT">&lt;</span><span class="highELE">a</span> <span class="highATT">href=</span><span class="highVAL">"http://www.w3schools.com/"</span> <span class="highATT">target=</span><span class="highVAL">"_blank"</span><span class="highGT">&gt;</span>Visit W3Schools!<span class="highLT">&lt;</span><span class="highELE">/a</span><span class="highGT">&gt;</span></p><p><span class="highLT">&lt;<span class="highELE">a</span> <span class="highATT">href=</span><span class="highVAL">"http://www.w3school', '2015-07-17 14:16:52'),
	(44, '81.30.164.98', 'std::cout << "Hello World!" << std::endl;', '2015-07-17 14:17:29'),
	(45, '81.30.164.98', 'std::cout << << std::endl;', '2015-07-17 14:17:42'),
	(46, '81.30.164.98', 'std::cout << "Hello World!" << std::endl;', '2015-07-17 14:19:48'),
	(47, '81.30.164.98', 'std::cout << "He', '2015-07-17 14:20:04'),
	(48, '81.30.164.98', 'std::cout <<', '2015-07-17 14:21:19'),
	(49, '81.30.164.98', 'std::cout << std::endl;', '2015-07-17 14:21:59'),
	(50, '81.30.164.98', 'nd fknbdl', '2015-07-17 14:29:44'),
	(51, '81.30.164.98', 'nsdvnsj', '2015-07-17 14:30:14'),
	(52, '81.30.164.98', 'bmdgbdmdg', '2015-07-17 14:30:41'),
	(53, '81.30.164.98', 'thnf', '2015-07-17 14:31:45'),
	(54, '81.30.164.98', 'grhgrehe', '2015-07-17 14:32:47'),
	(55, '81.30.164.98', 'fymjkgtuk', '2015-07-17 14:33:54'),
	(56, '81.30.164.98', 'hryjxstjkt', '2015-07-17 14:34:47'),
	(57, '81.30.164.98', 'bhinolk', '2015-07-17 14:35:51'),
	(58, '81.30.164.98', 'bhinolk', '2015-07-17 14:35:51'),
	(59, '81.30.164.98', '', '2015-07-17 14:55:19'),
	(60, '81.30.164.98', '', '2015-07-17 14:55:24'),
	(61, '81.30.164.98', 'nvlskvnmsl', '2015-07-17 15:12:10'),
	(62, '81.30.164.98', 'nvsldvnls', '2015-07-17 15:13:31'),
	(63, '81.30.164.98', 't4wy4', '2015-07-21 13:31:58'),
	(64, '81.30.164.98', 'werwer', '2015-07-21 13:39:51'),
	(65, '81.30.164.98', 'dfdgdf', '2015-07-21 13:39:56'),
	(66, '81.30.164.98', 'dfdgdf', '2015-07-21 13:39:56'),
	(67, '81.30.164.98', 'ergerg', '2015-07-21 13:41:21'),
	(68, '81.30.164.98', 'ergerg', '2015-07-21 13:41:52'),
	(69, '81.30.164.98', '', '2015-07-21 13:42:47'),
	(70, '81.30.164.98', '', '2015-07-21 13:44:09'),
	(71, '81.30.164.98', 'std::cout << << std::endl;', '2015-07-21 13:45:30'),
	(72, '81.30.164.98', '', '2015-07-21 13:45:56'),
	(73, '81.30.164.98', '', '2015-07-21 13:57:10'),
	(74, '81.30.164.98', '35t53', '2015-07-21 14:03:14'),
	(75, '81.30.164.98', '35t53', '2015-07-21 14:03:16'),
	(76, '81.30.164.98', '35t53', '2015-07-21 14:03:18'),
	(77, '81.30.164.98', '35t53', '2015-07-21 14:03:18'),
	(78, '81.30.164.98', '35t53', '2015-07-21 14:03:18'),
	(79, '81.30.164.98', '35t53', '2015-07-21 14:03:22'),
	(80, '81.30.164.98', 'wqeqw', '2015-07-21 14:04:57'),
	(81, '81.30.164.98', '', '2015-07-21 14:06:22'),
	(82, '81.30.164.98', '', '2015-07-21 14:06:49'),
	(83, '81.30.164.98', '', '2015-07-21 14:07:34'),
	(84, '81.30.164.98', '', '2015-07-21 14:07:48'),
	(85, '81.30.164.98', '', '2015-07-21 14:24:13'),
	(86, '81.30.164.98', '', '2015-07-21 14:25:13'),
	(87, '81.30.164.98', '', '2015-07-21 14:25:30'),
	(88, '81.30.164.98', 'fgh', '2015-07-21 14:39:23'),
	(89, '81.30.164.98', 'fgh', '2015-07-21 14:39:23'),
	(90, '81.30.164.98', 'dsc', '2015-07-21 14:40:19'),
	(91, '81.30.164.98', 'dsc', '2015-07-21 14:44:38'),
	(92, '81.30.164.98', 'dsc', '2015-07-21 14:45:21'),
	(93, '81.30.164.98', '', '2015-07-21 14:51:47'),
	(94, '81.30.164.98', 'dfdfb', '2015-07-21 14:54:10'),
	(95, '81.30.164.98', 'xcvxcvxv', '2015-07-21 14:54:40'),
	(96, '81.30.164.98', 'sdc', '2015-07-21 14:56:49'),
	(97, '81.30.164.98', 'sdc', '2015-07-21 14:56:49'),
	(98, '81.30.164.98', 'nbkjrnbsrk', '2015-07-21 16:07:43'),
	(99, '81.30.164.98', 'hjdrtnjted', '2015-07-21 16:09:12'),
	(100, '81.30.164.98', 'hhilvu', '2015-07-21 16:09:52'),
	(101, '81.30.164.98', 'yhrynjmrmj', '2015-07-21 16:11:04'),
	(102, '81.30.164.98', '', '2015-07-21 16:12:02'),
	(103, '81.30.164.98', '7i85', '2015-07-21 16:12:27'),
	(104, '81.30.164.98', 'std::cout <<  << std::endl;', '2015-07-21 16:13:32'),
	(105, '81.30.164.98', 'vfswgb', '2015-07-22 17:17:00'),
	(106, '81.30.164.98', 'etalon', '2015-07-22 17:17:08'),
	(107, '81.30.164.98', 'std::cout << "Hello World!" << std::endl;', '2015-07-22 17:17:29'),
	(108, '81.30.164.98', 'etalon', '2015-07-22 17:18:50'),
	(109, '81.30.164.98', 'std::cout << "Hello World!" << std::endl;', '2015-07-22 17:20:06'),
	(110, '81.30.164.98', 'std::cout << "Hello World!" << std::endl;', '2015-07-22 17:20:22'),
	(111, '81.30.164.98', 'std::cout << "Hello World!" << std::endl;', '2015-07-22 17:20:54'),
	(112, '94.179.32.251', '1', '2015-07-23 15:59:48'),
	(113, '94.179.32.251', '2', '2015-07-23 16:42:13'),
	(114, '81.30.164.98', 'dwqdwqdwq', '2015-07-23 16:43:50'),
	(115, '81.30.164.98', 'bjbjhnkjn', '2015-07-23 16:47:28'),
	(116, '94.179.32.251', '12', '2015-07-24 08:56:26'),
	(117, '94.179.32.251', '12', '2015-07-24 08:59:54'),
	(118, '94.179.32.251', '23', '2015-07-24 09:08:36'),
	(119, '94.179.32.251', '', '2015-07-24 09:08:43'),
	(120, '94.179.32.251', '23', '2015-07-24 09:08:52'),
	(121, '94.179.32.251', '?', '2015-07-24 09:09:39'),
	(122, '81.30.164.98', 'uyjruj', '2015-07-24 11:33:05'),
	(123, '81.30.164.98', 'y64yh467u7', '2015-07-24 11:33:40'),
	(124, '94.179.62.179', '12', '2015-07-24 13:10:29'),
	(125, '81.30.164.98', 'std::cout << std::endl;', '2015-07-24 13:32:11'),
	(126, '81.30.164.98', 'std::cout << std::endl;', '2015-07-24 13:32:22');
/*!40000 ALTER TABLE `history` ENABLE KEYS */;


-- Dumping structure for table interpreter.results
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

-- Dumping data for table interpreter.results: ~0 rows (approximately)
/*!40000 ALTER TABLE `results` DISABLE KEYS */;
/*!40000 ALTER TABLE `results` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
