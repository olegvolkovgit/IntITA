<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */
?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('_teacher/_admin/shareLink/index'); ?>')">
                Перегляд посилань на ресурси</button>
        </li>
    </ul>

    <div class="page-header">
        <h4>Створити посилання для викладачів</h4>
    </div>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>