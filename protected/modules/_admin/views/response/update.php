<?php
/* @var $this ResponseController */
/* @var $model Response */

//$this->menu=array(

//	array('label'=>'View Response', 'url'=>array('view', 'id'=>$model->id)),

//);
?>
    <a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/response/index');?>">Відгуки викладачів - Головна</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/response/view', array('id' => $model->id));?>">Переглянути відгук</a>

<h1>Редагувати відгук #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>