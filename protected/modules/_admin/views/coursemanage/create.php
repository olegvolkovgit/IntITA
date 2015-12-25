<?php
/* @var $this CoursemanageController */
/* @var $model Course */
?>
    <br>
    <br>
        <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/index'); ?>">
            <?php echo Yii::t("coursemanage", "0392"); ?>
        </a>
    <br>

        <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/admin'); ?>">
            <?php echo Yii::t("coursemanage", "0393"); ?>
        </a>

    <div class="page-header">
        <h1><?php echo Yii::t('coursemanage', '0394'); ?></h1>
    </div>
<?php $this->renderPartial('_form', array('model' => $model)); ?>