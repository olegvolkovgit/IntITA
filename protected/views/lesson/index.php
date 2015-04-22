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
<?php
/* @var $this LessonController */
$this->pageTitle = 'INTITA';
$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0050')=>Yii::app()->request->baseUrl."/courses",'Модуль PHP'=>Yii::app()->request->baseUrl."/course",'Заняття 2: Змінні та типи данних в PHP',
);
?>

<div class="lectureMainBlock" >
    <?php $this->renderPartial('_lectureInfo', array('lecture'=>$lecture));?>
    <?php $this->renderPartial('_teacherInfo', array('teacher'=>$lecture->getTeacherInfoById(1)));?>
</div>

<div class="lessonBlock" id="lessonBlock">
    <?php $this->renderPartial('_sidebar', array('lecture'=>$lecture, 'skype'=>$lecture->getTeacherInfoById(1)['skype']));?>
    <div class="lessonText">
        <h1 class="lessonTheme">Змінні та типи даних в PHP </h1>
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
        ));
        ?>
<table ><tr><td>
        <div class="download" id="do4">  <a  href="#"><img style="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/000zav-yrok.png">Завантажити урок</a></div>
            </td><td>
            <div class="download" id="do3"> <a  href="#"><img style="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/000zav-ysi-vid.png">Завантажити всі відео</a></div>
            </td><td>
                <div class="download" id="do1">  <a href="#"><img style="" src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/000zav-ysi-vid2.png">Завантажити всі відео</a></div>
</td></tr></table>
</div>

    <!-- lesson footer -->
<?php $this->renderPartial('_lectureFooter', array('lecture'=>$lecture));?>


