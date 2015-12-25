<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */
?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('_teacher/_admin/shareLink/index'); ?>')">
                Перегляд посиланнь на ресурси</button>
        </li>
    </ul>

    <div class="page-header">
        <h4>Редагувати ресурс <?php echo $model->name; ?></h4>
    </div>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>