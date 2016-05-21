<? $css_version = 1; ?>
<?php
/** @var $this LessonController
 * @var $page LecturePage
 * @var $lecture Lecture
 * @var $lectureElement LectureElement
 * @var $module Module
 */
$lecture = Lecture::model()->findByPk($page->id_lecture);
$module = $lecture->module;
if ($idCourse != 0) {
    $this->breadcrumbs = array(
        Yii::t('breadcrumbs', '0050') => Config::getBaseUrl() . "/courses",
        Course::getCourseTitleForBreadcrumbs($idCourse) => Yii::app()->createUrl('course/index', array('id' => $idCourse)),
        $module->getTitle() => Yii::app()->createUrl('module/index', array('idModule' => $module->module_ID, 'idCourse' => $idCourse)),
        $lecture->title() => Yii::app()->createUrl('lesson/index', array('id' => $page->id_lecture, 'idCourse' => $idCourse)),
    );
} else {
    $this->breadcrumbs = array(
        $module->getTitle() => Yii::app()->createUrl('module/index', array('idModule' => $module->module_ID)),
        $lecture->title() => Yii::app()->createUrl('lesson/index', array('id' => $page->id_lecture, 'idCourse' => $idCourse)),
    );
}
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular.min.js'); ?>"></script>

<script type="text/javascript">
    lang = '<?php echo CommonHelper::getLanguage();?>';
    idLecture = '<?php echo $page->id_lecture;?>';
    basePath = '<?php echo  Config::getBaseUrl(); ?>';
    idTeacher = '<?php echo $user;?>';
</script>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lessonsStyle.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'editPage.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lectureStyles.css'); ?>"/>
<link rel="stylesheet" type="text/css" href="http://latex.codecogs.com/css/equation-embed.css"/>
<!--[if lte IE 7]>
<link rel="stylesheet" href="http://latex.codecogs.com/css/ie6.css" type="text/css"/>
<![endif]-->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css">

<script type="text/javascript" src="http://latex.codecogs.com/js/eq_config.js"></script>
<script type="text/javascript" src="http://latex.codecogs.com/js/eq_editor-lite-18.js"></script>
<?php $this->renderPartial('/site/_hamburgermenu'); ?>
<div id="lecturePage" ng-app>
    <br>

    <h1 class="lessonPart">
        <?php echo Yii::t('lecture', '0073') . " " . $lecture->order . ': ';
        $title = Lecture::getTypeTitleParam();
        $this->widget('editable.EditableField', array(
            'type' => 'text',
            'model' => $lecture,
            'attribute' => $title,
            'emptytext' => Yii::t('config', '0575'),
            'url' => $this->createUrl('lesson/updateLectureAttribute'),
            'title' => Yii::t('lecture', '0567'),
            'placement' => 'right',
        )); ?>
    </h1>

    <h1 class="lessonPart">
        <div class="labelBlock">
            <p><?php echo Yii::t('lecture', '0615') . ' ' . $page->page_order . '. ';
                $this->widget('editable.EditableField', array(
                    'type' => 'textarea',
                    'model' => $page,
                    'attribute' => 'page_title',
                    'emptytext' => Yii::t('config', '0575'),
                    'url' => $this->createUrl('lesson/updateLecturePageAttribute'),
                    'placement' => 'right',
                ));
                ?></p>
        </div>
        <div>
            <a href="<?php echo Yii::app()->createURL('lesson/editPage', array('pageId' => $page->id, 'idCourse' => $idCourse, 'cke' => 1)); ?>">
                <img style="margin-left: 5px"
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'cke.png'); ?>"
                     id="editIco1" class="editButton" title="<?php echo Yii::t('lecture', '0686') . ' CKEditor' ?>"/>
            </a>
            <a href="<?php echo Yii::app()->createUrl('lesson/showPagesList', array('idLecture' => $page->id_lecture,
                'idCourse' => $idCourse)); ?>">
                <img style="margin-left: 5px"
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'list.jpg'); ?>"
                     class="editButton" title="<?php echo Yii::t('lecture', '0688'); ?>"/>
            </a>
            <a href="<?php echo Yii::app()->createUrl('lesson/index', array('id' => $page->id_lecture, 'idCourse' => $idCourse)); ?>">
                <img style="margin-left: 5px"
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'view.png'); ?>"
                     id="editIco1" class="editButton" title="<?php echo Yii::t('lecture', '0687'); ?>"/>
            </a>
        </div>
    </h1>
    <h3><label for="pageVideo"><?php echo Yii::t('lecture', '0613'); ?></label></h3>
    <?php
    if ($page->video == null) { ?>
        <?php $this->renderPartial('/editor/_addVideo', array('idLecture' => $page->id_lecture, 'pageOrder' =>
            $page->page_order)); ?>
        <button onclick="addVideoInput()" id="addVideoStart"><?php echo Yii::t('lecture', '0689'); ?></button>
        <?php
    } else {
        $lectureElement = LectureElement::model()->findByPk($page->video);
        $this->widget('editable.EditableField', array(
            'type' => 'textarea',
            'model' => $lectureElement,
            'attribute' => 'html_block',
            'emptytext' => Yii::t('config', '0575'),
            'url' => $this->createUrl('lesson/updateLectureElementAttribute'),
            'placement' => 'right',
        ));
        ?>
        <div class="videoDeleteButton">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png'); ?>" class="editIco"
                 onclick="deleteVideo(<?php echo $page->id_lecture; ?>, <?php echo $page->page_order; ?>);">
        </div>
    <?php } ?>

    <br>
    <br>
    <fieldset>
        <legend><?php echo Yii::t('lecture', '0690'); ?></legend>
        <?php $this->renderPartial('/editor/imperavi/_blocks_list', array('dataProvider' => $dataProvider,
            'countBlocks' => count($dataProvider), 'editMode' => 1, 'user' => $user)); ?>

        <div id="addBlock">
            <?php
            $this->renderPartial('/editor/imperavi/_addBlock', array('lecture' => $lecture, 'editMode' => 1,
                'teacher' => $user, 'pageOrder' => $page->page_order));
            ?>
        </div>
        <br>

        <div id="buttonsTextListPanel">
            <?php echo Yii::t('lecture', '0691'); ?>
            <br>
            <button onclick="addTextBlock('1')"><?php echo Yii::t('lecture', '0692'); ?></button>
            <button onclick="addTextBlock('3')"><?php echo Yii::t('lecture', '0693'); ?></button>
            <button onclick="addTextBlock('4')"><?php echo Yii::t('lecture', '0694'); ?></button>
            <button onclick="addTextBlock('7')"><?php echo Yii::t('lecture', '0695'); ?></button>
        </div>
    </fieldset>
    <h3><label for="pageQuiz"><?php echo Yii::t('lecture', '0696'); ?></label></h3>
    <?php
    if ($page->quiz != null) {
        $data = LecturePage::getPageQuiz($page->id);

        switch (LectureElement::getQuizType($data['id_block'])) {
            case '6':
                $this->renderPartial('/editor/imperavi/_editPlainTask', array('data' => $data,
                    'pageId' => $page->id));
                break;
            case '12':
            case '13':
                $this->renderPartial('/editor/imperavi/_editTest', array('idBlock' => $data['id_block'],
                    'pageId' => $page->id));
                break;
            default:
                break;
        }
    } else {
        ?>
    <div id="buttonsPanel">
        <button onclick="showAddTestForm('plain')"><?php echo Yii::t('lecture', '0697'); ?></button>
        <button onclick="showAddPlainTaskForm('plainTask')"><?php echo Yii::t('lecture', '0698'); ?></button>
    </div>
        <?php
    }
    ?>
    <?php if ($page->quiz == null) {
        $author = $user;
        $this->renderPartial('/editor/imperavi/_addTest', array('lecture' => $lecture->id, 'author' => $author, 'pageId' => $page->id));
        $this->renderPartial('/editor/imperavi/_addPlainTask', array('lecture' => $lecture->id,
            'author' => $author, 'pageId' => $page->id));
    } ?>
</div>
<br>
<br>
<script src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'lessonEditor.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'loadRedactor.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'LecturePageEditor.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'tasks.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'tests.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'plainTask.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'formulaEditor.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'skipTask.js'); ?>"></script>

