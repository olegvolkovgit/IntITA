<?php
/* @var $this LessonController */
/* @var $page LecturePage */
/* @var $lectureElement LectureElement */
if(!$editMode) {
    throw new CHttpException(403, Yii::t('errors', 'Вибачте. Ви не маєте прав редагувати цю лекцію.'));
}
$page = LecturePage::model()->findByAttributes(array('id_lecture' => $_GET['id'], 'page_order' => $_GET['editPage']));

if (isset($_GET['editPage'])) $thisPage = $_GET['editPage'];
else $thisPage = 1;
?>
<link rel="stylesheet" type="text/css"
      href="http://latex.codecogs.com/css/equation-embed.css" />
<!--[if lte IE 7]>
<link rel="stylesheet" href="http://latex.codecogs.com/css/ie6.css" type="text/css"/>
<![endif]-->
<script type="text/javascript" src="http://latex.codecogs.com/js/eq_config.js" ></script>
<script type="text/javascript" src="http://latex.codecogs.com/js/eq_editor-lite-18.js" ></script>
<div name="lecturePage">
    <?php $this->renderPartial('_lectureProgress', array('page'=>$page,'passedPages'=>$passedPages,'user'=>$user, 'thisPage'=>$thisPage, 'edit'=>1, 'idCourse' => $idCourse)); ?>
<script type="text/javascript">
    lang = '<?php echo LectureHelper::getLanguage();?>';
    idLecture = '<?php echo $_GET['id'];?>';
</script>

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
</h1>
<h3><label for="pageVideo">Відео</label></h3>
<?php
if($page->video == null) {?>
    <?php $this->renderPartial('_addVideo', array('idLecture' => $page->id_lecture, 'pageOrder' => $page->page_order));?>
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
    <?php $this->renderPartial('_blocks_list', array('dataProvider' => $dataProvider, 'countBlocks' => count($dataProvider), 'editMode' => 1, 'user' => $user)); ?>

    <div id="addBlock">
        <?php
        $lecture = Lecture::model()->findByPk($page->id_lecture);
        $this->renderPartial('_addBlock', array('lecture'=>$lecture, 'editMode' => $editMode, 'teacher' => TeacherHelper::getTeacherId($user), 'pageOrder' => $page->page_order));
        ?>
    </div>
<!--    --><?php //$this->renderPartial('_addFormula', array('idLecture' => $lecture->id, 'pageOrder' => $page->page_order));?>
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
                $this->renderPartial('_editTask', array('idBlock' => $data['id_block'], 'pageId' => $page->id));
                break;
            case '12':
            case '13':
                $this->renderPartial('_editTest', array('idBlock' => $data['id_block'], 'pageId' => $page->id));
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
<?php $this->renderPartial('_addTest', array('lecture' => $lecture->id, 'author' => TeacherHelper::getTeacherId($user), 'pageId' => $page->id));?>
<?php //$this->renderPartial('_addTask', array('pageId' => $page->id));?>
</div>
<br>
<br>
<script>
    if(typeof <?php echo $_GET['editPage'];?> !== "undefined"){
        $('#sharing').remove();
    }
</script>
