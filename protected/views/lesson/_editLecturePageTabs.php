<?php
/* @var $this LessonController */
/* @var $page LecturePage */
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<h1 class="lessonPart">
    <div class="labelBlock">
        <p>Сторінка <?php echo $page->page_order . '. ' . $page->page_title; ?></p>
    </div>
</h1>

<form method="post" action="<?php echo Yii::app()->createUrl('lesson/createNewPage'); ?>">
    <h3><label for="pageTitle">Назва сторінки</label></h3>
    <input type="text" name="pageTitle" placeholder="Введіть назву сторінки" size="108"
           value="<?php echo $page->page_title; ?>"/>
    <br>

    <h3><label for="pageVideo">Відео</label></h3>
    <input type="text" name="pageVideo" placeholder="Введіть посилання на відео сторінки лекції" size="108"
           value="<?php echo LectureHelper::getPageVideoUrl($page->id); ?>"/>
    <br>
    <br>
    <fieldset>
        <legend>Текстовий блок:</legend>
        <?php $this->renderPartial('_blocks_list', array('dataProvider' => $dataProvider, 'countBlocks' => $countBlocks, 'editMode' => $editMode, 'user' => $user)); ?>
        Додати:
        <br>
        <a href="#">|  Текст  |</a>
        <a href="#">  Код  |</a>
        <a href="#">  Приклад  |</a>
        <a href="#">  Інструкція  |</a>
        <a href="#">  Формула LaTeX  |</a>
        <div id="addBlock"></div>
    </fieldset>
    <h3><label for="pageQuiz">Завдання (тест) лекції</label></h3>
    <?php
    $data = LectureHelper::getPageQuiz($page->id);
    $this->widget('zii.widgets.jui.CJuiTabs', array(
        'tabs' => array(
            'Тест' => array('id' => 'test', 'content' => $this->renderPartial(
                '_testBlock',
                array('data'=>$data, 'editMode' => $editMode, 'user' => $user), true
            )),
            'Завдання' => array('id' => 'task', 'content' => $this->renderPartial(
                '_taskBlock',
                array('data'=>$data, 'editMode' => $editMode, 'user' => $user), true
            )),
        ),
        // additional javascript options for the tabs plugin
        'options' => array(
            'collapsible' => true,
        ),
        'id' => 'MyTab-Menu',
        'themeUrl' => Yii::app()->request->baseUrl . '/themes',
        'cssFile' => 'jquery-ui.min.css',
        'theme' => 'smoothness',
    ));
    ?>
    <br>
    <input type="submit" value="Зберегти"/>
</form>