<?php
/* @var $this OperationController */
/* @var $model Operation */
?>

<h1>Редагувати проплату <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>