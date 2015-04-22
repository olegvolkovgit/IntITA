<!-- lesson style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lessonsStyle.css" />
<!-- Підключення BBCode WysiBB -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/wysibb/jquery.wysibb.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/scripts/wysibb/theme/default/wbbtheme.css" type="text/css" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/wysibb/lang/ua.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/wysibb/BBCode.js"></script>
<!-- Підключення BBCode WysiBB -->
<!-- Spoiler -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/SpoilerContent.js"></script>
<!-------------------------------------------------------------->
<!-- teacherProfile style -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/teacherProfile.css" />
<!-- steps style -->
<?php
$this->pageTitle = 'INTITA';
$this->breadcrumbs=array(Yii::t('breadcrumbs', '0057'),);
$model = new TeacherProfile;
$model->firstName='Сіра';
$model->lastName='Олександра Василівна';
$model->arraySectionText=array('Програмування ПХП;','Java для IOS;');
$tmp2 = Yii::t('teachers', '0061');
$model->arrayCourseText=array(
    ' •  кройка и шитье сроков давности;'=> Yii::app()->request->baseUrl.'/course',
    ' •  программування самоубийств;'=> Yii::app()->request->baseUrl.'/course'
);
?>
<div class="TeacherProfilemainBlock">
    <!-- Block 1 -->
    <div class="TeacherProfileblock1">
        <table>
            <tr>
                <td valign="top">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher1Image.png"/>
                </td>
                <td>
                    <div class="TeacherProfilename"> <?php echo $model->firstName;?></div>
                    <div class="TeacherProfilename"> <?php echo $model->lastName; ?> </div>

                    <div class="TeacherProfiletitles">
                        <?php echo Yii::t('teacher', '0064') ?>
                    </div>

                    <div class="TeacherProfilesectionText">
                        <?php
                        foreach ($model->arraySectionText as $val) {
                            echo $val; ?><p></p><?php
                        }
                        ?>
                    </div>

                    <div class="TeacherProfiletitles">
                        <?php echo Yii::t('teacher', '0065') ?>
                    </div>

                    <div class="txtMsg">
                        <?php echo $model->aboutTextMain = "
                                Народилася і виросла в Сакраменто, у 18 років вона переїхала до Лос-Анджелеса й незабаром стала 
                                вкладачем. У 2007, 2008 і 2010 рр.. вона виграла кілька номінацій премії AVN Awards 
                                (також була названа «Найкращою програмісткою» у 2007 році за версією XRCO). 
                                Паралельно з вікладауцью роботою та роботою програміста в Саша Грей грає головну роль в тестванні Інтернету.</br>
                                Марина Енн Генціс народилася у родині механіка. Її батько мав грецьке походження.
                                Батьки дівчинки розлучилися коли їй було 5 років, надалі її виховувала мати, яка вступила 
                                в повторний шлюб у 2000 роц. Марина не ладнала з вітчимом, і, коли їй виповнилося 16 років, 
                                дівчина повідомила матері, що збирається покинути будинок. Достеменно невідомо, втекла вона з свого 
                    будинку або ж її відпустила мати. Сама Олександра пізніше зізнавалася, що в той час робила все те, 
                    що не подобалося її батькам і що вони їй забороняли.</br>
                    Главный бухгалтер акционерного предприятия, специализирующегося на:
                    <ul>
                    <li>оказании полезных услуг горизонтального характера;</li>
                    <li>торговле, внешнеэкономической и внутреннеэкономической;</li>
                    <li>позитивное обучение швейного мастерства;</li></ul>"; ?>
                    </div>
                    <?php echo Yii::t('teachers', '0061'); ?>
                    <div class="TeacherProfilecourse">
                        <?php
                        foreach ($model->arrayCourseText as $linkText => $linkAdress) {
                            ?>
                            <a href="<?php echo $linkAdress; ?>">
                                <?php echo $linkText; ?>
                            </a>
                            <br>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="txtMsg">
                        <?php echo $model->aboutTextSecond = "
                        </br>Олександра Сіра виконала головну роль у фільмі оскароносного режисера 
                        Стівена Содерберга «Дівчина за викликом»[27][28]. Олександра грає дівчину на ім'я Челсі, яка надає 
                        ескорт послуги заможним людям. Содерберг взяв її на роль після того, як прочитав статтю про неї у 
                        журналі Los Angeles, коментуючи це так: «She's kind of a new breed, I think. She doesn't really fit 
                        the typical mold of someone who goes into the adult film business. … I'd never heard anybody talk 
                        about the business the way that she talked about it». Журналіст Скотт Маколей каже, що можливо 
                        Грей вибрала саме цю роль через свій інтерес до незалежних режисерів, таких як Жан-Люк Годар, 
                        Хармоні Корін, Девід Гордон Грін, Мікеланджело Антоніоні, Аньєс Варда та Вільям Клейн.
                        </br>Коли Олександра  готувалася до ролі у «Дівчині за викликом», 
                        Содерберг попросив її подивитися «Жити своїм життям» і «Божевільний П'єро»[29]. 
                        У фільмі «Жити своїм життям» піднімаються проблеми проституції, звідки Грей могла 
                        взяти щось і для своєї ролі, в той час як у «Божевільному П'єро» показані відносини, 
                        схожі на ті, що відбуваються між Челсі, її хлопцем і клієнтами.";
                        ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <!-- Block 2 -->
    <div class="TeacherProfileblock2">
        <div class="border">
            <div class="TeacherProfiletitles">
                <?php echo Yii::t('teacher', '0181'); ?>
                <b>
                    <?php echo $model->firstName; ?>
                    <?php echo $model->lastName; ?>
                </b>
            </div>
        </div>

        <div class="TeacherProfiletitles"><?php echo Yii::t('teacher', '0182'); ?></div>

        <div class="border">
            <div class="txtMsg">
                <?php
                $foo = 12;
                echo Yii::t('teacher', '0183').$foo;
                echo Yii::t('teacher', '0184').$foo;
                echo Yii::t('teacher', '0185').$foo;
                ?>
            </div>
        </div>
        <div class="TeacherProfiletitles">
            <?php echo "Бевз Сергей"; ?>
        </div>
        <div class="sm">
            <?php
            echo "14.11.14 Всего 1 отзывов с IP:37.19.246.39";
            ?>
        </div>
        <div class="txtMsg">
            <?php
            $aboutTxt = "Только слова благодарности и восхищения таким педагогом и вообще человеком!
                        С Александрой знакома через ее сайт Учитель мистецтва. Столько высококлассных 
                        работ я в сети еще не встречала! Она всегда отвечает на просьбы, решает проблемы пользователей. 
                        Очень отзывчивый человек. Спасибо Вам! Терпения, удачи и творческого вдохновения на много лет!";
            echo $aboutTxt;
            ?>
        </div>
        <div class="border">
            <div class="TeacherProfiletitles">
                <?php
                echo Yii::t('teacher', '0186');

                for ($k = 0; $k < 10; $k++) {
                    ?>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starFull.png"/>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="TeacherProfiletitles">
            <?php echo "Грицина Ольга"; ?>
        </div>
        <div class="sm">
            <?php
            echo "14.11.14 Всего 1 отзывов с IP:37.19.246.39";
            ?>
        </div>
        <div class="txtMsg">
            <?php
            $aboutTxt = "Весьма важный этап, учитывая огромную конкуренцию на рынке.
                       Тут, конечно, более важно узнать бизнес-процессы конкурентов, но и проанализировать сайты компаний,
                       с которыми предстоит конкурировать на рынке интернет-торговли будет очень кстати. 
                       Так как мы говорим тут о проектировании, я не буду углубляться в сферу промышленного шпионажа, 
                       а сосредоточусь на исследовании сайтов, то есть тех моментов, 
                       которые нам нужны для последующего проектирования.!";
            echo $aboutTxt;
            ?>
        </div>
        <div class="border">
            <div class="TeacherProfiletitles">
                <?php
                echo Yii::t('teacher', '0186');

                for ($k = 0; $k < 7; $k++) {
                    ?>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starFull.png"/>
                <?php
                }
                ?>
                <?php
                for ($k = 0; $k < 3; $k++) {
                    ?>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starEmpty.png"/>
                <?php
                }
                ?>
            </div>

        </div>


        <div class="TeacherProfiletitles"> <?php echo "Бевзюковский Сергей"; ?></div>
        <div class="sm">
            <?php echo "14.11.14 Всего 1 отзывов с IP:37.19.246.39"; ?>
        </div>
        <div class="txtMsg">
            <?php
            $aboutTxt = "Только слова благодарности и восхищения таким педагогом и вообще человеком!
                                 С Александрой  знакома через ее сайт <<Учитель мистецтва>>.  Столько высококлассных 
                                 работ я в сети еще не встречала!";
            echo $aboutTxt;
            ?>
        </div>
        <div class="border">
            <div class="TeacherProfiletitles">
                <?php
                echo Yii::t('teacher', '0186');
                for ($k = 0; $k < 4; $k++) {
                    ?>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starFull.png"/>
                <?php
                }
                ?>
                <?php
                for ($k = 0; $k < 6; $k++) {
                    ?>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starEmpty.png"/>
                <?php
                }
                ?>
            </div>
        </div>


        <div class="TeacherProfiletitles"> <?php echo "Грицина Ольга"; ?></div>
        <div class="sm">
            <?php echo "14.11.14 Всего 1 отзывов с IP:37.19.246.39"; ?>
        </div>
        <div class="txtMsg">
            <?php
            $aboutTxt = "Весьма важный этап, учитывая огромную конкуренцию на рынке.
                                Тут, конечно, более важно узнать бизнес-процессы конкурентов, но и
                                проанализировать сайты компаний, с которыми предстоит конкурировать 
                                на рынке интернет-торговли будет очень кстати. Так как мы говорим тут
                                о проектировании, я не буду углубляться в сферу промышленного шпионажа, 
                                а сосредоточусь на исследовании сайтов, то есть тех моментов, которые 
                                нам нужны для последующего проектирования.!";
            echo $aboutTxt;
            ?>
        </div>

        <div class="border">
            <div class="TeacherProfiletitles">
                <?php
                echo Yii::t('teacher', '0186');
                for ($k = 0; $k < 5; $k++) {
                    ?>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starFull.png"/>
                <?php
                }
                ?>
                <?php
                for ($k = 0; $k < 5; $k++) {
                    ?>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starEmpty.png"/>
                <?php
                }
                ?>
            </div>
        </div>


        <div class="lessonTask">
            <img class="lessonBut" src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/lessButton.png">

            <div class="lessonButName" unselectable="on"><?php echo Yii::t('teacher', '0187'); ?></div>
            <div class="lessonLine"></div>
            <div class="responseBG">
            <div class="txtMsg">
                <table style="padding-left: 35px; padding-top: 30px;">
                    <tr>
                        <td align="right">
                            <b><?php echo  Yii::t('teacher', '0188'); ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <?php echo Yii::t('teacher', '0189'); ?>
                        </td>
                        <td>
                            <?php
                            for ($k = 0; $k < 10; $k++) {
                                ?>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starEmpty.png"/>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <?php echo Yii::t('teacher', '0190'); ?>
                        </td>
                        <td>
                            <?php
                            for ($k = 0; $k < 10; $k++) {
                                ?>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starEmpty.png"/>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <?php echo Yii::t('teacher', '0191'); ?>
                        </td>
                        <td>
                            <?php
                            for ($k = 0; $k < 10; $k++) {
                                ?>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starEmpty.png"/>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
            </div>
            </table>
            <div class="BBCode">
                <form action="" method="post">
                    <textarea class="editor"></textarea>
                    <input id="lessonTask1" type="submit" value="<?php echo Yii::t('teacher', '0192'); ?>">
                </form>
            </div>
        </div>
    </div>
    </div>
