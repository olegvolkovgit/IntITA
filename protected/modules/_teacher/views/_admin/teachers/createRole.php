<?php
/* @var $model Teacher */
?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/index'); ?>')">
                Викладачі
            </button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/roles'); ?>')">
                Управління ролями викладачів
            </button>
        </li>
    </ul>
    <br>
<?php $this->renderPartial('_formRole', array('model' => $model, 'scenario' => 'create')); ?>