<?php
/* @var $model Teacher */
?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/index'); ?>')">
                Викладачі</button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/roles'); ?>')">
                Управління ролями викладачів</button>
        </li>
    </ul>

    <div class="page-header">
    <h4>Додати роль</h4>
    </div>
<?php $this->renderPartial('_formRole', array('model'=>$model, 'scenario' => 'create')); ?>