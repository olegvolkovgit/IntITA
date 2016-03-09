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
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/update',
                        array('id' => $model->course_ID)); ?>')">
                Редагувати курс</button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="setCourseStatus('<?php echo Yii::app()->createUrl("/_teacher/_admin/coursemanage/changeStatus",
                        array("id"=>$model->course_ID)); ?>', '<?=($model->isActive())?'Видалити курс?':'Відновити курс?';?>')">
                <?=($model->isActive())?'Видалити':'Відновити';?></button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/schema',
                        array('idCourse' => $model->course_ID)); ?>')">
                Згенерувати схему курса</button>
        </li>
    </ul>
    <div class="page-header">
        <h4>Курс <?php echo $model->getTitle(); ?></h4>
    </div>
<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'language',
        'title_ua',
        'title_ru',
        'title_en',
        'level',
        'start',
        'status',
        'for_whom_ua',
        'what_you_learn_ua',
        'what_you_get_ua',
        'for_whom_ru',
        'what_you_learn_ru',
        'what_you_get_ru',
        'for_whom_en',
        'what_you_learn_en',
        'what_you_get_en',
        'course_img',
    ),
)); ?>