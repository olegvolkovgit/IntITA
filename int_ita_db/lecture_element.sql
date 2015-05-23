-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 23 2015 г., 15:36
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.4.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `int_ita_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lecture_element`
--

CREATE TABLE IF NOT EXISTS `lecture_element` (
  `id_block` int(11) NOT NULL AUTO_INCREMENT,
  `id_lecture` int(11) NOT NULL,
  `block_order` int(11) NOT NULL,
  `type` varchar(15) NOT NULL,
  `id_type` tinyint(4) NOT NULL,
  `html_block` text NOT NULL,
  PRIMARY KEY (`id_block`),
  KEY `FK_lecture_element_element_type` (`id_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Chapters and other lecture''s resources ' AUTO_INCREMENT=30 ;

--
-- Дамп данных таблицы `lecture_element`
--

INSERT INTO `lecture_element` (`id_block`, `id_lecture`, `block_order`, `type`, `id_type`, `html_block`) VALUES
(9, 1, 1, 'video', 2, 'https://www.youtube.com/embed/L3Mg6lk6yyA'),
(10, 1, 2, 'instruction', 7, '<li>On line 7, set <span class="colorBP"><span class="colorGreen">$</span>terms</span> equal to a number greater than 5. Make sure to put a semicolon at the end of the line.</li>\r\n                <li>On line 9, edit the state condition so that your program will be out Some expressions return a '' logical value": TRUE or FALSE, text like thise:<span class="colorAlert">You get a 10% discount!</span></li>'),
(13, 1, 3, 'text', 1, '<p><span class="colorBlack">Імена змінних</span>\n</p>\n<p>Будь-яка змінна в РНР має ім''я, що починається із знаку $, наприклад Svariable. При такому способі формування імен змінних їх дуже легко відрізнити від іншого коду. Якщо в інших мовах інколи може виникати плутанина з тим, що при першому погляді на код не завжди ясно - де тут змінні, а де функції, то в РНР це питання навіть не постає. Наприклад, ссилка на змінну по її імені, що зберігається в іншій змінній:\n</p>'),
(18, 1, 4, 'instruction', 7, '<li>On line 7, set <span class="colorBP"><span class="colorGreen">$</span>terms</span> equal to a number greater than 5. Make sure to put a semicolon at the end of the line.</li>\r\n                <li>On line 9, edit the state condition so that your program will be out Some expressions return a '' logical value": TRUE or FALSE, text like thise:<span class="colorAlert">You get a 10% discount!</span></li>'),
(19, 1, 5, 'video', 2, 'https://www.youtube.com/embed/L3Mg6lk6yyA'),
(21, 2, 1, 'text', 1, '<p><span class="colorBlack">Імена змінних<em></em></span>\n	<strong><del><em></em></del></strong>\n</p>\n<p>Будь-яка змінна в РНР має ім''я, що починається із знаку $, наприклад Svariable. При такому способі формування імен змінних їх дуже легко відрізнити від іншого коду. Якщо в інших мовах інколи може виникати плутанина з тим, що при першому погляді на код не завжди ясно - де тут змінні, а де функції, то в РНР це питання навіть не постає. Наприклад, ссилка на змінну по її імені, що зберігається в іншій змінній:\n</p>'),
(22, 3, 1, 'text', 1, ' <span class="colorBlack">Імена змінних</span>\r\n    <p>Будь-яка змінна в РНР має ім''я, що починається із знаку $, наприклад Svariable. При такому способі формування імен змінних їх дуже легко відрізнити від іншого коду. Якщо в інших мовах інколи може виникати плутанина з тим, що при першому погляді на код не завжди ясно - де тут змінні, а де функції, то в РНР це питання навіть не постає. Наприклад, ссилка на змінну по її імені, що зберігається в іншій змінній:</p>'),
(23, 24, 1, 'text', 1, '<p>New text block!</p>'),
(24, 24, 2, 'text', 1, '<p><iframe width="420" height="315" src="https://www.youtube.com/embed/7KAhgrBDl3A" frameborder="0" allowfullscreen=""></iframe></p>'),
(25, 1, 6, 'text', 1, '<p>simple\r\n</p>'),
(26, 1, 7, 'text', 1, '<p>Add links. Example with "www" and "http"</p><p><a href="http://www.google.com">www.google.com</a></p><p><a href="http://google.com">http://google.com</a></p><p><br></p>'),
(27, 1, 8, 'text', 1, '<p>Add video. Example: ("<a href="http://www.youtube.com/watch?v=QlRGhXj0uRY">youtube.com/watch?v=QlRGhXj0uRY</a>")\r\n</p>\r\n<p>\r\n	<iframe width="500" height="281" src="//www.youtube.com/embed/QlRGhXj0uRY" frameborder="0" allowfullscreen="">\r\n	</iframe><span class="redactor-invisible-space"><br></span>\r\n</p>'),
(28, 1, 9, 'text', 1, '<p>Add picture. Example: "screensavergift.com/wp-content/uploads/BeautifulNature3-610x320.jpg"</p><p><img src="http://www.screensavergift.com/wp-content/uploads/BeautifulNature3-610x320.jpg"><span class="redactor-invisible-space"><br></span></p>'),
(29, 1, 10, 'text', 1, '<p>Add code. Example:</p><pre>&lt;div id="logo_img" class="down"&gt;<br> &lt;a href="&lt;?php echo Yii::app()-&gt;createUrl(''site/index'');?&gt;"&gt;<br> &lt;img id="logo" src="&lt;?php echo Yii::app()-&gt;request-&gt;baseUrl;?&gt;/css/images/Logo_small.png"/&gt;<br> &lt;/a&gt;<br>&lt;/div&gt;</pre>');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `lecture_element`
--
ALTER TABLE `lecture_element`
  ADD CONSTRAINT `FK_lecture_element_element_type` FOREIGN KEY (`id_type`) REFERENCES `element_type` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
