<?php
/* @var $this AboutusSliderController */
/* @var $model AboutusSlider */

//$this->menu=array(
//	array('label'=>'List AboutusSlider', 'url'=>array('index')),
//	array('label'=>'Manage AboutusSlider', 'url'=>array('admin')),
//);
?>
    <a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/aboutusSlider/index');?>">Список фото</a>

<h1>Додати фото</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>