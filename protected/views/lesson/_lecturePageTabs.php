<?php
/**
 * @var $page LecturePage;
 */
?>
<div name="lecturePage">
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/cjuitabs.css" />
    <h1 class="lessonPart" >
        <div class="labelBlock">
            <p>Частина <?php echo $page->page_order.'. '.$page->page_title;?></p>
        </div>
    </h1>
<?php
for ($i = 0, $count = count($passedPages); $i < $count;$i++) {
    if ($passedPages[$i]['isDone']) {
        ?>
        <a href="<?php $args = $_GET;
             $args['page'] = $passedPages[$i]['order'];
            echo $this->createUrl('', $args);?>"
            title="Сторінка <?php echo $passedPages[$i]['order'];?>">
        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'pageDone.png');?>">
        </a>
    <?php } else {
        ?>
        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'pageNoAccess.png');?>"
        alt="Сторінка <?php echo $passedPages[$i]['order'];?>">
    <?php }
}?>
<br>
<div class="tabsWidget">
<?php
if($page->video == null){
    $this->widget('zii.widgets.jui.CJuiTabs', array(
        'tabs' => array(
            'Текст' => array('id' => 'text', 'content' => $this->renderPartial(
                '_textListTab',
                array('dataProvider' => $dataProvider, 'countBlocks' => $countBlocks, 'editMode' => 0, 'user' => $user), true
            )),
        ),
        // additional javascript options for the tabs plugin
        'options' => array(
            'collapsible' => true,
        ),
        'id' => 'MyTab-Menu',
    ));
}else {
    $this->widget('zii.widgets.jui.CJuiTabs', array(
        'tabs' => array(
            'Відео' => array('id' => 'video', 'content' => $this->renderPartial(
                '_videoTab',
                array('page' => $page), true
            )),
            'Текст' => array('id' => 'text', 'content' => $this->renderPartial(
                '_textListTab',
                array('dataProvider' => $dataProvider, 'countBlocks' => $countBlocks, 'editMode' => 0, 'user' => $user), true
            )),
        ),
        // additional javascript options for the tabs plugin
        'options' => array(
            'collapsible' => true,
        ),
        'id' => 'MyTab-Menu',
    ));
}
?>
</div>

<?php
if (!is_null($page->quiz)) {
    switch (lectureHelper::getQuizType($page->quiz)) {
        case '5':
            $this->renderPartial('_taskBlock', array('data' => LectureElement::model()->findByPk($page->quiz), 'editMode' => $editMode, 'user' => $user));
            break;
        case '6':
            $this->renderPartial('_taskBlock', array('data' => LectureElement::model()->findByPk($page->quiz), 'editMode' => $editMode, 'user' => $user));
            break;
        case '12':
            $this->renderPartial('_testBlock', array('data' => LectureElement::model()->findByPk($page->quiz), 'editMode' => $editMode, 'user' => $user));
            break;
        case '13':
            $this->renderPartial('_testBlock', array('data' => LectureElement::model()->findByPk($page->quiz), 'editMode' => $editMode, 'user' => $user));
            break;
        default:
            break;
    }
}
?>
</div>
<br>
<br>