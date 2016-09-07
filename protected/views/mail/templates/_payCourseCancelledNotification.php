<?php
/**
 * @var $params array
 * @var $model Course
 * @var $trainer Teacher
 */
$model = $params[0];
$trainer = $params[1];
?>
<h4><?=Yii::t('mail', '0850')?></h4>
<br>
<?=Yii::t('mail', '0851')?> <a
    href="<?= Yii::app()->createAbsoluteUrl('course/index', array('id' => $model->course_ID)); ?>" target="_blank">
    <em><?= $model->title_ua . ", (" . $model->language . ")"; ?></em></a>
<br>
<?=Yii::t('mail', '0852')?> <a
    href="<?= Yii::app()->createAbsoluteUrl('/_teacher/cabinet/index')?>#/newmessages/receiver/<?php echo $trainer->user_id; ?>"><?=Yii::t('mail', '0853')?></a>.
<br>
