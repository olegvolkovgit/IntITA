<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 07.12.2015
 * Time: 16:57
 */
?>
<!--[if !IE]><!-->
<!--<div class="fullScreen_button_container">-->
<!--    <button id="changeColor" class="fullScreen" onclick="enterFullscreen('quiz')" title="Розгорнути"></button>-->
<!--</div>-->
<!--<![endif]-->
<?php
/* @var $page LecturePage*/
if (!is_null($page->quiz)) {
    if (isset($message)){
        $buttonName = $message;
    } else {
        $buttonName = Yii::t('lecture','0089');
    }

    switch (LectureElement::getQuizType($page->quiz)) {
        case '5':
            $this->renderPartial('/lesson/_taskBlock', array(
                'data' => LectureElement::model()->findByPk($page->quiz),
                'editMode' => $editMode,
                'user' => $user,
                'buttonName' => $buttonName
            ));
            break;
        case '6':
            $this->renderPartial('/lesson/_plainTaskBlock', array(
                'data' => LectureElement::model()->findByPk($page->quiz),
                'editMode' => $editMode,
                'user' => $user,
                'buttonName' => $buttonName
            ));
            break;
        case '9' :
            $this->renderPartial('/lesson/_skipTaskBlock', array(
                'data' => LectureElement::model()->findByPk($page->quiz),
                'editMode' => $editMode,
                'user' => $user,
                'buttonName' => $buttonName
            ));
            break;
        case '12':
        case '13':
            $this->renderPartial('/lesson/_testBlock', array(
                'data' => LectureElement::model()->findByPk($page->quiz),
                'editMode' => $editMode,
                'user' => $user,
                'buttonName' => $buttonName
            ));
            break;
        default:
            break;
    }
}
?>
