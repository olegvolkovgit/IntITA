<?php
/* @var $this ConfigController */
/* @var $model Config */
?>
<br>
<br>
<button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/config/index'); ?>">Список налаштувань</a>
</button>
<br>
<button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/config/update', array('id' => $model->id)); ?>">
        Редагувати налаштування
    </a>
</button>

<div class="page-header">
    <h1>Перегляд налаштування #<?php echo $model->param; ?></h1>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'param',
        'value',
        'default',
        'label',
        'type',
    ),
)); ?>
