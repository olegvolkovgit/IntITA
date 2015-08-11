<?php
/* @var $this LessonController */
/* @var $page LecturePage */
/* @var $lectureElement LectureElement */
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<h1 class="lessonPart">
    <div class="labelBlock">
        <p>Сторінка <?php echo $page->page_order . '. ' . $page->page_title; ?></p>
    </div>
</h1>

<h3><label for="pageTitle">Назва сторінки</label></h3>
<?php
$this->widget('editable.EditableField', array(
    'type' => 'textarea',
    'model' => $page,
    'attribute' => 'page_title',
    'emptytext' => Yii::t('config', '0575'),
    'url' => $this->createUrl('lesson/updateLecturePageAttribute'),
    'placement' => 'right',
));
?>
<br>

<h3><label for="pageVideo">Відео</label></h3>
<?php
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

<br>
<br>
<fieldset>
    <legend>Текстовий блок:</legend>
    <?php $this->renderPartial('_blocks_list', array('dataProvider' => $dataProvider, 'countBlocks' => $countBlocks, 'editMode' => $editMode, 'user' => $user)); ?>

    <div id="addBlock">
        <?php
        $lecture = Lecture::model()->findByPk($page->id_lecture);
        $this->renderPartial('_addBlock', array('lecture'=>$lecture, 'countBlocks' => $countBlocks, 'editMode' => $editMode, 'teacher' => TeacherHelper::getTeacherId($user)));
        ?>
    </div>
    Додати:
    <br>
    <a href="#" onclick="addTextBlock()">| Текст |</a>
    <a href="#"> Код |</a>
    <a href="#"> Приклад |</a>
    <a href="#"> Інструкція |</a>
    <a href="#"> Формула LaTeX |</a>

</fieldset>
<h3><label for="pageQuiz">Завдання (тест) лекції</label></h3>
<?php
$data = LectureHelper::getPageQuiz($page->id);
$this->renderPartial('_editTest', array('idBlock' => $data['id_block'], 'editMode' => $editMode));

?>
