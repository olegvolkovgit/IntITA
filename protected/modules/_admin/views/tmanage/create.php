<?php
/* @var $model Teacher */
?>
    <a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/index');?>">Викладачі</a>

    <h2>Додати викладача</h2>

<?php $this->renderPartial('_form', array('model'=>$model, 'scenario' => 'create')); ?>