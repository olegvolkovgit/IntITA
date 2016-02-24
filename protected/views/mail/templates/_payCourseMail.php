<?php
/**
* @var $params array
* @var $model Course
*/
$model = $params[0];
?>
Вітаємо!
<br>
Тобі надано доступ до курса <strong><?=$model->title_ua;?></strong>.
<br>
Щоб розпочати навчання, перейди за посиланням: <a href="<?=Yii::app()->createAbsoluteUrl('course/index', array('id' => $model->course_ID));?>">
    <?=$model->title_ua;?></a><br>