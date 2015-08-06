<?php
/**
 * @var $page LecturePage;
 */
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<?php
$this->widget('zii.widgets.jui.CJuiTabs',array(
    'tabs'=>array(
        'Відео'=>array('id'=>'video','content'=>$this->renderPartial(
            '_videoTab',
            array('page' => $page),true
        )),
        'Текст'=>array('id'=>'text','content'=>$this->renderPartial(
            '_textListTab',
            array('dataProvider'=>$dataProvider, 'countBlocks' => $countBlocks, 'editMode' => $editMode, 'user' => $user),true
        )),
    ),
    // additional javascript options for the tabs plugin
    'options'=>array(
        'collapsible'=>true,
    ),
    'id'=>'MyTab-Menu',
));

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