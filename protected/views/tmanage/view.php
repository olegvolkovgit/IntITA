<?php
/* @var $this MytestController */
/* @var $model Teacher */

$this->breadcrumbs=array(
	'Teachers'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Список вчителів', 'url'=>array('index')),
	array('label'=>'Додати вчителя', 'url'=>array('create')),
	array('label'=>'Оновити', 'url'=>array('update', 'id'=>$model->teacher_id)),
	array('label'=>'Видалити', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->teacher_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управління вчителями', 'url'=>array('admin')),
);
?>

<h1>View Teacher #<?php echo $model->teacher_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'teacher_id',
		'first_name',
		'middle_name',
		'last_name',
		'foto_url',
		'subjects',
		'profile_text_first',
		'profile_text_short',
		'profile_text_last',
		'readMoreLink',
		'email',
		'tel',
		'skype',
		'smallImage',
		'rate_knowledge',
		'rate_efficiency',
		'rate_relations',
		'sections',
		'user_id',
	),
)); ?>
