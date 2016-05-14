<?php
/**
 * @var $params array
 * @var $model Course
 * @var $trainer Teacher
 */
$model = $params[0];
$trainer = $params[1];
?>
<h4>Повідомлення</h4>
<br>
Тобі скасовано доступ до курса <a
    href="<?= Yii::app()->createAbsoluteUrl('course/index', array('id' => $model->course_ID)); ?>" target="_blank">
    <em><?= $model->title_ua . ", (" . $model->language . ")"; ?></em></a>
<br>
Зв'язатися з адміністрацією: <a href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index', array(
    'scenario' => 'message',
    'receiver' => $trainer->user_id
)); ?>">написати адміністратору</a>.
<br>
