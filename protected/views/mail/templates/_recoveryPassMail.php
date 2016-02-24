<?php
/**
 * @var $params array
 * @var $model Course
 */
$model = $params[0];
?>

<h4>Вітаємо!</h4>
<br>
Yii::t('recovery', '0239') .
<br>
<a href="<?=Yii::app()->createAbsoluteUrl('/index.php?r=site/vertoken/view&token=', array($model->token),$model->updateByPk);?>">