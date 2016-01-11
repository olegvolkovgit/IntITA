<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */
?>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/shareLink/index');?>">Перегляд посиланнь на ресурси</a>
    <br>
    <div class="page-header">
        <h1>Створити посилання для викладачів</h1>
    </div>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>