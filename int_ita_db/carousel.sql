-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-04-22 09:15:00
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.carousel
DROP TABLE IF EXISTS `carousel`;
CREATE TABLE IF NOT EXISTS `carousel` (
  `order` int(11) NOT NULL,
  `pictureURL` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `imagesPath` varchar(255) DEFAULT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.carousel: ~4 rows (approximately)
/*!40000 ALTER TABLE `carousel` DISABLE KEYS */;
INSERT INTO `carousel` (`order`, `pictureURL`, `description`, `imagesPath`, `text`) VALUES
	(1, '1.jpg', '<p>Слайдер фото 1</p>', '/css/images/slider_img/', 'Не упусти свій шанс змінити світ - отримай якісну та сучасну освіту і стань класним спеціалістом!'),
	(2, '2.jpg', '<p>Слайдер фото 2</p>', '/css/images/slider_img/', 'Хочеш стати висококласним спеціалістом, приймай вірне рішення - вступай до ІТ Академії ІНТІТА!'),
	(3, '3.jpg', '<p>Слайдер фото 3</p>', '/css/images/slider_img/', 'Один рік наполегливого і цікавого навчання - і ти станеш професійним програмістом. Навчатись важко - зате роботу знайти легко!'),
	(4, '4.jpg', '<p>Слайдер фото 4</p>', '/css/images/slider_img/', 'Не втрачай свій шанс на гідну та цікаву працю – програмуй своє майбутнє вже сьогодні!');
/*!40000 ALTER TABLE `carousel` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
