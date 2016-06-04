<?php
/**
 * @var $params array
 * @var $model Module
 * @var $trainer Teacher
 */
$model = $params[0];
$trainer = $params[1];
?>
<h4><?=Yii::t('mail', '0850')?></h4>
<br>
<?=Yii::t('mail', '0854')?> <a
    href="<?= Yii::app()->createAbsoluteUrl('module/index', array('idModule' => $model->module_ID)); ?>"
    target="_blank">
    <em><?= $model->title_ua . ", (" . $model->language . ")"; ?></em>
</a>
<br>
<?=Yii::t('mail', '0852')?> <a href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index', array(
    'scenario' => 'message',
    'receiver' => $trainer->user_id
)); ?>"><?=Yii::t('mail', '0853')?></a>.
<br>
