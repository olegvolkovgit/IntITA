<?php
/* @var $this CoursemanageController */
/* @var $model Course */
?>


    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/index'); ?>')">
                <?php echo Yii::t("coursemanage", "0510"); ?></button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/create'); ?>')">
                <?php echo Yii::t("coursemanage", "0511"); ?></button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/view',
                        array('id' => $model->course_ID)); ?>')">
                Переглянути інформацію про курс</button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/schema',
                        array('idCourse' => $model->course_ID)); ?>')">
                Згенерувати схему курса</button>
        </li>

    </ul>

    <div class="page-header">
        <h4>Оновити курс <?php echo $model->title_ua . " (" . $model->language . ")"; ?></h4>
    </div>
<?php $this->renderPartial('_form', array('model' => $model)); ?>