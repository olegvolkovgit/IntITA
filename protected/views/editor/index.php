<?php
/* @var $this LessonController */
/* @var $page LecturePage */
/* @var $lectureElement LectureElement */
$module = LectureHelper::getModuleByLecture($page->id_lecture);
$this->setPageTitle('IntITA');
if($idCourse != 0) {
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
<script type="text/javascript">
    lang = '<?php echo LectureHelper::getLanguage();?>';
    idLecture = '<?php echo $page->id_lecture;?>';
</script>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lessonsStyle.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'editPage.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lectureStyles.css'); ?>" />
<link rel="stylesheet" type="text/css" href="http://latex.codecogs.com/css/equation-embed.css" />
<!--[if lte IE 7]>
<link rel="stylesheet" href="http://latex.codecogs.com/css/ie6.css" type="text/css"/>
<![endif]-->
<script type="text/javascript" src="http://latex.codecogs.com/js/eq_config.js" ></script>
<script type="text/javascript" src="http://latex.codecogs.com/js/eq_editor-lite-18.js" ></script>
<div id="lecturePage">
    <br>
    <h1 class="lessonPart">
    <?php echo Yii::t('lecture','0073')." ".$lecture->order.': ';
    $title = LectureHelper::getTypeTitleParam();
    $this->widget('editable.EditableField', array(
    'type'      => 'text',
    'model'     => $lecture,
    'attribute' => $title,
    'emptytext' => Yii::t('config','0575'),
    'url'       => $this->createUrl('lesson/updateLectureAttribute'),
    'title'     => Yii::t('lecture','0567'),
    'placement' => 'right',
    ));?>
        </h1>
    <h1 class="lessonPart">
    <div class="labelBlock">
        <p>Частина <?php echo $page->page_order . '. ';
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
                'idCourse' => $idCourse));?>">
                <img style="margin-left: 5px" src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'list.jpg'); ?>"
                     class="editButton" title="Список частин заняття"/>
            </a>
            <a href="<?php echo Yii::app()->createUrl('lesson/index', array('id' => $page->id_lecture, 'page' =>
                $page->page_order, 'idCourse' => $idCourse));?>">
                <img style="margin-left: 5px" src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'view.png'); ?>"
                     id="editIco1" class="editButton" title="Режим перегляду"/>
            </a>
        </div>
    </h1>
    <?php $this->renderPartial('/editor/_lectureProgressEdit', array('page'=>$page,'user'=>$user,
        'idCourse' => $idCourse)); ?>
<h3><label for="pageVideo">Відео</label></h3>
<?php
if($page->video == null) {?>
    <?php $this->renderPartial('/editor/_addVideo', array('idLecture' => $page->id_lecture, 'pageOrder' =>
        $page->page_order));?>
    <button onclick="addVideo()" id="addVideoStart">Додати відео</button>
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
}
?>

<br>
<br>
<fieldset>
    <legend>Текстовий блок:</legend>
    <?php $this->renderPartial('/lesson/_blocks_list', array('dataProvider' => $dataProvider,
        'countBlocks' => count($dataProvider), 'editMode' => 1, 'user' => $user)); ?>

    <div id="addBlock">
        <?php
        $lecture = Lecture::model()->findByPk($page->id_lecture);
        $this->renderPartial('/editor/_addBlock', array('lecture'=>$lecture, 'editMode' => 1,
            'teacher' => TeacherHelper::getTeacherId($user), 'pageOrder' => $page->page_order));
        ?>
    </div>
    <br>
    Додати:
    <br>
    <button onclick="addTextBlock('1')"> Текст </button>
    <button onclick="addTextBlock('3')"> Код </button>
    <button onclick="addTextBlock('4')"> Приклад </button>
    <button onclick="addTextBlock('7')"> Інструкція </button>
</fieldset>
<h3><label for="pageQuiz">Завдання (тест)</label></h3>
<?php
    if($page->quiz != null) {
        $data = LectureHelper::getPageQuiz($page->id);

        switch (LectureHelper::getQuizType($data['id_block'])) {
            case '5':
            case '6':
                $this->renderPartial('/editor/_editTask', array('idBlock' => $data['id_block'],
                    'pageId' => $page->id));
                break;
            case '12':
            case '13':
                $this->renderPartial('/editor/_editTest', array('idBlock' => $data['id_block'],
                    'pageId' => $page->id));
                break;
            default:
                break;
        }
    } else{
        ?>
        <button onclick="showAddTestForm('plain')"> Додати тест </button>
<!--        <button onclick="showAddTaskForm('plain')"> Додати задачу </button>-->
        <?php
    }
?>
<?php $this->renderPartial('/editor/_addTest', array('lecture' => $lecture->id,
    'author' => TeacherHelper::getTeacherId($user), 'pageId' => $page->id));?>
<?php $this->renderPartial('/editor/_addTask', array('pageId' => $page->id));?>
</div>
<br>
<br>
<script src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'lessonEditor.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'loadRedactor.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'LecturePageEditor.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'tasks.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'formulaEditor.js'); ?>"></script>

