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

-- Dumping structure for table int_ita_db.step
DROP TABLE IF EXISTS `step`;
CREATE TABLE IF NOT EXISTS `step` (
  `stepID` int(11) NOT NULL AUTO_INCREMENT,
  `language` enum('UA','RU','EN') NOT NULL,
  `stepName` varchar(30) NOT NULL DEFAULT '0',
  `stepNumber` int(11) NOT NULL,
  `stepTitle` varchar(50) NOT NULL,
  `stepImagePath` varchar(255) NOT NULL DEFAULT '0',
  `stepImage` varchar(50) NOT NULL,
  `stepText` text NOT NULL,
  PRIMARY KEY (`stepID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.step: ~5 rows (approximately)
/*!40000 ALTER TABLE `step` DISABLE KEYS */;
INSERT INTO `step` (`stepID`, `language`, `stepName`, `stepNumber`, `stepTitle`, `stepImagePath`, `stepImage`, `stepText`) VALUES
	(1, 'UA', 'крок', 1, 'Реєстрація на сайті', '/css/images/', 'step1.jpg', 'Щоб отримати доступ до переліку курсів, модулів і занять та пройти безкоштовні модулі і заняття зареєструйся на сайті. Реєстрація дозволить тобі оцінити якість та зручність нашого продукт, який стане для тебе надійним партнером і порадником в професійній самореалізації.\r\n'),
	(2, 'UA', 'крок', 2, 'Вибір курсу чи модуля', '/css/images/', 'step2.jpg', '<p>Щоб стати спеціалістом певного напрямку та рівня (отримати професійну спеціалізацію) вибери для проходження відповідний курс. Якщо Тебе цікавить виключно поглиблення знань в певному напрямку ІТ, то вибери відповідний модуль для проходження.</p>'),
	(3, 'UA', 'крок', 3, 'Проплата', '/css/images/', 'step3.jpg', 'Щоб розпочати проходження курсу чи модуля вибери схему оплати (вся сума за курс, помісячно, потриместрово тощо) та здійсни оплату зручним Тобі способом (схему оплати курсу чи модуля можна змінювати, також можлива помісячна оплата в кредит).'),
	(4, 'UA', 'крок', 4, 'Освоєння матеріалу', '/css/images/', 'step4.jpg', '<p>Вивчення матеріалу можливе шляхом читання тексту чи/і перегляду відео для кожного заняття.\n    Протягом освоєння матеріалу заняття виконуй Проміжні тестові завдання. По завершенню кожного заняття виконуй Підсумкове тестове завдання. Кожен модуль завершується Індивідуальним проектом чи Екзаменом.\n    Можна отримати індивідуальну консультацію викладача чи обговорити питання на форумі.</p>'),
	(5, 'UA', 'крок', 5, 'Завершення курсу', '/css/images/', 'step5.jpg', 'Підсумком курсу є Командний дипломний проект, який виконується разом з іншими студентами (склад команди формуєш самостійно чи рекомендує керівник, який затверджує тему і технічне завдання проекту). Здача проекту передбачає передзахист та захист в он-лайн режимі із представленням технічної документації.');
/*!40000 ALTER TABLE `step` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
