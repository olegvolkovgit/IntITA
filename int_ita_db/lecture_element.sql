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

-- Dumping structure for table int_ita_db.lecture_element
DROP TABLE IF EXISTS `lecture_element`;
CREATE TABLE IF NOT EXISTS `lecture_element` (
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

-- Dumping data for table int_ita_db.lecture_element: ~27 rows (approximately)
/*!40000 ALTER TABLE `lecture_element` DISABLE KEYS */;
INSERT INTO `lecture_element` (`id_lecture`, `block_order`, `type`, `id_type`, `html_block`) VALUES
	(1, 1, 'text', 1, '    <h1 class="lessonPart">Вступ</h1>\r\n    <span class="colorBlack">Змінна</span> - це літерно-символьне подання частини інформації, яка перебуває в памяті Web-сервера. В php змінна виглядає ось так:\r\n    \r\n   '),
	(1, 2, 'code', 4, '<p><span class="colorGreen">$</span>names=<span class="colorO">"Я інформація в памяті тчк"</span>;</p>'),
	(1, 3, 'text', 1, ' <span class="colorBlack">Імена змінних</span>\r\n    <p>Будь-яка змінна в РНР має ім\'я, що починається із знаку $, наприклад Svariable. При такому способі формування імен змінних їх дуже легко відрізнити від іншого коду. Якщо в інших мовах інколи може виникати плутанина з тим, що при першому погляді на код не завжди ясно - де тут змінні, а де функції, то в РНР це питання навіть не постає. Наприклад, ссилка на змінну по її імені, що зберігається в іншій змінній:</p>'),
	(1, 4, 'video', 2, '<iframe width="633" height="390" src="https://www.youtube.com/embed/L3Mg6lk6yyA" frameborder="0" allowfullscreen></iframe>'),
	(1, 5, 'label', 8, '    <a name="Частина 1: Типи змінних та перемінних"></a>'),
	(1, 6, 'text', 1, '    <h1 class="lessonPart">Частина 1: Типи змінних та перемінних</h1>\r\n    <span class="colorBlack">Змінна</span> - це літерно-символьне подання частини інформації, яка перебуває в памяті Web-сервера. В php змінна виглядає ось так:'),
	(1, 7, 'code', 4, '<p><span class="colorGreen">$</span>names=<span class="colorO">"Я інформація в памяті тчк"</span>;</p>'),
	(1, 8, 'text', 1, '    <span class="colorBlack">Імена змінних</span>\r\n    <p>Будь-яка змінна в РНР має ім\'я, що починається із знаку $, наприклад Svariable. При такому способі формування \r\n        імен змінних їх дуже легко відрізнити від іншого коду. Якщо в інших мовах інколи може виникати плутанина з тим,\r\n        що при першому погляді на код не завжди ясно - де тут змінні, а де функції, то в РНР це питання навіть не постає. \r\n        Наприклад, ссилка на змінну по її імені, що зберігається в іншій змінній:</p>'),
	(1, 9, 'code', 4, '\r\n        <p>$names="value";</p>\r\n        <p>$names=5;</p>\r\n        <p>echo $$name;</p>\r\n'),
	(1, 10, 'text', 1, '    <p>Змінні в РНР представляються у вигляді рядка, що починається знаком долара, а за ним слідує ім\'я змінної. Ім\'я змінної може складатися з латинських літер, звичайних цифр і деяких символів або комбінацій літер, цифр і символів.</p>'),
	(1, 11, 'example', 3, '<span class="subChapter">Зразок коду 1:</span>\r\n<pre class="prettyprint linenums">\r\n&lt;html&gt;\r\n  &lt;head&gt;\r\n  &lt;/head&gt;\r\n  &lt;body&gt;\r\n    &lt;p&gt;\r\n      &lt;?php\r\n      $items= //Set this to a number greater than 5! Type the string &quot;Arr, matey!&quot;\r\n\r\n      if ($items&lt;5) {\r\n      echo &quot;You get a 10% discount!&quot;;\r\n      }\r\n    ?&gt;\r\n    &lt;/p&gt;\r\n &lt;/body&gt;\r\n&lt;/html&gt;\r\n</pre>'),
	(1, 12, 'example', 3, '<span class="subChapter">Зразок коду 2  </span><span class="spoilerLinks"><span class="spoilerClick">(показати)</span><span class="spoilerTriangle"> &#9660;</span></span>'),
	(1, 13, 'video', 2, '<h3><span class="subChapter">Відео 1.</span></h3>\r\n    <iframe width="633" height="390" src="https://www.youtube.com/embed/L3Mg6lk6yyA" frameborder="0" allowfullscreen></iframe>'),
	(1, 14, 'instruction', 7, '<li>On line 7, set <span class="colorBP"><span class="colorGreen">$</span>terms</span> equal to a number greater than 5. Make sure to put a semicolon at the end of the line.</li>\r\n                <li>On line 9, edit the state condition so that your program will be out Some expressions return a \' logical value": TRUE or FALSE, text like thise:<span class="colorAlert">You get a 10% discount!</span></li>'),
	(1, 15, 'task', 5, '<li>On line 7, set equal to a number greater than 5. Some expressions return a "logical value": TRUE or FALSE. Make sure to put a semicolon at the end of the line.</li>\r\n                    <a href="#"> <span class="colorP"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/arrow.png"> Відповісти</span></a>\r\n                    <li>An if statement is made up of the if keyword, a condition like we\'ve seen before <span class="colorBP"><span class="colorGreen">$</span>terms</span>, and a pair of curly braces <span class="colorBP">{}</span>. If the answer to the condition is yes, the code inside the curly will run.</li>\r\n                    <a href="#"><span class="colorP"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/arrow.png"> Відповісти</span></a>\r\n                    <li>Резиновая по ширине (изменяется с Some expressions return a "logical value": TRUE or FALSE, изменением окна <span class="colorBP"><span class="colorGreen">$</span>terms</span> браузера или с разрешением экрана)</li>'),
	(1, 16, 'label', 8, '    <a name="Частина 7: Типи данних та математичний аналіз"></a>\r\n    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/borderLesson.png">'),
	(1, 17, 'text', 1, '<span class="colorBlack">Змінна</span> - це літерно-символьне подання частини інформації, яка перебуває в памяті Web-сервера. В php змінна виглядає ось так:'),
	(1, 18, 'code', 4, '<p><span class="colorGreen">$</span>names=<span class="colorO">"Я інформація в памяті тчк"</span>;</p>'),
	(1, 19, 'text', 1, '    <span class="colorBlack">Імена змінних</span>\r\n    <p>Будь-яка змінна в РНР має ім\'я, що починається із знаку $, наприклад Svariable. При такому способі формування імен змінних їх дуже легко відрізнити від іншого коду. Якщо в інших мовах інколи може виникати плутанина з тим, що при першому погляді на код не завжди ясно - де тут змінні, а де функції, то в РНР це питання навіть не постає. Наприклад, ссилка на змінну по її імені, що зберігається в іншій змінній:</p>'),
	(1, 20, 'code', 4, '        <p>$names="value";</p>\r\n        <p>$names=5;</p>\r\n        <p>echo $$name;</p>\r\n'),
	(1, 21, 'text', 1, '    <p>Змінні в РНР представляються у вигляді рядка, що починається знаком долара, а за ним слідує ім\'я змінної. Ім\'я змінної може складатися з латинських літер, звичайних цифр і деяких символів або комбінацій літер, цифр і символів.</p>'),
	(1, 22, 'example', 3, '<span class="subChapter">Зразок коду 1:</span>\r\n<pre class="prettyprint linenums">\r\n&lt;html&gt;\r\n  &lt;head&gt;\r\n  &lt;/head&gt;\r\n  &lt;body&gt;\r\n    &lt;p&gt;\r\n      &lt;?php\r\n      $items= //Set this to a number greater than 5! Type the string &quot;Arr, matey!&quot;\r\n\r\n      if ($items&lt;5) {\r\n      echo &quot;You get a 10% discount!&quot;;\r\n      }\r\n    ?&gt;\r\n    &lt;/p&gt;\r\n &lt;/body&gt;\r\n&lt;/html&gt;\r\n</pre>'),
	(1, 23, 'example', 3, '    <span class="subChapter"><?php echo Yii::t(\'lecture\',\'Code example\'); ?> 2  </span><span class="spoilerLinks"><span class="spoilerClick">(показати)</span><span class="spoilerTriangle"> &#9660;</span></span>\r\n    <div class="spoilerBody">\r\n<pre class="prettyprint linenums">\r\n&lt;html&gt;\r\n  &lt;head&gt;\r\n  &lt;/head&gt;\r\n  &lt;body&gt;\r\n    &lt;p&gt;\r\n      &lt;?php\r\n      $items= //Set this to a number greater than 5! Type the string &quot;Arr, matey!&quot;\r\n\r\n      if ($items&lt;5) {\r\n      echo &quot;You get a 10% discount!&quot;;\r\n      }\r\n    ?&gt;\r\n    &lt;/p&gt;\r\n &lt;/body&gt;\r\n&lt;/html&gt;\r\n</pre>\r\n    </div>'),
	(1, 24, 'video', 2, '<h3><span class="subChapter"><?php echo Yii::t(\'lecture\',\'0083\'); ?> 1.</span></h3>\r\n    <iframe width="633" height="390" src="https://www.youtube.com/embed/L3Mg6lk6yyA" frameborder="0" allowfullscreen></iframe>'),
	(1, 25, 'instruction', 7, '<li>On line 7, set <span class="colorBP"><span class="colorGreen">$</span>terms</span> equal to a number greater than 5. Make sure to put a semicolon at the end of the line.</li>\r\n                <li>On line 9, edit the state condition so that your program will be out Some expressions return a \' logical value": TRUE or FALSE, text like thise:<span class="colorAlert">You get a 10% discount!</span></li>'),
	(1, 26, 'task', 5, '<li>On line 7, set equal to a number greater than 5. Some expressions return a "logical value": TRUE or FALSE. Make sure to put a semicolon at the end of the line.</li>\r\n                <a href="#"> <span class="colorP"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/arrow.png"> Відповісти</span></a>\r\n                <li>An if statement is made up of the if keyword, a condition like we\'ve seen before <span class="colorBP"><span class="colorGreen">$</span>terms</span>, and a pair of curly braces <span class="colorBP">{}</span>. If the answer to the condition is yes, the code inside the curly will run.</li>\r\n                <a href="#"><span class="colorP"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/arrow.png"> Відповісти</span></a>\r\n                <li>Резиновая по ширине (изменяется с Some expressions return a "logical value": TRUE or FALSE, изменением окна <span class="colorBP"><span class="colorGreen">$</span>terms</span> браузера или с разрешением экрана)</li>'),
	(1, 27, 'final task', 6, ' <li>On line 7, set equal to a number greater than 5. Some expressions return a "logical value": TRUE or FALSE. Make sure to put a semicolon at the end of the line.</li>\r\n                <a href="#"> <span class="colorP"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/arrow.png"> Відповісти</span></a>\r\n                <li>An if statement is made up of the if keyword, a condition like we\'ve seen before <span class="colorBP">$terms</span>, and a pair of curly braces <span class="colorBP">{}</span>. If the answer to the condition is yes, the code inside the curly will run.</li>\r\n                <a href="#"><span class="colorP"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/arrow.png"> Відповісти</span></a>\r\n                <li>Резиновая по ширине (изменяется с Some expressions return a "logical value": TRUE or FALSE, изменением окна <span class="colorBP">$terms</span> браузера или с разрешением экрана)</li>');
/*!40000 ALTER TABLE `lecture_element` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
