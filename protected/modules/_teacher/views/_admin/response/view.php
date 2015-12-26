<?php
/* @var $this ResponseController */
/* @var $model Response */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/response/index'); ?>')">
            Відгуки про викладачів</button>
    </li>
</ul>
<div class="page-header">
<h4>Відгук про викладача #<?php echo $model->id; ?></h4>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
            'label' => 'Хто',
            'value' => $model->getResponseAuthorName(),
        ),
		'about',
		'date',
		'text',
		'rate',
		'who_ip',
		'knowledge',
		'behavior',
		'motivation',
        'is_checked'
	),
)); ?>
