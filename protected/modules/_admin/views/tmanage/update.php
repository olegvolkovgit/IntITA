<?php
/* @var $model Teacher */

?>
    <br>
    <br>
    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/index');?>">Викладачі</a>
    </button>
    <br>
    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/create');?>">Додати викладача</a>
    </button>
    <br>
    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/view', array('id' => $model->teacher_id));?>">Переглянути інформацію про викладача</a>
    </button>
    <br>
    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/admin');?>">Управління викладачами</a>
    </button>
    <div class="page-header">
    <h2>Оновлення інформації про викладача <?php echo "{$model->last_name} {$model->first_name} {$model->middle_name}"; ?></h2>
    </div>
<?php $this->renderPartial('_form', array('model'=>$model, 'scenario' => 'update')); ?>