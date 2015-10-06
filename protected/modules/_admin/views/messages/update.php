<?php
/* @var $this MessagesController */
/* @var $model Messages */
?>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/messages/index');?>">Інтерфейс сайта - Головна</a>

<h1>Редагувати повідомлення #<?php echo $model->id_record; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

