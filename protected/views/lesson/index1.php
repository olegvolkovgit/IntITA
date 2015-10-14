<?php
/* @var $this LessonController */
/* @var $lecture Lecture*/
/* @var $page LecturePage*/
/* @var $teacher Teacher*/
/* @var integer $idCourse*/

$this->pageTitle = 'INTITA';
if(!isset($idCourse)) $idCourse=0;

if($idCourse != 0) {
$this->renderPartial('/site/_shareMetaTag', array(
        'url' => Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $lecture['idModule'], 'idCourse' => $idCourse)),
        'title' => ModuleHelper::getModuleName($lecture->idModule).'. '.Yii::t('sharing','0643'),
        'description' =>Yii::t('sharing','0644'),
));
}else{
    $this->renderPartial('/site/_shareMetaTag', array(
        'url' => Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $lecture['idModule'])),
        'title' => ModuleHelper::getModuleName($lecture->idModule).'. '.Yii::t('sharing','0643'),
        'description' =>Yii::t('sharing','0644'),
    ));
}
?>
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

<script type="text/javascript">
    idLecture = <?php echo $lecture->id;?>;
    idUser = <?php echo $user;?>;
    <?php if($user != 0){?>
    idTeacher = <?php echo TeacherHelper::getTeacherId($user);?>;
    <?php }?>
    order = 1;
    currentTask = 0;
    editMode = <?php echo ($editMode)?1:0;?>;
    partNotAvailable = '<?php echo Yii::t('lecture', '0638'); ?>';
</script>
<?php

$passedLecture=LectureHelper::isPassedLecture($passedPages);
$finishedLecture=LectureHelper::isLectureFinished($user, $lecture->id);
?>
<div class="lessonBlock" id="lessonBlock">
    <?php $this->renderPartial('_sidebar', array('lecture'=>$lecture, 'idCourse'=>$idCourse));?>
    <div class="lessonText">
        <div class="lessonTheme">
            <?php echo LectureHelper::getLectureTitle($lecture->id);?>
            <div style="display: inline-block; float: right; margin-top: 10px">
                <?php if($editMode){?>
        <a href="<?php echo Yii::app()->createURL('lesson/editPage', array('pageId' => $page->id, 'idCourse' => $idCourse));?>">
        <img style="margin-left: 5px" src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'edt_30px.png'); ?>"
             id="editIco1" class="editButton" title="Редагувати сторінку"/>
            </a>
                <?php } ?>
            </div>
        </div>
        <?php
        $this->renderPartial('_lecturePageTabs', array('page' => $page,'lastAccessPage'=>$lastAccessPage, 'dataProvider' => $dataProvider, 'finishedLecture' => $finishedLecture, 'passedLecture'=>$passedLecture,'passedPages' => $passedPages, 'editMode' => $editMode, 'user' => $user, 'order' => $lecture->order, 'idCourse' => $idCourse));
        ?>
    </div>
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
    $this->renderPartial('/lesson/_modalTask', array('lastAccessPage'=>$lastAccessPage, 'idCourse'=>$idCourse));
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
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css">
<script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'taskAnswer.js'); ?>"></script>
<script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'tests.js'); ?>"></script>

<script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'lesson.js'); ?>"></script>
<script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'lectureProgress.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'SpoilerContent.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'SidebarLesson.js'); ?>"></script>


