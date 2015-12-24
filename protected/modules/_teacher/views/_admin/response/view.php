<?php
/* @var $this ResponseController */
/* @var $model Response */
?>
<br>
<br>
<a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/response/index'); ?>')">
    Відгуки про викладачів</a>
<br>
<h1>Відгук про викладача #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'who',
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
