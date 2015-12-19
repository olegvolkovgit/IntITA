<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */
?>
    <br>
    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/shareLink/index');?>">Перегляд посиланнь на ресурси</a>
    </button>
    <br>

    <div class="page-header">
        <h1>Редагувати ресурс <?php echo $model->name; ?></h1>
    </div>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>