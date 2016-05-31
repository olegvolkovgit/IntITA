<?php
/**
 * @var $params array
 * @var $model Course
 */
$model = $params[0];
?>
<h4><?=Yii::t('mail', '0839')?></h4>
<span><?=Yii::t('mail', '0847')?> <strong><?=$model->title_ua;?></strong>.</span>
<br>
<?=Yii::t('mail', '0848')?> <a href="<?=Yii::app()->createAbsoluteUrl('course/index', array('id' => $model->course_ID));?>" target="_blank">
    <?=$model->title_ua.", (".$model->language.")";?></a><br>