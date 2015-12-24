<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */
?>
    <br>
    <a href="#" onclick="load('<?php echo Yii::app()->createUrl('_teacher/_admin/shareLink/index');?>')">Перегляд посиланнь на ресурси</a>
    <br>

    <div class="page-header">
        <h1>Редагувати ресурс <?php echo $model->name; ?></h1>
    </div>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>