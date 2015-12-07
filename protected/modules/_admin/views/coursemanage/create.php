<?php
/* @var $this CoursemanageController */
/* @var $model Course */
?>
    <br>
    <br>
    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/index');?>"><?php echo Yii::t("coursemanage", "0392");?></a>
    </button>
    <br>

    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/admin');?>"><?php echo Yii::t("coursemanage", "0393");?></a>
    </button>

    <div class="page-header">
    <h1><?php echo Yii::t('coursemanage', '0394'); ?></h1>
    </div>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>