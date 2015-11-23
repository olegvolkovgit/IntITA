<?php
/* @var $this VerifyContentController */
?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'verifyContent.css'); ?>"/>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/verifyContent/initializeDir')?>">Ініціалізація</a>
<br>
<br>
<h2>Очікують підтвердження (лекції)</h2>

<?php
    $lectures = Lecture::getAllNotVerifiedLectures();
    foreach($lectures as $record) {
        echo "<a href='".Yii::app()->createUrl('/_admin/verifyContent/confirm', array('id' => $record->id)).
            "' class='confirm'>Затвердити   </a>     <span class='lectureTitle'><a href='" .
            Yii::app()->createUrl('lesson/index', array('id' => $record->id, 'idCourse' => 0)) . "'</a>" .
            LectureHelper::getLectureTitle($record->id) . " <span class='moduleTitle'>(модуль - " .
            ModuleHelper::getModuleName($record->idModule).")</span></span></a><br>";
    }
?>


