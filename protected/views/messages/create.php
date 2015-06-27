<?php
/* @var $this MessagesController */
/* @var $model Messages */

$this->breadcrumbs=array(
	'Messages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Messages', 'url'=>array('index')),
	array('label'=>'Manage Messages', 'url'=>array('admin')),
);
?>
    <link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl?>/css/formattedForm.css"/>
<h1>Create Messages</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>