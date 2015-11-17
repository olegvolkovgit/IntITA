<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 10.10.2015
 * Time: 10:59
 */
    if (!is_null($page->quiz)) {
        switch (lectureHelper::getQuizType($page->quiz)) {
            case '5':
                $this->renderPartial('_plainTaskBlock', array('data' => LectureElement::model()->findByPk($page->quiz), 'editMode' => $editMode, 'user' => $user));
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