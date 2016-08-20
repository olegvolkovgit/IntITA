<? $css_version = 1; ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.1.0/highlight.min.js"></script>
<script src='https://yastatic.net/highlightjs/8.2/highlight.min.js'></script>
<script src="https://pc035860.github.io/angular-highlightjs/angular-highlightjs.min.js"></script>

<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular-ui-router.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_app/app.js'); ?>"></script>
<script
    src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_app/services/paramService.js'); ?>"></script>
<script
    src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_app/services/accessLecturesService.js'); ?>"></script>
<script
    src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_app/services/pagesDataUpdateService.js'); ?>"></script>
<script
    src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_app/services/openDialogsService.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_app/services/userAnswerTaskService.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_app/services/getTaskJson.js'); ?>"></script>
<script
    src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_app/controllers/lessonPageCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_app/controllers/testCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_app/controllers/taskCtrl.js'); ?>"></script>
<script
    src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_app/controllers/skipTaskCtrl.js'); ?>"></script>
<script
    src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_app/controllers/plainTaskCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_app/directives/hoverSpot.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_app/directives/startVideo.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_app/configDynamic.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'ivpusic/angular-cookies.min.js'); ?>"></script>
<script
    src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-bootstrap/ui-bootstrap-tpls_0_13_0.js'); ?>"></script>
<link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrapRewrite.css') ?>"/>

<!--codemirror textarea hightlight-->
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/lib/codemirror.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/theme/rubyblue.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'codemirror.css'); ?>"/>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/lib/codemirror.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/mode/javascript/javascript.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/mode/clike/clike.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/mode/php/php.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-ui-codemirror/ui-codemirror.js'); ?>"></script>
<!--codemirror textarea hightlight-->
<?php
/* @var $this LessonController */
/* @var $lecture Lecture */
/* @var $page LecturePage */
/* @var integer $idCourse */
if (!isset($idCourse)) $idCourse = 0;
?>
<!-- lesson style -->
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lessonsStyle.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lectureStyles.css'); ?>"/>
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'modalTask.css'); ?>"/>
<?php
$passedLecture = Lecture::isPassedLecture($passedPages);
$finishedLecture = $lecture->isFinished($user);
?>
<script>
    interpreterServer='<?php echo Config::getInterpreterServer();?>';
    idCourse = <?php echo $idCourse;?>;
    idLecture = <?php echo $lecture->id;?>;
    idModule = <?php echo $lecture->idModule;?>;
    finishedLecture = <?php echo ($finishedLecture) ? 1 : 0;?>;
    idUser = <?php echo $user;?>;
    editMode = <?php echo ($editMode) ? 1 : 0;?>;
    partNotAvailable = '<?php echo Yii::t('lecture', '0638'); ?>';
    basePath = '<?php echo Config::getBaseUrl(); ?>';
    isAdmin = '<?php echo Yii::app()->user->model->isAdmin() ? 1 : 0; ?>';
    if (parseInt(editMode || isAdmin)) {
        lastAccessPage = 1;
    } else {
        lastAccessPage =<?php echo $lastAccessPage ?>;
    }
</script>
<div id="lessonHumMenu">
    <?php $this->renderPartial('/lesson/_lessonHamburgerMenu', array('idCourse' => $idCourse, 'module' => $lecture->module)); ?>
</div>
<div ng-cloak class="lessonBlock" id="lessonBlock" ng-app="lessonApp">
    <div ng-controller="lessonPageCtrl">
    <?php $this->renderPartial('_sidebar', array('lecture' => $lecture, 'editMode' => $editMode, 'idCourse' => $idCourse, 'finishedLecture' => $finishedLecture, 'passedPages' => $passedPages)); ?>
    <div class="lessonText">
        <div class="lessonTheme">
            <?php echo $lecture->title(); ?>
            <div style="display: inline-block; float: right; margin-top: 10px">
                <?php if ($editMode) { ?>
                    <a href="<?=Yii::app()->createUrl("revision/editlecture", array("idLecture" => $lecture->id)); ?>">
                        <img style="margin-left: 5px"
                             src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'edt_30px.png'); ?>"
                             id="editIco1" class="editButton" title="<?php echo Yii::t('lecture', '0686') ?>"/>
                    </a>
                <?php } ?>
            </div>
        </div>
        <?php
        $this->renderPartial('_jsLecturePageTabs', array('lectureId' => $lecture->id, 'page' => $page, 'lastAccessPage' => $lastAccessPage, 'dataProvider' => $dataProvider, 'finishedLecture' => $finishedLecture, 'passedLecture' => $passedLecture, 'passedPages' => $passedPages, 'editMode' => $editMode, 'user' => $user, 'order' => $lecture->order, 'idCourse' => $idCourse));
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
        $this->renderPartial('/lesson/_errorDialog');
        $this->endWidget('zii.widgets.jui.CJuiDialog');
        ?>

        <?php
        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => 'dialogNextLectureNG',
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
        if($isLastLecture){
            $this->renderPartial('/lesson/_moduleCompleteDialog', array('lecture' => $lecture));
        }else{
            $this->renderPartial('/lesson/_passLectureModal', array('lecture' => $lecture, 'idCourse' => $idCourse));
        }
        $this->endWidget('zii.widgets.jui.CJuiDialog');
        ?>
    </div>
</div>
<script src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'SidebarLesson.js'); ?>"></script>