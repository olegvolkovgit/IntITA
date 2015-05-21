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
<!--Font Awesome-->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css">
<!--Font Awesome-->
<!--Load Redactor-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/loadRedactor.js"></script>
<!--Load Redactor-->
<script type="text/javascript">
    idLecture = <?php echo $lecture->id;?>;
    order = 1;
</script>
<?php
/* @var $this LessonController */

$this->pageTitle = 'INTITA';
$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0050')=>Yii::app()->request->baseUrl."/courses",$lecture->getCourseInfoById()['courseTitle']=>Yii::app()->createUrl('course/index', array('id' => 1)),$lecture->getModuleInfoById()['moduleTitle']=>Yii::app()->createUrl('module/index', array('idModule' => $lecture['idModule'])),$lecture['title'],
);
?>

<div class="lectureMainBlock" >
    <?php $this->renderPartial('_lectureInfo', array('lecture'=>$lecture));?>
    <?php $this->renderPartial('_teacherInfo', array('lecture'=>$lecture));?>
</div>

<div class="lessonBlock" id="lessonBlock">
    <?php $this->renderPartial('_sidebar', array('lecture'=>$lecture));?>
    <div class="lessonText">
        <div onclick="enableLessonEdit();">
            <a href="#">
                <img src="<?php echo  '/IntITA/images/editor/edt_30px.png';//StaticFilesHelper::createPath('image', 'editor', 'edt_30px.png'); ?>"
                    id="editIco" title="Редагувати заняття"/>
            </a>
        </div>
        <div onclick="showForm();">
            <a href="#newBlockForm">
                <img src="<?php echo '/IntITA/images/editor/add_lesson.png';//StaticFilesHelper::createPath('image', 'editor', 'add.png');?>"
                     id="addTextBlock" title="Додати новий блок"/>
            </a>
        </div>


        <h1 class="lessonTheme"><?php echo $lecture['title']?></h1>
        <br>
        <?php if($countBlocks){?>
            <span class="listTheme"><?php echo Yii::t('lecture', '0317');?> </span><span class="spoilerLinks"><span class="spoilerClick">(показати)</span><span class="spoilerTriangle"> &#9660;</span></span>

            <div class="spoilerBody">
                <?php
                $summary =  Lecture::getLessonCont($lecture->id);
                for($i=0; $i<count($summary);$i++){
                ?>
                <p>
                    <a href="#<?php echo $summary[$i];?>">
                        <?php echo $summary[$i];?>
                    </a>
                </p>
                <?php
                }
                ?>
            </div>
        <?php }?>

        <!-- Lesson content-->
        <?php

        $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_content',
            'summaryText' => '',
            'viewData' => array('editMode' => $editMode),
            'emptyText' => Yii::t('lecture', '0316').'<br><br><br><br><br>',
            'pagerCssClass'=>'YiiPager',
            'ajaxUpdate' => true,
            'id'=>"blocks_list",
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
    <?php $this->renderPartial('_addBlock', array('lecture'=>$lecture, 'countBlocks' => $countBlocks, 'editMode' => $editMode));?>
    </div>
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
    function enableLessonEdit(){
        document.getElementById('editIco').style.display = 'none';
        document.getElementById('addTextBlock').style.display = 'inline-block';
    }

    function showForm(){
        document.getElementById('textBlockForm').style.display = 'block';
    }
</script>
</div>

