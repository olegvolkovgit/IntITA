<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-route/angular-route.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/app.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_app/controllers.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'ivpusic/angular-cookies.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-bootstrap/ui-bootstrap-tpls_0_13_0.js'); ?>"></script>
<link type='text/css' rel='stylesheet' href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-bootstrap/bootstrap.min.css'); ?>">
<?php
/* @var $this LessonController */
/* @var $lecture Lecture */
/* @var $page LecturePage */
/* @var $teacher Teacher */
/* @var integer $idCourse */

if (!isset($idCourse)) $idCourse = 0;
?>
<!-- lesson style -->
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lessonsStyle.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lectureStyles.css'); ?>"/>
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
    idTeacher = <?php echo Teacher::getTeacherId($user);?>;
    <?php }?>
    order = 1;
    currentTask = 0;
    editMode = <?php echo ($editMode)?1:0;?>;
    partNotAvailable = '<?php echo Yii::t('lecture', '0638'); ?>';
    lastAccessPage = <?php echo $lastAccessPage ?>;
    basePath='<?php echo  Config::getBaseUrl(); ?>';
</script>
<?php
$passedLecture = Lecture::isPassedLecture($passedPages);
$finishedLecture = $lecture->isFinished($user);
?>
<div id="lessonHumMenu">
    <?php $this->renderPartial('/lesson/_lessonHamburgerMenu', array('idCourse' => $idCourse, 'idModule'=>$lecture->idModule)); ?>
</div>
<div class="lessonBlock" id="lessonBlock"  ng-app="lessonApp">
    <?php $this->renderPartial('_sidebar', array('lecture' => $lecture,'editMode'=>$editMode, 'idCourse' => $idCourse,'finishedLecture' => $finishedLecture, 'passedPages'=>$passedPages)); ?>
    <div class="lessonText">
        <div class="lessonTheme">
            <?php echo Lecture::getLectureTitle($lecture->id); ?>
            <div style="display: inline-block; float: right; margin-top: 10px">
<!--                <a href="--><?php //echo Yii::app()->createUrl("lesson/index", array("id" => $lecture->id, "idCourse" => $idCourse, "template"=>1)); ?><!--">-->
<!--                    <img style="margin-left: 5px"-->
<!--                         src="--><?php //echo StaticFilesHelper::createPath('image', 'editor', 'newLecture.png'); ?><!--"-->
<!--                         title="New lecture View"/>-->
<!--                </a>-->
                <?php if ($editMode) { ?>
                    <a href="<?php echo Yii::app()->createURL('lesson/editPage', array('pageId' => $page->id, 'idCourse' => $idCourse, 'cke' => 1)); ?>">
                        <img style="margin-left: 5px"
                             src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'edt_30px.png'); ?>"
                             id="editIco1" class="editButton" title="<?php echo Yii::t('lecture','0686')?>"/>
                    </a>
                <?php } ?>
            </div>
        </div>
        <?php
        $browser = CommonHelper::detectBrowser($_SERVER['HTTP_USER_AGENT']);
        $cmp = CommonHelper::checkForBrowserVersion($browser, array(
            'Internet Explorer' => array(9, 0)
        ));
        if ($cmp < 0) {
            $this->renderPartial('_lecturePageTabs', array('lectureId'=>$lecture->id, 'page' => $page, 'lastAccessPage' => $lastAccessPage, 'dataProvider' => $dataProvider, 'finishedLecture' => $finishedLecture, 'passedLecture' => $passedLecture, 'passedPages' => $passedPages, 'editMode' => $editMode, 'user' => $user, 'order' => $lecture->order, 'idCourse' => $idCourse));
        }
        else {
//            angular lecture PageTabs
            $this->renderPartial('_jsLecturePageTabs', array('lectureId'=>$lecture->id, 'page' => $page, 'lastAccessPage' => $lastAccessPage, 'dataProvider' => $dataProvider, 'finishedLecture' => $finishedLecture, 'passedLecture' => $passedLecture, 'passedPages' => $passedPages, 'editMode' => $editMode, 'user' => $user, 'order' => $lecture->order, 'idCourse' => $idCourse));
        }
        ?>
    </div>

    <!--modal task error1-->
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'mydialog3',
        'themeUrl' => Config::getBaseUrl() . '/css',
        'cssFile' => 'jquery-ui.css',
        'theme' => 'my',
        'options' => array(
            'width' => 540,
            'autoOpen' => false,
            'modal' => true,
            'resizable' => false
        ),
    ));
    $this->renderPartial('/lesson/_modalTask2');
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>

    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'dialogNextLecture',
        'themeUrl' => Config::getBaseUrl() . '/css',
        'cssFile' => 'jquery-ui.css',
        'theme' => 'my',
        'options' => array(
            'width' => 540,
            'autoOpen' => false,
            'modal' => true,
            'resizable' => false
        ),
    ));
    $this->renderPartial('/lesson/_passLectureModal', array('lecture' => $lecture, 'idCourse' => $idCourse));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>
</div>
<!-- lesson style -->
<!-- Підсвітка синтаксису-->
<link type='text/css' rel='stylesheet'
      href="<?php echo StaticFilesHelper::fullPathTo('js', 'sh/styles/shCoreEclipse.css'); ?>">
<link type='text/css' rel='stylesheet'
      href="<?php echo StaticFilesHelper::fullPathTo('js', 'sh/styles/shThemeEclipse.css'); ?>">
<script class='javascript' src='<?php echo StaticFilesHelper::fullPathTo("js", "sh/scripts/XRegExp.js"); ?>'></script>
<script class='javascript' src='<?php echo StaticFilesHelper::fullPathTo("js", "sh/scripts/shLegacy.js"); ?>'></script>
<script class='javascript' src='<?php echo StaticFilesHelper::fullPathTo("js", "sh/scripts/shCore.js"); ?>'></script>
<script class='javascript'
        src='<?php echo StaticFilesHelper::fullPathTo("js", "sh/scripts/shMegaLang.js"); ?>'></script>

<script>SyntaxHighlighter.all();</script>
<script src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css">
<script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'taskAnswer.js'); ?>"></script>
<script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'tests.js'); ?>"></script>
<script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'plainTask.js'); ?>"></script>

<script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'lesson.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'SpoilerContent.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'SidebarLesson.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'skipTask.js')?>"></script>


