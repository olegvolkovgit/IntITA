<?php
/* @var $this CoursemanageController */
/* @var $model Course */
?>
    <a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/index');?>"><?php echo Yii::t("coursemanage", "0392");?></a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/admin');?>"><?php echo Yii::t("coursemanage", "0393");?></a>

<h1><?php echo Yii::t('coursemanage', '0394'); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>