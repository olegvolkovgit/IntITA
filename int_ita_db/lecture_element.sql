-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-06-27 16:33:14
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table int_ita_db.lecture_element
DROP TABLE IF EXISTS `lecture_element`;
CREATE TABLE IF NOT EXISTS `lecture_element` (
  `id_block` int(11) NOT NULL AUTO_INCREMENT,
  `id_lecture` int(11) NOT NULL,
  `block_order` int(11) NOT NULL,
  `type` varchar(15) NOT NULL,
  `id_type` tinyint(4) NOT NULL,
  `html_block` text NOT NULL,
  PRIMARY KEY (`id_block`),
  KEY `FK_lecture_element_element_type` (`id_type`),
  CONSTRAINT `FK_lecture_element_element_type` FOREIGN KEY (`id_type`) REFERENCES `element_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 COMMENT='Chapters and other lecture''s resources ';

-- Dumping data for table int_ita_db.lecture_element: ~44 rows (approximately)
/*!40000 ALTER TABLE `lecture_element` DISABLE KEYS */;
INSERT INTO `lecture_element` (`id_block`, `id_lecture`, `block_order`, `type`, `id_type`, `html_block`) VALUES
	(9, 1, 1, 'video', 2, 'https://www.youtube.com/embed/L3Mg6lk6yyA'),
	(10, 1, 2, 'instruction', 7, '<ol>\n	<li>On line 7, set <span class="colorBP"><span class="colorGreen">$</span>ter<em>ms</em></span><em> equal to a number greater than 5. Make sure to put a semicolon at the end of the line.</em></li>\n	<li>On line 9, edit the state condition so that your program will be out Some expressions return a \' logical value": TRUE or FALSE, text like thise:<span class="colorAlert">You get a 10% discount!</span></li>\n</ol>'),
	(13, 1, 3, 'text', 1, '<p><span class="colorBlack">Імена змінних</span>\n</p>\n<p>Будь-яка змінна в РНР має ім\'я, що починається із знаку $, наприклад Svariable. При такому способі формування імен змінних їх дуже легко відрізнити від іншого коду. Якщо в інших мовах інколи може виникати плутанина з тим, що при першому погляді на код не завжди ясно - де тут змінні, а де функції, то в РНР це питання навіть не постає. Наприклад, ссилка на змінну по її імені, що зберігається в іншій змінній:\n</p>'),
	(18, 1, 4, 'task', 5, '<ol>\n	<ol>\n		<li><span style="background-color: rgb(255, 255, 0);">On <del>li</del>ne 7, set <span class="colorGreen">$</span>terms equal to a number greater than 5. Make sure to put a semicolon at the end of the line.</span></li>\n		<li><span style="background-color: rgb(255, 255, 0);">On line 9, edit the st<del>ate condition so that your program will be out Some expressions return a \' logical value": TRUE or FALSE, text like thise:</del></span><span style="background-color: rgb(255, 255, 0);">You get a 1</span>0% discount!</li>\n	</ol>\n</ol>'),
	(19, 1, 5, 'video', 2, 'https://www.youtube.com/embed/L3Mg6lk6yyA'),
	(21, 2, 1, 'text', 1, '<p><span class="colorBlack">Імена змінних<em></em></span>\n	<strong><del><em></em></del></strong>\n</p>\n<p>Будь-яка змінна в РНР має ім\'я, що починається із знаку $, наприклад Svariable. При такому способі формування імен змінних їх дуже легко відрізнити від іншого коду. Якщо в інших мовах інколи може виникати плутанина з тим, що при першому погляді на код не завжди ясно - де тут змінні, а де функції, то в РНР це питання навіть не постає. Наприклад, ссилка на змінну по її імені, що зберігається в іншій змінній:\n</p>'),
	(22, 3, 1, 'text', 1, ' <span class="colorBlack">Імена змінних</span>\r\n    <p>Будь-яка змінна в РНР має ім\'я, що починається із знаку $, наприклад Svariable. При такому способі формування імен змінних їх дуже легко відрізнити від іншого коду. Якщо в інших мовах інколи може виникати плутанина з тим, що при першому погляді на код не завжди ясно - де тут змінні, а де функції, то в РНР це питання навіть не постає. Наприклад, ссилка на змінну по її імені, що зберігається в іншій змінній:</p>'),
	(23, 24, 1, 'text', 1, '<p>New text block!</p>'),
	(24, 24, 2, 'text', 1, '<p><iframe width="420" height="315" src="https://www.youtube.com/embed/7KAhgrBDl3A" frameborder="0" allowfullscreen=""></iframe></p>'),
	(25, 1, 6, 'text', 1, '<p>simple\r\n</p>'),
	(26, 1, 7, 'text', 1, '<p>Add links. Example with "www" and "http"</p><p><a href="http://www.google.com">www.google.com</a></p><p><a href="http://google.com">http://google.com</a></p><p><br></p>'),
	(27, 1, 8, 'text', 1, '<p>Add video. Example: ("<a href="http://www.youtube.com/watch?v=QlRGhXj0uRY">youtube.com/watch?v=QlRGhXj0uRY</a>")\r\n</p>\r\n<p>\r\n	<iframe width="500" height="281" src="//www.youtube.com/embed/QlRGhXj0uRY" frameborder="0" allowfullscreen="">\r\n	</iframe><span class="redactor-invisible-space"><br></span>\r\n</p>'),
	(28, 1, 9, 'text', 1, '<p>Add picture. Example: "screensavergift.com/wp-content/uploads/BeautifulNature3-610x320.jpg"</p><p><img src="http://www.screensavergift.com/wp-content/uploads/BeautifulNature3-610x320.jpg"><span class="redactor-invisible-space"><br></span></p>'),
	(29, 1, 10, 'text', 1, '<p>Add code. Example:</p><pre>&lt;div id="logo_img" class="down"&gt;<br> &lt;a href="&lt;?php echo Yii::app()-&gt;createUrl(\'site/index\');?&gt;"&gt;<br> &lt;img id="logo" src="&lt;?php echo Yii::app()-&gt;request-&gt;baseUrl;?&gt;/css/images/Logo_small.png"/&gt;<br> &lt;/a&gt;<br>&lt;/div&gt;</pre>'),
	(30, 1, 11, 'text', 1, '<p><iframe width="500" height="281" src="//www.youtube.com/embed/6zEnXc8jdEE" frameborder="0" allowfullscreen=""></iframe></p>'),
	(32, 1, 12, 'code', 3, '<pre>\r\nmodel = Module::model()->findByPk($idModule);\r\n        $owners = explode(\';\',$model->owners); //array of teacher\'s ids that cna edit this module\r\n        $teachers = Teacher::model()->findAllByAttributes(array(\'teacher_id\'=>$owners)); //info about owners\r\n\r\n\r\n        $criteria=new CDbCriteria();\r\n        $criteria->addCondition(\'idModule>0\');\r\n        $criteria->addCondition(\'idModule=\'.$idModule);\r\n\r\n        $dataProvider = new CActiveDataProvider(\'Lecture\', array(\r\n            \'criteria\' =>$criteria,\r\n            \'pagination\'=>false,\r\n            \'sort\'=>array(\r\n                \'defaultOrder\'=>array(\r\n                    \'order\'=>CSort::SORT_ASC,\r\n                )\r\n            )\r\n        ));\r\n</pre>'),
	(35, 1, 13, 'text', 8, '<p>Глава 1.</p>'),
	(36, 1, 14, 'label', 8, '<p>Глава 3.</p>'),
	(37, 1, 15, 'label', 8, '<p>Глава 4.</p>'),
	(38, 1, 16, 'task', 5, '<p>aefaeghsr</p>'),
	(39, 1, 17, 'text', 1, '<p>124578235689</p>'),
	(40, 1, 18, 'video', 2, '//www.youtube.com/embed/bVssxumkHI4"'),
	(41, 1, 19, 'video', 2, '//www.youtube.com/embed/5PSNL1qE6VY"'),
	(42, 1, 20, 'video', 2, '//www.youtube.com/embed/5PSNL1qE6VY"'),
	(43, 1, 21, 'video', 2, '//www.youtube.com/embed/d1_JBMrrYw8"'),
	(45, 1, 22, 'text', 1, '<p>y6</p>'),
	(46, 1, 23, 'text', 1, '<iframe style="width: 500px; height: 281px;" src="//www.youtube.com/embed/9eiRmWLcASw" frameborder="0" allowfullscreen=""></iframe>'),
	(47, 1, 24, 'video', 2, '//www.youtube.com/embed/9eiRmWLcASw"'),
	(56, 2, 2, 'text', 1, '/images/lecture/2139e6cb5c89529517e7c5ae47c49763.jpg'),
	(57, 2, 3, 'image', 9, '/images/lecture/29ce2affb5bdaa6c330f9ed52d0cf64a.jpg"></p'),
	(58, 2, 4, 'text', 1, '<p><img src="/images/lecture/f410fd7420bfa6c526e0fab647e3e484.jpg"></p>'),
	(59, 2, 5, 'text', 1, '<table><tbody><tr><td>bdffbdz</td><td>bdfb</td><td>bfdbdbfd</td></tr><tr><td>bfdbdf</td><td>bdfbfd</td><td>bfdb</td></tr><tr><td>fdbsf</td><td>bfb</td><td>bfbfs</td></tr></tbody></table>'),
	(60, 2, 6, 'text', 1, '<table><thead><tr><th>First Name</th><th>Last Name</th><th>Points</th></tr></thead><tbody><tr><td>Jill</td><td>Smith</td><td>50</td></tr><tr><td>Eve</td><td>Jackson</td><td>94</td></tr></tbody></table>'),
	(65, 2, 7, 'formula', 10, '\\[\\left \\{ \\Theta \\iota \\vartheta \\tau \\ddot{\\sqsupseteq \\uplus \\circ \\pm \\widehat{\\leftarrow }} \\right \\}\\]'),
	(66, 2, 8, 'formula', 10, '\\[\\alpha \\varepsilon \\mu \\tau\\]'),
	(67, 2, 9, 'formula', 10, '\\[\\OE \\measuredangle \\mathbb{N}\\mathbb{Q}\\bigcap \\tfrac{\\ae }{{\\check{\\breve{}}}\'\'}\\]'),
	(68, 2, 10, 'formula', 10, '\\[\\tfrac{\\beta }{\\gamma \\Delta \\Sigma n \\to }\\]'),
	(69, 2, 11, 'formula', 10, '\\[\\mp \\imath \\mathbb{I}\\Delta\\]'),
	(70, 2, 12, 'formula', 10, '\\[\\gamma \\iota \\varrho \\varpi \\prod \\bigcap_{\\oint \\frac{\\partial^2 \\frac{\\partial \\frac{\\partial^2 _{}}{\\partial x^2}}{\\partial x}}{\\partial x^2}}^{}\\]\r\n'),
	(71, 2, 13, 'formula', 10, '\\[\\left ( \\Cap \\delta \\sqsubset \\Gamma \\varepsilon \\varepsilon \\varepsilon \\bigcap \\frac{^{^{}}}{} \\right )\\]\r\n'),
	(72, 2, 14, 'formula', 10, '\\[\\frac{\\partial \\frac{\\partial^2 }{\\partial x^2}}{\\partial x}\\textit{\\lim_{}}\\]\r\n'),
	(73, 2, 15, 'formula', 10, '\\[\\tfrac{bd}{\\zeta \\eta \\varepsilon \\pi }\\ae\\]'),
	(74, 2, 16, 'formula', 10, '\\[\\mu \\varpi \\sigma \\varsigma \\varphi \\ae \\AE \\SS \\euro\\]'),
	(75, 2, 17, 'text', 1, '<p>ыупв</p>');
/*!40000 ALTER TABLE `lecture_element` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
