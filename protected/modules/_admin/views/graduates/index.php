<?php
/* @var $this RolesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Випускники',
);

$this->menu=array(
    array('label'=>'Додати випускника', 'url'=>array('create')),
    array('label'=>'Управління випускниками', 'url'=>array('admin')),
);
?>

<h1>Випускники</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
)); ?>
