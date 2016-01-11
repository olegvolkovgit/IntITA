<?php
/* @var $model Teacher */
?>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/index');?>">Викладачі</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/roles');?>">Ролі</a>
    <div class="page-header">
    <h2>Додати роль</h2>
    </div>
<?php $this->renderPartial('_formRole', array('model'=>$model, 'scenario' => 'create')); ?>