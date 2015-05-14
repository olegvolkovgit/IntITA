/*
Navicat MySQL Data Transfer

Source Server         : IntITA
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : int_ita_db

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-05-14 23:47:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `aa_access`
-- ----------------------------
DROP TABLE IF EXISTS `aa_access`;
CREATE TABLE `aa_access` (
  `user_id` smallint(5) unsigned NOT NULL,
  `interface_id` smallint(5) unsigned NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `add` tinyint(1) NOT NULL DEFAULT '0',
  `edit` tinyint(1) NOT NULL DEFAULT '0',
  `delete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`interface_id`),
  KEY `interface_id` (`interface_id`),
  CONSTRAINT `aa_access_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `aa_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `aa_access_ibfk_2` FOREIGN KEY (`interface_id`) REFERENCES `aa_interfaces` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of aa_access
-- ----------------------------

-- ----------------------------
-- Table structure for `aa_authorizations`
-- ----------------------------
DROP TABLE IF EXISTS `aa_authorizations`;
CREATE TABLE `aa_authorizations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` smallint(5) unsigned NOT NULL,
  `when_enter` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `when_enter` (`when_enter`),
  CONSTRAINT `aa_authorizations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `aa_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of aa_authorizations
-- ----------------------------
INSERT INTO `aa_authorizations` VALUES ('1', '2', '2015-03-02 15:33:25', '::1');
INSERT INTO `aa_authorizations` VALUES ('2', '2', '2015-03-02 15:33:25', '::1');
INSERT INTO `aa_authorizations` VALUES ('3', '2', '2015-03-02 15:41:58', '::1');
INSERT INTO `aa_authorizations` VALUES ('4', '2', '2015-03-02 15:41:59', '::1');
INSERT INTO `aa_authorizations` VALUES ('5', '3', '2015-03-02 15:45:10', '::1');
INSERT INTO `aa_authorizations` VALUES ('6', '3', '2015-03-02 15:45:10', '::1');
INSERT INTO `aa_authorizations` VALUES ('7', '2', '2015-03-03 15:04:10', '::1');
INSERT INTO `aa_authorizations` VALUES ('8', '2', '2015-03-03 15:04:10', '::1');
INSERT INTO `aa_authorizations` VALUES ('9', '2', '2015-03-03 15:41:31', '::1');
INSERT INTO `aa_authorizations` VALUES ('10', '2', '2015-03-03 15:41:32', '::1');
INSERT INTO `aa_authorizations` VALUES ('11', '2', '2015-03-03 17:26:15', '::1');
INSERT INTO `aa_authorizations` VALUES ('12', '2', '2015-03-03 17:26:15', '::1');
INSERT INTO `aa_authorizations` VALUES ('13', '2', '2015-03-04 12:54:56', '::1');
INSERT INTO `aa_authorizations` VALUES ('14', '2', '2015-03-04 12:54:56', '::1');
INSERT INTO `aa_authorizations` VALUES ('15', '2', '2015-03-05 14:12:11', '::1');
INSERT INTO `aa_authorizations` VALUES ('16', '2', '2015-03-05 14:12:12', '::1');
INSERT INTO `aa_authorizations` VALUES ('17', '2', '2015-03-06 13:21:13', '::1');
INSERT INTO `aa_authorizations` VALUES ('18', '2', '2015-03-06 13:21:13', '::1');
INSERT INTO `aa_authorizations` VALUES ('19', '2', '2015-03-06 13:33:29', '::1');
INSERT INTO `aa_authorizations` VALUES ('20', '2', '2015-03-06 13:33:30', '::1');
INSERT INTO `aa_authorizations` VALUES ('21', '2', '2015-03-07 01:19:06', '::1');
INSERT INTO `aa_authorizations` VALUES ('22', '2', '2015-03-07 01:19:07', '::1');
INSERT INTO `aa_authorizations` VALUES ('23', '2', '2015-03-07 10:31:26', '::1');
INSERT INTO `aa_authorizations` VALUES ('24', '2', '2015-03-07 10:31:27', '::1');
INSERT INTO `aa_authorizations` VALUES ('25', '2', '2015-03-10 14:40:09', '::1');
INSERT INTO `aa_authorizations` VALUES ('26', '2', '2015-03-10 14:40:09', '::1');
INSERT INTO `aa_authorizations` VALUES ('27', '2', '2015-03-12 17:10:57', '::1');
INSERT INTO `aa_authorizations` VALUES ('28', '2', '2015-03-12 17:10:57', '::1');
INSERT INTO `aa_authorizations` VALUES ('29', '2', '2015-03-12 18:59:14', '::1');
INSERT INTO `aa_authorizations` VALUES ('30', '2', '2015-03-12 18:59:14', '::1');
INSERT INTO `aa_authorizations` VALUES ('31', '2', '2015-03-13 13:24:19', '::1');
INSERT INTO `aa_authorizations` VALUES ('32', '2', '2015-03-13 13:24:21', '::1');
INSERT INTO `aa_authorizations` VALUES ('33', '2', '2015-03-13 16:25:37', '::1');
INSERT INTO `aa_authorizations` VALUES ('34', '2', '2015-03-13 16:25:37', '::1');
INSERT INTO `aa_authorizations` VALUES ('35', '2', '2015-03-19 15:45:40', '::1');
INSERT INTO `aa_authorizations` VALUES ('36', '2', '2015-03-19 15:45:41', '::1');
INSERT INTO `aa_authorizations` VALUES ('37', '2', '2015-03-20 15:14:18', '::1');
INSERT INTO `aa_authorizations` VALUES ('38', '2', '2015-03-20 15:14:18', '::1');
INSERT INTO `aa_authorizations` VALUES ('39', '2', '2015-03-23 14:29:03', '::1');
INSERT INTO `aa_authorizations` VALUES ('40', '2', '2015-03-23 14:29:04', '::1');
INSERT INTO `aa_authorizations` VALUES ('41', '2', '2015-03-24 19:48:01', '::1');
INSERT INTO `aa_authorizations` VALUES ('42', '2', '2015-03-24 19:48:01', '::1');
INSERT INTO `aa_authorizations` VALUES ('43', '2', '2015-03-26 16:11:11', '::1');
INSERT INTO `aa_authorizations` VALUES ('44', '2', '2015-03-26 16:11:12', '::1');
INSERT INTO `aa_authorizations` VALUES ('45', '2', '2015-04-02 16:57:52', '::1');
INSERT INTO `aa_authorizations` VALUES ('46', '2', '2015-04-02 16:57:52', '::1');
INSERT INTO `aa_authorizations` VALUES ('47', '2', '2015-04-07 16:12:17', '::1');
INSERT INTO `aa_authorizations` VALUES ('48', '2', '2015-04-07 16:12:17', '::1');
INSERT INTO `aa_authorizations` VALUES ('49', '2', '2015-04-09 13:46:07', '::1');
INSERT INTO `aa_authorizations` VALUES ('50', '2', '2015-04-09 13:46:07', '::1');
INSERT INTO `aa_authorizations` VALUES ('51', '2', '2015-05-05 23:41:47', '::1');
INSERT INTO `aa_authorizations` VALUES ('52', '2', '2015-05-05 23:41:47', '::1');
INSERT INTO `aa_authorizations` VALUES ('53', '2', '2015-05-06 14:29:21', '::1');
INSERT INTO `aa_authorizations` VALUES ('54', '2', '2015-05-06 14:29:21', '::1');
INSERT INTO `aa_authorizations` VALUES ('55', '2', '2015-05-06 19:24:31', '::1');
INSERT INTO `aa_authorizations` VALUES ('56', '2', '2015-05-06 19:24:31', '::1');
INSERT INTO `aa_authorizations` VALUES ('57', '2', '2015-05-10 22:46:16', '::1');
INSERT INTO `aa_authorizations` VALUES ('58', '2', '2015-05-10 22:46:16', '::1');

-- ----------------------------
-- Table structure for `aa_errors`
-- ----------------------------
DROP TABLE IF EXISTS `aa_errors`;
CREATE TABLE `aa_errors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `error_type` enum('exception','warning') DEFAULT NULL,
  `info` text,
  `authorization_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `authorization_id` (`authorization_id`),
  CONSTRAINT `aa_errors_ibfk_1` FOREIGN KEY (`authorization_id`) REFERENCES `aa_authorizations` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of aa_errors
-- ----------------------------

-- ----------------------------
-- Table structure for `aa_interfaces`
-- ----------------------------
DROP TABLE IF EXISTS `aa_interfaces`;
CREATE TABLE `aa_interfaces` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `section_id` tinyint(3) unsigned DEFAULT NULL,
  `alias` varchar(60) NOT NULL,
  `level` tinyint(3) unsigned NOT NULL DEFAULT '5',
  `title` varchar(80) NOT NULL,
  `info` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `aa_interfaces_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `aa_sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of aa_interfaces
-- ----------------------------

-- ----------------------------
-- Table structure for `aa_logs`
-- ----------------------------
DROP TABLE IF EXISTS `aa_logs`;
CREATE TABLE `aa_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `interface_id` smallint(5) unsigned DEFAULT NULL,
  `authorization_id` int(10) unsigned DEFAULT NULL,
  `when_event` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `message` text,
  `data` text,
  PRIMARY KEY (`id`),
  KEY `interface_id` (`interface_id`),
  KEY `authorization_id` (`authorization_id`),
  CONSTRAINT `aa_logs_ibfk_1` FOREIGN KEY (`interface_id`) REFERENCES `aa_interfaces` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `aa_logs_ibfk_2` FOREIGN KEY (`authorization_id`) REFERENCES `aa_authorizations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of aa_logs
-- ----------------------------

-- ----------------------------
-- Table structure for `aa_sections`
-- ----------------------------
DROP TABLE IF EXISTS `aa_sections`;
CREATE TABLE `aa_sections` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of aa_sections
-- ----------------------------

-- ----------------------------
-- Table structure for `aa_users`
-- ----------------------------
DROP TABLE IF EXISTS `aa_users`;
CREATE TABLE `aa_users` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `level` enum('root','admin','user') NOT NULL DEFAULT 'user',
  `login` varchar(21) NOT NULL,
  `password` varchar(32) NOT NULL,
  `interface_level` tinyint(4) NOT NULL DEFAULT '1',
  `email` varchar(40) NOT NULL,
  `surname` varchar(21) NOT NULL,
  `firstname` varchar(21) NOT NULL,
  `middlename` varchar(21) DEFAULT NULL,
  `regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info` tinytext,
  `salt` varchar(8) DEFAULT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of aa_users
-- ----------------------------
INSERT INTO `aa_users` VALUES ('2', 'root', 'root', '63a9f0ea7bb98050796b649e85481845', '1', 'root', 'root', 'root', 'root', '2015-03-02 15:33:13', null, null, '0');
INSERT INTO `aa_users` VALUES ('3', 'user', 'User', '5f4dcc3b5aa765d61d8327deb882cf99', '1', 'user', 'Surname', 'Name', 'Middle name', '2015-03-02 15:43:00', null, null, '0');

-- ----------------------------
-- Table structure for `aboutus`
-- ----------------------------
DROP TABLE IF EXISTS `aboutus`;
CREATE TABLE `aboutus` (
  `blockID` int(11) NOT NULL AUTO_INCREMENT,
  `language` enum('EN','UA','RU') NOT NULL,
  `line2Image` varchar(255) NOT NULL,
  `iconImage` varchar(255) NOT NULL,
  `titleText` varchar(50) NOT NULL,
  `textAbout` varchar(255) NOT NULL,
  `linkAddress` varchar(255) NOT NULL,
  `imagesPath` varchar(255) NOT NULL,
  `drop1Text` text NOT NULL,
  `drop2Text` text NOT NULL,
  `drop3Text` text NOT NULL,
  `dropName` varchar(50) NOT NULL,
  `textLarge` text NOT NULL,
  PRIMARY KEY (`blockID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of aboutus
-- ----------------------------
INSERT INTO `aboutus` VALUES ('1', 'UA', '/css/images/line2.png', 'image1.png', 'Про що мрієш ти?', '<p>Спробуємо вгадати: власна квартира чи навіть будинок? Гарний автомобіль? Закордонні подорожі, можливо, до екзотичних країн?</p>', '/index.php?r=site/aboutdetail&id=1', '/images/aboutus/', '', '', '', '', '<p>Спробуємо вгадати: власна квартира чи навіть будинок? Гарний автомобіль? Закордонні подорожі, можливо, до екзотичних країн? Забезпечене життя для себе та близьких, коли не доводиться думати про гроші?\nА, може, це свобода жити своїм життям? Самостійно керувати власним часом з можливістю працювати за зручним графіком без необхідності щодня їздити на роботу, але при цьому мати стабільно високий дохід?\n	Можливо ти хочеш заробляти, займаючись улюбленою справою і отримувати задоволення від сучасної професії?\nПро що б ти не мріяв, для здійснення більшості мрій потрібні гроші. Сьогодні середня зарплата в Україні є найнижчою в Європі: близько 3,5 тис грн у місяць. Навіть якщо брати сферу бізнесу, зарплати більшості робітників не перевищують 5-8 тис грн. \nЯк щодо 40 - 60 тис грн в місяць з можливістю працювати за гнучким графіком та дистанційно? Ти думаєш, що в нашій країні такі умови лише у керівників та власників бізнесу? У нас хороша новина: вже через рік-два-три так зможеш заробляти і ти.</p>\n\n<p><span class=\"detailTitle2\">Професія майбутнього</span>\n Сьогодні у тебе є реальна можливість поєднати хороший заробіток, гнучкий графік роботи та зручність дистанційної роботи. І це не “заработок в интернете”, про який кричить банерна реклама на багатьох сайтах. Ми віримо у те, що високого стабільного доходу можна досягти лише за допомогою власних зусиль.\nМи живемо в епоху, коли головним двигуном розвитку світової економіки є інформаційні технології (ІТ). Вони дозволяють досягти нових проривних результатів у традиційних галузях: виробництві та послугах. Саме інформаційні технології повністю змінили і продовжують трансформувати індустрії звязку, розваг (книги, музика, фільми), банківських послуг, а також такі традиційні бізнеси, як послуги таксі (Uber), готелів (Airbnb), навчання (Coursera). \nГерої інформаційної епохи - це спеціалісти з інформаційних технологій. Вони знаходяться на передовій змін, вони придумали та продовжують розвивати Windows, iOS, Android, а також мільйони додатків до них, вони створюють соціальні мережі, сайти та бази даних. \nГарна новина для тебе: сьогодні таких спеціалістів не вистачає. Інформаційні технології розвиваються дуже швидко і стають потрібними усюди, тому людей не вистачає, існуючі навчальні заклади просто не встигають готувати потрібну кількість. Нестача спеціалістів означає, що зарплати на ринку стабільно зростають, і сягнули небачених для України значень: в середньому спеціалісти з інформаційних технологій сьогодні отримують 3-5 тис доларів у місяць, і при цьому роботодавці активно полюють на професіоналів. Секрет таких високих зарплат не лише у дефіциті кадрів, а й у тому, що для ІТ-галузі кордони - не проблема. Ти можеш працювати вдома зі своєї квартири в Україні над замовленням клієнта зі США чи Німеччини і отримувати винагороду у доларах чи євро з рівнем оплати, не набагато нижчим від американських чи європейських стандартів.  \nМи запрошуємо тебе приєднатися до світової інформаційної еліти та за короткий час стати професіоналом у сфері інформаційних технологій, щоб отримувати стабільно високий дохід та працювати в зручних умовах за гнучким графіком. </p>\n\n<p><span class=\"detailTitle2\">Що очікується від тебе</span><br/>\nПрограмування - це не так складно, як ти можеш уявляти. Безумовно, щоб стати хорошим програмістом, потрібен час та зусилля. Ризикнемо сказати, що крім часу та зусиль (та, зрозуміло, наявності простенького компютера) не потрібно більше ні-чо-го. Не потрібно бути сильним у математиці: навіть якщо у школі ти не любив математику, а твої оцінки не піднимались вище середнього рівня, ти зможеш стати чудовим програмістом. Не потрібно знати, як влаштований компютер чи бути досвіченим користувачем будь-яких програм. Достатньо часу на навчання та бажання займатися. Гарні знання з математики, логіки, комп’ютера можуть пришвидшити темп навчання, але й без них кожен зможе досягти високого рівня професіоналізму у програмуванні завдяки іноваційному підходу до навчання Академії Програмування ІНТІТА.</p>');
INSERT INTO `aboutus` VALUES ('2', 'UA', '/css/images/line2.png', 'image2.png', 'Навчання майбутнього', '<p>Програмування – це не так складно, як ти можеш уявляти. Безумовно, щоб стати хорошим програмістом, потрібен час та зусилля.</p>', '/index.php?r=site/aboutdetail&id=2', '/images/aboutus/', '', '', '', '', '<p>Коли мова йде про навчальний заклад, можемо побитися об заклад, що до думки тобі приходять велика будівля з десятками навчальних приміщень, лекційна аудиторія, парти, записники, конспекти, викладачі, лекції, семінари. Така система освіти сформувалася ще у Стародавній Греції, і за кілька тисяч років майже не змінилася. Але зараз світ стоїть на порозі великої революції в освіті, яка назавжди змінить те, як ми навчаємося. Сьогодні технології зробили доступним те, що раніше могли дозволити собі лише одиниці, наймаючи персональних вчителів та репетиторів: персоналізоване навчання.\n<span class=\"detailTitle2\">“Три кити” Академії ІНТІТА </span></p>\n\n<p><span class=\"detailTitle3\">Кит перший. Гнучкість та зручність. </span></p>\n\n<p>Ти можеш самостійно будувати графік навчання, виходячи з власних потреб та цілей. Якщо ти хочеш закінчити навчання та почати працювати вже через рік, обирай інтенсивне навчання та займайся 6-8 годин в день. Якщо ти хочеш освоїти програмування поступово, не жертвуючи іншими важливими для тебе речами, ти можеш займатися ті ж 6-8 годин, але у тиждень. \nНе потрібно відвідувати навчальний заклад, Академія з тобою всюди. Навіть якщо ти у місці, де немає звязку та інтернету, ти можеш переглядати лекції в офлайн-режимі, а практичну частину зробити пізніше, коли зявиться доступ.  \n<span class=\"detailTitle3\">Кит другий. Орієнтація на ринок. </span></p>\n\n<p>Ми даємо тобі лише 100% необхідні знання. Ми поважаємо гуманітарні дисципліни та фундаментальні точні науки, які входять до  складу обовязкових для вивчення у вишах, але переконані, що вони не є обовязковими для того, щоб стати професіоналом у сфері інформаційних технологій. Ми вважаємо, що кожен має вирішувати індивідуально, що вивчати та чим цікавитись за межами своєї професії. У той же час у програмах вишів відсутні критичні для професійного успіху дисципліни, або ж вони викладаються недостатньо професійно (англійська мова для ІТ-спеціалістів, проектний менеджмент тощо). Інформаційні технології - це дисципліна, яка змінюється кожного дня, програми вишів просто не встигають адаптуватися до такої швидкості змін. ІНТІТА слідкує за змінами щодня, і адаптує як навчальну програму, так і зміст окремих предметів за необхідностю миттєво. Ми завжди у пошуку нового матеріалу, який можна передати студентам академії.  \nПорівнюючи звичайний технічний виш та академію ІНТІТА, ти можеш думати про сімейний універсал та болід Формула-1. Перший підходить для широкого кола завдань, але він значно програє позашляховикам у прохідності, міні-венам у місткості, лімузинам - у комфорті, спротивним автомобілям - у швидкості та керуванні. Другий сконструйовано лише заради максимальної швидкості та маневреності, жертвуючи усім іншим. І в результаті ми не зробимо з тебе універсально освічену людину, яка розбирається потрохи у всьому, ми зробимо тебе професіоналом світового класу в області програмування.  \n <span class=\"detailTitle3\">Кит третій. Результативність. </span></p>\n\n<p>На відміну від традиційних закладів, ми не навчаємо задля оцінок. Ми працюємо індивідуально з кожним студентом, щоб досягти 100% засвоєння необхідних знань (а ми даємо лише необхідні знання). Ми не обмежуємо тебе у часі, теоретично ти можеш навчатися як завгодно довго. Ми беремо на себе зобовязання навчити тебе програмуванню, незважаючи на те, які знання у тебе вже є. Єдиними передумовами для початку занять є бажання, час на навчання, наявність хоча б простенького компютера та вміння читати та писати. \nЗнання, які ти отримаєш, максимально практичні та сучасні. Починаючи з першого заняття, ти робитимеш завдання з реального світу програмування. Ближче до закінчення навчання ти будеш приймати участь у створенні реальних програмних продуктів для ринку.\nМи гарантуємо тобі 100% отримання пропозиції про працевлаштування протягом 4-6-ти місяців після успішного закінчення навчання.\n <span class=\"detailTitle2\">ІНТІТА: переваги наочно</span>\n \n <table id=\"detailTable\">\n<tr><td><span class=\"detailTitle2\">Традиційне навчання</span></td><td><span class=\"detailTitle2\">ІНТІТА</span></td><td><span class=\"detailTitle2\">Переваги</span></td></tr>\n <tr><td>Необхідність відвідувати заняття у класі</td><td>Навчання у себе вдома</td><td>Комфортна домашня атмосфера, економія часу та коштів на поїздки</td></tr>\n <tr><td>Заняття за фіксованим графіком</td><td>Заняття за індивідуальним графіком</td><td>Можливість підлаштувати графік навчання під власні потреби</td></tr>\n<tr><td>Жорстко визначена навчальна програма, привязана до часових рамок (академічний рік)</td><td>Можливість обирати предмети та термін навчання </td><td>Навчання в комфортному темпі за власним графіком, не обмежене часом</td></tr>\n<tr><td>Лекції та семінари, як основа навчального процесу (вивчення теорії)</td><td>Практичні заняття з першого дня навчання, створення реальних працюючих проектів</td><td>Отримання реального робочого досвіду вже протягом навчання, портфоліо готових робіт на момент закінчення навчання</td></tr>\n<tr><td>Оцінки за якість засвоєних знань за певний час </td><td>Оцінок немає, лише “знання засвоєні” чи “потрібно навчатися далі”</td><td>Навчання до позитивного результату: до повного засвоєння необхідних знань</td></tr>\n<tr><td>Диплом про вищу освіту видається через 5-6 років за умови засвоєння великої кількості непрофільних знань (мова, історія, філософія тощо)</td><td>Лише практичні знання, які будуть потрібні тобі у роботі та житті: програмування, англійська мова, побудова карєри на ринку інформаційних технологій, основи життєвого успіху.</td><td>Весь час навчання витрачається на отримання корисних практичних знань, тому термін навчання скорочуються, а кількість практичних засвоєних знань більша, ніж у традиційних закладах.</td></tr>\n </table> \'</p>');
INSERT INTO `aboutus` VALUES ('3', 'UA', '/css/images/line2.png', 'image3.png', 'Питання та відгуки', '<p>Три кити Академії Програмування ІНТІТА Самостійний графік навчання. Лише 100% необхідні знання. Засвоєння 100% знань!</p>', '/index.php?r=site/aboutdetail&id=3', '/images/aboutus/', '', '', '', '', '<p><span class=\"detailTitle3\">Скільки триває навчання, як швидко я зможу почати заробляти?\n</span><ul><li class=\"listAbout\">навчання не має фіксованого терміну і залежить виключно від темпу, який обереш ти.\n</li></ul>\n<span class=\"detailTitle3\">Чи отримаю я державний диплом про освіту?\n</span><ul><li class=\"listAbout\">ми не видаємо дипломів державного зразка, наша ціль - забезпечити передумови для гарантованого працевлаштування слухачів.\n</li></ul>\n<span class=\"detailTitle3\">Чому навчання коштує так дешево (дорого) у порівнянні з вишем (курсами) Х?\n</span><ul><li class=\"listAbout\">вартість навчання економічно обгрунтована і буде відроблена менше, ніж за рік роботи на позиції програміста-початківця.\n</li></ul>\n<span class=\"detailTitle3\">У мене зараз немає необхідних коштів, чи можу я навчатися у кредит?\n</span><ul><li class=\"listAbout\">так, ми пропонуємо гнучкий підхід в оплаті за навчання, детальніше можна вияснити написавши нам листа на електронну пошту. Контакти.\n</li></ul>\n<span class=\"detailTitle3\">Я чув від знайомого, що він освоїв програмування самотужки, це можливо?\n</span><ul><li class=\"listAbout\">так, на ринку багато “програмістів-самоучок”, але вони, як правило, пройшли довгий шлях для того, щоб навчитись програмуванню, ми - один із ефективних варіантів стати кваліфікованим програмістом за короткий час.\n</li></ul>\n<span class=\"detailTitle3\">У мене у школі було погано з математикою / я давно не займався математикою. Це може завадити мені навчитися програмуванню?\n</span><ul><li class=\"listAbout\">математика допомагає краще розвинути логічне мислення і знання елементарної математики необхідні обов’язково, проте, не математичне, а логічне мислення визначає наскільки гарний програміст і тільки невеликий відсоток гарних математиків стають професійними програмістами.\n</li></ul>\n<span class=\"detailTitle3\">Мені 34 роки, чи можу я зараз розпочати навчання?\n</span><ul><li class=\"listAbout\">верхньої вікової межі для того, щоб вивчати програмування - немає, люди і старшого віку розпочинали і досягали гарних результатів. Життєвий досвід людям старшого віку дозволяє ефективніше побудувати навчальний процес і швидше кар’єрно зростати.\n</li></ul>\n<span class=\"detailTitle3\">Я чув думку, що професія програміста технічна, а я - людина творча. Чи підійде програмування мені?\n</span><ul><li class=\"listAbout\">програмування - це і є творчість, варто спробувати, щоб зрозуміти чи це твоє покликання.\n</li></ul>\'</p>');
INSERT INTO `aboutus` VALUES ('4', 'RU', '/css/images/line2.png', 'image1.png', 'О чём ты мечтаешь?', '<p>Попробуем угадать: собственная квартира или даже дом? Красивая машина? Заграничные путешествия в экзотические страны?</p>', '/index.php?r=site/aboutdetail&id=1', '/images/aboutus/', '', '', '', '', '');
INSERT INTO `aboutus` VALUES ('5', 'RU', '/css/images/line2.png', 'image2.png', 'Обучение будущего', '<p>Программирование - это не так сложно, как ты думаешь. Безусловно, чтобы стать хорошим программистом, нужны время и усилия.</p>', '/index.php?r=site/aboutdetail&id=2', '/images/aboutus/', '', '', '', '', '');
INSERT INTO `aboutus` VALUES ('6', 'RU', '/css/images/line2.png', 'image3.png', 'Вопросы и отзывы', '<p>Три кита Академии Программирования ИНТИТА. Самостоятельный график обучения. Только 100% необходимые знания. 100 % усвоение знаний!</p>', '/index.php?r=site/aboutdetail&id=3', '/images/aboutus/', '', '', '', '', '');

-- ----------------------------
-- Table structure for `carousel`
-- ----------------------------
DROP TABLE IF EXISTS `carousel`;
CREATE TABLE `carousel` (
  `order` int(11) NOT NULL,
  `pictureURL` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `imagesPath` varchar(255) DEFAULT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of carousel
-- ----------------------------
INSERT INTO `carousel` VALUES ('1', '1.jpg', '<p>Слайдер фото 1</p>', '/css/images/slider_img/', 'Не упусти свій шанс змінити світ - отримай якісну та сучасну освіту і стань класним спеціалістом!');
INSERT INTO `carousel` VALUES ('2', '2.jpg', '<p>Слайдер фото 2</p>', '/css/images/slider_img/', 'Хочеш стати висококласним спеціалістом, приймай вірне рішення - вступай до ІТ Академії ІНТІТА!');
INSERT INTO `carousel` VALUES ('3', '3.jpg', '<p>Слайдер фото 3</p>', '/css/images/slider_img/', 'Один рік наполегливого і цікавого навчання - і ти станеш професійним програмістом. Навчатись важко - зате роботу знайти легко!');
INSERT INTO `carousel` VALUES ('4', '4.jpg', '<p>Слайдер фото 4</p>', '/css/images/slider_img/', 'Не втрачай свій шанс на гідну та цікаву працю – програмуй своє майбутнє вже сьогодні!');

-- ----------------------------
-- Table structure for `consultationscalendar`
-- ----------------------------
DROP TABLE IF EXISTS `consultationscalendar`;
CREATE TABLE `consultationscalendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lecture_id` int(11) DEFAULT NULL,
  `date_cons` date DEFAULT NULL,
  `start_cons` time DEFAULT NULL,
  `end_cons` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of consultationscalendar
-- ----------------------------
INSERT INTO `consultationscalendar` VALUES ('1', '1', '1', '1', '2015-05-08', '12:20:00', '12:40:00');
INSERT INTO `consultationscalendar` VALUES ('2', '1', '1', '1', '2015-05-07', '14:20:00', '14:40:00');
INSERT INTO `consultationscalendar` VALUES ('3', '1', '1', '1', '2015-05-07', '16:00:00', '16:20:00');
INSERT INTO `consultationscalendar` VALUES ('4', '1', '1', '1', '2015-05-07', '17:20:00', '17:40:00');
INSERT INTO `consultationscalendar` VALUES ('5', '1', '1', '1', '2015-05-07', '18:40:00', '19:00:00');
INSERT INTO `consultationscalendar` VALUES ('6', '1', '1', '1', '2015-05-07', '19:20:00', '19:40:00');
INSERT INTO `consultationscalendar` VALUES ('7', '1', '1', '1', '2015-05-07', '17:20:00', '17:40:00');
INSERT INTO `consultationscalendar` VALUES ('8', '1', '1', '1', '2015-05-07', '18:20:00', '18:40:00');
INSERT INTO `consultationscalendar` VALUES ('9', '1', '1', '1', '2015-05-07', '19:20:00', '19:40:00');
INSERT INTO `consultationscalendar` VALUES ('10', '2', '38', '1', '2015-05-05', '12:20:00', '12:40:00');
INSERT INTO `consultationscalendar` VALUES ('11', '2', '38', '1', '2015-05-05', '13:00:00', '14:00:00');
INSERT INTO `consultationscalendar` VALUES ('12', '2', '38', '1', '2015-05-05', '14:20:00', '14:40:00');
INSERT INTO `consultationscalendar` VALUES ('13', '2', '38', '1', '2015-05-12', '12:00:00', '15:00:00');
INSERT INTO `consultationscalendar` VALUES ('14', '2', '38', '1', '2015-05-12', '19:00:00', '21:00:00');
INSERT INTO `consultationscalendar` VALUES ('15', '2', '38', '1', '2015-05-13', '14:20:00', '14:40:00');
INSERT INTO `consultationscalendar` VALUES ('16', '2', '38', '1', '2015-05-13', '15:20:00', '15:40:00');
INSERT INTO `consultationscalendar` VALUES ('17', '2', '38', '1', '2015-05-13', '17:20:00', '19:40:00');
INSERT INTO `consultationscalendar` VALUES ('18', '2', '38', '1', '2015-05-12', '17:20:00', '17:40:00');
INSERT INTO `consultationscalendar` VALUES ('19', '2', '1', '1', '2015-05-06', '11:20:00', '12:00:00');
INSERT INTO `consultationscalendar` VALUES ('20', '2', '1', '1', '2015-05-06', '14:20:00', '14:40:00');
INSERT INTO `consultationscalendar` VALUES ('21', '2', '1', '1', '2015-05-06', '15:20:00', '15:40:00');
INSERT INTO `consultationscalendar` VALUES ('22', '2', '1', '1', '2015-05-06', '16:20:00', '16:40:00');
INSERT INTO `consultationscalendar` VALUES ('23', '2', '1', '1', '2015-05-13', '21:00:00', '21:20:00');
INSERT INTO `consultationscalendar` VALUES ('24', '2', '38', '1', '2015-05-14', '11:20:00', '11:40:00');

-- ----------------------------
-- Table structure for `course`
-- ----------------------------
DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `course_ID` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(10) NOT NULL,
  `language` varchar(6) NOT NULL,
  `course_name` varchar(45) NOT NULL,
  `level` enum('intern','junior','strong junior','middle','senior') NOT NULL,
  `start` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `modules_count` int(255) DEFAULT NULL,
  `course_duration_hours` int(11) NOT NULL,
  `course_price` decimal(10,0) DEFAULT NULL,
  `for_whom` text,
  `what_you_learn` text,
  `what_you_get` text,
  `course_img` varchar(255) DEFAULT NULL,
  `review` text,
  PRIMARY KEY (`course_ID`),
  UNIQUE KEY `course_name` (`course_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='status: 0 - in develop, 1 - avaliable';

-- ----------------------------
-- Records of course
-- ----------------------------
INSERT INTO `course` VALUES ('1', 'coursePhp', 'ua', 'Інтернет програміст (РНР)', 'strong junior', '2015-07-30', '0', '16', '89', '6548', 'хто відповідає за постановку завдань на розробку;для дизайнерів, які готові почати не просто малювати красиві картинки, а й навчитися тому, як створювати працюючі і зручні інтерфейси;для розробників, які хочуть самостійно створити або змінити свій проект;', 'Ви навчитеся писати чистий код;Користуватися системами контролю версій;Дізнаєтеся, з чого складається сучасний додаток;Для чого потрібен безперервна інтеграція (СІ) сервер;Чому потрібно тестувати свої програми і як це робити;', 'Відеозаписи та текстові матеріали всіх онлайн-занять;Спілкування з розумними одногрупниками;Сертифікат про закінчення навчання;Прилаштованість на робоче місце в силіконовій долині;', '/css/images/course1Image.png', null);
INSERT INTO `course` VALUES ('2', 'courseJava', 'ua', 'Інтернет програміст (Java Script)', 'strong junior', '2015-10-30', '0', '0', '120', '6500', 'хто відповідає за постановку завдань на розробку;для дизайнерів, які готові почати не просто малювати красиві картинки, а й навчитися тому, як створювати працюючі і зручні інтерфейси;для розробників, які хочуть самостійно створити або змінити свій проект;', 'Ви навчитеся писати чистий код;Користуватися системами контролю версій;Дізнаєтеся, з чого складається сучасний додаток;Для чого потрібен безперервна інтеграція (СІ) сервер;Чому потрібно тестувати свої програми і як це робити;', 'Відеозаписи та текстові матеріали всіх онлайн-занять;Спілкування з розумними одногрупниками;Сертифікат про закінчення навчання;Прилаштованість на робоче місце в силіконовій долині;', '/css/images/course9Image.png', null);
INSERT INTO `course` VALUES ('3', 'courseJava', 'ua', 'Програміст (Java)', 'strong junior', '2015-10-30', '0', '0', '30', '6700', 'хто відповідає за постановку завдань на розробку;для дизайнерів, які готові почати не просто малювати красиві картинки, а й навчитися тому, як створювати працюючі і зручні інтерфейси;для розробників, які хочуть самостійно створити або змінити свій проект;', 'Ви навчитеся писати чистий код;Користуватися системами контролю версій;Дізнаєтеся, з чого складається сучасний додаток;Для чого потрібен безперервна інтеграція (СІ) сервер;Чому потрібно тестувати свої програми і як це робити;', 'Відеозаписи та текстові матеріали всіх онлайн-занять;Спілкування з розумними одногрупниками;Сертифікат про закінчення навчання;Прилаштованість на робоче місце в силіконовій долині;', '/css/images/course3Image.png', null);
INSERT INTO `course` VALUES ('4', 'C#', 'ua', 'Програміст (C#)', 'strong junior', '2015-10-30', '0', '0', '40', '6000', 'хто відповідає за постановку завдань на розробку;для дизайнерів, які готові почати не просто малювати красиві картинки, а й навчитися тому, як створювати працюючі і зручні інтерфейси;для розробників, які хочуть самостійно створити або змінити свій проект;', 'Ви навчитеся писати чистий код;Користуватися системами контролю версій;Дізнаєтеся, з чого складається сучасний додаток;Для чого потрібен безперервна інтеграція (СІ) сервер;Чому потрібно тестувати свої програми і як це робити;', 'Відеозаписи та текстові матеріали всіх онлайн-занять;Спілкування з розумними одногрупниками;Сертифікат про закінчення навчання;Прилаштованість на робоче місце в силіконовій долині;', '/css/images/course4Image.png', null);
INSERT INTO `course` VALUES ('5', 'C++', 'ua', 'Програміст (С++)', 'intern', '2015-12-30', '0', '0', '36', '5900', 'хто відповідає за постановку завдань на розробку;для дизайнерів, які готові почати не просто малювати красиві картинки, а й навчитися тому, як створювати працюючі і зручні інтерфейси;для розробників, які хочуть самостійно створити або змінити свій проект;', 'Ви навчитеся писати чистий код;Користуватися системами контролю версій;Дізнаєтеся, з чого складається сучасний додаток;Для чого потрібен безперервна інтеграція (СІ) сервер;Чому потрібно тестувати свої програми і як це робити;', 'Відеозаписи та текстові матеріали всіх онлайн-занять;Спілкування з розумними одногрупниками;Сертифікат про закінчення навчання;Прилаштованість на робоче місце в силіконовій долині;', '/css/images/course2Image.png', null);
INSERT INTO `course` VALUES ('6', 'ObjectiveC', 'ua', 'Програміст (Objective С)', 'middle', '2015-10-30', '0', '0', '130', '7100', 'хто відповідає за постановку завдань на розробку;для дизайнерів, які готові почати не просто малювати красиві картинки, а й навчитися тому, як створювати працюючі і зручні інтерфейси;для розробників, які хочуть самостійно створити або змінити свій проект;', 'Ви навчитеся писати чистий код;Користуватися системами контролю версій;Дізнаєтеся, з чого складається сучасний додаток;Для чого потрібен безперервна інтеграція (СІ) сервер;Чому потрібно тестувати свої програми і як це робити;', 'Відеозаписи та текстові матеріали всіх онлайн-занять;Спілкування з розумними одногрупниками;Сертифікат про закінчення навчання;Прилаштованість на робоче місце в силіконовій долині;', '/css/images/course8Image.png', null);
INSERT INTO `course` VALUES ('7', 'QA', 'ua', 'Тестувальник (QA)', 'junior', '2016-02-28', '0', '0', '64', '6100', 'хто відповідає за постановку завдань на розробку;для дизайнерів, які готові почати не просто малювати красиві картинки, а й навчитися тому, як створювати працюючі і зручні інтерфейси;для розробників, які хочуть самостійно створити або змінити свій проект;', 'Ви навчитеся писати чистий код;Користуватися системами контролю версій;Дізнаєтеся, з чого складається сучасний додаток;Для чого потрібен безперервна інтеграція (СІ) сервер;Чому потрібно тестувати свої програми і як це робити;', 'Відеозаписи та текстові матеріали всіх онлайн-занять;Спілкування з розумними одногрупниками;Сертифікат про закінчення навчання;Прилаштованість на робоче місце в силіконовій долині;', '/css/images/course7Image.png', null);

-- ----------------------------
-- Table structure for `element_type`
-- ----------------------------
DROP TABLE IF EXISTS `element_type`;
CREATE TABLE `element_type` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `type` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='Types of lecture elements.';

-- ----------------------------
-- Records of element_type
-- ----------------------------
INSERT INTO `element_type` VALUES ('1', 'text');
INSERT INTO `element_type` VALUES ('2', 'video');
INSERT INTO `element_type` VALUES ('3', 'code');
INSERT INTO `element_type` VALUES ('4', 'example');
INSERT INTO `element_type` VALUES ('5', 'task');
INSERT INTO `element_type` VALUES ('6', 'final task');
INSERT INTO `element_type` VALUES ('7', 'instruction');
INSERT INTO `element_type` VALUES ('8', 'label');

-- ----------------------------
-- Table structure for `footer`
-- ----------------------------
DROP TABLE IF EXISTS `footer`;
CREATE TABLE `footer` (
  `footerID` int(11) NOT NULL AUTO_INCREMENT,
  `language` enum('EN','UA','RU') NOT NULL DEFAULT 'UA',
  `imageSotial` varchar(255) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `mobile` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `imageUp` varchar(255) NOT NULL,
  PRIMARY KEY (`footerID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of footer
-- ----------------------------
INSERT INTO `footer` VALUES ('1', 'RU', '/css/images/sotial.gif', 'телефон: +38 0432 52 82 67 ', 'тел. моб. +38 067 432 20 10', 'e-mail: intita.hr@gmail.com', '/css/images/go_up.png');
INSERT INTO `footer` VALUES ('2', 'EN', '/css/images/sotial.gif', 'tel.: +38 0432 52 82 67', 'mobile +38 067 432 20 10', 'e-mail: intita.hr@gmail.com', '/css/images/go_up.png');
INSERT INTO `footer` VALUES ('3', 'UA', '/css/images/sotial.gif', 'телефон: +38 0432 52 82 67', 'тел. моб. +38 067 432 20 10', 'e-mail: intita.hr@gmail.com', '/css/images/go_up.png');

-- ----------------------------
-- Table structure for `graduate`
-- ----------------------------
DROP TABLE IF EXISTS `graduate`;
CREATE TABLE `graduate` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `graduate_date` date DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `work_place` varchar(255) DEFAULT NULL,
  `courses` varchar(255) DEFAULT NULL,
  `history` varchar(255) DEFAULT NULL,
  `rate` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of graduate
-- ----------------------------

-- ----------------------------
-- Table structure for `header`
-- ----------------------------
DROP TABLE IF EXISTS `header`;
CREATE TABLE `header` (
  `headerID` int(11) NOT NULL AUTO_INCREMENT,
  `language` enum('EN','UA','RU') NOT NULL,
  `logoURL` varchar(255) NOT NULL,
  `smallLogoURL` varchar(255) NOT NULL,
  `item1Link` varchar(255) NOT NULL,
  `item2Link` varchar(255) NOT NULL,
  `item3Link` varchar(255) NOT NULL,
  `item4Link` varchar(255) NOT NULL,
  PRIMARY KEY (`headerID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of header
-- ----------------------------
INSERT INTO `header` VALUES ('0', 'UA', '/css/images/Logo_big.png', '/css/images/Logo_small.png', '/courses', '/teachers', '/forum', '/aboutus');
INSERT INTO `header` VALUES ('1', 'RU', '/css/images/Logo_big.png', '/css/images/Logo_small.png', '/courses', '/teachers', '/forum', '/aboutus');

-- ----------------------------
-- Table structure for `language`
-- ----------------------------
DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(6) NOT NULL,
  `language` varchar(50) NOT NULL,
  `country` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of language
-- ----------------------------
INSERT INTO `language` VALUES ('1', 'ru', 'русский', 'Россия');
INSERT INTO `language` VALUES ('2', 'en', 'english', 'Great Britain');
INSERT INTO `language` VALUES ('3', 'ua', 'українська', 'Україна');

-- ----------------------------
-- Table structure for `lectures`
-- ----------------------------
DROP TABLE IF EXISTS `lectures`;
CREATE TABLE `lectures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `alias` varchar(10) NOT NULL,
  `language` varchar(6) DEFAULT NULL,
  `idModule` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `idType` int(11) DEFAULT NULL,
  `durationInMinutes` int(11) DEFAULT NULL,
  `idTeacher` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lectures
-- ----------------------------
INSERT INTO `lectures` VALUES ('1', '/css/images/lectureImage.png', 'lecture1', 'ua', '1', '1', 'Змінні та типи даних в PHP', '1', '40', '2');
INSERT INTO `lectures` VALUES ('2', '/css/images/lectureImage.png', 'lecture2', 'ua', '1', '2', 'Основи синтаксису', '1', '50', '2');
INSERT INTO `lectures` VALUES ('3', '/css/images/lectureImage.png', 'lecture3', 'ua', '1', '3', 'Обробка запитів з допомогою PHP', '1', '60', '2');
INSERT INTO `lectures` VALUES ('5', '/css/images/lectureImage.png', 'lecture4', 'ua', '1', '4', 'Функції в PHP', '1', '60', '2');
INSERT INTO `lectures` VALUES ('14', '/css/images/lectureImage.png', 'lecture5', 'ua', '1', '5', 'Об\'єкти і класи PHP', '1', '60', '2');
INSERT INTO `lectures` VALUES ('15', '/css/images/lectureImage.png', 'lecture6', 'ua', '1', '6', 'Робота з масивами даних', '1', '60', '2');
INSERT INTO `lectures` VALUES ('16', '/css/images/lectureImage.png', 'lecture7', 'ua', '1', '7', 'Робота з стрічками', '1', '60', '2');
INSERT INTO `lectures` VALUES ('17', '/css/images/lectureImage.png', 'lecture8', 'ua', '1', '8', 'Робота з файловою системою', '1', '60', '2');
INSERT INTO `lectures` VALUES ('18', '/css/images/lectureImage.png', 'lecture9', 'ua', '1', '9', 'Бази даних і СУБД. Введення в SQL', '1', '60', '2');
INSERT INTO `lectures` VALUES ('19', '/css/images/lectureImage.png', 'lecture10', 'ua', '1', '10', 'Взаємодія PHP і MySQL', '1', '60', '2');
INSERT INTO `lectures` VALUES ('20', '/css/images/lectureImage.png', 'lecture11', 'ua', '1', '11', 'Авторизація доступу з допомогою сесій', '1', '60', '2');
INSERT INTO `lectures` VALUES ('21', '/css/images/lectureImage.png', 'lecture12', 'ua', '1', '12', 'Регулярні вирази', '1', '60', '2');
INSERT INTO `lectures` VALUES ('22', '/css/images/lectureImage.png', 'lecture1', 'ua', '2', '1', 'Взаємодія PHP і XML', '1', '60', '2');
INSERT INTO `lectures` VALUES ('23', '/css/images/lectureImage.png', 'lecture2', 'ua', '2', '2', 'Приклади коду', '1', '60', '2');
INSERT INTO `lectures` VALUES ('24', '/css/images/lectureImage.png', 'lecture3', 'ua', '2', '3', 'Список літератури', '1', '60', '2');
INSERT INTO `lectures` VALUES ('26', '/css/images/lectureImage.png', 'lecture14', 'ua', '1', '13', 'Фреймворк Yii', '1', '60', '2');
INSERT INTO `lectures` VALUES ('27', '/css/images/lectureImage.png', 'lecture15', 'ua', '1', '14', 'Фреймворк Lavarel', '1', '60', '2');
INSERT INTO `lectures` VALUES ('28', null, 'lecture15', 'ua', '0', '0', 'Примітки', null, null, null);
INSERT INTO `lectures` VALUES ('29', null, 'lecture16', 'ua', '0', '0', 'Приклади коду', null, null, null);
INSERT INTO `lectures` VALUES ('30', null, 'lecture15', 'ua', '0', '0', 'Примітки', null, null, null);
INSERT INTO `lectures` VALUES ('31', null, 'lecture15', 'ua', '0', '0', 'Приклади коду', null, null, null);
INSERT INTO `lectures` VALUES ('32', null, 'lecture16', 'ua', '0', '0', 'Примітки', null, null, null);
INSERT INTO `lectures` VALUES ('33', null, 'lecture16', 'ua', '0', '0', 'Примітки', null, null, null);
INSERT INTO `lectures` VALUES ('34', null, 'lecture16', 'ua', '0', '0', 'Примітки', null, null, null);
INSERT INTO `lectures` VALUES ('35', null, 'lecture17', 'ua', '0', '0', 'Приклади коду', null, null, null);
INSERT INTO `lectures` VALUES ('36', null, 'lecture18', 'ua', '0', '0', 'Висновки', null, null, null);
INSERT INTO `lectures` VALUES ('37', null, 'lecture15', 'ua', '0', '0', 'dakwdjlkwe', null, null, null);

-- ----------------------------
-- Table structure for `lecturetype`
-- ----------------------------
DROP TABLE IF EXISTS `lecturetype`;
CREATE TABLE `lecturetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `text` varchar(50) NOT NULL,
  `short` varchar(5) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lecturetype
-- ----------------------------
INSERT INTO `lecturetype` VALUES ('1', '/css/images/lectureType.png', 'лекція/практика', 'л/п', '');
INSERT INTO `lecturetype` VALUES ('2', '/css/images/exam.png', 'екзамен', 'екз', '');
INSERT INTO `lecturetype` VALUES ('3', '/css/images/imp.png', 'індивідуальний модульний проект', 'ІМП', '');
INSERT INTO `lecturetype` VALUES ('4', '/css/images/kdp.png', 'командний дипломний проект', 'КДП', '');

-- ----------------------------
-- Table structure for `lecture_element`
-- ----------------------------
DROP TABLE IF EXISTS `lecture_element`;
CREATE TABLE `lecture_element` (
  `id_lecture` int(11) NOT NULL,
  `block_order` int(11) NOT NULL,
  `type` varchar(15) NOT NULL,
  `id_type` tinyint(4) NOT NULL,
  `html_block` text NOT NULL,
  PRIMARY KEY (`id_lecture`,`block_order`),
  KEY `FK_lecture_element_element_type` (`id_type`),
  CONSTRAINT `FK__lectures` FOREIGN KEY (`id_lecture`) REFERENCES `lectures` (`id`),
  CONSTRAINT `FK_lecture_element_element_type` FOREIGN KEY (`id_type`) REFERENCES `element_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Chapters and other lecture''s resources ';

-- ----------------------------
-- Records of lecture_element
-- ----------------------------
INSERT INTO `lecture_element` VALUES ('1', '1', 'text', '1', '    <h1 class=\"lessonPart\">Вступ</h1>\r\n    <span class=\"colorBlack\">Змінна</span> - це літерно-символьне подання частини інформації, яка перебуває в памяті Web-сервера. В php змінна виглядає ось так:\r\n    \r\n   ');
INSERT INTO `lecture_element` VALUES ('1', '2', 'code', '4', '<p><span class=\"colorGreen\">$</span>names=<span class=\"colorO\">\"Я інформація в памяті тчк\"</span>;</p>');
INSERT INTO `lecture_element` VALUES ('1', '3', 'text', '1', ' <span class=\"colorBlack\">Імена змінних</span>\r\n    <p>Будь-яка змінна в РНР має ім\'я, що починається із знаку $, наприклад Svariable. При такому способі формування імен змінних їх дуже легко відрізнити від іншого коду. Якщо в інших мовах інколи може виникати плутанина з тим, що при першому погляді на код не завжди ясно - де тут змінні, а де функції, то в РНР це питання навіть не постає. Наприклад, ссилка на змінну по її імені, що зберігається в іншій змінній:</p>');
INSERT INTO `lecture_element` VALUES ('1', '4', 'video', '2', 'https://www.youtube.com/embed/L3Mg6lk6yyA');
INSERT INTO `lecture_element` VALUES ('1', '5', 'label', '8', '    <a name=\"Частина 1: Типи змінних та перемінних\"></a>');
INSERT INTO `lecture_element` VALUES ('1', '6', 'text', '1', '    <h1 class=\"lessonPart\">Частина 1: Типи змінних та перемінних</h1>\r\n    <span class=\"colorBlack\">Змінна</span> - це літерно-символьне подання частини інформації, яка перебуває в памяті Web-сервера. В php змінна виглядає ось так:');
INSERT INTO `lecture_element` VALUES ('1', '7', 'code', '4', '<p><span class=\"colorGreen\">$</span>names=<span class=\"colorO\">\"Я інформація в памяті тчк\"</span>;</p>');
INSERT INTO `lecture_element` VALUES ('1', '8', 'text', '1', '    <span class=\"colorBlack\">Імена змінних</span>\r\n    <p>Будь-яка змінна в РНР має ім\'я, що починається із знаку $, наприклад Svariable. При такому способі формування \r\n        імен змінних їх дуже легко відрізнити від іншого коду. Якщо в інших мовах інколи може виникати плутанина з тим,\r\n        що при першому погляді на код не завжди ясно - де тут змінні, а де функції, то в РНР це питання навіть не постає. \r\n        Наприклад, ссилка на змінну по її імені, що зберігається в іншій змінній:</p>');
INSERT INTO `lecture_element` VALUES ('1', '9', 'code', '4', '\r\n        <p>$names=\"value\";</p>\r\n        <p>$names=5;</p>\r\n        <p>echo $$name;</p>\r\n');
INSERT INTO `lecture_element` VALUES ('1', '10', 'text', '1', '    <p>Змінні в РНР представляються у вигляді рядка, що починається знаком долара, а за ним слідує ім\'я змінної. Ім\'я змінної може складатися з латинських літер, звичайних цифр і деяких символів або комбінацій літер, цифр і символів.</p>');
INSERT INTO `lecture_element` VALUES ('1', '11', 'example', '3', '<span class=\"subChapter\">Зразок коду 1:</span>\r\n<pre class=\"prettyprint linenums\">\r\n&lt;html&gt;\r\n  &lt;head&gt;\r\n  &lt;/head&gt;\r\n  &lt;body&gt;\r\n    &lt;p&gt;\r\n      &lt;?php\r\n      $items= //Set this to a number greater than 5! Type the string &quot;Arr, matey!&quot;\r\n\r\n      if ($items&lt;5) {\r\n      echo &quot;You get a 10% discount!&quot;;\r\n      }\r\n    ?&gt;\r\n    &lt;/p&gt;\r\n &lt;/body&gt;\r\n&lt;/html&gt;\r\n</pre>');
INSERT INTO `lecture_element` VALUES ('1', '12', 'example', '3', '<span class=\"subChapter\">Зразок коду 2  </span><span class=\"spoilerLinks\"><span class=\"spoilerClick\">(показати)</span><span class=\"spoilerTriangle\"> &#9660;</span></span>');
INSERT INTO `lecture_element` VALUES ('1', '13', 'video', '2', 'https://www.youtube.com/embed/L3Mg6lk6yyA');
INSERT INTO `lecture_element` VALUES ('1', '14', 'instruction', '7', '<li>On line 7, set <span class=\"colorBP\"><span class=\"colorGreen\">$</span>terms</span> equal to a number greater than 5. Make sure to put a semicolon at the end of the line.</li>\r\n                <li>On line 9, edit the state condition so that your program will be out Some expressions return a \' logical value\": TRUE or FALSE, text like thise:<span class=\"colorAlert\">You get a 10% discount!</span></li>');
INSERT INTO `lecture_element` VALUES ('1', '15', 'task', '5', '<li>On line 7, set equal to a number greater than 5. Some expressions return a \"logical value\": TRUE or FALSE. Make sure to put a semicolon at the end of the line.</li>\r\n                    <a href=\"#\"> <span class=\"colorP\"><img src=\"<?php echo Yii::app()->request->baseUrl; ?>/css/images/arrow.png\"> Відповісти</span></a>\r\n                    <li>An if statement is made up of the if keyword, a condition like we\'ve seen before <span class=\"colorBP\"><span class=\"colorGreen\">$</span>terms</span>, and a pair of curly braces <span class=\"colorBP\">{}</span>. If the answer to the condition is yes, the code inside the curly will run.</li>\r\n                    <a href=\"#\"><span class=\"colorP\"><img src=\"<?php echo Yii::app()->request->baseUrl; ?>/css/images/arrow.png\"> Відповісти</span></a>\r\n                    <li>Резиновая по ширине (изменяется с Some expressions return a \"logical value\": TRUE or FALSE, изменением окна <span class=\"colorBP\"><span class=\"colorGreen\">$</span>terms</span> браузера или с разрешением экрана)</li>');
INSERT INTO `lecture_element` VALUES ('1', '16', 'label', '8', '    <a name=\"Частина 7: Типи данних та математичний аналіз\"></a>\r\n    <img src=\"<?php echo Yii::app()->request->baseUrl; ?>/css/images/borderLesson.png\">');
INSERT INTO `lecture_element` VALUES ('1', '17', 'text', '1', '<span class=\"colorBlack\">Змінна</span> - це літерно-символьне подання частини інформації, яка перебуває в памяті Web-сервера. В php змінна виглядає ось так:');
INSERT INTO `lecture_element` VALUES ('1', '18', 'code', '4', '<p><span class=\"colorGreen\">$</span>names=<span class=\"colorO\">\"Я інформація в памяті тчк\"</span>;</p>');
INSERT INTO `lecture_element` VALUES ('1', '19', 'text', '1', '    <span class=\"colorBlack\">Імена змінних</span>\r\n    <p>Будь-яка змінна в РНР має ім\'я, що починається із знаку $, наприклад Svariable. При такому способі формування імен змінних їх дуже легко відрізнити від іншого коду. Якщо в інших мовах інколи може виникати плутанина з тим, що при першому погляді на код не завжди ясно - де тут змінні, а де функції, то в РНР це питання навіть не постає. Наприклад, ссилка на змінну по її імені, що зберігається в іншій змінній:</p>');
INSERT INTO `lecture_element` VALUES ('1', '20', 'code', '4', '        <p>$names=\"value\";</p>\r\n        <p>$names=5;</p>\r\n        <p>echo $$name;</p>\r\n');
INSERT INTO `lecture_element` VALUES ('1', '21', 'text', '1', '    <p>Змінні в РНР представляються у вигляді рядка, що починається знаком долара, а за ним слідує ім\'я змінної. Ім\'я змінної може складатися з латинських літер, звичайних цифр і деяких символів або комбінацій літер, цифр і символів.</p>');
INSERT INTO `lecture_element` VALUES ('1', '22', 'example', '3', '<span class=\"subChapter\">Зразок коду 1:</span>\r\n<pre class=\"prettyprint linenums\">\r\n&lt;html&gt;\r\n  &lt;head&gt;\r\n  &lt;/head&gt;\r\n  &lt;body&gt;\r\n    &lt;p&gt;\r\n      &lt;?php\r\n      $items= //Set this to a number greater than 5! Type the string &quot;Arr, matey!&quot;\r\n\r\n      if ($items&lt;5) {\r\n      echo &quot;You get a 10% discount!&quot;;\r\n      }\r\n    ?&gt;\r\n    &lt;/p&gt;\r\n &lt;/body&gt;\r\n&lt;/html&gt;\r\n</pre>');
INSERT INTO `lecture_element` VALUES ('1', '23', 'example', '3', '    <span class=\"subChapter\"><?php echo Yii::t(\'lecture\',\'Code example\'); ?> 2  </span><span class=\"spoilerLinks\"><span class=\"spoilerClick\">(показати)</span><span class=\"spoilerTriangle\"> &#9660;</span></span>\r\n    <div class=\"spoilerBody\">\r\n<pre class=\"prettyprint linenums\">\r\n&lt;html&gt;\r\n  &lt;head&gt;\r\n  &lt;/head&gt;\r\n  &lt;body&gt;\r\n    &lt;p&gt;\r\n      &lt;?php\r\n      $items= //Set this to a number greater than 5! Type the string &quot;Arr, matey!&quot;\r\n\r\n      if ($items&lt;5) {\r\n      echo &quot;You get a 10% discount!&quot;;\r\n      }\r\n    ?&gt;\r\n    &lt;/p&gt;\r\n &lt;/body&gt;\r\n&lt;/html&gt;\r\n</pre>\r\n    </div>');
INSERT INTO `lecture_element` VALUES ('1', '24', 'video', '2', 'https://www.youtube.com/embed/L3Mg6lk6yyA');
INSERT INTO `lecture_element` VALUES ('1', '25', 'instruction', '7', '<li>On line 7, set <span class=\"colorBP\"><span class=\"colorGreen\">$</span>terms</span> equal to a number greater than 5. Make sure to put a semicolon at the end of the line.</li>\r\n                <li>On line 9, edit the state condition so that your program will be out Some expressions return a \' logical value\": TRUE or FALSE, text like thise:<span class=\"colorAlert\">You get a 10% discount!</span></li>');
INSERT INTO `lecture_element` VALUES ('1', '26', 'task', '5', '<li>On line 7, set equal to a number greater than 5. Some expressions return a \"logical value\": TRUE or FALSE. Make sure to put a semicolon at the end of the line.</li>\r\n                <a href=\"#\"> <span class=\"colorP\"><img src=\"/css/images/arrow.png\"> Відповісти</span></a>\r\n                <li>An if statement is made up of the if keyword, a condition like we\'ve seen before <span class=\"colorBP\"><span class=\"colorGreen\">$</span>terms</span>, and a pair of curly braces <span class=\"colorBP\">{}</span>. If the answer to the condition is yes, the code inside the curly will run.</li>\r\n                <a href=\"#\"><span class=\"colorP\"><img src=\"/css/images/arrow.png\"> Відповісти</span></a>\r\n                <li>Резиновая по ширине (изменяется с Some expressions return a \"logical value\": TRUE or FALSE, изменением окна <span class=\"colorBP\"><span class=\"colorGreen\">$</span>terms</span> браузера или с разрешением экрана)</li>');
INSERT INTO `lecture_element` VALUES ('1', '27', 'final task', '6', ' <li>On line 7, set equal to a number greater than 5. Some expressions return a \"logical value\": TRUE or FALSE. Make sure to put a semicolon at the end of the line.</li>\r\n                <a href=\"#\"> <span class=\"colorP\"><img src=\"/css/images/arrow.png\"> Відповісти</span></a>\r\n                <li>An if statement is made up of the if keyword, a condition like we\'ve seen before <span class=\"colorBP\">$terms</span>, and a pair of curly braces <span class=\"colorBP\">{}</span>. If the answer to the condition is yes, the code inside the curly will run.</li>\r\n                <a href=\"#\"><span class=\"colorP\"><img src=\"/css/images/arrow.png\"> Відповісти</span></a>\r\n                <li>Резиновая по ширине (изменяется с Some expressions return a \"logical value\": TRUE or FALSE, изменением окна <span class=\"colorBP\">$terms</span> браузера или с разрешением экрана)</li>');

-- ----------------------------
-- Table structure for `mainpage`
-- ----------------------------
DROP TABLE IF EXISTS `mainpage`;
CREATE TABLE `mainpage` (
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

-- ----------------------------
-- Records of mainpage
-- ----------------------------
INSERT INTO `mainpage` VALUES ('0', 'ua', 'INTITA', 'ПРОГРАМУЙ  МАЙБУТНЄ', 'Не упусти свій шанс змінити світ - отримай якісну та сучасну освіту і стань класним спеціалістом!', 'mainpage', 'PROGRAM FUTURE', '/css/images/slider_img/texture.png', '/css/images/slider_img/line.png', 'ПОЧАТИ', 'Про нас', '/css/images/line1.png', 'дещо, що Вам потрібно знати про наші курси', '1', 'Як проводиться навчання?', 'далі пояснення як ви будете вчитися крок за кроком', '1', '958px', 'детальніше ...', '/css/images/hexagon.png', 'Готові розпочати?', 'Введіть дані в форму нижче', 'розширена реєстрація', 'ПОЧАТИ', 'Ви можете також зареєструватися через соцмережі:', '/css/images/networking.png', '/css/images/formFon.png');

-- ----------------------------
-- Table structure for `messages`
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `language` varchar(16) NOT NULL,
  `translation` text NOT NULL,
  KEY `FK_messages_sourcemessages` (`id`),
  CONSTRAINT `FK_messages_sourcemessages` FOREIGN KEY (`id`) REFERENCES `sourcemessages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of messages
-- ----------------------------
INSERT INTO `messages` VALUES ('1', 'ua', 'INTITA');
INSERT INTO `messages` VALUES ('2', 'ua', 'Про нас');
INSERT INTO `messages` VALUES ('3', 'ua', 'Як розпочати навчання?');
INSERT INTO `messages` VALUES ('4', 'ua', 'детальніше ...');
INSERT INTO `messages` VALUES ('5', 'ua', 'ПРОГРАМУЙ МАЙБУТНЄ');
INSERT INTO `messages` VALUES ('6', 'ua', 'Важлива інформація про навчання разом з нами');
INSERT INTO `messages` VALUES ('7', 'ua', 'П’ять кроків до здійснення твоїх мрій');
INSERT INTO `messages` VALUES ('8', 'ua', 'ПОЧАТИ  />');
INSERT INTO `messages` VALUES ('9', 'ua', 'Реєстрація в один клік');
INSERT INTO `messages` VALUES ('10', 'ua', 'Введіть дані в форму нижче');
INSERT INTO `messages` VALUES ('11', 'ua', 'розширена реєстрація');
INSERT INTO `messages` VALUES ('12', 'ua', 'Зареєструватись через соцмережі');
INSERT INTO `messages` VALUES ('13', 'ua', 'ПОЧАТИ />');
INSERT INTO `messages` VALUES ('14', 'ua', 'Електронна пошта');
INSERT INTO `messages` VALUES ('15', 'ua', 'Пароль');
INSERT INTO `messages` VALUES ('16', 'ua', 'Курси');
INSERT INTO `messages` VALUES ('17', 'ua', 'Форум');
INSERT INTO `messages` VALUES ('18', 'ua', 'Про нас');
INSERT INTO `messages` VALUES ('19', 'ua', 'Вхід');
INSERT INTO `messages` VALUES ('20', 'ua', 'Вихід');
INSERT INTO `messages` VALUES ('21', 'ua', 'Викладачі');
INSERT INTO `messages` VALUES ('22', 'ua', 'Вихід');
INSERT INTO `messages` VALUES ('23', 'ua', 'телефон: +38 0432 52 82 67 ');
INSERT INTO `messages` VALUES ('24', 'ua', 'тел. моб. +38 067 432 20 10');
INSERT INTO `messages` VALUES ('25', 'ua', 'e-mail: intita.hr@gmail.com');
INSERT INTO `messages` VALUES ('26', 'ua', 'скайп: int.ita');
INSERT INTO `messages` VALUES ('27', 'ua', 'Ми гарантуємо тобі отримання пропозиції працевлаштування<br>\r\nпісля успішного завершення навчання!');
INSERT INTO `messages` VALUES ('28', 'ua', 'Не упусти свій шанс змінити світ - отримай якісну та сучасну освіту<br>\r\nі стань класним спеціалістом!');
INSERT INTO `messages` VALUES ('29', 'ua', 'Один рік наполегливого та цікавого навчання - і ти станеш професійним програмістом<br>\r\nготовим працювати в індустрії інформаційних технологій!\r\n');
INSERT INTO `messages` VALUES ('30', 'ua', 'Хочеш стати висококласним спеціалістом?<br>\r\nПриймай вірне і виважене рішення - навчайся разом з нами! \r\n');
INSERT INTO `messages` VALUES ('31', 'ua', 'Не втрачай свій шанс на творчу, цікаву, гідну та перспективну працю –<br>\r\n плануй своє професійне майбутнє вже сьогодні!');
INSERT INTO `messages` VALUES ('32', 'ua', 'Про що мрієш ти?');
INSERT INTO `messages` VALUES ('33', 'ua', 'Навчання майбутнього');
INSERT INTO `messages` VALUES ('34', 'ua', 'Важливі питання');
INSERT INTO `messages` VALUES ('35', 'ua', 'Можливо, це свобода жити своїм життям? \r\nСамостійно керувати власним часом\r\nз можливістю заробляти, займаючись \r\nулюбленою справою і отримувати \r\nзадоволення від сучасної професії?');
INSERT INTO `messages` VALUES ('36', 'ua', 'На відміну від традиційних закладів, \r\nми не навчаємо задля оцінок.  \r\nМи працюємо індивідуально  \r\nз кожним студентом, щоб досягти \r\n100% засвоєння необхідних знань. ');
INSERT INTO `messages` VALUES ('37', 'ua', 'Ми пропонуємо кожному нашому \r\nвипускнику гарантоване отримання \r\nпропозиції працевлаштування \r\nпротягом 4-6-ти місяців після \r\nуспішного завершення навчання.');
INSERT INTO `messages` VALUES ('38', 'ua', 'Реєстрація на сайті');
INSERT INTO `messages` VALUES ('39', 'ua', 'Вибір курсу чи модуля');
INSERT INTO `messages` VALUES ('40', 'ua', 'Проплата за навчання');
INSERT INTO `messages` VALUES ('41', 'ua', 'Освоєння матеріалу');
INSERT INTO `messages` VALUES ('42', 'ua', 'Завершення курсу');
INSERT INTO `messages` VALUES ('43', 'ua', 'крок');
INSERT INTO `messages` VALUES ('44', 'ua', 'Щоб отримати доступ до курсів та пройти безкоштовні модулі і заняття зареєструйся на сайті. Реєстрація дозволить тобі оцінити якість та зручність нашого продукт, який стане для тебе надійним партнером і порадником в професійній самореалізації.');
INSERT INTO `messages` VALUES ('45', 'ua', 'Щоб стати спеціалістом певного напрямку та рівня (отримати професійну спеціалізацію) вибери для проходження відповідний курс. Якщо Тебе цікавить виключно поглиблення знань в певному напрямку інформаційних технологій, то вибери відповідний модуль для проходження.');
INSERT INTO `messages` VALUES ('46', 'ua', 'Щоб розпочати проходження курсу чи модуля вибери схему оплати (вся сума за курс, оплата модулів, оплата потриместрово, помісячно тощо) та здійсни оплату зручним Тобі способом (схему оплати курсу чи модуля можна змінювати, також можлива помісячна оплата в кредит).');
INSERT INTO `messages` VALUES ('47', 'ua', 'Вивчення матеріалу можливе шляхом читання тексту чи/і перегляду відео для кожного заняття. Під час проходження заняття виконуй Проміжні тестові завдання. По завершенню кожного заняття виконуй Підсумкове тестове завдання. Кожен модуль завершується Індивідуальним проектом чи Екзаменом. 	Можна отримати індивідуальну консультацію викладача чи консультацію онлайн.');
INSERT INTO `messages` VALUES ('48', 'ua', 'Підсумком курсу є Командний дипломний проект, який виконується разом з іншими студентами (склад команди формуєш самостійно чи рекомендує керівник, який затверджує тему і технічне завдання проекту). Здача проекту передбачає передзахист та захист в он-лайн режимі із представленням технічної документації. Після захисту видається диплом та рекомендація для працевлаштування.');
INSERT INTO `messages` VALUES ('49', 'ua', 'Головна');
INSERT INTO `messages` VALUES ('50', 'ua', 'Курси');
INSERT INTO `messages` VALUES ('51', 'ua', 'Про нас');
INSERT INTO `messages` VALUES ('52', 'ua', 'Викладачі');
INSERT INTO `messages` VALUES ('53', 'ua', 'Форум');
INSERT INTO `messages` VALUES ('54', 'ua', 'Профіль');
INSERT INTO `messages` VALUES ('55', 'ua', 'Редагувати профіль');
INSERT INTO `messages` VALUES ('56', 'ua', 'Реєстрація');
INSERT INTO `messages` VALUES ('57', 'ua', 'Профіль викладача');
INSERT INTO `messages` VALUES ('58', 'ua', 'Наші викладачі');
INSERT INTO `messages` VALUES ('59', 'ua', 'персональна сторінка');
INSERT INTO `messages` VALUES ('60', 'ua', 'Якщо ви професійний ІТ-шник і бажаєте викладати окремі ІТ теми чи модулі і співпрацювати з нами в напрямку підготовки програмістів, напишіть нам листа.');
INSERT INTO `messages` VALUES ('61', 'ua', 'Веде курси:');
INSERT INTO `messages` VALUES ('62', 'ua', 'Читати повністю');
INSERT INTO `messages` VALUES ('63', 'ua', 'Відгуки');
INSERT INTO `messages` VALUES ('64', 'ua', 'Розділ:');
INSERT INTO `messages` VALUES ('65', 'ua', 'Про викладача:');
INSERT INTO `messages` VALUES ('66', 'ua', 'Наші курси');
INSERT INTO `messages` VALUES ('67', 'ua', 'Концепція підготовки');
INSERT INTO `messages` VALUES ('68', 'ua', 'Рівень курсу:');
INSERT INTO `messages` VALUES ('69', 'ua', 'Мова курсу:');
INSERT INTO `messages` VALUES ('70', 'ua', 'Курс:');
INSERT INTO `messages` VALUES ('71', 'ua', 'мова:');
INSERT INTO `messages` VALUES ('72', 'ua', 'Модуль:');
INSERT INTO `messages` VALUES ('73', 'ua', 'Заняття');
INSERT INTO `messages` VALUES ('74', 'ua', 'Тип:');
INSERT INTO `messages` VALUES ('75', 'ua', 'Тривалість:');
INSERT INTO `messages` VALUES ('76', 'ua', 'хв');
INSERT INTO `messages` VALUES ('77', 'ua', 'Викладач');
INSERT INTO `messages` VALUES ('78', 'ua', 'детальніше');
INSERT INTO `messages` VALUES ('79', 'ua', 'Запланувати консультацію');
INSERT INTO `messages` VALUES ('80', 'ua', 'Зміст');
INSERT INTO `messages` VALUES ('81', 'ua', 'показати');
INSERT INTO `messages` VALUES ('82', 'ua', 'приховати');
INSERT INTO `messages` VALUES ('83', 'ua', 'Відео');
INSERT INTO `messages` VALUES ('84', 'ua', 'Зразок коду');
INSERT INTO `messages` VALUES ('85', 'ua', 'Інструкція');
INSERT INTO `messages` VALUES ('86', 'ua', 'Завдання');
INSERT INTO `messages` VALUES ('87', 'ua', 'переглянути знову попередній урок');
INSERT INTO `messages` VALUES ('88', 'ua', 'НАСТУПНИЙ УРОК');
INSERT INTO `messages` VALUES ('89', 'ua', 'Відповісти');
INSERT INTO `messages` VALUES ('90', 'ua', 'Підсумкове завдання');
INSERT INTO `messages` VALUES ('91', 'ua', 'Ви можете також увійти через соцмережі:');
INSERT INTO `messages` VALUES ('92', 'ua', 'Забули пароль?');
INSERT INTO `messages` VALUES ('93', 'ua', 'ВВІЙТИ');
INSERT INTO `messages` VALUES ('94', 'ua', 'Стан курсу: ');
INSERT INTO `messages` VALUES ('95', 'ua', 'Профіль студента');
INSERT INTO `messages` VALUES ('96', 'ua', 'Редагувати </br> профіль');
INSERT INTO `messages` VALUES ('97', 'ua', ' років');
INSERT INTO `messages` VALUES ('98', 'ua', ' рік');
INSERT INTO `messages` VALUES ('99', 'ua', ' роки');
INSERT INTO `messages` VALUES ('100', 'ua', 'Про себе:');
INSERT INTO `messages` VALUES ('101', 'ua', 'Електрона пошта:');
INSERT INTO `messages` VALUES ('102', 'ua', 'Телефон:');
INSERT INTO `messages` VALUES ('103', 'ua', 'Освіта:');
INSERT INTO `messages` VALUES ('104', 'ua', 'Інтереси:');
INSERT INTO `messages` VALUES ('105', 'ua', 'Звідки дізнався про Вас:');
INSERT INTO `messages` VALUES ('106', 'ua', 'Форма навчання:');
INSERT INTO `messages` VALUES ('107', 'ua', 'Завершенні курси:');
INSERT INTO `messages` VALUES ('108', 'ua', 'Мої курси');
INSERT INTO `messages` VALUES ('109', 'ua', 'Розклад');
INSERT INTO `messages` VALUES ('110', 'ua', 'Консультації');
INSERT INTO `messages` VALUES ('111', 'ua', 'Екзамени');
INSERT INTO `messages` VALUES ('112', 'ua', 'Проекти');
INSERT INTO `messages` VALUES ('113', 'ua', 'Мій рейтинг');
INSERT INTO `messages` VALUES ('114', 'ua', 'Завантаження');
INSERT INTO `messages` VALUES ('115', 'ua', 'Листування');
INSERT INTO `messages` VALUES ('116', 'ua', 'Мої оцінювання');
INSERT INTO `messages` VALUES ('117', 'ua', 'Фінанси');
INSERT INTO `messages` VALUES ('118', 'ua', 'Поточний курс:');
INSERT INTO `messages` VALUES ('119', 'ua', 'Незавершений курс:');
INSERT INTO `messages` VALUES ('120', 'ua', 'Завершений курс:');
INSERT INTO `messages` VALUES ('121', 'ua', 'Необхідно здійснити наступну проплату до');
INSERT INTO `messages` VALUES ('122', 'ua', 'Сума проплати:');
INSERT INTO `messages` VALUES ('123', 'ua', ' грн');
INSERT INTO `messages` VALUES ('124', 'ua', 'Індивідуальний модульний проект');
INSERT INTO `messages` VALUES ('125', 'ua', 'Командний дипломний проект');
INSERT INTO `messages` VALUES ('126', 'ua', 'Тип');
INSERT INTO `messages` VALUES ('127', 'ua', 'Дата');
INSERT INTO `messages` VALUES ('128', 'ua', 'Час');
INSERT INTO `messages` VALUES ('129', 'ua', 'Викладач');
INSERT INTO `messages` VALUES ('130', 'ua', 'Тема');
INSERT INTO `messages` VALUES ('131', 'ua', 'Е');
INSERT INTO `messages` VALUES ('132', 'ua', 'К');
INSERT INTO `messages` VALUES ('133', 'ua', 'ІМП');
INSERT INTO `messages` VALUES ('134', 'ua', 'КДП');
INSERT INTO `messages` VALUES ('135', 'ua', ' сильний початківець');
INSERT INTO `messages` VALUES ('136', 'ua', ' українська');
INSERT INTO `messages` VALUES ('137', 'ua', 'Випускники');
INSERT INTO `messages` VALUES ('138', 'ua', 'Вибачте, Ви не можете переглядати цю лекцію. Щоб отримати доступ до цієї лекції, зареєструйтесь або увійдіть у свій аккаунт.');
INSERT INTO `messages` VALUES ('139', 'ua', 'Вибачте, Ви не можете переглядати цю лекцію. Щоб отримати доступ до цієї лекції, увійдіть у свій аккаунт та оплатіть доступ до лекції.');
INSERT INTO `messages` VALUES ('140', 'ua', 'Для початківців');
INSERT INTO `messages` VALUES ('141', 'ua', 'Для спеціалістів');
INSERT INTO `messages` VALUES ('142', 'ua', 'Для експертів');
INSERT INTO `messages` VALUES ('143', 'ua', 'Усі курси');
INSERT INTO `messages` VALUES ('144', 'ua', 'знижка');
INSERT INTO `messages` VALUES ('145', 'ua', 'Оцінка курсу:');
INSERT INTO `messages` VALUES ('146', 'ua', 'детальніше ...');
INSERT INTO `messages` VALUES ('147', 'ua', 'Вартість курсу: ');
INSERT INTO `messages` VALUES ('148', 'ua', 'Спочатку навчання створюється стійкий фундамент для підготовки програмістів: необхідні знання елементарної математики, будови комп’ютера і основ програмування.');
INSERT INTO `messages` VALUES ('149', 'ua', '<p>Потім вивчаються основні принципи програмування на базі класичних комп&rsquo;ютерних наук і методологій: алгоритмічна мова;елементи вищої та дискретної математики і комбінаторики; структури даних, розробка і аналіз алгоритмів.                                 \r\n<p>Після чого формується база для переходу до сучасних технологій програмування: об’єктно-орієнтоване програмування; проектування баз даних.\r\n<p>Завершення процесу підготовки шляхом конкретного застосування отриманих знань на реальних проектах із засвоєнням сучасних методів і технологій, які використовуються в ІТ індустрії компаніями.');
INSERT INTO `messages` VALUES ('1', 'en', 'INTITA');
INSERT INTO `messages` VALUES ('2', 'en', 'About Us');
INSERT INTO `messages` VALUES ('3', 'en', 'How to start studying?');
INSERT INTO `messages` VALUES ('4', 'en', 'more ...');
INSERT INTO `messages` VALUES ('5', 'en', 'PROGRAM THE FUTURE');
INSERT INTO `messages` VALUES ('6', 'en', 'Important information about studying with us');
INSERT INTO `messages` VALUES ('7', 'en', 'Five steps to implement your dreams');
INSERT INTO `messages` VALUES ('8', 'en', 'START />');
INSERT INTO `messages` VALUES ('9', 'en', 'Ready to get started?');
INSERT INTO `messages` VALUES ('10', 'en', 'Enter data into the form below');
INSERT INTO `messages` VALUES ('11', 'en', 'extended registration');
INSERT INTO `messages` VALUES ('12', 'en', 'You can also register by social networks:');
INSERT INTO `messages` VALUES ('13', 'en', 'START');
INSERT INTO `messages` VALUES ('14', 'en', 'Email');
INSERT INTO `messages` VALUES ('15', 'en', 'password');
INSERT INTO `messages` VALUES ('16', 'en', 'Courses');
INSERT INTO `messages` VALUES ('17', 'en', 'Forum');
INSERT INTO `messages` VALUES ('18', 'en', 'About Us');
INSERT INTO `messages` VALUES ('19', 'en', 'Enter');
INSERT INTO `messages` VALUES ('20', 'en', 'Exit');
INSERT INTO `messages` VALUES ('21', 'en', 'Teachers');
INSERT INTO `messages` VALUES ('22', 'en', 'Exit');
INSERT INTO `messages` VALUES ('23', 'en', 'phone: +38 0432 52 82 67');
INSERT INTO `messages` VALUES ('24', 'en', 'mobile: +38 067 432 50 20');
INSERT INTO `messages` VALUES ('25', 'en', 'e-mail: intita.hr@gmail.com');
INSERT INTO `messages` VALUES ('26', 'en', 'skype: int.ita');
INSERT INTO `messages` VALUES ('27', 'en', 'We guarantee you an offer of employment<br>\r\nafter successful completion of training!');
INSERT INTO `messages` VALUES ('28', 'en', 'Do not miss your chance to change the world - get high-quality and modern education<br>\r\nand become a specialist class!');
INSERT INTO `messages` VALUES ('29', 'en', 'One year of productive and interesting learning - and you will become a professional programmer<br>\r\nready work in the IT industry!');
INSERT INTO `messages` VALUES ('30', 'en', 'Do you want to become a high-class specialist?<br>\r\ntakes correct and informed decision - Learn with us!');
INSERT INTO `messages` VALUES ('31', 'en', 'Do not lose your chance for creative, interesting, and challenging decent work -<br>\r\nplan their professional future today!');
INSERT INTO `messages` VALUES ('32', 'en', 'What are you dreaming?');
INSERT INTO `messages` VALUES ('33', 'en', 'Future Studies');
INSERT INTO `messages` VALUES ('34', 'en', 'Important questions');
INSERT INTO `messages` VALUES ('35', 'en', 'Maybe this freedom to live their lives? Independently manage own time with opportunity to earn by doing things you love and get business and get meet the modern profession?');
INSERT INTO `messages` VALUES ('36', 'en', 'Unlike traditional schools, We do not teach for the sake of ratings. We work individually with each student to achieve 100% mastering the necessary knowledge.');
INSERT INTO `messages` VALUES ('37', 'en', 'We offer each of our graduate guaranteed receipt employment offers for 4-6 months after the successful completion of training.');
INSERT INTO `messages` VALUES ('38', 'en', 'Register Online');
INSERT INTO `messages` VALUES ('39', 'en', 'Choice of course or module');
INSERT INTO `messages` VALUES ('40', 'en', 'Payment for training');
INSERT INTO `messages` VALUES ('41', 'en', 'Mastering the material');
INSERT INTO `messages` VALUES ('42', 'en', 'Completion rate');
INSERT INTO `messages` VALUES ('43', 'en', 'step');
INSERT INTO `messages` VALUES ('44', 'en', 'To access the courses and pass free modules and classes register on the site. Registration will allow you to assess the quality and usability of our product that you will become a reliable partner and advisor in professional self-realization.');
INSERT INTO `messages` VALUES ('45', 'en', 'To become specialists in a certain direction and level (get professional specialization) choose to undergo appropriate course. If you are interested only deepen the knowledge in a particular area of ​​information technology, then choose the module to pass.\')');
INSERT INTO `messages` VALUES ('46', 'en', 'To start a course or module choose payment scheme (the entire amount for the course, payment modules, payment potrymestrovo, month, etc.) and make a payment convenient way to You (payment scheme or course module can be changed monthly as possible payment credit). ');
INSERT INTO `messages` VALUES ('47', 'en', 'The study material is possible by reading the text and / or viewing a video for each session. During the passage Intermediate classes perform tests. At the end of each session do the final test tasks. Each module ends with an individual project or exam. You can receive individual counseling teacher or advice online. ');
INSERT INTO `messages` VALUES ('48', 'en', 'The result of course is the command thesis project, performed together with other students (the team recommends that forms an independent or executive who approved topic and terms of reference of the project). Delivery Project peredzahyst and provides protection in the online mode with presentation design. After defending his diploma and recommendation for employment.');
INSERT INTO `messages` VALUES ('49', 'en', 'Home');
INSERT INTO `messages` VALUES ('50', 'en', 'Courses');
INSERT INTO `messages` VALUES ('51', 'en', 'About us');
INSERT INTO `messages` VALUES ('52', 'en', 'Teachers');
INSERT INTO `messages` VALUES ('53', 'en', 'Forum');
INSERT INTO `messages` VALUES ('54', 'en', 'Profile');
INSERT INTO `messages` VALUES ('55', 'en', 'Edit profile');
INSERT INTO `messages` VALUES ('56', 'en', 'Registration');
INSERT INTO `messages` VALUES ('57', 'en', 'Teacher profile');
INSERT INTO `messages` VALUES ('58', 'en', 'Our teachers');
INSERT INTO `messages` VALUES ('59', 'en', 'personal page');
INSERT INTO `messages` VALUES ('60', 'en', 'If you\'re a professional IT specialist and want to teach some courses or modules IT and cooperate with us in the field of training programmers write us a letter.');
INSERT INTO `messages` VALUES ('61', 'en', 'Conducts courses');
INSERT INTO `messages` VALUES ('62', 'en', 'Read more');
INSERT INTO `messages` VALUES ('63', 'en', 'Reviews');
INSERT INTO `messages` VALUES ('64', 'en', 'Section:');
INSERT INTO `messages` VALUES ('65', 'en', 'About the teacher:');
INSERT INTO `messages` VALUES ('66', 'en', 'Our courses');
INSERT INTO `messages` VALUES ('67', 'en', 'Training concept');
INSERT INTO `messages` VALUES ('68', 'en', 'Level: ');
INSERT INTO `messages` VALUES ('69', 'en', 'Language: ');
INSERT INTO `messages` VALUES ('70', 'en', 'Course:');
INSERT INTO `messages` VALUES ('71', 'en', 'lang:');
INSERT INTO `messages` VALUES ('72', 'en', 'Module:');
INSERT INTO `messages` VALUES ('73', 'en', 'Lecture ');
INSERT INTO `messages` VALUES ('74', 'en', 'Type:');
INSERT INTO `messages` VALUES ('75', 'en', 'Duration:');
INSERT INTO `messages` VALUES ('76', 'en', 'min');
INSERT INTO `messages` VALUES ('77', 'en', 'Teacher');
INSERT INTO `messages` VALUES ('78', 'en', 'more');
INSERT INTO `messages` VALUES ('79', 'en', 'Plan consultation');
INSERT INTO `messages` VALUES ('80', 'en', 'Content');
INSERT INTO `messages` VALUES ('81', 'en', 'show');
INSERT INTO `messages` VALUES ('82', 'en', 'hide');
INSERT INTO `messages` VALUES ('83', 'en', 'Videos');
INSERT INTO `messages` VALUES ('84', 'en', 'Sample code');
INSERT INTO `messages` VALUES ('85', 'en', 'User');
INSERT INTO `messages` VALUES ('86', 'en', 'Task');
INSERT INTO `messages` VALUES ('87', 'en', 'review the previous lesson');
INSERT INTO `messages` VALUES ('88', 'en', 'NEXT LECTURE');
INSERT INTO `messages` VALUES ('89', 'en', 'Reply');
INSERT INTO `messages` VALUES ('90', 'en', 'Final task');
INSERT INTO `messages` VALUES ('91', 'en', 'You can also enter by social networks:');
INSERT INTO `messages` VALUES ('92', 'en', 'Forget password?');
INSERT INTO `messages` VALUES ('93', 'en', 'SIGN IN');
INSERT INTO `messages` VALUES ('94', 'en', 'Status:');
INSERT INTO `messages` VALUES ('95', 'en', 'Student Profile');
INSERT INTO `messages` VALUES ('96', 'en', 'Edit </br> profile');
INSERT INTO `messages` VALUES ('97', 'en', ' years');
INSERT INTO `messages` VALUES ('98', 'en', ' year');
INSERT INTO `messages` VALUES ('99', 'en', ' years');
INSERT INTO `messages` VALUES ('100', 'en', 'About myself:');
INSERT INTO `messages` VALUES ('101', 'en', 'Email:');
INSERT INTO `messages` VALUES ('102', 'en', 'Phone:');
INSERT INTO `messages` VALUES ('103', 'en', 'Education:');
INSERT INTO `messages` VALUES ('104', 'en', 'Interests:');
INSERT INTO `messages` VALUES ('105', 'en', 'Where learned you:');
INSERT INTO `messages` VALUES ('106', 'en', 'Learning:');
INSERT INTO `messages` VALUES ('107', 'en', 'Completion of the course:');
INSERT INTO `messages` VALUES ('108', 'en', 'My courses');
INSERT INTO `messages` VALUES ('109', 'en', 'Timetable');
INSERT INTO `messages` VALUES ('110', 'en', 'Consultation');
INSERT INTO `messages` VALUES ('111', 'en', 'Exams');
INSERT INTO `messages` VALUES ('112', 'en', 'Projects');
INSERT INTO `messages` VALUES ('113', 'en', 'My rating');
INSERT INTO `messages` VALUES ('114', 'en', 'Downloads');
INSERT INTO `messages` VALUES ('115', 'en', 'Correspondence');
INSERT INTO `messages` VALUES ('116', 'en', 'My assessment');
INSERT INTO `messages` VALUES ('117', 'en', 'Finances');
INSERT INTO `messages` VALUES ('118', 'en', 'Current course:');
INSERT INTO `messages` VALUES ('119', 'en', 'Unfinished course:');
INSERT INTO `messages` VALUES ('120', 'en', 'Completed course:');
INSERT INTO `messages` VALUES ('121', 'en', 'Please make the following payments to');
INSERT INTO `messages` VALUES ('122', 'en', 'Amount of payment:');
INSERT INTO `messages` VALUES ('123', 'en', ' UAH');
INSERT INTO `messages` VALUES ('124', 'en', 'Individual modular project');
INSERT INTO `messages` VALUES ('125', 'en', 'Team thesis project');
INSERT INTO `messages` VALUES ('126', 'en', 'Type');
INSERT INTO `messages` VALUES ('127', 'en', 'Date');
INSERT INTO `messages` VALUES ('128', 'en', 'Time');
INSERT INTO `messages` VALUES ('129', 'en', 'Teacher');
INSERT INTO `messages` VALUES ('130', 'en', 'Theme');
INSERT INTO `messages` VALUES ('131', 'en', 'E');
INSERT INTO `messages` VALUES ('132', 'en', 'C');
INSERT INTO `messages` VALUES ('133', 'en', 'IMP');
INSERT INTO `messages` VALUES ('134', 'en', 'TTP');
INSERT INTO `messages` VALUES ('135', 'en', ' strong junior');
INSERT INTO `messages` VALUES ('136', 'en', ' ukrainian');
INSERT INTO `messages` VALUES ('137', 'en', 'Graduates');
INSERT INTO `messages` VALUES ('138', 'en', 'Sorry, you couldn\\\'t view this lecture.Please login for getting access to this material.');
INSERT INTO `messages` VALUES ('139', 'en', 'Sorry, you couldn\\\'t view this lecture.\r\nYou don\\\'t have access to this lecture.\r\nPlease go to your profile and pay access.');
INSERT INTO `messages` VALUES ('140', 'en', 'For beginners');
INSERT INTO `messages` VALUES ('141', 'en', 'For specialists');
INSERT INTO `messages` VALUES ('142', 'en', 'For experts');
INSERT INTO `messages` VALUES ('143', 'en', 'All courses');
INSERT INTO `messages` VALUES ('144', 'en', 'discount');
INSERT INTO `messages` VALUES ('145', 'en', 'Сourse rate:');
INSERT INTO `messages` VALUES ('146', 'en', 'details ...');
INSERT INTO `messages` VALUES ('147', 'en', 'Course price:');
INSERT INTO `messages` VALUES ('148', 'en', 'Firstly training creates a stable foundation for training programmers: requires knowledge of elementary mathematics, the structure of computer and computer science.');
INSERT INTO `messages` VALUES ('149', 'en', '<P>Then we study the basic principles of programming based on classic PC & raquo; Books sciences and methodologies algorithmic language, elements of higher and discrete mathematics and combinatorics; data structures, design and analysis of algorithms.\r\n<P> After that formed the basis for the transition to modern programming technologies: object-oriented programming; database design.\r\n<P> Completion of training by the specific application of knowledge to real projects with the assimilation of modern techniques and technologies used in the IT industry companies.');
INSERT INTO `messages` VALUES ('1', 'ru', 'INTITA');
INSERT INTO `messages` VALUES ('2', 'ru', 'О нас');
INSERT INTO `messages` VALUES ('3', 'ru', 'Как проходит обучение?');
INSERT INTO `messages` VALUES ('4', 'ru', 'далее ...');
INSERT INTO `messages` VALUES ('5', 'ru', 'ПРОГРАММИРУЙ БУДУЩЕЕ');
INSERT INTO `messages` VALUES ('6', 'ru', 'Важная информация про обучение вместе с нами');
INSERT INTO `messages` VALUES ('7', 'ru', 'Пять шагов к исполнения твоих желаний');
INSERT INTO `messages` VALUES ('8', 'ru', 'СТАРТ  />');
INSERT INTO `messages` VALUES ('9', 'ru', 'Готовы начать?');
INSERT INTO `messages` VALUES ('10', 'ru', 'Введите данные в форму ниже');
INSERT INTO `messages` VALUES ('11', 'ru', 'расширенная регистрация');
INSERT INTO `messages` VALUES ('12', 'ru', 'Вы также можете зарегистрироваться с помощью соцсетей:');
INSERT INTO `messages` VALUES ('13', 'ru', 'НАЧАТЬ');
INSERT INTO `messages` VALUES ('14', 'ru', 'Электронная почта');
INSERT INTO `messages` VALUES ('15', 'ru', 'Пароль');
INSERT INTO `messages` VALUES ('16', 'ru', 'Курсы');
INSERT INTO `messages` VALUES ('17', 'ru', 'Форум');
INSERT INTO `messages` VALUES ('18', 'ru', 'О нас');
INSERT INTO `messages` VALUES ('19', 'ru', 'Вход');
INSERT INTO `messages` VALUES ('20', 'ru', 'Выход');
INSERT INTO `messages` VALUES ('21', 'ru', 'Преподаватели');
INSERT INTO `messages` VALUES ('22', 'ru', 'Выход');
INSERT INTO `messages` VALUES ('23', 'ru', 'телефон: +38 0432 52 82 67 ');
INSERT INTO `messages` VALUES ('24', 'ru', 'тел. моб. +38 067 432 20 10');
INSERT INTO `messages` VALUES ('25', 'ru', 'e-mail: intita.hr@gmail.com');
INSERT INTO `messages` VALUES ('26', 'ru', 'скайп: int.ita');
INSERT INTO `messages` VALUES ('27', 'ru', 'Мы гарантируем получение предложения работы<br>\r\nпосле успешного завершения обучения!');
INSERT INTO `messages` VALUES ('28', 'ru', 'Хочешь стать классным специалистом?<br>\r\nпринимай правильное решение - поступай в IТ Академию  ИНТИТА!');
INSERT INTO `messages` VALUES ('29', 'ru', 'Один год упорного и интересного обучения - и ты станешь проессиональным программистом.<br>\r\nУчиться тяжело -зато легко найти работу!');
INSERT INTO `messages` VALUES ('30', 'ru', 'Не упускай свой шанс на достойную и интересную работу - <br>\r\nпрограммируй свое будущее уже сегодня!');
INSERT INTO `messages` VALUES ('31', 'ru', 'Текст на пятой картинке слайдера');
INSERT INTO `messages` VALUES ('32', 'ru', 'О чем ты мечтаешь?');
INSERT INTO `messages` VALUES ('33', 'ru', 'Обучение будущего');
INSERT INTO `messages` VALUES ('34', 'ru', 'Вопросы');
INSERT INTO `messages` VALUES ('35', 'ru', 'Может, это возможность жить своей жизнью? Самостоятельно распоряжаться своим временем с возможностью зарабатывать, занимаясь любимым делом и получать удовольстие от современной профессии?');
INSERT INTO `messages` VALUES ('36', 'ru', 'В отличие от традиционных заведений, мы не учим ради оценок. Мы индивидуально работаем с каждым студентом, чтобы достичь 100% усвоения необходимых знаний.');
INSERT INTO `messages` VALUES ('37', 'ru', 'Мы предлагаем каждому выпускнику гарантированное получение предложения работы в течении 4-6-ти месяцев после успешного завершения обучения.');
INSERT INTO `messages` VALUES ('38', 'ru', 'Регистрация на сайте');
INSERT INTO `messages` VALUES ('39', 'ru', 'Выбор курса или модуля');
INSERT INTO `messages` VALUES ('40', 'ru', 'Оплата');
INSERT INTO `messages` VALUES ('41', 'ru', 'Изучение материала');
INSERT INTO `messages` VALUES ('42', 'ru', 'Завершение курса');
INSERT INTO `messages` VALUES ('43', 'ru', 'шаг');
INSERT INTO `messages` VALUES ('44', 'ru', 'Чтобы получить доступ к курсам и пройти бесплатные модули и занятия зарегистрируйся на сайте. Регистрация позволит тебе оценить качество и удобство нашего продукт , который станет для тебя надежным партнером и советчиком в профессиональной самореализации.');
INSERT INTO `messages` VALUES ('45', 'ru', 'Чтобы стать специалистом определенного направления и уровня ( получить профессиональную специализацию ) выбери для прохождения соответствующий курс . Если Тебя интересует исключительно углубления знаний в определенном направлении информационных технологий , то выбери соответствующий модуль для прохождения .');
INSERT INTO `messages` VALUES ('46', 'ru', 'Чтобы начать прохождении курса модуля выбери схему оплаты ( вся сумма за курс , оплата модулей , оплата потриместрово , помесячно и т.д.) и исполни оплату удобным Тебе способом ( схему оплаты курса или модуля можно изменять , также возможна помесячная оплата в кредит ) .');
INSERT INTO `messages` VALUES ('47', 'ru', 'Вивчення матеріалу можливе шляхом читання тексту чи/і перегляду відео для кожного заняття. Під час проходження заняття виконуй Проміжні тестові завдання. По завершенню кожного заняття виконуй Підсумкове тестове завдання. Кожен модуль завершується Індивідуальним проектом чи Екзаменом. 	Можна отримати індивідуальну консультацію викладача чи консультацію онлайн.');
INSERT INTO `messages` VALUES ('48', 'ru', 'Підсумком курсу є Командний дипломний проект, який виконується разом з іншими студентами (склад команди формуєш самостійно чи рекомендує керівник, який затверджує тему і технічне завдання проекту). Здача проекту передбачає передзахист та захист в он-лайн режимі із представленням технічної документації. Після захисту видається диплом та рекомендація для працевлаштування.');
INSERT INTO `messages` VALUES ('49', 'ru', 'Главная');
INSERT INTO `messages` VALUES ('50', 'ru', 'Курсы');
INSERT INTO `messages` VALUES ('51', 'ru', 'О нас');
INSERT INTO `messages` VALUES ('52', 'ru', 'Преподаватели');
INSERT INTO `messages` VALUES ('53', 'ru', 'Форум');
INSERT INTO `messages` VALUES ('54', 'ru', 'Профиль');
INSERT INTO `messages` VALUES ('55', 'ru', 'Редактировать профиль');
INSERT INTO `messages` VALUES ('56', 'ru', 'Регистрация');
INSERT INTO `messages` VALUES ('57', 'ru', 'Профиль преподавателя');
INSERT INTO `messages` VALUES ('58', 'ru', 'Наши преподаватели');
INSERT INTO `messages` VALUES ('59', 'ru', 'персональная страница');
INSERT INTO `messages` VALUES ('60', 'ru', 'Если Вы профессиональный ІТ-шник и хотите преподавать некоторые ІТ курсы и сотрудничать с нами в подготовке программистов, напишите нам письмо.');
INSERT INTO `messages` VALUES ('61', 'ru', 'Ведет курсы:');
INSERT INTO `messages` VALUES ('62', 'ru', 'Читать полностью');
INSERT INTO `messages` VALUES ('63', 'ru', 'Отзывы');
INSERT INTO `messages` VALUES ('64', 'ru', 'Раздел:');
INSERT INTO `messages` VALUES ('65', 'ru', 'О преподавателе:');
INSERT INTO `messages` VALUES ('66', 'ru', 'Наши курсы');
INSERT INTO `messages` VALUES ('67', 'ru', 'Концепция подготовки');
INSERT INTO `messages` VALUES ('68', 'ru', 'Уровень курса:');
INSERT INTO `messages` VALUES ('69', 'ru', 'Язык курса:');
INSERT INTO `messages` VALUES ('70', 'ru', 'Курс:');
INSERT INTO `messages` VALUES ('71', 'ru', 'язык:');
INSERT INTO `messages` VALUES ('72', 'ru', 'Модуль:');
INSERT INTO `messages` VALUES ('73', 'ru', 'Занятие ');
INSERT INTO `messages` VALUES ('74', 'ru', 'Тип:');
INSERT INTO `messages` VALUES ('75', 'ru', 'Время:');
INSERT INTO `messages` VALUES ('76', 'ru', 'мин');
INSERT INTO `messages` VALUES ('77', 'ru', 'Преподаватель');
INSERT INTO `messages` VALUES ('78', 'ru', 'детальнее');
INSERT INTO `messages` VALUES ('79', 'ru', 'Запланировать консультацию');
INSERT INTO `messages` VALUES ('80', 'ru', 'Содержание');
INSERT INTO `messages` VALUES ('81', 'ru', 'показать');
INSERT INTO `messages` VALUES ('82', 'ru', 'скрыть');
INSERT INTO `messages` VALUES ('83', 'ru', 'Видео');
INSERT INTO `messages` VALUES ('84', 'ru', 'Пример кода');
INSERT INTO `messages` VALUES ('85', 'ru', 'Инструкция');
INSERT INTO `messages` VALUES ('86', 'ru', 'Задание');
INSERT INTO `messages` VALUES ('87', 'ru', 'просмотреть снова предыдущий урок');
INSERT INTO `messages` VALUES ('88', 'ru', 'НАСТУПНИЙ УРОК');
INSERT INTO `messages` VALUES ('89', 'ru', 'Ответить');
INSERT INTO `messages` VALUES ('90', 'ru', 'Итоговое задание');
INSERT INTO `messages` VALUES ('91', 'ru', 'Вы также можете ввойти с помощью соцсетей:');
INSERT INTO `messages` VALUES ('92', 'ru', 'Забыли пароль?');
INSERT INTO `messages` VALUES ('93', 'ru', 'ВОЙТИ');
INSERT INTO `messages` VALUES ('94', 'ru', 'Статус курса: ');
INSERT INTO `messages` VALUES ('95', 'ru', 'Профиль студента');
INSERT INTO `messages` VALUES ('96', 'ru', 'Редактировать </br> профиль');
INSERT INTO `messages` VALUES ('97', 'ru', ' лет');
INSERT INTO `messages` VALUES ('98', 'ru', ' год');
INSERT INTO `messages` VALUES ('99', 'ru', ' года');
INSERT INTO `messages` VALUES ('100', 'ru', 'Про себя:');
INSERT INTO `messages` VALUES ('101', 'ru', 'Электронная почта:');
INSERT INTO `messages` VALUES ('102', 'ru', 'Телефон:');
INSERT INTO `messages` VALUES ('103', 'ru', 'Образование:');
INSERT INTO `messages` VALUES ('104', 'ru', 'Интересы:');
INSERT INTO `messages` VALUES ('105', 'ru', 'Откуда узнал о Вас:');
INSERT INTO `messages` VALUES ('106', 'ru', 'Форма обучения:');
INSERT INTO `messages` VALUES ('107', 'ru', 'Завершенные курсы:');
INSERT INTO `messages` VALUES ('108', 'ru', 'Мои курсы');
INSERT INTO `messages` VALUES ('109', 'ru', 'Расписание');
INSERT INTO `messages` VALUES ('110', 'ru', 'Консультации');
INSERT INTO `messages` VALUES ('111', 'ru', 'Экзамены');
INSERT INTO `messages` VALUES ('112', 'ru', 'Проекты');
INSERT INTO `messages` VALUES ('113', 'ru', 'Мой рейтинг');
INSERT INTO `messages` VALUES ('114', 'ru', 'Загрузки');
INSERT INTO `messages` VALUES ('115', 'ru', 'Переписка');
INSERT INTO `messages` VALUES ('116', 'ru', 'Мои оценки');
INSERT INTO `messages` VALUES ('117', 'ru', 'Финансы');
INSERT INTO `messages` VALUES ('118', 'ru', 'Текущий курс:');
INSERT INTO `messages` VALUES ('119', 'ru', 'Незавершенный курс:');
INSERT INTO `messages` VALUES ('120', 'ru', 'Завершен курс:');
INSERT INTO `messages` VALUES ('121', 'ru', 'Необходимо осуществить следующую проплату до');
INSERT INTO `messages` VALUES ('122', 'ru', 'Сумма оплаты:');
INSERT INTO `messages` VALUES ('123', 'ru', ' грн');
INSERT INTO `messages` VALUES ('124', 'ru', 'Индивидуальный модульный проект');
INSERT INTO `messages` VALUES ('125', 'ru', 'Командный дипломный проект');
INSERT INTO `messages` VALUES ('126', 'ru', 'Тип');
INSERT INTO `messages` VALUES ('127', 'ru', 'Дата');
INSERT INTO `messages` VALUES ('128', 'ru', 'Время');
INSERT INTO `messages` VALUES ('129', 'ru', 'Преподаватель');
INSERT INTO `messages` VALUES ('130', 'ru', 'Тема');
INSERT INTO `messages` VALUES ('131', 'ru', 'Э');
INSERT INTO `messages` VALUES ('132', 'ru', 'К');
INSERT INTO `messages` VALUES ('133', 'ru', 'ИМП');
INSERT INTO `messages` VALUES ('134', 'ru', 'КДП');
INSERT INTO `messages` VALUES ('135', 'ru', ' начинающий сильный');
INSERT INTO `messages` VALUES ('136', 'ru', ' украинский');
INSERT INTO `messages` VALUES ('137', 'ru', 'Выпускники');
INSERT INTO `messages` VALUES ('138', 'ru', 'Извините, Вы не можете просматривать эту лекцию. Пожалуйста, зарестрируйтесь для доступа к этой лекции.');
INSERT INTO `messages` VALUES ('139', 'ru', 'Извините, Вы не можете просматривать эту лекцию. Вы не имеете доступа к этой лекции. Пожалуйста, зайдите в свой аккаунт и оплатите доступ.');
INSERT INTO `messages` VALUES ('140', 'ru', 'Для начинающих');
INSERT INTO `messages` VALUES ('141', 'ru', 'Для специалистов');
INSERT INTO `messages` VALUES ('142', 'ru', 'Для экспертов');
INSERT INTO `messages` VALUES ('143', 'ru', 'Все курсы');
INSERT INTO `messages` VALUES ('144', 'ru', 'скидка');
INSERT INTO `messages` VALUES ('145', 'ru', 'Оценка курса:');
INSERT INTO `messages` VALUES ('146', 'ru', 'детальнее ...');
INSERT INTO `messages` VALUES ('147', 'ru', 'Стоимость курса:');
INSERT INTO `messages` VALUES ('148', 'ru', 'В начале обучения формируется стойкий фундамент для подготовки программистов: необходимые знания элементарной математики, устройства компьютера и основ информатики.');
INSERT INTO `messages` VALUES ('149', 'ru', '<p>Потом изучаются основные принципы программирования на базе классических компьютерних наук и методологий: алгоритмический язык; элементы высшей и дискретной математики, комбинаторики; структуры данных, разработка и анализ алгоритмов.\r\n<P> После чего формируется база для перехода к современным технологиям программирования: объектно-ориентированное программирование; проектирования баз данных.\r\n<P> Завершением процесса подготовки есть конкретное применение полученных знаний на реальных проектах с усвоением современных методов и технологий, используемых в ИТ индустрии компаниями.');
INSERT INTO `messages` VALUES ('150', 'ua', 'Персональні дані');
INSERT INTO `messages` VALUES ('150', 'ru', 'Персональные данные');
INSERT INTO `messages` VALUES ('150', 'en', 'Personal info');
INSERT INTO `messages` VALUES ('151', 'ua', 'Студент');
INSERT INTO `messages` VALUES ('151', 'ru', 'Студент');
INSERT INTO `messages` VALUES ('151', 'en', 'Student');
INSERT INTO `messages` VALUES ('152', 'ua', 'введіть в форматі дд/мм/рррр');
INSERT INTO `messages` VALUES ('152', 'ru', 'введите в формате дд/мм/гггг');
INSERT INTO `messages` VALUES ('152', 'en', 'enter as dd/mm/yyyy');
INSERT INTO `messages` VALUES ('153', 'ua', 'введіть Ваші інтереси (через кому)');
INSERT INTO `messages` VALUES ('153', 'ru', 'введите Ваши интересы (через запятую)');
INSERT INTO `messages` VALUES ('153', 'en', 'enter Your interests ');
INSERT INTO `messages` VALUES ('154', 'ua', 'звідки Ви про нас дізналися?');
INSERT INTO `messages` VALUES ('154', 'en', 'where you hear about us?');
INSERT INTO `messages` VALUES ('154', 'ru', 'откуда Вы о нас узнали?');
INSERT INTO `messages` VALUES ('155', 'ua', 'ВІДПРАВИТИ');
INSERT INTO `messages` VALUES ('155', 'ru', 'ОТПРАВИТЬ');
INSERT INTO `messages` VALUES ('155', 'en', 'SEND');
INSERT INTO `messages` VALUES ('156', 'ua', 'Завантажити фото профілю');
INSERT INTO `messages` VALUES ('156', 'ru', 'Загрузить фото профиля');
INSERT INTO `messages` VALUES ('156', 'en', 'Download your profile avatar');
INSERT INTO `messages` VALUES ('157', 'ua', 'ВИБЕРІТЬ ФАЙЛ');
INSERT INTO `messages` VALUES ('157', 'ru', 'ВЫБЕРИТЕ ФАЙЛ');
INSERT INTO `messages` VALUES ('157', 'en', 'CHOOSE FILE');
INSERT INTO `messages` VALUES ('158', 'ua', 'Розмір фото до 512Kб');
INSERT INTO `messages` VALUES ('158', 'ru', 'Размер фото до 512Kб');
INSERT INTO `messages` VALUES ('158', 'en', 'Photo size to 512Kb');
INSERT INTO `messages` VALUES ('159', 'ua', 'Файл не вибрано...');
INSERT INTO `messages` VALUES ('159', 'ru', 'Файл не выбран...');
INSERT INTO `messages` VALUES ('159', 'en', 'The file is not selected');
INSERT INTO `messages` VALUES ('160', 'ua', 'І\'мя');
INSERT INTO `messages` VALUES ('160', 'ru', 'Имя');
INSERT INTO `messages` VALUES ('160', 'en', 'Name');
INSERT INTO `messages` VALUES ('161', 'ua', 'Роль');
INSERT INTO `messages` VALUES ('161', 'ru', 'Роль');
INSERT INTO `messages` VALUES ('161', 'en', 'Role');
INSERT INTO `messages` VALUES ('162', 'ua', 'Прізвище');
INSERT INTO `messages` VALUES ('162', 'ru', 'Фамилия');
INSERT INTO `messages` VALUES ('162', 'en', 'Last name');
INSERT INTO `messages` VALUES ('163', 'ua', 'Нік');
INSERT INTO `messages` VALUES ('163', 'ru', 'Ник');
INSERT INTO `messages` VALUES ('163', 'en', 'Nickname');
INSERT INTO `messages` VALUES ('164', 'ua', 'Дата народження');
INSERT INTO `messages` VALUES ('164', 'ru', 'Дата рождения');
INSERT INTO `messages` VALUES ('164', 'en', 'Date of birth');
INSERT INTO `messages` VALUES ('165', 'ua', 'Телефон');
INSERT INTO `messages` VALUES ('165', 'ru', 'Телефон');
INSERT INTO `messages` VALUES ('165', 'en', 'Phone');
INSERT INTO `messages` VALUES ('166', 'ua', 'Адреса');
INSERT INTO `messages` VALUES ('166', 'ru', 'Адрес');
INSERT INTO `messages` VALUES ('166', 'en', 'Address');
INSERT INTO `messages` VALUES ('167', 'ua', 'Освіта');
INSERT INTO `messages` VALUES ('167', 'ru', 'Образование');
INSERT INTO `messages` VALUES ('167', 'en', 'Education');
INSERT INTO `messages` VALUES ('168', 'ua', 'Форма навчання');
INSERT INTO `messages` VALUES ('168', 'ru', 'Форма обучения');
INSERT INTO `messages` VALUES ('168', 'en', 'Education form');
INSERT INTO `messages` VALUES ('169', 'ua', 'Захоплення');
INSERT INTO `messages` VALUES ('169', 'ru', 'Увлечения');
INSERT INTO `messages` VALUES ('169', 'en', 'Interests');
INSERT INTO `messages` VALUES ('170', 'ua', 'Про себе');
INSERT INTO `messages` VALUES ('170', 'ru', 'О себе');
INSERT INTO `messages` VALUES ('170', 'en', 'About myself');
INSERT INTO `messages` VALUES ('171', 'ua', 'Пароль');
INSERT INTO `messages` VALUES ('171', 'ru', 'Пароль');
INSERT INTO `messages` VALUES ('171', 'en', 'Password');
INSERT INTO `messages` VALUES ('172', 'ua', 'Повтор пароля');
INSERT INTO `messages` VALUES ('172', 'ru', 'Повтор пароля');
INSERT INTO `messages` VALUES ('172', 'en', 'Repeat password');
INSERT INTO `messages` VALUES ('173', 'ua', 'ЗБЕРЕГТИ');
INSERT INTO `messages` VALUES ('173', 'ru', 'СОХРАНИТЬ');
INSERT INTO `messages` VALUES ('173', 'en', 'SAVE');
INSERT INTO `messages` VALUES ('174', 'ua', 'І\'мя');
INSERT INTO `messages` VALUES ('174', 'ru', 'Имя');
INSERT INTO `messages` VALUES ('174', 'en', 'Name');
INSERT INTO `messages` VALUES ('175', 'ua', 'Прізвище');
INSERT INTO `messages` VALUES ('175', 'ru', 'Фамилия');
INSERT INTO `messages` VALUES ('175', 'en', 'Last name');
INSERT INTO `messages` VALUES ('176', 'ua', 'Вік');
INSERT INTO `messages` VALUES ('176', 'ru', 'Возраст');
INSERT INTO `messages` VALUES ('176', 'en', 'Age');
INSERT INTO `messages` VALUES ('177', 'ua', 'Освіта');
INSERT INTO `messages` VALUES ('177', 'ru', 'Образование');
INSERT INTO `messages` VALUES ('177', 'en', 'Education');
INSERT INTO `messages` VALUES ('178', 'ua', 'Телефон');
INSERT INTO `messages` VALUES ('178', 'ru', 'Телефон');
INSERT INTO `messages` VALUES ('178', 'en', 'Phone');
INSERT INTO `messages` VALUES ('179', 'ua', 'Які курси Ви готові викладати');
INSERT INTO `messages` VALUES ('179', 'ru', 'Какие курсы Вы готовы преподавать');
INSERT INTO `messages` VALUES ('179', 'en', 'What courses you ready to teach ');
INSERT INTO `messages` VALUES ('180', 'ua', 'Відправити');
INSERT INTO `messages` VALUES ('180', 'ru', 'Отправить');
INSERT INTO `messages` VALUES ('180', 'en', 'Send');
INSERT INTO `messages` VALUES ('181', 'ua', 'Відгуки студентів про викладача:');
INSERT INTO `messages` VALUES ('181', 'ru', 'Отзывы студентов о преподавателе:');
INSERT INTO `messages` VALUES ('181', 'en', 'Guest students of the teacher:');
INSERT INTO `messages` VALUES ('182', 'ua', 'Середня оцінка: ');
INSERT INTO `messages` VALUES ('182', 'ru', 'Средний балл:');
INSERT INTO `messages` VALUES ('182', 'en', 'Average rate:');
INSERT INTO `messages` VALUES ('183', 'ua', 'Знання: ');
INSERT INTO `messages` VALUES ('183', 'ru', 'Знания:');
INSERT INTO `messages` VALUES ('183', 'en', 'Knowledge:');
INSERT INTO `messages` VALUES ('184', 'ua', 'Ефективність: ');
INSERT INTO `messages` VALUES ('184', 'ru', 'Эффективность:');
INSERT INTO `messages` VALUES ('184', 'en', 'Efficiency:');
INSERT INTO `messages` VALUES ('185', 'ua', 'Відношення до студента: ');
INSERT INTO `messages` VALUES ('185', 'ru', 'Отношение к студенту:');
INSERT INTO `messages` VALUES ('185', 'en', 'Relationship to student:');
INSERT INTO `messages` VALUES ('186', 'ua', 'Оцінка: ');
INSERT INTO `messages` VALUES ('186', 'ru', 'Оценка:');
INSERT INTO `messages` VALUES ('186', 'en', 'Rate:');
INSERT INTO `messages` VALUES ('187', 'ua', 'Твій відгук');
INSERT INTO `messages` VALUES ('187', 'ru', 'Твой отзыв');
INSERT INTO `messages` VALUES ('187', 'en', 'Your review:');
INSERT INTO `messages` VALUES ('188', 'ua', 'Ваша оцінка');
INSERT INTO `messages` VALUES ('188', 'ru', 'Ваша оценка');
INSERT INTO `messages` VALUES ('188', 'en', 'Your rate');
INSERT INTO `messages` VALUES ('189', 'ua', 'Знання викладача:');
INSERT INTO `messages` VALUES ('189', 'ru', 'Знания преподавателя:');
INSERT INTO `messages` VALUES ('189', 'en', 'Teacher knowledge:');
INSERT INTO `messages` VALUES ('190', 'ua', 'Ефективність: ');
INSERT INTO `messages` VALUES ('190', 'ru', 'Эффективность:');
INSERT INTO `messages` VALUES ('190', 'en', 'Efficiency:');
INSERT INTO `messages` VALUES ('191', 'ua', 'Ставлення до студента:');
INSERT INTO `messages` VALUES ('191', 'ru', 'Отношение к студенту:');
INSERT INTO `messages` VALUES ('191', 'en', 'Relationship to student:');
INSERT INTO `messages` VALUES ('192', 'ua', 'Відправити');
INSERT INTO `messages` VALUES ('192', 'ru', 'Отправить');
INSERT INTO `messages` VALUES ('192', 'en', 'Send');
INSERT INTO `messages` VALUES ('193', 'ua', 'Рівень курсу: ');
INSERT INTO `messages` VALUES ('193', 'ru', 'Уровень курса:');
INSERT INTO `messages` VALUES ('193', 'en', 'Course rate:');
INSERT INTO `messages` VALUES ('194', 'ua', 'Тривалість курсу: ');
INSERT INTO `messages` VALUES ('194', 'ru', 'Длительность курса:');
INSERT INTO `messages` VALUES ('194', 'en', 'Course duration:');
INSERT INTO `messages` VALUES ('195', 'ua', '');
INSERT INTO `messages` VALUES ('195', 'ru', '');
INSERT INTO `messages` VALUES ('195', 'en', '');
INSERT INTO `messages` VALUES ('196', 'ua', 'Схеми проплат');
INSERT INTO `messages` VALUES ('196', 'ru', 'Схемы оплаты');
INSERT INTO `messages` VALUES ('196', 'en', 'Ways of pay');
INSERT INTO `messages` VALUES ('197', 'ua', 'за весь курс наперед:');
INSERT INTO `messages` VALUES ('197', 'ru', 'за весь курс наперед:');
INSERT INTO `messages` VALUES ('197', 'en', 'for the entire course:');
INSERT INTO `messages` VALUES ('198', 'ua', '2 проплати за курс:');
INSERT INTO `messages` VALUES ('198', 'ru', '2 оплаты за курс:');
INSERT INTO `messages` VALUES ('198', 'en', '2 pays for course:');
INSERT INTO `messages` VALUES ('199', 'ua', '4 проплати за курс:');
INSERT INTO `messages` VALUES ('199', 'ru', '4 оплаты за курс:');
INSERT INTO `messages` VALUES ('199', 'en', '4 pays for course:');
INSERT INTO `messages` VALUES ('200', 'ua', 'помісячно:');
INSERT INTO `messages` VALUES ('200', 'ru', 'ежемесячно:');
INSERT INTO `messages` VALUES ('200', 'en', 'every month:');
INSERT INTO `messages` VALUES ('201', 'ua', 'кредит на 2 роки:');
INSERT INTO `messages` VALUES ('201', 'ru', 'кредит на 2 года:');
INSERT INTO `messages` VALUES ('201', 'en', 'credit for 2 years:');
INSERT INTO `messages` VALUES ('202', 'ua', 'кредит на 3 роки:');
INSERT INTO `messages` VALUES ('202', 'ru', 'кредит на 3 года:');
INSERT INTO `messages` VALUES ('202', 'en', 'credit for 3 years:');
INSERT INTO `messages` VALUES ('203', 'ua', 'Середня оцінка: ');
INSERT INTO `messages` VALUES ('203', 'ru', 'Средняя оценка:');
INSERT INTO `messages` VALUES ('203', 'en', 'Avarage rate:');
INSERT INTO `messages` VALUES ('204', 'ua', 'Для кого:');
INSERT INTO `messages` VALUES ('204', 'ru', 'Для кого:');
INSERT INTO `messages` VALUES ('204', 'en', 'For whom:');
INSERT INTO `messages` VALUES ('205', 'ua', 'Чому Ти навчишся?');
INSERT INTO `messages` VALUES ('205', 'ru', 'Чему Ты научишься?');
INSERT INTO `messages` VALUES ('205', 'en', 'Why do you learn ?');
INSERT INTO `messages` VALUES ('206', 'ua', 'Що Ти отримаєш?');
INSERT INTO `messages` VALUES ('206', 'ru', 'Что ты получишь?');
INSERT INTO `messages` VALUES ('206', 'en', 'What you get?');
INSERT INTO `messages` VALUES ('207', 'ua', 'Викладачі');
INSERT INTO `messages` VALUES ('207', 'ru', 'Преподаватели');
INSERT INTO `messages` VALUES ('207', 'en', 'Teachers');
INSERT INTO `messages` VALUES ('208', 'ua', 'Модуль');
INSERT INTO `messages` VALUES ('208', 'ru', 'Модуль');
INSERT INTO `messages` VALUES ('208', 'en', 'Module');
INSERT INTO `messages` VALUES ('209', 'ua', 'орієнтовно');
INSERT INTO `messages` VALUES ('209', 'ru', 'около');
INSERT INTO `messages` VALUES ('209', 'en', 'approximately');
INSERT INTO `messages` VALUES ('210', 'ua', 'знижка');
INSERT INTO `messages` VALUES ('210', 'ru', 'скидка');
INSERT INTO `messages` VALUES ('210', 'en', 'discount');
INSERT INTO `messages` VALUES ('211', 'ua', 'Модуль:');
INSERT INTO `messages` VALUES ('211', 'ru', 'Модуль:');
INSERT INTO `messages` VALUES ('211', 'en', 'Module:');
INSERT INTO `messages` VALUES ('212', 'ua', 'Заняття:');
INSERT INTO `messages` VALUES ('212', 'ru', 'Занятие:');
INSERT INTO `messages` VALUES ('212', 'en', 'Lectures:');
INSERT INTO `messages` VALUES ('213', 'ua', 'Тривалість:');
INSERT INTO `messages` VALUES ('213', 'ru', 'Длительность:');
INSERT INTO `messages` VALUES ('213', 'en', 'Duration:');
INSERT INTO `messages` VALUES ('214', 'ua', 'Рівень модуля:');
INSERT INTO `messages` VALUES ('214', 'ru', 'Уровень модуля:');
INSERT INTO `messages` VALUES ('214', 'en', 'Level module:');
INSERT INTO `messages` VALUES ('215', 'ua', 'Тривалість модуля:');
INSERT INTO `messages` VALUES ('215', 'ru', 'Длительность модуля:');
INSERT INTO `messages` VALUES ('215', 'en', 'Duration module:');
INSERT INTO `messages` VALUES ('216', 'ua', 'занять');
INSERT INTO `messages` VALUES ('216', 'ru', 'занятий');
INSERT INTO `messages` VALUES ('216', 'en', 'lectures');
INSERT INTO `messages` VALUES ('217', 'ua', 'орієнтовно');
INSERT INTO `messages` VALUES ('217', 'ru', 'ориентировочно');
INSERT INTO `messages` VALUES ('217', 'en', 'approximately');
INSERT INTO `messages` VALUES ('218', 'ua', 'міс.');
INSERT INTO `messages` VALUES ('218', 'ru', 'мес.');
INSERT INTO `messages` VALUES ('218', 'en', 'months');
INSERT INTO `messages` VALUES ('219', 'ua', 'год./день');
INSERT INTO `messages` VALUES ('219', 'ru', 'ч. / день');
INSERT INTO `messages` VALUES ('219', 'en', 'hr. / day');
INSERT INTO `messages` VALUES ('220', 'ua', 'дні/тиждень');
INSERT INTO `messages` VALUES ('220', 'ru', 'дня / неделю');
INSERT INTO `messages` VALUES ('220', 'en', 'days / week');
INSERT INTO `messages` VALUES ('221', 'ua', 'Вартість модуля:');
INSERT INTO `messages` VALUES ('221', 'ru', 'Cтоимость модуля:');
INSERT INTO `messages` VALUES ('221', 'en', 'Cost module:');
INSERT INTO `messages` VALUES ('222', 'ua', 'грн.');
INSERT INTO `messages` VALUES ('222', 'ru', 'грн.');
INSERT INTO `messages` VALUES ('222', 'en', 'UAH');
INSERT INTO `messages` VALUES ('223', 'ua', 'в межах курсу');
INSERT INTO `messages` VALUES ('223', 'ru', 'в рамках курса');
INSERT INTO `messages` VALUES ('223', 'en', 'within a year');
INSERT INTO `messages` VALUES ('224', 'ua', 'Оцінка:');
INSERT INTO `messages` VALUES ('224', 'ru', 'Оценка:');
INSERT INTO `messages` VALUES ('224', 'en', 'Rating:');
INSERT INTO `messages` VALUES ('225', 'ua', 'Заняття модуля');
INSERT INTO `messages` VALUES ('225', 'ru', 'Занятия модуля');
INSERT INTO `messages` VALUES ('225', 'en', 'Lectures module');
INSERT INTO `messages` VALUES ('227', 'ua', 'Викладач:');
INSERT INTO `messages` VALUES ('227', 'ru', 'Преподаватель:');
INSERT INTO `messages` VALUES ('227', 'en', 'Teacher:');
INSERT INTO `messages` VALUES ('228', 'ru', 'персональная страница');
INSERT INTO `messages` VALUES ('228', 'en', 'personal page');
INSERT INTO `messages` VALUES ('228', 'ua', 'персональна сторінка');
INSERT INTO `messages` VALUES ('226', 'ru', 'Занятие');
INSERT INTO `messages` VALUES ('226', 'en', 'Lecture');
INSERT INTO `messages` VALUES ('226', 'ua', 'Заняття');
INSERT INTO `messages` VALUES ('229', 'ua', '<p>Потім вивчаються основні принципи програмування на базі класичних комп&rsquo;ютерних наук і методологій: алгоритмічна мова;елементи вищої та дискретної математики і комбінаторики; структури даних, розробка і аналіз алгоритмів.\" +\r\n                                  \"<p>Після чого формується база для переходу до сучасних технологій програмування: об’єктно-орієнтоване програмування; проектування баз даних.\" +\r\n                                   \"<p>Завершення процесу підготовки шляхом конкретного застосування отриманих знань на реальних проектах із засвоєнням сучасних методів і технологій, які використовуються в ІТ індустрії компаніями.');
INSERT INTO `messages` VALUES ('229', 'ru', '<P> Затем изучаются основные принципы программирования на базе классических комп & rsquo; ютерних наук и методологий: алгоритмический язык; элементы высшего и дискретной математики и комбинаторики; структуры данных, разработка и анализ алгоритмов. \"+\r\n                                  \"<P> После чего формируется база для перехода к современным технологиям программирования: объектно-ориентированное программирование, проектирование баз данных.\" +\r\n                                   \"<P> Завершение процесса подготовки путем конкретного применения полученных знаний на реальных проектах с усвоением современных методов и технологий, используемых в ИТ индустрии компаниями.');
INSERT INTO `messages` VALUES ('229', 'en', '<P> Then we study the basic principles of programming based on classic computer books sciences and methodologies algorithmic language, elements of higher and discrete mathematics and combinatorics; data structures, design and analysis of algorithms. \"+\r\n                                  \"<P> After that formed the basis for the transition to modern programming technologies, object-oriented programming, database design.\" +\r\n                                   \"<P> Completion of training by specific application of knowledge to real projects with the assimilation of modern methods and technologies used in IT industry companies.');
INSERT INTO `messages` VALUES ('230', 'ua', 'розробляється');
INSERT INTO `messages` VALUES ('230', 'ru', 'в разработке');
INSERT INTO `messages` VALUES ('230', 'en', 'in develop');
INSERT INTO `messages` VALUES ('231', 'ua', 'доступний');
INSERT INTO `messages` VALUES ('231', 'ru', 'доступен');
INSERT INTO `messages` VALUES ('231', 'en', 'available');
INSERT INTO `messages` VALUES ('232', 'ua', 'стажер');
INSERT INTO `messages` VALUES ('232', 'ru', 'стажер');
INSERT INTO `messages` VALUES ('232', 'en', 'intern');
INSERT INTO `messages` VALUES ('233', 'ua', 'початківець');
INSERT INTO `messages` VALUES ('233', 'ru', 'начинающий');
INSERT INTO `messages` VALUES ('233', 'en', 'junior');
INSERT INTO `messages` VALUES ('234', 'ua', 'сильний початківець');
INSERT INTO `messages` VALUES ('234', 'ru', 'начинающий сильный');
INSERT INTO `messages` VALUES ('234', 'en', 'strong junior');
INSERT INTO `messages` VALUES ('235', 'ua', 'середній');
INSERT INTO `messages` VALUES ('235', 'ru', 'средний');
INSERT INTO `messages` VALUES ('235', 'en', 'middle');
INSERT INTO `messages` VALUES ('236', 'ua', 'високий');
INSERT INTO `messages` VALUES ('236', 'ru', 'высокий');
INSERT INTO `messages` VALUES ('236', 'en', 'senior');
INSERT INTO `messages` VALUES ('241', 'ua', 'Профіль викладача');
INSERT INTO `messages` VALUES ('241', 'ru', 'Профиль преподавателя');
INSERT INTO `messages` VALUES ('241', 'en', 'Teacher profile');
INSERT INTO `messages` VALUES ('246', 'ua', 'Ім\'я або id Vkontakte');
INSERT INTO `messages` VALUES ('246', 'ru', 'Имя или id Vkontakte');
INSERT INTO `messages` VALUES ('245', 'en', 'Id on LinkedIn (for example in / username)');
INSERT INTO `messages` VALUES ('247', 'ua', 'Ім\'я или id профиля Twitter');
INSERT INTO `messages` VALUES ('247', 'ru', 'Имя профиля Twitter');
INSERT INTO `messages` VALUES ('254', 'ua', 'Мої розрахунки');
INSERT INTO `messages` VALUES ('254', 'ru', 'Мои расчеты');
INSERT INTO `messages` VALUES ('254', 'en', 'My finance');
INSERT INTO `messages` VALUES ('255', 'ua', 'Проплати:');
INSERT INTO `messages` VALUES ('255', 'ru', 'Проплаты:');
INSERT INTO `messages` VALUES ('255', 'en', 'Payment:');
INSERT INTO `messages` VALUES ('256', 'ua', 'проплачені повністю');
INSERT INTO `messages` VALUES ('256', 'ru', 'проплаченные полностью');
INSERT INTO `messages` VALUES ('256', 'en', 'are paid completely');
INSERT INTO `messages` VALUES ('257', 'ua', 'проплачені частково');
INSERT INTO `messages` VALUES ('257', 'ru', 'проплаченные частично');
INSERT INTO `messages` VALUES ('257', 'en', 'are paid partly');
INSERT INTO `messages` VALUES ('247', 'en', 'Username Twitter');
INSERT INTO `messages` VALUES ('248', 'ua', 'Змінити пароль');
INSERT INTO `messages` VALUES ('248', 'ru', 'Изменить пароль');
INSERT INTO `messages` VALUES ('248', 'en', 'Change password');
INSERT INTO `messages` VALUES ('253', 'ua', 'Замовити</br>електронний</br>сертифікат');
INSERT INTO `messages` VALUES ('253', 'ru', 'Заказать </ br> электронный </ br> сертификат');
INSERT INTO `messages` VALUES ('253', 'en', 'Order </ br> e </ br> certificate');
INSERT INTO `messages` VALUES ('249', 'ua', 'ЗБЕРЕГТИ />');
INSERT INTO `messages` VALUES ('249', 'ru', 'СОХРАНИТЬ />');
INSERT INTO `messages` VALUES ('249', 'en', 'SAVE />');
INSERT INTO `messages` VALUES ('252', 'ua', 'Екзаменаційний проект');
INSERT INTO `messages` VALUES ('252', 'ru', 'Экзаменационный проект');
INSERT INTO `messages` VALUES ('252', 'en', 'Examination project');
INSERT INTO `messages` VALUES ('250', 'ua', 'Модуль');
INSERT INTO `messages` VALUES ('250', 'ru', 'Модуль');
INSERT INTO `messages` VALUES ('250', 'en', 'Module');
INSERT INTO `messages` VALUES ('251', 'ua', 'Екзамен');
INSERT INTO `messages` VALUES ('251', 'ru', 'Экзамен');
INSERT INTO `messages` VALUES ('251', 'en', 'Exam');
INSERT INTO `messages` VALUES ('258', 'ua', 'Проплачено:');
INSERT INTO `messages` VALUES ('258', 'ru', 'Проплачено:');
INSERT INTO `messages` VALUES ('258', 'en', 'Paid for:');
INSERT INTO `messages` VALUES ('259', 'ua', 'грн');
INSERT INTO `messages` VALUES ('259', 'ru', 'грн');
INSERT INTO `messages` VALUES ('259', 'en', 'UAH');
INSERT INTO `messages` VALUES ('260', 'ua', 'Проплачені модулі:');
INSERT INTO `messages` VALUES ('260', 'ru', 'Проплаченные модули:');
INSERT INTO `messages` VALUES ('260', 'en', 'Bribed modules:');
INSERT INTO `messages` VALUES ('261', 'ua', 'Сплатити зараз');
INSERT INTO `messages` VALUES ('261', 'ru', 'Оплатить сейчас');
INSERT INTO `messages` VALUES ('261', 'en', 'Pay now');
INSERT INTO `messages` VALUES ('243', 'en', 'Username Facebook');
INSERT INTO `messages` VALUES ('244', 'ua', 'Ім\'я або id профіля Google+');
INSERT INTO `messages` VALUES ('244', 'ru', 'Имя или id профиля Google+');
INSERT INTO `messages` VALUES ('244', 'en', 'Username or Id Google+ profile');
INSERT INTO `messages` VALUES ('245', 'ua', 'Id на LinkedIn (наприклад in/username)');
INSERT INTO `messages` VALUES ('245', 'ru', 'Id на LinkedIn (например in/username)');
INSERT INTO `messages` VALUES ('262', 'ua', 'дд.мм.рррр');
INSERT INTO `messages` VALUES ('262', 'ru', 'дд.мм.гггг');
INSERT INTO `messages` VALUES ('262', 'en', 'dd.mm.yyyy');
INSERT INTO `messages` VALUES ('263', 'ua', 'Діючий пароль');
INSERT INTO `messages` VALUES ('263', 'ru', 'Действующий пароль');
INSERT INTO `messages` VALUES ('263', 'en', 'Current password');
INSERT INTO `messages` VALUES ('266', 'ua', 'Забули пароль?');
INSERT INTO `messages` VALUES ('266', 'ru', 'Забыли пароль?');
INSERT INTO `messages` VALUES ('266', 'en', 'Forgot your password?');
INSERT INTO `messages` VALUES ('268', 'ua', 'Будь ласка заповніть поле');
INSERT INTO `messages` VALUES ('268', 'ru', 'Пожалуйста заполните поле');
INSERT INTO `messages` VALUES ('268', 'en', 'Please fill out the field');
INSERT INTO `messages` VALUES ('269', 'ua', 'Паролі не співпадають');
INSERT INTO `messages` VALUES ('269', 'ru', 'Пароли не совпадают');
INSERT INTO `messages` VALUES ('269', 'en', 'Passwords do not match');
INSERT INTO `messages` VALUES ('273', 'ua', 'Невірна електронна пошта або пароль');
INSERT INTO `messages` VALUES ('273', 'ru', 'Неверная электронная почта или пароль');
INSERT INTO `messages` VALUES ('273', 'en', 'Incorrect email or password');
INSERT INTO `messages` VALUES ('274', 'ua', 'Невірний пароль');
INSERT INTO `messages` VALUES ('274', 'ru', 'Неверный пароль');
INSERT INTO `messages` VALUES ('274', 'en', 'Invalid password');
INSERT INTO `messages` VALUES ('267', 'ua', 'ЗБЕРЕГТИ />');
INSERT INTO `messages` VALUES ('267', 'ru', 'СОХРАНИТЬ />');
INSERT INTO `messages` VALUES ('267', 'en', 'SAVE />');
INSERT INTO `messages` VALUES ('264', 'ua', 'Новий пароль');
INSERT INTO `messages` VALUES ('264', 'ru', 'Новый пароль');
INSERT INTO `messages` VALUES ('264', 'en', 'New password');
INSERT INTO `messages` VALUES ('265', 'ua', 'Повторіть новий пароль');
INSERT INTO `messages` VALUES ('265', 'ru', 'Повторите новый пароль');
INSERT INTO `messages` VALUES ('265', 'en', 'Repeat your new password');
INSERT INTO `messages` VALUES ('242', 'ua', 'Електронна пошта');
INSERT INTO `messages` VALUES ('242', 'ru', 'Электронная почта');
INSERT INTO `messages` VALUES ('242', 'en', 'Email');
INSERT INTO `messages` VALUES ('243', 'ua', 'Ім\'я користувача Facebook');
INSERT INTO `messages` VALUES ('243', 'ru', 'Имя пользователя Facebook');
INSERT INTO `messages` VALUES ('246', 'en', 'Username or Id Vkontakte');
INSERT INTO `messages` VALUES ('270', 'ua', 'не може бути пустою');
INSERT INTO `messages` VALUES ('270', 'ru', 'не может быть пустым');
INSERT INTO `messages` VALUES ('270', 'en', 'can not be empty');
INSERT INTO `messages` VALUES ('271', 'ua', 'Електронна пошта не являється правильною');
INSERT INTO `messages` VALUES ('271', 'ru', 'Электронная почта не является правильной');
INSERT INTO `messages` VALUES ('271', 'en', 'Email is incorrect');
INSERT INTO `messages` VALUES ('272', 'ua', 'Електронна пошта уже зайнята');
INSERT INTO `messages` VALUES ('272', 'ru', 'Электронная почта уже занята');
INSERT INTO `messages` VALUES ('272', 'en', 'Email already occupied');
INSERT INTO `messages` VALUES ('279', 'ua', 'Почати модуль');
INSERT INTO `messages` VALUES ('279', 'ru', 'Начать модуль');
INSERT INTO `messages` VALUES ('279', 'en', 'Start module');
INSERT INTO `messages` VALUES ('280', 'ua', 'Почати курс');
INSERT INTO `messages` VALUES ('280', 'ru', 'Начать курс');
INSERT INTO `messages` VALUES ('280', 'en', 'Start course');
INSERT INTO `messages` VALUES ('237', 'ua', 'Запрошена сторінка не існує.');
INSERT INTO `messages` VALUES ('237', 'ru', 'Запрашиваемая страница не существует.');
INSERT INTO `messages` VALUES ('237', 'en', 'The requested page does not exist.');
INSERT INTO `messages` VALUES ('237', 'ua', 'Запрошена сторінка не існує.');
INSERT INTO `messages` VALUES ('237', 'ru', 'Запрашиваемая страница не существует.');
INSERT INTO `messages` VALUES ('237', 'en', 'The requested page does not exist.');
INSERT INTO `messages` VALUES ('237', 'ua', 'Запрошена сторінка не існує.');
INSERT INTO `messages` VALUES ('237', 'ru', 'Запрашиваемая страница не существует.');
INSERT INTO `messages` VALUES ('237', 'en', 'The requested page does not exist.');
INSERT INTO `messages` VALUES ('238', 'ua', 'Час дії посилання для відновлення паролю вичерпано.');
INSERT INTO `messages` VALUES ('238', 'ru', 'Время действия ссылки для восстановления пароля исчерпан.');
INSERT INTO `messages` VALUES ('238', 'en', 'Time for action restoration link exhausted.');
INSERT INTO `messages` VALUES ('239', 'ua', 'Для відновлення паролю перейдіть по посиланню нижче:');
INSERT INTO `messages` VALUES ('239', 'ru', 'Для восстановления пароля перейдите по ссылке ниже:');
INSERT INTO `messages` VALUES ('239', 'en', 'To recover your password click on the link below:');
INSERT INTO `messages` VALUES ('240', 'ua', 'Нажміть тут для відновлення паролю');
INSERT INTO `messages` VALUES ('240', 'ru', 'Нажмите здесь для восстановления пароля');
INSERT INTO `messages` VALUES ('240', 'en', 'Click here for password recovery');
INSERT INTO `messages` VALUES ('238', 'ua', 'Час дії посилання для відновлення паролю вичерпано.');
INSERT INTO `messages` VALUES ('238', 'ru', 'Время действия ссылки для восстановления пароля исчерпан.');
INSERT INTO `messages` VALUES ('238', 'en', 'Time for action restoration link exhausted.');
INSERT INTO `messages` VALUES ('239', 'ua', 'Для відновлення паролю перейдіть по посиланню нижче:');
INSERT INTO `messages` VALUES ('239', 'ru', 'Для восстановления пароля перейдите по ссылке ниже:');
INSERT INTO `messages` VALUES ('239', 'en', 'To recover your password click on the link below:');
INSERT INTO `messages` VALUES ('240', 'ua', 'Нажміть тут для відновлення паролю');
INSERT INTO `messages` VALUES ('240', 'ru', 'Нажмите здесь для восстановления пароля');
INSERT INTO `messages` VALUES ('240', 'en', 'Click here for password recovery');
INSERT INTO `messages` VALUES ('281', 'ua', 'Відновлення паролю');
INSERT INTO `messages` VALUES ('281', 'ru', 'Восстановление пароля');
INSERT INTO `messages` VALUES ('281', 'en', 'Password recovery');
INSERT INTO `messages` VALUES ('282', 'ua', 'Підтвердження email');
INSERT INTO `messages` VALUES ('282', 'ru', 'Подтверждение email');
INSERT INTO `messages` VALUES ('282', 'en', 'Сonfirmation email');
INSERT INTO `messages` VALUES ('283', 'ua', 'Для підтвердження email перейдіть по посиланню нижче:');
INSERT INTO `messages` VALUES ('283', 'ru', 'Для подтверждения email перейдите по ссылке ниже:');
INSERT INTO `messages` VALUES ('283', 'en', 'For confirmation email click on the link below:');
INSERT INTO `messages` VALUES ('284', 'ua', 'Нажміть тут для підтвердження email');
INSERT INTO `messages` VALUES ('284', 'ru', 'Нажмите здесь для подтверждения email');
INSERT INTO `messages` VALUES ('284', 'en', 'Click here to confirm your email');
INSERT INTO `messages` VALUES ('285', 'ua', 'Відновлення паролю');
INSERT INTO `messages` VALUES ('285', 'ru', 'Восстановление пароля');
INSERT INTO `messages` VALUES ('285', 'en', 'Password recovery');
INSERT INTO `messages` VALUES ('286', 'ua', 'Зміна email');
INSERT INTO `messages` VALUES ('286', 'ru', 'Смена email');
INSERT INTO `messages` VALUES ('286', 'en', 'Change email');
INSERT INTO `messages` VALUES ('287', 'ua', 'Вітаємо!');
INSERT INTO `messages` VALUES ('287', 'ru', 'Поздравляем!');
INSERT INTO `messages` VALUES ('287', 'en', 'Congratulations!');
INSERT INTO `messages` VALUES ('288', 'ua', 'Ви успішно змінили пароль.');
INSERT INTO `messages` VALUES ('288', 'ru', 'Вы успешно изменили пароль.');
INSERT INTO `messages` VALUES ('288', 'en', 'You have successfully changed your password.');
INSERT INTO `messages` VALUES ('289', 'ua', 'Відновлення паролю');
INSERT INTO `messages` VALUES ('289', 'ru', 'Восстановление пароля');
INSERT INTO `messages` VALUES ('289', 'en', 'Password recovery');
INSERT INTO `messages` VALUES ('290', 'ua', 'Щоб відновити пароль, введіть свою електронну пошту нижче. На данну електронну пошту буде відправлено посиланням для відновлення паролю. Термін дії посилання 30 хв.');
INSERT INTO `messages` VALUES ('290', 'ru', 'Чтобы восстановить пароль, введите свою электронную почту ниже. На эту электронную почту будет отправлено ссылкой для восстановления пароля. Срок действия ссылки 30 мин.');
INSERT INTO `messages` VALUES ('290', 'en', 'To reset your password, enter your email below. In this e-mail will be sent a link to reset your password. The link 30 min.');
INSERT INTO `messages` VALUES ('291', 'ua', 'ВІДПРАВИТИ />');
INSERT INTO `messages` VALUES ('291', 'ru', 'ОТПРАВИТЬ />');
INSERT INTO `messages` VALUES ('291', 'en', 'SEND />');
INSERT INTO `messages` VALUES ('292', 'ua', 'Зміна email');
INSERT INTO `messages` VALUES ('292', 'ru', 'Изменение email');
INSERT INTO `messages` VALUES ('292', 'en', 'Changing email');
INSERT INTO `messages` VALUES ('293', 'ua', 'Введіть нову електронну пошту в поле нижче.На дану електронну пошту буде відправлено посиланням для підтвердження дійсності адреси. Термін дії посилання 30 хв.');
INSERT INTO `messages` VALUES ('293', 'ru', 'Введите новую электронную почту в поле ниже.На данную электронную почту будет отправлено ссылкой для подтверждения подлинности адреса. Срок действия ссылки 30 мин.');
INSERT INTO `messages` VALUES ('293', 'en', 'Enter a new e-mail in this field below.Na email will be sent a link to confirm validity of the address. The link 30 min.');
INSERT INTO `messages` VALUES ('294', 'ua', 'ВІДПРАВИТИ />');
INSERT INTO `messages` VALUES ('294', 'ru', 'ОТПРАВИТЬ />');
INSERT INTO `messages` VALUES ('294', 'en', 'SEND />');
INSERT INTO `messages` VALUES ('295', 'ua', 'Змінити email');
INSERT INTO `messages` VALUES ('295', 'ru', 'Изменить email');
INSERT INTO `messages` VALUES ('295', 'en', 'Change email');
INSERT INTO `messages` VALUES ('238', 'ua', 'Час дії посилання для відновлення паролю вичерпано.');
INSERT INTO `messages` VALUES ('238', 'ru', 'Время действия ссылки для восстановления пароля исчерпан.');
INSERT INTO `messages` VALUES ('238', 'en', 'Time for action restoration link exhausted.');
INSERT INTO `messages` VALUES ('239', 'ua', 'Для відновлення паролю перейдіть по посиланню нижче:');
INSERT INTO `messages` VALUES ('239', 'ru', 'Для восстановления пароля перейдите по ссылке ниже:');
INSERT INTO `messages` VALUES ('239', 'en', 'To recover your password click on the link below:');
INSERT INTO `messages` VALUES ('240', 'ua', 'Нажміть тут для відновлення паролю');
INSERT INTO `messages` VALUES ('240', 'ru', 'Нажмите здесь для восстановления пароля');
INSERT INTO `messages` VALUES ('240', 'en', 'Click here for password recovery');
INSERT INTO `messages` VALUES ('281', 'ua', 'Відновлення паролю');
INSERT INTO `messages` VALUES ('281', 'ru', 'Восстановление пароля');
INSERT INTO `messages` VALUES ('281', 'en', 'Password recovery');
INSERT INTO `messages` VALUES ('282', 'ua', 'Підтвердження email');
INSERT INTO `messages` VALUES ('282', 'ru', 'Подтверждение email');
INSERT INTO `messages` VALUES ('282', 'en', 'Сonfirmation email');
INSERT INTO `messages` VALUES ('283', 'ua', 'Для підтвердження email перейдіть по посиланню нижче:');
INSERT INTO `messages` VALUES ('283', 'ru', 'Для подтверждения email перейдите по ссылке ниже:');
INSERT INTO `messages` VALUES ('283', 'en', 'For confirmation email click on the link below:');
INSERT INTO `messages` VALUES ('284', 'ua', 'Нажміть тут для підтвердження email');
INSERT INTO `messages` VALUES ('284', 'ru', 'Нажмите здесь для подтверждения email');
INSERT INTO `messages` VALUES ('284', 'en', 'Click here to confirm your email');
INSERT INTO `messages` VALUES ('285', 'ua', 'Відновлення паролю');
INSERT INTO `messages` VALUES ('285', 'ru', 'Восстановление пароля');
INSERT INTO `messages` VALUES ('285', 'en', 'Password recovery');
INSERT INTO `messages` VALUES ('286', 'ua', 'Зміна email');
INSERT INTO `messages` VALUES ('286', 'ru', 'Смена email');
INSERT INTO `messages` VALUES ('286', 'en', 'Change email');
INSERT INTO `messages` VALUES ('287', 'ua', 'Вітаємо!');
INSERT INTO `messages` VALUES ('287', 'ru', 'Поздравляем!');
INSERT INTO `messages` VALUES ('287', 'en', 'Congratulations!');
INSERT INTO `messages` VALUES ('288', 'ua', 'Ви успішно змінили пароль.');
INSERT INTO `messages` VALUES ('288', 'ru', 'Вы успешно изменили пароль.');
INSERT INTO `messages` VALUES ('288', 'en', 'You have successfully changed your password.');
INSERT INTO `messages` VALUES ('289', 'ua', 'Відновлення паролю');
INSERT INTO `messages` VALUES ('289', 'ru', 'Восстановление пароля');
INSERT INTO `messages` VALUES ('289', 'en', 'Password recovery');
INSERT INTO `messages` VALUES ('290', 'ua', 'Щоб відновити пароль, введіть свою електронну пошту нижче. На данну електронну пошту буде відправлено посиланням для відновлення паролю. Термін дії посилання 30 хв.');
INSERT INTO `messages` VALUES ('290', 'ru', 'Чтобы восстановить пароль, введите свою электронную почту ниже. На эту электронную почту будет отправлено ссылкой для восстановления пароля. Срок действия ссылки 30 мин.');
INSERT INTO `messages` VALUES ('290', 'en', 'To reset your password, enter your email below. In this e-mail will be sent a link to reset your password. The link 30 min.');
INSERT INTO `messages` VALUES ('291', 'ua', 'ВІДПРАВИТИ />');
INSERT INTO `messages` VALUES ('291', 'ru', 'ОТПРАВИТЬ />');
INSERT INTO `messages` VALUES ('291', 'en', 'SEND />');
INSERT INTO `messages` VALUES ('292', 'ua', 'Зміна email');
INSERT INTO `messages` VALUES ('292', 'ru', 'Изменение email');
INSERT INTO `messages` VALUES ('292', 'en', 'Changing email');
INSERT INTO `messages` VALUES ('293', 'ua', 'Введіть нову електронну пошту в поле нижче.На дану електронну пошту буде відправлено посиланням для підтвердження дійсності адреси. Термін дії посилання 30 хв.');
INSERT INTO `messages` VALUES ('293', 'ru', 'Введите новую электронную почту в поле ниже.На данную электронную почту будет отправлено ссылкой для подтверждения подлинности адреса. Срок действия ссылки 30 мин.');
INSERT INTO `messages` VALUES ('293', 'en', 'Enter a new e-mail in this field below.Na email will be sent a link to confirm validity of the address. The link 30 min.');
INSERT INTO `messages` VALUES ('294', 'ua', 'ВІДПРАВИТИ />');
INSERT INTO `messages` VALUES ('294', 'ru', 'ОТПРАВИТЬ />');
INSERT INTO `messages` VALUES ('294', 'en', 'SEND />');
INSERT INTO `messages` VALUES ('295', 'ua', 'Змінити email');
INSERT INTO `messages` VALUES ('295', 'ru', 'Изменить email');
INSERT INTO `messages` VALUES ('295', 'en', 'Change email');
INSERT INTO `messages` VALUES ('296', 'ua', 'Випускники');
INSERT INTO `messages` VALUES ('296', 'ru', 'Выпускники');
INSERT INTO `messages` VALUES ('296', 'en', 'Graduates');
INSERT INTO `messages` VALUES ('297', 'ua', 'Наші випускники');
INSERT INTO `messages` VALUES ('297', 'ru', 'Наши выпускники');
INSERT INTO `messages` VALUES ('297', 'en', 'Our graduates');

-- ----------------------------
-- Table structure for `module`
-- ----------------------------
DROP TABLE IF EXISTS `module`;
CREATE TABLE `module` (
  `module_ID` int(11) NOT NULL AUTO_INCREMENT,
  `course` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `alias` varchar(10) NOT NULL,
  `language` varchar(6) NOT NULL,
  `module_duration_hours` int(11) NOT NULL,
  `module_duration_days` int(11) NOT NULL,
  `lesson_count` int(11) DEFAULT NULL,
  `module_price` decimal(10,0) DEFAULT NULL,
  `for_whom` text,
  `what_you_learn` text,
  `what_you_get` text,
  `module_img` varchar(255) DEFAULT NULL,
  `about_module` text,
  `owners` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`module_ID`),
  UNIQUE KEY `module_ID` (`module_ID`),
  KEY `course` (`course`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of module
-- ----------------------------
INSERT INTO `module` VALUES ('1', '1', '1', 'Вступ до програмування', 'module1', 'ua', '313', '20', '14', '3000', 'для менеджерів проектів і тих, хто відповідає за постановку завдань на розробку;для дизайнерів, які готові почати не просто малювати красиві картинки, а й навчитися тому, як створювати працюючі і зручні інтерфейси;для розробників, які хочуть самостійно створити або змінити свій проект;', 'Ви навчитеся писати чистий код;Користуватися системами контролю версій;Дізнаєтеся, з чого складається сучасний додаток;Для чого потрібен безперервна інтеграція (СІ) сервер;Чому потрібно тестувати свої програми і як це робити;', 'Відеозаписи та текстові матеріали всіх онлайн-занять;Спілкування з розумними одногрупниками;Сертифікат про закінчення навчання;Прилаштованість на робоче місце в силіконовій долині;', '/css/images/courseimg1.png', null, '1;2;3;4;');
INSERT INTO `module` VALUES ('2', '1', '4', 'Елементарна математика', 'module2', 'ua', '30', '15', '3', '3200', null, null, null, '/css/images/courseimg1.png', null, '3;4;');
INSERT INTO `module` VALUES ('3', '1', '2', 'Алгоритмізація і програмування на мові С', 'module3', 'ua', '60', '30', '0', '3500', null, null, null, '/css/images/courseimg1.png', null, '1;4;5;');
INSERT INTO `module` VALUES ('4', '1', '3', 'Елементи вищої математики', 'module4', 'ua', '60', '0', '0', '3000', null, null, null, '/css/images/courseimg1.png', null, '4;');
INSERT INTO `module` VALUES ('7', '1', '5', 'Комп\'ютерні мережі', 'module5', 'ua', '60', '0', '0', '3000', null, null, null, '/css/images/courseimg1.png', null, '1;2;');
INSERT INTO `module` VALUES ('9', '1', '6', 'Розробка та аналіз алгоритмів. Комбінаторні алгоритми.', 'module6', 'ua', '60', '0', '0', '3000', null, null, null, '/css/images/courseimg1.png', null, '3;4;');
INSERT INTO `module` VALUES ('10', '1', '7', 'Дискретна математика', 'module7', 'ua', '60', '0', '0', '3000', null, null, null, '/css/images/courseimg1.png', null, '1;4;');
INSERT INTO `module` VALUES ('11', '1', '8', 'Бази даних', 'module8', 'ua', '60', '0', '0', '3000', null, null, null, '/css/images/courseimg1.png', null, '1;3;');
INSERT INTO `module` VALUES ('14', '1', '9', 'Англійська мова', 'module9', 'ua', '60', '0', '0', '3000', null, null, null, '/css/images/courseimg1.png', null, '4;5;6;');
INSERT INTO `module` VALUES ('16', '1', '10', 'Програмування на PHP (Частина 1)', 'module10', 'ua', '60', '0', '0', '3000', null, null, null, '/css/images/courseimg1.png', null, '6;');
INSERT INTO `module` VALUES ('17', '1', '11', 'Програмування на PHP (Частина 2)', 'module11', 'ua', '60', '0', '0', '3000', null, null, null, '/css/images/courseimg1.png', null, '5;6;');
INSERT INTO `module` VALUES ('18', '1', '13', 'Верстка на HTML, CSS', 'module12', 'ua', '60', '0', '0', '3000', null, null, null, '/css/images/courseimg1.png', null, '1;');
INSERT INTO `module` VALUES ('20', '1', '12', 'Програмування на JavaScript', 'module13', 'ua', '60', '0', '0', '3000', null, null, null, '/css/images/courseimg1.png', null, '1;5;6;');
INSERT INTO `module` VALUES ('22', '1', '14', 'Сучасні технології розробки програм', 'module14', 'ua', '60', '0', '0', '3000', null, null, null, '/css/images/courseimg1.png', null, '5;4;6;');
INSERT INTO `module` VALUES ('23', '1', '15', 'Командний дипломний проект', 'module15', 'ua', '60', '0', '0', '3000', null, null, null, '/css/images/courseimg1.png', null, '1;4;');
INSERT INTO `module` VALUES ('24', '1', '16', 'Побудова індивідуального плану кар’єри.\r\n\r\n\r\n', 'module16', 'ua', '60', '0', '0', '3000', null, null, null, '/css/images/courseimg1.png', null, '1;3;');
INSERT INTO `module` VALUES ('26', '0', '0', 'Ефективне працевлаштування', 'module17', 'ua', '0', '0', null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `permissions`
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id_user` int(11) NOT NULL,
  `id_resource` int(11) NOT NULL,
  `rights` tinyint(10) NOT NULL,
  PRIMARY KEY (`id_user`,`id_resource`),
  KEY `FK_permissions_lectures` (`id_resource`),
  CONSTRAINT `FK_permissions_lectures` FOREIGN KEY (`id_resource`) REFERENCES `lectures` (`id`),
  CONSTRAINT `FK_permissions_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User rights for lectures: TINYINT(10) \r\n0 - read\r\n1 - edit\r\n2 - create\r\n3 - delete  ';

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', '1', '1');
INSERT INTO `permissions` VALUES ('1', '2', '1');
INSERT INTO `permissions` VALUES ('1', '3', '1');
INSERT INTO `permissions` VALUES ('1', '5', '1');
INSERT INTO `permissions` VALUES ('1', '14', '1');
INSERT INTO `permissions` VALUES ('1', '15', '1');
INSERT INTO `permissions` VALUES ('1', '16', '1');
INSERT INTO `permissions` VALUES ('1', '17', '1');
INSERT INTO `permissions` VALUES ('1', '18', '1');
INSERT INTO `permissions` VALUES ('1', '19', '1');
INSERT INTO `permissions` VALUES ('1', '20', '1');
INSERT INTO `permissions` VALUES ('1', '21', '1');
INSERT INTO `permissions` VALUES ('1', '22', '1');
INSERT INTO `permissions` VALUES ('1', '23', '1');
INSERT INTO `permissions` VALUES ('1', '24', '1');
INSERT INTO `permissions` VALUES ('1', '26', '1');
INSERT INTO `permissions` VALUES ('1', '27', '1');
INSERT INTO `permissions` VALUES ('11', '1', '15');
INSERT INTO `permissions` VALUES ('22', '1', '15');
INSERT INTO `permissions` VALUES ('38', '1', '15');
INSERT INTO `permissions` VALUES ('38', '2', '15');
INSERT INTO `permissions` VALUES ('38', '3', '15');
INSERT INTO `permissions` VALUES ('38', '5', '15');
INSERT INTO `permissions` VALUES ('38', '14', '15');
INSERT INTO `permissions` VALUES ('38', '15', '15');
INSERT INTO `permissions` VALUES ('38', '16', '15');
INSERT INTO `permissions` VALUES ('38', '17', '15');
INSERT INTO `permissions` VALUES ('38', '18', '15');
INSERT INTO `permissions` VALUES ('38', '19', '15');
INSERT INTO `permissions` VALUES ('38', '20', '15');
INSERT INTO `permissions` VALUES ('38', '21', '15');
INSERT INTO `permissions` VALUES ('38', '22', '15');
INSERT INTO `permissions` VALUES ('38', '23', '15');
INSERT INTO `permissions` VALUES ('38', '24', '15');
INSERT INTO `permissions` VALUES ('38', '26', '15');
INSERT INTO `permissions` VALUES ('38', '27', '15');
INSERT INTO `permissions` VALUES ('39', '1', '15');
INSERT INTO `permissions` VALUES ('39', '2', '15');
INSERT INTO `permissions` VALUES ('40', '1', '15');
INSERT INTO `permissions` VALUES ('40', '2', '15');
INSERT INTO `permissions` VALUES ('41', '1', '15');
INSERT INTO `permissions` VALUES ('41', '2', '15');
INSERT INTO `permissions` VALUES ('42', '1', '15');
INSERT INTO `permissions` VALUES ('42', '2', '15');
INSERT INTO `permissions` VALUES ('43', '1', '15');
INSERT INTO `permissions` VALUES ('43', '2', '15');

-- ----------------------------
-- Table structure for `phpbb_acl_options`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_acl_options`;
CREATE TABLE `phpbb_acl_options` (
  `auth_option_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `auth_option` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `is_global` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_local` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `founder_only` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`auth_option_id`),
  UNIQUE KEY `auth_option` (`auth_option`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_acl_options
-- ----------------------------
INSERT INTO `phpbb_acl_options` VALUES ('1', 'f_', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('2', 'f_announce', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('3', 'f_attach', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('4', 'f_bbcode', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('5', 'f_bump', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('6', 'f_delete', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('7', 'f_download', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('8', 'f_edit', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('9', 'f_email', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('10', 'f_flash', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('11', 'f_icons', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('12', 'f_ignoreflood', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('13', 'f_img', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('14', 'f_list', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('15', 'f_noapprove', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('16', 'f_poll', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('17', 'f_post', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('18', 'f_postcount', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('19', 'f_print', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('20', 'f_read', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('21', 'f_reply', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('22', 'f_report', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('23', 'f_search', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('24', 'f_sigs', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('25', 'f_smilies', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('26', 'f_sticky', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('27', 'f_subscribe', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('28', 'f_user_lock', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('29', 'f_vote', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('30', 'f_votechg', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('31', 'f_softdelete', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('32', 'm_', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('33', 'm_approve', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('34', 'm_chgposter', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('35', 'm_delete', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('36', 'm_edit', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('37', 'm_info', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('38', 'm_lock', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('39', 'm_merge', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('40', 'm_move', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('41', 'm_report', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('42', 'm_split', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('43', 'm_softdelete', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('44', 'm_ban', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('45', 'm_warn', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('46', 'a_', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('47', 'a_aauth', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('48', 'a_attach', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('49', 'a_authgroups', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('50', 'a_authusers', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('51', 'a_backup', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('52', 'a_ban', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('53', 'a_bbcode', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('54', 'a_board', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('55', 'a_bots', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('56', 'a_clearlogs', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('57', 'a_email', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('58', 'a_extensions', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('59', 'a_fauth', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('60', 'a_forum', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('61', 'a_forumadd', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('62', 'a_forumdel', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('63', 'a_group', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('64', 'a_groupadd', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('65', 'a_groupdel', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('66', 'a_icons', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('67', 'a_jabber', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('68', 'a_language', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('69', 'a_mauth', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('70', 'a_modules', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('71', 'a_names', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('72', 'a_phpinfo', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('73', 'a_profile', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('74', 'a_prune', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('75', 'a_ranks', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('76', 'a_reasons', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('77', 'a_roles', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('78', 'a_search', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('79', 'a_server', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('80', 'a_styles', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('81', 'a_switchperm', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('82', 'a_uauth', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('83', 'a_user', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('84', 'a_userdel', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('85', 'a_viewauth', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('86', 'a_viewlogs', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('87', 'a_words', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('88', 'u_', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('89', 'u_attach', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('90', 'u_chgavatar', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('91', 'u_chgcensors', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('92', 'u_chgemail', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('93', 'u_chggrp', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('94', 'u_chgname', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('95', 'u_chgpasswd', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('96', 'u_chgprofileinfo', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('97', 'u_download', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('98', 'u_hideonline', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('99', 'u_ignoreflood', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('100', 'u_masspm', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('101', 'u_masspm_group', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('102', 'u_pm_attach', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('103', 'u_pm_bbcode', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('104', 'u_pm_delete', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('105', 'u_pm_download', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('106', 'u_pm_edit', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('107', 'u_pm_emailpm', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('108', 'u_pm_flash', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('109', 'u_pm_forward', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('110', 'u_pm_img', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('111', 'u_pm_printpm', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('112', 'u_pm_smilies', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('113', 'u_readpm', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('114', 'u_savedrafts', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('115', 'u_search', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('116', 'u_sendemail', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('117', 'u_sendim', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('118', 'u_sendpm', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('119', 'u_sig', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('120', 'u_viewonline', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('121', 'u_viewprofile', '1', '0', '0');

-- ----------------------------
-- Table structure for `phpbb_acl_roles`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_acl_roles`;
CREATE TABLE `phpbb_acl_roles` (
  `role_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `role_description` text COLLATE utf8_bin NOT NULL,
  `role_type` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',
  `role_order` smallint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`),
  KEY `role_type` (`role_type`),
  KEY `role_order` (`role_order`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_acl_roles
-- ----------------------------
INSERT INTO `phpbb_acl_roles` VALUES ('1', 'ROLE_ADMIN_STANDARD', 0x524F4C455F4445534352495054494F4E5F41444D494E5F5354414E44415244, 'a_', '1');
INSERT INTO `phpbb_acl_roles` VALUES ('2', 'ROLE_ADMIN_FORUM', 0x524F4C455F4445534352495054494F4E5F41444D494E5F464F52554D, 'a_', '3');
INSERT INTO `phpbb_acl_roles` VALUES ('3', 'ROLE_ADMIN_USERGROUP', 0x524F4C455F4445534352495054494F4E5F41444D494E5F5553455247524F5550, 'a_', '4');
INSERT INTO `phpbb_acl_roles` VALUES ('4', 'ROLE_ADMIN_FULL', 0x524F4C455F4445534352495054494F4E5F41444D494E5F46554C4C, 'a_', '2');
INSERT INTO `phpbb_acl_roles` VALUES ('5', 'ROLE_USER_FULL', 0x524F4C455F4445534352495054494F4E5F555345525F46554C4C, 'u_', '3');
INSERT INTO `phpbb_acl_roles` VALUES ('6', 'ROLE_USER_STANDARD', 0x524F4C455F4445534352495054494F4E5F555345525F5354414E44415244, 'u_', '1');
INSERT INTO `phpbb_acl_roles` VALUES ('7', 'ROLE_USER_LIMITED', 0x524F4C455F4445534352495054494F4E5F555345525F4C494D49544544, 'u_', '2');
INSERT INTO `phpbb_acl_roles` VALUES ('8', 'ROLE_USER_NOPM', 0x524F4C455F4445534352495054494F4E5F555345525F4E4F504D, 'u_', '4');
INSERT INTO `phpbb_acl_roles` VALUES ('9', 'ROLE_USER_NOAVATAR', 0x524F4C455F4445534352495054494F4E5F555345525F4E4F415641544152, 'u_', '5');
INSERT INTO `phpbb_acl_roles` VALUES ('10', 'ROLE_MOD_FULL', 0x524F4C455F4445534352495054494F4E5F4D4F445F46554C4C, 'm_', '3');
INSERT INTO `phpbb_acl_roles` VALUES ('11', 'ROLE_MOD_STANDARD', 0x524F4C455F4445534352495054494F4E5F4D4F445F5354414E44415244, 'm_', '1');
INSERT INTO `phpbb_acl_roles` VALUES ('12', 'ROLE_MOD_SIMPLE', 0x524F4C455F4445534352495054494F4E5F4D4F445F53494D504C45, 'm_', '2');
INSERT INTO `phpbb_acl_roles` VALUES ('13', 'ROLE_MOD_QUEUE', 0x524F4C455F4445534352495054494F4E5F4D4F445F5155455545, 'm_', '4');
INSERT INTO `phpbb_acl_roles` VALUES ('14', 'ROLE_FORUM_FULL', 0x524F4C455F4445534352495054494F4E5F464F52554D5F46554C4C, 'f_', '7');
INSERT INTO `phpbb_acl_roles` VALUES ('15', 'ROLE_FORUM_STANDARD', 0x524F4C455F4445534352495054494F4E5F464F52554D5F5354414E44415244, 'f_', '5');
INSERT INTO `phpbb_acl_roles` VALUES ('16', 'ROLE_FORUM_NOACCESS', 0x524F4C455F4445534352495054494F4E5F464F52554D5F4E4F414343455353, 'f_', '1');
INSERT INTO `phpbb_acl_roles` VALUES ('17', 'ROLE_FORUM_READONLY', 0x524F4C455F4445534352495054494F4E5F464F52554D5F524541444F4E4C59, 'f_', '2');
INSERT INTO `phpbb_acl_roles` VALUES ('18', 'ROLE_FORUM_LIMITED', 0x524F4C455F4445534352495054494F4E5F464F52554D5F4C494D49544544, 'f_', '3');
INSERT INTO `phpbb_acl_roles` VALUES ('19', 'ROLE_FORUM_BOT', 0x524F4C455F4445534352495054494F4E5F464F52554D5F424F54, 'f_', '9');
INSERT INTO `phpbb_acl_roles` VALUES ('20', 'ROLE_FORUM_ONQUEUE', 0x524F4C455F4445534352495054494F4E5F464F52554D5F4F4E5155455545, 'f_', '8');
INSERT INTO `phpbb_acl_roles` VALUES ('21', 'ROLE_FORUM_POLLS', 0x524F4C455F4445534352495054494F4E5F464F52554D5F504F4C4C53, 'f_', '6');
INSERT INTO `phpbb_acl_roles` VALUES ('22', 'ROLE_FORUM_LIMITED_POLLS', 0x524F4C455F4445534352495054494F4E5F464F52554D5F4C494D495445445F504F4C4C53, 'f_', '4');
INSERT INTO `phpbb_acl_roles` VALUES ('23', 'ROLE_USER_NEW_MEMBER', 0x524F4C455F4445534352495054494F4E5F555345525F4E45575F4D454D424552, 'u_', '6');
INSERT INTO `phpbb_acl_roles` VALUES ('24', 'ROLE_FORUM_NEW_MEMBER', 0x524F4C455F4445534352495054494F4E5F464F52554D5F4E45575F4D454D424552, 'f_', '10');

-- ----------------------------
-- Table structure for `phpbb_acl_roles_data`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_acl_roles_data`;
CREATE TABLE `phpbb_acl_roles_data` (
  `role_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_option_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_setting` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`,`auth_option_id`),
  KEY `ath_op_id` (`auth_option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_acl_roles_data
-- ----------------------------
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '46', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '48', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '49', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '50', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '52', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '53', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '54', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '58', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '59', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '60', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '61', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '62', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '63', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '64', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '65', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '66', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '69', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '71', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '73', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '74', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '75', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '76', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '82', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '83', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '84', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '85', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '86', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '87', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '46', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '49', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '50', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '59', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '60', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '61', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '62', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '69', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '74', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '82', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '85', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '86', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '46', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '49', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '50', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '52', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '63', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '64', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '65', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '75', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '82', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '83', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '85', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '86', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '46', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '47', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '48', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '49', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '50', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '51', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '52', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '53', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '54', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '55', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '56', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '57', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '58', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '59', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '60', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '61', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '62', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '63', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '64', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '65', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '66', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '67', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '68', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '69', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '70', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '71', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '72', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '73', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '74', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '75', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '76', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '77', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '78', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '79', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '80', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '81', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '82', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '83', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '84', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '85', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '86', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '87', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '88', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '89', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '90', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '91', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '92', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '93', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '94', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '95', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '96', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '97', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '98', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '99', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '100', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '101', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '102', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '103', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '104', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '105', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '106', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '107', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '108', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '109', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '110', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '111', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '112', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '113', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '114', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '115', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '116', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '117', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '118', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '119', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '120', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '121', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '88', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '89', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '90', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '91', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '92', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '95', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '96', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '97', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '98', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '100', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '101', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '102', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '103', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '104', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '105', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '106', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '107', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '110', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '111', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '112', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '113', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '114', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '115', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '116', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '117', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '118', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '119', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '121', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '88', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '90', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '91', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '92', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '95', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '96', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '97', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '98', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '103', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '104', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '105', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '106', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '109', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '110', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '111', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '112', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '113', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '118', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '119', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '121', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '88', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '90', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '91', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '92', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '95', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '97', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '98', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '100', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '101', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '113', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '118', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '119', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '121', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '88', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '90', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '91', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '92', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '95', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '96', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '97', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '98', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '103', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '104', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '105', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '106', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '109', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '110', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '111', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '112', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '113', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '118', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '119', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '121', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '32', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '33', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '34', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '35', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '36', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '37', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '38', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '39', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '40', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '41', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '42', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '43', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '44', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '45', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '32', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '33', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '35', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '36', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '37', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '38', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '39', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '40', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '41', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '42', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '43', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '45', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('12', '32', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('12', '35', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('12', '36', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('12', '37', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('12', '41', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('12', '43', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('13', '32', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('13', '33', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('13', '36', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '1', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '2', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '3', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '4', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '5', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '6', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '7', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '8', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '9', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '10', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '11', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '12', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '13', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '14', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '15', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '16', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '17', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '18', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '19', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '20', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '21', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '22', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '23', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '24', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '25', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '26', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '27', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '28', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '29', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '30', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '31', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '1', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '3', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '4', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '5', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '6', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '7', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '8', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '9', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '11', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '13', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '14', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '15', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '17', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '18', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '19', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '20', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '21', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '22', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '23', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '24', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '25', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '27', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '29', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '30', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '31', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('16', '1', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('17', '1', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('17', '7', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('17', '14', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('17', '19', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('17', '20', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('17', '23', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('17', '27', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '1', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '4', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '7', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '8', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '9', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '13', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '14', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '15', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '17', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '18', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '19', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '20', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '21', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '22', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '23', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '24', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '25', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '27', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '29', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '31', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('19', '1', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('19', '7', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('19', '14', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('19', '19', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('19', '20', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '1', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '3', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '4', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '7', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '8', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '9', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '13', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '14', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '15', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '17', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '18', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '19', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '20', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '21', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '22', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '23', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '24', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '25', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '27', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '29', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '31', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '1', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '3', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '4', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '5', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '6', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '7', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '8', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '9', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '11', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '13', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '14', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '15', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '16', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '17', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '18', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '19', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '20', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '21', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '22', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '23', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '24', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '25', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '27', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '29', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '30', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '31', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '1', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '4', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '7', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '8', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '9', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '13', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '14', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '15', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '16', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '17', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '18', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '19', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '20', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '21', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '22', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '23', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '24', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '25', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '27', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '29', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '31', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('23', '96', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('23', '100', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('23', '101', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('23', '118', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('24', '15', '0');

-- ----------------------------
-- Table structure for `phpbb_acl_users`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_acl_users`;
CREATE TABLE `phpbb_acl_users` (
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_option_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_role_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_setting` tinyint(2) NOT NULL DEFAULT '0',
  KEY `user_id` (`user_id`),
  KEY `auth_option_id` (`auth_option_id`),
  KEY `auth_role_id` (`auth_role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_acl_users
-- ----------------------------
INSERT INTO `phpbb_acl_users` VALUES ('2', '0', '0', '5', '0');

-- ----------------------------
-- Table structure for `phpbb_attachments`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_attachments`;
CREATE TABLE `phpbb_attachments` (
  `attach_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `post_msg_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `in_message` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `poster_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `is_orphan` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `physical_filename` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `real_filename` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `download_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `attach_comment` text COLLATE utf8_bin NOT NULL,
  `extension` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `mimetype` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `filesize` int(20) unsigned NOT NULL DEFAULT '0',
  `filetime` int(11) unsigned NOT NULL DEFAULT '0',
  `thumbnail` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`attach_id`),
  KEY `filetime` (`filetime`),
  KEY `post_msg_id` (`post_msg_id`),
  KEY `topic_id` (`topic_id`),
  KEY `poster_id` (`poster_id`),
  KEY `is_orphan` (`is_orphan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_attachments
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_banlist`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_banlist`;
CREATE TABLE `phpbb_banlist` (
  `ban_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ban_userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ban_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ban_email` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ban_start` int(11) unsigned NOT NULL DEFAULT '0',
  `ban_end` int(11) unsigned NOT NULL DEFAULT '0',
  `ban_exclude` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ban_give_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`ban_id`),
  KEY `ban_end` (`ban_end`),
  KEY `ban_user` (`ban_userid`,`ban_exclude`),
  KEY `ban_email` (`ban_email`,`ban_exclude`),
  KEY `ban_ip` (`ban_ip`,`ban_exclude`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_banlist
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_bbcodes`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_bbcodes`;
CREATE TABLE `phpbb_bbcodes` (
  `bbcode_id` smallint(4) unsigned NOT NULL DEFAULT '0',
  `bbcode_tag` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bbcode_helpline` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_on_posting` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `bbcode_match` text COLLATE utf8_bin NOT NULL,
  `bbcode_tpl` mediumtext COLLATE utf8_bin NOT NULL,
  `first_pass_match` mediumtext COLLATE utf8_bin NOT NULL,
  `first_pass_replace` mediumtext COLLATE utf8_bin NOT NULL,
  `second_pass_match` mediumtext COLLATE utf8_bin NOT NULL,
  `second_pass_replace` mediumtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`bbcode_id`),
  KEY `display_on_post` (`display_on_posting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_bbcodes
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_bookmarks`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_bookmarks`;
CREATE TABLE `phpbb_bookmarks` (
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`topic_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_bookmarks
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_bots`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_bots`;
CREATE TABLE `phpbb_bots` (
  `bot_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `bot_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `bot_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `bot_agent` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bot_ip` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`bot_id`),
  KEY `bot_active` (`bot_active`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_bots
-- ----------------------------
INSERT INTO `phpbb_bots` VALUES ('1', '1', 'AdsBot [Google]', '3', 'AdsBot-Google', '');
INSERT INTO `phpbb_bots` VALUES ('2', '1', 'Alexa [Bot]', '4', 'ia_archiver', '');
INSERT INTO `phpbb_bots` VALUES ('3', '1', 'Alta Vista [Bot]', '5', 'Scooter/', '');
INSERT INTO `phpbb_bots` VALUES ('4', '1', 'Ask Jeeves [Bot]', '6', 'Ask Jeeves', '');
INSERT INTO `phpbb_bots` VALUES ('5', '1', 'Baidu [Spider]', '7', 'Baiduspider', '');
INSERT INTO `phpbb_bots` VALUES ('6', '1', 'Bing [Bot]', '8', 'bingbot/', '');
INSERT INTO `phpbb_bots` VALUES ('7', '1', 'Exabot [Bot]', '9', 'Exabot', '');
INSERT INTO `phpbb_bots` VALUES ('8', '1', 'FAST Enterprise [Crawler]', '10', 'FAST Enterprise Crawler', '');
INSERT INTO `phpbb_bots` VALUES ('9', '1', 'FAST WebCrawler [Crawler]', '11', 'FAST-WebCrawler/', '');
INSERT INTO `phpbb_bots` VALUES ('10', '1', 'Francis [Bot]', '12', 'http://www.neomo.de/', '');
INSERT INTO `phpbb_bots` VALUES ('11', '1', 'Gigabot [Bot]', '13', 'Gigabot/', '');
INSERT INTO `phpbb_bots` VALUES ('12', '1', 'Google Adsense [Bot]', '14', 'Mediapartners-Google', '');
INSERT INTO `phpbb_bots` VALUES ('13', '1', 'Google Desktop', '15', 'Google Desktop', '');
INSERT INTO `phpbb_bots` VALUES ('14', '1', 'Google Feedfetcher', '16', 'Feedfetcher-Google', '');
INSERT INTO `phpbb_bots` VALUES ('15', '1', 'Google [Bot]', '17', 'Googlebot', '');
INSERT INTO `phpbb_bots` VALUES ('16', '1', 'Heise IT-Markt [Crawler]', '18', 'heise-IT-Markt-Crawler', '');
INSERT INTO `phpbb_bots` VALUES ('17', '1', 'Heritrix [Crawler]', '19', 'heritrix/1.', '');
INSERT INTO `phpbb_bots` VALUES ('18', '1', 'IBM Research [Bot]', '20', 'ibm.com/cs/crawler', '');
INSERT INTO `phpbb_bots` VALUES ('19', '1', 'ICCrawler - ICjobs', '21', 'ICCrawler - ICjobs', '');
INSERT INTO `phpbb_bots` VALUES ('20', '1', 'ichiro [Crawler]', '22', 'ichiro/', '');
INSERT INTO `phpbb_bots` VALUES ('21', '1', 'Majestic-12 [Bot]', '23', 'MJ12bot/', '');
INSERT INTO `phpbb_bots` VALUES ('22', '1', 'Metager [Bot]', '24', 'MetagerBot/', '');
INSERT INTO `phpbb_bots` VALUES ('23', '1', 'MSN NewsBlogs', '25', 'msnbot-NewsBlogs/', '');
INSERT INTO `phpbb_bots` VALUES ('24', '1', 'MSN [Bot]', '26', 'msnbot/', '');
INSERT INTO `phpbb_bots` VALUES ('25', '1', 'MSNbot Media', '27', 'msnbot-media/', '');
INSERT INTO `phpbb_bots` VALUES ('26', '1', 'Nutch [Bot]', '28', 'http://lucene.apache.org/nutch/', '');
INSERT INTO `phpbb_bots` VALUES ('27', '1', 'Online link [Validator]', '29', 'online link validator', '');
INSERT INTO `phpbb_bots` VALUES ('28', '1', 'psbot [Picsearch]', '30', 'psbot/0', '');
INSERT INTO `phpbb_bots` VALUES ('29', '1', 'Sensis [Crawler]', '31', 'Sensis Web Crawler', '');
INSERT INTO `phpbb_bots` VALUES ('30', '1', 'SEO Crawler', '32', 'SEO search Crawler/', '');
INSERT INTO `phpbb_bots` VALUES ('31', '1', 'Seoma [Crawler]', '33', 'Seoma [SEO Crawler]', '');
INSERT INTO `phpbb_bots` VALUES ('32', '1', 'SEOSearch [Crawler]', '34', 'SEOsearch/', '');
INSERT INTO `phpbb_bots` VALUES ('33', '1', 'Snappy [Bot]', '35', 'Snappy/1.1 ( http://www.urltrends.com/ )', '');
INSERT INTO `phpbb_bots` VALUES ('34', '1', 'Steeler [Crawler]', '36', 'http://www.tkl.iis.u-tokyo.ac.jp/~crawler/', '');
INSERT INTO `phpbb_bots` VALUES ('35', '1', 'Telekom [Bot]', '37', 'crawleradmin.t-info@telekom.de', '');
INSERT INTO `phpbb_bots` VALUES ('36', '1', 'TurnitinBot [Bot]', '38', 'TurnitinBot/', '');
INSERT INTO `phpbb_bots` VALUES ('37', '1', 'Voyager [Bot]', '39', 'voyager/', '');
INSERT INTO `phpbb_bots` VALUES ('38', '1', 'W3 [Sitesearch]', '40', 'W3 SiteSearch Crawler', '');
INSERT INTO `phpbb_bots` VALUES ('39', '1', 'W3C [Linkcheck]', '41', 'W3C-checklink/', '');
INSERT INTO `phpbb_bots` VALUES ('40', '1', 'W3C [Validator]', '42', 'W3C_Validator', '');
INSERT INTO `phpbb_bots` VALUES ('41', '1', 'YaCy [Bot]', '43', 'yacybot', '');
INSERT INTO `phpbb_bots` VALUES ('42', '1', 'Yahoo MMCrawler [Bot]', '44', 'Yahoo-MMCrawler/', '');
INSERT INTO `phpbb_bots` VALUES ('43', '1', 'Yahoo Slurp [Bot]', '45', 'Yahoo! DE Slurp', '');
INSERT INTO `phpbb_bots` VALUES ('44', '1', 'Yahoo [Bot]', '46', 'Yahoo! Slurp', '');
INSERT INTO `phpbb_bots` VALUES ('45', '1', 'YahooSeeker [Bot]', '47', 'YahooSeeker/', '');

-- ----------------------------
-- Table structure for `phpbb_config`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_config`;
CREATE TABLE `phpbb_config` (
  `config_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `config_value` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `is_dynamic` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`config_name`),
  KEY `is_dynamic` (`is_dynamic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_config
-- ----------------------------
INSERT INTO `phpbb_config` VALUES ('active_sessions', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_attachments', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_autologin', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_avatar', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_avatar_gravatar', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_avatar_local', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_avatar_remote', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_avatar_remote_upload', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_avatar_upload', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_bbcode', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_birthdays', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_bookmarks', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_cdn', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_emailreuse', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_forum_notify', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_live_searches', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_mass_pm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_name_chars', 'USERNAME_CHARS_ANY', '0');
INSERT INTO `phpbb_config` VALUES ('allow_namechange', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_nocensors', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_password_reset', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_pm_attach', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_pm_report', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_post_flash', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_post_links', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_privmsg', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_quick_reply', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_sig', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_sig_bbcode', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_sig_flash', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_sig_img', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_sig_links', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_sig_pm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_sig_smilies', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_smilies', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_topic_notify', '1', '0');
INSERT INTO `phpbb_config` VALUES ('assets_version', '1', '0');
INSERT INTO `phpbb_config` VALUES ('attachment_quota', '52428800', '0');
INSERT INTO `phpbb_config` VALUES ('auth_bbcode_pm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('auth_flash_pm', '0', '0');
INSERT INTO `phpbb_config` VALUES ('auth_img_pm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('auth_method', 'db', '0');
INSERT INTO `phpbb_config` VALUES ('auth_smilies_pm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('avatar_filesize', '6144', '0');
INSERT INTO `phpbb_config` VALUES ('avatar_gallery_path', 'images/avatars/gallery', '0');
INSERT INTO `phpbb_config` VALUES ('avatar_max_height', '90', '0');
INSERT INTO `phpbb_config` VALUES ('avatar_max_width', '90', '0');
INSERT INTO `phpbb_config` VALUES ('avatar_min_height', '20', '0');
INSERT INTO `phpbb_config` VALUES ('avatar_min_width', '20', '0');
INSERT INTO `phpbb_config` VALUES ('avatar_path', 'images/avatars/upload', '0');
INSERT INTO `phpbb_config` VALUES ('avatar_salt', '3fb48adc0dd274aaf401e3442d2697a0', '0');
INSERT INTO `phpbb_config` VALUES ('board_contact', 'intita.hr@gmail.com', '0');
INSERT INTO `phpbb_config` VALUES ('board_contact_name', '', '0');
INSERT INTO `phpbb_config` VALUES ('board_disable', '0', '0');
INSERT INTO `phpbb_config` VALUES ('board_disable_msg', '', '0');
INSERT INTO `phpbb_config` VALUES ('board_email', 'intita.hr@gmail.com', '0');
INSERT INTO `phpbb_config` VALUES ('board_email_form', '0', '0');
INSERT INTO `phpbb_config` VALUES ('board_email_sig', 'Дякуємо, Адміністрація', '0');
INSERT INTO `phpbb_config` VALUES ('board_hide_emails', '1', '0');
INSERT INTO `phpbb_config` VALUES ('board_index_text', '', '0');
INSERT INTO `phpbb_config` VALUES ('board_startdate', '1431076924', '0');
INSERT INTO `phpbb_config` VALUES ('board_timezone', 'UTC', '0');
INSERT INTO `phpbb_config` VALUES ('browser_check', '1', '0');
INSERT INTO `phpbb_config` VALUES ('bump_interval', '10', '0');
INSERT INTO `phpbb_config` VALUES ('bump_type', 'd', '0');
INSERT INTO `phpbb_config` VALUES ('cache_gc', '7200', '0');
INSERT INTO `phpbb_config` VALUES ('cache_last_gc', '1431432161', '1');
INSERT INTO `phpbb_config` VALUES ('captcha_gd', '1', '0');
INSERT INTO `phpbb_config` VALUES ('captcha_gd_3d_noise', '1', '0');
INSERT INTO `phpbb_config` VALUES ('captcha_gd_fonts', '1', '0');
INSERT INTO `phpbb_config` VALUES ('captcha_gd_foreground_noise', '0', '0');
INSERT INTO `phpbb_config` VALUES ('captcha_gd_wave', '0', '0');
INSERT INTO `phpbb_config` VALUES ('captcha_gd_x_grid', '25', '0');
INSERT INTO `phpbb_config` VALUES ('captcha_gd_y_grid', '25', '0');
INSERT INTO `phpbb_config` VALUES ('captcha_plugin', 'core.captcha.plugins.gd', '0');
INSERT INTO `phpbb_config` VALUES ('check_attachment_content', '1', '0');
INSERT INTO `phpbb_config` VALUES ('check_dnsbl', '0', '0');
INSERT INTO `phpbb_config` VALUES ('chg_passforce', '0', '0');
INSERT INTO `phpbb_config` VALUES ('confirm_refresh', '1', '0');
INSERT INTO `phpbb_config` VALUES ('contact_admin_form_enable', '1', '0');
INSERT INTO `phpbb_config` VALUES ('cookie_domain', 'intita', '0');
INSERT INTO `phpbb_config` VALUES ('cookie_name', 'phpbb3_6vpfb', '0');
INSERT INTO `phpbb_config` VALUES ('cookie_path', '/', '0');
INSERT INTO `phpbb_config` VALUES ('cookie_secure', '0', '0');
INSERT INTO `phpbb_config` VALUES ('coppa_enable', '0', '0');
INSERT INTO `phpbb_config` VALUES ('coppa_fax', '', '0');
INSERT INTO `phpbb_config` VALUES ('coppa_mail', '', '0');
INSERT INTO `phpbb_config` VALUES ('cron_lock', '0', '1');
INSERT INTO `phpbb_config` VALUES ('database_gc', '604800', '0');
INSERT INTO `phpbb_config` VALUES ('database_last_gc', '1431077130', '1');
INSERT INTO `phpbb_config` VALUES ('dbms_version', '5.5.41-log', '0');
INSERT INTO `phpbb_config` VALUES ('default_dateformat', 'D M d, Y g:i a', '0');
INSERT INTO `phpbb_config` VALUES ('default_lang', 'uk', '0');
INSERT INTO `phpbb_config` VALUES ('default_style', '1', '0');
INSERT INTO `phpbb_config` VALUES ('delete_time', '0', '0');
INSERT INTO `phpbb_config` VALUES ('display_last_edited', '1', '0');
INSERT INTO `phpbb_config` VALUES ('display_last_subject', '1', '0');
INSERT INTO `phpbb_config` VALUES ('display_order', '0', '0');
INSERT INTO `phpbb_config` VALUES ('edit_time', '0', '0');
INSERT INTO `phpbb_config` VALUES ('email_check_mx', '1', '0');
INSERT INTO `phpbb_config` VALUES ('email_enable', '1', '0');
INSERT INTO `phpbb_config` VALUES ('email_function_name', 'mail', '0');
INSERT INTO `phpbb_config` VALUES ('email_max_chunk_size', '50', '0');
INSERT INTO `phpbb_config` VALUES ('email_package_size', '20', '0');
INSERT INTO `phpbb_config` VALUES ('enable_confirm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('enable_mod_rewrite', '0', '0');
INSERT INTO `phpbb_config` VALUES ('enable_pm_icons', '1', '0');
INSERT INTO `phpbb_config` VALUES ('enable_post_confirm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('extension_force_unstable', '0', '0');
INSERT INTO `phpbb_config` VALUES ('feed_enable', '1', '0');
INSERT INTO `phpbb_config` VALUES ('feed_forum', '1', '0');
INSERT INTO `phpbb_config` VALUES ('feed_http_auth', '0', '0');
INSERT INTO `phpbb_config` VALUES ('feed_item_statistics', '1', '0');
INSERT INTO `phpbb_config` VALUES ('feed_limit_post', '15', '0');
INSERT INTO `phpbb_config` VALUES ('feed_limit_topic', '10', '0');
INSERT INTO `phpbb_config` VALUES ('feed_overall', '1', '0');
INSERT INTO `phpbb_config` VALUES ('feed_overall_forums', '0', '0');
INSERT INTO `phpbb_config` VALUES ('feed_topic', '1', '0');
INSERT INTO `phpbb_config` VALUES ('feed_topics_active', '0', '0');
INSERT INTO `phpbb_config` VALUES ('feed_topics_new', '1', '0');
INSERT INTO `phpbb_config` VALUES ('flood_interval', '15', '0');
INSERT INTO `phpbb_config` VALUES ('force_server_vars', '0', '0');
INSERT INTO `phpbb_config` VALUES ('form_token_lifetime', '7200', '0');
INSERT INTO `phpbb_config` VALUES ('form_token_mintime', '0', '0');
INSERT INTO `phpbb_config` VALUES ('form_token_sid_guests', '1', '0');
INSERT INTO `phpbb_config` VALUES ('forward_pm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('forwarded_for_check', '0', '0');
INSERT INTO `phpbb_config` VALUES ('full_folder_action', '2', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_mysql_max_word_len', '254', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_mysql_min_word_len', '4', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_native_common_thres', '5', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_native_load_upd', '1', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_native_max_chars', '14', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_native_min_chars', '3', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_postgres_max_word_len', '254', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_postgres_min_word_len', '4', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_postgres_ts_name', 'simple', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_sphinx_indexer_mem_limit', '512', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_sphinx_stopwords', '0', '0');
INSERT INTO `phpbb_config` VALUES ('gzip_compress', '0', '0');
INSERT INTO `phpbb_config` VALUES ('hot_threshold', '25', '0');
INSERT INTO `phpbb_config` VALUES ('icons_path', 'images/icons', '0');
INSERT INTO `phpbb_config` VALUES ('img_create_thumbnail', '0', '0');
INSERT INTO `phpbb_config` VALUES ('img_display_inlined', '1', '0');
INSERT INTO `phpbb_config` VALUES ('img_imagick', 'd:/openserver/modules/imagemagick', '0');
INSERT INTO `phpbb_config` VALUES ('img_link_height', '0', '0');
INSERT INTO `phpbb_config` VALUES ('img_link_width', '0', '0');
INSERT INTO `phpbb_config` VALUES ('img_max_height', '0', '0');
INSERT INTO `phpbb_config` VALUES ('img_max_thumb_width', '400', '0');
INSERT INTO `phpbb_config` VALUES ('img_max_width', '0', '0');
INSERT INTO `phpbb_config` VALUES ('img_min_thumb_filesize', '12000', '0');
INSERT INTO `phpbb_config` VALUES ('ip_check', '3', '0');
INSERT INTO `phpbb_config` VALUES ('ip_login_limit_max', '50', '0');
INSERT INTO `phpbb_config` VALUES ('ip_login_limit_time', '21600', '0');
INSERT INTO `phpbb_config` VALUES ('ip_login_limit_use_forwarded', '0', '0');
INSERT INTO `phpbb_config` VALUES ('jab_enable', '0', '0');
INSERT INTO `phpbb_config` VALUES ('jab_host', '', '0');
INSERT INTO `phpbb_config` VALUES ('jab_package_size', '20', '0');
INSERT INTO `phpbb_config` VALUES ('jab_password', '', '0');
INSERT INTO `phpbb_config` VALUES ('jab_port', '5222', '0');
INSERT INTO `phpbb_config` VALUES ('jab_use_ssl', '0', '0');
INSERT INTO `phpbb_config` VALUES ('jab_username', '', '0');
INSERT INTO `phpbb_config` VALUES ('last_queue_run', '0', '1');
INSERT INTO `phpbb_config` VALUES ('ldap_base_dn', '', '0');
INSERT INTO `phpbb_config` VALUES ('ldap_email', '', '0');
INSERT INTO `phpbb_config` VALUES ('ldap_password', '', '0');
INSERT INTO `phpbb_config` VALUES ('ldap_port', '', '0');
INSERT INTO `phpbb_config` VALUES ('ldap_server', '', '0');
INSERT INTO `phpbb_config` VALUES ('ldap_uid', '', '0');
INSERT INTO `phpbb_config` VALUES ('ldap_user', '', '0');
INSERT INTO `phpbb_config` VALUES ('ldap_user_filter', '', '0');
INSERT INTO `phpbb_config` VALUES ('legend_sort_groupname', '0', '0');
INSERT INTO `phpbb_config` VALUES ('limit_load', '0', '0');
INSERT INTO `phpbb_config` VALUES ('limit_search_load', '0', '0');
INSERT INTO `phpbb_config` VALUES ('load_anon_lastread', '0', '0');
INSERT INTO `phpbb_config` VALUES ('load_birthdays', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_cpf_memberlist', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_cpf_pm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_cpf_viewprofile', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_cpf_viewtopic', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_db_lastread', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_db_track', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_jquery_url', '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', '0');
INSERT INTO `phpbb_config` VALUES ('load_jumpbox', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_moderators', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_notifications', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_online', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_online_guests', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_online_time', '5', '0');
INSERT INTO `phpbb_config` VALUES ('load_onlinetrack', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_search', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_tplcompile', '0', '0');
INSERT INTO `phpbb_config` VALUES ('load_unreads_search', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_user_activity', '1', '0');
INSERT INTO `phpbb_config` VALUES ('max_attachments', '3', '0');
INSERT INTO `phpbb_config` VALUES ('max_attachments_pm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('max_autologin_time', '0', '0');
INSERT INTO `phpbb_config` VALUES ('max_filesize', '262144', '0');
INSERT INTO `phpbb_config` VALUES ('max_filesize_pm', '262144', '0');
INSERT INTO `phpbb_config` VALUES ('max_login_attempts', '3', '0');
INSERT INTO `phpbb_config` VALUES ('max_name_chars', '20', '0');
INSERT INTO `phpbb_config` VALUES ('max_num_search_keywords', '10', '0');
INSERT INTO `phpbb_config` VALUES ('max_pass_chars', '100', '0');
INSERT INTO `phpbb_config` VALUES ('max_poll_options', '10', '0');
INSERT INTO `phpbb_config` VALUES ('max_post_chars', '60000', '0');
INSERT INTO `phpbb_config` VALUES ('max_post_font_size', '200', '0');
INSERT INTO `phpbb_config` VALUES ('max_post_img_height', '0', '0');
INSERT INTO `phpbb_config` VALUES ('max_post_img_width', '0', '0');
INSERT INTO `phpbb_config` VALUES ('max_post_smilies', '0', '0');
INSERT INTO `phpbb_config` VALUES ('max_post_urls', '0', '0');
INSERT INTO `phpbb_config` VALUES ('max_quote_depth', '3', '0');
INSERT INTO `phpbb_config` VALUES ('max_reg_attempts', '5', '0');
INSERT INTO `phpbb_config` VALUES ('max_sig_chars', '255', '0');
INSERT INTO `phpbb_config` VALUES ('max_sig_font_size', '200', '0');
INSERT INTO `phpbb_config` VALUES ('max_sig_img_height', '0', '0');
INSERT INTO `phpbb_config` VALUES ('max_sig_img_width', '0', '0');
INSERT INTO `phpbb_config` VALUES ('max_sig_smilies', '0', '0');
INSERT INTO `phpbb_config` VALUES ('max_sig_urls', '5', '0');
INSERT INTO `phpbb_config` VALUES ('mime_triggers', 'body|head|html|img|plaintext|a href|pre|script|table|title', '0');
INSERT INTO `phpbb_config` VALUES ('min_name_chars', '3', '0');
INSERT INTO `phpbb_config` VALUES ('min_pass_chars', '6', '0');
INSERT INTO `phpbb_config` VALUES ('min_post_chars', '1', '0');
INSERT INTO `phpbb_config` VALUES ('min_search_author_chars', '3', '0');
INSERT INTO `phpbb_config` VALUES ('new_member_group_default', '0', '0');
INSERT INTO `phpbb_config` VALUES ('new_member_post_limit', '3', '0');
INSERT INTO `phpbb_config` VALUES ('newest_user_colour', 'AA0000', '1');
INSERT INTO `phpbb_config` VALUES ('newest_user_id', '2', '1');
INSERT INTO `phpbb_config` VALUES ('newest_username', 'intita', '1');
INSERT INTO `phpbb_config` VALUES ('num_files', '0', '1');
INSERT INTO `phpbb_config` VALUES ('num_posts', '2', '1');
INSERT INTO `phpbb_config` VALUES ('num_topics', '2', '1');
INSERT INTO `phpbb_config` VALUES ('num_users', '1', '1');
INSERT INTO `phpbb_config` VALUES ('override_user_style', '0', '0');
INSERT INTO `phpbb_config` VALUES ('pass_complex', 'PASS_TYPE_ANY', '0');
INSERT INTO `phpbb_config` VALUES ('plupload_last_gc', '0', '1');
INSERT INTO `phpbb_config` VALUES ('plupload_salt', '817854cf7a4792286ce9f1c9f42f593c', '0');
INSERT INTO `phpbb_config` VALUES ('pm_edit_time', '0', '0');
INSERT INTO `phpbb_config` VALUES ('pm_max_boxes', '4', '0');
INSERT INTO `phpbb_config` VALUES ('pm_max_msgs', '50', '0');
INSERT INTO `phpbb_config` VALUES ('pm_max_recipients', '0', '0');
INSERT INTO `phpbb_config` VALUES ('posts_per_page', '10', '0');
INSERT INTO `phpbb_config` VALUES ('print_pm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('questionnaire_unique_id', '793ec7662bd4d575', '0');
INSERT INTO `phpbb_config` VALUES ('queue_interval', '60', '0');
INSERT INTO `phpbb_config` VALUES ('rand_seed', '7ed1b335fa3d47a385585bb4440b7770', '1');
INSERT INTO `phpbb_config` VALUES ('rand_seed_last_update', '1431504484', '1');
INSERT INTO `phpbb_config` VALUES ('ranks_path', 'images/ranks', '0');
INSERT INTO `phpbb_config` VALUES ('read_notification_expire_days', '30', '0');
INSERT INTO `phpbb_config` VALUES ('read_notification_gc', '86400', '0');
INSERT INTO `phpbb_config` VALUES ('read_notification_last_gc', '1431504484', '1');
INSERT INTO `phpbb_config` VALUES ('record_online_date', '1431077095', '1');
INSERT INTO `phpbb_config` VALUES ('record_online_users', '2', '1');
INSERT INTO `phpbb_config` VALUES ('referer_validation', '1', '0');
INSERT INTO `phpbb_config` VALUES ('require_activation', '0', '0');
INSERT INTO `phpbb_config` VALUES ('script_path', '/forum', '0');
INSERT INTO `phpbb_config` VALUES ('search_anonymous_interval', '0', '0');
INSERT INTO `phpbb_config` VALUES ('search_block_size', '250', '0');
INSERT INTO `phpbb_config` VALUES ('search_gc', '7200', '0');
INSERT INTO `phpbb_config` VALUES ('search_indexing_state', '', '1');
INSERT INTO `phpbb_config` VALUES ('search_interval', '0', '0');
INSERT INTO `phpbb_config` VALUES ('search_last_gc', '1431165018', '1');
INSERT INTO `phpbb_config` VALUES ('search_store_results', '1800', '0');
INSERT INTO `phpbb_config` VALUES ('search_type', '\\phpbb\\search\\fulltext_native', '0');
INSERT INTO `phpbb_config` VALUES ('secure_allow_deny', '1', '0');
INSERT INTO `phpbb_config` VALUES ('secure_allow_empty_referer', '1', '0');
INSERT INTO `phpbb_config` VALUES ('secure_downloads', '0', '0');
INSERT INTO `phpbb_config` VALUES ('server_name', 'intita', '0');
INSERT INTO `phpbb_config` VALUES ('server_port', '80', '0');
INSERT INTO `phpbb_config` VALUES ('server_protocol', 'http://', '0');
INSERT INTO `phpbb_config` VALUES ('session_gc', '3600', '0');
INSERT INTO `phpbb_config` VALUES ('session_last_gc', '1431504213', '1');
INSERT INTO `phpbb_config` VALUES ('session_length', '3600', '0');
INSERT INTO `phpbb_config` VALUES ('site_desc', 'IT Академія', '0');
INSERT INTO `phpbb_config` VALUES ('site_home_text', '', '0');
INSERT INTO `phpbb_config` VALUES ('site_home_url', '', '0');
INSERT INTO `phpbb_config` VALUES ('sitename', 'intita.itatests.com', '0');
INSERT INTO `phpbb_config` VALUES ('smilies_path', 'images/smilies', '0');
INSERT INTO `phpbb_config` VALUES ('smilies_per_page', '50', '0');
INSERT INTO `phpbb_config` VALUES ('smtp_auth_method', 'PLAIN', '0');
INSERT INTO `phpbb_config` VALUES ('smtp_delivery', '0', '0');
INSERT INTO `phpbb_config` VALUES ('smtp_host', '', '0');
INSERT INTO `phpbb_config` VALUES ('smtp_password', '', '0');
INSERT INTO `phpbb_config` VALUES ('smtp_port', '25', '0');
INSERT INTO `phpbb_config` VALUES ('smtp_username', '', '0');
INSERT INTO `phpbb_config` VALUES ('teampage_forums', '1', '0');
INSERT INTO `phpbb_config` VALUES ('teampage_memberships', '1', '0');
INSERT INTO `phpbb_config` VALUES ('topics_per_page', '25', '0');
INSERT INTO `phpbb_config` VALUES ('tpl_allow_php', '0', '0');
INSERT INTO `phpbb_config` VALUES ('upload_dir_size', '0', '1');
INSERT INTO `phpbb_config` VALUES ('upload_icons_path', 'images/upload_icons', '0');
INSERT INTO `phpbb_config` VALUES ('upload_path', 'files', '0');
INSERT INTO `phpbb_config` VALUES ('use_system_cron', '0', '0');
INSERT INTO `phpbb_config` VALUES ('version', '3.1.4', '0');
INSERT INTO `phpbb_config` VALUES ('warnings_expire_days', '90', '0');
INSERT INTO `phpbb_config` VALUES ('warnings_gc', '14400', '0');
INSERT INTO `phpbb_config` VALUES ('warnings_last_gc', '1431165013', '1');

-- ----------------------------
-- Table structure for `phpbb_config_text`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_config_text`;
CREATE TABLE `phpbb_config_text` (
  `config_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `config_value` mediumtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`config_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_config_text
-- ----------------------------
INSERT INTO `phpbb_config_text` VALUES ('contact_admin_info', '');
INSERT INTO `phpbb_config_text` VALUES ('contact_admin_info_bitfield', '');
INSERT INTO `phpbb_config_text` VALUES ('contact_admin_info_flags', 0x37);
INSERT INTO `phpbb_config_text` VALUES ('contact_admin_info_uid', '');

-- ----------------------------
-- Table structure for `phpbb_confirm`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_confirm`;
CREATE TABLE `phpbb_confirm` (
  `confirm_id` char(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_id` char(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `confirm_type` tinyint(3) NOT NULL DEFAULT '0',
  `code` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `seed` int(10) unsigned NOT NULL DEFAULT '0',
  `attempts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`,`confirm_id`),
  KEY `confirm_type` (`confirm_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_confirm
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_disallow`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_disallow`;
CREATE TABLE `phpbb_disallow` (
  `disallow_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `disallow_username` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`disallow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_disallow
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_drafts`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_drafts`;
CREATE TABLE `phpbb_drafts` (
  `draft_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `save_time` int(11) unsigned NOT NULL DEFAULT '0',
  `draft_subject` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `draft_message` mediumtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`draft_id`),
  KEY `save_time` (`save_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_drafts
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_ext`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_ext`;
CREATE TABLE `phpbb_ext` (
  `ext_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ext_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ext_state` text COLLATE utf8_bin NOT NULL,
  UNIQUE KEY `ext_name` (`ext_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_ext
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_extensions`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_extensions`;
CREATE TABLE `phpbb_extensions` (
  `extension_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `extension` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`extension_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_extensions
-- ----------------------------
INSERT INTO `phpbb_extensions` VALUES ('1', '1', 'gif');
INSERT INTO `phpbb_extensions` VALUES ('2', '1', 'png');
INSERT INTO `phpbb_extensions` VALUES ('3', '1', 'jpeg');
INSERT INTO `phpbb_extensions` VALUES ('4', '1', 'jpg');
INSERT INTO `phpbb_extensions` VALUES ('5', '1', 'tif');
INSERT INTO `phpbb_extensions` VALUES ('6', '1', 'tiff');
INSERT INTO `phpbb_extensions` VALUES ('7', '1', 'tga');
INSERT INTO `phpbb_extensions` VALUES ('8', '2', 'gtar');
INSERT INTO `phpbb_extensions` VALUES ('9', '2', 'gz');
INSERT INTO `phpbb_extensions` VALUES ('10', '2', 'tar');
INSERT INTO `phpbb_extensions` VALUES ('11', '2', 'zip');
INSERT INTO `phpbb_extensions` VALUES ('12', '2', 'rar');
INSERT INTO `phpbb_extensions` VALUES ('13', '2', 'ace');
INSERT INTO `phpbb_extensions` VALUES ('14', '2', 'torrent');
INSERT INTO `phpbb_extensions` VALUES ('15', '2', 'tgz');
INSERT INTO `phpbb_extensions` VALUES ('16', '2', 'bz2');
INSERT INTO `phpbb_extensions` VALUES ('17', '2', '7z');
INSERT INTO `phpbb_extensions` VALUES ('18', '3', 'txt');
INSERT INTO `phpbb_extensions` VALUES ('19', '3', 'c');
INSERT INTO `phpbb_extensions` VALUES ('20', '3', 'h');
INSERT INTO `phpbb_extensions` VALUES ('21', '3', 'cpp');
INSERT INTO `phpbb_extensions` VALUES ('22', '3', 'hpp');
INSERT INTO `phpbb_extensions` VALUES ('23', '3', 'diz');
INSERT INTO `phpbb_extensions` VALUES ('24', '3', 'csv');
INSERT INTO `phpbb_extensions` VALUES ('25', '3', 'ini');
INSERT INTO `phpbb_extensions` VALUES ('26', '3', 'log');
INSERT INTO `phpbb_extensions` VALUES ('27', '3', 'js');
INSERT INTO `phpbb_extensions` VALUES ('28', '3', 'xml');
INSERT INTO `phpbb_extensions` VALUES ('29', '4', 'xls');
INSERT INTO `phpbb_extensions` VALUES ('30', '4', 'xlsx');
INSERT INTO `phpbb_extensions` VALUES ('31', '4', 'xlsm');
INSERT INTO `phpbb_extensions` VALUES ('32', '4', 'xlsb');
INSERT INTO `phpbb_extensions` VALUES ('33', '4', 'doc');
INSERT INTO `phpbb_extensions` VALUES ('34', '4', 'docx');
INSERT INTO `phpbb_extensions` VALUES ('35', '4', 'docm');
INSERT INTO `phpbb_extensions` VALUES ('36', '4', 'dot');
INSERT INTO `phpbb_extensions` VALUES ('37', '4', 'dotx');
INSERT INTO `phpbb_extensions` VALUES ('38', '4', 'dotm');
INSERT INTO `phpbb_extensions` VALUES ('39', '4', 'pdf');
INSERT INTO `phpbb_extensions` VALUES ('40', '4', 'ai');
INSERT INTO `phpbb_extensions` VALUES ('41', '4', 'ps');
INSERT INTO `phpbb_extensions` VALUES ('42', '4', 'ppt');
INSERT INTO `phpbb_extensions` VALUES ('43', '4', 'pptx');
INSERT INTO `phpbb_extensions` VALUES ('44', '4', 'pptm');
INSERT INTO `phpbb_extensions` VALUES ('45', '4', 'odg');
INSERT INTO `phpbb_extensions` VALUES ('46', '4', 'odp');
INSERT INTO `phpbb_extensions` VALUES ('47', '4', 'ods');
INSERT INTO `phpbb_extensions` VALUES ('48', '4', 'odt');
INSERT INTO `phpbb_extensions` VALUES ('49', '4', 'rtf');
INSERT INTO `phpbb_extensions` VALUES ('50', '5', 'rm');
INSERT INTO `phpbb_extensions` VALUES ('51', '5', 'ram');
INSERT INTO `phpbb_extensions` VALUES ('52', '6', 'wma');
INSERT INTO `phpbb_extensions` VALUES ('53', '6', 'wmv');
INSERT INTO `phpbb_extensions` VALUES ('54', '7', 'swf');
INSERT INTO `phpbb_extensions` VALUES ('55', '8', 'mov');
INSERT INTO `phpbb_extensions` VALUES ('56', '8', 'm4v');
INSERT INTO `phpbb_extensions` VALUES ('57', '8', 'm4a');
INSERT INTO `phpbb_extensions` VALUES ('58', '8', 'mp4');
INSERT INTO `phpbb_extensions` VALUES ('59', '8', '3gp');
INSERT INTO `phpbb_extensions` VALUES ('60', '8', '3g2');
INSERT INTO `phpbb_extensions` VALUES ('61', '8', 'qt');
INSERT INTO `phpbb_extensions` VALUES ('62', '9', 'mpeg');
INSERT INTO `phpbb_extensions` VALUES ('63', '9', 'mpg');
INSERT INTO `phpbb_extensions` VALUES ('64', '9', 'mp3');
INSERT INTO `phpbb_extensions` VALUES ('65', '9', 'ogg');
INSERT INTO `phpbb_extensions` VALUES ('66', '9', 'ogm');

-- ----------------------------
-- Table structure for `phpbb_extension_groups`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_extension_groups`;
CREATE TABLE `phpbb_extension_groups` (
  `group_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `cat_id` tinyint(2) NOT NULL DEFAULT '0',
  `allow_group` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `download_mode` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `upload_icon` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `max_filesize` int(20) unsigned NOT NULL DEFAULT '0',
  `allowed_forums` text COLLATE utf8_bin NOT NULL,
  `allow_in_pm` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_extension_groups
-- ----------------------------
INSERT INTO `phpbb_extension_groups` VALUES ('1', 'IMAGES', '1', '1', '1', '', '0', '', '0');
INSERT INTO `phpbb_extension_groups` VALUES ('2', 'ARCHIVES', '0', '1', '1', '', '0', '', '0');
INSERT INTO `phpbb_extension_groups` VALUES ('3', 'PLAIN_TEXT', '0', '0', '1', '', '0', '', '0');
INSERT INTO `phpbb_extension_groups` VALUES ('4', 'DOCUMENTS', '0', '0', '1', '', '0', '', '0');
INSERT INTO `phpbb_extension_groups` VALUES ('5', 'REAL_MEDIA', '3', '0', '1', '', '0', '', '0');
INSERT INTO `phpbb_extension_groups` VALUES ('6', 'WINDOWS_MEDIA', '2', '0', '1', '', '0', '', '0');
INSERT INTO `phpbb_extension_groups` VALUES ('7', 'FLASH_FILES', '5', '0', '1', '', '0', '', '0');
INSERT INTO `phpbb_extension_groups` VALUES ('8', 'QUICKTIME_MEDIA', '6', '0', '1', '', '0', '', '0');
INSERT INTO `phpbb_extension_groups` VALUES ('9', 'DOWNLOADABLE_FILES', '0', '0', '1', '', '0', '', '0');

-- ----------------------------
-- Table structure for `phpbb_forums`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_forums`;
CREATE TABLE `phpbb_forums` (
  `forum_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `left_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `right_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_parents` mediumtext COLLATE utf8_bin NOT NULL,
  `forum_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_desc` text COLLATE utf8_bin NOT NULL,
  `forum_desc_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_desc_options` int(11) unsigned NOT NULL DEFAULT '7',
  `forum_desc_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_link` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_password` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_style` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_image` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_rules` text COLLATE utf8_bin NOT NULL,
  `forum_rules_link` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_rules_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_rules_options` int(11) unsigned NOT NULL DEFAULT '7',
  `forum_rules_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_topics_per_page` tinyint(4) NOT NULL DEFAULT '0',
  `forum_type` tinyint(4) NOT NULL DEFAULT '0',
  `forum_status` tinyint(4) NOT NULL DEFAULT '0',
  `forum_last_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_last_poster_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_last_post_subject` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_last_post_time` int(11) unsigned NOT NULL DEFAULT '0',
  `forum_last_poster_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_last_poster_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_flags` tinyint(4) NOT NULL DEFAULT '32',
  `display_on_index` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_indexing` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_icons` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_prune` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `prune_next` int(11) unsigned NOT NULL DEFAULT '0',
  `prune_days` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `prune_viewed` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `prune_freq` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `display_subforum_list` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `forum_options` int(20) unsigned NOT NULL DEFAULT '0',
  `enable_shadow_prune` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `prune_shadow_days` mediumint(8) unsigned NOT NULL DEFAULT '7',
  `prune_shadow_freq` mediumint(8) unsigned NOT NULL DEFAULT '1',
  `prune_shadow_next` int(11) NOT NULL DEFAULT '0',
  `forum_posts_approved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_posts_unapproved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_posts_softdeleted` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_topics_approved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_topics_unapproved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_topics_softdeleted` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`forum_id`),
  KEY `left_right_id` (`left_id`,`right_id`),
  KEY `forum_lastpost_id` (`forum_last_post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_forums
-- ----------------------------
INSERT INTO `phpbb_forums` VALUES ('1', '0', '1', '4', '', 'Ваша перша категорія', '', '', '7', '', '', '', '0', '', '', '', '', '7', '', '0', '0', '0', '1', '2', '', '1431076924', 'intita', 'AA0000', '32', '1', '1', '1', '0', '0', '0', '0', '0', '1', '0', '0', '7', '1', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `phpbb_forums` VALUES ('2', '1', '2', '3', 0x613A313A7B693A313B613A323A7B693A303B733A33383A22D092D0B0D188D0B020D0BFD0B5D180D188D0B020D0BAD0B0D182D0B5D0B3D0BED180D196D18F223B693A313B693A303B7D7D, 'Ваш перший форум', 0xD09ED0BFD0B8D18120D0B2D0B0D188D0BED0B3D0BE20D0BFD0B5D180D188D0BED0B3D0BE20D184D0BED180D183D0BCD1832E, '', '7', '', '', '', '0', '', '', '', '', '7', '', '0', '1', '0', '2', '2', '8 травня', '1431082457', 'intita', 'AA0000', '48', '1', '1', '1', '0', '0', '0', '0', '0', '1', '0', '0', '7', '1', '0', '2', '0', '0', '2', '0', '0');

-- ----------------------------
-- Table structure for `phpbb_forums_access`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_forums_access`;
CREATE TABLE `phpbb_forums_access` (
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `session_id` char(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`forum_id`,`user_id`,`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_forums_access
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_forums_track`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_forums_track`;
CREATE TABLE `phpbb_forums_track` (
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `mark_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`forum_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_forums_track
-- ----------------------------
INSERT INTO `phpbb_forums_track` VALUES ('2', '2', '1431082457');

-- ----------------------------
-- Table structure for `phpbb_forums_watch`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_forums_watch`;
CREATE TABLE `phpbb_forums_watch` (
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `notify_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  KEY `forum_id` (`forum_id`),
  KEY `user_id` (`user_id`),
  KEY `notify_stat` (`notify_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_forums_watch
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_groups`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_groups`;
CREATE TABLE `phpbb_groups` (
  `group_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_type` tinyint(4) NOT NULL DEFAULT '1',
  `group_founder_manage` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `group_skip_auth` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `group_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_desc` text COLLATE utf8_bin NOT NULL,
  `group_desc_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_desc_options` int(11) unsigned NOT NULL DEFAULT '7',
  `group_desc_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `group_avatar` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_avatar_type` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_avatar_width` smallint(4) unsigned NOT NULL DEFAULT '0',
  `group_avatar_height` smallint(4) unsigned NOT NULL DEFAULT '0',
  `group_rank` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_sig_chars` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_receive_pm` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `group_message_limit` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_legend` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_max_recipients` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`),
  KEY `group_legend_name` (`group_legend`,`group_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_groups
-- ----------------------------
INSERT INTO `phpbb_groups` VALUES ('1', '3', '0', '0', 'GUESTS', '', '', '7', '', '0', '', '', '0', '0', '0', '', '0', '0', '0', '0', '5');
INSERT INTO `phpbb_groups` VALUES ('2', '3', '0', '0', 'REGISTERED', '', '', '7', '', '0', '', '', '0', '0', '0', '', '0', '0', '0', '0', '5');
INSERT INTO `phpbb_groups` VALUES ('3', '3', '0', '0', 'REGISTERED_COPPA', '', '', '7', '', '0', '', '', '0', '0', '0', '', '0', '0', '0', '0', '5');
INSERT INTO `phpbb_groups` VALUES ('4', '3', '0', '0', 'GLOBAL_MODERATORS', '', '', '7', '', '0', '', '', '0', '0', '0', '00AA00', '0', '0', '0', '2', '0');
INSERT INTO `phpbb_groups` VALUES ('5', '3', '1', '0', 'ADMINISTRATORS', '', '', '7', '', '0', '', '', '0', '0', '0', 'AA0000', '0', '0', '0', '1', '0');
INSERT INTO `phpbb_groups` VALUES ('6', '3', '0', '0', 'BOTS', '', '', '7', '', '0', '', '', '0', '0', '0', '9E8DA7', '0', '0', '0', '0', '5');
INSERT INTO `phpbb_groups` VALUES ('7', '3', '0', '0', 'NEWLY_REGISTERED', '', '', '7', '', '0', '', '', '0', '0', '0', '', '0', '0', '0', '0', '5');

-- ----------------------------
-- Table structure for `phpbb_icons`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_icons`;
CREATE TABLE `phpbb_icons` (
  `icons_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `icons_url` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `icons_width` tinyint(4) NOT NULL DEFAULT '0',
  `icons_height` tinyint(4) NOT NULL DEFAULT '0',
  `icons_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `display_on_posting` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`icons_id`),
  KEY `display_on_posting` (`display_on_posting`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_icons
-- ----------------------------
INSERT INTO `phpbb_icons` VALUES ('1', 'misc/fire.gif', '16', '16', '1', '1');
INSERT INTO `phpbb_icons` VALUES ('2', 'smile/redface.gif', '16', '16', '9', '1');
INSERT INTO `phpbb_icons` VALUES ('3', 'smile/mrgreen.gif', '16', '16', '10', '1');
INSERT INTO `phpbb_icons` VALUES ('4', 'misc/heart.gif', '16', '16', '4', '1');
INSERT INTO `phpbb_icons` VALUES ('5', 'misc/star.gif', '16', '16', '2', '1');
INSERT INTO `phpbb_icons` VALUES ('6', 'misc/radioactive.gif', '16', '16', '3', '1');
INSERT INTO `phpbb_icons` VALUES ('7', 'misc/thinking.gif', '16', '16', '5', '1');
INSERT INTO `phpbb_icons` VALUES ('8', 'smile/info.gif', '16', '16', '8', '1');
INSERT INTO `phpbb_icons` VALUES ('9', 'smile/question.gif', '16', '16', '6', '1');
INSERT INTO `phpbb_icons` VALUES ('10', 'smile/alert.gif', '16', '16', '7', '1');

-- ----------------------------
-- Table structure for `phpbb_lang`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_lang`;
CREATE TABLE `phpbb_lang` (
  `lang_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `lang_iso` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `lang_dir` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `lang_english_name` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `lang_local_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `lang_author` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`lang_id`),
  KEY `lang_iso` (`lang_iso`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_lang
-- ----------------------------
INSERT INTO `phpbb_lang` VALUES ('1', 'en', 'en', 'British English', 'British English', 'phpBB Limited');
INSERT INTO `phpbb_lang` VALUES ('2', 'uk', 'uk', 'Ukrainian', 'Українська', 'Black_SN');

-- ----------------------------
-- Table structure for `phpbb_log`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_log`;
CREATE TABLE `phpbb_log` (
  `log_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `log_type` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `reportee_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `log_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `log_time` int(11) unsigned NOT NULL DEFAULT '0',
  `log_operation` text COLLATE utf8_bin NOT NULL,
  `log_data` mediumtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `log_type` (`log_type`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`),
  KEY `reportee_id` (`reportee_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_log
-- ----------------------------
INSERT INTO `phpbb_log` VALUES ('1', '0', '2', '0', '0', '0', '127.0.0.1', '1431076934', 0x4C4F475F494E5354414C4C5F494E5354414C4C4544, 0x613A313A7B693A303B733A353A22332E312E34223B7D);

-- ----------------------------
-- Table structure for `phpbb_login_attempts`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_login_attempts`;
CREATE TABLE `phpbb_login_attempts` (
  `attempt_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `attempt_browser` varchar(150) COLLATE utf8_bin NOT NULL DEFAULT '',
  `attempt_forwarded_for` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `attempt_time` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `username_clean` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '0',
  KEY `att_ip` (`attempt_ip`,`attempt_time`),
  KEY `att_for` (`attempt_forwarded_for`,`attempt_time`),
  KEY `att_time` (`attempt_time`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_login_attempts
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_migrations`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_migrations`;
CREATE TABLE `phpbb_migrations` (
  `migration_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `migration_depends_on` text COLLATE utf8_bin NOT NULL,
  `migration_schema_done` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `migration_data_done` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `migration_data_state` text COLLATE utf8_bin NOT NULL,
  `migration_start_time` int(11) unsigned NOT NULL DEFAULT '0',
  `migration_end_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`migration_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_migrations
-- ----------------------------
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\local_url_bbcode', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31325F726331223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_0', 0x613A303A7B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_1', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F315F726331223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_10', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31305F726333223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_10_rc1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F39223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_10_rc2', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31305F726331223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_10_rc3', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31305F726332223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31315F726332223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11_rc1', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3130223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11_rc2', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31315F726331223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_12', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31325F726333223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_12_rc1', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3131223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_12_rc2', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31325F726331223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_12_rc3', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31325F726332223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_13', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31335F726331223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_13_pl1', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3133223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_13_rc1', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3132223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_14', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31345F726331223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_14_rc1', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3133223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_1_rc1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F30223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_2', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F325F726332223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_2_rc1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_2_rc2', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F325F726331223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_3', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F335F726331223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_3_rc1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F32223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_4', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F345F726331223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_4_rc1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F33223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_5', 0x613A313A7B693A303B733A35323A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F355F7263317061727432223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_5_rc1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F34223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_5_rc1part2', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F355F726331223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F365F726334223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6_rc1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F35223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6_rc2', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F365F726331223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6_rc3', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F365F726332223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6_rc4', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F365F726333223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_7', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F375F726332223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_7_pl1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F37223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_7_rc1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F36223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_7_rc2', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F375F726331223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_8', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F385F726331223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_8_rc1', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F375F706C31223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F395F726334223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9_rc1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F38223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9_rc2', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F395F726331223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9_rc3', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F395F726332223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9_rc4', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F395F726333223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\acp_prune_users_module', 0x613A313A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6265746131223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\acp_style_components_module', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\allow_cdn', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6A71756572795F757064617465223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\alpha1', 0x613A31383A7B693A303B733A34363A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C6C6F63616C5F75726C5F6262636F6465223B693A313B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3132223B693A323B733A35373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6163705F7374796C655F636F6D706F6E656E74735F6D6F64756C65223B693A333B733A33393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C616C6C6F775F63646E223B693A343B733A34393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C617574685F70726F76696465725F6F61757468223B693A353B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C61766174617273223B693A363B733A34303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C626F617264696E646578223B693A373B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C636F6E6669675F64625F74657874223B693A383B733A34353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C666F72676F745F70617373776F7264223B693A393B733A34313A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6D6F645F72657772697465223B693A31303B733A34393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6D7973716C5F66756C6C746578745F64726F70223B693A31313B733A34303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6E616D65737061636573223B693A31323B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6E6F74696669636174696F6E735F63726F6E223B693A31333B733A36303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6E6F74696669636174696F6E5F6F7074696F6E735F7265636F6E76657274223B693A31343B733A33383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C706C75706C6F6164223B693A31353B733A35313A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C7369676E61747572655F6D6F64756C655F61757468223B693A31363B733A35323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C736F667464656C6574655F6D63705F6D6F64756C6573223B693A31373B733A33383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C7465616D70616765223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\alpha2', 0x613A323A7B693A303B733A33363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C616C70686131223B693A313B733A35313A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6E6F74696669636174696F6E735F63726F6E5F7032223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\alpha3', 0x613A343A7B693A303B733A33363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C616C70686132223B693A313B733A34323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6176617461725F7479706573223B693A323B733A33393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70617373776F726473223B693A333B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7479706573223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\auth_provider_oauth', 0x613A303A7B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\auth_provider_oauth2', 0x613A313A7B693A303B733A34393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C617574685F70726F76696465725F6F61757468223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\avatar_types', 0x613A323A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B693A313B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C61766174617273223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\avatars', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3131223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\beta1', 0x613A373A7B693A303B733A33363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C616C70686133223B693A313B733A34323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70617373776F7264735F7032223B693A323B733A35323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C706F7374677265735F66756C6C746578745F64726F70223B693A333B733A36333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6368616E67655F6C6F61645F73657474696E6773223B693A343B733A35313A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6C6F636174696F6E223B693A353B733A35343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C736F66745F64656C6574655F6D6F645F636F6E7665727432223B693A363B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C7563705F706F707570706D5F6D6F64756C65223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\beta2', 0x613A333A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6265746131223B693A313B733A35323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6163705F7072756E655F75736572735F6D6F64756C65223B693A323B733A35393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6C6F636174696F6E5F636C65616E7570223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\beta3', 0x613A363A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6265746132223B693A313B733A35303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C617574685F70726F76696465725F6F6175746832223B693A323B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C626F6172645F636F6E746163745F6E616D65223B693A333B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6A71756572795F75706461746532223B693A343B733A35303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6C6976655F73656172636865735F636F6E666967223B693A353B733A34393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C7072756E655F736861646F775F746F70696373223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\beta4', 0x613A333A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6265746133223B693A313B733A36393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C657874656E73696F6E735F76657273696F6E5F636865636B5F666F7263655F756E737461626C65223B693A323B733A35383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C72657365745F6D697373696E675F636170746368615F706C7567696E223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\board_contact_name', 0x613A313A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6265746132223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\boardindex', 0x613A303A7B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\bot_update', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726336223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\captcha_plugins', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726332223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\config_db_text', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3131223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\contact_admin_acp_module', 0x613A303A7B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\contact_admin_form', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C636F6E6669675F64625F74657874223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\dev', 0x613A353A7B693A303B733A34303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C657874656E73696F6E73223B693A313B733A34353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C7374796C655F7570646174655F7032223B693A323B733A34313A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C74696D657A6F6E655F7032223B693A333B733A35323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C7265706F727465645F706F7374735F646973706C6179223B693A343B733A34363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6D6967726174696F6E735F7461626C65223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\extensions', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3131223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\extensions_version_check_force_unstable', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\forgot_password', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3131223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\gold', 0x613A323A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726336223B693A313B733A34303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C626F745F757064617465223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\jquery_update', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\jquery_update2', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6A71756572795F757064617465223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\live_searches_config', 0x613A303A7B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\migrations_table', 0x613A303A7B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\mod_rewrite', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\mysql_fulltext_drop', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\namespaces', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\notification_options_reconvert', 0x613A313A7B693A303B733A35343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6E6F74696669636174696F6E735F736368656D615F666978223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\notifications', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\notifications_cron', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6E6F74696669636174696F6E73223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\notifications_cron_p2', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6E6F74696669636174696F6E735F63726F6E223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\notifications_schema_fix', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6E6F74696669636174696F6E73223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\notifications_use_full_name', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726333223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\passwords', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3131223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\passwords_convert_p1', 0x613A313A7B693A303B733A34323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70617373776F7264735F7032223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\passwords_convert_p2', 0x613A313A7B693A303B733A35303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70617373776F7264735F636F6E766572745F7031223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\passwords_p2', 0x613A313A7B693A303B733A33393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70617373776F726473223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\plupload', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\postgres_fulltext_drop', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_aol', 0x613A313A7B693A303B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7961686F6F5F636C65616E7570223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_aol_cleanup', 0x613A313A7B693A303B733A34363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F616F6C223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_change_load_settings', 0x613A313A7B693A303B733A35343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F616F6C5F636C65616E7570223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_cleanup', 0x613A323A7B693A303B733A35323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F696E74657265737473223B693A313B733A35333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6F636375706174696F6E223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_contact_field', 0x613A313A7B693A303B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6F6E5F6D656D6265726C697374223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_facebook', 0x613A333A7B693A303B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F636F6E746163745F6669656C64223B693A313B733A35353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F73686F775F6E6F76616C7565223B693A323B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7479706573223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_field_validation_length', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726333223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_googleplus', 0x613A333A7B693A303B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F636F6E746163745F6669656C64223B693A313B733A35353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F73686F775F6E6F76616C7565223B693A323B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7479706573223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_icq', 0x613A313A7B693A303B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F636F6E746163745F6669656C64223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_icq_cleanup', 0x613A313A7B693A303B733A34363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F696371223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_interests', 0x613A323A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7479706573223B693A313B733A35353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F73686F775F6E6F76616C7565223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_location', 0x613A323A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7479706573223B693A313B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6F6E5F6D656D6265726C697374223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_location_cleanup', 0x613A313A7B693A303B733A35313A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6C6F636174696F6E223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_occupation', 0x613A313A7B693A303B733A35323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F696E74657265737473223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_on_memberlist', 0x613A313A7B693A303B733A35303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F636C65616E7570223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_show_novalue', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7479706573223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_skype', 0x613A333A7B693A303B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F636F6E746163745F6669656C64223B693A313B733A35353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F73686F775F6E6F76616C7565223B693A323B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7479706573223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_twitter', 0x613A333A7B693A303B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F636F6E746163745F6669656C64223B693A313B733A35353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F73686F775F6E6F76616C7565223B693A323B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7479706573223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_types', 0x613A313A7B693A303B733A33363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C616C70686132223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_website', 0x613A323A7B693A303B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6F6E5F6D656D6265726C697374223B693A313B733A35343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6963715F636C65616E7570223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_website_cleanup', 0x613A313A7B693A303B733A35303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F77656273697465223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_wlm', 0x613A313A7B693A303B733A35383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F776562736974655F636C65616E7570223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_wlm_cleanup', 0x613A313A7B693A303B733A34363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F776C6D223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_yahoo', 0x613A313A7B693A303B733A35343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F776C6D5F636C65616E7570223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_yahoo_cleanup', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7961686F6F223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_youtube', 0x613A333A7B693A303B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F636F6E746163745F6669656C64223B693A313B733A35353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F73686F775F6E6F76616C7565223B693A323B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7479706573223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\prune_shadow_topics', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\rc1', 0x613A393A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6265746134223B693A313B733A35343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C636F6E746163745F61646D696E5F6163705F6D6F64756C65223B693A323B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C636F6E746163745F61646D696E5F666F726D223B693A333B733A35303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70617373776F7264735F636F6E766572745F7032223B693A343B733A35313A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F66616365626F6F6B223B693A353B733A35333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F676F6F676C65706C7573223B693A363B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F736B797065223B693A373B733A35303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F74776974746572223B693A383B733A35303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F796F7574756265223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\rc2', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726331223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\rc3', 0x613A353A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726332223B693A313B733A34353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C636170746368615F706C7567696E73223B693A323B733A35333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C72656E616D655F746F6F5F6C6F6E675F696E6465786573223B693A333B733A34313A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C7365617263685F74797065223B693A343B733A34393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C746F7069635F736F72745F757365726E616D65223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\rc4', 0x613A323A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726333223B693A313B733A35373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6E6F74696669636174696F6E735F7573655F66756C6C5F6E616D65223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\rc5', 0x613A333A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726334223B693A313B733A36363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6669656C645F76616C69646174696F6E5F6C656E677468223B693A323B733A35333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C72656D6F76655F6163705F7374796C65735F6361636865223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\rc6', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726335223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\remove_acp_styles_cache', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726334223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\rename_too_long_indexes', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F30223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\reported_posts_display', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3131223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\reset_missing_captcha_plugin', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\search_type', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\signature_module_auth', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\soft_delete_mod_convert', 0x613A313A7B693A303B733A33363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C616C70686133223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\soft_delete_mod_convert2', 0x613A313A7B693A303B733A35333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C736F66745F64656C6574655F6D6F645F636F6E76657274223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\softdelete_mcp_modules', 0x613A323A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B693A313B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C736F667464656C6574655F7032223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\softdelete_p1', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\softdelete_p2', 0x613A323A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B693A313B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C736F667464656C6574655F7031223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\style_update_p1', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3131223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\style_update_p2', 0x613A313A7B693A303B733A34353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C7374796C655F7570646174655F7031223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\teampage', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\timezone', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3131223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\timezone_p2', 0x613A313A7B693A303B733A33383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C74696D657A6F6E65223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\topic_sort_username', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\ucp_popuppm_module', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\m_softdelete_global', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333131223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\plupload_last_gc_dynamic', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333132223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\profilefield_remove_underscore_from_alpha', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333131223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\profilefield_yahoo_update_url', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333132223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\style_update', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C676F6C64223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\update_custom_bbcodes_with_idn', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333132223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v311', 0x613A323A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C676F6C64223B693A313B733A34323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C7374796C655F757064617465223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v312', 0x613A313A7B693A303B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333132726331223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v312rc1', 0x613A323A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333131223B693A313B733A34393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C6D5F736F667464656C6574655F676C6F62616C223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v313', 0x613A313A7B693A303B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333133726332223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v313rc1', 0x613A353A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31335F726331223B693A313B733A35343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C706C75706C6F61645F6C6173745F67635F64796E616D6963223B693A323B733A37313A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C70726F66696C656669656C645F72656D6F76655F756E64657273636F72655F66726F6D5F616C706861223B693A333B733A35393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C70726F66696C656669656C645F7961686F6F5F7570646174655F75726C223B693A343B733A36303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C7570646174655F637573746F6D5F6262636F6465735F776974685F69646E223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v313rc2', 0x613A323A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31335F706C31223B693A313B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333133726331223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v314', 0x613A323A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3134223B693A313B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333134726332223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v314rc1', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333133223B7D, '1', '1', '', '1431076934', '1431076934');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v314rc2', 0x613A323A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31345F726331223B693A313B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333134726331223B7D, '1', '1', '', '1431076934', '1431076934');

-- ----------------------------
-- Table structure for `phpbb_moderator_cache`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_moderator_cache`;
CREATE TABLE `phpbb_moderator_cache` (
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_on_index` tinyint(1) unsigned NOT NULL DEFAULT '1',
  KEY `disp_idx` (`display_on_index`),
  KEY `forum_id` (`forum_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_moderator_cache
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_modules`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_modules`;
CREATE TABLE `phpbb_modules` (
  `module_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `module_enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `module_display` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `module_basename` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `module_class` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `left_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `right_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `module_langname` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `module_mode` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `module_auth` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`module_id`),
  KEY `left_right_id` (`left_id`,`right_id`),
  KEY `module_enabled` (`module_enabled`),
  KEY `class_left_id` (`module_class`,`left_id`)
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_modules
-- ----------------------------
INSERT INTO `phpbb_modules` VALUES ('1', '1', '1', '', 'acp', '0', '1', '66', 'ACP_CAT_GENERAL', '', '');
INSERT INTO `phpbb_modules` VALUES ('2', '1', '1', '', 'acp', '1', '4', '17', 'ACP_QUICK_ACCESS', '', '');
INSERT INTO `phpbb_modules` VALUES ('3', '1', '1', '', 'acp', '1', '18', '43', 'ACP_BOARD_CONFIGURATION', '', '');
INSERT INTO `phpbb_modules` VALUES ('4', '1', '1', '', 'acp', '1', '44', '51', 'ACP_CLIENT_COMMUNICATION', '', '');
INSERT INTO `phpbb_modules` VALUES ('5', '1', '1', '', 'acp', '1', '52', '65', 'ACP_SERVER_CONFIGURATION', '', '');
INSERT INTO `phpbb_modules` VALUES ('6', '1', '1', '', 'acp', '0', '67', '86', 'ACP_CAT_FORUMS', '', '');
INSERT INTO `phpbb_modules` VALUES ('7', '1', '1', '', 'acp', '6', '68', '73', 'ACP_MANAGE_FORUMS', '', '');
INSERT INTO `phpbb_modules` VALUES ('8', '1', '1', '', 'acp', '6', '74', '85', 'ACP_FORUM_BASED_PERMISSIONS', '', '');
INSERT INTO `phpbb_modules` VALUES ('9', '1', '1', '', 'acp', '0', '87', '114', 'ACP_CAT_POSTING', '', '');
INSERT INTO `phpbb_modules` VALUES ('10', '1', '1', '', 'acp', '9', '88', '101', 'ACP_MESSAGES', '', '');
INSERT INTO `phpbb_modules` VALUES ('11', '1', '1', '', 'acp', '9', '102', '113', 'ACP_ATTACHMENTS', '', '');
INSERT INTO `phpbb_modules` VALUES ('12', '1', '1', '', 'acp', '0', '115', '172', 'ACP_CAT_USERGROUP', '', '');
INSERT INTO `phpbb_modules` VALUES ('13', '1', '1', '', 'acp', '12', '116', '151', 'ACP_CAT_USERS', '', '');
INSERT INTO `phpbb_modules` VALUES ('14', '1', '1', '', 'acp', '12', '152', '161', 'ACP_GROUPS', '', '');
INSERT INTO `phpbb_modules` VALUES ('15', '1', '1', '', 'acp', '12', '162', '171', 'ACP_USER_SECURITY', '', '');
INSERT INTO `phpbb_modules` VALUES ('16', '1', '1', '', 'acp', '0', '173', '222', 'ACP_CAT_PERMISSIONS', '', '');
INSERT INTO `phpbb_modules` VALUES ('17', '1', '1', '', 'acp', '16', '176', '185', 'ACP_GLOBAL_PERMISSIONS', '', '');
INSERT INTO `phpbb_modules` VALUES ('18', '1', '1', '', 'acp', '16', '186', '197', 'ACP_FORUM_BASED_PERMISSIONS', '', '');
INSERT INTO `phpbb_modules` VALUES ('19', '1', '1', '', 'acp', '16', '198', '207', 'ACP_PERMISSION_ROLES', '', '');
INSERT INTO `phpbb_modules` VALUES ('20', '1', '1', '', 'acp', '16', '208', '221', 'ACP_PERMISSION_MASKS', '', '');
INSERT INTO `phpbb_modules` VALUES ('21', '1', '1', '', 'acp', '0', '223', '238', 'ACP_CAT_CUSTOMISE', '', '');
INSERT INTO `phpbb_modules` VALUES ('22', '1', '1', '', 'acp', '21', '228', '233', 'ACP_STYLE_MANAGEMENT', '', '');
INSERT INTO `phpbb_modules` VALUES ('23', '1', '1', '', 'acp', '21', '224', '227', 'ACP_EXTENSION_MANAGEMENT', '', '');
INSERT INTO `phpbb_modules` VALUES ('24', '1', '1', '', 'acp', '21', '234', '237', 'ACP_LANGUAGE', '', '');
INSERT INTO `phpbb_modules` VALUES ('25', '1', '1', '', 'acp', '0', '239', '258', 'ACP_CAT_MAINTENANCE', '', '');
INSERT INTO `phpbb_modules` VALUES ('26', '1', '1', '', 'acp', '25', '240', '249', 'ACP_FORUM_LOGS', '', '');
INSERT INTO `phpbb_modules` VALUES ('27', '1', '1', '', 'acp', '25', '250', '257', 'ACP_CAT_DATABASE', '', '');
INSERT INTO `phpbb_modules` VALUES ('28', '1', '1', '', 'acp', '0', '259', '282', 'ACP_CAT_SYSTEM', '', '');
INSERT INTO `phpbb_modules` VALUES ('29', '1', '1', '', 'acp', '28', '260', '263', 'ACP_AUTOMATION', '', '');
INSERT INTO `phpbb_modules` VALUES ('30', '1', '1', '', 'acp', '28', '264', '273', 'ACP_GENERAL_TASKS', '', '');
INSERT INTO `phpbb_modules` VALUES ('31', '1', '1', '', 'acp', '28', '274', '281', 'ACP_MODULE_MANAGEMENT', '', '');
INSERT INTO `phpbb_modules` VALUES ('32', '1', '1', '', 'acp', '0', '283', '284', 'ACP_CAT_DOT_MODS', '', '');
INSERT INTO `phpbb_modules` VALUES ('33', '1', '1', 'acp_attachments', 'acp', '3', '19', '20', 'ACP_ATTACHMENT_SETTINGS', 'attach', 'acl_a_attach');
INSERT INTO `phpbb_modules` VALUES ('34', '1', '1', 'acp_attachments', 'acp', '11', '103', '104', 'ACP_ATTACHMENT_SETTINGS', 'attach', 'acl_a_attach');
INSERT INTO `phpbb_modules` VALUES ('35', '1', '1', 'acp_attachments', 'acp', '11', '105', '106', 'ACP_MANAGE_EXTENSIONS', 'extensions', 'acl_a_attach');
INSERT INTO `phpbb_modules` VALUES ('36', '1', '1', 'acp_attachments', 'acp', '11', '107', '108', 'ACP_EXTENSION_GROUPS', 'ext_groups', 'acl_a_attach');
INSERT INTO `phpbb_modules` VALUES ('37', '1', '1', 'acp_attachments', 'acp', '11', '109', '110', 'ACP_ORPHAN_ATTACHMENTS', 'orphan', 'acl_a_attach');
INSERT INTO `phpbb_modules` VALUES ('38', '1', '1', 'acp_attachments', 'acp', '11', '111', '112', 'ACP_MANAGE_ATTACHMENTS', 'manage', 'acl_a_attach');
INSERT INTO `phpbb_modules` VALUES ('39', '1', '1', 'acp_ban', 'acp', '15', '163', '164', 'ACP_BAN_EMAILS', 'email', 'acl_a_ban');
INSERT INTO `phpbb_modules` VALUES ('40', '1', '1', 'acp_ban', 'acp', '15', '165', '166', 'ACP_BAN_IPS', 'ip', 'acl_a_ban');
INSERT INTO `phpbb_modules` VALUES ('41', '1', '1', 'acp_ban', 'acp', '15', '167', '168', 'ACP_BAN_USERNAMES', 'user', 'acl_a_ban');
INSERT INTO `phpbb_modules` VALUES ('42', '1', '1', 'acp_bbcodes', 'acp', '10', '89', '90', 'ACP_BBCODES', 'bbcodes', 'acl_a_bbcode');
INSERT INTO `phpbb_modules` VALUES ('43', '1', '1', 'acp_board', 'acp', '3', '21', '22', 'ACP_BOARD_SETTINGS', 'settings', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('44', '1', '1', 'acp_board', 'acp', '3', '23', '24', 'ACP_BOARD_FEATURES', 'features', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('45', '1', '1', 'acp_board', 'acp', '3', '25', '26', 'ACP_AVATAR_SETTINGS', 'avatar', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('46', '1', '1', 'acp_board', 'acp', '3', '27', '28', 'ACP_MESSAGE_SETTINGS', 'message', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('47', '1', '1', 'acp_board', 'acp', '10', '91', '92', 'ACP_MESSAGE_SETTINGS', 'message', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('48', '1', '1', 'acp_board', 'acp', '3', '29', '30', 'ACP_POST_SETTINGS', 'post', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('49', '1', '1', 'acp_board', 'acp', '10', '93', '94', 'ACP_POST_SETTINGS', 'post', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('50', '1', '1', 'acp_board', 'acp', '3', '31', '32', 'ACP_SIGNATURE_SETTINGS', 'signature', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('51', '1', '1', 'acp_board', 'acp', '3', '33', '34', 'ACP_FEED_SETTINGS', 'feed', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('52', '1', '1', 'acp_board', 'acp', '3', '35', '36', 'ACP_REGISTER_SETTINGS', 'registration', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('53', '1', '1', 'acp_board', 'acp', '4', '45', '46', 'ACP_AUTH_SETTINGS', 'auth', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES ('54', '1', '1', 'acp_board', 'acp', '4', '47', '48', 'ACP_EMAIL_SETTINGS', 'email', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES ('55', '1', '1', 'acp_board', 'acp', '5', '53', '54', 'ACP_COOKIE_SETTINGS', 'cookie', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES ('56', '1', '1', 'acp_board', 'acp', '5', '55', '56', 'ACP_SERVER_SETTINGS', 'server', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES ('57', '1', '1', 'acp_board', 'acp', '5', '57', '58', 'ACP_SECURITY_SETTINGS', 'security', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES ('58', '1', '1', 'acp_board', 'acp', '5', '59', '60', 'ACP_LOAD_SETTINGS', 'load', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES ('59', '1', '1', 'acp_bots', 'acp', '30', '265', '266', 'ACP_BOTS', 'bots', 'acl_a_bots');
INSERT INTO `phpbb_modules` VALUES ('60', '1', '1', 'acp_captcha', 'acp', '3', '37', '38', 'ACP_VC_SETTINGS', 'visual', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('61', '1', '0', 'acp_captcha', 'acp', '3', '39', '40', 'ACP_VC_CAPTCHA_DISPLAY', 'img', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('62', '1', '1', 'acp_contact', 'acp', '3', '41', '42', 'ACP_CONTACT_SETTINGS', 'contact', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('63', '1', '1', 'acp_database', 'acp', '27', '251', '252', 'ACP_BACKUP', 'backup', 'acl_a_backup');
INSERT INTO `phpbb_modules` VALUES ('64', '1', '1', 'acp_database', 'acp', '27', '253', '254', 'ACP_RESTORE', 'restore', 'acl_a_backup');
INSERT INTO `phpbb_modules` VALUES ('65', '1', '1', 'acp_disallow', 'acp', '15', '169', '170', 'ACP_DISALLOW_USERNAMES', 'usernames', 'acl_a_names');
INSERT INTO `phpbb_modules` VALUES ('66', '1', '1', 'acp_email', 'acp', '30', '267', '268', 'ACP_MASS_EMAIL', 'email', 'acl_a_email && cfg_email_enable');
INSERT INTO `phpbb_modules` VALUES ('67', '1', '1', 'acp_extensions', 'acp', '23', '225', '226', 'ACP_EXTENSIONS', 'main', 'acl_a_extensions');
INSERT INTO `phpbb_modules` VALUES ('68', '1', '1', 'acp_forums', 'acp', '7', '69', '70', 'ACP_MANAGE_FORUMS', 'manage', 'acl_a_forum');
INSERT INTO `phpbb_modules` VALUES ('69', '1', '1', 'acp_groups', 'acp', '14', '153', '154', 'ACP_GROUPS_MANAGE', 'manage', 'acl_a_group');
INSERT INTO `phpbb_modules` VALUES ('70', '1', '1', 'acp_groups', 'acp', '14', '155', '156', 'ACP_GROUPS_POSITION', 'position', 'acl_a_group');
INSERT INTO `phpbb_modules` VALUES ('71', '1', '1', 'acp_icons', 'acp', '10', '95', '96', 'ACP_ICONS', 'icons', 'acl_a_icons');
INSERT INTO `phpbb_modules` VALUES ('72', '1', '1', 'acp_icons', 'acp', '10', '97', '98', 'ACP_SMILIES', 'smilies', 'acl_a_icons');
INSERT INTO `phpbb_modules` VALUES ('73', '1', '1', 'acp_inactive', 'acp', '13', '117', '118', 'ACP_INACTIVE_USERS', 'list', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('74', '1', '1', 'acp_jabber', 'acp', '4', '49', '50', 'ACP_JABBER_SETTINGS', 'settings', 'acl_a_jabber');
INSERT INTO `phpbb_modules` VALUES ('75', '1', '1', 'acp_language', 'acp', '24', '235', '236', 'ACP_LANGUAGE_PACKS', 'lang_packs', 'acl_a_language');
INSERT INTO `phpbb_modules` VALUES ('76', '1', '1', 'acp_logs', 'acp', '26', '241', '242', 'ACP_ADMIN_LOGS', 'admin', 'acl_a_viewlogs');
INSERT INTO `phpbb_modules` VALUES ('77', '1', '1', 'acp_logs', 'acp', '26', '243', '244', 'ACP_MOD_LOGS', 'mod', 'acl_a_viewlogs');
INSERT INTO `phpbb_modules` VALUES ('78', '1', '1', 'acp_logs', 'acp', '26', '245', '246', 'ACP_USERS_LOGS', 'users', 'acl_a_viewlogs');
INSERT INTO `phpbb_modules` VALUES ('79', '1', '1', 'acp_logs', 'acp', '26', '247', '248', 'ACP_CRITICAL_LOGS', 'critical', 'acl_a_viewlogs');
INSERT INTO `phpbb_modules` VALUES ('80', '1', '1', 'acp_main', 'acp', '1', '2', '3', 'ACP_INDEX', 'main', '');
INSERT INTO `phpbb_modules` VALUES ('81', '1', '1', 'acp_modules', 'acp', '31', '275', '276', 'ACP', 'acp', 'acl_a_modules');
INSERT INTO `phpbb_modules` VALUES ('82', '1', '1', 'acp_modules', 'acp', '31', '277', '278', 'UCP', 'ucp', 'acl_a_modules');
INSERT INTO `phpbb_modules` VALUES ('83', '1', '1', 'acp_modules', 'acp', '31', '279', '280', 'MCP', 'mcp', 'acl_a_modules');
INSERT INTO `phpbb_modules` VALUES ('84', '1', '1', 'acp_permission_roles', 'acp', '19', '199', '200', 'ACP_ADMIN_ROLES', 'admin_roles', 'acl_a_roles && acl_a_aauth');
INSERT INTO `phpbb_modules` VALUES ('85', '1', '1', 'acp_permission_roles', 'acp', '19', '201', '202', 'ACP_USER_ROLES', 'user_roles', 'acl_a_roles && acl_a_uauth');
INSERT INTO `phpbb_modules` VALUES ('86', '1', '1', 'acp_permission_roles', 'acp', '19', '203', '204', 'ACP_MOD_ROLES', 'mod_roles', 'acl_a_roles && acl_a_mauth');
INSERT INTO `phpbb_modules` VALUES ('87', '1', '1', 'acp_permission_roles', 'acp', '19', '205', '206', 'ACP_FORUM_ROLES', 'forum_roles', 'acl_a_roles && acl_a_fauth');
INSERT INTO `phpbb_modules` VALUES ('88', '1', '1', 'acp_permissions', 'acp', '16', '174', '175', 'ACP_PERMISSIONS', 'intro', 'acl_a_authusers || acl_a_authgroups || acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES ('89', '1', '0', 'acp_permissions', 'acp', '20', '209', '210', 'ACP_PERMISSION_TRACE', 'trace', 'acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES ('90', '1', '1', 'acp_permissions', 'acp', '18', '187', '188', 'ACP_FORUM_PERMISSIONS', 'setting_forum_local', 'acl_a_fauth && (acl_a_authusers || acl_a_authgroups)');
INSERT INTO `phpbb_modules` VALUES ('91', '1', '1', 'acp_permissions', 'acp', '18', '189', '190', 'ACP_FORUM_PERMISSIONS_COPY', 'setting_forum_copy', 'acl_a_fauth && acl_a_authusers && acl_a_authgroups && acl_a_mauth');
INSERT INTO `phpbb_modules` VALUES ('92', '1', '1', 'acp_permissions', 'acp', '18', '191', '192', 'ACP_FORUM_MODERATORS', 'setting_mod_local', 'acl_a_mauth && (acl_a_authusers || acl_a_authgroups)');
INSERT INTO `phpbb_modules` VALUES ('93', '1', '1', 'acp_permissions', 'acp', '17', '177', '178', 'ACP_USERS_PERMISSIONS', 'setting_user_global', 'acl_a_authusers && (acl_a_aauth || acl_a_mauth || acl_a_uauth)');
INSERT INTO `phpbb_modules` VALUES ('94', '1', '1', 'acp_permissions', 'acp', '13', '121', '122', 'ACP_USERS_PERMISSIONS', 'setting_user_global', 'acl_a_authusers && (acl_a_aauth || acl_a_mauth || acl_a_uauth)');
INSERT INTO `phpbb_modules` VALUES ('95', '1', '1', 'acp_permissions', 'acp', '18', '193', '194', 'ACP_USERS_FORUM_PERMISSIONS', 'setting_user_local', 'acl_a_authusers && (acl_a_mauth || acl_a_fauth)');
INSERT INTO `phpbb_modules` VALUES ('96', '1', '1', 'acp_permissions', 'acp', '13', '123', '124', 'ACP_USERS_FORUM_PERMISSIONS', 'setting_user_local', 'acl_a_authusers && (acl_a_mauth || acl_a_fauth)');
INSERT INTO `phpbb_modules` VALUES ('97', '1', '1', 'acp_permissions', 'acp', '17', '179', '180', 'ACP_GROUPS_PERMISSIONS', 'setting_group_global', 'acl_a_authgroups && (acl_a_aauth || acl_a_mauth || acl_a_uauth)');
INSERT INTO `phpbb_modules` VALUES ('98', '1', '1', 'acp_permissions', 'acp', '14', '157', '158', 'ACP_GROUPS_PERMISSIONS', 'setting_group_global', 'acl_a_authgroups && (acl_a_aauth || acl_a_mauth || acl_a_uauth)');
INSERT INTO `phpbb_modules` VALUES ('99', '1', '1', 'acp_permissions', 'acp', '18', '195', '196', 'ACP_GROUPS_FORUM_PERMISSIONS', 'setting_group_local', 'acl_a_authgroups && (acl_a_mauth || acl_a_fauth)');
INSERT INTO `phpbb_modules` VALUES ('100', '1', '1', 'acp_permissions', 'acp', '14', '159', '160', 'ACP_GROUPS_FORUM_PERMISSIONS', 'setting_group_local', 'acl_a_authgroups && (acl_a_mauth || acl_a_fauth)');
INSERT INTO `phpbb_modules` VALUES ('101', '1', '1', 'acp_permissions', 'acp', '17', '181', '182', 'ACP_ADMINISTRATORS', 'setting_admin_global', 'acl_a_aauth && (acl_a_authusers || acl_a_authgroups)');
INSERT INTO `phpbb_modules` VALUES ('102', '1', '1', 'acp_permissions', 'acp', '17', '183', '184', 'ACP_GLOBAL_MODERATORS', 'setting_mod_global', 'acl_a_mauth && (acl_a_authusers || acl_a_authgroups)');
INSERT INTO `phpbb_modules` VALUES ('103', '1', '1', 'acp_permissions', 'acp', '20', '211', '212', 'ACP_VIEW_ADMIN_PERMISSIONS', 'view_admin_global', 'acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES ('104', '1', '1', 'acp_permissions', 'acp', '20', '213', '214', 'ACP_VIEW_USER_PERMISSIONS', 'view_user_global', 'acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES ('105', '1', '1', 'acp_permissions', 'acp', '20', '215', '216', 'ACP_VIEW_GLOBAL_MOD_PERMISSIONS', 'view_mod_global', 'acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES ('106', '1', '1', 'acp_permissions', 'acp', '20', '217', '218', 'ACP_VIEW_FORUM_MOD_PERMISSIONS', 'view_mod_local', 'acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES ('107', '1', '1', 'acp_permissions', 'acp', '20', '219', '220', 'ACP_VIEW_FORUM_PERMISSIONS', 'view_forum_local', 'acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES ('108', '1', '1', 'acp_php_info', 'acp', '30', '269', '270', 'ACP_PHP_INFO', 'info', 'acl_a_phpinfo');
INSERT INTO `phpbb_modules` VALUES ('109', '1', '1', 'acp_profile', 'acp', '13', '125', '126', 'ACP_CUSTOM_PROFILE_FIELDS', 'profile', 'acl_a_profile');
INSERT INTO `phpbb_modules` VALUES ('110', '1', '1', 'acp_prune', 'acp', '7', '71', '72', 'ACP_PRUNE_FORUMS', 'forums', 'acl_a_prune');
INSERT INTO `phpbb_modules` VALUES ('111', '1', '1', 'acp_prune', 'acp', '13', '127', '128', 'ACP_PRUNE_USERS', 'users', 'acl_a_userdel');
INSERT INTO `phpbb_modules` VALUES ('112', '1', '1', 'acp_ranks', 'acp', '13', '129', '130', 'ACP_MANAGE_RANKS', 'ranks', 'acl_a_ranks');
INSERT INTO `phpbb_modules` VALUES ('113', '1', '1', 'acp_reasons', 'acp', '30', '271', '272', 'ACP_MANAGE_REASONS', 'main', 'acl_a_reasons');
INSERT INTO `phpbb_modules` VALUES ('114', '1', '1', 'acp_search', 'acp', '5', '61', '62', 'ACP_SEARCH_SETTINGS', 'settings', 'acl_a_search');
INSERT INTO `phpbb_modules` VALUES ('115', '1', '1', 'acp_search', 'acp', '27', '255', '256', 'ACP_SEARCH_INDEX', 'index', 'acl_a_search');
INSERT INTO `phpbb_modules` VALUES ('116', '1', '1', 'acp_send_statistics', 'acp', '5', '63', '64', 'ACP_SEND_STATISTICS', 'send_statistics', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES ('117', '1', '1', 'acp_styles', 'acp', '22', '229', '230', 'ACP_STYLES', 'style', 'acl_a_styles');
INSERT INTO `phpbb_modules` VALUES ('118', '1', '1', 'acp_styles', 'acp', '22', '231', '232', 'ACP_STYLES_INSTALL', 'install', 'acl_a_styles');
INSERT INTO `phpbb_modules` VALUES ('119', '1', '1', 'acp_update', 'acp', '29', '261', '262', 'ACP_VERSION_CHECK', 'version_check', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('120', '1', '1', 'acp_users', 'acp', '13', '119', '120', 'ACP_MANAGE_USERS', 'overview', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('121', '1', '0', 'acp_users', 'acp', '13', '131', '132', 'ACP_USER_FEEDBACK', 'feedback', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('122', '1', '0', 'acp_users', 'acp', '13', '133', '134', 'ACP_USER_WARNINGS', 'warnings', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('123', '1', '0', 'acp_users', 'acp', '13', '135', '136', 'ACP_USER_PROFILE', 'profile', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('124', '1', '0', 'acp_users', 'acp', '13', '137', '138', 'ACP_USER_PREFS', 'prefs', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('125', '1', '0', 'acp_users', 'acp', '13', '139', '140', 'ACP_USER_AVATAR', 'avatar', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('126', '1', '0', 'acp_users', 'acp', '13', '141', '142', 'ACP_USER_RANK', 'rank', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('127', '1', '0', 'acp_users', 'acp', '13', '143', '144', 'ACP_USER_SIG', 'sig', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('128', '1', '0', 'acp_users', 'acp', '13', '145', '146', 'ACP_USER_GROUPS', 'groups', 'acl_a_user && acl_a_group');
INSERT INTO `phpbb_modules` VALUES ('129', '1', '0', 'acp_users', 'acp', '13', '147', '148', 'ACP_USER_PERM', 'perm', 'acl_a_user && acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES ('130', '1', '0', 'acp_users', 'acp', '13', '149', '150', 'ACP_USER_ATTACH', 'attach', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('131', '1', '1', 'acp_words', 'acp', '10', '99', '100', 'ACP_WORDS', 'words', 'acl_a_words');
INSERT INTO `phpbb_modules` VALUES ('132', '1', '1', 'acp_users', 'acp', '2', '5', '6', 'ACP_MANAGE_USERS', 'overview', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('133', '1', '1', 'acp_groups', 'acp', '2', '7', '8', 'ACP_GROUPS_MANAGE', 'manage', 'acl_a_group');
INSERT INTO `phpbb_modules` VALUES ('134', '1', '1', 'acp_forums', 'acp', '2', '9', '10', 'ACP_MANAGE_FORUMS', 'manage', 'acl_a_forum');
INSERT INTO `phpbb_modules` VALUES ('135', '1', '1', 'acp_logs', 'acp', '2', '11', '12', 'ACP_MOD_LOGS', 'mod', 'acl_a_viewlogs');
INSERT INTO `phpbb_modules` VALUES ('136', '1', '1', 'acp_bots', 'acp', '2', '13', '14', 'ACP_BOTS', 'bots', 'acl_a_bots');
INSERT INTO `phpbb_modules` VALUES ('137', '1', '1', 'acp_php_info', 'acp', '2', '15', '16', 'ACP_PHP_INFO', 'info', 'acl_a_phpinfo');
INSERT INTO `phpbb_modules` VALUES ('138', '1', '1', 'acp_permissions', 'acp', '8', '75', '76', 'ACP_FORUM_PERMISSIONS', 'setting_forum_local', 'acl_a_fauth && (acl_a_authusers || acl_a_authgroups)');
INSERT INTO `phpbb_modules` VALUES ('139', '1', '1', 'acp_permissions', 'acp', '8', '77', '78', 'ACP_FORUM_PERMISSIONS_COPY', 'setting_forum_copy', 'acl_a_fauth && acl_a_authusers && acl_a_authgroups && acl_a_mauth');
INSERT INTO `phpbb_modules` VALUES ('140', '1', '1', 'acp_permissions', 'acp', '8', '79', '80', 'ACP_FORUM_MODERATORS', 'setting_mod_local', 'acl_a_mauth && (acl_a_authusers || acl_a_authgroups)');
INSERT INTO `phpbb_modules` VALUES ('141', '1', '1', 'acp_permissions', 'acp', '8', '81', '82', 'ACP_USERS_FORUM_PERMISSIONS', 'setting_user_local', 'acl_a_authusers && (acl_a_mauth || acl_a_fauth)');
INSERT INTO `phpbb_modules` VALUES ('142', '1', '1', 'acp_permissions', 'acp', '8', '83', '84', 'ACP_GROUPS_FORUM_PERMISSIONS', 'setting_group_local', 'acl_a_authgroups && (acl_a_mauth || acl_a_fauth)');
INSERT INTO `phpbb_modules` VALUES ('143', '1', '1', '', 'mcp', '0', '1', '10', 'MCP_MAIN', '', '');
INSERT INTO `phpbb_modules` VALUES ('144', '1', '1', '', 'mcp', '0', '11', '22', 'MCP_QUEUE', '', '');
INSERT INTO `phpbb_modules` VALUES ('145', '1', '1', '', 'mcp', '0', '23', '36', 'MCP_REPORTS', '', '');
INSERT INTO `phpbb_modules` VALUES ('146', '1', '1', '', 'mcp', '0', '37', '42', 'MCP_NOTES', '', '');
INSERT INTO `phpbb_modules` VALUES ('147', '1', '1', '', 'mcp', '0', '43', '52', 'MCP_WARN', '', '');
INSERT INTO `phpbb_modules` VALUES ('148', '1', '1', '', 'mcp', '0', '53', '60', 'MCP_LOGS', '', '');
INSERT INTO `phpbb_modules` VALUES ('149', '1', '1', '', 'mcp', '0', '61', '68', 'MCP_BAN', '', '');
INSERT INTO `phpbb_modules` VALUES ('150', '1', '1', 'mcp_ban', 'mcp', '149', '62', '63', 'MCP_BAN_USERNAMES', 'user', 'acl_m_ban');
INSERT INTO `phpbb_modules` VALUES ('151', '1', '1', 'mcp_ban', 'mcp', '149', '64', '65', 'MCP_BAN_IPS', 'ip', 'acl_m_ban');
INSERT INTO `phpbb_modules` VALUES ('152', '1', '1', 'mcp_ban', 'mcp', '149', '66', '67', 'MCP_BAN_EMAILS', 'email', 'acl_m_ban');
INSERT INTO `phpbb_modules` VALUES ('153', '1', '1', 'mcp_logs', 'mcp', '148', '54', '55', 'MCP_LOGS_FRONT', 'front', 'acl_m_ || aclf_m_');
INSERT INTO `phpbb_modules` VALUES ('154', '1', '1', 'mcp_logs', 'mcp', '148', '56', '57', 'MCP_LOGS_FORUM_VIEW', 'forum_logs', 'acl_m_,$id');
INSERT INTO `phpbb_modules` VALUES ('155', '1', '1', 'mcp_logs', 'mcp', '148', '58', '59', 'MCP_LOGS_TOPIC_VIEW', 'topic_logs', 'acl_m_,$id');
INSERT INTO `phpbb_modules` VALUES ('156', '1', '1', 'mcp_main', 'mcp', '143', '2', '3', 'MCP_MAIN_FRONT', 'front', '');
INSERT INTO `phpbb_modules` VALUES ('157', '1', '1', 'mcp_main', 'mcp', '143', '4', '5', 'MCP_MAIN_FORUM_VIEW', 'forum_view', 'acl_m_,$id');
INSERT INTO `phpbb_modules` VALUES ('158', '1', '1', 'mcp_main', 'mcp', '143', '6', '7', 'MCP_MAIN_TOPIC_VIEW', 'topic_view', 'acl_m_,$id');
INSERT INTO `phpbb_modules` VALUES ('159', '1', '1', 'mcp_main', 'mcp', '143', '8', '9', 'MCP_MAIN_POST_DETAILS', 'post_details', 'acl_m_,$id || (!$id && aclf_m_)');
INSERT INTO `phpbb_modules` VALUES ('160', '1', '1', 'mcp_notes', 'mcp', '146', '38', '39', 'MCP_NOTES_FRONT', 'front', '');
INSERT INTO `phpbb_modules` VALUES ('161', '1', '1', 'mcp_notes', 'mcp', '146', '40', '41', 'MCP_NOTES_USER', 'user_notes', '');
INSERT INTO `phpbb_modules` VALUES ('162', '1', '1', 'mcp_pm_reports', 'mcp', '145', '30', '31', 'MCP_PM_REPORTS_OPEN', 'pm_reports', 'aclf_m_report');
INSERT INTO `phpbb_modules` VALUES ('163', '1', '1', 'mcp_pm_reports', 'mcp', '145', '32', '33', 'MCP_PM_REPORTS_CLOSED', 'pm_reports_closed', 'aclf_m_report');
INSERT INTO `phpbb_modules` VALUES ('164', '1', '1', 'mcp_pm_reports', 'mcp', '145', '34', '35', 'MCP_PM_REPORT_DETAILS', 'pm_report_details', 'aclf_m_report');
INSERT INTO `phpbb_modules` VALUES ('165', '1', '1', 'mcp_queue', 'mcp', '144', '12', '13', 'MCP_QUEUE_UNAPPROVED_TOPICS', 'unapproved_topics', 'aclf_m_approve');
INSERT INTO `phpbb_modules` VALUES ('166', '1', '1', 'mcp_queue', 'mcp', '144', '14', '15', 'MCP_QUEUE_UNAPPROVED_POSTS', 'unapproved_posts', 'aclf_m_approve');
INSERT INTO `phpbb_modules` VALUES ('167', '1', '1', 'mcp_queue', 'mcp', '144', '16', '17', 'MCP_QUEUE_DELETED_TOPICS', 'deleted_topics', 'aclf_m_approve');
INSERT INTO `phpbb_modules` VALUES ('168', '1', '1', 'mcp_queue', 'mcp', '144', '18', '19', 'MCP_QUEUE_DELETED_POSTS', 'deleted_posts', 'aclf_m_approve');
INSERT INTO `phpbb_modules` VALUES ('169', '1', '1', 'mcp_queue', 'mcp', '144', '20', '21', 'MCP_QUEUE_APPROVE_DETAILS', 'approve_details', 'acl_m_approve,$id || (!$id && aclf_m_approve)');
INSERT INTO `phpbb_modules` VALUES ('170', '1', '1', 'mcp_reports', 'mcp', '145', '24', '25', 'MCP_REPORTS_OPEN', 'reports', 'aclf_m_report');
INSERT INTO `phpbb_modules` VALUES ('171', '1', '1', 'mcp_reports', 'mcp', '145', '26', '27', 'MCP_REPORTS_CLOSED', 'reports_closed', 'aclf_m_report');
INSERT INTO `phpbb_modules` VALUES ('172', '1', '1', 'mcp_reports', 'mcp', '145', '28', '29', 'MCP_REPORT_DETAILS', 'report_details', 'acl_m_report,$id || (!$id && aclf_m_report)');
INSERT INTO `phpbb_modules` VALUES ('173', '1', '1', 'mcp_warn', 'mcp', '147', '44', '45', 'MCP_WARN_FRONT', 'front', 'aclf_m_warn');
INSERT INTO `phpbb_modules` VALUES ('174', '1', '1', 'mcp_warn', 'mcp', '147', '46', '47', 'MCP_WARN_LIST', 'list', 'aclf_m_warn');
INSERT INTO `phpbb_modules` VALUES ('175', '1', '1', 'mcp_warn', 'mcp', '147', '48', '49', 'MCP_WARN_USER', 'warn_user', 'aclf_m_warn');
INSERT INTO `phpbb_modules` VALUES ('176', '1', '1', 'mcp_warn', 'mcp', '147', '50', '51', 'MCP_WARN_POST', 'warn_post', 'acl_m_warn && acl_f_read,$id');
INSERT INTO `phpbb_modules` VALUES ('177', '1', '1', '', 'ucp', '0', '1', '14', 'UCP_MAIN', '', '');
INSERT INTO `phpbb_modules` VALUES ('178', '1', '1', '', 'ucp', '0', '15', '28', 'UCP_PROFILE', '', '');
INSERT INTO `phpbb_modules` VALUES ('179', '1', '1', '', 'ucp', '0', '29', '38', 'UCP_PREFS', '', '');
INSERT INTO `phpbb_modules` VALUES ('180', '1', '1', 'ucp_pm', 'ucp', '0', '39', '48', 'UCP_PM', '', '');
INSERT INTO `phpbb_modules` VALUES ('181', '1', '1', '', 'ucp', '0', '49', '54', 'UCP_USERGROUPS', '', '');
INSERT INTO `phpbb_modules` VALUES ('182', '1', '1', '', 'ucp', '0', '55', '60', 'UCP_ZEBRA', '', '');
INSERT INTO `phpbb_modules` VALUES ('183', '1', '1', 'ucp_attachments', 'ucp', '177', '10', '11', 'UCP_MAIN_ATTACHMENTS', 'attachments', 'acl_u_attach');
INSERT INTO `phpbb_modules` VALUES ('184', '1', '1', 'ucp_auth_link', 'ucp', '178', '26', '27', 'UCP_AUTH_LINK_MANAGE', 'auth_link', 'authmethod_oauth');
INSERT INTO `phpbb_modules` VALUES ('185', '1', '1', 'ucp_groups', 'ucp', '181', '50', '51', 'UCP_USERGROUPS_MEMBER', 'membership', '');
INSERT INTO `phpbb_modules` VALUES ('186', '1', '1', 'ucp_groups', 'ucp', '181', '52', '53', 'UCP_USERGROUPS_MANAGE', 'manage', '');
INSERT INTO `phpbb_modules` VALUES ('187', '1', '1', 'ucp_main', 'ucp', '177', '2', '3', 'UCP_MAIN_FRONT', 'front', '');
INSERT INTO `phpbb_modules` VALUES ('188', '1', '1', 'ucp_main', 'ucp', '177', '4', '5', 'UCP_MAIN_SUBSCRIBED', 'subscribed', '');
INSERT INTO `phpbb_modules` VALUES ('189', '1', '1', 'ucp_main', 'ucp', '177', '6', '7', 'UCP_MAIN_BOOKMARKS', 'bookmarks', 'cfg_allow_bookmarks');
INSERT INTO `phpbb_modules` VALUES ('190', '1', '1', 'ucp_main', 'ucp', '177', '8', '9', 'UCP_MAIN_DRAFTS', 'drafts', '');
INSERT INTO `phpbb_modules` VALUES ('191', '1', '1', 'ucp_notifications', 'ucp', '179', '36', '37', 'UCP_NOTIFICATION_OPTIONS', 'notification_options', '');
INSERT INTO `phpbb_modules` VALUES ('192', '1', '1', 'ucp_notifications', 'ucp', '177', '12', '13', 'UCP_NOTIFICATION_LIST', 'notification_list', '');
INSERT INTO `phpbb_modules` VALUES ('193', '1', '0', 'ucp_pm', 'ucp', '180', '40', '41', 'UCP_PM_VIEW', 'view', 'cfg_allow_privmsg');
INSERT INTO `phpbb_modules` VALUES ('194', '1', '1', 'ucp_pm', 'ucp', '180', '42', '43', 'UCP_PM_COMPOSE', 'compose', 'cfg_allow_privmsg');
INSERT INTO `phpbb_modules` VALUES ('195', '1', '1', 'ucp_pm', 'ucp', '180', '44', '45', 'UCP_PM_DRAFTS', 'drafts', 'cfg_allow_privmsg');
INSERT INTO `phpbb_modules` VALUES ('196', '1', '1', 'ucp_pm', 'ucp', '180', '46', '47', 'UCP_PM_OPTIONS', 'options', 'cfg_allow_privmsg');
INSERT INTO `phpbb_modules` VALUES ('197', '1', '1', 'ucp_prefs', 'ucp', '179', '30', '31', 'UCP_PREFS_PERSONAL', 'personal', '');
INSERT INTO `phpbb_modules` VALUES ('198', '1', '1', 'ucp_prefs', 'ucp', '179', '32', '33', 'UCP_PREFS_POST', 'post', '');
INSERT INTO `phpbb_modules` VALUES ('199', '1', '1', 'ucp_prefs', 'ucp', '179', '34', '35', 'UCP_PREFS_VIEW', 'view', '');
INSERT INTO `phpbb_modules` VALUES ('200', '1', '1', 'ucp_profile', 'ucp', '178', '16', '17', 'UCP_PROFILE_PROFILE_INFO', 'profile_info', 'acl_u_chgprofileinfo');
INSERT INTO `phpbb_modules` VALUES ('201', '1', '1', 'ucp_profile', 'ucp', '178', '18', '19', 'UCP_PROFILE_SIGNATURE', 'signature', 'acl_u_sig');
INSERT INTO `phpbb_modules` VALUES ('202', '1', '1', 'ucp_profile', 'ucp', '178', '20', '21', 'UCP_PROFILE_AVATAR', 'avatar', 'cfg_allow_avatar');
INSERT INTO `phpbb_modules` VALUES ('203', '1', '1', 'ucp_profile', 'ucp', '178', '22', '23', 'UCP_PROFILE_REG_DETAILS', 'reg_details', '');
INSERT INTO `phpbb_modules` VALUES ('204', '1', '1', 'ucp_profile', 'ucp', '178', '24', '25', 'UCP_PROFILE_AUTOLOGIN_KEYS', 'autologin_keys', '');
INSERT INTO `phpbb_modules` VALUES ('205', '1', '1', 'ucp_zebra', 'ucp', '182', '56', '57', 'UCP_ZEBRA_FRIENDS', 'friends', '');
INSERT INTO `phpbb_modules` VALUES ('206', '1', '1', 'ucp_zebra', 'ucp', '182', '58', '59', 'UCP_ZEBRA_FOES', 'foes', '');

-- ----------------------------
-- Table structure for `phpbb_notifications`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_notifications`;
CREATE TABLE `phpbb_notifications` (
  `notification_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notification_type_id` smallint(4) unsigned NOT NULL DEFAULT '0',
  `item_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `item_parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `notification_read` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `notification_time` int(11) unsigned NOT NULL DEFAULT '1',
  `notification_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`notification_id`),
  KEY `item_ident` (`notification_type_id`,`item_id`),
  KEY `user` (`user_id`,`notification_read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_notifications
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_notification_types`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_notification_types`;
CREATE TABLE `phpbb_notification_types` (
  `notification_type_id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `notification_type_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `notification_type_enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`notification_type_id`),
  UNIQUE KEY `type` (`notification_type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_notification_types
-- ----------------------------
INSERT INTO `phpbb_notification_types` VALUES ('1', 'notification.type.topic', '1');
INSERT INTO `phpbb_notification_types` VALUES ('2', 'notification.type.approve_topic', '1');
INSERT INTO `phpbb_notification_types` VALUES ('3', 'notification.type.quote', '1');
INSERT INTO `phpbb_notification_types` VALUES ('4', 'notification.type.bookmark', '1');
INSERT INTO `phpbb_notification_types` VALUES ('5', 'notification.type.post', '1');
INSERT INTO `phpbb_notification_types` VALUES ('6', 'notification.type.approve_post', '1');

-- ----------------------------
-- Table structure for `phpbb_oauth_accounts`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_oauth_accounts`;
CREATE TABLE `phpbb_oauth_accounts` (
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `provider` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `oauth_provider_id` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_id`,`provider`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_oauth_accounts
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_oauth_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_oauth_tokens`;
CREATE TABLE `phpbb_oauth_tokens` (
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `session_id` char(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `provider` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `oauth_token` mediumtext COLLATE utf8_bin NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `provider` (`provider`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_oauth_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_poll_options`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_poll_options`;
CREATE TABLE `phpbb_poll_options` (
  `poll_option_id` tinyint(4) NOT NULL DEFAULT '0',
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poll_option_text` text COLLATE utf8_bin NOT NULL,
  `poll_option_total` mediumint(8) unsigned NOT NULL DEFAULT '0',
  KEY `poll_opt_id` (`poll_option_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_poll_options
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_poll_votes`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_poll_votes`;
CREATE TABLE `phpbb_poll_votes` (
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poll_option_id` tinyint(4) NOT NULL DEFAULT '0',
  `vote_user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `vote_user_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  KEY `topic_id` (`topic_id`),
  KEY `vote_user_id` (`vote_user_id`),
  KEY `vote_user_ip` (`vote_user_ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_poll_votes
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_posts`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_posts`;
CREATE TABLE `phpbb_posts` (
  `post_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poster_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `icon_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poster_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_time` int(11) unsigned NOT NULL DEFAULT '0',
  `post_reported` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `enable_bbcode` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_smilies` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_magic_url` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_sig` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `post_username` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `post_text` mediumtext COLLATE utf8_bin NOT NULL,
  `post_checksum` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_attachment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `bbcode_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bbcode_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_postcount` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `post_edit_time` int(11) unsigned NOT NULL DEFAULT '0',
  `post_edit_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_edit_user` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `post_edit_count` smallint(4) unsigned NOT NULL DEFAULT '0',
  `post_edit_locked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `post_visibility` tinyint(3) NOT NULL DEFAULT '0',
  `post_delete_time` int(11) unsigned NOT NULL DEFAULT '0',
  `post_delete_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_delete_user` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`),
  KEY `poster_ip` (`poster_ip`),
  KEY `poster_id` (`poster_id`),
  KEY `tid_post_time` (`topic_id`,`post_time`),
  KEY `post_username` (`post_username`),
  KEY `post_visibility` (`post_visibility`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_posts
-- ----------------------------
INSERT INTO `phpbb_posts` VALUES ('1', '1', '2', '2', '0', '127.0.0.1', '1431076924', '0', '1', '1', '1', '1', '', 'Ласкаво просимо до phpBB3', 0xD0A6D0B520D0BFD180D0B8D0BAD0BBD0B0D0B420D0BFD0BED0B2D196D0B4D0BED0BCD0BBD0B5D0BDD0BDD18F20D0B2D0B0D188D0BED0B3D0BE2070687042423320D184D0BED180D183D0BCD1832E20D097D0B4D0B0D194D182D18CD181D18F20D0BDD196D0B1D0B820D0B2D181D0B520D0BDD0BED180D0BCD0B0D0BBD18CD0BDD0BE20D0BFD180D0B0D186D18ED1942E20D092D0B820D0BCD0BED0B6D0B5D182D0B520D0BFD180D0B820D0B1D0B0D0B6D0B0D0BDD0BDD19620D0B2D0B8D0B4D0B0D0BBD0B8D182D0B820D186D0B520D0BFD0BED0B2D196D0B4D0BED0BCD0BBD0B5D0BDD0BDD18F20D182D0B020D0BFD180D0BED0B4D0BED0B2D0B6D0B8D182D0B820D0BDD0B0D0BBD0B0D188D182D183D0B2D0B0D0BDD0BDD18F20D0B2D0B0D188D0BED0B3D0BE20D184D0BED180D183D0BCD1832E20D09220D0BFD180D0BED186D0B5D181D19620D0B2D181D182D0B0D0BDD0BED0B2D0BBD0B5D0BDD0BDD18F20D0B2D0B0D188D196D0B920D0BFD0B5D180D188D196D0B920D0BAD0B0D182D0B5D0B3D0BED180D196D19720D182D0B020D0B2D0B0D188D0BED0BCD18320D0BFD0B5D180D188D0BED0BCD18320D184D0BED180D183D0BCD18320D0B1D183D0BBD0BE20D0B2D181D182D0B0D0BDD0BED0B2D0BBD0B5D0BDD0BE20D0B2D196D0B4D0BFD0BED0B2D196D0B4D0BDD19620D0BFD180D0B0D0B2D0B020D0B4D0BED181D182D183D0BFD18320D0B4D0BBD18F20D0BFD0B5D180D0B5D0B4D0B2D181D182D0B0D0BDD0BED0B2D0BBD0B5D0BDD0B8D18520D0B3D180D183D0BF202D20D0B0D0B4D0BCD196D0BDD196D181D182D180D0B0D182D0BED180D196D0B22C20D0B1D0BED182D196D0B22C20D181D183D0BFD0B5D180D0BCD0BED0B4D0B5D180D0B0D182D0BED180D196D0B22C20D0B3D0BED181D182D0B5D0B92C20D0B7D0B0D180D0B5D194D181D182D180D0BED0B2D0B0D0BDD0B8D18520D0BAD0BED180D0B8D181D182D183D0B2D0B0D187D196D0B220D182D0B020D0B7D0B0D180D0B5D194D181D182D180D0BED0B2D0B0D0BDD0B8D18520D0BAD0BED180D0B8D181D182D183D0B2D0B0D187D196D0B220434F5050412E20D0AFD0BAD189D0BE20D0B2D0B820D0B2D0B8D0B4D0B0D0BBD0B8D182D0B520D0B2D0B0D188D18320D0BFD0B5D180D188D18320D0BAD0B0D182D0B5D0B3D0BED180D196D18E20D182D0B020D0B2D0B0D18820D0BFD0B5D180D188D0B8D0B920D184D0BED180D183D0BC2C20D0BDD0B520D0B7D0B0D0B1D183D0B4D18CD182D0B520D0BDD0B0D0B4D0B0D182D0B820D0BFD180D0B0D0B2D0B020D0B4D0BED181D182D183D0BFD18320D183D181D196D0BC20D186D0B8D18520D0B3D180D183D0BFD0B0D0BC20D0B4D0BE20D0BDD0BED0B2D0B8D18520D0BAD0B0D182D0B5D0B3D0BED180D196D0B920D182D0B020D184D0BED180D183D0BCD196D0B22C20D18FD0BAD19620D0B2D0B820D181D182D0B2D0BED180D0B8D182D0B52E20D0A0D0B5D0BAD0BED0BCD0B5D0BDD0B4D183D194D182D18CD181D18F20D0BFD0B5D180D0B5D0B9D0BCD0B5D0BDD183D0B2D0B0D182D0B820D0B2D0B0D188D18320D0BFD0B5D180D188D18320D0BAD0B0D182D0B5D0B3D0BED180D196D18E20D182D0B020D0B2D0B0D18820D0BFD0B5D180D188D0B8D0B920D184D0BED180D183D0BC20D182D0B020D181D0BAD0BED0BFD196D18ED0B2D0B0D182D0B820D0BFD180D0B0D0B2D0B020D0B720D0BDD0B8D18520D0BFD180D0B820D181D182D0B2D0BED180D0B5D0BDD0BDD19620D0BDD0BED0B2D0B8D18520D0BAD0B0D182D0B5D0B3D0BED180D196D0B920D182D0B020D184D0BED180D183D0BCD196D0B22E20D0A3D181D0BFD196D185D196D0B221, '5dd683b17f641daf84c040bfefc58ce9', '0', '', '', '1', '0', '', '0', '0', '0', '1', '0', '', '0');
INSERT INTO `phpbb_posts` VALUES ('2', '2', '2', '2', '0', '127.0.0.1', '1431082457', '0', '1', '1', '1', '1', '', '8 травня', 0xD094D0B5D0BDD18C20D0BFD0B0D0BC27D18FD182D19620D19620D0BFD180D0B8D0BCD0B8D180D0B5D0BDD0BDD18F, 'c98397723d1ed5555c63cffa2f083bf8', '0', '', 'cyjx8e6c', '1', '0', '', '0', '0', '0', '1', '0', '', '0');

-- ----------------------------
-- Table structure for `phpbb_privmsgs`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_privmsgs`;
CREATE TABLE `phpbb_privmsgs` (
  `msg_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `root_level` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `author_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `icon_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `author_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `message_time` int(11) unsigned NOT NULL DEFAULT '0',
  `enable_bbcode` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_smilies` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_magic_url` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_sig` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `message_subject` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `message_text` mediumtext COLLATE utf8_bin NOT NULL,
  `message_edit_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `message_edit_user` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `message_attachment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `bbcode_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bbcode_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `message_edit_time` int(11) unsigned NOT NULL DEFAULT '0',
  `message_edit_count` smallint(4) unsigned NOT NULL DEFAULT '0',
  `to_address` text COLLATE utf8_bin NOT NULL,
  `bcc_address` text COLLATE utf8_bin NOT NULL,
  `message_reported` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`msg_id`),
  KEY `author_ip` (`author_ip`),
  KEY `message_time` (`message_time`),
  KEY `author_id` (`author_id`),
  KEY `root_level` (`root_level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_privmsgs
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_privmsgs_folder`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_privmsgs_folder`;
CREATE TABLE `phpbb_privmsgs_folder` (
  `folder_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `folder_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pm_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`folder_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_privmsgs_folder
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_privmsgs_rules`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_privmsgs_rules`;
CREATE TABLE `phpbb_privmsgs_rules` (
  `rule_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rule_check` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rule_connection` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rule_string` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `rule_user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rule_group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rule_action` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rule_folder_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rule_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_privmsgs_rules
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_privmsgs_to`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_privmsgs_to`;
CREATE TABLE `phpbb_privmsgs_to` (
  `msg_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `author_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `pm_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pm_new` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `pm_unread` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `pm_replied` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pm_marked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pm_forwarded` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `folder_id` int(11) NOT NULL DEFAULT '0',
  KEY `msg_id` (`msg_id`),
  KEY `author_id` (`author_id`),
  KEY `usr_flder_id` (`user_id`,`folder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_privmsgs_to
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_profile_fields`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_profile_fields`;
CREATE TABLE `phpbb_profile_fields` (
  `field_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `field_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_type` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_ident` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_length` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_minlen` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_maxlen` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_novalue` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_default_value` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_validation` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_required` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_show_on_reg` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_hide` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_no_view` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `field_show_profile` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_show_on_vt` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_show_novalue` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_show_on_pm` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_show_on_ml` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_is_contact` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_contact_desc` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_contact_url` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`field_id`),
  KEY `fld_type` (`field_type`),
  KEY `fld_ordr` (`field_order`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_profile_fields
-- ----------------------------
INSERT INTO `phpbb_profile_fields` VALUES ('1', 'phpbb_location', 'profilefields.type.string', 'phpbb_location', '20', '2', '100', '', '', '.*', '0', '0', '0', '0', '1', '1', '1', '1', '0', '1', '1', '0', '', '');
INSERT INTO `phpbb_profile_fields` VALUES ('2', 'phpbb_website', 'profilefields.type.url', 'phpbb_website', '40', '12', '255', '', '', '', '0', '0', '0', '0', '1', '2', '1', '1', '0', '1', '1', '1', 'VISIT_WEBSITE', '%s');
INSERT INTO `phpbb_profile_fields` VALUES ('3', 'phpbb_interests', 'profilefields.type.text', 'phpbb_interests', '3|30', '2', '500', '', '', '.*', '0', '0', '0', '0', '0', '3', '1', '0', '0', '0', '0', '0', '', '');
INSERT INTO `phpbb_profile_fields` VALUES ('4', 'phpbb_occupation', 'profilefields.type.text', 'phpbb_occupation', '3|30', '2', '500', '', '', '.*', '0', '0', '0', '0', '0', '4', '1', '0', '0', '0', '0', '0', '', '');
INSERT INTO `phpbb_profile_fields` VALUES ('5', 'phpbb_aol', 'profilefields.type.string', 'phpbb_aol', '40', '5', '255', '', '', '.*', '0', '0', '0', '0', '0', '5', '1', '1', '0', '1', '1', '1', '', '');
INSERT INTO `phpbb_profile_fields` VALUES ('6', 'phpbb_icq', 'profilefields.type.string', 'phpbb_icq', '20', '3', '15', '', '', '[0-9]+', '0', '0', '0', '0', '0', '6', '1', '1', '0', '1', '1', '1', 'SEND_ICQ_MESSAGE', 'https://www.icq.com/people/%s/');
INSERT INTO `phpbb_profile_fields` VALUES ('7', 'phpbb_wlm', 'profilefields.type.string', 'phpbb_wlm', '40', '5', '255', '', '', '.*', '0', '0', '0', '0', '0', '7', '1', '1', '0', '1', '1', '1', '', '');
INSERT INTO `phpbb_profile_fields` VALUES ('8', 'phpbb_yahoo', 'profilefields.type.string', 'phpbb_yahoo', '40', '5', '255', '', '', '.*', '0', '0', '0', '0', '0', '8', '1', '1', '0', '1', '1', '1', 'SEND_YIM_MESSAGE', 'ymsgr:sendim?%s');
INSERT INTO `phpbb_profile_fields` VALUES ('9', 'phpbb_facebook', 'profilefields.type.string', 'phpbb_facebook', '20', '5', '50', '', '', '[\\w.]+', '0', '0', '0', '0', '1', '9', '1', '1', '0', '1', '1', '1', 'VIEW_FACEBOOK_PROFILE', 'http://facebook.com/%s/');
INSERT INTO `phpbb_profile_fields` VALUES ('10', 'phpbb_twitter', 'profilefields.type.string', 'phpbb_twitter', '20', '1', '15', '', '', '[\\w_]+', '0', '0', '0', '0', '1', '10', '1', '1', '0', '1', '1', '1', 'VIEW_TWITTER_PROFILE', 'http://twitter.com/%s');
INSERT INTO `phpbb_profile_fields` VALUES ('11', 'phpbb_skype', 'profilefields.type.string', 'phpbb_skype', '20', '6', '32', '', '', '[a-zA-Z][\\w\\.,\\-_]+', '0', '0', '0', '0', '1', '11', '1', '1', '0', '1', '1', '1', 'VIEW_SKYPE_PROFILE', 'skype:%s?userinfo');
INSERT INTO `phpbb_profile_fields` VALUES ('12', 'phpbb_youtube', 'profilefields.type.string', 'phpbb_youtube', '20', '3', '60', '', '', '[a-zA-Z][\\w\\.,\\-_]+', '0', '0', '0', '0', '1', '12', '1', '1', '0', '1', '1', '1', 'VIEW_YOUTUBE_CHANNEL', 'http://youtube.com/user/%s');
INSERT INTO `phpbb_profile_fields` VALUES ('13', 'phpbb_googleplus', 'profilefields.type.googleplus', 'phpbb_googleplus', '20', '3', '255', '', '', '[\\w]+', '0', '0', '0', '0', '1', '13', '1', '1', '0', '1', '1', '1', 'VIEW_GOOGLEPLUS_PROFILE', 'http://plus.google.com/%s');

-- ----------------------------
-- Table structure for `phpbb_profile_fields_data`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_profile_fields_data`;
CREATE TABLE `phpbb_profile_fields_data` (
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `pf_phpbb_interests` mediumtext COLLATE utf8_bin NOT NULL,
  `pf_phpbb_occupation` mediumtext COLLATE utf8_bin NOT NULL,
  `pf_phpbb_facebook` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pf_phpbb_googleplus` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pf_phpbb_icq` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pf_phpbb_location` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pf_phpbb_skype` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pf_phpbb_twitter` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pf_phpbb_website` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pf_phpbb_wlm` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pf_phpbb_yahoo` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pf_phpbb_youtube` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pf_phpbb_aol` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_profile_fields_data
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_profile_fields_lang`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_profile_fields_lang`;
CREATE TABLE `phpbb_profile_fields_lang` (
  `field_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `option_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `field_type` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `lang_value` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`field_id`,`lang_id`,`option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_profile_fields_lang
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_profile_lang`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_profile_lang`;
CREATE TABLE `phpbb_profile_lang` (
  `field_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `lang_explain` text COLLATE utf8_bin NOT NULL,
  `lang_default_value` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`field_id`,`lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_profile_lang
-- ----------------------------
INSERT INTO `phpbb_profile_lang` VALUES ('1', '1', 'LOCATION', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('1', '2', 'LOCATION', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('2', '1', 'WEBSITE', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('2', '2', 'WEBSITE', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('3', '1', 'INTERESTS', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('3', '2', 'INTERESTS', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('4', '1', 'OCCUPATION', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('4', '2', 'OCCUPATION', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('5', '1', 'AOL', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('5', '2', 'AOL', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('6', '1', 'ICQ', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('6', '2', 'ICQ', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('7', '1', 'WLM', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('7', '2', 'WLM', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('8', '1', 'YAHOO', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('8', '2', 'YAHOO', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('9', '1', 'FACEBOOK', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('9', '2', 'FACEBOOK', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('10', '1', 'TWITTER', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('10', '2', 'TWITTER', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('11', '1', 'SKYPE', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('11', '2', 'SKYPE', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('12', '1', 'YOUTUBE', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('12', '2', 'YOUTUBE', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('13', '1', 'GOOGLEPLUS', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('13', '2', 'GOOGLEPLUS', '', '');

-- ----------------------------
-- Table structure for `phpbb_ranks`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_ranks`;
CREATE TABLE `phpbb_ranks` (
  `rank_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `rank_title` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `rank_min` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rank_special` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `rank_image` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`rank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_ranks
-- ----------------------------
INSERT INTO `phpbb_ranks` VALUES ('1', 'Адміністратор сайту', '0', '1', '');

-- ----------------------------
-- Table structure for `phpbb_reports`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_reports`;
CREATE TABLE `phpbb_reports` (
  `report_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `reason_id` smallint(4) unsigned NOT NULL DEFAULT '0',
  `post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_notify` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `report_closed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `report_time` int(11) unsigned NOT NULL DEFAULT '0',
  `report_text` mediumtext COLLATE utf8_bin NOT NULL,
  `pm_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `reported_post_enable_bbcode` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `reported_post_enable_smilies` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `reported_post_enable_magic_url` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `reported_post_text` mediumtext COLLATE utf8_bin NOT NULL,
  `reported_post_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `reported_post_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`report_id`),
  KEY `post_id` (`post_id`),
  KEY `pm_id` (`pm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_reports
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_reports_reasons`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_reports_reasons`;
CREATE TABLE `phpbb_reports_reasons` (
  `reason_id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `reason_title` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `reason_description` mediumtext COLLATE utf8_bin NOT NULL,
  `reason_order` smallint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`reason_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_reports_reasons
-- ----------------------------
INSERT INTO `phpbb_reports_reasons` VALUES ('1', 'warez', 0xD09FD0BED0B2D196D0B4D0BED0BCD0BBD0B5D0BDD0BDD18F20D0BCD196D181D182D0B8D182D18C20D0BFD0BED181D0B8D0BBD0B0D0BDD0BDD18F20D0BDD0B020D0BDD0B5D0BBD0B5D0B3D0B0D0BBD18CD0BDD0B520D0B0D0B1D0BE20D0BFD196D180D0B0D182D181D18CD0BAD0B520D0BFD180D0BED0B3D180D0B0D0BCD0BDD0B520D0B7D0B0D0B1D0B5D0B7D0BFD0B5D187D0B5D0BDD0BDD18F2E, '1');
INSERT INTO `phpbb_reports_reasons` VALUES ('2', 'spam', 0xD09FD0BED0B2D196D0B4D0BED0BCD0BBD0B5D0BDD0BDD18F20D0BCD0B0D19420D0B7D0B020D0BCD0B5D182D18320D0BBD0B8D188D0B520D180D0B5D0BAD0BBD0B0D0BCD18320D0B2D0B5D0B1D181D0B0D0B9D182D18320D0B0D0B1D0BE20D196D0BDD188D0BED0B3D0BE20D0BFD180D0BED0B4D183D0BAD182D1832E, '2');
INSERT INTO `phpbb_reports_reasons` VALUES ('3', 'off_topic', 0xD09FD0BED0B2D196D0B4D0BED0BCD0BBD0B5D0BDD0BDD18F20D0BDD0B520D0B2D196D0B4D0BDD0BED181D0B8D182D18CD181D18F20D0B4D0BE20D0B4D0B0D0BDD0BED19720D182D0B5D0BCD0B82E, '3');
INSERT INTO `phpbb_reports_reasons` VALUES ('4', 'other', 0xD09FD180D0B8D187D0B8D0BDD0B020D181D0BAD0B0D180D0B3D0B820D0BDD0B020D0BFD0BED0B2D196D0B4D0BED0BCD0BBD0B5D0BDD0BDD18F20D0BDD0B520D0BFD196D0B4D0BFD0B0D0B4D0B0D19420D0BFD196D0B420D0B6D0BED0B4D0BDD18320D0B720D186D0B8D18520D0BAD0B0D182D0B5D0B3D0BED180D196D0B92C20D181D0BAD0BED180D0B8D181D182D0B0D0B9D182D0B5D181D18C20D0BFD0BED0BBD0B5D0BC20D0B4D0BED0B4D0B0D182D0BAD0BED0B2D0BED19720D196D0BDD184D0BED180D0BCD0B0D186D196D1972E, '4');

-- ----------------------------
-- Table structure for `phpbb_search_results`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_search_results`;
CREATE TABLE `phpbb_search_results` (
  `search_key` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_time` int(11) unsigned NOT NULL DEFAULT '0',
  `search_keywords` mediumtext COLLATE utf8_bin NOT NULL,
  `search_authors` mediumtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`search_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_search_results
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_search_wordlist`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_search_wordlist`;
CREATE TABLE `phpbb_search_wordlist` (
  `word_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `word_text` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `word_common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `word_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`word_id`),
  UNIQUE KEY `wrd_txt` (`word_text`),
  KEY `wrd_cnt` (`word_count`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_search_wordlist
-- ----------------------------
INSERT INTO `phpbb_search_wordlist` VALUES ('1', 'приклад', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('2', 'повідомлення', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('3', 'вашого', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('4', 'phpbb3', '0', '2');
INSERT INTO `phpbb_search_wordlist` VALUES ('5', 'форуму', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('6', 'здається', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('7', 'ніби', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('8', 'все', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('9', 'нормально', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('10', 'працює', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('11', 'можете', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('12', 'при', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('13', 'бажанні', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('14', 'видалити', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('15', 'продовжити', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('16', 'налаштування', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('17', 'процесі', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('18', 'встановлення', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('19', 'вашій', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('20', 'першій', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('21', 'категорії', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('22', 'вашому', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('23', 'першому', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('24', 'було', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('25', 'встановлено', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('26', 'відповідні', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('27', 'права', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('28', 'доступу', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('29', 'для', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('30', 'передвстановлених', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('31', 'груп', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('32', 'адміністраторів', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('33', 'ботів', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('34', 'супермодераторів', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('35', 'гостей', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('36', 'зареєстрованих', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('37', 'користувачів', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('38', 'coppa', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('39', 'якщо', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('40', 'видалите', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('41', 'вашу', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('42', 'першу', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('43', 'категорію', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('44', 'ваш', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('45', 'перший', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('46', 'форум', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('47', 'забудьте', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('48', 'надати', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('49', 'усім', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('50', 'цих', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('51', 'групам', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('52', 'нових', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('53', 'категорій', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('54', 'форумів', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('55', 'які', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('56', 'створите', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('57', 'рекомендується', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('58', 'перейменувати', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('59', 'скопіювати', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('60', 'них', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('61', 'створенні', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('62', 'успіхів', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('63', 'ласкаво', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('64', 'просимо', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('65', 'день', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('66', 'пам', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('67', 'яті', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('68', 'примирення', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('69', 'травня', '0', '1');

-- ----------------------------
-- Table structure for `phpbb_search_wordmatch`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_search_wordmatch`;
CREATE TABLE `phpbb_search_wordmatch` (
  `post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `word_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title_match` tinyint(1) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `un_mtch` (`word_id`,`post_id`,`title_match`),
  KEY `word_id` (`word_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_search_wordmatch
-- ----------------------------
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '1', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '2', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '3', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '4', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '4', '1');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '5', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '6', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '7', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '8', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '9', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '10', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '11', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '12', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '13', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '14', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '15', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '16', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '17', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '18', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '19', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '20', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '21', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '22', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '23', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '24', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '25', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '26', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '27', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '28', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '29', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '30', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '31', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '32', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '33', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '34', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '35', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '36', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '37', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '38', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '39', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '40', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '41', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '42', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '43', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '44', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '45', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '46', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '47', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '48', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '49', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '50', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '51', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '52', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '53', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '54', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '55', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '56', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '57', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '58', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '59', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '60', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '61', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '62', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '63', '1');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '64', '1');
INSERT INTO `phpbb_search_wordmatch` VALUES ('2', '65', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('2', '66', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('2', '67', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('2', '68', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('2', '69', '1');

-- ----------------------------
-- Table structure for `phpbb_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_sessions`;
CREATE TABLE `phpbb_sessions` (
  `session_id` char(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `session_last_visit` int(11) unsigned NOT NULL DEFAULT '0',
  `session_start` int(11) unsigned NOT NULL DEFAULT '0',
  `session_time` int(11) unsigned NOT NULL DEFAULT '0',
  `session_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_browser` varchar(150) COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_forwarded_for` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_page` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_viewonline` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `session_autologin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `session_admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `session_forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`),
  KEY `session_time` (`session_time`),
  KEY `session_user_id` (`session_user_id`),
  KEY `session_fid` (`session_forum_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_sessions
-- ----------------------------
INSERT INTO `phpbb_sessions` VALUES ('a732d8b9555572ea1a300fff2a894c59', '1', '1431504211', '1431504211', '1431504487', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36', '', 'viewtopic.php?f=2&t=2', '1', '0', '0', '2');

-- ----------------------------
-- Table structure for `phpbb_sessions_keys`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_sessions_keys`;
CREATE TABLE `phpbb_sessions_keys` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `last_login` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`key_id`,`user_id`),
  KEY `last_login` (`last_login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_sessions_keys
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_sitelist`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_sitelist`;
CREATE TABLE `phpbb_sitelist` (
  `site_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `site_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `site_hostname` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ip_exclude` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_sitelist
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_smilies`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_smilies`;
CREATE TABLE `phpbb_smilies` (
  `smiley_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `emotion` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `smiley_url` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `smiley_width` smallint(4) unsigned NOT NULL DEFAULT '0',
  `smiley_height` smallint(4) unsigned NOT NULL DEFAULT '0',
  `smiley_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `display_on_posting` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`smiley_id`),
  KEY `display_on_post` (`display_on_posting`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_smilies
-- ----------------------------
INSERT INTO `phpbb_smilies` VALUES ('1', ':D', 'Дуже щасливий', 'icon_e_biggrin.gif', '15', '17', '1', '1');
INSERT INTO `phpbb_smilies` VALUES ('2', ':-D', 'Дуже щасливий', 'icon_e_biggrin.gif', '15', '17', '2', '1');
INSERT INTO `phpbb_smilies` VALUES ('3', ':grin:', 'Дуже щасливий', 'icon_e_biggrin.gif', '15', '17', '3', '1');
INSERT INTO `phpbb_smilies` VALUES ('4', ':)', 'Посмішка', 'icon_e_smile.gif', '15', '17', '4', '1');
INSERT INTO `phpbb_smilies` VALUES ('5', ':-)', 'Посмішка', 'icon_e_smile.gif', '15', '17', '5', '1');
INSERT INTO `phpbb_smilies` VALUES ('6', ':smile:', 'Посмішка', 'icon_e_smile.gif', '15', '17', '6', '1');
INSERT INTO `phpbb_smilies` VALUES ('7', ';)', 'Підморгує', 'icon_e_wink.gif', '15', '17', '7', '1');
INSERT INTO `phpbb_smilies` VALUES ('8', ';-)', 'Підморгує', 'icon_e_wink.gif', '15', '17', '8', '1');
INSERT INTO `phpbb_smilies` VALUES ('9', ':wink:', 'Підморгує', 'icon_e_wink.gif', '15', '17', '9', '1');
INSERT INTO `phpbb_smilies` VALUES ('10', ':(', 'Сумний', 'icon_e_sad.gif', '15', '17', '10', '1');
INSERT INTO `phpbb_smilies` VALUES ('11', ':-(', 'Сумний', 'icon_e_sad.gif', '15', '17', '11', '1');
INSERT INTO `phpbb_smilies` VALUES ('12', ':sad:', 'Сумний', 'icon_e_sad.gif', '15', '17', '12', '1');
INSERT INTO `phpbb_smilies` VALUES ('13', ':o', 'Здивований', 'icon_e_surprised.gif', '15', '17', '13', '1');
INSERT INTO `phpbb_smilies` VALUES ('14', ':-o', 'Здивований', 'icon_e_surprised.gif', '15', '17', '14', '1');
INSERT INTO `phpbb_smilies` VALUES ('15', ':eek:', 'Здивований', 'icon_e_surprised.gif', '15', '17', '15', '1');
INSERT INTO `phpbb_smilies` VALUES ('16', ':shock:', 'Шокований', 'icon_eek.gif', '15', '17', '16', '1');
INSERT INTO `phpbb_smilies` VALUES ('17', ':?', 'Спантеличений', 'icon_e_confused.gif', '15', '17', '17', '1');
INSERT INTO `phpbb_smilies` VALUES ('18', ':-?', 'Спантеличений', 'icon_e_confused.gif', '15', '17', '18', '1');
INSERT INTO `phpbb_smilies` VALUES ('19', ':???:', 'Спантеличений', 'icon_e_confused.gif', '15', '17', '19', '1');
INSERT INTO `phpbb_smilies` VALUES ('20', '8-)', 'Кльво', 'icon_cool.gif', '15', '17', '20', '1');
INSERT INTO `phpbb_smilies` VALUES ('21', ':cool:', 'Кльво', 'icon_cool.gif', '15', '17', '21', '1');
INSERT INTO `phpbb_smilies` VALUES ('22', ':lol:', 'Сміється', 'icon_lol.gif', '15', '17', '22', '1');
INSERT INTO `phpbb_smilies` VALUES ('23', ':x', 'Божевільний', 'icon_mad.gif', '15', '17', '23', '1');
INSERT INTO `phpbb_smilies` VALUES ('24', ':-x', 'Божевільний', 'icon_mad.gif', '15', '17', '24', '1');
INSERT INTO `phpbb_smilies` VALUES ('25', ':mad:', 'Божевільний', 'icon_mad.gif', '15', '17', '25', '1');
INSERT INTO `phpbb_smilies` VALUES ('26', ':P', 'Глузує', 'icon_razz.gif', '15', '17', '26', '1');
INSERT INTO `phpbb_smilies` VALUES ('27', ':-P', 'Глузує', 'icon_razz.gif', '15', '17', '27', '1');
INSERT INTO `phpbb_smilies` VALUES ('28', ':razz:', 'Глузує', 'icon_razz.gif', '15', '17', '28', '1');
INSERT INTO `phpbb_smilies` VALUES ('29', ':oops:', 'Збентежений', 'icon_redface.gif', '15', '17', '29', '1');
INSERT INTO `phpbb_smilies` VALUES ('30', ':cry:', 'Плаче або дуже сердитий', 'icon_cry.gif', '15', '17', '30', '1');
INSERT INTO `phpbb_smilies` VALUES ('31', ':evil:', 'Злий або дуже роздратований', 'icon_evil.gif', '15', '17', '31', '1');
INSERT INTO `phpbb_smilies` VALUES ('32', ':twisted:', 'Дуже злий', 'icon_twisted.gif', '15', '17', '32', '1');
INSERT INTO `phpbb_smilies` VALUES ('33', ':roll:', 'Закочує очі', 'icon_rolleyes.gif', '15', '17', '33', '1');
INSERT INTO `phpbb_smilies` VALUES ('34', ':!:', 'Увага', 'icon_exclaim.gif', '15', '17', '34', '1');
INSERT INTO `phpbb_smilies` VALUES ('35', ':?:', 'Питання', 'icon_question.gif', '15', '17', '35', '1');
INSERT INTO `phpbb_smilies` VALUES ('36', ':idea:', 'Ідея', 'icon_idea.gif', '15', '17', '36', '1');
INSERT INTO `phpbb_smilies` VALUES ('37', ':arrow:', 'Стрілка', 'icon_arrow.gif', '15', '17', '37', '1');
INSERT INTO `phpbb_smilies` VALUES ('38', ':|', 'Нейтральний', 'icon_neutral.gif', '15', '17', '38', '1');
INSERT INTO `phpbb_smilies` VALUES ('39', ':-|', 'Нейтральний', 'icon_neutral.gif', '15', '17', '39', '1');
INSERT INTO `phpbb_smilies` VALUES ('40', ':mrgreen:', 'Зелений', 'icon_mrgreen.gif', '15', '17', '40', '1');
INSERT INTO `phpbb_smilies` VALUES ('41', ':geek:', 'Ботанік', 'icon_e_geek.gif', '17', '17', '41', '1');
INSERT INTO `phpbb_smilies` VALUES ('42', ':ugeek:', 'Конкретний ботанік', 'icon_e_ugeek.gif', '17', '18', '42', '1');

-- ----------------------------
-- Table structure for `phpbb_styles`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_styles`;
CREATE TABLE `phpbb_styles` (
  `style_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `style_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `style_copyright` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `style_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `style_path` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bbcode_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'kNg=',
  `style_parent_id` int(4) unsigned NOT NULL DEFAULT '0',
  `style_parent_tree` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`style_id`),
  UNIQUE KEY `style_name` (`style_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_styles
-- ----------------------------
INSERT INTO `phpbb_styles` VALUES ('1', 'prosilver', '&copy; phpBB Limited', '1', 'prosilver', 'kNg=', '0', '');

-- ----------------------------
-- Table structure for `phpbb_teampage`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_teampage`;
CREATE TABLE `phpbb_teampage` (
  `teampage_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `teampage_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `teampage_position` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `teampage_parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`teampage_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_teampage
-- ----------------------------
INSERT INTO `phpbb_teampage` VALUES ('1', '5', '', '1', '0');
INSERT INTO `phpbb_teampage` VALUES ('2', '4', '', '2', '0');

-- ----------------------------
-- Table structure for `phpbb_topics`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_topics`;
CREATE TABLE `phpbb_topics` (
  `topic_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `icon_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_attachment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_reported` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `topic_poster` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_time_limit` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_status` tinyint(3) NOT NULL DEFAULT '0',
  `topic_type` tinyint(3) NOT NULL DEFAULT '0',
  `topic_first_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_first_poster_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `topic_first_poster_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_last_poster_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_last_poster_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_poster_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_post_subject` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_post_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_last_view_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_moved_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_bumped` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_bumper` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poll_title` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `poll_start` int(11) unsigned NOT NULL DEFAULT '0',
  `poll_length` int(11) unsigned NOT NULL DEFAULT '0',
  `poll_max_options` tinyint(4) NOT NULL DEFAULT '1',
  `poll_last_vote` int(11) unsigned NOT NULL DEFAULT '0',
  `poll_vote_change` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_visibility` tinyint(3) NOT NULL DEFAULT '0',
  `topic_delete_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_delete_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_delete_user` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_posts_approved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_posts_unapproved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_posts_softdeleted` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `forum_id_type` (`forum_id`,`topic_type`),
  KEY `last_post_time` (`topic_last_post_time`),
  KEY `fid_time_moved` (`forum_id`,`topic_last_post_time`,`topic_moved_id`),
  KEY `topic_visibility` (`topic_visibility`),
  KEY `forum_vis_last` (`forum_id`,`topic_visibility`,`topic_last_post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_topics
-- ----------------------------
INSERT INTO `phpbb_topics` VALUES ('1', '2', '0', '0', '0', 'Ласкаво просимо до phpBB3', '2', '1431076924', '0', '1', '0', '0', '1', 'intita', 'AA0000', '1', '2', 'intita', 'AA0000', 'Ласкаво просимо до phpBB3', '1431076924', '1431077129', '0', '0', '0', '', '0', '0', '1', '0', '0', '1', '0', '', '0', '1', '0', '0');
INSERT INTO `phpbb_topics` VALUES ('2', '2', '0', '0', '0', '8 травня', '2', '1431082457', '0', '3', '0', '0', '2', 'intita', 'AA0000', '2', '2', 'intita', 'AA0000', '8 травня', '1431082457', '1431082648', '0', '0', '0', '', '0', '0', '1', '0', '0', '1', '0', '', '0', '1', '0', '0');

-- ----------------------------
-- Table structure for `phpbb_topics_posted`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_topics_posted`;
CREATE TABLE `phpbb_topics_posted` (
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_posted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_topics_posted
-- ----------------------------
INSERT INTO `phpbb_topics_posted` VALUES ('2', '1', '1');
INSERT INTO `phpbb_topics_posted` VALUES ('2', '2', '1');

-- ----------------------------
-- Table structure for `phpbb_topics_track`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_topics_track`;
CREATE TABLE `phpbb_topics_track` (
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `mark_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_topics_track
-- ----------------------------
INSERT INTO `phpbb_topics_track` VALUES ('2', '2', '2', '1431082457');

-- ----------------------------
-- Table structure for `phpbb_topics_watch`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_topics_watch`;
CREATE TABLE `phpbb_topics_watch` (
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `notify_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  KEY `notify_stat` (`notify_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_topics_watch
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_users`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_users`;
CREATE TABLE `phpbb_users` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` tinyint(2) NOT NULL DEFAULT '0',
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '3',
  `user_permissions` mediumtext COLLATE utf8_bin NOT NULL,
  `user_perm_from` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_regdate` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `username_clean` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_password` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_passchg` int(11) unsigned NOT NULL DEFAULT '0',
  `user_email` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_email_hash` bigint(20) NOT NULL DEFAULT '0',
  `user_birthday` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_lastvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `user_lastmark` int(11) unsigned NOT NULL DEFAULT '0',
  `user_lastpost_time` int(11) unsigned NOT NULL DEFAULT '0',
  `user_lastpage` varchar(200) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_last_confirm_key` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_last_search` int(11) unsigned NOT NULL DEFAULT '0',
  `user_warnings` tinyint(4) NOT NULL DEFAULT '0',
  `user_last_warning` int(11) unsigned NOT NULL DEFAULT '0',
  `user_login_attempts` tinyint(4) NOT NULL DEFAULT '0',
  `user_inactive_reason` tinyint(2) NOT NULL DEFAULT '0',
  `user_inactive_time` int(11) unsigned NOT NULL DEFAULT '0',
  `user_posts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_lang` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_timezone` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_dateformat` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT 'd M Y H:i',
  `user_style` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_rank` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_new_privmsg` int(4) NOT NULL DEFAULT '0',
  `user_unread_privmsg` int(4) NOT NULL DEFAULT '0',
  `user_last_privmsg` int(11) unsigned NOT NULL DEFAULT '0',
  `user_message_rules` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_full_folder` int(11) NOT NULL DEFAULT '-3',
  `user_emailtime` int(11) unsigned NOT NULL DEFAULT '0',
  `user_topic_show_days` smallint(4) unsigned NOT NULL DEFAULT '0',
  `user_topic_sortby_type` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 't',
  `user_topic_sortby_dir` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'd',
  `user_post_show_days` smallint(4) unsigned NOT NULL DEFAULT '0',
  `user_post_sortby_type` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 't',
  `user_post_sortby_dir` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'a',
  `user_notify` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_notify_pm` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_notify_type` tinyint(4) NOT NULL DEFAULT '0',
  `user_allow_pm` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_allow_viewonline` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_allow_viewemail` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_allow_massemail` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_options` int(11) unsigned NOT NULL DEFAULT '230271',
  `user_avatar` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_avatar_type` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_avatar_width` smallint(4) unsigned NOT NULL DEFAULT '0',
  `user_avatar_height` smallint(4) unsigned NOT NULL DEFAULT '0',
  `user_sig` mediumtext COLLATE utf8_bin NOT NULL,
  `user_sig_bbcode_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_sig_bbcode_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_jabber` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_actkey` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_newpasswd` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_form_salt` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_new` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_reminded` tinyint(4) NOT NULL DEFAULT '0',
  `user_reminded_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_clean` (`username_clean`),
  KEY `user_birthday` (`user_birthday`),
  KEY `user_email_hash` (`user_email_hash`),
  KEY `user_type` (`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_users
-- ----------------------------
INSERT INTO `phpbb_users` VALUES ('1', '2', '1', 0x3030303030303030303030773237777267670A6931636A796F3030303030300A6931636A796F303030303030, '0', '', '1431076924', 'Anonymous', 'anonymous', '', '0', '', '0', '', '0', '0', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', '', 'd M Y H:i', '1', '0', '', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '1', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '0617b53b6240848e', '1', '0', '0');
INSERT INTO `phpbb_users` VALUES ('2', '3', '5', 0x7A696B307A6A7A696B307A6A7A696B307A630A6931636A796F3030303030300A7A696B307A6A7A6938736730, '0', '127.0.0.1', '1431076924', 'intita', 'intita', '$2y$10$G.aeTtUTb6qI44QQuAOgh.P5fP9mw3.6/WzPVzB53z5TM5i3mBdra', '0', 'intita.hr@gmail.com', '144972273819', '', '1431084018', '0', '1431082457', 'index.php', '', '0', '0', '0', '0', '0', '0', '2', 'uk', '', 'D M d, Y g:i a', '1', '1', 'AA0000', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '1', '1', '1', '1', '230271', '', '', '0', '0', '', '', '', '', '', '', 'ed3b359fb386d1d6', '1', '0', '0');
INSERT INTO `phpbb_users` VALUES ('3', '2', '6', '', '0', '', '1431076932', 'AdsBot [Google]', 'adsbot [google]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '8fb1961bea68d3af', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('4', '2', '6', '', '0', '', '1431076932', 'Alexa [Bot]', 'alexa [bot]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'b0ce7ddbe26f78e5', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('5', '2', '6', '', '0', '', '1431076932', 'Alta Vista [Bot]', 'alta vista [bot]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'aa44fb14e9ba2611', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('6', '2', '6', '', '0', '', '1431076932', 'Ask Jeeves [Bot]', 'ask jeeves [bot]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'c6a227e047b660dd', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('7', '2', '6', '', '0', '', '1431076932', 'Baidu [Spider]', 'baidu [spider]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '81eabd6fba400ea6', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('8', '2', '6', '', '0', '', '1431076932', 'Bing [Bot]', 'bing [bot]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'b46ecc9cf4351084', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('9', '2', '6', '', '0', '', '1431076932', 'Exabot [Bot]', 'exabot [bot]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'adccd845a4a3309a', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('10', '2', '6', '', '0', '', '1431076932', 'FAST Enterprise [Crawler]', 'fast enterprise [crawler]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'a9f6cad28682c0b9', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('11', '2', '6', '', '0', '', '1431076932', 'FAST WebCrawler [Crawler]', 'fast webcrawler [crawler]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '0f1e07b60f11f1d0', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('12', '2', '6', '', '0', '', '1431076932', 'Francis [Bot]', 'francis [bot]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '23fc118e872ccb6e', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('13', '2', '6', '', '0', '', '1431076932', 'Gigabot [Bot]', 'gigabot [bot]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '1cb937388ea81f60', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('14', '2', '6', '', '0', '', '1431076932', 'Google Adsense [Bot]', 'google adsense [bot]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '6b94dc3b6ba0ce4d', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('15', '2', '6', '', '0', '', '1431076932', 'Google Desktop', 'google desktop', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '59d01214c2906319', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('16', '2', '6', '', '0', '', '1431076932', 'Google Feedfetcher', 'google feedfetcher', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'fc42531b9677a64b', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('17', '2', '6', '', '0', '', '1431076932', 'Google [Bot]', 'google [bot]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '205e6956b35b1775', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('18', '2', '6', '', '0', '', '1431076932', 'Heise IT-Markt [Crawler]', 'heise it-markt [crawler]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '553be5516caa2d51', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('19', '2', '6', '', '0', '', '1431076932', 'Heritrix [Crawler]', 'heritrix [crawler]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '259e0909a00c977d', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('20', '2', '6', '', '0', '', '1431076932', 'IBM Research [Bot]', 'ibm research [bot]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '0b8c869b3a1976b8', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('21', '2', '6', '', '0', '', '1431076932', 'ICCrawler - ICjobs', 'iccrawler - icjobs', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '98202e2f508b229d', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('22', '2', '6', '', '0', '', '1431076932', 'ichiro [Crawler]', 'ichiro [crawler]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '9d6a1a15c4e37982', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('23', '2', '6', '', '0', '', '1431076932', 'Majestic-12 [Bot]', 'majestic-12 [bot]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'ac211676f47e478d', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('24', '2', '6', '', '0', '', '1431076932', 'Metager [Bot]', 'metager [bot]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '9d659da1e1817872', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('25', '2', '6', '', '0', '', '1431076932', 'MSN NewsBlogs', 'msn newsblogs', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '6e753fd32e6c1fda', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('26', '2', '6', '', '0', '', '1431076932', 'MSN [Bot]', 'msn [bot]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'bf0dde11ccbf74a0', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('27', '2', '6', '', '0', '', '1431076932', 'MSNbot Media', 'msnbot media', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '3335f518df13845b', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('28', '2', '6', '', '0', '', '1431076932', 'Nutch [Bot]', 'nutch [bot]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'f9e8a789835722f6', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('29', '2', '6', '', '0', '', '1431076932', 'Online link [Validator]', 'online link [validator]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '01918a62521bb42f', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('30', '2', '6', '', '0', '', '1431076932', 'psbot [Picsearch]', 'psbot [picsearch]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '2f56f12a5e4703a5', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('31', '2', '6', '', '0', '', '1431076932', 'Sensis [Crawler]', 'sensis [crawler]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '2ed96394667bb77e', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('32', '2', '6', '', '0', '', '1431076932', 'SEO Crawler', 'seo crawler', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'ff916b227c9ec3b8', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('33', '2', '6', '', '0', '', '1431076932', 'Seoma [Crawler]', 'seoma [crawler]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'c9263d6960674eba', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('34', '2', '6', '', '0', '', '1431076932', 'SEOSearch [Crawler]', 'seosearch [crawler]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'ee80f9400368a4c6', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('35', '2', '6', '', '0', '', '1431076932', 'Snappy [Bot]', 'snappy [bot]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'c0268ed35b1b9e27', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('36', '2', '6', '', '0', '', '1431076932', 'Steeler [Crawler]', 'steeler [crawler]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'f88cc526513fe28a', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('37', '2', '6', '', '0', '', '1431076932', 'Telekom [Bot]', 'telekom [bot]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '3647d0840f2b5e85', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('38', '2', '6', '', '0', '', '1431076932', 'TurnitinBot [Bot]', 'turnitinbot [bot]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '70d8e8d5726b0dcd', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('39', '2', '6', '', '0', '', '1431076932', 'Voyager [Bot]', 'voyager [bot]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'c1d7e86c9804c88a', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('40', '2', '6', '', '0', '', '1431076932', 'W3 [Sitesearch]', 'w3 [sitesearch]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'fae0202108d740f5', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('41', '2', '6', '', '0', '', '1431076932', 'W3C [Linkcheck]', 'w3c [linkcheck]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '363767d3d3969504', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('42', '2', '6', '', '0', '', '1431076932', 'W3C [Validator]', 'w3c [validator]', '', '1431076932', '', '0', '', '0', '1431076932', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '1e38cf7df0120df5', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('43', '2', '6', '', '0', '', '1431076933', 'YaCy [Bot]', 'yacy [bot]', '', '1431076933', '', '0', '', '0', '1431076933', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '59c5244985f29d79', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('44', '2', '6', '', '0', '', '1431076933', 'Yahoo MMCrawler [Bot]', 'yahoo mmcrawler [bot]', '', '1431076933', '', '0', '', '0', '1431076933', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '8b4d4e5b829312c3', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('45', '2', '6', '', '0', '', '1431076933', 'Yahoo Slurp [Bot]', 'yahoo slurp [bot]', '', '1431076933', '', '0', '', '0', '1431076933', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '40bdfa398100dabe', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('46', '2', '6', '', '0', '', '1431076933', 'Yahoo [Bot]', 'yahoo [bot]', '', '1431076933', '', '0', '', '0', '1431076933', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '5ef718e8d194dd82', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('47', '2', '6', '', '0', '', '1431076933', 'YahooSeeker [Bot]', 'yahooseeker [bot]', '', '1431076933', '', '0', '', '0', '1431076933', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'uk', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'cd7ba34f5b0082fd', '0', '0', '0');

-- ----------------------------
-- Table structure for `phpbb_user_group`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_user_group`;
CREATE TABLE `phpbb_user_group` (
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_leader` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_pending` tinyint(1) unsigned NOT NULL DEFAULT '1',
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`),
  KEY `group_leader` (`group_leader`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_user_group
-- ----------------------------
INSERT INTO `phpbb_user_group` VALUES ('1', '1', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('2', '2', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('4', '2', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('5', '2', '1', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '3', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '4', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '5', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '6', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '7', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '8', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '9', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '10', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '11', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '12', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '13', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '14', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '15', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '16', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '17', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '18', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '19', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '20', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '21', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '22', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '23', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '24', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '25', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '26', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '27', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '28', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '29', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '30', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '31', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '32', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '33', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '34', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '35', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '36', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '37', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '38', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '39', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '40', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '41', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '42', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '43', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '44', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '45', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '46', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '47', '0', '0');

-- ----------------------------
-- Table structure for `phpbb_user_notifications`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_user_notifications`;
CREATE TABLE `phpbb_user_notifications` (
  `item_type` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `item_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `method` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `notify` tinyint(1) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_user_notifications
-- ----------------------------
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '2', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '2', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '2', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '2', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '3', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '3', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '3', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '3', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '4', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '4', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '4', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '4', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '5', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '5', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '5', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '5', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '6', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '6', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '6', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '6', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '7', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '7', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '7', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '7', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '8', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '8', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '8', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '8', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '9', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '9', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '9', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '9', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '10', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '10', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '10', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '10', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '11', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '11', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '11', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '11', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '12', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '12', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '12', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '12', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '13', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '13', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '13', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '13', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '14', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '14', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '14', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '14', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '15', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '15', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '15', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '15', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '16', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '16', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '16', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '16', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '17', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '17', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '17', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '17', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '18', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '18', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '18', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '18', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '19', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '19', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '19', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '19', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '20', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '20', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '20', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '20', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '21', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '21', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '21', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '21', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '22', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '22', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '22', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '22', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '23', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '23', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '23', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '23', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '24', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '24', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '24', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '24', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '25', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '25', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '25', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '25', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '26', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '26', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '26', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '26', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '27', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '27', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '27', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '27', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '28', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '28', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '28', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '28', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '29', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '29', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '29', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '29', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '30', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '30', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '30', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '30', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '31', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '31', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '31', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '31', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '32', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '32', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '32', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '32', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '33', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '33', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '33', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '33', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '34', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '34', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '34', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '34', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '35', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '35', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '35', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '35', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '36', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '36', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '36', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '36', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '37', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '37', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '37', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '37', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '38', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '38', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '38', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '38', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '39', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '39', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '39', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '39', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '40', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '40', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '40', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '40', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '41', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '41', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '41', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '41', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '42', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '42', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '42', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '42', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '43', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '43', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '43', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '43', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '44', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '44', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '44', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '44', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '45', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '45', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '45', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '45', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '46', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '46', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '46', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '46', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '47', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '47', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '47', '', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '47', 'notification.method.email', '1');

-- ----------------------------
-- Table structure for `phpbb_warnings`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_warnings`;
CREATE TABLE `phpbb_warnings` (
  `warning_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `log_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `warning_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`warning_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_warnings
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_words`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_words`;
CREATE TABLE `phpbb_words` (
  `word_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `replacement` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`word_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_words
-- ----------------------------

-- ----------------------------
-- Table structure for `phpbb_zebra`
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_zebra`;
CREATE TABLE `phpbb_zebra` (
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `zebra_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `friend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `foe` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`zebra_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_zebra
-- ----------------------------

-- ----------------------------
-- Table structure for `response`
-- ----------------------------
DROP TABLE IF EXISTS `response`;
CREATE TABLE `response` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `who` int(11) NOT NULL,
  `about` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `text` text NOT NULL,
  `rate` int(2) DEFAULT NULL,
  `who_ip` varchar(40) NOT NULL,
  `knowledge` int(2) NOT NULL,
  `behavior` int(2) NOT NULL,
  `motivation` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__user` (`who`),
  KEY `FK__user_2` (`about`),
  CONSTRAINT `FK__user` FOREIGN KEY (`who`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__user_2` FOREIGN KEY (`about`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Responses for taechers';

-- ----------------------------
-- Records of response
-- ----------------------------
INSERT INTO `response` VALUES ('1', '1', '38', '2014-11-14 00:00:00', 'Только слова благодарности и восхищения таким педагогом и вообще человеком!\r\n                        С Александрой знакома через ее сайт Учитель мистецтва. Столько высококлассных \r\n                        работ я в сети еще не встречала! Она всегда отвечает на просьбы, решает проблемы пользователей. \r\n                        Очень отзывчивый человек. Спасибо Вам! Терпения, удачи и творческого вдохновения на много лет!', '10', '123.44.31.12', '0', '0', '0');
INSERT INTO `response` VALUES ('2', '22', '38', '2014-11-14 00:00:00', 'Весьма важный этап, учитывая огромную конкуренцию на рынке.\r\n                       Тут, конечно, более важно узнать бизнес-процессы конкурентов, но и проанализировать сайты компаний,\r\n                       с которыми предстоит конкурировать на рынке интернет-торговли будет очень кстати. \r\n                       Так как мы говорим тут о проектировании, я не буду углубляться в сферу промышленного шпионажа, \r\n                       а сосредоточусь на исследовании сайтов, то есть тех моментов, \r\n                       которые нам нужны для последующего проектирования.!', '9', '123.44.31.12', '0', '0', '0');
INSERT INTO `response` VALUES ('5', '22', '38', '2014-11-14 00:00:00', 'Только слова благодарности и восхищения таким педагогом и вообще человеком!\r\n                                 С Александрой  знакома через ее сайт <<Учитель мистецтва>>.  Столько высококлассных \r\n                                 работ я в сети еще не встречала!', '9', '123.44.31.12', '0', '0', '0');
INSERT INTO `response` VALUES ('6', '1', '38', '2014-11-14 00:00:00', 'Весьма важный этап, учитывая огромную конкуренцию на рынке.\r\n                                Тут, конечно, более важно узнать бизнес-процессы конкурентов, но и\r\n                                проанализировать сайты компаний, с которыми предстоит конкурировать \r\n                                на рынке интернет-торговли будет очень кстати. Так как мы говорим тут\r\n                                о проектировании, я не буду углубляться в сферу промышленного шпионажа, \r\n                                а сосредоточусь на исследовании сайтов, то есть тех моментов, которые \r\n                                нам нужны для последующего проектирования.!', '10', '123.44.31.12', '0', '0', '0');

-- ----------------------------
-- Table structure for `sourcemessages`
-- ----------------------------
DROP TABLE IF EXISTS `sourcemessages`;
CREATE TABLE `sourcemessages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category` varchar(32) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=298 DEFAULT CHARSET=utf8 COMMENT='Table for interface messages (keys).';

-- ----------------------------
-- Records of sourcemessages
-- ----------------------------
INSERT INTO `sourcemessages` VALUES ('1', 'mainpage', '0001');
INSERT INTO `sourcemessages` VALUES ('2', 'mainpage', '0002');
INSERT INTO `sourcemessages` VALUES ('3', 'mainpage', '0003');
INSERT INTO `sourcemessages` VALUES ('4', 'mainpage', '0004');
INSERT INTO `sourcemessages` VALUES ('5', 'slider', '0005');
INSERT INTO `sourcemessages` VALUES ('6', 'mainpage', '0006');
INSERT INTO `sourcemessages` VALUES ('7', 'mainpage', '0007');
INSERT INTO `sourcemessages` VALUES ('8', 'slider', '0008');
INSERT INTO `sourcemessages` VALUES ('9', 'regform', '0009');
INSERT INTO `sourcemessages` VALUES ('10', 'regform', '0010');
INSERT INTO `sourcemessages` VALUES ('11', 'regform', '0011');
INSERT INTO `sourcemessages` VALUES ('12', 'regform', '0012');
INSERT INTO `sourcemessages` VALUES ('13', 'regform', '0013');
INSERT INTO `sourcemessages` VALUES ('14', 'regform', '0014');
INSERT INTO `sourcemessages` VALUES ('15', 'regform', '0015');
INSERT INTO `sourcemessages` VALUES ('16', 'header', '0016');
INSERT INTO `sourcemessages` VALUES ('17', 'header', '0017');
INSERT INTO `sourcemessages` VALUES ('18', 'header', '0018');
INSERT INTO `sourcemessages` VALUES ('19', 'header', '0019');
INSERT INTO `sourcemessages` VALUES ('20', 'header', '0020');
INSERT INTO `sourcemessages` VALUES ('21', 'header', '0021');
INSERT INTO `sourcemessages` VALUES ('22', 'header', '0022');
INSERT INTO `sourcemessages` VALUES ('23', 'footer', '0023');
INSERT INTO `sourcemessages` VALUES ('24', 'footer', '0024');
INSERT INTO `sourcemessages` VALUES ('25', 'footer', '0025');
INSERT INTO `sourcemessages` VALUES ('26', 'footer', '0026');
INSERT INTO `sourcemessages` VALUES ('27', 'slider', '0027');
INSERT INTO `sourcemessages` VALUES ('28', 'slider', '0028');
INSERT INTO `sourcemessages` VALUES ('29', 'slider', '0029');
INSERT INTO `sourcemessages` VALUES ('30', 'slider', '0030');
INSERT INTO `sourcemessages` VALUES ('31', 'slider', '0031');
INSERT INTO `sourcemessages` VALUES ('32', 'aboutus', '0032');
INSERT INTO `sourcemessages` VALUES ('33', 'aboutus', '0033');
INSERT INTO `sourcemessages` VALUES ('34', 'aboutus', '0034');
INSERT INTO `sourcemessages` VALUES ('35', 'aboutus', '0035');
INSERT INTO `sourcemessages` VALUES ('36', 'aboutus', '0036');
INSERT INTO `sourcemessages` VALUES ('37', 'aboutus', '0037');
INSERT INTO `sourcemessages` VALUES ('38', 'step', '0038');
INSERT INTO `sourcemessages` VALUES ('39', 'step', '0039');
INSERT INTO `sourcemessages` VALUES ('40', 'step', '0040');
INSERT INTO `sourcemessages` VALUES ('41', 'step', '0041');
INSERT INTO `sourcemessages` VALUES ('42', 'step', '0042');
INSERT INTO `sourcemessages` VALUES ('43', 'step', '0043');
INSERT INTO `sourcemessages` VALUES ('44', 'step', '0044');
INSERT INTO `sourcemessages` VALUES ('45', 'step', '0045');
INSERT INTO `sourcemessages` VALUES ('46', 'step', '0046');
INSERT INTO `sourcemessages` VALUES ('47', 'step', '0047');
INSERT INTO `sourcemessages` VALUES ('48', 'step', '0048');
INSERT INTO `sourcemessages` VALUES ('49', 'breadcrumbs', '0049');
INSERT INTO `sourcemessages` VALUES ('50', 'breadcrumbs', '0050');
INSERT INTO `sourcemessages` VALUES ('51', 'breadcrumbs', '0051');
INSERT INTO `sourcemessages` VALUES ('52', 'breadcrumbs', '0052');
INSERT INTO `sourcemessages` VALUES ('53', 'breadcrumbs', '0053');
INSERT INTO `sourcemessages` VALUES ('54', 'breadcrumbs', '0054');
INSERT INTO `sourcemessages` VALUES ('55', 'breadcrumbs', '0055');
INSERT INTO `sourcemessages` VALUES ('56', 'breadcrumbs', '0056');
INSERT INTO `sourcemessages` VALUES ('57', 'breadcrumbs', '0057');
INSERT INTO `sourcemessages` VALUES ('58', 'teachers', '0058');
INSERT INTO `sourcemessages` VALUES ('59', 'teachers', '0059');
INSERT INTO `sourcemessages` VALUES ('60', 'teachers', '0060');
INSERT INTO `sourcemessages` VALUES ('61', 'teachers', '0061');
INSERT INTO `sourcemessages` VALUES ('62', 'teachers', '0062');
INSERT INTO `sourcemessages` VALUES ('63', 'teachers', '0063');
INSERT INTO `sourcemessages` VALUES ('64', 'teacher', '0064');
INSERT INTO `sourcemessages` VALUES ('65', 'teacher', '0065');
INSERT INTO `sourcemessages` VALUES ('66', 'courses', '0066');
INSERT INTO `sourcemessages` VALUES ('67', 'courses', '0067');
INSERT INTO `sourcemessages` VALUES ('68', 'courses', '0068');
INSERT INTO `sourcemessages` VALUES ('69', 'courses', '0069');
INSERT INTO `sourcemessages` VALUES ('70', 'lecture', '0070');
INSERT INTO `sourcemessages` VALUES ('71', 'lecture', '0071');
INSERT INTO `sourcemessages` VALUES ('72', 'lecture', '0072');
INSERT INTO `sourcemessages` VALUES ('73', 'lecture', '0073');
INSERT INTO `sourcemessages` VALUES ('74', 'lecture', '0074');
INSERT INTO `sourcemessages` VALUES ('75', 'lecture', '0075');
INSERT INTO `sourcemessages` VALUES ('76', 'lecture', '0076');
INSERT INTO `sourcemessages` VALUES ('77', 'lecture', '0077');
INSERT INTO `sourcemessages` VALUES ('78', 'lecture', '0078');
INSERT INTO `sourcemessages` VALUES ('79', 'lecture', '0079');
INSERT INTO `sourcemessages` VALUES ('80', 'lecture', '0080');
INSERT INTO `sourcemessages` VALUES ('81', 'lecture', '0081');
INSERT INTO `sourcemessages` VALUES ('82', 'lecture', '0082');
INSERT INTO `sourcemessages` VALUES ('83', 'lecture', '0083');
INSERT INTO `sourcemessages` VALUES ('84', 'lecture', '0084');
INSERT INTO `sourcemessages` VALUES ('85', 'lecture', '0085');
INSERT INTO `sourcemessages` VALUES ('86', 'lecture', '0086');
INSERT INTO `sourcemessages` VALUES ('87', 'lecture', '0087');
INSERT INTO `sourcemessages` VALUES ('88', 'lecture', '0088');
INSERT INTO `sourcemessages` VALUES ('89', 'lecture', '0089');
INSERT INTO `sourcemessages` VALUES ('90', 'lecture', '0090');
INSERT INTO `sourcemessages` VALUES ('91', 'regform', '0091');
INSERT INTO `sourcemessages` VALUES ('92', 'regform', '0092');
INSERT INTO `sourcemessages` VALUES ('93', 'regform', '0093');
INSERT INTO `sourcemessages` VALUES ('94', 'courses', '0094');
INSERT INTO `sourcemessages` VALUES ('95', 'profile', '0095');
INSERT INTO `sourcemessages` VALUES ('96', 'profile', '0096');
INSERT INTO `sourcemessages` VALUES ('97', 'profile', '0097');
INSERT INTO `sourcemessages` VALUES ('98', 'profile', '0098');
INSERT INTO `sourcemessages` VALUES ('99', 'profile', '0099');
INSERT INTO `sourcemessages` VALUES ('100', 'profile', '0100');
INSERT INTO `sourcemessages` VALUES ('101', 'profile', '0101');
INSERT INTO `sourcemessages` VALUES ('102', 'profile', '0102');
INSERT INTO `sourcemessages` VALUES ('103', 'profile', '0103');
INSERT INTO `sourcemessages` VALUES ('104', 'profile', '0104');
INSERT INTO `sourcemessages` VALUES ('105', 'profile', '0105');
INSERT INTO `sourcemessages` VALUES ('106', 'profile', '0106');
INSERT INTO `sourcemessages` VALUES ('107', 'profile', '0107');
INSERT INTO `sourcemessages` VALUES ('108', 'profile', '0108');
INSERT INTO `sourcemessages` VALUES ('109', 'profile', '0109');
INSERT INTO `sourcemessages` VALUES ('110', 'profile', '0110');
INSERT INTO `sourcemessages` VALUES ('111', 'profile', '0111');
INSERT INTO `sourcemessages` VALUES ('112', 'profile', '0112');
INSERT INTO `sourcemessages` VALUES ('113', 'profile', '0113');
INSERT INTO `sourcemessages` VALUES ('114', 'profile', '0114');
INSERT INTO `sourcemessages` VALUES ('115', 'profile', '0115');
INSERT INTO `sourcemessages` VALUES ('116', 'profile', '0116');
INSERT INTO `sourcemessages` VALUES ('117', 'profile', '0117');
INSERT INTO `sourcemessages` VALUES ('118', 'profile', '0118');
INSERT INTO `sourcemessages` VALUES ('119', 'profile', '0119');
INSERT INTO `sourcemessages` VALUES ('120', 'profile', '0120');
INSERT INTO `sourcemessages` VALUES ('121', 'profile', '0121');
INSERT INTO `sourcemessages` VALUES ('122', 'profile', '0122');
INSERT INTO `sourcemessages` VALUES ('123', 'profile', '0123');
INSERT INTO `sourcemessages` VALUES ('124', 'profile', '0124');
INSERT INTO `sourcemessages` VALUES ('125', 'profile', '0125');
INSERT INTO `sourcemessages` VALUES ('126', 'profile', '0126');
INSERT INTO `sourcemessages` VALUES ('127', 'profile', '0127');
INSERT INTO `sourcemessages` VALUES ('128', 'profile', '0128');
INSERT INTO `sourcemessages` VALUES ('129', 'profile', '0129');
INSERT INTO `sourcemessages` VALUES ('130', 'profile', '0130');
INSERT INTO `sourcemessages` VALUES ('131', 'profile', '0131');
INSERT INTO `sourcemessages` VALUES ('132', 'profile', '0132');
INSERT INTO `sourcemessages` VALUES ('133', 'profile', '0133');
INSERT INTO `sourcemessages` VALUES ('134', 'profile', '0134');
INSERT INTO `sourcemessages` VALUES ('135', 'profile', '0135');
INSERT INTO `sourcemessages` VALUES ('136', 'profile', '0136');
INSERT INTO `sourcemessages` VALUES ('137', 'header', '0137');
INSERT INTO `sourcemessages` VALUES ('138', 'errors', '0138');
INSERT INTO `sourcemessages` VALUES ('139', 'errors', '0139');
INSERT INTO `sourcemessages` VALUES ('140', 'courses', '0140');
INSERT INTO `sourcemessages` VALUES ('141', 'courses', '0141');
INSERT INTO `sourcemessages` VALUES ('142', 'courses', '0142');
INSERT INTO `sourcemessages` VALUES ('143', 'courses', '0143');
INSERT INTO `sourcemessages` VALUES ('144', 'courses', '0144');
INSERT INTO `sourcemessages` VALUES ('145', 'courses', '0145');
INSERT INTO `sourcemessages` VALUES ('146', 'courses', '0146');
INSERT INTO `sourcemessages` VALUES ('147', 'courses', '0147');
INSERT INTO `sourcemessages` VALUES ('148', 'courses', '0148');
INSERT INTO `sourcemessages` VALUES ('149', 'courses', '0149');
INSERT INTO `sourcemessages` VALUES ('150', 'regexp', '0150');
INSERT INTO `sourcemessages` VALUES ('151', 'regexp', '0151');
INSERT INTO `sourcemessages` VALUES ('152', 'regexp', '0152');
INSERT INTO `sourcemessages` VALUES ('153', 'regexp', '0153');
INSERT INTO `sourcemessages` VALUES ('154', 'regexp', '0154');
INSERT INTO `sourcemessages` VALUES ('155', 'regexp', '0155');
INSERT INTO `sourcemessages` VALUES ('156', 'regexp', '0156');
INSERT INTO `sourcemessages` VALUES ('157', 'regexp', '0157');
INSERT INTO `sourcemessages` VALUES ('158', 'regexp', '0158');
INSERT INTO `sourcemessages` VALUES ('159', 'regexp', '0159');
INSERT INTO `sourcemessages` VALUES ('160', 'regexp', '0160');
INSERT INTO `sourcemessages` VALUES ('161', 'regexp', '0161');
INSERT INTO `sourcemessages` VALUES ('162', 'regexp', '0162');
INSERT INTO `sourcemessages` VALUES ('163', 'regexp', '0163');
INSERT INTO `sourcemessages` VALUES ('164', 'regexp', '0164');
INSERT INTO `sourcemessages` VALUES ('165', 'regexp', '0165');
INSERT INTO `sourcemessages` VALUES ('166', 'regexp', '0166');
INSERT INTO `sourcemessages` VALUES ('167', 'regexp', '0167');
INSERT INTO `sourcemessages` VALUES ('168', 'regexp', '0168');
INSERT INTO `sourcemessages` VALUES ('169', 'regexp', '0169');
INSERT INTO `sourcemessages` VALUES ('170', 'regexp', '0170');
INSERT INTO `sourcemessages` VALUES ('171', 'regexp', '0171');
INSERT INTO `sourcemessages` VALUES ('172', 'regexp', '0172');
INSERT INTO `sourcemessages` VALUES ('173', 'regexp', '0173');
INSERT INTO `sourcemessages` VALUES ('174', 'teachers', '0174');
INSERT INTO `sourcemessages` VALUES ('175', 'teachers', '0175');
INSERT INTO `sourcemessages` VALUES ('176', 'teachers', '0176');
INSERT INTO `sourcemessages` VALUES ('177', 'teachers', '0177');
INSERT INTO `sourcemessages` VALUES ('178', 'teachers', '0178');
INSERT INTO `sourcemessages` VALUES ('179', 'teachers', '0179');
INSERT INTO `sourcemessages` VALUES ('180', 'teachers', '0180');
INSERT INTO `sourcemessages` VALUES ('181', 'teacher', '0181');
INSERT INTO `sourcemessages` VALUES ('182', 'teacher', '0182');
INSERT INTO `sourcemessages` VALUES ('183', 'teacher', '0183');
INSERT INTO `sourcemessages` VALUES ('184', 'teacher', '0184');
INSERT INTO `sourcemessages` VALUES ('185', 'teacher', '0185');
INSERT INTO `sourcemessages` VALUES ('186', 'teacher', '0186');
INSERT INTO `sourcemessages` VALUES ('187', 'teacher', '0187');
INSERT INTO `sourcemessages` VALUES ('188', 'teacher', '0188');
INSERT INTO `sourcemessages` VALUES ('189', 'teacher', '0189');
INSERT INTO `sourcemessages` VALUES ('190', 'teacher', '0190');
INSERT INTO `sourcemessages` VALUES ('191', 'teacher', '0191');
INSERT INTO `sourcemessages` VALUES ('192', 'teacher', '0192');
INSERT INTO `sourcemessages` VALUES ('193', 'course', '0193');
INSERT INTO `sourcemessages` VALUES ('194', 'course', '0194');
INSERT INTO `sourcemessages` VALUES ('195', 'course', '0195');
INSERT INTO `sourcemessages` VALUES ('196', 'course', '0196');
INSERT INTO `sourcemessages` VALUES ('197', 'course', '0197');
INSERT INTO `sourcemessages` VALUES ('198', 'course', '0198');
INSERT INTO `sourcemessages` VALUES ('199', 'course', '0199');
INSERT INTO `sourcemessages` VALUES ('200', 'course', '0200');
INSERT INTO `sourcemessages` VALUES ('201', 'course', '0201');
INSERT INTO `sourcemessages` VALUES ('202', 'course', '0202');
INSERT INTO `sourcemessages` VALUES ('203', 'course', '0203');
INSERT INTO `sourcemessages` VALUES ('204', 'course', '0204');
INSERT INTO `sourcemessages` VALUES ('205', 'course', '0205');
INSERT INTO `sourcemessages` VALUES ('206', 'course', '0206');
INSERT INTO `sourcemessages` VALUES ('207', 'course', '0207');
INSERT INTO `sourcemessages` VALUES ('208', 'course', '0208');
INSERT INTO `sourcemessages` VALUES ('209', 'course', '0209');
INSERT INTO `sourcemessages` VALUES ('210', 'course', '0210');
INSERT INTO `sourcemessages` VALUES ('211', 'module', '0211');
INSERT INTO `sourcemessages` VALUES ('212', 'module', '0212');
INSERT INTO `sourcemessages` VALUES ('213', 'module', '0213');
INSERT INTO `sourcemessages` VALUES ('214', 'module', '0214');
INSERT INTO `sourcemessages` VALUES ('215', 'module', '0215');
INSERT INTO `sourcemessages` VALUES ('216', 'module', '0216');
INSERT INTO `sourcemessages` VALUES ('217', 'module', '0217');
INSERT INTO `sourcemessages` VALUES ('218', 'module', '0218');
INSERT INTO `sourcemessages` VALUES ('219', 'module', '0219');
INSERT INTO `sourcemessages` VALUES ('220', 'module', '0220');
INSERT INTO `sourcemessages` VALUES ('221', 'module', '0221');
INSERT INTO `sourcemessages` VALUES ('222', 'module', '0222');
INSERT INTO `sourcemessages` VALUES ('223', 'module', '0223');
INSERT INTO `sourcemessages` VALUES ('224', 'module', '0224');
INSERT INTO `sourcemessages` VALUES ('225', 'module', '0225');
INSERT INTO `sourcemessages` VALUES ('226', 'module', '0226');
INSERT INTO `sourcemessages` VALUES ('227', 'module', '0227');
INSERT INTO `sourcemessages` VALUES ('228', 'module', '0228');
INSERT INTO `sourcemessages` VALUES ('229', 'courses', '0229');
INSERT INTO `sourcemessages` VALUES ('230', 'courses', '0230');
INSERT INTO `sourcemessages` VALUES ('231', 'courses', '0231');
INSERT INTO `sourcemessages` VALUES ('232', 'courses', '0232');
INSERT INTO `sourcemessages` VALUES ('233', 'courses', '0233');
INSERT INTO `sourcemessages` VALUES ('234', 'courses', '0234');
INSERT INTO `sourcemessages` VALUES ('235', 'courses', '0235');
INSERT INTO `sourcemessages` VALUES ('236', 'courses', '0236');
INSERT INTO `sourcemessages` VALUES ('237', 'exception', '0237');
INSERT INTO `sourcemessages` VALUES ('238', 'exception', '0238');
INSERT INTO `sourcemessages` VALUES ('239', 'recovery', '0239');
INSERT INTO `sourcemessages` VALUES ('240', 'recovery', '0240');
INSERT INTO `sourcemessages` VALUES ('241', 'profile', '0241');
INSERT INTO `sourcemessages` VALUES ('242', 'regexp', '0242');
INSERT INTO `sourcemessages` VALUES ('243', 'regexp', '0243');
INSERT INTO `sourcemessages` VALUES ('244', 'regexp', '0244');
INSERT INTO `sourcemessages` VALUES ('245', 'regexp', '0245');
INSERT INTO `sourcemessages` VALUES ('246', 'regexp', '0246');
INSERT INTO `sourcemessages` VALUES ('247', 'regexp', '0247');
INSERT INTO `sourcemessages` VALUES ('248', 'regexp', '0248');
INSERT INTO `sourcemessages` VALUES ('249', 'regexp', '0249');
INSERT INTO `sourcemessages` VALUES ('250', 'profile', '0250');
INSERT INTO `sourcemessages` VALUES ('251', 'profile', '0251');
INSERT INTO `sourcemessages` VALUES ('252', 'profile', '0252');
INSERT INTO `sourcemessages` VALUES ('253', 'profile', '0253');
INSERT INTO `sourcemessages` VALUES ('254', 'profile', '0254');
INSERT INTO `sourcemessages` VALUES ('255', 'profile', '0255');
INSERT INTO `sourcemessages` VALUES ('256', 'profile', '0256');
INSERT INTO `sourcemessages` VALUES ('257', 'profile', '0257');
INSERT INTO `sourcemessages` VALUES ('258', 'profile', '0258');
INSERT INTO `sourcemessages` VALUES ('259', 'profile', '0259');
INSERT INTO `sourcemessages` VALUES ('260', 'profile', '0260');
INSERT INTO `sourcemessages` VALUES ('261', 'profile', '0261');
INSERT INTO `sourcemessages` VALUES ('262', 'regexp', '0262');
INSERT INTO `sourcemessages` VALUES ('263', 'regexp', '0263');
INSERT INTO `sourcemessages` VALUES ('264', 'regexp', '0264');
INSERT INTO `sourcemessages` VALUES ('265', 'regexp', '0265');
INSERT INTO `sourcemessages` VALUES ('266', 'regexp', '0266');
INSERT INTO `sourcemessages` VALUES ('267', 'regexp', '0267');
INSERT INTO `sourcemessages` VALUES ('268', 'error', '0268');
INSERT INTO `sourcemessages` VALUES ('269', 'error', '0269');
INSERT INTO `sourcemessages` VALUES ('270', 'error', '0270');
INSERT INTO `sourcemessages` VALUES ('271', 'error', '0271');
INSERT INTO `sourcemessages` VALUES ('272', 'error', '0272');
INSERT INTO `sourcemessages` VALUES ('273', 'error', '0273');
INSERT INTO `sourcemessages` VALUES ('274', 'error', '0274');
INSERT INTO `sourcemessages` VALUES ('275', 'error', '0275');
INSERT INTO `sourcemessages` VALUES ('276', 'error', '0276');
INSERT INTO `sourcemessages` VALUES ('277', 'error', '0277');
INSERT INTO `sourcemessages` VALUES ('278', 'error', '0278');
INSERT INTO `sourcemessages` VALUES ('279', 'module', '0279');
INSERT INTO `sourcemessages` VALUES ('280', 'module', '0280');
INSERT INTO `sourcemessages` VALUES ('281', 'recovery', '0281');
INSERT INTO `sourcemessages` VALUES ('282', 'recovery', '0282');
INSERT INTO `sourcemessages` VALUES ('283', 'recovery', '0283');
INSERT INTO `sourcemessages` VALUES ('284', 'recovery', '0284');
INSERT INTO `sourcemessages` VALUES ('285', 'resetpass', '0285');
INSERT INTO `sourcemessages` VALUES ('286', 'resetemail', '0286');
INSERT INTO `sourcemessages` VALUES ('287', 'resetemail', '0287');
INSERT INTO `sourcemessages` VALUES ('288', 'resetemail', '0288');
INSERT INTO `sourcemessages` VALUES ('289', 'forgotpass', '0289');
INSERT INTO `sourcemessages` VALUES ('290', 'forgotpass', '0290');
INSERT INTO `sourcemessages` VALUES ('291', 'forgotpass', '0291');
INSERT INTO `sourcemessages` VALUES ('292', 'changeemail', '0292');
INSERT INTO `sourcemessages` VALUES ('293', 'changeemail', '0293');
INSERT INTO `sourcemessages` VALUES ('294', 'changeemail', '0294');
INSERT INTO `sourcemessages` VALUES ('295', 'regexp', '0295');
INSERT INTO `sourcemessages` VALUES ('296', 'breadcrumbs', '0296');
INSERT INTO `sourcemessages` VALUES ('297', 'graduates', '0297');

-- ----------------------------
-- Table structure for `step`
-- ----------------------------
DROP TABLE IF EXISTS `step`;
CREATE TABLE `step` (
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

-- ----------------------------
-- Records of step
-- ----------------------------
INSERT INTO `step` VALUES ('1', 'UA', 'крок', '1', 'Реєстрація на сайті', '/css/images/', ' /images/mainpage/step1.jpg', 'Щоб отримати доступ до переліку курсів, модулів і занять та пройти безкоштовні модулі і заняття зареєструйся на сайті. Реєстрація дозволить тобі оцінити якість та зручність нашого продукт, який стане для тебе надійним партнером і порадником в професійній самореалізації.\r\n');
INSERT INTO `step` VALUES ('2', 'UA', 'крок', '2', 'Вибір курсу чи модуля', '/css/images/', '/images/mainpage/step2.jpg', '<p>Щоб стати спеціалістом певного напрямку та рівня (отримати професійну спеціалізацію) вибери для проходження відповідний курс. Якщо Тебе цікавить виключно поглиблення знань в певному напрямку ІТ, то вибери відповідний модуль для проходження.</p>');
INSERT INTO `step` VALUES ('3', 'UA', 'крок', '3', 'Проплата', '/css/images/', '/images/mainpage/step3.jpg', 'Щоб розпочати проходження курсу чи модуля вибери схему оплати (вся сума за курс, помісячно, потриместрово тощо) та здійсни оплату зручним Тобі способом (схему оплати курсу чи модуля можна змінювати, також можлива помісячна оплата в кредит).');
INSERT INTO `step` VALUES ('4', 'UA', 'крок', '4', 'Освоєння матеріалу', '/css/images/', '/images/mainpage/step4.jpg', '<p>Вивчення матеріалу можливе шляхом читання тексту чи/і перегляду відео для кожного заняття.\n    Протягом освоєння матеріалу заняття виконуй Проміжні тестові завдання. По завершенню кожного заняття виконуй Підсумкове тестове завдання. Кожен модуль завершується Індивідуальним проектом чи Екзаменом.\n    Можна отримати індивідуальну консультацію викладача чи обговорити питання на форумі.</p>');
INSERT INTO `step` VALUES ('5', 'UA', 'крок', '5', 'Завершення курсу', '/css/images/', '/images/mainpage/step5.jpg', 'Підсумком курсу є Командний дипломний проект, який виконується разом з іншими студентами (склад команди формуєш самостійно чи рекомендує керівник, який затверджує тему і технічне завдання проекту). Здача проекту передбачає передзахист та захист в он-лайн режимі із представленням технічної документації.');

-- ----------------------------
-- Table structure for `teacher`
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(6) NOT NULL,
  `first_name` varchar(35) NOT NULL,
  `middle_name` varchar(35) NOT NULL,
  `last_name` varchar(35) NOT NULL,
  `foto_url` varchar(100) NOT NULL,
  `subjects` varchar(100) NOT NULL,
  `profile_text_first` text NOT NULL,
  `profile_text_short` text NOT NULL,
  `profile_text_last` text NOT NULL,
  `readMoreLink` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(100) NOT NULL,
  `skype` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `linkName` varchar(50) NOT NULL,
  `smallImage` varchar(255) NOT NULL,
  `rate_knowledge` int(2) NOT NULL,
  `rate_efficiency` int(2) NOT NULL,
  `rate_relations` int(2) NOT NULL,
  `sections` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `courses` varchar(255) NOT NULL,
  `foto_url_short` varchar(255) NOT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teacher
-- ----------------------------
INSERT INTO `teacher` VALUES ('1', 'UA', 'Олександра', 'Василівна', 'Сіра', '/css/images/teacher1.jpg', 'кройка и шитье сроков; програмування самоубийств', '<p><em></em>Народилася і виросла в Сакраменто, у 18 років вона переїхала до Лос-Анджелеса й незабаром стала</p><p>                                викладачем. У 2007, 2008 і 2010 рр.. вона виграла кілька номінацій премії AVN Awards</p><p>                                (також була названа «Найкращою програмісткою» у 2007 році за версією XRCO).</p><p>                                Паралельно з вікладауцью роботою та роботою програміста в Саша Грей грає головну роль в тестванні Інтернету.<br></p><p>                                Марина Енн Генціс народилася у родині механіка. Її батько мав грецьке походження.</p><p>                                Батьки дівчинки розлучилися коли їй було 5 років, надалі її виховувала мати, яка вступила</p><p>                                в повторний шлюб у 2000 роц. Марина не ладнала з вітчимом, і, коли їй виповнилося 16 років,</p><p>                                дівчина повідомила матері, що збирається покинути будинок. Достеменно невідомо, втекла вона з свого</p><p>                    будинку або ж її відпустила мати. Сама Олександра пізніше зізнавалася, що в той час робила все те,</p><p>                    що не подобалося її батькам і що вони їй забороняли.<br></p><p>                    Главный бухгалтер акционерного предприятия, специализирующегося на:</p><ul>	<li>оказании полезных услуг горизонтального характера;</li>	<li>торговле, внешнеэкономической и внутреннеэкономической;</li>	<li>позитивное обучение швейного мастерства;</li></ul>', '<p>Профессиональный преподаватель бухгалтерского и налогового учета Национальноготранспортного университета кафедры финансов, учета и аудита со стажем преподавательской работы более 25 лет. Закончила аспирантуру, автор 36 научных работ в области учета и аудита, в т.ч. уникальной обучающей методики написания бухгалтерских проводок: <span>\"Как украсть и не сесть\" </span> и <span>\"Как украсть и посадить другого\" </span>.</p><p>Главный бухгалтер акционерного предприятия, специализирующегося на:<ul><li>оказании полезных услуг горизонтального характера;</li><li>торговле, внешнеэкономической и внутреннеэкономической;</li><li>позитивное обучение швейного мастерства;</li></ul></p>', '<p>Олександра Сіра <del>виконала гол</del>овну роль у фільмі оскароносного режисера</p><p>                        Стівена Содерберга «Дівчина за викликом»[27][28]. Олександра грає дівчину на ім\'я Челсі, яка надає</p><p>                        ескорт послуги заможним людям. Содерберг взяв її на роль після того, як прочитав статтю про неї у</p><p>                        журналі Los Angeles, коментуючи це так: «She\'s kind of a new breed, I think. She doesn\'t really <del>fit </del></p><p><del><strong>                        the typical mold of someone who goes into the adult film <em>business. … I\'d never heard anybody talk </em></strong></del></p><p><del><em><strong>                        about the business the way that she ta</strong></em></del>lked about it». Журналіст Скотт Маколей каже, що можливо</p><p>                        Грей вибрала саме цю роль через свій інтерес до незалежних режисерів, таких як Жан-Люк Годар,</p><p>                        Хармоні Корін, Девід Гордон Грін, Мікеланджело Антоніоні, Аньєс Варда та Вільям Клейн.</p><p><br>Коли Олександра  готувалася до ролі у «Дівчині за викликом»,</p><p>                        Содерберг попросив її подивитися «Жити своїм життям» і «Божевільний П\'єро»[29].</p><p>                        У фільмі «Жити своїм життям» піднімаються проблеми проституції, звідки Грей могла</p><p>                        взяти щось і для своєї ролі, в той час як у «Божевільному П\'єро» показані відносини,</p><p>                        схожі на ті, що відбуваються між Челсі, її хлопцем і клієнтами.</p>', '/profile/index/1/', 'teacher1@gmail.com', '/067/56-569-56, /093/26-45-65', 'teacher1', '', '', '/css/images/teacherImage.png', '4', '4', '5', 'Програмування ПХП;\r\nJava для IOS;', '38', '', 'teacher1.jpg');
INSERT INTO `teacher` VALUES ('2', 'UA', 'Константин', 'Константинович', 'Константинопольский', '/css/images/teacher2.jpg', 'программування БДСМ; программування на Php для пострадавших в ЧАЭС; GlobalLoqic, Samsung, Coqniance', '<p>Hello!</p>', '<p>Консультант по вопросам бухгалтерского и налогового учета, отчетности для предприятий разной формы собственности. Преподаватель с многолетним стажем работы. <span>Реально шарит в компьютерах.</span></p><p>Автор технологии повышения квалификации специалистов экономического профиля.</p><p>Опыт преподавательской работы около 20 лет в учебных центрах и ВУЗах Киева. Опыт работы главным бухгалтером, финансовым директором. Большой опыт внедрения программ системы Виндовз 3:11.</p>', '<h2>Hello!</h2>', '/profile/index/2/', 'teacher2@gmail.com', '/067/56-569-56, /093/26-45-65', 'teacher2', '', '', '/css/images/teacherImage.png', '10', '10', '10', 'Програмування ПХП;\r\nJava для IOS;', '39', '', 'teacher2.jpg');
INSERT INTO `teacher` VALUES ('3', 'UA', 'Любовь', 'Анатольевна', 'Ктоятакая-Замухриншская', '/css/images/teacher3.jpg', 'Бухгалтер с «О» и до первой отсидки; Программирование своего позитивного прошлого', '', '<p>Практикующий главный бухгалтер. Учредитель ПП <span>«Логика тут безсильна»</span>;</p>\r\n<p>Образование высшее - ДонГУ (1987г.)</p>\r\n<p>Опыт работы 27 лет, в т. ч. преподавания - 9 лет.</p>\r\n<ul><li>специалист по позитивной энергетике;</li><li>эксперт по эффективному ремонту баянов;</li><li>мастер психотерапии для сложных бабушек и дедушек;</li></ul>', '', '/profile/index/3/', 'teacher3@gmail.com', '/067/56-569-56, /093/26-45-65', 'teacher3', '', '', '/css/images/teacherImage.png', '11', '11', '11', 'Програмування ПХП;\r\nJava для IOS;', '40', '', 'teacher3.jpg');
INSERT INTO `teacher` VALUES ('4', 'UA', 'Василий', 'Васильевич', 'Меняетпроффесию', '/css/images/teacher4.jpg', 'программування БДСМ; программування на Php для пострадавших в ЧАЭС; GlobalLoqic, Samsung, Coqniance', '', '<p>Консультант по вопросам бухгалтерского и налогового учета, отчетности для предприятий разной формы собственности. Преподаватель с многолетним стажем работы. <span>Реально шарит в компьютерах.</span></p><p>Автор технологии повышения квалификации специалистов экономического профиля.</p><p>Опыт преподавательской работы около 20 лет в учебных центрах и ВУЗах Киева. Опыт работы главным бухгалтером, финансовым директором. Большой опыт внедрения программ системы Виндовз 3:11.</p>', '', '/profile/index/4/', 'teacher4@gmail.com', '/067/56-569-56, /093/26-45-65', 'teacher4', '', '', '/css/images/teacherImage.png', '9', '9', '9', 'Програмування ПХП;\r\nJava для IOS;', '41', '', 'teacher4.jpg');
INSERT INTO `teacher` VALUES ('5', 'UA', 'Ия', 'Тожевна', 'Воваяготова', '/css/images/teacher5.jpg', 'программування БДСМ; программування на Php для пострадавших в ЧАЭС; GlobalLoqic, Samsung, Coqniance', '', '<p>Консультант по вопросам бухгалтерского и налогового учета, отчетности для предприятий разной формы собственности. Преподаватель с многолетним стажем работы. <span>Реально шарит в компьютерах.</span></p><p>Автор технологии повышения квалификации специалистов экономического профиля.</p><p>Опыт преподавательской работы около 20 лет в учебных центрах и ВУЗах Киева. Опыт работы главным бухгалтером, финансовым директором. Большой опыт внедрения программ системы Виндовз 3:11.</p>', '', '/profile/index/5/', 'teacher5@gmail.com', '/067/56-569-56, /093/26-45-65', 'teacher5', '', '', '/css/images/teacherImage.png', '10', '10', '10', 'Програмування ПХП;\r\nJava для IOS;', '42', '', 'teacher1image.png');
INSERT INTO `teacher` VALUES ('6', 'UA', 'Петросян', 'Петросянович', 'Забугорный', '/css/images/teacher6.jpg', 'программування БДСМ; программування на Php для пострадавших в ЧАЭС; GlobalLoqic, Samsung, Coqniance', '<p>hello!</p>', '<p>Консультант по вопросам бухгалтерского и налогового учета, отчетности для предприятий разной формы собственности. Преподаватель с многолетним стажем работы. <span>Реально шарит в компьютерах.</span></p><p>Автор технологии повышения квалификации специалистов экономического профиля.</p><p>Опыт преподавательской работы около 20 лет в учебных центрах и ВУЗах Киева. Опыт работы главным бухгалтером, финансовым директором. Большой опыт внедрения программ системы Виндовз 3:11.</p>', '<h3>hello2!</h3>', '/profile/index/6/', 'teacher6@gmail.com', '/067/56-569-56, /093/26-45-65', 'teacher6', '', '', '/css/images/teacherImage.png', '11', '11', '11', 'Програмування ПХП;\r\nJava для IOS;', '43', '', 'teacher6.jpg');

-- ----------------------------
-- Table structure for `teacher_module`
-- ----------------------------
DROP TABLE IF EXISTS `teacher_module`;
CREATE TABLE `teacher_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTeacher` int(11) NOT NULL,
  `idModule` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_teacher_module_teacher` (`idTeacher`),
  KEY `FK_teacher_module_module` (`idModule`),
  CONSTRAINT `FK_teacher_module_module` FOREIGN KEY (`idModule`) REFERENCES `module` (`module_ID`),
  CONSTRAINT `FK_teacher_module_teacher` FOREIGN KEY (`idTeacher`) REFERENCES `teacher` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teacher_module
-- ----------------------------
INSERT INTO `teacher_module` VALUES ('1', '1', '1');
INSERT INTO `teacher_module` VALUES ('2', '2', '1');
INSERT INTO `teacher_module` VALUES ('3', '3', '1');
INSERT INTO `teacher_module` VALUES ('5', '4', '1');
INSERT INTO `teacher_module` VALUES ('6', '3', '2');
INSERT INTO `teacher_module` VALUES ('7', '4', '2');
INSERT INTO `teacher_module` VALUES ('8', '1', '3');
INSERT INTO `teacher_module` VALUES ('9', '4', '3');
INSERT INTO `teacher_module` VALUES ('10', '5', '3');
INSERT INTO `teacher_module` VALUES ('11', '4', '4');
INSERT INTO `teacher_module` VALUES ('12', '1', '7');
INSERT INTO `teacher_module` VALUES ('13', '2', '7');
INSERT INTO `teacher_module` VALUES ('14', '3', '9');
INSERT INTO `teacher_module` VALUES ('15', '4', '9');
INSERT INTO `teacher_module` VALUES ('17', '1', '10');
INSERT INTO `teacher_module` VALUES ('18', '4', '10');

-- ----------------------------
-- Table structure for `teacher_temp`
-- ----------------------------
DROP TABLE IF EXISTS `teacher_temp`;
CREATE TABLE `teacher_temp` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(6) NOT NULL,
  `first_name` varchar(35) NOT NULL,
  `middle_name` varchar(35) NOT NULL,
  `last_name` varchar(35) NOT NULL,
  `foto_url` varchar(100) NOT NULL,
  `subjects` varchar(100) NOT NULL,
  `profile_text_big` text NOT NULL,
  `profile_text` text NOT NULL,
  `readMoreLink` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(100) NOT NULL,
  `skype` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `linkName` varchar(50) NOT NULL,
  `smallImage` varchar(255) NOT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teacher_temp
-- ----------------------------
INSERT INTO `teacher_temp` VALUES ('1', 'UA', 'Олександра', 'Василівна', 'Сіра', '/css/images/teacher1.jpg', 'кройка и шитье сроков; програмування самоубийств', 'Народилася і виросла в Сакраменто, у 18 років вона переїхала до Лос-Анджелеса й незабаром стала вкладачем. У 2007, 2008 і 2010 рр.. вона виграла кілька номінацій премії AVN Awards (також була названа «Найкращою програмісткою» у 2007 році за версією XRCO). Паралельно з вікладауцью роботою та роботою програміста в Саша Грей грає головну роль в тестванні Інтернету.\r\n\r\nМарина Енн Генціс народилася у родині механіка. Її батько мав грецьке походження. Батьки дівчинки розлучилися коли їй було 5 років, надалі її виховувала мати, яка вступила в повторний шлюб у 2000 роц. Марина не ладнала з вітчимом, і, коли їй виповнилося 16 років, дівчина повідомила матері, що збирається покинути будинок. Достеменно невідомо, втекла вона з свого будинку або ж її відпустила мати. Сама Олександра пізніше зізнавалася, що в той час робила все те, що не подобалося її батькам і що вони їй забороняли.\r\n\r\nГлавный бухгалтер акционерного предприятия, специализирующегося на:\r\n\r\n    оказании полезных услуг горизонтального характера;\r\n    торговле, внешнеэкономической и внутреннеэкономической;\r\n    позитивное обучение швейного мастерства;\r\n\r\n Олександра Сіра виконала головну роль у фільмі оскароносного режисера Стівена Содерберга «Дівчина за викликом»[27][28]. Олександра грає дівчину на ім\'я Челсі, яка надає ескорт послуги заможним людям. Содерберг взяв її на роль після того, як прочитав статтю про неї у журналі Los Angeles, коментуючи це так: «She\'s kind of a new breed, I think. She doesn\'t really fit the typical mold of someone who goes into the adult film business. … I\'d never heard anybody talk about the business the way that she talked about it». Журналіст Скотт Маколей каже, що можливо Грей вибрала саме цю роль через свій інтерес до незалежних режисерів, таких як Жан-Люк Годар, Хармоні Корін, Девід Гордон Грін, Мікеланджело Антоніоні, Аньєс Варда та Вільям Клейн.\r\n\r\nКоли Олександра готувалася до ролі у «Дівчині за викликом», Содерберг попросив її подивитися «Жити своїм життям» і «Божевільний П\'єро»[29]. У фільмі «Жити своїм життям» піднімаються проблеми проституції, звідки Грей могла взяти щось і для своєї ролі, в той час як у «Божевільному П\'єро» показані відносини, схожі на ті, що відбуваються між Челсі, її хлопцем і клієнтами.\'; ', '<p>Профессиональный преподаватель бухгалтерского и налогового учета Национальноготранспортного университета кафедры финансов, учета и аудита со стажем преподавательской работы более 25 лет. Закончила аспирантуру, автор 36 научных работ в области учета и аудита, в т.ч. уникальной обучающей методики написания бухгалтерских проводок: <span>\"Как украсть и не сесть\" </span> и <span>\"Как украсть и посадить другого\" </span>.</p><p>Главный бухгалтер акционерного предприятия, специализирующегося на:<ul><li>оказании полезных услуг горизонтального характера;</li><li>торговле, внешнеэкономической и внутреннеэкономической;</li><li>позитивное обучение швейного мастерства;</li></ul></p>', '/profile', 'ivanov@intita.org, ivanov@gmail.com', '/067/56-569-56, /093/26-45-65', 'ivanov.ivanov', '', '', '/css/images/teacherImage.png');
INSERT INTO `teacher_temp` VALUES ('2', 'UA', 'Константин', 'Константинович', 'Константинопольский', '/css/images/teacher2.jpg', 'программування БДСМ; программування на Php для пострадавших в ЧАЭС; GlobalLoqic, Samsung, Coqniance', '', '<p>Консультант по вопросам бухгалтерского и налогового учета, отчетности для предприятий разной формы собственности. Преподаватель с многолетним стажем работы. <span>Реально шарит в компьютерах.</span></p><p>Автор технологии повышения квалификации специалистов экономического профиля.</p><p>Опыт преподавательской работы около 20 лет в учебных центрах и ВУЗах Киева. Опыт работы главным бухгалтером, финансовым директором. Большой опыт внедрения программ системы Виндовз 3:11.</p>', '/profile', 'ivanov@intita.org, ivanov@gmail.com', '/067/56-569-56, /093/26-45-65', 'ivanov.ivanov', '', '', '/css/images/teacherImage.png');
INSERT INTO `teacher_temp` VALUES ('3', 'UA', 'Любовь', 'Анатольевна', 'Ктоятакая-Замухриншская', '/css/images/teacher3.jpg', 'Бухгалтер с «О» и до первой отсидки; Программирование своего позитивного прошлого', '', '<p>Практикующий главный бухгалтер. Учредитель ПП <span>«Логика тут безсильна»</span>;</p>\r\n<p>Образование высшее - ДонГУ (1987г.)</p>\r\n<p>Опыт работы 27 лет, в т. ч. преподавания - 9 лет.</p>\r\n<ul><li>специалист по позитивной энергетике;</li><li>эксперт по эффективному ремонту баянов;</li><li>мастер психотерапии для сложных бабушек и дедушек;</li></ul>', '/profile', 'ivanov@intita.org, ivanov@gmail.com', '/067/56-569-56, /093/26-45-65', 'ivanov.ivanov', '', '', '/css/images/teacherImage.png');
INSERT INTO `teacher_temp` VALUES ('4', 'UA', 'Василий', 'Васильевич', 'Меняетпроффесию', '/css/images/teacher4.jpg', 'программування БДСМ; программування на Php для пострадавших в ЧАЭС; GlobalLoqic, Samsung, Coqniance', '', '<p>Консультант по вопросам бухгалтерского и налогового учета, отчетности для предприятий разной формы собственности. Преподаватель с многолетним стажем работы. <span>Реально шарит в компьютерах.</span></p><p>Автор технологии повышения квалификации специалистов экономического профиля.</p><p>Опыт преподавательской работы около 20 лет в учебных центрах и ВУЗах Киева. Опыт работы главным бухгалтером, финансовым директором. Большой опыт внедрения программ системы Виндовз 3:11.</p>', '/profile', 'ivanov@intita.org, ivanov@gmail.com', '/067/56-569-56, /093/26-45-65', 'ivanov.ivanov', '', '', '/css/images/teacherImage.png');
INSERT INTO `teacher_temp` VALUES ('5', 'UA', 'Ия', 'Тожевна', 'Воваяготова', '/css/images/teacher5.jpg', 'программування БДСМ; программування на Php для пострадавших в ЧАЭС; GlobalLoqic, Samsung, Coqniance', '', '<p>Консультант по вопросам бухгалтерского и налогового учета, отчетности для предприятий разной формы собственности. Преподаватель с многолетним стажем работы. <span>Реально шарит в компьютерах.</span></p><p>Автор технологии повышения квалификации специалистов экономического профиля.</p><p>Опыт преподавательской работы около 20 лет в учебных центрах и ВУЗах Киева. Опыт работы главным бухгалтером, финансовым директором. Большой опыт внедрения программ системы Виндовз 3:11.</p>', '/profile', 'ivanov@intita.org, ivanov@gmail.com', '/067/56-569-56, /093/26-45-65', 'ivanov.ivanov', '', '', '/css/images/teacherImage.png');
INSERT INTO `teacher_temp` VALUES ('6', 'UA', 'Петросян', 'Петросянович', 'Забугорный', '/css/images/teacher6.jpg', 'программування БДСМ; программування на Php для пострадавших в ЧАЭС; GlobalLoqic, Samsung, Coqniance', '', '<p>Консультант по вопросам бухгалтерского и налогового учета, отчетности для предприятий разной формы собственности. Преподаватель с многолетним стажем работы. <span>Реально шарит в компьютерах.</span></p><p>Автор технологии повышения квалификации специалистов экономического профиля.</p><p>Опыт преподавательской работы около 20 лет в учебных центрах и ВУЗах Киева. Опыт работы главным бухгалтером, финансовым директором. Большой опыт внедрения программ системы Виндовз 3:11.</p>', '/profile', 'ivanov@intita.org, ivanov@gmail.com', '/067/56-569-56, /093/26-45-65', 'ivanov.ivanov', '', '', '/css/images/teacherImage.png');

-- ----------------------------
-- Table structure for `translatedmessagesen`
-- ----------------------------
DROP TABLE IF EXISTS `translatedmessagesen`;
CREATE TABLE `translatedmessagesen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(16) NOT NULL,
  `translation` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of translatedmessagesen
-- ----------------------------
INSERT INTO `translatedmessagesen` VALUES ('1', 'en', 'INTITA');
INSERT INTO `translatedmessagesen` VALUES ('2', 'en', 'About Us');
INSERT INTO `translatedmessagesen` VALUES ('3', 'en', 'How to start studying?');
INSERT INTO `translatedmessagesen` VALUES ('4', 'en', 'more ...');
INSERT INTO `translatedmessagesen` VALUES ('5', 'en', 'PROGRAM THE FUTURE');
INSERT INTO `translatedmessagesen` VALUES ('6', 'en', 'Important information about studying with us');
INSERT INTO `translatedmessagesen` VALUES ('7', 'en', 'Five steps to implement your dreams');
INSERT INTO `translatedmessagesen` VALUES ('8', 'en', 'START />');
INSERT INTO `translatedmessagesen` VALUES ('9', 'en', 'Ready to get started?');
INSERT INTO `translatedmessagesen` VALUES ('10', 'en', 'Enter data into the form below');
INSERT INTO `translatedmessagesen` VALUES ('11', 'en', 'extended registration');
INSERT INTO `translatedmessagesen` VALUES ('12', 'en', 'You can also register by social networks:');
INSERT INTO `translatedmessagesen` VALUES ('13', 'en', 'START');
INSERT INTO `translatedmessagesen` VALUES ('14', 'en', 'Email');
INSERT INTO `translatedmessagesen` VALUES ('15', 'en', 'password');
INSERT INTO `translatedmessagesen` VALUES ('16', 'en', 'Courses');
INSERT INTO `translatedmessagesen` VALUES ('17', 'en', 'Forum');
INSERT INTO `translatedmessagesen` VALUES ('18', 'en', 'About Us');
INSERT INTO `translatedmessagesen` VALUES ('19', 'en', 'Enter');
INSERT INTO `translatedmessagesen` VALUES ('20', 'en', 'Exit');
INSERT INTO `translatedmessagesen` VALUES ('21', 'en', 'Teachers');
INSERT INTO `translatedmessagesen` VALUES ('22', 'en', 'Exit');
INSERT INTO `translatedmessagesen` VALUES ('23', 'en', 'phone: +38 0432 52 82 67');
INSERT INTO `translatedmessagesen` VALUES ('24', 'en', 'mobile: +38 067 432 50 20');
INSERT INTO `translatedmessagesen` VALUES ('25', 'en', 'e-mail: intita.hr@gmail.com');
INSERT INTO `translatedmessagesen` VALUES ('26', 'en', 'skype: int.ita');
INSERT INTO `translatedmessagesen` VALUES ('27', 'en', 'We guarantee you an offer of employment<br>\r\nafter successful completion of training!');
INSERT INTO `translatedmessagesen` VALUES ('28', 'en', 'Do not miss your chance to change the world - get high-quality and modern education<br>\r\nand become a specialist class!');
INSERT INTO `translatedmessagesen` VALUES ('29', 'en', 'One year of productive and interesting learning - and you will become a professional programmer<br>\r\nready work in the IT industry!');
INSERT INTO `translatedmessagesen` VALUES ('30', 'en', 'Do you want to become a high-class specialist?<br>\r\ntakes correct and informed decision - Learn with us!');
INSERT INTO `translatedmessagesen` VALUES ('31', 'en', 'Do not lose your chance for creative, interesting, and challenging decent work -<br>\r\nplan their professional future today!');
INSERT INTO `translatedmessagesen` VALUES ('32', 'en', 'What are you dreaming?');
INSERT INTO `translatedmessagesen` VALUES ('33', 'en', 'Future Studies');
INSERT INTO `translatedmessagesen` VALUES ('34', 'en', 'Important questions');
INSERT INTO `translatedmessagesen` VALUES ('35', 'en', 'Maybe this freedom to live their lives? Independently manage own time with opportunity to earn by doing things you love and get business and get meet the modern profession?');
INSERT INTO `translatedmessagesen` VALUES ('36', 'en', 'Unlike traditional schools, We do not teach for the sake of ratings. We work individually with each student to achieve 100% mastering the necessary knowledge.');
INSERT INTO `translatedmessagesen` VALUES ('37', 'en', 'We offer each of our graduate guaranteed receipt employment offers for 4-6 months after the successful completion of training.');
INSERT INTO `translatedmessagesen` VALUES ('38', 'en', 'Register Online');
INSERT INTO `translatedmessagesen` VALUES ('39', 'en', 'Choice of course or module');
INSERT INTO `translatedmessagesen` VALUES ('40', 'en', 'Payment for training');
INSERT INTO `translatedmessagesen` VALUES ('41', 'en', 'Mastering the material');
INSERT INTO `translatedmessagesen` VALUES ('42', 'en', 'Completion rate');
INSERT INTO `translatedmessagesen` VALUES ('43', 'en', 'step');
INSERT INTO `translatedmessagesen` VALUES ('44', 'en', 'To access the courses and pass free modules and classes register on the site. Registration will allow you to assess the quality and usability of our product that you will become a reliable partner and advisor in professional self-realization.');
INSERT INTO `translatedmessagesen` VALUES ('45', 'en', 'To become specialists in a certain direction and level (get professional specialization) choose to undergo appropriate course. If you are interested only deepen the knowledge in a particular area of ​​information technology, then choose the module to pass.\')');
INSERT INTO `translatedmessagesen` VALUES ('46', 'en', 'To start a course or module choose payment scheme (the entire amount for the course, payment modules, payment potrymestrovo, month, etc.) and make a payment convenient way to You (payment scheme or course module can be changed monthly as possible payment credit). ');
INSERT INTO `translatedmessagesen` VALUES ('47', 'en', 'The study material is possible by reading the text and / or viewing a video for each session. During the passage Intermediate classes perform tests. At the end of each session do the final test tasks. Each module ends with an individual project or exam. You can receive individual counseling teacher or advice online. ');
INSERT INTO `translatedmessagesen` VALUES ('48', 'en', 'The result of course is the command thesis project, performed together with other students (the team recommends that forms an independent or executive who approved topic and terms of reference of the project). Delivery Project peredzahyst and provides protection in the online mode with presentation design. After defending his diploma and recommendation for employment.');
INSERT INTO `translatedmessagesen` VALUES ('49', 'en', 'Home');
INSERT INTO `translatedmessagesen` VALUES ('50', 'en', 'Courses');
INSERT INTO `translatedmessagesen` VALUES ('51', 'en', 'About us');
INSERT INTO `translatedmessagesen` VALUES ('52', 'en', 'Teachers');
INSERT INTO `translatedmessagesen` VALUES ('53', 'en', 'Forum');
INSERT INTO `translatedmessagesen` VALUES ('54', 'en', 'Profile');
INSERT INTO `translatedmessagesen` VALUES ('55', 'en', 'Edit profile');
INSERT INTO `translatedmessagesen` VALUES ('56', 'en', 'Registration');
INSERT INTO `translatedmessagesen` VALUES ('57', 'en', 'Teacher profile');
INSERT INTO `translatedmessagesen` VALUES ('58', 'en', 'Our teachers');
INSERT INTO `translatedmessagesen` VALUES ('59', 'en', 'personal page');
INSERT INTO `translatedmessagesen` VALUES ('60', 'en', 'If you\'re a professional IT specialist and want to teach some courses or modules IT and cooperate with us in the field of training programmers write us a letter.');
INSERT INTO `translatedmessagesen` VALUES ('61', 'en', 'Conducts courses');
INSERT INTO `translatedmessagesen` VALUES ('62', 'en', 'Read more');
INSERT INTO `translatedmessagesen` VALUES ('63', 'en', 'Reviews');
INSERT INTO `translatedmessagesen` VALUES ('64', 'en', 'Section:');
INSERT INTO `translatedmessagesen` VALUES ('65', 'en', 'About the teacher:');
INSERT INTO `translatedmessagesen` VALUES ('66', 'en', 'Our courses');
INSERT INTO `translatedmessagesen` VALUES ('67', 'en', 'Training concept');
INSERT INTO `translatedmessagesen` VALUES ('68', 'en', 'Level: ');
INSERT INTO `translatedmessagesen` VALUES ('69', 'en', 'Language: ');
INSERT INTO `translatedmessagesen` VALUES ('70', 'en', 'Course:');
INSERT INTO `translatedmessagesen` VALUES ('71', 'en', 'lang:');
INSERT INTO `translatedmessagesen` VALUES ('72', 'en', 'Module:');
INSERT INTO `translatedmessagesen` VALUES ('73', 'en', 'Lecture:');
INSERT INTO `translatedmessagesen` VALUES ('74', 'en', 'Type:');
INSERT INTO `translatedmessagesen` VALUES ('75', 'en', 'Duration:');
INSERT INTO `translatedmessagesen` VALUES ('76', 'en', 'min');
INSERT INTO `translatedmessagesen` VALUES ('77', 'en', 'Teacher');
INSERT INTO `translatedmessagesen` VALUES ('78', 'en', 'more');
INSERT INTO `translatedmessagesen` VALUES ('79', 'en', 'Plan consultation');
INSERT INTO `translatedmessagesen` VALUES ('80', 'en', 'Content');
INSERT INTO `translatedmessagesen` VALUES ('81', 'en', 'show');
INSERT INTO `translatedmessagesen` VALUES ('82', 'en', 'hide');
INSERT INTO `translatedmessagesen` VALUES ('83', 'en', 'Videos');
INSERT INTO `translatedmessagesen` VALUES ('84', 'en', 'Sample code');
INSERT INTO `translatedmessagesen` VALUES ('85', 'en', 'User');
INSERT INTO `translatedmessagesen` VALUES ('86', 'en', 'Task');
INSERT INTO `translatedmessagesen` VALUES ('87', 'en', 'review the previous lesson');
INSERT INTO `translatedmessagesen` VALUES ('88', 'en', 'NEXT LECTURE');
INSERT INTO `translatedmessagesen` VALUES ('89', 'en', 'Reply');
INSERT INTO `translatedmessagesen` VALUES ('90', 'en', 'Final task');
INSERT INTO `translatedmessagesen` VALUES ('91', 'en', 'You can also enter by social networks:');
INSERT INTO `translatedmessagesen` VALUES ('92', 'en', 'Forget password?');
INSERT INTO `translatedmessagesen` VALUES ('93', 'en', 'SIGN IN');
INSERT INTO `translatedmessagesen` VALUES ('94', 'en', 'Status:');
INSERT INTO `translatedmessagesen` VALUES ('95', 'en', 'Student Profile');
INSERT INTO `translatedmessagesen` VALUES ('96', 'en', 'Edit </br> profile');
INSERT INTO `translatedmessagesen` VALUES ('97', 'en', ' years');
INSERT INTO `translatedmessagesen` VALUES ('98', 'en', ' year');
INSERT INTO `translatedmessagesen` VALUES ('99', 'en', ' years');
INSERT INTO `translatedmessagesen` VALUES ('100', 'en', 'About myself:');
INSERT INTO `translatedmessagesen` VALUES ('101', 'en', 'Email:');
INSERT INTO `translatedmessagesen` VALUES ('102', 'en', 'Phone:');
INSERT INTO `translatedmessagesen` VALUES ('103', 'en', 'Education:');
INSERT INTO `translatedmessagesen` VALUES ('104', 'en', 'Interests:');
INSERT INTO `translatedmessagesen` VALUES ('105', 'en', 'Where learned you:');
INSERT INTO `translatedmessagesen` VALUES ('106', 'en', 'Learning:');
INSERT INTO `translatedmessagesen` VALUES ('107', 'en', 'Completion of the course:');
INSERT INTO `translatedmessagesen` VALUES ('108', 'en', 'My courses');
INSERT INTO `translatedmessagesen` VALUES ('109', 'en', 'Timetable');
INSERT INTO `translatedmessagesen` VALUES ('110', 'en', 'Consultation');
INSERT INTO `translatedmessagesen` VALUES ('111', 'en', 'Exams');
INSERT INTO `translatedmessagesen` VALUES ('112', 'en', 'Projects');
INSERT INTO `translatedmessagesen` VALUES ('113', 'en', 'My rating');
INSERT INTO `translatedmessagesen` VALUES ('114', 'en', 'Downloads');
INSERT INTO `translatedmessagesen` VALUES ('115', 'en', 'Correspondence');
INSERT INTO `translatedmessagesen` VALUES ('116', 'en', 'My assessment');
INSERT INTO `translatedmessagesen` VALUES ('117', 'en', 'Finances');
INSERT INTO `translatedmessagesen` VALUES ('118', 'en', 'Current course:');
INSERT INTO `translatedmessagesen` VALUES ('119', 'en', 'Unfinished course:');
INSERT INTO `translatedmessagesen` VALUES ('120', 'en', 'Completed course:');
INSERT INTO `translatedmessagesen` VALUES ('121', 'en', 'Please make the following payments to');
INSERT INTO `translatedmessagesen` VALUES ('122', 'en', 'Amount of payment:');
INSERT INTO `translatedmessagesen` VALUES ('123', 'en', ' UAH');
INSERT INTO `translatedmessagesen` VALUES ('124', 'en', 'Individual modular project');
INSERT INTO `translatedmessagesen` VALUES ('125', 'en', 'Team thesis project');
INSERT INTO `translatedmessagesen` VALUES ('126', 'en', 'Type');
INSERT INTO `translatedmessagesen` VALUES ('127', 'en', 'Date');
INSERT INTO `translatedmessagesen` VALUES ('128', 'en', 'Time');
INSERT INTO `translatedmessagesen` VALUES ('129', 'en', 'Teacher');
INSERT INTO `translatedmessagesen` VALUES ('130', 'en', 'Theme');
INSERT INTO `translatedmessagesen` VALUES ('131', 'en', 'E');
INSERT INTO `translatedmessagesen` VALUES ('132', 'en', 'C');
INSERT INTO `translatedmessagesen` VALUES ('133', 'en', 'IMP');
INSERT INTO `translatedmessagesen` VALUES ('134', 'en', 'TTP');
INSERT INTO `translatedmessagesen` VALUES ('135', 'en', ' strong junior');
INSERT INTO `translatedmessagesen` VALUES ('136', 'en', ' ukrainian');
INSERT INTO `translatedmessagesen` VALUES ('137', 'en', 'Graduates');
INSERT INTO `translatedmessagesen` VALUES ('138', 'en', 'Sorry, you couldn\\\'t view this lecture.Please login for getting access to this material.');
INSERT INTO `translatedmessagesen` VALUES ('139', 'en', 'Sorry, you couldn\\\'t view this lecture.\r\nYou don\\\'t have access to this lecture.\r\nPlease go to your profile and pay access.');
INSERT INTO `translatedmessagesen` VALUES ('140', 'en', 'For beginners');
INSERT INTO `translatedmessagesen` VALUES ('141', 'en', 'For specialists');
INSERT INTO `translatedmessagesen` VALUES ('142', 'en', 'For experts');
INSERT INTO `translatedmessagesen` VALUES ('143', 'en', 'All courses');
INSERT INTO `translatedmessagesen` VALUES ('144', 'en', 'discount');
INSERT INTO `translatedmessagesen` VALUES ('145', 'en', 'Сourse rate:');
INSERT INTO `translatedmessagesen` VALUES ('146', 'en', 'details ...');
INSERT INTO `translatedmessagesen` VALUES ('147', 'en', 'Course price:');
INSERT INTO `translatedmessagesen` VALUES ('148', 'en', 'Firstly training creates a stable foundation for training programmers: requires knowledge of elementary mathematics, the structure of computer and computer science.');
INSERT INTO `translatedmessagesen` VALUES ('149', 'en', '<P>Then we study the basic principles of programming based on classic PC & raquo; Books sciences and methodologies algorithmic language, elements of higher and discrete mathematics and combinatorics; data structures, design and analysis of algorithms.\r\n<P> After that formed the basis for the transition to modern programming technologies: object-oriented programming; database design.\r\n<P> Completion of training by the specific application of knowledge to real projects with the assimilation of modern techniques and technologies used in the IT industry companies.');
INSERT INTO `translatedmessagesen` VALUES ('150', 'en', '');

-- ----------------------------
-- Table structure for `translatedmessagesru`
-- ----------------------------
DROP TABLE IF EXISTS `translatedmessagesru`;
CREATE TABLE `translatedmessagesru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(16) NOT NULL,
  `translation` text NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_translatedMessagesRU_sourcemessages` FOREIGN KEY (`id`) REFERENCES `sourcemessages` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of translatedmessagesru
-- ----------------------------
INSERT INTO `translatedmessagesru` VALUES ('1', 'ru', 'INTITA');
INSERT INTO `translatedmessagesru` VALUES ('2', 'ru', 'О нас');
INSERT INTO `translatedmessagesru` VALUES ('3', 'ru', 'Как проходит обучение?');
INSERT INTO `translatedmessagesru` VALUES ('4', 'ru', 'далее ...');
INSERT INTO `translatedmessagesru` VALUES ('5', 'ru', 'ПРОГРАММИРУЙ БУДУЩЕЕ');
INSERT INTO `translatedmessagesru` VALUES ('6', 'ru', 'Важная информация про обучение вместе с нами');
INSERT INTO `translatedmessagesru` VALUES ('7', 'ru', 'Пять шагов к исполнения твоих желаний');
INSERT INTO `translatedmessagesru` VALUES ('8', 'ru', 'СТАРТ  />');
INSERT INTO `translatedmessagesru` VALUES ('9', 'ru', 'Готовы начать?');
INSERT INTO `translatedmessagesru` VALUES ('10', 'ru', 'Введите данные в форму ниже');
INSERT INTO `translatedmessagesru` VALUES ('11', 'ru', 'расширенная регистрация');
INSERT INTO `translatedmessagesru` VALUES ('12', 'ru', 'Вы также можете зарегистрироваться с помощью соцсетей:');
INSERT INTO `translatedmessagesru` VALUES ('13', 'ru', 'НАЧАТЬ');
INSERT INTO `translatedmessagesru` VALUES ('14', 'ru', 'Электронная почта');
INSERT INTO `translatedmessagesru` VALUES ('15', 'ru', 'Пароль');
INSERT INTO `translatedmessagesru` VALUES ('16', 'ru', 'Курсы');
INSERT INTO `translatedmessagesru` VALUES ('17', 'ru', 'Форум');
INSERT INTO `translatedmessagesru` VALUES ('18', 'ru', 'О нас');
INSERT INTO `translatedmessagesru` VALUES ('19', 'ru', 'Вход');
INSERT INTO `translatedmessagesru` VALUES ('20', 'ru', 'Выход');
INSERT INTO `translatedmessagesru` VALUES ('21', 'ru', 'Преподаватели');
INSERT INTO `translatedmessagesru` VALUES ('22', 'ru', 'Выход');
INSERT INTO `translatedmessagesru` VALUES ('23', 'ru', 'телефон: +38 0432 52 82 67 ');
INSERT INTO `translatedmessagesru` VALUES ('24', 'ru', 'тел. моб. +38 067 432 20 10');
INSERT INTO `translatedmessagesru` VALUES ('25', 'ru', 'e-mail: intita.hr@gmail.com');
INSERT INTO `translatedmessagesru` VALUES ('26', 'ru', 'скайп: int.ita');
INSERT INTO `translatedmessagesru` VALUES ('27', 'ru', 'Мы гарантируем получение предложения работы<br>\r\nпосле успешного завершения обучения!');
INSERT INTO `translatedmessagesru` VALUES ('28', 'ru', 'Хочешь стать классным специалистом?<br>\r\nпринимай правильное решение - поступай в IТ Академию  ИНТИТА!');
INSERT INTO `translatedmessagesru` VALUES ('29', 'ru', 'Один год упорного и интересного обучения - и ты станешь проессиональным программистом.<br>\r\nУчиться тяжело -зато легко найти работу!');
INSERT INTO `translatedmessagesru` VALUES ('30', 'ru', 'Не упускай свой шанс на достойную и интересную работу - <br>\r\nпрограммируй свое будущее уже сегодня!');
INSERT INTO `translatedmessagesru` VALUES ('31', 'ru', 'Текст на пятой картинке слайдера');
INSERT INTO `translatedmessagesru` VALUES ('32', 'ru', 'О чем ты мечтаешь?');
INSERT INTO `translatedmessagesru` VALUES ('33', 'ru', 'Обучение будущего');
INSERT INTO `translatedmessagesru` VALUES ('34', 'ru', 'Вопросы');
INSERT INTO `translatedmessagesru` VALUES ('35', 'ru', 'Может, это возможность жить своей жизнью? Самостоятельно распоряжаться своим временем с возможностью зарабатывать, занимаясь любимым делом и получать удовольстие от современной профессии?');
INSERT INTO `translatedmessagesru` VALUES ('36', 'ru', 'В отличие от традиционных заведений, мы не учим ради оценок. Мы индивидуально работаем с каждым студентом, чтобы достичь 100% усвоения необходимых знаний.');
INSERT INTO `translatedmessagesru` VALUES ('37', 'ru', 'Мы предлагаем каждому выпускнику гарантированное получение предложения работы в течении 4-6-ти месяцев после успешного завершения обучения.');
INSERT INTO `translatedmessagesru` VALUES ('38', 'ru', 'Регистрация на сайте');
INSERT INTO `translatedmessagesru` VALUES ('39', 'ru', 'Выбор курса или модуля');
INSERT INTO `translatedmessagesru` VALUES ('40', 'ru', 'Оплата');
INSERT INTO `translatedmessagesru` VALUES ('41', 'ru', 'Изучение материала');
INSERT INTO `translatedmessagesru` VALUES ('42', 'ru', 'Завершение курса');
INSERT INTO `translatedmessagesru` VALUES ('43', 'ru', 'шаг');
INSERT INTO `translatedmessagesru` VALUES ('44', 'ru', 'Чтобы получить доступ к курсам и пройти бесплатные модули и занятия зарегистрируйся на сайте. Регистрация позволит тебе оценить качество и удобство нашего продукт , который станет для тебя надежным партнером и советчиком в профессиональной самореализации.');
INSERT INTO `translatedmessagesru` VALUES ('45', 'ru', 'Чтобы стать специалистом определенного направления и уровня ( получить профессиональную специализацию ) выбери для прохождения соответствующий курс . Если Тебя интересует исключительно углубления знаний в определенном направлении информационных технологий , то выбери соответствующий модуль для прохождения .');
INSERT INTO `translatedmessagesru` VALUES ('46', 'ru', 'Чтобы начать прохождении курса модуля выбери схему оплаты ( вся сумма за курс , оплата модулей , оплата потриместрово , помесячно и т.д.) и исполни оплату удобным Тебе способом ( схему оплаты курса или модуля можно изменять , также возможна помесячная оплата в кредит ) .');
INSERT INTO `translatedmessagesru` VALUES ('47', 'ru', 'Вивчення матеріалу можливе шляхом читання тексту чи/і перегляду відео для кожного заняття. Під час проходження заняття виконуй Проміжні тестові завдання. По завершенню кожного заняття виконуй Підсумкове тестове завдання. Кожен модуль завершується Індивідуальним проектом чи Екзаменом. 	Можна отримати індивідуальну консультацію викладача чи консультацію онлайн.');
INSERT INTO `translatedmessagesru` VALUES ('48', 'ru', 'Підсумком курсу є Командний дипломний проект, який виконується разом з іншими студентами (склад команди формуєш самостійно чи рекомендує керівник, який затверджує тему і технічне завдання проекту). Здача проекту передбачає передзахист та захист в он-лайн режимі із представленням технічної документації. Після захисту видається диплом та рекомендація для працевлаштування.');
INSERT INTO `translatedmessagesru` VALUES ('49', 'ru', 'Главная');
INSERT INTO `translatedmessagesru` VALUES ('50', 'ru', 'Курсы');
INSERT INTO `translatedmessagesru` VALUES ('51', 'ru', 'О нас');
INSERT INTO `translatedmessagesru` VALUES ('52', 'ru', 'Преподаватели');
INSERT INTO `translatedmessagesru` VALUES ('53', 'ru', 'Форум');
INSERT INTO `translatedmessagesru` VALUES ('54', 'ru', 'Профиль');
INSERT INTO `translatedmessagesru` VALUES ('55', 'ru', 'Редактировать профиль');
INSERT INTO `translatedmessagesru` VALUES ('56', 'ru', 'Регистрация');
INSERT INTO `translatedmessagesru` VALUES ('57', 'ru', 'Профиль преподавателя');
INSERT INTO `translatedmessagesru` VALUES ('58', 'ru', 'Наши преподаватели');
INSERT INTO `translatedmessagesru` VALUES ('59', 'ru', 'персональная страница');
INSERT INTO `translatedmessagesru` VALUES ('60', 'ru', 'Если Вы профессиональный ІТ-шник и хотите преподавать некоторые ІТ курсы и сотрудничать с нами в подготовке программистов, напишите нам письмо.');
INSERT INTO `translatedmessagesru` VALUES ('61', 'ru', 'Ведет курсы:');
INSERT INTO `translatedmessagesru` VALUES ('62', 'ru', 'Читать полностью');
INSERT INTO `translatedmessagesru` VALUES ('63', 'ru', 'Отзывы');
INSERT INTO `translatedmessagesru` VALUES ('64', 'ru', 'Раздел:');
INSERT INTO `translatedmessagesru` VALUES ('65', 'ru', 'О преподавателе:');
INSERT INTO `translatedmessagesru` VALUES ('66', 'ru', 'Наши курсы');
INSERT INTO `translatedmessagesru` VALUES ('67', 'ru', 'Концепция подготовки');
INSERT INTO `translatedmessagesru` VALUES ('68', 'ru', 'Уровень курса:');
INSERT INTO `translatedmessagesru` VALUES ('69', 'ru', 'Язык курса:');
INSERT INTO `translatedmessagesru` VALUES ('70', 'ru', 'Курс:');
INSERT INTO `translatedmessagesru` VALUES ('71', 'ru', 'язык:');
INSERT INTO `translatedmessagesru` VALUES ('72', 'ru', 'Модуль:');
INSERT INTO `translatedmessagesru` VALUES ('73', 'ru', 'Занятие:');
INSERT INTO `translatedmessagesru` VALUES ('74', 'ru', 'Тип:');
INSERT INTO `translatedmessagesru` VALUES ('75', 'ru', 'Время:');
INSERT INTO `translatedmessagesru` VALUES ('76', 'ru', 'мин');
INSERT INTO `translatedmessagesru` VALUES ('77', 'ru', 'Преподаватель');
INSERT INTO `translatedmessagesru` VALUES ('78', 'ru', 'детальнее');
INSERT INTO `translatedmessagesru` VALUES ('79', 'ru', 'Запланировать консультацию');
INSERT INTO `translatedmessagesru` VALUES ('80', 'ru', 'Содержание');
INSERT INTO `translatedmessagesru` VALUES ('81', 'ru', 'показать');
INSERT INTO `translatedmessagesru` VALUES ('82', 'ru', 'скрыть');
INSERT INTO `translatedmessagesru` VALUES ('83', 'ru', 'Видео');
INSERT INTO `translatedmessagesru` VALUES ('84', 'ru', 'Пример кода');
INSERT INTO `translatedmessagesru` VALUES ('85', 'ru', 'Инструкция');
INSERT INTO `translatedmessagesru` VALUES ('86', 'ru', 'Задание');
INSERT INTO `translatedmessagesru` VALUES ('87', 'ru', 'просмотреть снова предыдущий урок');
INSERT INTO `translatedmessagesru` VALUES ('88', 'ru', 'НАСТУПНИЙ УРОК');
INSERT INTO `translatedmessagesru` VALUES ('89', 'ru', 'Ответить');
INSERT INTO `translatedmessagesru` VALUES ('90', 'ru', 'Итоговое задание');
INSERT INTO `translatedmessagesru` VALUES ('91', 'ru', 'Вы также можете ввойти с помощью соцсетей:');
INSERT INTO `translatedmessagesru` VALUES ('92', 'ru', 'Забыли пароль?');
INSERT INTO `translatedmessagesru` VALUES ('93', 'ru', 'ВОЙТИ');
INSERT INTO `translatedmessagesru` VALUES ('94', 'ru', 'Статус курса: ');
INSERT INTO `translatedmessagesru` VALUES ('95', 'ru', 'Профиль студента');
INSERT INTO `translatedmessagesru` VALUES ('96', 'ru', 'Редактировать </br> профиль');
INSERT INTO `translatedmessagesru` VALUES ('97', 'ru', ' лет');
INSERT INTO `translatedmessagesru` VALUES ('98', 'ru', ' год');
INSERT INTO `translatedmessagesru` VALUES ('99', 'ru', ' года');
INSERT INTO `translatedmessagesru` VALUES ('100', 'ru', 'Про себя:');
INSERT INTO `translatedmessagesru` VALUES ('101', 'ru', 'Электронная почта:');
INSERT INTO `translatedmessagesru` VALUES ('102', 'ru', 'Телефон:');
INSERT INTO `translatedmessagesru` VALUES ('103', 'ru', 'Образование:');
INSERT INTO `translatedmessagesru` VALUES ('104', 'ru', 'Интересы:');
INSERT INTO `translatedmessagesru` VALUES ('105', 'ru', 'Откуда узнал о Вас:');
INSERT INTO `translatedmessagesru` VALUES ('106', 'ru', 'Форма обучения:');
INSERT INTO `translatedmessagesru` VALUES ('107', 'ru', 'Завершенные курсы:');
INSERT INTO `translatedmessagesru` VALUES ('108', 'ru', 'Мои курсы');
INSERT INTO `translatedmessagesru` VALUES ('109', 'ru', 'Расписание');
INSERT INTO `translatedmessagesru` VALUES ('110', 'ru', 'Консультации');
INSERT INTO `translatedmessagesru` VALUES ('111', 'ru', 'Экзамены');
INSERT INTO `translatedmessagesru` VALUES ('112', 'ru', 'Проекты');
INSERT INTO `translatedmessagesru` VALUES ('113', 'ru', 'Мой рейтинг');
INSERT INTO `translatedmessagesru` VALUES ('114', 'ru', 'Загрузки');
INSERT INTO `translatedmessagesru` VALUES ('115', 'ru', 'Переписка');
INSERT INTO `translatedmessagesru` VALUES ('116', 'ru', 'Мои оценки');
INSERT INTO `translatedmessagesru` VALUES ('117', 'ru', 'Финансы');
INSERT INTO `translatedmessagesru` VALUES ('118', 'ru', 'Текущий курс:');
INSERT INTO `translatedmessagesru` VALUES ('119', 'ru', 'Незавершенный курс:');
INSERT INTO `translatedmessagesru` VALUES ('120', 'ru', 'Завершен курс:');
INSERT INTO `translatedmessagesru` VALUES ('121', 'ru', 'Необходимо осуществить следующую проплату до');
INSERT INTO `translatedmessagesru` VALUES ('122', 'ru', 'Сумма оплаты:');
INSERT INTO `translatedmessagesru` VALUES ('123', 'ru', ' грн');
INSERT INTO `translatedmessagesru` VALUES ('124', 'ru', 'Индивидуальный модульный проект');
INSERT INTO `translatedmessagesru` VALUES ('125', 'ru', 'Командный дипломный проект');
INSERT INTO `translatedmessagesru` VALUES ('126', 'ru', 'Тип');
INSERT INTO `translatedmessagesru` VALUES ('127', 'ru', 'Дата');
INSERT INTO `translatedmessagesru` VALUES ('128', 'ru', 'Время');
INSERT INTO `translatedmessagesru` VALUES ('129', 'ru', 'Преподаватель');
INSERT INTO `translatedmessagesru` VALUES ('130', 'ru', 'Тема');
INSERT INTO `translatedmessagesru` VALUES ('131', 'ru', 'Э');
INSERT INTO `translatedmessagesru` VALUES ('132', 'ru', 'К');
INSERT INTO `translatedmessagesru` VALUES ('133', 'ru', 'ИМП');
INSERT INTO `translatedmessagesru` VALUES ('134', 'ru', 'КДП');
INSERT INTO `translatedmessagesru` VALUES ('135', 'ru', ' начинающий сильный');
INSERT INTO `translatedmessagesru` VALUES ('136', 'ru', ' украинский');
INSERT INTO `translatedmessagesru` VALUES ('137', 'ru', 'Выпускники');
INSERT INTO `translatedmessagesru` VALUES ('138', 'ru', 'Извините, Вы не можете просматривать эту лекцию. Пожалуйста, зарестрируйтесь для доступа к этой лекции.');
INSERT INTO `translatedmessagesru` VALUES ('139', 'ru', 'Извините, Вы не можете просматривать эту лекцию. Вы не имеете доступа к этой лекции. Пожалуйста, зайдите в свой аккаунт и оплатите доступ.');
INSERT INTO `translatedmessagesru` VALUES ('140', 'ru', 'Для начинающих');
INSERT INTO `translatedmessagesru` VALUES ('141', 'ru', 'Для специалистов');
INSERT INTO `translatedmessagesru` VALUES ('142', 'ru', 'Для экспертов');
INSERT INTO `translatedmessagesru` VALUES ('143', 'ru', 'Все курсы');
INSERT INTO `translatedmessagesru` VALUES ('144', 'ru', 'скидка');
INSERT INTO `translatedmessagesru` VALUES ('145', 'ru', 'Оценка курса:');
INSERT INTO `translatedmessagesru` VALUES ('146', 'ru', 'детальнее ...');
INSERT INTO `translatedmessagesru` VALUES ('147', 'ru', 'Стоимость курса:');
INSERT INTO `translatedmessagesru` VALUES ('148', 'ru', 'В начале обучения формируется стойкий фундамент для подготовки программистов: необходимые знания элементарной математики, устройства компьютера и основ информатики.');
INSERT INTO `translatedmessagesru` VALUES ('149', 'ru', '<p>Потом изучаются основные принципы программирования на базе классических компьютерних наук и методологий: алгоритмический язык; элементы высшей и дискретной математики, комбинаторики; структуры данных, разработка и анализ алгоритмов.\r\n<P> После чего формируется база для перехода к современным технологиям программирования: объектно-ориентированное программирование; проектирования баз данных.\r\n<P> Завершением процесса подготовки есть конкретное применение полученных знаний на реальных проектах с усвоением современных методов и технологий, используемых в ИТ индустрии компаниями.');
INSERT INTO `translatedmessagesru` VALUES ('150', 'ru', '');

-- ----------------------------
-- Table structure for `translatedmessagesua`
-- ----------------------------
DROP TABLE IF EXISTS `translatedmessagesua`;
CREATE TABLE `translatedmessagesua` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(16) NOT NULL,
  `translation` text NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_translatedmessages_sourcemessages` FOREIGN KEY (`id`) REFERENCES `sourcemessages` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8 COMMENT='Table for translation interface messages (see sourceMessages). UA';

-- ----------------------------
-- Records of translatedmessagesua
-- ----------------------------
INSERT INTO `translatedmessagesua` VALUES ('1', 'ua', 'INTITA');
INSERT INTO `translatedmessagesua` VALUES ('2', 'ua', 'Про нас');
INSERT INTO `translatedmessagesua` VALUES ('3', 'ua', 'Як розпочати навчання?');
INSERT INTO `translatedmessagesua` VALUES ('4', 'ua', 'детальніше ...');
INSERT INTO `translatedmessagesua` VALUES ('5', 'ua', 'ПРОГРАМУЙ МАЙБУТНЄ');
INSERT INTO `translatedmessagesua` VALUES ('6', 'ua', 'Важлива інформація про навчання разом з нами');
INSERT INTO `translatedmessagesua` VALUES ('7', 'ua', 'П’ять кроків до здійснення твоїх мрій');
INSERT INTO `translatedmessagesua` VALUES ('8', 'ua', 'ПОЧАТИ  />');
INSERT INTO `translatedmessagesua` VALUES ('9', 'ua', 'Готові розпочати?');
INSERT INTO `translatedmessagesua` VALUES ('10', 'ua', 'Введіть дані в форму нижче');
INSERT INTO `translatedmessagesua` VALUES ('11', 'ua', 'розширена реєстрація');
INSERT INTO `translatedmessagesua` VALUES ('12', 'ua', 'Ви можете також зареєструватися через соцмережі:');
INSERT INTO `translatedmessagesua` VALUES ('13', 'ua', 'ПОЧАТИ');
INSERT INTO `translatedmessagesua` VALUES ('14', 'ua', 'Електронна пошта');
INSERT INTO `translatedmessagesua` VALUES ('15', 'ua', 'Пароль');
INSERT INTO `translatedmessagesua` VALUES ('16', 'ua', 'Курси');
INSERT INTO `translatedmessagesua` VALUES ('17', 'ua', 'Форум');
INSERT INTO `translatedmessagesua` VALUES ('18', 'ua', 'Про нас');
INSERT INTO `translatedmessagesua` VALUES ('19', 'ua', 'Вхід');
INSERT INTO `translatedmessagesua` VALUES ('20', 'ua', 'Вихід');
INSERT INTO `translatedmessagesua` VALUES ('21', 'ua', 'Викладачі');
INSERT INTO `translatedmessagesua` VALUES ('22', 'ua', 'Вихід');
INSERT INTO `translatedmessagesua` VALUES ('23', 'ua', 'телефон: +38 0432 52 82 67 ');
INSERT INTO `translatedmessagesua` VALUES ('24', 'ua', 'тел. моб. +38 067 432 20 10');
INSERT INTO `translatedmessagesua` VALUES ('25', 'ua', 'e-mail: intita.hr@gmail.com');
INSERT INTO `translatedmessagesua` VALUES ('26', 'ua', 'скайп: int.ita');
INSERT INTO `translatedmessagesua` VALUES ('27', 'ua', 'Ми гарантуємо тобі отримання пропозиції працевлаштування<br>\r\nпісля успішного завершення навчання!');
INSERT INTO `translatedmessagesua` VALUES ('28', 'ua', 'Не упусти свій шанс змінити світ - отримай якісну та сучасну освіту<br>\r\nі стань класним спеціалістом!');
INSERT INTO `translatedmessagesua` VALUES ('29', 'ua', 'Один рік наполегливого та цікавого навчання - і ти станеш професійним програмістом<br>\r\nготовим працювати в індустрії інформаційних технологій!\r\n');
INSERT INTO `translatedmessagesua` VALUES ('30', 'ua', 'Хочеш стати висококласним спеціалістом?<br>\r\nПриймай вірне і виважене рішення - навчайся разом з нами! \r\n');
INSERT INTO `translatedmessagesua` VALUES ('31', 'ua', 'Не втрачай свій шанс на творчу, цікаву, гідну та перспективну працю –<br>\r\n плануй своє професійне майбутнє вже сьогодні!');
INSERT INTO `translatedmessagesua` VALUES ('32', 'ua', 'Про що мрієш ти?');
INSERT INTO `translatedmessagesua` VALUES ('33', 'ua', 'Навчання майбутнього');
INSERT INTO `translatedmessagesua` VALUES ('34', 'ua', 'Важливі питання');
INSERT INTO `translatedmessagesua` VALUES ('35', 'ua', 'Можливо, це свобода жити своїм життям? \r\nСамостійно керувати власним часом\r\nз можливістю заробляти, займаючись \r\nулюбленою справою і отримувати \r\nзадоволення від сучасної професії?');
INSERT INTO `translatedmessagesua` VALUES ('36', 'ua', 'На відміну від традиційних закладів, \r\nми не навчаємо задля оцінок.  \r\nМи працюємо індивідуально  \r\nз кожним студентом, щоб досягти \r\n100% засвоєння необхідних знань. ');
INSERT INTO `translatedmessagesua` VALUES ('37', 'ua', 'Ми пропонуємо кожному нашому \r\nвипускнику гарантоване отримання \r\nпропозиції працевлаштування \r\nпротягом 4-6-ти місяців після \r\nуспішного завершення навчання.');
INSERT INTO `translatedmessagesua` VALUES ('38', 'ua', 'Реєстрація на сайті');
INSERT INTO `translatedmessagesua` VALUES ('39', 'ua', 'Вибір курсу чи модуля');
INSERT INTO `translatedmessagesua` VALUES ('40', 'ua', 'Проплата за навчання');
INSERT INTO `translatedmessagesua` VALUES ('41', 'ua', 'Освоєння матеріалу');
INSERT INTO `translatedmessagesua` VALUES ('42', 'ua', 'Завершення курсу');
INSERT INTO `translatedmessagesua` VALUES ('43', 'ua', 'крок');
INSERT INTO `translatedmessagesua` VALUES ('44', 'ua', 'Щоб отримати доступ до курсів та пройти безкоштовні модулі і заняття зареєструйся на сайті. Реєстрація дозволить тобі оцінити якість та зручність нашого продукт, який стане для тебе надійним партнером і порадником в професійній самореалізації.');
INSERT INTO `translatedmessagesua` VALUES ('45', 'ua', 'Щоб стати спеціалістом певного напрямку та рівня (отримати професійну спеціалізацію) вибери для проходження відповідний курс. Якщо Тебе цікавить виключно поглиблення знань в певному напрямку інформаційних технологій, то вибери відповідний модуль для проходження.');
INSERT INTO `translatedmessagesua` VALUES ('46', 'ua', 'Щоб розпочати проходження курсу чи модуля вибери схему оплати (вся сума за курс, оплата модулів, оплата потриместрово, помісячно тощо) та здійсни оплату зручним Тобі способом (схему оплати курсу чи модуля можна змінювати, також можлива помісячна оплата в кредит).');
INSERT INTO `translatedmessagesua` VALUES ('47', 'ua', 'Вивчення матеріалу можливе шляхом читання тексту чи/і перегляду відео для кожного заняття. Під час проходження заняття виконуй Проміжні тестові завдання. По завершенню кожного заняття виконуй Підсумкове тестове завдання. Кожен модуль завершується Індивідуальним проектом чи Екзаменом. 	Можна отримати індивідуальну консультацію викладача чи консультацію онлайн.');
INSERT INTO `translatedmessagesua` VALUES ('48', 'ua', 'Підсумком курсу є Командний дипломний проект, який виконується разом з іншими студентами (склад команди формуєш самостійно чи рекомендує керівник, який затверджує тему і технічне завдання проекту). Здача проекту передбачає передзахист та захист в он-лайн режимі із представленням технічної документації. Після захисту видається диплом та рекомендація для працевлаштування.');
INSERT INTO `translatedmessagesua` VALUES ('49', 'ua', 'Головна');
INSERT INTO `translatedmessagesua` VALUES ('50', 'ua', 'Курси');
INSERT INTO `translatedmessagesua` VALUES ('51', 'ua', 'Про нас');
INSERT INTO `translatedmessagesua` VALUES ('52', 'ua', 'Викладачі');
INSERT INTO `translatedmessagesua` VALUES ('53', 'ua', 'Форум');
INSERT INTO `translatedmessagesua` VALUES ('54', 'ua', 'Профіль');
INSERT INTO `translatedmessagesua` VALUES ('55', 'ua', 'Редагувати профіль');
INSERT INTO `translatedmessagesua` VALUES ('56', 'ua', 'Реєстрація');
INSERT INTO `translatedmessagesua` VALUES ('57', 'ua', 'Профіль викладача');
INSERT INTO `translatedmessagesua` VALUES ('58', 'ua', 'Наші викладачі');
INSERT INTO `translatedmessagesua` VALUES ('59', 'ua', 'персональна сторінка');
INSERT INTO `translatedmessagesua` VALUES ('60', 'ua', 'Якщо ви професійний ІТ-шник і бажаєте викладати окремі ІТ курси чи модулі і співпрацювати з нами в напрямку підготовки програмістів, напишіть нам листа.');
INSERT INTO `translatedmessagesua` VALUES ('61', 'ua', 'Веде курси:');
INSERT INTO `translatedmessagesua` VALUES ('62', 'ua', 'Читати повністю');
INSERT INTO `translatedmessagesua` VALUES ('63', 'ua', 'Відгуки');
INSERT INTO `translatedmessagesua` VALUES ('64', 'ua', 'Розділ:');
INSERT INTO `translatedmessagesua` VALUES ('65', 'ua', 'Про викладача:');
INSERT INTO `translatedmessagesua` VALUES ('66', 'ua', 'Наші курси');
INSERT INTO `translatedmessagesua` VALUES ('67', 'ua', 'Концепція підготовки');
INSERT INTO `translatedmessagesua` VALUES ('68', 'ua', 'Рівень курсу:');
INSERT INTO `translatedmessagesua` VALUES ('69', 'ua', 'Мова курсу:');
INSERT INTO `translatedmessagesua` VALUES ('70', 'ua', 'Курс:');
INSERT INTO `translatedmessagesua` VALUES ('71', 'ua', 'мова:');
INSERT INTO `translatedmessagesua` VALUES ('72', 'ua', 'Модуль:');
INSERT INTO `translatedmessagesua` VALUES ('73', 'ua', 'Заняття:');
INSERT INTO `translatedmessagesua` VALUES ('74', 'ua', 'Тип:');
INSERT INTO `translatedmessagesua` VALUES ('75', 'ua', 'Тривалість:');
INSERT INTO `translatedmessagesua` VALUES ('76', 'ua', 'хв');
INSERT INTO `translatedmessagesua` VALUES ('77', 'ua', 'Викладач');
INSERT INTO `translatedmessagesua` VALUES ('78', 'ua', 'детальніше');
INSERT INTO `translatedmessagesua` VALUES ('79', 'ua', 'Запланувати консультацію');
INSERT INTO `translatedmessagesua` VALUES ('80', 'ua', 'Зміст');
INSERT INTO `translatedmessagesua` VALUES ('81', 'ua', 'показати');
INSERT INTO `translatedmessagesua` VALUES ('82', 'ua', 'приховати');
INSERT INTO `translatedmessagesua` VALUES ('83', 'ua', 'Відео');
INSERT INTO `translatedmessagesua` VALUES ('84', 'ua', 'Зразок коду');
INSERT INTO `translatedmessagesua` VALUES ('85', 'ua', 'Інструкція');
INSERT INTO `translatedmessagesua` VALUES ('86', 'ua', 'Завдання');
INSERT INTO `translatedmessagesua` VALUES ('87', 'ua', 'переглянути знову попередній урок');
INSERT INTO `translatedmessagesua` VALUES ('88', 'ua', 'НАСТУПНИЙ УРОК');
INSERT INTO `translatedmessagesua` VALUES ('89', 'ua', 'Відповісти');
INSERT INTO `translatedmessagesua` VALUES ('90', 'ua', 'Підсумкове завдання');
INSERT INTO `translatedmessagesua` VALUES ('91', 'ua', 'Ви можете також увійти через соцмережі:');
INSERT INTO `translatedmessagesua` VALUES ('92', 'ua', 'Забули пароль?');
INSERT INTO `translatedmessagesua` VALUES ('93', 'ua', 'ВВІЙТИ');
INSERT INTO `translatedmessagesua` VALUES ('94', 'ua', 'Стан курсу: ');
INSERT INTO `translatedmessagesua` VALUES ('95', 'ua', 'Профіль студента');
INSERT INTO `translatedmessagesua` VALUES ('96', 'ua', 'Редагувати </br> профіль');
INSERT INTO `translatedmessagesua` VALUES ('97', 'ua', ' років');
INSERT INTO `translatedmessagesua` VALUES ('98', 'ua', ' рік');
INSERT INTO `translatedmessagesua` VALUES ('99', 'ua', ' роки');
INSERT INTO `translatedmessagesua` VALUES ('100', 'ua', 'Про себе:');
INSERT INTO `translatedmessagesua` VALUES ('101', 'ua', 'Електрона пошта:');
INSERT INTO `translatedmessagesua` VALUES ('102', 'ua', 'Телефон:');
INSERT INTO `translatedmessagesua` VALUES ('103', 'ua', 'Освіта:');
INSERT INTO `translatedmessagesua` VALUES ('104', 'ua', 'Інтереси:');
INSERT INTO `translatedmessagesua` VALUES ('105', 'ua', 'Звідки дізнався про Вас:');
INSERT INTO `translatedmessagesua` VALUES ('106', 'ua', 'Форма навчання:');
INSERT INTO `translatedmessagesua` VALUES ('107', 'ua', 'Завершенні курси:');
INSERT INTO `translatedmessagesua` VALUES ('108', 'ua', 'Мої курси');
INSERT INTO `translatedmessagesua` VALUES ('109', 'ua', 'Розклад');
INSERT INTO `translatedmessagesua` VALUES ('110', 'ua', 'Консультації');
INSERT INTO `translatedmessagesua` VALUES ('111', 'ua', 'Екзамени');
INSERT INTO `translatedmessagesua` VALUES ('112', 'ua', 'Проекти');
INSERT INTO `translatedmessagesua` VALUES ('113', 'ua', 'Мій рейтинг');
INSERT INTO `translatedmessagesua` VALUES ('114', 'ua', 'Завантаження');
INSERT INTO `translatedmessagesua` VALUES ('115', 'ua', 'Листування');
INSERT INTO `translatedmessagesua` VALUES ('116', 'ua', 'Мої оцінювання');
INSERT INTO `translatedmessagesua` VALUES ('117', 'ua', 'Фінанси');
INSERT INTO `translatedmessagesua` VALUES ('118', 'ua', 'Поточний курс:');
INSERT INTO `translatedmessagesua` VALUES ('119', 'ua', 'Незавершений курс:');
INSERT INTO `translatedmessagesua` VALUES ('120', 'ua', 'Завершений курс:');
INSERT INTO `translatedmessagesua` VALUES ('121', 'ua', 'Необхідно здійснити наступну проплату до');
INSERT INTO `translatedmessagesua` VALUES ('122', 'ua', 'Сума проплати:');
INSERT INTO `translatedmessagesua` VALUES ('123', 'ua', ' грн');
INSERT INTO `translatedmessagesua` VALUES ('124', 'ua', 'Індивідуальний модульний проект');
INSERT INTO `translatedmessagesua` VALUES ('125', 'ua', 'Командний дипломний проект');
INSERT INTO `translatedmessagesua` VALUES ('126', 'ua', 'Тип');
INSERT INTO `translatedmessagesua` VALUES ('127', 'ua', 'Дата');
INSERT INTO `translatedmessagesua` VALUES ('128', 'ua', 'Час');
INSERT INTO `translatedmessagesua` VALUES ('129', 'ua', 'Викладач');
INSERT INTO `translatedmessagesua` VALUES ('130', 'ua', 'Тема');
INSERT INTO `translatedmessagesua` VALUES ('131', 'ua', 'Е');
INSERT INTO `translatedmessagesua` VALUES ('132', 'ua', 'К');
INSERT INTO `translatedmessagesua` VALUES ('133', 'ua', 'ІМП');
INSERT INTO `translatedmessagesua` VALUES ('134', 'ua', 'КДП');
INSERT INTO `translatedmessagesua` VALUES ('135', 'ua', ' сильний початківець');
INSERT INTO `translatedmessagesua` VALUES ('136', 'ua', ' українська');
INSERT INTO `translatedmessagesua` VALUES ('137', 'ua', 'Випускники');
INSERT INTO `translatedmessagesua` VALUES ('138', 'ua', 'Вибачте, Ви не можете переглядати цю лекцію. Щоб отримати доступ до цієї лекції, зареєструйтесь або увійдіть у свій аккаунт.');
INSERT INTO `translatedmessagesua` VALUES ('139', 'ua', 'Вибачте, у Вас немає доступу до цієї лекції. Будь-ласка. зайдіть у свій аккаунт та оплатіть доступ до лекції.');
INSERT INTO `translatedmessagesua` VALUES ('140', 'ua', 'Для початківців');
INSERT INTO `translatedmessagesua` VALUES ('141', 'ua', 'Для спеціалістів');
INSERT INTO `translatedmessagesua` VALUES ('142', 'ua', 'Для експертів');
INSERT INTO `translatedmessagesua` VALUES ('143', 'ua', 'Усі курси');
INSERT INTO `translatedmessagesua` VALUES ('144', 'ua', 'знижка');
INSERT INTO `translatedmessagesua` VALUES ('145', 'ua', 'Оцінка курсу:');
INSERT INTO `translatedmessagesua` VALUES ('146', 'ua', 'детальніше ...');
INSERT INTO `translatedmessagesua` VALUES ('147', 'ua', 'Вартість курсу: ');
INSERT INTO `translatedmessagesua` VALUES ('148', 'ua', 'Спочатку навчання створюється стійкий фундамент для підготовки програмістів: необхідні знання елементарної математики, будови комп’ютера і основ інформатики.');
INSERT INTO `translatedmessagesua` VALUES ('149', 'ua', '<p>Потім вивчаються основні принципи програмування на базі класичних комп&rsquo;ютерних наук і методологій: алгоритмічна мова;елементи вищої та дискретної математики і комбінаторики; структури даних, розробка і аналіз алгоритмів.                                 \r\n<p>Після чого формується база для переходу до сучасних технологій програмування: об’єктно-орієнтоване програмування; проектування баз даних.\r\n<p>Завершення процесу підготовки шляхом конкретного застосування отриманих знань на реальних проектах із засвоєнням сучасних методів і технологій, які використовуються в ІТ індустрії компаніями.');
INSERT INTO `translatedmessagesua` VALUES ('150', 'ua', '');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL DEFAULT 'Анонім',
  `identity` varchar(255) NOT NULL,
  `network` varchar(255) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `secondName` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `birthday` varchar(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `googleplus` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `vkontakte` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `hash` varchar(20) NOT NULL,
  `address` text,
  `education` varchar(255) DEFAULT NULL,
  `educform` varchar(60) DEFAULT 'Онлайн',
  `interests` text,
  `aboutUs` text,
  `aboutMy` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT '/avatars/noname.png',
  `role` varchar(255) NOT NULL DEFAULT '0',
  `token` varchar(150) DEFAULT NULL,
  `activkey_lifetime` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'Вова', '', '', '0', '', 'Джа', 'Марля', 'Wizlight', '21/03/1997', 'Wizlightdragon@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', '', '+38(911)_______', '', 'Ямайка', 'ВДПУ', 'Онлайн', 'Ковбаска, колобки, раста', '', '11111111111111111111111111111111111111111111111111111111111111111111111111111111111111', '/css/images/1id.jpg', '0', null, null, '1');
INSERT INTO `user` VALUES ('11', 'ivanna@yutr.rtr', '', '', '0', '', null, '', '', '', 'ivanna@yutr.rtr', '011c945f30ce2cbafc452f39840f025693339c42', null, null, null, null, null, '', '', '', '', 'Онлайн', '', '', '', '/avatars/ivanna@yutr.rtr.jpg', '0', null, null, '1');
INSERT INTO `user` VALUES ('22', 'tttttt', '', '', '0', '', null, '', '', '', 'ttttt@tttt.com', '011c945f30ce2cbafc452f39840f025693339c42', null, null, null, null, null, '', '', '', '', 'Онлайн', '', '', '', '/avatars/ttttt@tttt.com.jpg', '0', null, null, '1');
INSERT INTO `user` VALUES ('38', '', '', '', '0', '', null, null, null, null, 'teacher1@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', null, null, null, null, null, null, '', null, null, 'Онлайн', null, null, null, '/avatars/noname.png', '0', '34b03f0f889edb7b30343b435eec9275e572b025', '2015-05-13 17:22:14', '1');
INSERT INTO `user` VALUES ('39', '', '', '', '0', '', null, null, null, null, 'teacher2@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', null, null, null, null, null, null, '', null, null, 'Онлайн', null, null, null, '/avatars/noname.png', '0', null, null, '1');
INSERT INTO `user` VALUES ('40', '', '', '', '0', '', null, null, null, null, 'teacher3@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', null, null, null, null, null, null, '', null, null, 'Онлайн', null, null, null, '/avatars/noname.png', '0', null, null, '1');
INSERT INTO `user` VALUES ('41', '', '', '', '0', '', null, null, null, null, 'teacher4@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', null, null, null, null, null, null, '', null, null, 'Онлайн', null, null, null, '/avatars/noname.png', '0', null, null, '1');
INSERT INTO `user` VALUES ('42', '', '', '', '0', '', null, null, null, null, 'teacher5@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', null, null, null, null, null, null, '', null, null, 'Онлайн', null, null, null, '/avatars/noname.png', '0', null, null, '1');
INSERT INTO `user` VALUES ('43', '', '', '', '0', '', null, null, null, null, 'teacher6@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', null, null, null, null, null, null, '', null, null, 'Онлайн', null, null, null, '/avatars/noname.png', '0', null, null, '1');
INSERT INTO `user` VALUES ('59', '', '', '', '0', '', null, '', '', '', 'Wizlht@rambler.ru', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', '', '', '', '', '', 'Онлайн', '', '', '', '/avatars/noname.png', '0', null, null, '1');
INSERT INTO `user` VALUES ('63', 'Анонім', '', '', '0', '', null, 'Марля', 'Wizlight', '', 'htdragon@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', '', '', '', '', '', 'Онлайн', '', '', '', '/avatars/noname.png', '0', null, null, '1');
INSERT INTO `user` VALUES ('64', 'Анонімус', '', '', '0', '', null, '', '', '', 'gog@gog.gog', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', '', '', '', '', '', 'Онлайн', '', '', '', '/avatars/noname.png', '0', null, null, '1');
