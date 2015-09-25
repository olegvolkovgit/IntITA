<?php
/* @var $this LessonController */
/* @var $lecture Lecture*/
/* @var $page LecturePage*/
/* @var $teacher Teacher*/

$this->pageTitle = 'INTITA';
$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0050') => Config::getBaseUrl()."/courses",
    $lecture->getCourseInfoById($idCourse)['courseTitle']=>Yii::app()->createUrl('course/index', array('id' => $idCourse)),
    $lecture->getModuleInfoById($idCourse)['moduleTitle']=>Yii::app()->createUrl('module/index', array('idModule' => $lecture['idModule'],'idCourse' => $idCourse)),
    LectureHelper::getLectureTitle($lecture->id),
);
?>
<?php //$this->renderPartial('/site/_shareMetaTag', array(
//    'url'=>Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $lecture['idModule'],'idCourse' => $idCourse)),
//    'title'=>$lecture->getCourseInfoById($idCourse)['courseTitle'],
//    'description'=>'Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали',
//    'image'=>StaticFilesHelper::createPath('image', 'lecture/share', ImageHelper::setOpenGraphImage(Yii::getPathOfAlias('webroot')."/images/lecture/share/",'shareLectureImg_',$lecture->id,'defaultLectureImg.png'))));
//?>
<div id="sharing">
    <div class="share42init" data-top1="75" data-top2="110" data-margin="15"
         data-url="<?php echo Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $lecture['idModule'],'idCourse' => $idCourse)); ?>"
         data-title="<?php echo $lecture->getCourseInfoById($idCourse)['courseTitle'];?>"
         data-image="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>"
         data-description="Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали"
         data-path="<?php echo Config::getBaseUrl(); ?>/scripts/share42/"
         data-zero-counter="1">
    </div>
</div>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'share42/share42.js'); ?>"></script>
<!-- lesson style -->
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lessonsStyle.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lectureStyles.css'); ?>" />
<script type="text/x-mathjax-config">
  MathJax.Hub.Config({
    tex2jax: {
      inlineMath: [ ['$','$'], ["\\(","\\)"] ],
      processEscapes: true
    }
  });
</script>
<!--"HTML-CSS": {-->
<!--availableFonts: [],-->
<!--preferredFonts: "TeX",-->
<!--webFont:"",-->
<!--imageFont:"",-->
<!--undefinedFamily:"'MyriadPro'"-->
<!--}-->
<script src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>

<script type="text/javascript"
        src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>
<!-- Spoiler -->
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'SpoilerContent.js'); ?>"></script>
<!-- Spoiler -->
<!--Sidebar-->
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'SidebarLesson.js'); ?>"></script>
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
$passedLecture=LectureHelper::isPassedLecture($passedPages);
$finishedLecture=LectureHelper::isLectureFinished($user, $lecture->id);
?>
<div class="lectureMainBlock" >
    <?php $this->renderPartial('_lectureInfo', array('lecture'=>$lecture, 'idCourse'=>$idCourse, 'user' => $user));?>
    <?php $this->renderPartial('_teacherInfo', array('lecture'=>$lecture,'teacher'=>$teacher, 'idCourse'=>$idCourse));?>
</div>

<div class="lessonBlock" id="lessonBlock">
    <?php $this->renderPartial('_sidebar', array('lecture'=>$lecture, 'idCourse'=>$idCourse));?>
    <div class="lessonText">
        <h1 class="lessonTheme"><a name="title" ></a><?php echo LectureHelper::getLectureTitle($lecture->id);?></h1>
        <div id="chaptersList">
            <?php $this->renderPartial('_chaptersList', array('idLecture' => $lecture->id,'isFree' => $lecture->isFree, 'passedPages' => $passedPages, 'editMode' =>$editMode)); ?>
        </div>
        <?php if($editMode) {
            $this->renderPartial('_startEditButton', array('block' => 1));
        }
        if (isset($_GET['editPage'])){
            $this->renderPartial('_editLecturePageTabs', array('page' => $_GET['editPage'], 'dataProvider'=>$dataProvider, 'passedPages' => $passedPages, 'editMode' => 0, 'user' => Yii::app()->user->getId(), 'idCourse' => $_GET['idCourse'], 'editMode' => $editMode));
        }else {
            $this->renderPartial('_lecturePageTabs', array('page' => $page,'lastAccessPage'=>$lastAccessPage, 'dataProvider' => $dataProvider, 'finishedLecture' => $finishedLecture, 'passedLecture'=>$passedLecture,'passedPages' => $passedPages, 'editMode' => $editMode, 'user' => $user, 'order' => $lecture->order));
        }
        ?>

    </div>
    <!-- lesson footer ----congratulations-->
    <?php $this->renderPartial('_lectureFooter', array('lecture'=>$lecture, 'idCourse'=>$idCourse, 'finishedLecture' => $finishedLecture, 'user'=>$user, 'editMode' => $editMode));?>
    <!--modal task congratulations-->
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'mydialog2',
        'themeUrl' => Config::getBaseUrl().'/css',
        'cssFile' => 'jquery-ui.css',
        'theme' => 'my',
        'options' => array(
            'width' => 540,
            'autoOpen' => false,
            'modal' => true,
            'resizable' => false,
        ),
    ));
    $this->renderPartial('/lesson/_modalTask', array('lastAccessPage'=>$lastAccessPage));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>
    <!--modal task congratulations end-->

    <!--modal task ---error1-->
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'mydialog3',
        'themeUrl'=>Config::getBaseUrl().'/css',
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

    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'dialogNextLecture',
        'themeUrl'=>Config::getBaseUrl().'/css',
        'cssFile'=>'jquery-ui.css',
        'theme'=>'my',
        'options' => array(
            'width'=>540,
            'autoOpen' => false,
            'modal' => true,
            'resizable'=> false
        ),
    ));
    $this->renderPartial('/lesson/_passLectureModal', array('lecture'=>$lecture, 'idCourse'=>$idCourse));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>
</div>

<!-- lesson style -->
<!-- Підсвітка синтаксису-->
<link type='text/css' rel='stylesheet' href="<?php echo StaticFilesHelper::fullPathTo('js', 'sh/styles/shCoreEclipse.css'); ?>">
<link type='text/css' rel='stylesheet' href="<?php echo StaticFilesHelper::fullPathTo('js', 'sh/styles/shThemeEclipse.css'); ?>">
<script class='javascript' src='<?php echo StaticFilesHelper::fullPathTo("js", "sh/scripts/XRegExp.js"); ?>'></script>
<script class='javascript' src='<?php echo StaticFilesHelper::fullPathTo("js", "sh/scripts/shLegacy.js"); ?>'></script>
<script class='javascript' src='<?php echo StaticFilesHelper::fullPathTo("js", "sh/scripts/shCore.js"); ?>'></script>
<script class='javascript' src='<?php echo StaticFilesHelper::fullPathTo("js", "sh/scripts/shMegaLang.js"); ?>'></script>

<script>SyntaxHighlighter.all();</script>
<script src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<!--Font Awesome-->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css">
<!--Font Awesome-->
<!--Load Redactor-->
<?php if (isset($_GET['editPage'])){?>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'loadRedactor.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'tasks.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'formulaEditor.js'); ?>"></script>
<?php }?>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'lessonEditor.js'); ?>"></script>
<script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'taskAnswer.js'); ?>"></script>
<script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'tests.js'); ?>"></script>

<script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'lesson.js'); ?>"></script>
<script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'lectureProgress.js'); ?>"></script>


