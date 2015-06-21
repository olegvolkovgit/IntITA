<?php

$this->breadcrumbs = array(
	'Інтерфейс сайту',
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' повідомлення', 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' повідомленнями', 'url' => array('admin')),
);
?>

<h1><?php //echo GxHtml::encode(Messages::label(2)); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 