<?php

$this->breadcrumbs = array(
	Yii::t('app', 'Create'),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'List') . ' повідомлення', 'url' => array('index')),
	array('label'=>Yii::t('app', 'Manage') . ' повідомленнями', 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Create') . ' повідомлення'; ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>