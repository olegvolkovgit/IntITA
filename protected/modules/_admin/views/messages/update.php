<?php
/* @var $this MessagesController */
/* @var $model Translate */
?>
<br>
<br>
<button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/messages/index'); ?>">Інтерфейс сайта - Головна</a>
</button>

<div class="page-header">
    <h1>Редагувати повідомлення #<?php echo $model->id_record; ?></h1>
</div>
<?php $this->renderPartial('_form', array('model' => $model)); ?>

