<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('_teacher/_admin/shareLink/index'); ?>',
					'Посилання на ресурси')">
            Перегляд посилань на ресурси</button>
    </li>
</ul>

<div class="page-header">
<h4>Управління ресурсами для викладачів № <?php echo $model->id; ?></h4>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'link',
	),
)); ?>
