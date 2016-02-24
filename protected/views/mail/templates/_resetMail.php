<?php
/**
 * @var $params array
 * @var $model Course
 */
$model = $params[0];
?>
<h4>Вітаємо!</h4>
<br>
Yii::t('recovery', '0283')
<br>
 <a href="<?=Yii::app()->createAbsoluteUrl('/index.php?r=site/veremail/view&token=', array('id' => $model->course_ID));?>">
 $model->token . "&email=" . urlencode($mailHash);
$model->updateByPk($model->id, array('token' => $model->token, 'activkey_lifetime' => $time));