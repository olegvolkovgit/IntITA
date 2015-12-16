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
        <h1>Створити посилання для викладачів</h1>
    </div>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>