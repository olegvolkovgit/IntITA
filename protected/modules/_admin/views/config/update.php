<?php
/* @var $this ConfigController */
/* @var $model Config */
?>
<a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/config/index');?>">Список налаштувань</a>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/config/view', array('id' => $model->id));?>">Переглянути налаштування</a>


<h1>Редагувати налаштування <?php echo $model->param; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>