<a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/module/index');?>">Список модулів</a>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/module/view', array('id' => $model->module_ID));?>">Переглянути модуль</a>

<h1>Редагувати інформацію про <?php echo $model->module_number." ".$model->title_ua; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>