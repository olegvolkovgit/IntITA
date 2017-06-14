<? $css_version = 1; ?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lectureStyles.css'); ?>"/>
<?php if($isVerified){ ?>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_app/config.js'); ?>"></script>
<?php } else { ?>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_app/configDynamic.js'); ?>"></script>
<?php } ?>
<?php
/* @var $this LessonController */
/* @var $lecture Lecture */
/* @var $page LecturePage */
/* @var integer $idCourse */
if (!isset($idCourse)) $idCourse = 0;
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/MathJax/MathJax.js?config=TeX-AMS-MML_HTMLorMML'); ?>"></script>
<!-- lesson style -->
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'modalTask.css'); ?>"/>
<?php
$passedLecture = Lecture::isPassedLecture($passedPages);
$finishedLecture = $lecture->isFinished($user);
?>
<script type="text/javascript">
    interpreterServer='<?php echo Config::getInterpreterServer();?>';
    idCourse = <?php echo $idCourse;?>;
    lang = '<?php echo CommonHelper::getLanguage();?>';
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
<div ng-cloak class="lessonBlock" id="lessonBlock">
    <div ng-controller="lessonPageCtrl">
        <div class="lectureHeaderMini">
            <div class="sidebarMini">
                <?php $this->renderPartial('_sidebarMain', array('lecture' => $lecture, 'editMode' => $editMode, 'idCourse' => $idCourse, 'finishedLecture' => $finishedLecture, 'passedPages' => $passedPages)); ?>
            </div>
        </div>
        <div id="sidebarLesson">
            <?php $this->renderPartial('_sidebarMain', array('lecture' => $lecture, 'editMode' => $editMode, 'idCourse' => $idCourse, 'finishedLecture' => $finishedLecture, 'passedPages' => $passedPages)); ?>
            <?php $this->renderPartial('_sidebarHelp', array('lecture' => $lecture, 'idCourse' => $idCourse)); ?>
        </div>
        <div class="lessonText">
            <div class="lessonTheme">
                <?php echo $lecture->title(); ?>
                <?php $this->renderPartial('_editLecture', array('lecture' => $lecture, 'editMode' => $editMode)); ?>
            </div>
            <?php
            $this->renderPartial('_jsLecturePageTabs', array('lectureId'=>$lecture->id, 'page' => $page, 'lastAccessPage' => $lastAccessPage, 'dataProvider' => $dataProvider, 'finishedLecture' => $finishedLecture, 'passedLecture' => $passedLecture, 'passedPages' => $passedPages, 'editMode' => $editMode, 'user' => $user, 'order' => $lecture->order, 'idCourse' => $idCourse));
            ?>
            <div class="lectureFooterMini">
                <?php $this->renderPartial('_sidebarHelp', array('lecture' => $lecture, 'idCourse' => $idCourse)); ?>
            </div>
        </div>

        <!--modal task error1-->
        <?php
        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => 'mydialog3',
            'themeUrl' => Config::getBaseUrl() . '/css',
            'cssFile' => 'jquery-ui.css',
            'theme' => 'my',
            'options' => array(
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
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'SidebarLesson.js'); ?>"></script>