<?php
/* @var $model Teacher */
?>
    <br>
    <br>
    <ul class="list-inline">
    <li>
    <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/teachers/index'); ?>')">Викладачі</a>
    </li>
    <li>
    <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/teachers/roles'); ?>')">
        Управління ролями викладачів</a>
    </li>
    </ul>
    <div class="page-header">
    <h2>Додати роль</h2>
    </div>
<?php $this->renderPartial('_formRole', array('model'=>$model, 'scenario' => 'create')); ?>