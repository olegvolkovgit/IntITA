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

-- Dumping structure for table int_ita_db.mainpage
DROP TABLE IF EXISTS `mainpage`;
CREATE TABLE IF NOT EXISTS `mainpage` (
  `id` int(11) NOT NULL,
  `language` varchar(6) NOT NULL,
  `title` varchar(100) NOT NULL,
  `sliderHeader` varchar(50) NOT NULL,
  `sliderText` varchar(255) NOT NULL,
  `category` varchar(32) NOT NULL,
  `message` varchar(50) NOT NULL,
  `sliderTextureURL` varchar(255) NOT NULL,
  `sliderLineURL` varchar(255) NOT NULL,
  `sliderButtonText` varchar(20) NOT NULL,
  `header1` varchar(50) NOT NULL,
  `subLineImage` varchar(255) NOT NULL,
  `subheader1` varchar(100) NOT NULL,
  `arrayBlocks` varchar(10) NOT NULL,
  `header2` varchar(50) NOT NULL,
  `subheader2` varchar(100) NOT NULL,
  `arraySteps` varchar(10) NOT NULL,
  `stepSize` varchar(10) NOT NULL,
  `linkName` varchar(20) NOT NULL,
  `hexagon` varchar(255) NOT NULL,
  `formHeader1` varchar(50) NOT NULL,
  `formHeader2` varchar(50) NOT NULL,
  `regText` varchar(50) NOT NULL,
  `buttonStart` varchar(50) NOT NULL,
  `socialText` varchar(50) NOT NULL,
  `imageNetwork` varchar(255) NOT NULL,
  `formFon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.mainpage: ~1 rows (approximately)
/*!40000 ALTER TABLE `mainpage` DISABLE KEYS */;
INSERT INTO `mainpage` (`id`, `language`, `title`, `sliderHeader`, `sliderText`, `category`, `message`, `sliderTextureURL`, `sliderLineURL`, `sliderButtonText`, `header1`, `subLineImage`, `subheader1`, `arrayBlocks`, `header2`, `subheader2`, `arraySteps`, `stepSize`, `linkName`, `hexagon`, `formHeader1`, `formHeader2`, `regText`, `buttonStart`, `socialText`, `imageNetwork`, `formFon`) VALUES
	(0, 'ua', 'INTITA', 'ПРОГРАМУЙ  МАЙБУТНЄ', 'Не упусти свій шанс змінити світ - отримай якісну та сучасну освіту і стань класним спеціалістом!', 'mainpage', 'PROGRAM FUTURE', '/css/images/slider_img/texture.png', '/css/images/slider_img/line.png', 'ПОЧАТИ', 'Про нас', '/css/images/line1.png', 'дещо, що Вам потрібно знати про наші курси', '1', 'Як проводиться навчання?', 'далі пояснення як ви будете вчитися крок за кроком', '1', '958px', 'детальніше ...', '/css/images/hexagon.png', 'Готові розпочати?', 'Введіть дані в форму нижче', 'розширена реєстрація', 'ПОЧАТИ', 'Ви можете також зареєструватися через соцмережі:', '/css/images/networking.png', '/css/images/formFon.png');
/*!40000 ALTER TABLE `mainpage` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
