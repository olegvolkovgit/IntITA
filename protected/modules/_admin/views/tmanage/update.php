<?php
/* @var $model Teacher */

?>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/index');?>">Викладачі</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/create');?>">Додати викладача</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/view', array('id' => $model->teacher_id));?>">Переглянути інформацію про викладача</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/admin');?>">Управління викладачами</a>

    <h2>Оновлення інформації про викладача <?php echo "{$model->last_name} {$model->first_name} {$model->middle_name}"; ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model, 'scenario' => 'update')); ?>