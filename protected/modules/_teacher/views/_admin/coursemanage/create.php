<?php
/* @var $this CoursemanageController */
/* @var $model Course */
?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/index'); ?>')">
                <?php echo Yii::t("coursemanage", "0392"); ?></button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/admin'); ?>')">
                <?php echo Yii::t("coursemanage", "0393"); ?></button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/addExistModule'); ?>')">
                Додати існуючий модуль до курса</button>
        </li>
    </ul>

    <div class="page-header">
        <h4><?php echo Yii::t('coursemanage', '0394'); ?></h4>
    </div>
<?php $this->renderPartial('_form', array('model' => $model)); ?>