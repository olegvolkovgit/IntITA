<?php
/**
 * @var $record Lecture
 */
$lectures = Lecture::getAllVerifiedLectures();
foreach($lectures as $record) {
    echo "<a href='".Yii::app()->createUrl('/_admin/verifyContent/cancel', array('id' => $record->id)).
        "' class='confirm'>Скасувати   </a>     <span class='lectureTitle'><a href='" .
        Yii::app()->createUrl('lesson/index', array('id' => $record->id, 'idCourse' => 0, 'page' => 1)) . "'</a>" .
        $record->title() . " <span class='moduleTitle'>(модуль - " .
        $record->module->getTitle().")</span></span></a><br>";
}
?>