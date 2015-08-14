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
    idUser = <?php echo $user;?>;
    <?php if($user != 0){?>
    idTeacher = <?php echo TeacherHelper::getTeacherId($user);?>;
    <?php }?>
    order = 1;
    currentTask = 0;
    editMode = <?php echo ($editMode)?1:0;?>;
</script>
<?php
/* @var $this LessonController */
/* @var $lecture Lecture*/
/* @var $page LecturePage*/
$this->pageTitle = 'INTITA';
$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0050')=>Yii::app()->request->baseUrl."/courses",
    $lecture->getCourseInfoById($idCourse)['courseTitle']=>Yii::app()->createUrl('course/index', array('id' => $idCourse)),
    $lecture->getModuleInfoById($idCourse)['moduleTitle']=>Yii::app()->createUrl('module/index', array('idModule' => $lecture['idModule'],'idCourse' => $idCourse)),
    LectureHelper::getLectureTitle($lecture->id),
);
?>

<div class="lectureMainBlock" >
    <?php $this->renderPartial('_lectureInfo', array('lecture'=>$lecture, 'idCourse'=>$idCourse, 'user' => $user));?>
    <?php $this->renderPartial('_teacherInfo', array('lecture'=>$lecture,'teacher'=>$teacher, 'idCourse'=>$idCourse));?>
</div>

<div class="lessonBlock" id="lessonBlock">
    <?php $this->renderPartial('_sidebar', array('lecture'=>$lecture, 'idCourse'=>$idCourse));?>
    <div class="lessonText">
        <h1 class="lessonTheme"><?php echo LectureHelper::getLectureTitle($lecture->id);?></h1>
        <?php if($editMode) {
            $this->renderPartial('_startEditButton', array('block' => 1));
        }
        if (isset($_GET['editPage'])){
            $this->renderPartial('_editLecturePageTabs', array('page' => $_GET['editPage'], 'dataProvider'=>$dataProvider, 'countBlocks' => $countBlocks, 'editMode' => 0, 'user' => Yii::app()->user->getId(), 'idCourse' => $_GET['idCourse']));
        }else {
            $this->renderPartial('_lecturePageTabs', array('page' => $page, 'countBlocks' => $countBlocks, 'dataProvider' => $dataProvider, 'passedPages' => $passedPages, 'editMode' => $editMode, 'user' => $user, 'order' => $lecture->order));
        }
        ?>

    </div>
    <!-- lesson footer ----congratulations-->
    <?php $this->renderPartial('_lectureFooter', array('lecture'=>$lecture, 'idCourse'=>$idCourse, 'user'=>$user, 'editMode' => $editMode));?>
    <!--modal task congratulations-->
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'mydialog2',
        'themeUrl' => Yii::app()->request->baseUrl . '/css',
        'cssFile' => 'jquery-ui.css',
        'theme' => 'my',
        'options' => array(
            'width' => 540,
            'autoOpen' => false,
            'modal' => true,
            'resizable' => false,
        ),
    ));
    $this->renderPartial('/lesson/_modalTask');
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>
    <!--modal task congratulations end-->

    <!--modal task ---error1-->
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'mydialog3',
        'themeUrl'=>Yii::app()->request->baseUrl.'/css',
        'cssFile'=>'jquery-ui.css',
        'theme'=>'my',
        'options' => array(
            'width'=>540,
            'autoOpen' => false,
            'modal' => true,
            'resizable'=> false
        ),
    ));
    $this->renderPartial('/lesson/_modalTask2');
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>
    <!--<!--modal task ---error-->
</div>

<!-- lesson style -->
<!-- Підсвітка синтаксису-->
<link type='text/css' rel='stylesheet' href='<?php echo Yii::app()->request->baseUrl; ?>/scripts/sh/styles/shCoreEclipse.css'>
<link type='text/css' rel='stylesheet' href='<?php echo Yii::app()->request->baseUrl; ?>/scripts/sh/styles/shThemeEclipse.css'>
<script class='javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/scripts/sh/scripts/XRegExp.js'></script>
<script class='javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/scripts/sh/scripts/shLegacy.js'></script>
<script class='javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/scripts/sh/scripts/shCore.js'></script>
<script class='javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/scripts/sh/scripts/shMegaLang.js'></script>
<script src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script>SyntaxHighlighter.all();</script>
<!--Font Awesome-->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css">
<!--Font Awesome-->
<!--Load Redactor-->
<?php if ($editMode){?>
    <script async src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/loadRedactor.js"></script>
    <script async src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/tasks.js"></script>
    <script async src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/lessonEditor.js"></script>
<?php }?>
<script async src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/taskAnswer.js"></script>
<script async src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/tests.js"></script>


