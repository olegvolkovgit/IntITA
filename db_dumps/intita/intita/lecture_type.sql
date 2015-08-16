-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-08-15 11:35:05
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table intita.lecture_type
DROP TABLE IF EXISTS `lecture_type`;
CREATE TABLE IF NOT EXISTS `lecture_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `title_ua` varchar(50) NOT NULL,
  `title_ru` varchar(50) NOT NULL,
  `title_en` varchar(50) NOT NULL,
  `short` varchar(5) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table intita.lecture_type: ~4 rows (approximately)
/*!40000 ALTER TABLE `lecture_type` DISABLE KEYS */;
INSERT INTO `lecture_type` (`id`, `image`, `title_ua`, `title_ru`, `title_en`, `short`, `description`) VALUES
	(1, 'lectureType.png', 'лекція/практика', 'лекция/практика', 'lecture/practice', 'л/п', ''),
	(2, 'exam.png', 'екзамен', 'экзамен', 'exam', 'екз', ''),
	(3, 'imp.png', 'індивідуальний модульний проект', 'индивидуальный модульный проект', 'module individual project', 'ІМП', ''),
	(4, 'kdp.png', 'командний дипломний проект', 'комадный модульный проект', 'diploma team project', 'КДП', '');
/*!40000 ALTER TABLE `lecture_type` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
