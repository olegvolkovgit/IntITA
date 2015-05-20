-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-05-20 18:36:26
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.translatedmessagesru
DROP TABLE IF EXISTS `translatedmessagesru`;
CREATE TABLE IF NOT EXISTS `translatedmessagesru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(16) NOT NULL,
  `translation` text NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_translatedMessagesRU_sourcemessages` FOREIGN KEY (`id`) REFERENCES `sourcemessages` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8;

-- Dumping data for table int_ita_db.translatedmessagesru: ~136 rows (approximately)
/*!40000 ALTER TABLE `translatedmessagesru` DISABLE KEYS */;
INSERT INTO `translatedmessagesru` (`id`, `language`, `translation`) VALUES
	(1, 'ru', 'INTITA'),
	(2, 'ru', 'О нас'),
	(3, 'ru', 'Как проходит обучение?'),
	(4, 'ru', 'далее ...'),
	(5, 'ru', 'ПРОГРАММИРУЙ БУДУЩЕЕ'),
	(6, 'ru', 'Важная информация про обучение вместе с нами'),
	(7, 'ru', 'Пять шагов к исполнения твоих желаний'),
	(8, 'ru', 'СТАРТ  />'),
	(9, 'ru', 'Готовы начать?'),
	(10, 'ru', 'Введите данные в форму ниже'),
	(11, 'ru', 'расширенная регистрация'),
	(12, 'ru', 'Вы также можете зарегистрироваться с помощью соцсетей:'),
	(13, 'ru', 'НАЧАТЬ'),
	(14, 'ru', 'Электронная почта'),
	(15, 'ru', 'Пароль'),
	(16, 'ru', 'Курсы'),
	(17, 'ru', 'Форум'),
	(18, 'ru', 'О нас'),
	(19, 'ru', 'Вход'),
	(20, 'ru', 'Выход'),
	(21, 'ru', 'Преподаватели'),
	(22, 'ru', 'Выход'),
	(23, 'ru', 'телефон: +38 0432 52 82 67 '),
	(24, 'ru', 'тел. моб. +38 067 432 20 10'),
	(25, 'ru', 'e-mail: intita.hr@gmail.com'),
	(26, 'ru', 'скайп: int.ita'),
	(27, 'ru', 'Мы гарантируем получение предложения работы<br>\r\nпосле успешного завершения обучения!'),
	(28, 'ru', 'Хочешь стать классным специалистом?<br>\r\nпринимай правильное решение - поступай в IТ Академию  ИНТИТА!'),
	(29, 'ru', 'Один год упорного и интересного обучения - и ты станешь проессиональным программистом.<br>\r\nУчиться тяжело -зато легко найти работу!'),
	(30, 'ru', 'Не упускай свой шанс на достойную и интересную работу - <br>\r\nпрограммируй свое будущее уже сегодня!'),
	(31, 'ru', 'Текст на пятой картинке слайдера'),
	(32, 'ru', 'О чем ты мечтаешь?'),
	(33, 'ru', 'Обучение будущего'),
	(34, 'ru', 'Вопросы'),
	(35, 'ru', 'Может, это возможность жить своей жизнью? Самостоятельно распоряжаться своим временем с возможностью зарабатывать, занимаясь любимым делом и получать удовольстие от современной профессии?'),
	(36, 'ru', 'В отличие от традиционных заведений, мы не учим ради оценок. Мы индивидуально работаем с каждым студентом, чтобы достичь 100% усвоения необходимых знаний.'),
	(37, 'ru', 'Мы предлагаем каждому выпускнику гарантированное получение предложения работы в течении 4-6-ти месяцев после успешного завершения обучения.'),
	(38, 'ru', 'Регистрация на сайте'),
	(39, 'ru', 'Выбор курса или модуля'),
	(40, 'ru', 'Оплата'),
	(41, 'ru', 'Изучение материала'),
	(42, 'ru', 'Завершение курса'),
	(43, 'ru', 'шаг'),
	(44, 'ru', 'Чтобы получить доступ к курсам и пройти бесплатные модули и занятия зарегистрируйся на сайте. Регистрация позволит тебе оценить качество и удобство нашего продукт , который станет для тебя надежным партнером и советчиком в профессиональной самореализации.'),
	(45, 'ru', 'Чтобы стать специалистом определенного направления и уровня ( получить профессиональную специализацию ) выбери для прохождения соответствующий курс . Если Тебя интересует исключительно углубления знаний в определенном направлении информационных технологий , то выбери соответствующий модуль для прохождения .'),
	(46, 'ru', 'Чтобы начать прохождении курса модуля выбери схему оплаты ( вся сумма за курс , оплата модулей , оплата потриместрово , помесячно и т.д.) и исполни оплату удобным Тебе способом ( схему оплаты курса или модуля можно изменять , также возможна помесячная оплата в кредит ) .'),
	(47, 'ru', 'Вивчення матеріалу можливе шляхом читання тексту чи/і перегляду відео для кожного заняття. Під час проходження заняття виконуй Проміжні тестові завдання. По завершенню кожного заняття виконуй Підсумкове тестове завдання. Кожен модуль завершується Індивідуальним проектом чи Екзаменом. 	Можна отримати індивідуальну консультацію викладача чи консультацію онлайн.'),
	(48, 'ru', 'Підсумком курсу є Командний дипломний проект, який виконується разом з іншими студентами (склад команди формуєш самостійно чи рекомендує керівник, який затверджує тему і технічне завдання проекту). Здача проекту передбачає передзахист та захист в он-лайн режимі із представленням технічної документації. Після захисту видається диплом та рекомендація для працевлаштування.'),
	(49, 'ru', 'Главная'),
	(50, 'ru', 'Курсы'),
	(51, 'ru', 'О нас'),
	(52, 'ru', 'Преподаватели'),
	(53, 'ru', 'Форум'),
	(54, 'ru', 'Профиль'),
	(55, 'ru', 'Редактировать профиль'),
	(56, 'ru', 'Регистрация'),
	(57, 'ru', 'Профиль преподавателя'),
	(58, 'ru', 'Наши преподаватели'),
	(59, 'ru', 'персональная страница'),
	(60, 'ru', 'Если Вы профессиональный ІТ-шник и хотите преподавать некоторые ІТ курсы и сотрудничать с нами в подготовке программистов, напишите нам письмо.'),
	(61, 'ru', 'Ведет курсы:'),
	(62, 'ru', 'Читать полностью'),
	(63, 'ru', 'Отзывы'),
	(64, 'ru', 'Раздел:'),
	(65, 'ru', 'О преподавателе:'),
	(66, 'ru', 'Наши курсы'),
	(67, 'ru', 'Концепция подготовки'),
	(68, 'ru', 'Уровень курса:'),
	(69, 'ru', 'Язык курса:'),
	(70, 'ru', 'Курс:'),
	(71, 'ru', 'язык:'),
	(72, 'ru', 'Модуль:'),
	(73, 'ru', 'Занятие:'),
	(74, 'ru', 'Тип:'),
	(75, 'ru', 'Время:'),
	(76, 'ru', 'мин'),
	(77, 'ru', 'Преподаватель'),
	(78, 'ru', 'детальнее'),
	(79, 'ru', 'Запланировать консультацию'),
	(80, 'ru', 'Содержание'),
	(81, 'ru', 'показать'),
	(82, 'ru', 'скрыть'),
	(83, 'ru', 'Видео'),
	(84, 'ru', 'Пример кода'),
	(85, 'ru', 'Инструкция'),
	(86, 'ru', 'Задание'),
	(87, 'ru', 'просмотреть снова предыдущий урок'),
	(88, 'ru', 'НАСТУПНИЙ УРОК'),
	(89, 'ru', 'Ответить'),
	(90, 'ru', 'Итоговое задание'),
	(91, 'ru', 'Вы также можете ввойти с помощью соцсетей:'),
	(92, 'ru', 'Забыли пароль?'),
	(93, 'ru', 'ВОЙТИ'),
	(94, 'ru', 'Статус курса: '),
	(95, 'ru', 'Профиль студента'),
	(96, 'ru', 'Редактировать </br> профиль'),
	(97, 'ru', ' лет'),
	(98, 'ru', ' год'),
	(99, 'ru', ' года'),
	(100, 'ru', 'Про себя:'),
	(101, 'ru', 'Электронная почта:'),
	(102, 'ru', 'Телефон:'),
	(103, 'ru', 'Образование:'),
	(104, 'ru', 'Интересы:'),
	(105, 'ru', 'Откуда узнал о Вас:'),
	(106, 'ru', 'Форма обучения:'),
	(107, 'ru', 'Завершенные курсы:'),
	(108, 'ru', 'Мои курсы'),
	(109, 'ru', 'Расписание'),
	(110, 'ru', 'Консультации'),
	(111, 'ru', 'Экзамены'),
	(112, 'ru', 'Проекты'),
	(113, 'ru', 'Мой рейтинг'),
	(114, 'ru', 'Загрузки'),
	(115, 'ru', 'Переписка'),
	(116, 'ru', 'Мои оценки'),
	(117, 'ru', 'Финансы'),
	(118, 'ru', 'Текущий курс:'),
	(119, 'ru', 'Незавершенный курс:'),
	(120, 'ru', 'Завершен курс:'),
	(121, 'ru', 'Необходимо осуществить следующую проплату до'),
	(122, 'ru', 'Сумма оплаты:'),
	(123, 'ru', ' грн'),
	(124, 'ru', 'Индивидуальный модульный проект'),
	(125, 'ru', 'Командный дипломный проект'),
	(126, 'ru', 'Тип'),
	(127, 'ru', 'Дата'),
	(128, 'ru', 'Время'),
	(129, 'ru', 'Преподаватель'),
	(130, 'ru', 'Тема'),
	(131, 'ru', 'Э'),
	(132, 'ru', 'К'),
	(133, 'ru', 'ИМП'),
	(134, 'ru', 'КДП'),
	(135, 'ru', ' начинающий сильный'),
	(136, 'ru', ' украинский'),
	(137, 'ru', 'Выпускники'),
	(138, 'ru', 'Извините, Вы не можете просматривать эту лекцию. Пожалуйста, зарестрируйтесь для доступа к этой лекции.'),
	(139, 'ru', 'Извините, Вы не можете просматривать эту лекцию. Вы не имеете доступа к этой лекции. Пожалуйста, зайдите в свой аккаунт и оплатите доступ.'),
	(140, 'ru', 'Для начинающих'),
	(141, 'ru', 'Для специалистов'),
	(142, 'ru', 'Для экспертов'),
	(143, 'ru', 'Все курсы'),
	(144, 'ru', 'скидка'),
	(145, 'ru', 'Оценка курса:'),
	(146, 'ru', 'детальнее ...'),
	(147, 'ru', 'Стоимость курса:'),
	(148, 'ru', 'В начале обучения формируется стойкий фундамент для подготовки программистов: необходимые знания элементарной математики, устройства компьютера и основ информатики.'),
	(149, 'ru', '<p>Потом изучаются основные принципы программирования на базе классических компьютерних наук и методологий: алгоритмический язык; элементы высшей и дискретной математики, комбинаторики; структуры данных, разработка и анализ алгоритмов.\r\n<P> После чего формируется база для перехода к современным технологиям программирования: объектно-ориентированное программирование; проектирования баз данных.\r\n<P> Завершением процесса подготовки есть конкретное применение полученных знаний на реальных проектах с усвоением современных методов и технологий, используемых в ИТ индустрии компаниями.'),
	(150, 'ru', '');
/*!40000 ALTER TABLE `translatedmessagesru` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
