<?php
/**
 * @var $params array
 * @var $model Module*/
$model = $params[0];
?>
Вітаємо!
<br>
Тобі надано доступ до модуля <strong><?=$model->title_ua;?></strong>.
<br>
Щоб розпочати навчання, перейди за посиланням: <a href="<?=Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $model->module_ID));?>">
    <em><?=$model->title_ua;?></em>
</a><br>
