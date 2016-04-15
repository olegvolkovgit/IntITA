<?php
/**
 * @var $params array
 * @var $model Module
 */
$model = $params[0];
?>
<h4>Вітаємо!</h4>
<br>
Тобі надано доступ до модуля <strong><?=$model->title_ua;?></strong>.
<br>
Щоб розпочати навчання, перейди за посиланням: <a href="<?=Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $model->module_ID));?>" target="_blank">
    <em><?=$model->title_ua.", (".$model->language.")";?></em>
</a><br>
