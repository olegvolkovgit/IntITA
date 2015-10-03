<?php
/* @var $this AboutusSliderController */
/* @var $model AboutusSlider */

//$this->menu=array(
//	array('label'=>'List AboutusSlider', 'url'=>array('index')),
//	array('label'=>'Create AboutusSlider', 'url'=>array('create')),
//	array('label'=>'View AboutusSlider', 'url'=>array('view', 'id'=>$model->image_order)),
//	array('label'=>'Manage AboutusSlider', 'url'=>array('admin')),
//);
?>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/aboutusSlider/index');?>">Список фото</a>

<h1>Змінити зображення #<?php echo $model->image_order; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>