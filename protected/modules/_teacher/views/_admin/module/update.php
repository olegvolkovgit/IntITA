<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/index'); ?>')">
            Список модулів</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/mandatory',
                    array('id' => $model->module_ID)); ?>')">Додати попередній модуль у курсі</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/coursePrice',
                    array('id' => $model->module_ID)); ?>')">Додати/змінити ціну модуля у курсі</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/view',
                    array('id' => $model->module_ID)); ?>')">Переглянути модуль</button>
    </li>

</ul>

<div class="page-header">
    <h4>Редагувати інформацію про <?php echo $model->module_number . " " . $model->title_ua; ?></h4>
</div>

<?php $this->renderPartial('_formAddModule', array('model' => $model)); ?>
