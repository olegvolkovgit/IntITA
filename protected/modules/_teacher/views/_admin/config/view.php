<?php
/* @var $this ConfigController */
/* @var $model Config */
?>

<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/config/index'); ?>', 'Налаштування')">
            Список налаштувань</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/config/update',
                    array('id' => $model->id)); ?>')">Редагувати налаштування</button>
    </li>
</ul>

<div class="page-header">
    <h4>Перегляд налаштування #<?php echo $model->param; ?></h4>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'param',
        'value',
        'default',
        'label',
        'type',
    ),
)); ?>
