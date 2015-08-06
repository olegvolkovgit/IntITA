-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-06 16:18:09
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

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
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
