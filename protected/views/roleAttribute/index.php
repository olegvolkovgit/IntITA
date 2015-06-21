<?php
/* @var $this RoleAttributeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Role Attributes',
);

$this->menu=array(
	array('label'=>'Create RoleAttribute', 'url'=>array('create')),
	array('label'=>'Manage RoleAttribute', 'url'=>array('admin')),
);
?>

<h1>Role Attributes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'summaryText'=>'',
)); ?>
