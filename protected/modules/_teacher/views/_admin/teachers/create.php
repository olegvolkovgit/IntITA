<?php
/* @var $model Teacher */
?>
    <ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/index'); ?>')">Викладачі</button>
    </li>
    </ul>
<?php $this->renderPartial('_form', array('model' => $model, 'scenario' => 'create')); ?>