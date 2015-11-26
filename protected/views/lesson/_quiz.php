<?php
/* @var $page LecturePage*/
    if (!is_null($page->quiz)) {
        switch (lectureHelper::getQuizType($page->quiz)) {
            case '5':
                $this->renderPartial('_taskBlock', array(
                    'data' => LectureElement::model()->findByPk($page->quiz),
                    'editMode' => $editMode,
                    'user' => $user
                ));
                break;
            case '6':
                $this->renderPartial('_plainTaskBlock', array(
                    'data' => LectureElement::model()->findByPk($page->quiz),
                    'editMode' => $editMode,
                    'user' => $user
                ));
                break;
            case '12':
            case '13':
                $this->renderPartial('_testBlock', array(
                    'data' => LectureElement::model()->findByPk($page->quiz),
                    'editMode' => $editMode,
                    'user' => $user
                    ));
                break;
            default:
                break;
        }
    }
?>