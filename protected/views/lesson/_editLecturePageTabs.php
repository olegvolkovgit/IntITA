<?php
/* @var $this LessonController */
/* @var $page LecturePage */
/* @var $lectureElement LectureElement */

$page = LecturePage::model()->findByAttributes(array('id_lecture' => $_GET['id'], 'page_order' => $_GET['editPage']));
?>

<div name="lecturePage">
    <?php
for ($i = 0, $count = LectureHelper::getNumberLecturePages($page->id_lecture); $i < $count;$i++) {
  ?>
        <a href="<?php echo Yii::app()->createURL('lesson/index', array('id' => $_GET['id'], 'idCourse' => $_GET['idCourse'], 'editPage' => $i+1));?>"
           title="Частина <?php echo ($i+1);?>">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'pageDone.png');?>">
        </a>
<?php
}?>
<script type="text/javascript">
    lang = '<?php echo LectureHelper::getLanguage();?>';
</script>

<h1 class="lessonPart">
    <div class="labelBlock">
        <p>Сторінка <?php echo $page->page_order . '. ';
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
        $this->renderPartial('_addBlock', array('lecture'=>$lecture, 'countBlocks' => $countBlocks, 'editMode' => $editMode, 'teacher' => TeacherHelper::getTeacherId($user), 'pageOrder' => $page->page_order));
        ?>
    </div>
    <?php $this->renderPartial('_addFormula', array('idLecture' => $lecture->id, 'pageOrder' => $page->page_order));?>
    <br>
    Додати:
    <br>
    <button onclick="addTextBlock('1')"> Текст </button>
    <button onclick="addTextBlock('3')"> Код </button>
    <button onclick="addTextBlock('4')"> Приклад </button>
    <button onclick="addTextBlock('7')"> Інструкція </button>
    <button onclick="addFormula()"> Формула LaTeX </button>

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
        <button onclick="showAddTaskForm('plain')"> Додати задачу </button>
        <?php
    }
?>
<?php $this->renderPartial('_addTest', array('lecture' => $lecture->id, 'author' => TeacherHelper::getTeacherId($user), 'pageId' => $page->id));?>
<?php $this->renderPartial('_addTask', array('pageId' => $page->id));?>
</div>
<br>
<br>
