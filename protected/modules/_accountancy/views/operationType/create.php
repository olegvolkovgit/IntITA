<?php
/* @var $this OperationTypeController */
/* @var $model OperationType */
?>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_accountancy/operationType/index');?>">Типи операцій - Головна</a>

<h1>Додати тип операції</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>