<?php
/**
 * @var $params array
 * @var $model Module
 */
$model = $params[0];
?>
<h4><?=Yii::t('mail', '0839')?></h4>
<br>
<?=Yii::t('mail', '0849')?> <strong><?=$model->title_ua;?></strong>.
<br>
<?=Yii::t('mail', '0848')?> <a href="<?=Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $model->module_ID));?>" target="_blank">
    <em><?=$model->title_ua.", (".$model->language.")";?></em>
</a><br>
