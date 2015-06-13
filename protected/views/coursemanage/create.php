<?php
/* @var $this CoursemanageController */
/* @var $model Course */

$this->breadcrumbs=array(
    Yii::t('coursemanage', '0390')=>array('index'),
    Yii::t('coursemanage', '0391'),
);

$this->menu=array(
	array('label'=>Yii::t('coursemanage', '0392'), 'url'=>array('index')),
	array('label'=>Yii::t('coursemanage', '0393'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('coursemanage', '0394'); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>