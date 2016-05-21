<?php
/* @var $model Teacher */
?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/index'); ?>',
                'Співробітники')">Співробітники</button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/create'); ?>',
                'Додати співробітника')">Додати спвіробітника</button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/showTeacher', array('id' => $model->user_id)); ?>',
                'Переглянути інформацію про співробітника')">
                Переглянути інформацію про співробітника</button>
        </li>
    </ul>
<?php $this->renderPartial('_form', array('model' => $model, 'scenario' => 'update')); ?>