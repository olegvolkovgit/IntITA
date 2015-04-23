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
$tmp2 = Yii::t('teachers', '0061');
$currentDiv = '';
$arrayCourseText=array(
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
<!--                    <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/images/edit.png" class="editIcon" />-->
                    <a href="javascript:enableEdit()">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher1Image.png"/>
                    </a>
                </td>
                <td>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/edit.png" class="editIcon" />
                    <div class="TeacherProfilename"> <?php echo $model->last_name;?></div>
                    <div class="TeacherProfilename"> <?php echo $model->first_name.' '.$model->middle_name; ?> </div>

                    <div class="TeacherProfiletitles">
                        <?php echo Yii::t('teacher', '0064') ?>
                    </div>

                    <div class="TeacherProfilesectionText">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/edit.png" class="editIcon" />
                        <?php
                        foreach ($sections as $val) {
                            echo $val; ?><p></p><?php
                        }
                        ?>
                    </div>

                    <div class="TeacherProfiletitles">
                        <?php echo Yii::t('teacher', '0065') ?>
                    </div>

                    <div class="txtMsgFirst">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/edit.png" class="editIcon" />
                        <?php echo $model->profile_text_first; ?>
                    </div>
                    <?php echo Yii::t('teachers', '0061'); ?>
                    <div class="TeacherProfilecourse">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/edit.png" class="editIcon" />
                        <?php
                        foreach ($arrayCourseText as $linkText => $linkAdress) {
                            ?>
                            <a href="<?php echo $linkAdress; ?>">
                                <?php echo $linkText; ?>
                            </a>
                            <br>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="txtMsgSecond">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/edit.png" class="editIcon" />
                        <?php echo $model->profile_text_last;?>
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
                    <?php echo $model->last_name; ?>
                    <?php echo $model->first_name; ?>
                    <?php echo $model->middle_name; ?>
                </b>
            </div>
        </div>

        <div class="TeacherProfiletitles"><?php echo Yii::t('teacher', '0182'); ?></div>

        <div class="border">
            <div class="txtMsg">
                <?php
                echo Yii::t('teacher', '0183').$model->rate_knowledge.'    ';
                echo Yii::t('teacher', '0184').$model->rate_efficiency.'    ';
                echo Yii::t('teacher', '0185').$model->rate_relations.'    ';
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

    <?php
    // use editor WYSIWYG Imperavi
    $this->widget('ImperaviRedactorWidget', array(
        'selector' => '',
        'options' => array(
            'imageUpload' => $this->createUrl('files/upload'),
            'lang' => 'ua',
            'toolbar' => true,
            'iframe' => true,
            'css' => 'wym.css',
        ),
        'plugins' => array(
            'fullscreen' => array(
                'js' => array('fullscreen.js',),
            ),
            'video' => array(
                'js' => array('video.js',),
            ),
            'fontsize' => array(
                'js' => array('fontsize.js',),
            ),
            'fontfamily' => array(
                'js' => array('fontfamily.js',),
            ),
            'fontcolor' => array(
                'js' => array('fontcolor.js',),
            ),

        ),
    ));
    ?>

    <script type='text/javascript'>

        function enableEdit(blockId)
        {

        }
    </script>
