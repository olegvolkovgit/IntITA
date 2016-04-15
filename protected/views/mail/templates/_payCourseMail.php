<?php
/**
 * @var $params array
 * @var $model Course
 */
$model = $params[0];
?>
<h4>Вітаємо!</h4>
<span>Тобі надано доступ до курса <strong><?=$model->title_ua;?></strong>.</span>
<br>
Щоб розпочати навчання, перейди за посиланням: <a href="<?=Yii::app()->createAbsoluteUrl('course/index', array('id' => $model->course_ID));?>" target="_blank">
    <?=$model->title_ua.", (".$model->language.")";?></a><br>