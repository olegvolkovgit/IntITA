<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/verifyContent/initializeDir')?>">Ініціалізація</a>
<br>
<br>
<h2>Очікують підтвердження (лекції)</h2>

<?php
    $lectures = Lecture::getAllNotVerifiedLectures();
    foreach($lectures as $record){
        echo "<a href='#'>".LectureHelper::getLectureTitle($record->id)."</a><br>";
    }
?>