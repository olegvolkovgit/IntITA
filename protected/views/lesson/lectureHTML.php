<?php
/* @var $this LessonController */
/* @var $lecture Lecture */
/* @var $page LecturePage */
/* @var $teacher Teacher */
/* @var integer $idCourse */
$idCourse = 0;

$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs' => array(
        $messages['613'] => array('id' => 'video', 'content' => $this->renderPartial(
            '/lesson/_videoTab',
            array('page' => $page, 'message' => $messages['613']), true
        )),
        $messages['614'] => array('id' => 'text', 'content' => $this->renderPartial(
            '/lesson/_textListTab',
            array('dataProvider' => $dataProvider, 'editMode' => 0, 'user' => 49), true
        )),
        $messages['659'] => array('id' => 'quiz', 'content' => $this->renderPartial(
            '/lesson/_quiz',
            array('page' => $page, 'editMode' => 0, 'user' => 49), true
        )
        ),
    ),
    'options' => array(
        'collapsible' => true,
        'active' => 1,
    ),
    'id' => 'MyTab-Menu',
));
?>
