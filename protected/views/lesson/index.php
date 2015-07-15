<!-- lesson style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lessonsStyle.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lectureStyles.css" />

<!-- Spoiler -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/SpoilerContent.js"></script>
<!-- Spoiler -->
<!--Sidebar-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/SidebarLesson.js"></script>
<!--Sidebar-->

<script type="text/javascript">
    idLecture = <?php echo $lecture->id;?>;
    <?php if($user != 0){?>
    idTeacher = <?php echo TeacherHelper::getTeacherId($user);?>;
    <?php }?>
    order = 1;
</script>
<?php
/* @var $this LessonController */
$this->pageTitle = 'INTITA';
$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0050')=>Yii::app()->request->baseUrl."/courses",$lecture->getCourseInfoById($idCourse)['courseTitle']=>Yii::app()->createUrl('course/index', array('id' => $idCourse)),$lecture->getModuleInfoById($idCourse)['moduleTitle']=>Yii::app()->createUrl('module/index', array('idModule' => $lecture['idModule'],'idCourse' => $idCourse)),$lecture['title'],
);
?>

<div class="lectureMainBlock" >
    <?php $this->renderPartial('_lectureInfo', array('lecture'=>$lecture, 'idCourse'=>$idCourse));?>
    <?php $this->renderPartial('_teacherInfo', array('lecture'=>$lecture,'teacher'=>$teacher, 'idCourse'=>$idCourse));?>
</div>

<div class="lessonBlock" id="lessonBlock">
    <?php $this->renderPartial('_sidebar', array('lecture'=>$lecture, 'idCourse'=>$idCourse));?>
    <div class="lessonText">

        <?php if($editMode){?>
        <div onclick="enableLessonEdit();">
            <a>
                <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'edt_30px.png'); ?>"
                    id="editIco" title="Редагувати заняття"/>
            </a>
        </div>
        <div onclick="showForm();">
            <a href="#newBlockForm">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'add_lesson.png');?>"
                     id="addTextBlock" title="Додати новий блок" onclick="showBlockForm()"/>
            </a>
        </div>
        <?php }?>


        <h1 class="lessonTheme"><?php echo $lecture['title']?></h1>
        <br>
        <?php if($countBlocks){?>
            <span class="listTheme"><?php echo Yii::t('lecture', '0321');?> </span><span class="spoilerLinks"><span class="spoilerClick">(показати)</span><span class="spoilerTriangle"> &#9660;</span></span>

            <div class="spoilerBody">
                <?php
                $summary =  Lecture::getLessonCont($lecture->id);
                for($i=0; $i<count($summary);$i++){
                ?>
                <p>
                    <a href="#<?php echo strip_tags($summary[$i]);?>">
                        <?php echo strip_tags($summary[$i]);?>
                    </a>
                </p>
                <?php
                }
                ?>
            </div>
        <?php }?>

        <!-- Lesson content-->
        <?php $this->renderPartial('_blocks_list', array('dataProvider'=>$dataProvider, 'countBlocks' => $countBlocks, 'editMode' => $editMode));?>
    <?php $this->renderPartial('_addBlock', array('lecture'=>$lecture, 'countBlocks' => $countBlocks, 'editMode' => $editMode));?>

        </div>
    <!-- lesson footer ----congratulations-->
<?php $this->renderPartial('_lectureFooter', array('lecture'=>$lecture, 'idCourse'=>$idCourse));?>
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
<!--modal task ---congratulations





<!--modal task ---error1-
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
</div>

<script type="text/javascript">
    function enableLessonEdit(){
        document.getElementById('editIco').style.display = 'none';
        document.getElementById('addTextBlock').style.display = 'inline-block';
    }

    function showForm(){
        document.getElementById('textBlockForm').style.display = 'block';
    }

    function showBlockForm(){
        document.getElementById('blockForm').style.display = 'block';
    }
</script>

<!-- lesson style -->
<!-- Підсвітка синтаксису-->
<link type='text/css' rel='stylesheet' href='<?php echo Yii::app()->request->baseUrl; ?>/scripts/sh/styles/shCoreEclipse.css'>
<link type='text/css' rel='stylesheet' href='<?php echo Yii::app()->request->baseUrl; ?>/scripts/sh/styles/shThemeEclipse.css'>
<script class='javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/scripts/sh/scripts/XRegExp.js'></script>
<script class='javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/scripts/sh/scripts/shLegacy.js'></script>
<script class='javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/scripts/sh/scripts/shCore.js'></script>
<script class='javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/scripts/sh/scripts/shMegaLang.js'></script>
<script type="text/javascript" src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script type='text/javascript'>SyntaxHighlighter.all();</script>
<!--Font Awesome-->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css">
<!--Font Awesome-->
<!--Load Redactor-->
<?php if ($editMode){?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/loadRedactor.js"></script>
<!--Load Redactor-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/tasks.js"></script>
<?php }?>


