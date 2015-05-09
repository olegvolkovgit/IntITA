<!-- lesson style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lessonsStyle.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lectureStyles.css" />

<!-- lesson style -->
<!-- Підсвітка синтаксису-->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/scripts/syntaxhighlighter/prettify.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/syntaxhighlighter/prettify.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/syntaxhighlighter/prettify.init.js"></script>
<!-- Підсвітка синтаксису -->
<!-- Підключення BBCode WysiBB -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/wysibb/jquery.wysibb.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/scripts/wysibb/theme/default/wbbtheme.css" type="text/css" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/wysibb/lang/ua.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/wysibb/BBCode.js"></script>
<!-- Підключення BBCode WysiBB -->
<!-- Spoiler -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/SpoilerContent.js"></script>
<!-- Spoiler -->
<!--Sidebar-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/SidebarLesson.js"></script>
<!--Sidebar-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/loadRedactor.js"></script>
<?php
/* @var $this LessonController */

$this->pageTitle = 'INTITA';
$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0050')=>Yii::app()->request->baseUrl."/courses",'Курс'=>Yii::app()->createUrl('course/index', array('id' => 1)),'Mодуль'=>Yii::app()->createUrl('module/index', array('idModule' => $lecture['idModule'])),$lecture['title'],
);
?>

<div class="lectureMainBlock" >
    <?php $this->renderPartial('_lectureInfo', array('lecture'=>$lecture));?>
    <?php $this->renderPartial('_teacherInfo', array('lecture'=>$lecture));?>
</div>

<div class="lessonBlock" id="lessonBlock">
    <?php $this->renderPartial('_sidebar', array('lecture'=>$lecture));?>
    <div class="lessonText">

        <?php
        // use editor WYSIWYG Imperavi
        $this->widget('ImperaviRedactorWidget', array(
            // use editor to field .aboutStepBlock
            'selector' => '#',
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
                'advanced' => array(
                    'js' => array('advanced.js',),
                ),
            ),
        ));
        //    ?>

        <h1 class="lessonTheme"><?php echo $lecture['title']?></h1>
        <span class="listTheme">Зміст </span><span class="spoilerLinks"><span class="spoilerClick">(показати)</span><span class="spoilerTriangle"> &#9660;</span></span>

        <div class="spoilerBody">
            <p><a href="#Частина 1: Типи змінних та перемінних">Частина 1: Типи змінних та перемінних</a></p>
            <p><a href="#Частина 7: Типи данних та математичний аналіз">Частина 7: Типи данних та математичний аналіз</a></p>
        </div>
        <!-- Lesson content-->
        <?php

        $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_content',
            'summaryText' => '',
            'emptyText' => 'В данной лекции еще ничего нет (',
            'pagerCssClass'=>'YiiPager',
        ));
        ?>
<!--<table ><tr><td>-->
<!--        <div class="download" id="do4">  <a  href="#"><img style="" src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/000zav-yrok.png">Завантажити урок</a></div>-->
<!--            </td><td>-->
<!--            <div class="download" id="do3"> <a href="#"><img style="" src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/000zav-ysi-vid.png">Завантажити всі відео</a></div>-->
<!--            </td><td>-->
<!--                <div class="download" id="do1">  <a href="#"><img style="" src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/000zav-ysi-vid2.png">Завантажити всі відео</a></div>-->
<!--</td></tr></table>-->
<!--</div>-->

    <!-- lesson footer ----congratulations-->
<?php $this->renderPartial('_lectureFooter', array('lecture'=>$lecture));?>
<!--modal task -->
<?php
//$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
//    'id' => 'mydialog2',
//    'themeUrl'=>Yii::app()->request->baseUrl.'/css',
//    'cssFile'=>'jquery-ui2.css',
//    'theme'=>'my',
//    'options' => array(
//        'width'=>540,
//        'autoOpen' => false,
//        'modal' => true,
//        'resizable'=> false,
//    ),
//));
//$this->renderPartial('/lesson/_modalTask');
//$this->endWidget('zii.widgets.jui.CJuiDialog');
//?>
<!--<!--modal task ---congratulations-->
<!---->
<!---->
<!---->
<!---->
<!---->
<!--<!--modal task ---error1--->
<?php
//$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
//    'id' => 'mydialog3',
//    'themeUrl'=>Yii::app()->request->baseUrl.'/css',
//    'cssFile'=>'jquery-ui3.css',
//    'theme'=>'my',
//    'options' => array(
//        'width'=>540,
//        'autoOpen' => false,
//        'modal' => true,
//        'resizable'=> false
//    ),
//));
//$this->renderPartial('/lesson/_modalTask2');
//$this->endWidget('zii.widgets.jui.CJuiDialog');
//?>
<!--<!--modal task ---error-->

        <script type="text/javascript">
            function pressEditRedactor(className)
            {
                var selector = className;
                $(selector).redactor({
                    focus: true
                });
                $('.btn-edit-ImperaviSimple').hide();
                $('.btn-save-ImperaviSimple').show();
                $('.btn-cancel-ImperaviSimple').show();
            }

            function pressCancelRedactor(className)
            {
                var selector = className;
                $(selector).redactor('core.destroy');
                $('.btn-edit-ImperaviSimple').show();
                $('.btn-save-ImperaviSimple').hide();
                $('.btn-cancel-ImperaviSimple').hide();
            }

            function pressSaveRedactor(className)
            {
                var selector = className;
                // save content if you need
                var text = $(selector).redactor('code.get');

                // destroy editor
                $(selector).redactor('core.destroy');
                $('.btn-edit-ImperaviSimple').show();
                $('.btn-save-ImperaviSimple').hide();
                $('.btn-cancel-ImperaviSimple').hide();
            }
        </script>
