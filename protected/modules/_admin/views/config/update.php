<?php
/* @var $this ConfigController */
/* @var $model Config */
?>
<br>
<br>
    <button type="button" class="btn btn-link">
        <a href="<?php echo Yii::app()->createUrl('/_admin/config/index');?>">Список налаштувань</a>
    </button>
    <br>
    <button type="button" class="btn btn-link">
        <a href="<?php echo Yii::app()->createUrl('/_admin/config/view', array('id' => $model->id));?>">Переглянути налаштування</a>
    </button>
    <div class="page-header">
        <h1>Редагувати налаштування <?php echo $model->param; ?></h1>
    </div>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>