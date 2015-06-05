-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-06-05 16:01:39
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.translatedmessagesua
DROP TABLE IF EXISTS `translatedmessagesua`;
CREATE TABLE IF NOT EXISTS `translatedmessagesua` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(16) NOT NULL,
  `translation` text NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_translatedmessages_sourcemessages` FOREIGN KEY (`id`) REFERENCES `sourcemessages` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8 COMMENT='Table for translation interface messages (see sourceMessages). UA';

-- Dumping data for table int_ita_db.translatedmessagesua: ~136 rows (approximately)
/*!40000 ALTER TABLE `translatedmessagesua` DISABLE KEYS */;
INSERT INTO `translatedmessagesua` (`id`, `language`, `translation`) VALUES
	(1, 'ua', 'INTITA'),
	(2, 'ua', 'Про нас'),
	(3, 'ua', 'Як розпочати навчання?'),
	(4, 'ua', 'детальніше ...'),
	(5, 'ua', 'ПРОГРАМУЙ МАЙБУТНЄ'),
	(6, 'ua', 'Важлива інформація про навчання разом з нами'),
	(7, 'ua', 'П’ять кроків до здійснення твоїх мрій'),
	(8, 'ua', 'ПОЧАТИ  />'),
	(9, 'ua', 'Готові розпочати?'),
	(10, 'ua', 'Введіть дані в форму нижче'),
	(11, 'ua', 'розширена реєстрація'),
	(12, 'ua', 'Ви можете також зареєструватися через соцмережі:'),
	(13, 'ua', 'ПОЧАТИ'),
	(14, 'ua', 'Електронна пошта'),
	(15, 'ua', 'Пароль'),
	(16, 'ua', 'Курси'),
	(17, 'ua', 'Форум'),
	(18, 'ua', 'Про нас'),
	(19, 'ua', 'Вхід'),
	(20, 'ua', 'Вихід'),
	(21, 'ua', 'Викладачі'),
	(22, 'ua', 'Вихід'),
	(23, 'ua', 'телефон: +38 0432 52 82 67 '),
	(24, 'ua', 'тел. моб. +38 067 432 20 10'),
	(25, 'ua', 'e-mail: intita.hr@gmail.com'),
	(26, 'ua', 'скайп: int.ita'),
	(27, 'ua', 'Ми гарантуємо тобі отримання пропозиції працевлаштування<br>\r\nпісля успішного завершення навчання!'),
	(28, 'ua', 'Не упусти свій шанс змінити світ - отримай якісну та сучасну освіту<br>\r\nі стань класним спеціалістом!'),
	(29, 'ua', 'Один рік наполегливого та цікавого навчання - і ти станеш професійним програмістом<br>\r\nготовим працювати в індустрії інформаційних технологій!\r\n'),
	(30, 'ua', 'Хочеш стати висококласним спеціалістом?<br>\r\nПриймай вірне і виважене рішення - навчайся разом з нами! \r\n'),
	(31, 'ua', 'Не втрачай свій шанс на творчу, цікаву, гідну та перспективну працю –<br>\r\n плануй своє професійне майбутнє вже сьогодні!'),
	(32, 'ua', 'Про що мрієш ти?'),
	(33, 'ua', 'Навчання майбутнього'),
	(34, 'ua', 'Важливі питання'),
	(35, 'ua', 'Можливо, це свобода жити своїм життям? \r\nСамостійно керувати власним часом\r\nз можливістю заробляти, займаючись \r\nулюбленою справою і отримувати \r\nзадоволення від сучасної професії?'),
	(36, 'ua', 'На відміну від традиційних закладів, \r\nми не навчаємо задля оцінок.  \r\nМи працюємо індивідуально  \r\nз кожним студентом, щоб досягти \r\n100% засвоєння необхідних знань. '),
	(37, 'ua', 'Ми пропонуємо кожному нашому \r\nвипускнику гарантоване отримання \r\nпропозиції працевлаштування \r\nпротягом 4-6-ти місяців після \r\nуспішного завершення навчання.'),
	(38, 'ua', 'Реєстрація на сайті'),
	(39, 'ua', 'Вибір курсу чи модуля'),
	(40, 'ua', 'Проплата за навчання'),
	(41, 'ua', 'Освоєння матеріалу'),
	(42, 'ua', 'Завершення курсу'),
	(43, 'ua', 'крок'),
	(44, 'ua', 'Щоб отримати доступ до курсів та пройти безкоштовні модулі і заняття зареєструйся на сайті. Реєстрація дозволить тобі оцінити якість та зручність нашого продукт, який стане для тебе надійним партнером і порадником в професійній самореалізації.'),
	(45, 'ua', 'Щоб стати спеціалістом певного напрямку та рівня (отримати професійну спеціалізацію) вибери для проходження відповідний курс. Якщо Тебе цікавить виключно поглиблення знань в певному напрямку інформаційних технологій, то вибери відповідний модуль для проходження.'),
	(46, 'ua', 'Щоб розпочати проходження курсу чи модуля вибери схему оплати (вся сума за курс, оплата модулів, оплата потриместрово, помісячно тощо) та здійсни оплату зручним Тобі способом (схему оплати курсу чи модуля можна змінювати, також можлива помісячна оплата в кредит).'),
	(47, 'ua', 'Вивчення матеріалу можливе шляхом читання тексту чи/і перегляду відео для кожного заняття. Під час проходження заняття виконуй Проміжні тестові завдання. По завершенню кожного заняття виконуй Підсумкове тестове завдання. Кожен модуль завершується Індивідуальним проектом чи Екзаменом. 	Можна отримати індивідуальну консультацію викладача чи консультацію онлайн.'),
	(48, 'ua', 'Підсумком курсу є Командний дипломний проект, який виконується разом з іншими студентами (склад команди формуєш самостійно чи рекомендує керівник, який затверджує тему і технічне завдання проекту). Здача проекту передбачає передзахист та захист в он-лайн режимі із представленням технічної документації. Після захисту видається диплом та рекомендація для працевлаштування.'),
	(49, 'ua', 'Головна'),
	(50, 'ua', 'Курси'),
	(51, 'ua', 'Про нас'),
	(52, 'ua', 'Викладачі'),
	(53, 'ua', 'Форум'),
	(54, 'ua', 'Профіль'),
	(55, 'ua', 'Редагувати профіль'),
	(56, 'ua', 'Реєстрація'),
	(57, 'ua', 'Профіль викладача'),
	(58, 'ua', 'Наші викладачі'),
	(59, 'ua', 'персональна сторінка'),
	(60, 'ua', 'Якщо ви професійний ІТ-шник і бажаєте викладати окремі ІТ курси чи модулі і співпрацювати з нами в напрямку підготовки програмістів, напишіть нам листа.'),
	(61, 'ua', 'Веде курси:'),
	(62, 'ua', 'Читати повністю'),
	(63, 'ua', 'Відгуки'),
	(64, 'ua', 'Розділ:'),
	(65, 'ua', 'Про викладача:'),
	(66, 'ua', 'Наші курси'),
	(67, 'ua', 'Концепція підготовки'),
	(68, 'ua', 'Рівень курсу:'),
	(69, 'ua', 'Мова курсу:'),
	(70, 'ua', 'Курс:'),
	(71, 'ua', 'мова:'),
	(72, 'ua', 'Модуль:'),
	(73, 'ua', 'Заняття:'),
	(74, 'ua', 'Тип:'),
	(75, 'ua', 'Тривалість:'),
	(76, 'ua', 'хв'),
	(77, 'ua', 'Викладач'),
	(78, 'ua', 'детальніше'),
	(79, 'ua', 'Запланувати консультацію'),
	(80, 'ua', 'Зміст'),
	(81, 'ua', 'показати'),
	(82, 'ua', 'приховати'),
	(83, 'ua', 'Відео'),
	(84, 'ua', 'Зразок коду'),
	(85, 'ua', 'Інструкція'),
	(86, 'ua', 'Завдання'),
	(87, 'ua', 'переглянути знову попередній урок'),
	(88, 'ua', 'НАСТУПНИЙ УРОК'),
	(89, 'ua', 'Відповісти'),
	(90, 'ua', 'Підсумкове завдання'),
	(91, 'ua', 'Ви можете також увійти через соцмережі:'),
	(92, 'ua', 'Забули пароль?'),
	(93, 'ua', 'ВВІЙТИ'),
	(94, 'ua', 'Стан курсу: '),
	(95, 'ua', 'Профіль студента'),
	(96, 'ua', 'Редагувати </br> профіль'),
	(97, 'ua', ' років'),
	(98, 'ua', ' рік'),
	(99, 'ua', ' роки'),
	(100, 'ua', 'Про себе:'),
	(101, 'ua', 'Електрона пошта:'),
	(102, 'ua', 'Телефон:'),
	(103, 'ua', 'Освіта:'),
	(104, 'ua', 'Інтереси:'),
	(105, 'ua', 'Звідки дізнався про Вас:'),
	(106, 'ua', 'Форма навчання:'),
	(107, 'ua', 'Завершенні курси:'),
	(108, 'ua', 'Мої курси'),
	(109, 'ua', 'Розклад'),
	(110, 'ua', 'Консультації'),
	(111, 'ua', 'Екзамени'),
	(112, 'ua', 'Проекти'),
	(113, 'ua', 'Мій рейтинг'),
	(114, 'ua', 'Завантаження'),
	(115, 'ua', 'Листування'),
	(116, 'ua', 'Мої оцінювання'),
	(117, 'ua', 'Фінанси'),
	(118, 'ua', 'Поточний курс:'),
	(119, 'ua', 'Незавершений курс:'),
	(120, 'ua', 'Завершений курс:'),
	(121, 'ua', 'Необхідно здійснити наступну проплату до'),
	(122, 'ua', 'Сума проплати:'),
	(123, 'ua', ' грн'),
	(124, 'ua', 'Індивідуальний модульний проект'),
	(125, 'ua', 'Командний дипломний проект'),
	(126, 'ua', 'Тип'),
	(127, 'ua', 'Дата'),
	(128, 'ua', 'Час'),
	(129, 'ua', 'Викладач'),
	(130, 'ua', 'Тема'),
	(131, 'ua', 'Е'),
	(132, 'ua', 'К'),
	(133, 'ua', 'ІМП'),
	(134, 'ua', 'КДП'),
	(135, 'ua', ' сильний початківець'),
	(136, 'ua', ' українська'),
	(137, 'ua', 'Випускники'),
	(138, 'ua', 'Вибачте, Ви не можете переглядати цю лекцію. Щоб отримати доступ до цієї лекції, зареєструйтесь або увійдіть у свій аккаунт.'),
	(139, 'ua', 'Вибачте, у Вас немає доступу до цієї лекції. Будь-ласка. зайдіть у свій аккаунт та оплатіть доступ до лекції.'),
	(140, 'ua', 'Для початківців'),
	(141, 'ua', 'Для спеціалістів'),
	(142, 'ua', 'Для експертів'),
	(143, 'ua', 'Усі курси'),
	(144, 'ua', 'знижка'),
	(145, 'ua', 'Оцінка курсу:'),
	(146, 'ua', 'детальніше ...'),
	(147, 'ua', 'Вартість курсу: '),
	(148, 'ua', 'Спочатку навчання створюється стійкий фундамент для підготовки програмістів: необхідні знання елементарної математики, будови комп’ютера і основ інформатики.'),
	(149, 'ua', '<p>Потім вивчаються основні принципи програмування на базі класичних комп&rsquo;ютерних наук і методологій: алгоритмічна мова;елементи вищої та дискретної математики і комбінаторики; структури даних, розробка і аналіз алгоритмів.                                 \r\n<p>Після чого формується база для переходу до сучасних технологій програмування: об’єктно-орієнтоване програмування; проектування баз даних.\r\n<p>Завершення процесу підготовки шляхом конкретного застосування отриманих знань на реальних проектах із засвоєнням сучасних методів і технологій, які використовуються в ІТ індустрії компаніями.'),
	(150, 'ua', '');
/*!40000 ALTER TABLE `translatedmessagesua` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
