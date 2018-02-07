<? $css_version = 1; ?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lectureStyles.css'); ?>"/>
<?php if ($isVerified) { ?>
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
    interpreterServer = '<?php echo Config::getInterpreterServer();?>';
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

<div id="lessonHumMenu" data-toggle="tooltip" title="Меню INTITA">
    <?php $this->renderPartial('/lesson/_lessonHamburgerMenu', array('idCourse' => $idCourse, 'module' => $lecture->module)); ?>
</div>
            <a class='consultationButtons'
   href="<?php echo Yii::app()->createUrl('/consultationscalendar/index', array('lectureId' => $lecture->id, 'idCourse' => $idCourse)); ?>">
    <div id="consultationAssistance" data-toggle="tooltip" data-placement="bottom" title="Запланувати консультацію">
        <img class="consultationLogos"
             src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'consultationLogo.png'); ?>">
        <div class="consultationText">Запланувати консультацію</div>
    </div>
</a>
<div class="consultations">
    <a class='consultationButtons'
       href="<?php echo Yii::app()->createUrl('/consultationscalendar/index', array('lectureId' => $lecture->id, 'idCourse' => $idCourse)); ?>">
    </a>
</div>

<div ng-cloak class="lessonBlock" id="lessonBlock">
    <div ng-controller="lessonPageCtrl">
        <div class="lessonText">
            <div>
                <div class="lessonTheme">
                    <?php echo $lecture->title(); ?>
                    <?php $this->renderPartial('_editLecture', array('lecture' => $lecture, 'editMode' => $editMode)); ?>
                </div>
                <div ng-if=lectureRating class="lecturesSpots" style="padding: 0;">
                    <?php echo Yii::t('graduates', '0319') ?> <span animate-on-change="lectureRating">{{lectureRating*10| limitTo:3}}/10</span>
                </div>
                <div ng-if=lecturesData.currentOrder class="lecturesSpots" style="padding: 0;">
                    ({{lecturesData.currentOrder}} /
                    {{lecturesData.module.lectures.length}} <?php echo Yii::t('lecture', '0616'); ?>)
                </div>
            </div>
                <div id="counter">
                <span ng-repeat="lecture in lecturesData.module.lectures track by $index">
                    <a ng-if=(+lecture.order<=+lecturesData.lastAccessLectureOrder)
                       href=""
                       ng-click="lectureLink(lecture.id, lecturesData.courseId)"
                       uib-tooltip-html="lecture.title">
                        <div class="lectureAccess"
                             ng-class="{thisLecture: lecture.order=='<?php echo $lecture->order; ?>'}"></div>
                    </a>
                    <a ng-if=!(lecture.order<=+lecturesData.lastAccessLectureOrder)
                       uib-tooltip-html="'<span class=\'titleNoAccessMin\'>{{lecture.title | unsafe}}</span><span class=\'noAccessMin\'> (Заняття недоступне)</span>'">
                        <div class="lectureDisabled"></div>
                    </a>
                </span>
                    <div ng-if=lecturesData.currentOrder id="iconImage">
                        <?php if ($lecture->module->isModuleDone()) { ?>
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'medalIco.png'); ?>"/>
                        <?php } else { ?>
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'medalIcoFalse.png'); ?>"/>
                        <?php } ?>
                    </div>
                </div>
                <div class="spoilerLinks col-md-9,5" data-toggle="collapse" data-target="#spoilerBody">
                <span class="spoilerClick" data-toggle="tooltip" title="Зміст розділу"><span class="spoilerTitle">
                        <?php echo Lecture::getLectureTitle($idLecture); ?>
                    </span><div class="spoilerTriangle"
                                id="spoilerTriangle">(<span><?php echo Yii::t('lecture', '0080') ?>
                        </span>
                        <span id='trg'>&#9660;</span>)
                    </div>
                </span>
                </div>
                <div class="spoilerBody collapse" id="spoilerBody">
                    <p ng-repeat="page in pageData">
                        <a
                                ng-class="{pageAccess: page.isDone || editMode || isAdmin}"
                                ui-sref="{{(page.isDone || editMode || isAdmin) ? 'page({page: $index+1})' : '.'}}"
                        >
                            <?php echo Yii::t('lecture', '0615') . ' ' ?>{{($index+1)+'. '+page.title}}
                        </a>
                    </p>
                </div>
            <!-- Spoiler -->
            <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'chaptersSpoiler.js'); ?>"></script>
            <!-- Spoiler -->
            <?php
            $this->renderPartial('_jsLecturePageTabs', array('lectureId' => $lecture->id, 'page' => $page, 'lastAccessPage' => $lastAccessPage, 'dataProvider' => $dataProvider, 'finishedLecture' => $finishedLecture, 'passedLecture' => $passedLecture, 'passedPages' => $passedPages, 'editMode' => $editMode, 'user' => $user, 'order' => $lecture->order, 'idCourse' => $idCourse));
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
        if ($isLastLecture) {
            $this->renderPartial('/lesson/_moduleCompleteDialog', array('lecture' => $lecture));
        } else {
            $this->renderPartial('/lesson/_passLectureModal', array('lecture' => $lecture, 'idCourse' => $idCourse));
        }
        $this->endWidget('zii.widgets.jui.CJuiDialog');
        ?>
    </div>
</div>

<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'SidebarLesson.js'); ?>"></script>