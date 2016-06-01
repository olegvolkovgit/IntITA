<?php
/**
 * @var $model StudentReg
 * @var $params array
 */
 $model = $params[0];
?>
<?=Yii::t('mail', '0844')?> <?=$model->userNameWithEmail();?>. <?=Yii::t('mail', '0845')?> 
<a href="<?=Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index');?>"><?=Yii::t('mail', '0846')?></a>.
