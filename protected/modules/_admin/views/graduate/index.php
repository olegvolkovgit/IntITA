<?php
/* @var $this GraduateController */
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
    'summaryText' => 'Показано випускників {start} - {end} з {count}',
    'htmlOptions'=>array('class'=>'grid-view custom','id'=>'graduate-form'),
    'itemView'=>'_view',
)); ?>
