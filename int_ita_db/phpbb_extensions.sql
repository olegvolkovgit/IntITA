-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-07-04 11:06:42
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.phpbb_extensions
DROP TABLE IF EXISTS `phpbb_extensions`;
CREATE TABLE IF NOT EXISTS `phpbb_extensions` (
  `extension_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `extension` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`extension_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table int_ita_db.phpbb_extensions: ~66 rows (approximately)
/*!40000 ALTER TABLE `phpbb_extensions` DISABLE KEYS */;
INSERT INTO `phpbb_extensions` (`extension_id`, `group_id`, `extension`) VALUES
	(1, 1, 'gif'),
	(2, 1, 'png'),
	(3, 1, 'jpeg'),
	(4, 1, 'jpg'),
	(5, 1, 'tif'),
	(6, 1, 'tiff'),
	(7, 1, 'tga'),
	(8, 2, 'gtar'),
	(9, 2, 'gz'),
	(10, 2, 'tar'),
	(11, 2, 'zip'),
	(12, 2, 'rar'),
	(13, 2, 'ace'),
	(14, 2, 'torrent'),
	(15, 2, 'tgz'),
	(16, 2, 'bz2'),
	(17, 2, '7z'),
	(18, 3, 'txt'),
	(19, 3, 'c'),
	(20, 3, 'h'),
	(21, 3, 'cpp'),
	(22, 3, 'hpp'),
	(23, 3, 'diz'),
	(24, 3, 'csv'),
	(25, 3, 'ini'),
	(26, 3, 'log'),
	(27, 3, 'js'),
	(28, 3, 'xml'),
	(29, 4, 'xls'),
	(30, 4, 'xlsx'),
	(31, 4, 'xlsm'),
	(32, 4, 'xlsb'),
	(33, 4, 'doc'),
	(34, 4, 'docx'),
	(35, 4, 'docm'),
	(36, 4, 'dot'),
	(37, 4, 'dotx'),
	(38, 4, 'dotm'),
	(39, 4, 'pdf'),
	(40, 4, 'ai'),
	(41, 4, 'ps'),
	(42, 4, 'ppt'),
	(43, 4, 'pptx'),
	(44, 4, 'pptm'),
	(45, 4, 'odg'),
	(46, 4, 'odp'),
	(47, 4, 'ods'),
	(48, 4, 'odt'),
	(49, 4, 'rtf'),
	(50, 5, 'rm'),
	(51, 5, 'ram'),
	(52, 6, 'wma'),
	(53, 6, 'wmv'),
	(54, 7, 'swf'),
	(55, 8, 'mov'),
	(56, 8, 'm4v'),
	(57, 8, 'm4a'),
	(58, 8, 'mp4'),
	(59, 8, '3gp'),
	(60, 8, '3g2'),
	(61, 8, 'qt'),
	(62, 9, 'mpeg'),
	(63, 9, 'mpg'),
	(64, 9, 'mp3'),
	(65, 9, 'ogg'),
	(66, 9, 'ogm');
/*!40000 ALTER TABLE `phpbb_extensions` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
