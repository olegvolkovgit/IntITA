<?php
$lectures = Lecture::getAllNotVerifiedLectures();
foreach($lectures as $record) {
    echo "<a href='".Yii::app()->createUrl('/_admin/verifyContent/confirm', array('id' => $record->id)).
        "' class='confirm'>Затвердити   </a>     <span class='lectureTitle'><a href='" .
        Yii::app()->createUrl('lesson/index', array('id' => $record->id, 'idCourse' => 0)) . "'</a>" .
        Lecture::getLectureTitle($record->id) . " <span class='moduleTitle'>(модуль - " .
        Module::getModuleName($record->idModule).")</span></span></a><br>";
}
?>