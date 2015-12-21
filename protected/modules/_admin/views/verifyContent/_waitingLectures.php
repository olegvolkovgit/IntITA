<?php
/**
 * @var $record Lecture
 */
$lectures = Lecture::getAllNotVerifiedLectures();
foreach($lectures as $record) {
    echo "<a href='".Yii::app()->createUrl('/_admin/verifyContent/confirm', array('id' => $record->id)).
        "' class='confirm'>Затвердити   </a>     <span class='lectureTitle'><a href='" .
        Yii::app()->createUrl('lesson/index', array('id' => $record->id, 'idCourse' => 0, 'page' => 1)) . "'</a>" .
        $record->title() . " <span class='moduleTitle'>(модуль - " .
        $record->module->getTitle().")</span></span></a><br>";
}
?>