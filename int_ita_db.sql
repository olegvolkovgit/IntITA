/*
Navicat MySQL Data Transfer

Source Server         : IntITA
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : int_ita_db

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2015-04-28 16:00:12
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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

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
INSERT INTO `aboutus` VALUES ('1', 'UA', '/css/images/line2.png', 'image1.png', 'Про що мрієш ти?', '<p>Спробуємо вгадати: власна квартира чи навіть будинок? Гарний автомобіль? Закордонні подорожі, можливо, до екзотичних країн?</p>', '/index.php?r=site/aboutdetail&id=1', '/css/images/', '', '', '', '', '<p>Спробуємо вгадати: власна квартира чи навіть будинок? Гарний автомобіль? Закордонні подорожі, можливо, до екзотичних країн? Забезпечене життя для себе та близьких, коли не доводиться думати про гроші?\nА, може, це свобода жити своїм життям? Самостійно керувати власним часом з можливістю працювати за зручним графіком без необхідності щодня їздити на роботу, але при цьому мати стабільно високий дохід?\n	Можливо ти хочеш заробляти, займаючись улюбленою справою і отримувати задоволення від сучасної професії?\nПро що б ти не мріяв, для здійснення більшості мрій потрібні гроші. Сьогодні середня зарплата в Україні є найнижчою в Європі: близько 3,5 тис грн у місяць. Навіть якщо брати сферу бізнесу, зарплати більшості робітників не перевищують 5-8 тис грн. \nЯк щодо 40 - 60 тис грн в місяць з можливістю працювати за гнучким графіком та дистанційно? Ти думаєш, що в нашій країні такі умови лише у керівників та власників бізнесу? У нас хороша новина: вже через рік-два-три так зможеш заробляти і ти.</p>\n\n<p><span class=\"detailTitle2\">Професія майбутнього</span>\n Сьогодні у тебе є реальна можливість поєднати хороший заробіток, гнучкий графік роботи та зручність дистанційної роботи. І це не “заработок в интернете”, про який кричить банерна реклама на багатьох сайтах. Ми віримо у те, що високого стабільного доходу можна досягти лише за допомогою власних зусиль.\nМи живемо в епоху, коли головним двигуном розвитку світової економіки є інформаційні технології (ІТ). Вони дозволяють досягти нових проривних результатів у традиційних галузях: виробництві та послугах. Саме інформаційні технології повністю змінили і продовжують трансформувати індустрії звязку, розваг (книги, музика, фільми), банківських послуг, а також такі традиційні бізнеси, як послуги таксі (Uber), готелів (Airbnb), навчання (Coursera). \nГерої інформаційної епохи - це спеціалісти з інформаційних технологій. Вони знаходяться на передовій змін, вони придумали та продовжують розвивати Windows, iOS, Android, а також мільйони додатків до них, вони створюють соціальні мережі, сайти та бази даних. \nГарна новина для тебе: сьогодні таких спеціалістів не вистачає. Інформаційні технології розвиваються дуже швидко і стають потрібними усюди, тому людей не вистачає, існуючі навчальні заклади просто не встигають готувати потрібну кількість. Нестача спеціалістів означає, що зарплати на ринку стабільно зростають, і сягнули небачених для України значень: в середньому спеціалісти з інформаційних технологій сьогодні отримують 3-5 тис доларів у місяць, і при цьому роботодавці активно полюють на професіоналів. Секрет таких високих зарплат не лише у дефіциті кадрів, а й у тому, що для ІТ-галузі кордони - не проблема. Ти можеш працювати вдома зі своєї квартири в Україні над замовленням клієнта зі США чи Німеччини і отримувати винагороду у доларах чи євро з рівнем оплати, не набагато нижчим від американських чи європейських стандартів.  \nМи запрошуємо тебе приєднатися до світової інформаційної еліти та за короткий час стати професіоналом у сфері інформаційних технологій, щоб отримувати стабільно високий дохід та працювати в зручних умовах за гнучким графіком. </p>\n\n<p><span class=\"detailTitle2\">Що очікується від тебе</span><br/>\nПрограмування - це не так складно, як ти можеш уявляти. Безумовно, щоб стати хорошим програмістом, потрібен час та зусилля. Ризикнемо сказати, що крім часу та зусиль (та, зрозуміло, наявності простенького компютера) не потрібно більше ні-чо-го. Не потрібно бути сильним у математиці: навіть якщо у школі ти не любив математику, а твої оцінки не піднимались вище середнього рівня, ти зможеш стати чудовим програмістом. Не потрібно знати, як влаштований компютер чи бути досвіченим користувачем будь-яких програм. Достатньо часу на навчання та бажання займатися. Гарні знання з математики, логіки, комп’ютера можуть пришвидшити темп навчання, але й без них кожен зможе досягти високого рівня професіоналізму у програмуванні завдяки іноваційному підходу до навчання Академії Програмування ІНТІТА.</p>');
INSERT INTO `aboutus` VALUES ('2', 'UA', '/css/images/line2.png', 'image2.png', 'Навчання майбутнього', '<p>Програмування – це не так складно, як ти можеш уявляти. Безумовно, щоб стати хорошим програмістом, потрібен час та зусилля.</p>', '/index.php?r=site/aboutdetail&id=2', '/css/images/', '', '', '', '', '<p>Коли мова йде про навчальний заклад, можемо побитися об заклад, що до думки тобі приходять велика будівля з десятками навчальних приміщень, лекційна аудиторія, парти, записники, конспекти, викладачі, лекції, семінари. Така система освіти сформувалася ще у Стародавній Греції, і за кілька тисяч років майже не змінилася. Але зараз світ стоїть на порозі великої революції в освіті, яка назавжди змінить те, як ми навчаємося. Сьогодні технології зробили доступним те, що раніше могли дозволити собі лише одиниці, наймаючи персональних вчителів та репетиторів: персоналізоване навчання.\n<span class=\"detailTitle2\">“Три кити” Академії ІНТІТА </span></p>\n\n<p><span class=\"detailTitle3\">Кит перший. Гнучкість та зручність. </span></p>\n\n<p>Ти можеш самостійно будувати графік навчання, виходячи з власних потреб та цілей. Якщо ти хочеш закінчити навчання та почати працювати вже через рік, обирай інтенсивне навчання та займайся 6-8 годин в день. Якщо ти хочеш освоїти програмування поступово, не жертвуючи іншими важливими для тебе речами, ти можеш займатися ті ж 6-8 годин, але у тиждень. \nНе потрібно відвідувати навчальний заклад, Академія з тобою всюди. Навіть якщо ти у місці, де немає звязку та інтернету, ти можеш переглядати лекції в офлайн-режимі, а практичну частину зробити пізніше, коли зявиться доступ.  \n<span class=\"detailTitle3\">Кит другий. Орієнтація на ринок. </span></p>\n\n<p>Ми даємо тобі лише 100% необхідні знання. Ми поважаємо гуманітарні дисципліни та фундаментальні точні науки, які входять до  складу обовязкових для вивчення у вишах, але переконані, що вони не є обовязковими для того, щоб стати професіоналом у сфері інформаційних технологій. Ми вважаємо, що кожен має вирішувати індивідуально, що вивчати та чим цікавитись за межами своєї професії. У той же час у програмах вишів відсутні критичні для професійного успіху дисципліни, або ж вони викладаються недостатньо професійно (англійська мова для ІТ-спеціалістів, проектний менеджмент тощо). Інформаційні технології - це дисципліна, яка змінюється кожного дня, програми вишів просто не встигають адаптуватися до такої швидкості змін. ІНТІТА слідкує за змінами щодня, і адаптує як навчальну програму, так і зміст окремих предметів за необхідностю миттєво. Ми завжди у пошуку нового матеріалу, який можна передати студентам академії.  \nПорівнюючи звичайний технічний виш та академію ІНТІТА, ти можеш думати про сімейний універсал та болід Формула-1. Перший підходить для широкого кола завдань, але він значно програє позашляховикам у прохідності, міні-венам у місткості, лімузинам - у комфорті, спротивним автомобілям - у швидкості та керуванні. Другий сконструйовано лише заради максимальної швидкості та маневреності, жертвуючи усім іншим. І в результаті ми не зробимо з тебе універсально освічену людину, яка розбирається потрохи у всьому, ми зробимо тебе професіоналом світового класу в області програмування.  \n <span class=\"detailTitle3\">Кит третій. Результативність. </span></p>\n\n<p>На відміну від традиційних закладів, ми не навчаємо задля оцінок. Ми працюємо індивідуально з кожним студентом, щоб досягти 100% засвоєння необхідних знань (а ми даємо лише необхідні знання). Ми не обмежуємо тебе у часі, теоретично ти можеш навчатися як завгодно довго. Ми беремо на себе зобовязання навчити тебе програмуванню, незважаючи на те, які знання у тебе вже є. Єдиними передумовами для початку занять є бажання, час на навчання, наявність хоча б простенького компютера та вміння читати та писати. \nЗнання, які ти отримаєш, максимально практичні та сучасні. Починаючи з першого заняття, ти робитимеш завдання з реального світу програмування. Ближче до закінчення навчання ти будеш приймати участь у створенні реальних програмних продуктів для ринку.\nМи гарантуємо тобі 100% отримання пропозиції про працевлаштування протягом 4-6-ти місяців після успішного закінчення навчання.\n <span class=\"detailTitle2\">ІНТІТА: переваги наочно</span>\n \n <table id=\"detailTable\">\n<tr><td><span class=\"detailTitle2\">Традиційне навчання</span></td><td><span class=\"detailTitle2\">ІНТІТА</span></td><td><span class=\"detailTitle2\">Переваги</span></td></tr>\n <tr><td>Необхідність відвідувати заняття у класі</td><td>Навчання у себе вдома</td><td>Комфортна домашня атмосфера, економія часу та коштів на поїздки</td></tr>\n <tr><td>Заняття за фіксованим графіком</td><td>Заняття за індивідуальним графіком</td><td>Можливість підлаштувати графік навчання під власні потреби</td></tr>\n<tr><td>Жорстко визначена навчальна програма, привязана до часових рамок (академічний рік)</td><td>Можливість обирати предмети та термін навчання </td><td>Навчання в комфортному темпі за власним графіком, не обмежене часом</td></tr>\n<tr><td>Лекції та семінари, як основа навчального процесу (вивчення теорії)</td><td>Практичні заняття з першого дня навчання, створення реальних працюючих проектів</td><td>Отримання реального робочого досвіду вже протягом навчання, портфоліо готових робіт на момент закінчення навчання</td></tr>\n<tr><td>Оцінки за якість засвоєних знань за певний час </td><td>Оцінок немає, лише “знання засвоєні” чи “потрібно навчатися далі”</td><td>Навчання до позитивного результату: до повного засвоєння необхідних знань</td></tr>\n<tr><td>Диплом про вищу освіту видається через 5-6 років за умови засвоєння великої кількості непрофільних знань (мова, історія, філософія тощо)</td><td>Лише практичні знання, які будуть потрібні тобі у роботі та житті: програмування, англійська мова, побудова карєри на ринку інформаційних технологій, основи життєвого успіху.</td><td>Весь час навчання витрачається на отримання корисних практичних знань, тому термін навчання скорочуються, а кількість практичних засвоєних знань більша, ніж у традиційних закладах.</td></tr>\n </table> \'</p>');
INSERT INTO `aboutus` VALUES ('3', 'UA', '/css/images/line2.png', 'image3.png', 'Питання та відгуки', '<p>Три кити Академії Програмування ІНТІТА Самостійний графік навчання. Лише 100% необхідні знання. Засвоєння 100% знань!</p>', '/index.php?r=site/aboutdetail&id=3', '/css/images/', '', '', '', '', '<p><span class=\"detailTitle3\">Скільки триває навчання, як швидко я зможу почати заробляти?\n</span><ul><li class=\"listAbout\">навчання не має фіксованого терміну і залежить виключно від темпу, який обереш ти.\n</li></ul>\n<span class=\"detailTitle3\">Чи отримаю я державний диплом про освіту?\n</span><ul><li class=\"listAbout\">ми не видаємо дипломів державного зразка, наша ціль - забезпечити передумови для гарантованого працевлаштування слухачів.\n</li></ul>\n<span class=\"detailTitle3\">Чому навчання коштує так дешево (дорого) у порівнянні з вишем (курсами) Х?\n</span><ul><li class=\"listAbout\">вартість навчання економічно обгрунтована і буде відроблена менше, ніж за рік роботи на позиції програміста-початківця.\n</li></ul>\n<span class=\"detailTitle3\">У мене зараз немає необхідних коштів, чи можу я навчатися у кредит?\n</span><ul><li class=\"listAbout\">так, ми пропонуємо гнучкий підхід в оплаті за навчання, детальніше можна вияснити написавши нам листа на електронну пошту. Контакти.\n</li></ul>\n<span class=\"detailTitle3\">Я чув від знайомого, що він освоїв програмування самотужки, це можливо?\n</span><ul><li class=\"listAbout\">так, на ринку багато “програмістів-самоучок”, але вони, як правило, пройшли довгий шлях для того, щоб навчитись програмуванню, ми - один із ефективних варіантів стати кваліфікованим програмістом за короткий час.\n</li></ul>\n<span class=\"detailTitle3\">У мене у школі було погано з математикою / я давно не займався математикою. Це може завадити мені навчитися програмуванню?\n</span><ul><li class=\"listAbout\">математика допомагає краще розвинути логічне мислення і знання елементарної математики необхідні обов’язково, проте, не математичне, а логічне мислення визначає наскільки гарний програміст і тільки невеликий відсоток гарних математиків стають професійними програмістами.\n</li></ul>\n<span class=\"detailTitle3\">Мені 34 роки, чи можу я зараз розпочати навчання?\n</span><ul><li class=\"listAbout\">верхньої вікової межі для того, щоб вивчати програмування - немає, люди і старшого віку розпочинали і досягали гарних результатів. Життєвий досвід людям старшого віку дозволяє ефективніше побудувати навчальний процес і швидше кар’єрно зростати.\n</li></ul>\n<span class=\"detailTitle3\">Я чув думку, що професія програміста технічна, а я - людина творча. Чи підійде програмування мені?\n</span><ul><li class=\"listAbout\">програмування - це і є творчість, варто спробувати, щоб зрозуміти чи це твоє покликання.\n</li></ul>\'</p>');
INSERT INTO `aboutus` VALUES ('4', 'RU', '/css/images/line2.png', 'image1.png', 'О чём ты мечтаешь?', '<p>Попробуем угадать: собственная квартира или даже дом? Красивая машина? Заграничные путешествия в экзотические страны?</p>', '/index.php?r=site/aboutdetail&id=1', '/css/images/', '', '', '', '', '');
INSERT INTO `aboutus` VALUES ('5', 'RU', '/css/images/line2.png', 'image2.png', 'Обучение будущего', '<p>Программирование - это не так сложно, как ты думаешь. Безусловно, чтобы стать хорошим программистом, нужны время и усилия.</p>', '/index.php?r=site/aboutdetail&id=2', '/css/images/', '', '', '', '', '');
INSERT INTO `aboutus` VALUES ('6', 'RU', '/css/images/line2.png', 'image3.png', 'Вопросы и отзывы', '<p>Три кита Академии Программирования ИНТИТА. Самостоятельный график обучения. Только 100% необходимые знания. 100 % усвоение знаний!</p>', '/index.php?r=site/aboutdetail&id=3', '/css/images/', '', '', '', '', '');

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
INSERT INTO `course` VALUES ('1', 'Php', 'ua', 'Інтернет програміст (РНР)', 'strong junior', '2015-07-30', '0', '7', '89', '6548', 'хто відповідає за постановку завдань на розробку;для дизайнерів, які готові почати не просто малювати красиві картинки, а й навчитися тому, як створювати працюючі і зручні інтерфейси;для розробників, які хочуть самостійно створити або змінити свій проект;', 'Ви навчитеся писати чистий код;Користуватися системами контролю версій;Дізнаєтеся, з чого складається сучасний додаток;Для чого потрібен безперервна інтеграція (СІ) сервер;Чому потрібно тестувати свої програми і як це робити;', 'Відеозаписи та текстові матеріали всіх онлайн-занять;Спілкування з розумними одногрупниками;Сертифікат про закінчення навчання;Прилаштованість на робоче місце в силіконовій долині;', '/css/images/course1Image.png', null);
INSERT INTO `course` VALUES ('2', 'Javascript', 'ua', 'Інтернет програміст (Java Script)', 'strong junior', '2015-10-30', '0', '7', '120', '0', '', '', '', '/css/images/course1Image.png', null);
INSERT INTO `course` VALUES ('3', 'Java', 'ua', 'Програміст (Java)', 'strong junior', '2015-10-30', '0', '7', '30', '0', '', '', '', '/css/images/course1Image.png', null);
INSERT INTO `course` VALUES ('4', 'C#', 'ua', 'Програміст (C#)', 'strong junior', '2015-10-30', '0', '7', '40', '0', '', '', '', '/css/images/course1Image.png', null);
INSERT INTO `course` VALUES ('5', 'C++', 'ua', 'Програміст (С++)', 'intern', '2015-12-30', '0', '7', '36', '0', '', '', '', '/css/images/course1Image.png', null);
INSERT INTO `course` VALUES ('6', 'ObjectiveC', 'ua', 'Програміст (Objective С)', 'middle', '2015-10-30', '0', '7', '130', '0', '', '', '', '/css/images/course1Image.png', null);
INSERT INTO `course` VALUES ('7', 'QA', 'ua', 'Тестувальник (QA)', 'junior', '2016-02-28', '0', '7', '64', '0', '', '', '', '/css/images/course1Image.png', null);

-- ----------------------------
-- Table structure for `courseresource`
-- ----------------------------
DROP TABLE IF EXISTS `courseresource`;
CREATE TABLE `courseresource` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idCourse` int(10) NOT NULL,
  `idResource` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_courseresource_resource` (`idResource`),
  CONSTRAINT `FK_courseresource_resource` FOREIGN KEY (`idResource`) REFERENCES `resource` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of courseresource
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of header
-- ----------------------------
INSERT INTO `header` VALUES ('0', 'UA', '/css/images/Logo_big.png', '/css/images/Logo_small.png', '/courses', '/teachers', '/index.php', '/site/aboutdetail');
INSERT INTO `header` VALUES ('1', 'RU', '/css/images/Logo_big.png', '/css/images/Logo_small.png', '/courses', '/teachers', '/index.php', '/site/aboutdetail');
INSERT INTO `header` VALUES ('3', 'UA', '/css/images/Logo_big.png', '/css/images/Logo_small.png', '/courses', '/teachers', '/index.php', '/site/aboutdetail');

-- ----------------------------
-- Table structure for `hometasks`
-- ----------------------------
DROP TABLE IF EXISTS `hometasks`;
CREATE TABLE `hometasks` (
  `hometask_ID` int(11) NOT NULL AUTO_INCREMENT,
  `fkmodule_ID` int(11) NOT NULL,
  `fklecture_ID` int(11) NOT NULL,
  `hometask_name` varchar(45) NOT NULL,
  `hometask_description` varchar(45) NOT NULL,
  `hometask_url` varchar(255) NOT NULL,
  PRIMARY KEY (`hometask_ID`),
  UNIQUE KEY `fkmodule_ID` (`fkmodule_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hometasks
-- ----------------------------
INSERT INTO `hometasks` VALUES ('1', '23', '34', 'Hometask 1', 'Description 1', 'URL 1');
INSERT INTO `hometasks` VALUES ('2', '2', '2', 'Hometask 2', 'Descipion 2', 'URL 2');

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
-- Table structure for `lecture`
-- ----------------------------
DROP TABLE IF EXISTS `lecture`;
CREATE TABLE `lecture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `alias` varchar(10) NOT NULL,
  `language` varchar(6) NOT NULL,
  `idModule` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `idType` int(11) NOT NULL,
  `durationInMinutes` int(11) NOT NULL,
  `maxNumber` int(11) NOT NULL,
  `iconIsDone` varchar(255) NOT NULL,
  `preLecture` int(11) NOT NULL,
  `nextLecture` int(11) NOT NULL,
  `idTeacher` varchar(50) NOT NULL,
  `lectureUnwatchedImage` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_lecture_module` (`idModule`),
  CONSTRAINT `FK_lecture_module` FOREIGN KEY (`idModule`) REFERENCES `module` (`module_ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lecture
-- ----------------------------
INSERT INTO `lecture` VALUES ('1', '/css/images/lectureImage.png', 'types', 'ua', '1', '3', 'Goal of classes 1', '10', '40', '6', '/css/images/medalIcoFalse.png', '2', '4', '2', 'css/images/ratIco0.png');

-- ----------------------------
-- Table structure for `lectureresource`
-- ----------------------------
DROP TABLE IF EXISTS `lectureresource`;
CREATE TABLE `lectureresource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idLecture` int(11) NOT NULL,
  `idResource` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_lectureResource_resource` (`idResource`),
  CONSTRAINT `FK_lectureResource_resource` FOREIGN KEY (`idResource`) REFERENCES `resource` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lectureresource
-- ----------------------------

-- ----------------------------
-- Table structure for `lectures`
-- ----------------------------
DROP TABLE IF EXISTS `lectures`;
CREATE TABLE `lectures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `alias` varchar(10) NOT NULL,
  `language` varchar(6) NOT NULL,
  `idModule` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `idType` int(11) NOT NULL,
  `durationInMinutes` int(11) NOT NULL,
  `maxNumber` int(11) NOT NULL,
  `iconIsDone` varchar(255) NOT NULL,
  `preLecture` int(11) NOT NULL,
  `nextLecture` int(11) NOT NULL,
  `idTeacher` varchar(50) NOT NULL,
  `lectureUnwatchedImage` varchar(255) NOT NULL,
  `lectureOverlookedImage` varchar(255) NOT NULL,
  `lectureTimeImage` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lectures
-- ----------------------------
INSERT INTO `lectures` VALUES ('1', '/css/images/lectureImage.png', 'lecture1', 'UA', '1', '3', 'Змінні та типи даних в PHP', '1', '40', '6', '/css/images/medalIcoFalse.png', '2', '4', '2', '/css/images/ratIco0.png', '/css/images/ratIco1.png', '/css/images/timeIco.png');
INSERT INTO `lectures` VALUES ('2', '/css/images/lectureImage.png', 'lecture2', 'UA', '1', '2', 'Змінні та типи даних в PHP', '1', '50', '6', '/css/images/medalIcoFalse.png', '1', '3', '2', '/css/images/ratIco0.png', '/css/images/ratIco1.png', '/css/images/timeIco.png');
INSERT INTO `lectures` VALUES ('3', '/css/images/lectureImage.png', 'lecture3', 'UA', '1', '4', 'Змінні та типи даних в PHP', '1', '60', '6', '/css/images/medalIcoFalse.png', '3', '5', '3', '/css/images/ratIco0.png', '/css/images/ratIco1.png', '/css/images/timeIco.png');

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
  CONSTRAINT `FK_lecture_element_element_type` FOREIGN KEY (`id_type`) REFERENCES `element_type` (`id`),
  CONSTRAINT `FK__lectures` FOREIGN KEY (`id_lecture`) REFERENCES `lectures` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Chapters and other lecture''s resources ';

-- ----------------------------
-- Records of lecture_element
-- ----------------------------
INSERT INTO `lecture_element` VALUES ('1', '1', 'text', '1', '    <h1 class=\"lessonPart\">Вступ</h1>\r\n    <span class=\"colorBlack\">Змінна</span> - це літерно-символьне подання частини інформації, яка перебуває в памяті Web-сервера. В php змінна виглядає ось так:\r\n    \r\n   ');
INSERT INTO `lecture_element` VALUES ('1', '2', 'code', '4', '<p><span class=\"colorGreen\">$</span>names=<span class=\"colorO\">\"Я інформація в памяті тчк\"</span>;</p>');
INSERT INTO `lecture_element` VALUES ('1', '3', 'text', '1', ' <span class=\"colorBlack\">Імена змінних</span>\r\n    <p>Будь-яка змінна в РНР має ім\'я, що починається із знаку $, наприклад Svariable. При такому способі формування імен змінних їх дуже легко відрізнити від іншого коду. Якщо в інших мовах інколи може виникати плутанина з тим, що при першому погляді на код не завжди ясно - де тут змінні, а де функції, то в РНР це питання навіть не постає. Наприклад, ссилка на змінну по її імені, що зберігається в іншій змінній:</p>');
INSERT INTO `lecture_element` VALUES ('1', '4', 'video', '2', '<iframe width=\"633\" height=\"390\" src=\"https://www.youtube.com/embed/L3Mg6lk6yyA\" frameborder=\"0\" allowfullscreen></iframe>');
INSERT INTO `lecture_element` VALUES ('1', '5', 'label', '8', '    <a name=\"Частина 1: Типи змінних та перемінних\"></a>');
INSERT INTO `lecture_element` VALUES ('1', '6', 'text', '1', '    <h1 class=\"lessonPart\">Частина 1: Типи змінних та перемінних</h1>\r\n    <span class=\"colorBlack\">Змінна</span> - це літерно-символьне подання частини інформації, яка перебуває в памяті Web-сервера. В php змінна виглядає ось так:');
INSERT INTO `lecture_element` VALUES ('1', '7', 'code', '4', '<p><span class=\"colorGreen\">$</span>names=<span class=\"colorO\">\"Я інформація в памяті тчк\"</span>;</p>');
INSERT INTO `lecture_element` VALUES ('1', '8', 'text', '1', '    <span class=\"colorBlack\">Імена змінних</span>\r\n    <p>Будь-яка змінна в РНР має ім\'я, що починається із знаку $, наприклад Svariable. При такому способі формування \r\n        імен змінних їх дуже легко відрізнити від іншого коду. Якщо в інших мовах інколи може виникати плутанина з тим,\r\n        що при першому погляді на код не завжди ясно - де тут змінні, а де функції, то в РНР це питання навіть не постає. \r\n        Наприклад, ссилка на змінну по її імені, що зберігається в іншій змінній:</p>');
INSERT INTO `lecture_element` VALUES ('1', '9', 'code', '4', '\r\n        <p>$names=\"value\";</p>\r\n        <p>$names=5;</p>\r\n        <p>echo $$name;</p>\r\n');
INSERT INTO `lecture_element` VALUES ('1', '10', 'text', '1', '    <p>Змінні в РНР представляються у вигляді рядка, що починається знаком долара, а за ним слідує ім\'я змінної. Ім\'я змінної може складатися з латинських літер, звичайних цифр і деяких символів або комбінацій літер, цифр і символів.</p>');
INSERT INTO `lecture_element` VALUES ('1', '11', 'example', '3', '<span class=\"subChapter\">Зразок коду 1:</span>\r\n<pre class=\"prettyprint linenums\">\r\n&lt;html&gt;\r\n  &lt;head&gt;\r\n  &lt;/head&gt;\r\n  &lt;body&gt;\r\n    &lt;p&gt;\r\n      &lt;?php\r\n      $items= //Set this to a number greater than 5! Type the string &quot;Arr, matey!&quot;\r\n\r\n      if ($items&lt;5) {\r\n      echo &quot;You get a 10% discount!&quot;;\r\n      }\r\n    ?&gt;\r\n    &lt;/p&gt;\r\n &lt;/body&gt;\r\n&lt;/html&gt;\r\n</pre>');
INSERT INTO `lecture_element` VALUES ('1', '12', 'example', '3', '<span class=\"subChapter\">Зразок коду 2  </span><span class=\"spoilerLinks\"><span class=\"spoilerClick\">(показати)</span><span class=\"spoilerTriangle\"> &#9660;</span></span>');
INSERT INTO `lecture_element` VALUES ('1', '13', 'video', '2', '<h3><span class=\"subChapter\">Відео 1.</span></h3>\r\n    <iframe width=\"633\" height=\"390\" src=\"https://www.youtube.com/embed/L3Mg6lk6yyA\" frameborder=\"0\" allowfullscreen></iframe>');
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
INSERT INTO `lecture_element` VALUES ('1', '24', 'video', '2', '<h3><span class=\"subChapter\"><?php echo Yii::t(\'lecture\',\'0083\'); ?> 1.</span></h3>\r\n    <iframe width=\"633\" height=\"390\" src=\"https://www.youtube.com/embed/L3Mg6lk6yyA\" frameborder=\"0\" allowfullscreen></iframe>');
INSERT INTO `lecture_element` VALUES ('1', '25', 'instruction', '7', '<li>On line 7, set <span class=\"colorBP\"><span class=\"colorGreen\">$</span>terms</span> equal to a number greater than 5. Make sure to put a semicolon at the end of the line.</li>\r\n                <li>On line 9, edit the state condition so that your program will be out Some expressions return a \' logical value\": TRUE or FALSE, text like thise:<span class=\"colorAlert\">You get a 10% discount!</span></li>');
INSERT INTO `lecture_element` VALUES ('1', '26', 'task', '5', '<li>On line 7, set equal to a number greater than 5. Some expressions return a \"logical value\": TRUE or FALSE. Make sure to put a semicolon at the end of the line.</li>\r\n                <a href=\"#\"> <span class=\"colorP\"><img src=\"<?php echo Yii::app()->request->baseUrl; ?>/css/images/arrow.png\"> Відповісти</span></a>\r\n                <li>An if statement is made up of the if keyword, a condition like we\'ve seen before <span class=\"colorBP\"><span class=\"colorGreen\">$</span>terms</span>, and a pair of curly braces <span class=\"colorBP\">{}</span>. If the answer to the condition is yes, the code inside the curly will run.</li>\r\n                <a href=\"#\"><span class=\"colorP\"><img src=\"<?php echo Yii::app()->request->baseUrl; ?>/css/images/arrow.png\"> Відповісти</span></a>\r\n                <li>Резиновая по ширине (изменяется с Some expressions return a \"logical value\": TRUE or FALSE, изменением окна <span class=\"colorBP\"><span class=\"colorGreen\">$</span>terms</span> браузера или с разрешением экрана)</li>');
INSERT INTO `lecture_element` VALUES ('1', '27', 'final task', '6', ' <li>On line 7, set equal to a number greater than 5. Some expressions return a \"logical value\": TRUE or FALSE. Make sure to put a semicolon at the end of the line.</li>\r\n                <a href=\"#\"> <span class=\"colorP\"><img src=\"<?php echo Yii::app()->request->baseUrl; ?>/css/images/arrow.png\"> Відповісти</span></a>\r\n                <li>An if statement is made up of the if keyword, a condition like we\'ve seen before <span class=\"colorBP\">$terms</span>, and a pair of curly braces <span class=\"colorBP\">{}</span>. If the answer to the condition is yes, the code inside the curly will run.</li>\r\n                <a href=\"#\"><span class=\"colorP\"><img src=\"<?php echo Yii::app()->request->baseUrl; ?>/css/images/arrow.png\"> Відповісти</span></a>\r\n                <li>Резиновая по ширине (изменяется с Some expressions return a \"logical value\": TRUE or FALSE, изменением окна <span class=\"colorBP\">$terms</span> браузера или с разрешением экрана)</li>');

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
-- Table structure for `mainpagetranslated`
-- ----------------------------
DROP TABLE IF EXISTS `mainpagetranslated`;
CREATE TABLE `mainpagetranslated` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(6) NOT NULL,
  `title` varchar(100) NOT NULL,
  `header1` varchar(100) NOT NULL,
  `subheader1` varchar(255) NOT NULL,
  `translation` text NOT NULL,
  `header2` varchar(100) NOT NULL,
  `subheader2` varchar(255) NOT NULL,
  `sliderHeader` varchar(50) NOT NULL,
  `sliderText` varchar(255) NOT NULL,
  `sliderButtonText` varchar(20) NOT NULL,
  `linkName` varchar(20) NOT NULL,
  `formHeader1` varchar(50) NOT NULL,
  `formHeader2` varchar(50) NOT NULL,
  `regText` varchar(50) NOT NULL,
  `buttonStart` varchar(50) NOT NULL,
  `socialText` varchar(50) NOT NULL,
  PRIMARY KEY (`id`,`language`),
  CONSTRAINT `FK__mainpage` FOREIGN KEY (`id`) REFERENCES `mainpage` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mainpagetranslated
-- ----------------------------
INSERT INTO `mainpagetranslated` VALUES ('0', 'ru', 'ИНТИТА', 'О нас', '', 'ПРОГРАММИРУЙ БУДУЩЕЕ', '', '', 'ПРОГРАММИРУЙ БУДУЩЕЕ', '', '', '', '', '', '', '', '');

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
INSERT INTO `messages` VALUES ('13', 'ua', 'ПОЧАТИ');
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
INSERT INTO `messages` VALUES ('73', 'ua', 'Заняття:');
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
INSERT INTO `messages` VALUES ('73', 'en', 'Lecture:');
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
INSERT INTO `messages` VALUES ('73', 'ru', 'Занятие:');
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
INSERT INTO `messages` VALUES ('194', 'ru', 'Продолжительность курса:');
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
INSERT INTO `messages` VALUES ('213', 'ru', 'Продолжительность:');
INSERT INTO `messages` VALUES ('213', 'en', 'Duration:');
INSERT INTO `messages` VALUES ('214', 'ua', 'Рівень модуля:');
INSERT INTO `messages` VALUES ('214', 'ru', 'Уровень модуля:');
INSERT INTO `messages` VALUES ('214', 'en', 'Level module:');
INSERT INTO `messages` VALUES ('215', 'ua', 'Тривалість модуля:');
INSERT INTO `messages` VALUES ('215', 'ru', 'Продолжительность модуля:');
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
INSERT INTO `messages` VALUES ('227', '', '');
INSERT INTO `messages` VALUES ('228', 'ru', 'персональная страница');
INSERT INTO `messages` VALUES ('228', 'en', 'personal page');
INSERT INTO `messages` VALUES ('228', 'ua', 'персональна сторінка');
INSERT INTO `messages` VALUES ('226', 'ru', 'Занятие');
INSERT INTO `messages` VALUES ('226', 'en', 'Lecture');

-- ----------------------------
-- Table structure for `module`
-- ----------------------------
DROP TABLE IF EXISTS `module`;
CREATE TABLE `module` (
  `module_ID` int(11) NOT NULL AUTO_INCREMENT,
  `course` int(11) NOT NULL,
  `module_name` varchar(45) NOT NULL,
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
  PRIMARY KEY (`module_ID`),
  UNIQUE KEY `module_ID` (`module_ID`),
  KEY `course` (`course`),
  CONSTRAINT `FK_module_course` FOREIGN KEY (`course`) REFERENCES `course` (`course_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of module
-- ----------------------------
INSERT INTO `module` VALUES ('1', '1', 'Основи PHP', 'start', 'ua', '14', '20', '27', '1256', 'для менеджерів проектів і тих, хто відповідає за постановку завдань на розробку;для дизайнерів, які готові почати не просто малювати красиві картинки, а й навчитися тому, як створювати працюючі і зручні інтерфейси;для розробників, які хочуть самостійно створити або змінити свій проект;', 'Ви навчитеся писати чистий код;Користуватися системами контролю версій;Дізнаєтеся, з чого складається сучасний додаток;Для чого потрібен безперервна інтеграція (СІ) сервер;Чому потрібно тестувати свої програми і як це робити;', 'Відеозаписи та текстові матеріали всіх онлайн-занять;Спілкування з розумними одногрупниками;Сертифікат про закінчення навчання;Прилаштованість на робоче місце в силіконовій долині;', '/css/images/courseimg1.png', null);
INSERT INTO `module` VALUES ('2', '2', 'Module 2', 'module2', 'ua', '30', '15', null, null, null, null, null, null, null);
INSERT INTO `module` VALUES ('3', '3', 'Module 3', 'module3', 'ua', '60', '30', null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `moduleresource`
-- ----------------------------
DROP TABLE IF EXISTS `moduleresource`;
CREATE TABLE `moduleresource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idModule` int(11) NOT NULL,
  `idResource` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_moduleResource_moduleresource` (`idResource`),
  CONSTRAINT `FK_moduleResource_moduleresource` FOREIGN KEY (`idResource`) REFERENCES `moduleresource` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of moduleresource
-- ----------------------------

-- ----------------------------
-- Table structure for `modules`
-- ----------------------------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `module_ID` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(45) NOT NULL,
  `module_duration_hours` int(11) NOT NULL,
  `module_duration_days` int(11) NOT NULL,
  `lesson_count` int(11) DEFAULT NULL,
  `module_price` decimal(10,0) DEFAULT NULL,
  `for_whom` text,
  `what_you_learn` text,
  `what_you_get` text,
  `module_img` varchar(255) DEFAULT NULL,
  `about_module` text,
  PRIMARY KEY (`module_ID`),
  UNIQUE KEY `module_ID` (`module_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of modules
-- ----------------------------
INSERT INTO `modules` VALUES ('1', 'Основи PHP', '14', '20', '6', '1256', 'для менеджерів проектів і тих, хто відповідає за постановку завдань на розробку;для дизайнерів, які готові почати не просто малювати красиві картинки, а й навчитися тому, як створювати працюючі і зручні інтерфейси;для розробників, які хочуть самостійно створити або змінити свій проект;', 'Ви навчитеся писати чистий код;Користуватися системами контролю версій;Дізнаєтеся, з чого складається сучасний додаток;Для чого потрібен безперервна інтеграція (СІ) сервер;Чому потрібно тестувати свої програми і як це робити;', 'Відеозаписи та текстові матеріали всіх онлайн-занять;Спілкування з розумними одногрупниками;Сертифікат про закінчення навчання;Прилаштованість на робоче місце в силіконовій долині;', '/css/images/courseimg1.png', null);
INSERT INTO `modules` VALUES ('2', 'Module 2', '30', '15', null, null, null, null, null, null, null);
INSERT INTO `modules` VALUES ('3', 'Module 3', '60', '30', null, null, null, null, null, null, null);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User rights for lectures: BIT (32) \r\n0 - read\r\n1 - edit\r\n2 - create\r\n3 - delete  ';

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', '1', '15');
INSERT INTO `permissions` VALUES ('11', '1', '15');
INSERT INTO `permissions` VALUES ('22', '1', '15');
INSERT INTO `permissions` VALUES ('38', '2', '3');
INSERT INTO `permissions` VALUES ('39', '2', '3');
INSERT INTO `permissions` VALUES ('40', '2', '3');
INSERT INTO `permissions` VALUES ('41', '2', '3');
INSERT INTO `permissions` VALUES ('42', '2', '3');
INSERT INTO `permissions` VALUES ('43', '2', '3');

-- ----------------------------
-- Table structure for `regextended`
-- ----------------------------
DROP TABLE IF EXISTS `regextended`;
CREATE TABLE `regextended` (
  `regID` int(11) NOT NULL AUTO_INCREMENT,
  `language` enum('UA','EN','RU') NOT NULL,
  `mainLink` varchar(30) NOT NULL,
  `regLink` varchar(30) NOT NULL,
  `header` varchar(50) NOT NULL,
  `headerFoto` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `dateOfBirth` varchar(50) NOT NULL,
  `education` varchar(50) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `repeatPassword` varchar(50) NOT NULL,
  `submitButtonText` varchar(50) NOT NULL,
  `chooseFileButton` varchar(50) NOT NULL,
  `fileNotChoose` varchar(50) NOT NULL,
  PRIMARY KEY (`regID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of regextended
-- ----------------------------
INSERT INTO `regextended` VALUES ('1', 'UA', 'Головна', 'Реєстрація', 'Персональні', 'Завантажити фото профілю', 'Ім\'я', 'По-батькові', 'Прізвище', 'Дата народження', 'Освіта', 'Телефон', 'Email', 'Пароль', 'Повтор пароля', 'Відправити />', 'Виберіть файл', 'Файл не вибрано ...');
INSERT INTO `regextended` VALUES ('2', 'RU', 'Главная', 'Регистрация', 'Персональные данные', 'Загрузить фото профиля', 'Имя', 'Отчество', 'Фамилия', 'Дата рождения', 'Образование', 'Телефон', 'Еmail', 'Пароль', 'Повтор пароля', 'ОТПРАВИТЬ />', 'ВЫБЕРИТЕ ФАЙЛ', 'Файл не вибрано &hellip;');

-- ----------------------------
-- Table structure for `resource`
-- ----------------------------
DROP TABLE IF EXISTS `resource`;
CREATE TABLE `resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `idResource` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of resource
-- ----------------------------

-- ----------------------------
-- Table structure for `response`
-- ----------------------------
DROP TABLE IF EXISTS `response`;
CREATE TABLE `response` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `who` int(11) NOT NULL,
  `about` int(11) NOT NULL,
  `date` date NOT NULL,
  `text` text NOT NULL,
  `rate` int(2) NOT NULL,
  `who_ip` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__user` (`who`),
  KEY `FK__user_2` (`about`),
  CONSTRAINT `FK__user` FOREIGN KEY (`who`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__user_2` FOREIGN KEY (`about`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='Responses for taechers';

-- ----------------------------
-- Records of response
-- ----------------------------
INSERT INTO `response` VALUES ('1', '1', '38', '2014-11-14', 'Только слова благодарности и восхищения таким педагогом и вообще человеком!\r\n                        С Александрой знакома через ее сайт Учитель мистецтва. Столько высококлассных \r\n                        работ я в сети еще не встречала! Она всегда отвечает на просьбы, решает проблемы пользователей. \r\n                        Очень отзывчивый человек. Спасибо Вам! Терпения, удачи и творческого вдохновения на много лет!', '10', '123.43.31.12');
INSERT INTO `response` VALUES ('2', '22', '38', '2014-11-14', 'Весьма важный этап, учитывая огромную конкуренцию на рынке.\r\n                       Тут, конечно, более важно узнать бизнес-процессы конкурентов, но и проанализировать сайты компаний,\r\n                       с которыми предстоит конкурировать на рынке интернет-торговли будет очень кстати. \r\n                       Так как мы говорим тут о проектировании, я не буду углубляться в сферу промышленного шпионажа, \r\n                       а сосредоточусь на исследовании сайтов, то есть тех моментов, \r\n                       которые нам нужны для последующего проектирования.!', '9', '123.43.31.12');
INSERT INTO `response` VALUES ('5', '22', '38', '2014-11-14', 'Только слова благодарности и восхищения таким педагогом и вообще человеком!\r\n                                 С Александрой  знакома через ее сайт <<Учитель мистецтва>>.  Столько высококлассных \r\n                                 работ я в сети еще не встречала!', '9', '123.44.31.12');
INSERT INTO `response` VALUES ('6', '1', '38', '2014-11-14', 'Весьма важный этап, учитывая огромную конкуренцию на рынке.\r\n                                Тут, конечно, более важно узнать бизнес-процессы конкурентов, но и\r\n                                проанализировать сайты компаний, с которыми предстоит конкурировать \r\n                                на рынке интернет-торговли будет очень кстати. Так как мы говорим тут\r\n                                о проектировании, я не буду углубляться в сферу промышленного шпионажа, \r\n                                а сосредоточусь на исследовании сайтов, то есть тех моментов, которые \r\n                                нам нужны для последующего проектирования.!', '10', '123.43.31.12');

-- ----------------------------
-- Table structure for `settings`
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(64) NOT NULL DEFAULT 'system',
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_key` (`category`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of settings
-- ----------------------------

-- ----------------------------
-- Table structure for `sourcemessages`
-- ----------------------------
DROP TABLE IF EXISTS `sourcemessages`;
CREATE TABLE `sourcemessages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category` varchar(32) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=229 DEFAULT CHARSET=utf8 COMMENT='Table for interface messages (keys).';

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
INSERT INTO `step` VALUES ('1', 'UA', 'крок', '1', 'Реєстрація на сайті', '/css/images/', 'step1.jpg', 'Щоб отримати доступ до переліку курсів, модулів і занять та пройти безкоштовні модулі і заняття зареєструйся на сайті. Реєстрація дозволить тобі оцінити якість та зручність нашого продукт, який стане для тебе надійним партнером і порадником в професійній самореалізації.\r\n');
INSERT INTO `step` VALUES ('2', 'UA', 'крок', '2', 'Вибір курсу чи модуля', '/css/images/', 'step2.jpg', '<p>Щоб стати спеціалістом певного напрямку та рівня (отримати професійну спеціалізацію) вибери для проходження відповідний курс. Якщо Тебе цікавить виключно поглиблення знань в певному напрямку ІТ, то вибери відповідний модуль для проходження.</p>');
INSERT INTO `step` VALUES ('3', 'UA', 'крок', '3', 'Проплата', '/css/images/', 'step3.jpg', 'Щоб розпочати проходження курсу чи модуля вибери схему оплати (вся сума за курс, помісячно, потриместрово тощо) та здійсни оплату зручним Тобі способом (схему оплати курсу чи модуля можна змінювати, також можлива помісячна оплата в кредит).');
INSERT INTO `step` VALUES ('4', 'UA', 'крок', '4', 'Освоєння матеріалу', '/css/images/', 'step4.jpg', '<p>Вивчення матеріалу можливе шляхом читання тексту чи/і перегляду відео для кожного заняття.\n    Протягом освоєння матеріалу заняття виконуй Проміжні тестові завдання. По завершенню кожного заняття виконуй Підсумкове тестове завдання. Кожен модуль завершується Індивідуальним проектом чи Екзаменом.\n    Можна отримати індивідуальну консультацію викладача чи обговорити питання на форумі.</p>');
INSERT INTO `step` VALUES ('5', 'UA', 'крок', '5', 'Завершення курсу', '/css/images/', 'step5.jpg', 'Підсумком курсу є Командний дипломний проект, який виконується разом з іншими студентами (склад команди формуєш самостійно чи рекомендує керівник, який затверджує тему і технічне завдання проекту). Здача проекту передбачає передзахист та захист в он-лайн режимі із представленням технічної документації.');

-- ----------------------------
-- Table structure for `studentprofile`
-- ----------------------------
DROP TABLE IF EXISTS `studentprofile`;
CREATE TABLE `studentprofile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `secondName` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `birthday` varchar(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text,
  `education` varchar(255) DEFAULT NULL,
  `educform` varchar(60) DEFAULT NULL,
  `interests` text,
  `aboutUs` text,
  `aboutMy` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of studentprofile
-- ----------------------------
INSERT INTO `studentprofile` VALUES ('1', 'Воваgjhghjgfj', 'Джа', 'Марля', 'Wizlight', '21/03/1997', 'Wizlightdragon@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '+38(911)_______', 'Ямайка', 'ВДПУ', 'Онлайн', 'Ковбаска, колобки, раста', 'Інтернет', 'Володію албанською. Люблю м\'ясо та до м\'яса. Розвожу королів. ', '/css/images/1id.jpg', null);
INSERT INTO `studentprofile` VALUES ('2', 'uhg', null, '', '', '21/03/1997', 'Elfigo@mail.ru', '011c945f30ce2cbafc452f39840f025693339c42', '', 'Ямайка', '', 'Не вибрано', '', '', '', '/css/images/avatars/2id.jpg', '0');
INSERT INTO `studentprofile` VALUES ('4', 'Elfigo@mail.ru', null, null, null, null, 'Elfigod@mail.ru', '011c945f30ce2cbafc452f39840f025693339c42', null, null, null, null, null, null, null, null, null);
INSERT INTO `studentprofile` VALUES ('5', 'Wizlightdr@gmail.com', null, null, null, null, 'Wizlightdr@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', null, null, null, null, null, null, null, null, null);
INSERT INTO `studentprofile` VALUES ('6', 'Wizlight@gmail.com', null, null, null, null, 'Wizlight@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', null, null, null, null, null, null, null, null, null);
INSERT INTO `studentprofile` VALUES ('7', 'Wiz@gmail.com', null, null, null, null, 'Wiz@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', null, null, null, null, null, null, null, '/css/images/avatars/noname.png', null);

-- ----------------------------
-- Table structure for `students`
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(35) NOT NULL,
  `middle_name` varchar(35) NOT NULL,
  `last_name` varchar(35) NOT NULL,
  `login` varchar(50) NOT NULL,
  `phone` int(13) NOT NULL,
  `education` varchar(255) NOT NULL,
  `about_myself` varchar(255) NOT NULL,
  `interests` varchar(255) NOT NULL,
  `certificates` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_repeat` varchar(50) NOT NULL,
  `note` varchar(255) NOT NULL,
  `email` varchar(35) NOT NULL,
  `address` varchar(150) NOT NULL,
  `birthday` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `date_joined` date NOT NULL,
  `country` varchar(50) NOT NULL,
  `timezome` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of students
-- ----------------------------

-- ----------------------------
-- Table structure for `studentsaccess`
-- ----------------------------
DROP TABLE IF EXISTS `studentsaccess`;
CREATE TABLE `studentsaccess` (
  `accessID` int(11) NOT NULL AUTO_INCREMENT,
  `studentID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  `moduleID` int(11) NOT NULL,
  `lectureID` int(11) NOT NULL,
  `dateChange` date NOT NULL,
  PRIMARY KEY (`accessID`),
  KEY `FK_courseaccess_students` (`studentID`),
  KEY `FK_studentsaccess_course` (`courseID`),
  KEY `FK_studentsaccess_lectures` (`lectureID`),
  KEY `FK_studentsaccess_modules` (`moduleID`),
  CONSTRAINT `FK_studentsaccess_course` FOREIGN KEY (`courseID`) REFERENCES `course` (`course_ID`),
  CONSTRAINT `FK_studentsaccess_lectures` FOREIGN KEY (`lectureID`) REFERENCES `lecture` (`id`),
  CONSTRAINT `FK_studentsaccess_modules` FOREIGN KEY (`moduleID`) REFERENCES `module` (`module_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of studentsaccess
-- ----------------------------

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
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teacher
-- ----------------------------
INSERT INTO `teacher` VALUES ('1', 'UA', 'Олександра', 'Василівна', 'Сіра', '/css/images/teacher1.jpg', 'кройка и шитье сроков; програмування самоубийств', ' Народилася і виросла в Сакраменто, у 18 років вона переїхала до Лос-Анджелеса й незабаром стала \r\n                                викладачем. У 2007, 2008 і 2010 рр.. вона виграла кілька номінацій премії AVN Awards \r\n                                (також була названа «Найкращою програмісткою» у 2007 році за версією XRCO). \r\n                                Паралельно з вікладауцью роботою та роботою програміста в Саша Грей грає головну роль в тестванні Інтернету.</br>\r\n                                Марина Енн Генціс народилася у родині механіка. Її батько мав грецьке походження.\r\n                                Батьки дівчинки розлучилися коли їй було 5 років, надалі її виховувала мати, яка вступила \r\n                                в повторний шлюб у 2000 роц. Марина не ладнала з вітчимом, і, коли їй виповнилося 16 років, \r\n                                дівчина повідомила матері, що збирається покинути будинок. Достеменно невідомо, втекла вона з свого \r\n                    будинку або ж її відпустила мати. Сама Олександра пізніше зізнавалася, що в той час робила все те, \r\n                    що не подобалося її батькам і що вони їй забороняли.</br>\r\n                    Главный бухгалтер акционерного предприятия, специализирующегося на:\r\n                    <ul>\r\n                    <li>оказании полезных услуг горизонтального характера;</li>\r\n                    <li>торговле, внешнеэкономической и внутреннеэкономической;</li>\r\n                    <li>позитивное обучение швейного мастерства;</li></ul>', '<p>Профессиональный преподаватель бухгалтерского и налогового учета Национальноготранспортного университета кафедры финансов, учета и аудита со стажем преподавательской работы более 25 лет. Закончила аспирантуру, автор 36 научных работ в области учета и аудита, в т.ч. уникальной обучающей методики написания бухгалтерских проводок: <span>\"Как украсть и не сесть\" </span> и <span>\"Как украсть и посадить другого\" </span>.</p><p>Главный бухгалтер акционерного предприятия, специализирующегося на:<ul><li>оказании полезных услуг горизонтального характера;</li><li>торговле, внешнеэкономической и внутреннеэкономической;</li><li>позитивное обучение швейного мастерства;</li></ul></p>', 'Олександра Сіра виконала головну роль у фільмі оскароносного режисера \r\n                        Стівена Содерберга «Дівчина за викликом»[27][28]. Олександра грає дівчину на ім\'я Челсі, яка надає \r\n                        ескорт послуги заможним людям. Содерберг взяв її на роль після того, як прочитав статтю про неї у \r\n                        журналі Los Angeles, коментуючи це так: «She\'s kind of a new breed, I think. She doesn\'t really fit \r\n                        the typical mold of someone who goes into the adult film business. … I\'d never heard anybody talk \r\n                        about the business the way that she talked about it». Журналіст Скотт Маколей каже, що можливо \r\n                        Грей вибрала саме цю роль через свій інтерес до незалежних режисерів, таких як Жан-Люк Годар, \r\n                        Хармоні Корін, Девід Гордон Грін, Мікеланджело Антоніоні, Аньєс Варда та Вільям Клейн.\r\n                        </br>Коли Олександра  готувалася до ролі у «Дівчині за викликом», \r\n                        Содерберг попросив її подивитися «Жити своїм життям» і «Божевільний П\'єро»[29]. \r\n                        У фільмі «Жити своїм життям» піднімаються проблеми проституції, звідки Грей могла \r\n                        взяти щось і для своєї ролі, в той час як у «Божевільному П\'єро» показані відносини, \r\n                        схожі на ті, що відбуваються між Челсі, її хлопцем і клієнтами.', '/profile', '', '', '', '', '', '/css/images/teacherImage.png', '12', '12', '12', 'Програмування ПХП;\r\nJava для IOS;', '0');
INSERT INTO `teacher` VALUES ('2', 'UA', 'Константин', 'Константинович', 'Константинопольский', '/css/images/teacher2.jpg', 'программування БДСМ; программування на Php для пострадавших в ЧАЭС; GlobalLoqic, Samsung, Coqniance', '', '<p>Консультант по вопросам бухгалтерского и налогового учета, отчетности для предприятий разной формы собственности. Преподаватель с многолетним стажем работы. <span>Реально шарит в компьютерах.</span></p><p>Автор технологии повышения квалификации специалистов экономического профиля.</p><p>Опыт преподавательской работы около 20 лет в учебных центрах и ВУЗах Киева. Опыт работы главным бухгалтером, финансовым директором. Большой опыт внедрения программ системы Виндовз 3:11.</p>', '', '/profile', '', '', '', '', '', '/css/images/teacherImage.png', '10', '10', '10', 'Програмування ПХП;\r\nJava для IOS;', '0');
INSERT INTO `teacher` VALUES ('3', 'UA', 'Любовь', 'Анатольевна', 'Ктоятакая-Замухриншская', '/css/images/teacher3.jpg', 'Бухгалтер с «О» и до первой отсидки; Программирование своего позитивного прошлого', '', '<p>Практикующий главный бухгалтер. Учредитель ПП <span>«Логика тут безсильна»</span>;</p>\r\n<p>Образование высшее - ДонГУ (1987г.)</p>\r\n<p>Опыт работы 27 лет, в т. ч. преподавания - 9 лет.</p>\r\n<ul><li>специалист по позитивной энергетике;</li><li>эксперт по эффективному ремонту баянов;</li><li>мастер психотерапии для сложных бабушек и дедушек;</li></ul>', '', '/profile', '', '', '', '', '', '/css/images/teacherImage.png', '11', '11', '11', 'Програмування ПХП;\r\nJava для IOS;', '0');
INSERT INTO `teacher` VALUES ('4', 'UA', 'Василий', 'Васильевич', 'Меняетпроффесию', '/css/images/teacher4.jpg', 'программування БДСМ; программування на Php для пострадавших в ЧАЭС; GlobalLoqic, Samsung, Coqniance', '', '<p>Консультант по вопросам бухгалтерского и налогового учета, отчетности для предприятий разной формы собственности. Преподаватель с многолетним стажем работы. <span>Реально шарит в компьютерах.</span></p><p>Автор технологии повышения квалификации специалистов экономического профиля.</p><p>Опыт преподавательской работы около 20 лет в учебных центрах и ВУЗах Киева. Опыт работы главным бухгалтером, финансовым директором. Большой опыт внедрения программ системы Виндовз 3:11.</p>', '', '/profile', '', '', '', '', '', '/css/images/teacherImage.png', '9', '9', '9', 'Програмування ПХП;\r\nJava для IOS;', '0');
INSERT INTO `teacher` VALUES ('5', 'UA', 'Ия', 'Тожевна', 'Воваяготова', '/css/images/teacher5.jpg', 'программування БДСМ; программування на Php для пострадавших в ЧАЭС; GlobalLoqic, Samsung, Coqniance', '', '<p>Консультант по вопросам бухгалтерского и налогового учета, отчетности для предприятий разной формы собственности. Преподаватель с многолетним стажем работы. <span>Реально шарит в компьютерах.</span></p><p>Автор технологии повышения квалификации специалистов экономического профиля.</p><p>Опыт преподавательской работы около 20 лет в учебных центрах и ВУЗах Киева. Опыт работы главным бухгалтером, финансовым директором. Большой опыт внедрения программ системы Виндовз 3:11.</p>', '', '/profile', '', '', '', '', '', '/css/images/teacherImage.png', '10', '10', '10', 'Програмування ПХП;\r\nJava для IOS;', '0');
INSERT INTO `teacher` VALUES ('6', 'UA', 'Петросян', 'Петросянович', 'Забугорный', '/css/images/teacher6.jpg', 'программування БДСМ; программування на Php для пострадавших в ЧАЭС; GlobalLoqic, Samsung, Coqniance', '', '<p>Консультант по вопросам бухгалтерского и налогового учета, отчетности для предприятий разной формы собственности. Преподаватель с многолетним стажем работы. <span>Реально шарит в компьютерах.</span></p><p>Автор технологии повышения квалификации специалистов экономического профиля.</p><p>Опыт преподавательской работы около 20 лет в учебных центрах и ВУЗах Киева. Опыт работы главным бухгалтером, финансовым директором. Большой опыт внедрения программ системы Виндовз 3:11.</p>', '', '/profile', '', '', '', '', '', '/css/images/teacherImage.png', '11', '11', '11', 'Програмування ПХП;\r\nJava для IOS;', '0');

-- ----------------------------
-- Table structure for `teachers`
-- ----------------------------
DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers` (
  `teacherID` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_title` int(11) NOT NULL DEFAULT '0',
  `linkName` int(11) NOT NULL DEFAULT '0',
  `firstName` varchar(35) NOT NULL,
  `middleName` varchar(35) NOT NULL,
  `lastName` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  `fotoURL` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `coursesArray` varchar(255) NOT NULL,
  `skype` varchar(100) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `gender` int(11) NOT NULL DEFAULT '0',
  `dateOfBirth` int(11) NOT NULL DEFAULT '0',
  `subjects` varchar(50) NOT NULL DEFAULT '0',
  `jobTitle` varchar(50) NOT NULL DEFAULT '0',
  `education` varchar(100) NOT NULL DEFAULT '0',
  `degree` varchar(50) NOT NULL DEFAULT '0',
  `articles` text NOT NULL,
  `otherTeacherDetailes` text NOT NULL,
  PRIMARY KEY (`teacherID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teachers
-- ----------------------------

-- ----------------------------
-- Table structure for `teacherspage`
-- ----------------------------
DROP TABLE IF EXISTS `teacherspage`;
CREATE TABLE `teacherspage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(6) NOT NULL,
  `header` varchar(50) NOT NULL,
  `courses` varchar(50) NOT NULL,
  `link1` varchar(100) NOT NULL,
  `link2` varchar(100) NOT NULL,
  `BCmain` varchar(30) NOT NULL,
  `BCteachers` varchar(30) NOT NULL,
  `title` varchar(50) NOT NULL,
  `profile` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teacherspage
-- ----------------------------
INSERT INTO `teacherspage` VALUES ('1', 'UA', 'Our teachers', 'Веде курси:', 'Читати повністю', 'Відгуки про викладача', 'Головна', 'Викладачі', 'ІНТІТА - Викладачі', 'Персональна сторінка');
INSERT INTO `teacherspage` VALUES ('2', 'RU', 'Наши преподаватели', 'Ведет курсы:', 'Читать полностью', 'Отзывы о преподавателе', 'Главная', 'Преподаватели', 'ИНТИТА - Преподаватели', 'Персональная страница');

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
-- Table structure for `team`
-- ----------------------------
DROP TABLE IF EXISTS `team`;
CREATE TABLE `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `post` varchar(64) DEFAULT NULL,
  `pic` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of team
-- ----------------------------
INSERT INTO `team` VALUES ('1', 'Кузнецов  Андрей  Сергеевич', 'слесарь', '541dff9af18fe.jpg');
INSERT INTO `team` VALUES ('2', 'Квентин', 'сантехник', '541dffd7e4f9f.jpg');
INSERT INTO `team` VALUES ('3', 'Арни', 'электрик', '541e015b628be.jpg');
INSERT INTO `team` VALUES ('4', 'Аврил', 'пост', '541e01d395797.jpg');
INSERT INTO `team` VALUES ('5', 'Бриттани Мерфи', 'пост', '541e01ecd43b2.jpg');

-- ----------------------------
-- Table structure for `tests`
-- ----------------------------
DROP TABLE IF EXISTS `tests`;
CREATE TABLE `tests` (
  `test_ID` int(11) NOT NULL AUTO_INCREMENT,
  `fkmodule_ID` int(11) NOT NULL,
  `fklecture_ID` int(11) NOT NULL,
  `test_title` varchar(45) NOT NULL,
  `test_description` varchar(45) NOT NULL,
  `test_url` varchar(45) NOT NULL,
  PRIMARY KEY (`test_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tests
-- ----------------------------
INSERT INTO `tests` VALUES ('1', '2', '2', 'Test 2', 'Description 2', 'URL 2');
INSERT INTO `tests` VALUES ('2', '3', '3', 'Test 3', 'Description 3', 'URL 3');

-- ----------------------------
-- Table structure for `theoreticalsmaterials`
-- ----------------------------
DROP TABLE IF EXISTS `theoreticalsmaterials`;
CREATE TABLE `theoreticalsmaterials` (
  `tm_ID` int(11) NOT NULL AUTO_INCREMENT,
  `fkmodule_ID` int(11) NOT NULL,
  `fklecture_ID` int(11) NOT NULL,
  `TM_name` varchar(45) NOT NULL,
  `TM_description` varchar(45) NOT NULL,
  `TM_url` varchar(255) NOT NULL,
  PRIMARY KEY (`tm_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of theoreticalsmaterials
-- ----------------------------
INSERT INTO `theoreticalsmaterials` VALUES ('1', '1', '1', 'TM 1', 'Description 1', 'URL 1');
INSERT INTO `theoreticalsmaterials` VALUES ('2', '2', '2', 'TM 2', 'Description 2', 'URL 2');

-- ----------------------------
-- Table structure for `timeconsultation`
-- ----------------------------
DROP TABLE IF EXISTS `timeconsultation`;
CREATE TABLE `timeconsultation` (
  `time1` time DEFAULT NULL,
  `time2` time DEFAULT NULL,
  `time3` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of timeconsultation
-- ----------------------------
INSERT INTO `timeconsultation` VALUES ('09:00:00', '09:20:00', '09:40:00');
INSERT INTO `timeconsultation` VALUES ('10:00:00', '10:20:00', '10:40:00');
INSERT INTO `timeconsultation` VALUES ('11:00:00', '11:20:00', '11:40:00');
INSERT INTO `timeconsultation` VALUES ('12:00:00', '12:20:00', '12:40:00');
INSERT INTO `timeconsultation` VALUES ('13:00:00', '13:20:00', '13:40:00');
INSERT INTO `timeconsultation` VALUES ('14:00:00', '14:20:00', '14:40:00');
INSERT INTO `timeconsultation` VALUES ('15:00:00', '15:20:00', '15:40:00');
INSERT INTO `timeconsultation` VALUES ('16:00:00', '16:20:00', '16:40:00');
INSERT INTO `timeconsultation` VALUES ('17:00:00', '17:20:00', '17:40:00');
INSERT INTO `timeconsultation` VALUES ('18:00:00', '18:20:00', '18:40:00');
INSERT INTO `timeconsultation` VALUES ('19:00:00', '19:20:00', '19:40:00');
INSERT INTO `timeconsultation` VALUES ('20:00:00', '20:20:00', '20:40:00');
INSERT INTO `timeconsultation` VALUES ('21:00:00', '21:20:00', '21:40:00');
INSERT INTO `timeconsultation` VALUES ('22:00:00', '22:20:00', '22:40:00');

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
-- Table structure for `typeresource`
-- ----------------------------
DROP TABLE IF EXISTS `typeresource`;
CREATE TABLE `typeresource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of typeresource
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `identity` varchar(255) NOT NULL,
  `network` varchar(255) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `secondName` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `birthday` varchar(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `hash` varchar(20) NOT NULL,
  `address` text,
  `education` varchar(255) DEFAULT NULL,
  `educform` varchar(60) DEFAULT 'Не вибрано',
  `interests` text,
  `aboutUs` text,
  `aboutMy` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT '/avatars/noname.png',
  `role` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'Вова', '', '', '0', '', 'Джа', 'Марля', 'Wizlight', '13/12/1906', 'Wizlightdragon@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '+38(911)_______', '', '', 'ВДПУ', 'Онлайн', 'Ковбаска, колобки, раста', '', 'Володію албанською. Люблю м\'ясо та до м\'яса. Розвожу королів. ', '/css/images/1id.jpg', '0');
INSERT INTO `user` VALUES ('11', 'ivanna@yutr.rtr', '', '', '0', '', null, '', '', '', 'ivanna@yutr.rtr', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', null, '', '', '', '/avatars/ivanna@yutr.rtr.jpg', '0');
INSERT INTO `user` VALUES ('22', 'tttttt', '', '', '0', '', null, '', '', '', 'ttttt@tttt.com', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', 'Не вибрано', '', '', '', '/avatars/ttttt@tttt.com.jpg', '0');
INSERT INTO `user` VALUES ('38', '', '', '', '0', '', null, null, null, null, 'teacher1@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', null, '', null, null, 'Не вибрано', null, null, null, '/avatars/noname.png', '0');
INSERT INTO `user` VALUES ('39', '', '', '', '0', '', null, null, null, null, 'teacher2@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', null, '', null, null, 'Не вибрано', null, null, null, '/avatars/noname.png', '0');
INSERT INTO `user` VALUES ('40', 'HALA', '', '', '0', '', null, null, null, null, 'teacher3@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', null, '', null, null, 'Не вибрано', null, null, null, '/avatars/noname.png', '0');
INSERT INTO `user` VALUES ('41', 'vOVA', '', '', '0', '', null, null, null, null, 'teacher4@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', null, '', null, null, 'Не вибрано', null, null, null, '/avatars/noname.png', '0');
INSERT INTO `user` VALUES ('42', 'kOLA', '', '', '0', '', null, null, null, null, 'teacher5@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', null, '', null, null, 'Не вибрано', null, null, null, '/avatars/noname.png', '0');
INSERT INTO `user` VALUES ('43', 'rOLA', '', '', '0', '', null, null, null, null, 'teacher6@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', null, '', null, null, 'Не вибрано', null, null, null, '/avatars/noname.png', '0');
INSERT INTO `user` VALUES ('44', 'Игорок', '', '', '0', '', null, 'Колобок', '', '', 'Wizlight@rambler.ru', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', 'Не вибрано', '', '', '', '/avatars/noname.png', '0');
INSERT INTO `user` VALUES ('45', 'Hello', '', '', '0', '', null, '', '', '', 'Gogo@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', 'Онлайн', '', '', '', '/avatars/553f3574f0915.jpg', '0');
INSERT INTO `user` VALUES ('46', 'Hello', '', '', '0', '', null, '', '', '', 'Gogo1@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', '', 'Онлайн/Офлайн', '', '', '', '/avatars/noname.png', '0');

-- ----------------------------
-- Table structure for `videos`
-- ----------------------------
DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `video_ID` int(11) NOT NULL AUTO_INCREMENT,
  `fkmodule_ID` int(11) NOT NULL,
  `fklecture_ID` int(11) NOT NULL,
  `video_name` varchar(45) NOT NULL,
  `video_description` varchar(45) NOT NULL,
  `video_url` varchar(45) NOT NULL,
  `video_durationin_seconds` int(11) NOT NULL,
  PRIMARY KEY (`video_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of videos
-- ----------------------------
INSERT INTO `videos` VALUES ('1', '1', '1', 'Video 1', 'Description 1', 'URL 1', '344');
