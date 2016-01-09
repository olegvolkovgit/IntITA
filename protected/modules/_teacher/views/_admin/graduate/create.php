<?php
/* @var $this GraduateController */
/* @var $model Graduate */
?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/index'); ?>')">
                Список випускників</button>
        </li>
    </ul>
<?php $this->renderPartial('_form', array('model' => $model)); ?>