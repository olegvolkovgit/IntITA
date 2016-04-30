<?php
/* @var $page LecturePage*/
if (!is_null($quiz)) {
    $buttonName = Yii::t('lecture','0089');

    switch ($quiz->id_type) {
        case '5':
            $this->renderPartial('lecturePreview/_taskBlock', array(
                'data' => $quiz,
                'buttonName' => $buttonName
            ));
            break;
        case '6':
            $this->renderPartial('lecturePreview/_plainTaskBlock', array(
                'data' => $quiz,
                'buttonName' => $buttonName
            ));
            break;
        case '9' :
            $this->renderPartial('lecturePreview/_skipTaskBlock', array(
                'data' => $quiz,
                'buttonName' => $buttonName
            ));
            break;
        case '12':
        case '13':
            $this->renderPartial('lecturePreview/_testBlock', array(
                'data' => $quiz,
                'buttonName' => $buttonName
            ));
            break;
        default:
            break;
    }
}
?>

