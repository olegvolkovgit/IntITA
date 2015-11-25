<?php
/* @var $this LessonController */
/* @var $page LecturePage */
/* @var $lectureElement LectureElement */
$module = LectureHelper::getModuleByLecture($page->id_lecture);
$this->setPageTitle('INTITA');
if ($idCourse != 0) {
    $this->breadcrumbs = array(
        Yii::t('breadcrumbs', '0050') => Config::getBaseUrl() . "/courses",
        CourseHelper::getCourseName($idCourse) => Yii::app()->createUrl('course/index', array('id' => $idCourse)),
        ModuleHelper::getModuleName($module) => Yii::app()->createUrl('module/index', array('idModule' => $module, 'idCourse' => $idCourse)),
        LectureHelper::getLectureTitle($page->id_lecture) =>
            Yii::app()->createUrl('lesson/index', array('id' => $page->id_lecture, 'idCourse' => $idCourse)),
    );
} else {
    $this->breadcrumbs = array(
        ModuleHelper::getModuleName($module) => Yii::app()->createUrl('module/index', array('idModule' => $module)),
        LectureHelper::getLectureTitle($page->id_lecture) =>
            Yii::app()->createUrl('lesson/index', array('id' => $page->id_lecture, 'idCourse' => $idCourse)),
    );
}
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'ckeditor/ckeditor.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/ng-ckeditor.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/app.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/controllers.js'); ?>"></script>

<script type="text/javascript">
    lang = '<?php if(LectureHelper::getLanguage()=='ua') echo 'uk'; else echo LectureHelper::getLanguage();?>';
    idLecture = '<?php echo $page->id_lecture;?>';
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
<script>
    basePath='<?php echo  Config::getBaseUrl(); ?>';
    idTeacher = '<?php echo TeacherHelper::getTeacherId($user);?>';
    idLecture = '<?php echo $page->id_lecture;?>';
</script>
<?php $this->renderPartial('/site/_hamburgermenu'); ?>
<div ng-app="lessonEdit">
    <div ng-controller="CKEditorCtrl">
        <div data-ng-init="
        deleteMsg='<?php echo addslashes(Yii::t('lecture', '0767')); ?>';
        errorMsg='<?php echo addslashes(Yii::t('lecture', '0768')); ?>';
        editMsg='<?php echo addslashes(Yii::t('lecture', '0769')); ?>';
        saveMsg='<?php echo addslashes(Yii::t('lecture', '0770')); ?>';
        saveBtn='<?php echo addslashes(Yii::t('lecture', '0771')); ?>';
        closeBtn='<?php echo addslashes(Yii::t('lecture', '0772')); ?>';
            ">
        </div>
        <div id="lecturePage">
            <br>
            <h1 class="lessonPart">
                <?php echo Yii::t('lecture', '0073') . " " . $lecture->order . ': ';
                $title = LectureHelper::getTypeTitleParam();
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
            <?php $this->renderPartial('/editor/_lectureProgressEdit', array('page' => $page, 'user' => $user,
                'idCourse' => $idCourse)); ?>
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
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png'); ?>"
                         class="editIco"
                         onclick="deleteVideo(<?php echo $page->id_lecture; ?>, <?php echo $page->page_order; ?>);">
                </div>
            <?php } ?>
            <br>
            <br>
            <fieldset>
                <legend><?php echo Yii::t('lecture', '0690'); ?></legend>
                <div id="blockList">
                    <?php $this->renderPartial('/lesson/_blocks_list_CKE', array('dataProvider' => $dataProvider,
                        'countBlocks' => count($dataProvider), 'editMode' => 1, 'user' => $user)); ?>
                </div>
                <div id="addBlock">
                    <?php
                    $lecture = Lecture::model()->findByPk($page->id_lecture);
                    $this->renderPartial('/editor/_addBlockCKE', array('lecture' => $lecture, 'editMode' => 1,
                        'teacher' => TeacherHelper::getTeacherId($user), 'pageOrder' => $page->page_order));
                    ?>
                </div>
                <br>
                <div style="display: block; clear: both">
                    <?php echo Yii::t('lecture', '0691'); ?>
                    <br>
                    <button selected-button onclick="addTextBlockCKE('1')"><?php echo Yii::t('lecture', '0692'); ?></button>
                    <button selected-button onclick="addTextBlockCKE('3')"><?php echo Yii::t('lecture', '0693'); ?></button>
                    <button selected-button onclick="addTextBlockCKE('4')"><?php echo Yii::t('lecture', '0694'); ?></button>
                    <button selected-button onclick="addTextBlockCKE('7')"><?php echo Yii::t('lecture', '0695'); ?></button>
                </div>
            </fieldset>
            <h3><label for="pageQuiz"><?php echo Yii::t('lecture', '0696'); ?></label></h3>
            <?php
            if ($page->quiz != null) {
                $data = LectureHelper::getPageQuiz($page->id);

                switch (LectureHelper::getQuizType($data['id_block'])) {
                    case '5':
                        $this->renderPartial('/editor/_editTask', array('idBlock' => $data['id_block'],
                            'pageId' => $page->id));
                        break;
                    case '6':
                        $this->renderPartial('/editor/_editPlainTaskCKE', array('data' => $data,
                            'pageId' => $page->id));
                        break;
                    case '12':
                    case '13':
                        $this->renderPartial('/editor/_editTestCKE', array('idBlock' => $data['id_block'],
                            'pageId' => $page->id));
                        break;
                    default:
                        break;
                }
            } else {
                ?>
            <div id="buttonsPanel">
                <button onclick="showAddTestFormCKE('plain')"><?php echo Yii::t('lecture', '0697'); ?></button>
                <button onclick="showAddPlainTaskFormCKE('plainTask')"><?php echo Yii::t('lecture', '0698'); ?></button>
                <button onclick="showAddTaskForm('plain')"><?php echo Yii::t('lecture', '0699'); ?></button>
                <button onclick="showAddSkipTaskForm()">Додати задачу з пропусками</button>
            </div>
                <?php
            }
            ?>
            <?php if ($page->quiz == null) {
                $author = TeacherHelper::getTeacherId($user);
            $this->renderPartial('/editor/_addTestCKE', array('lecture' => $lecture->id, 'author' => $author, 'pageId' => $page->id));
            $this->renderPartial('/editor/_addTaskCKE', array('pageId' => $page->id));
            $this->renderPartial('/editor/_addPlainTaskCKE', array('lecture' => $lecture->id, 'author' => $author, 'pageId' => $page->id));
            $this->renderPartial('/editor/_addSkipTaskCKE', array('pageId' => $page->id, 'lecture' => $lecture->id, 'author' => $author));
            }?>
        </div>
    </div>
</div>
<script src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'lessonEditor.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'LecturePageEditor.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'tasks.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'tests.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'skipTask.js'); ?>"></script>

