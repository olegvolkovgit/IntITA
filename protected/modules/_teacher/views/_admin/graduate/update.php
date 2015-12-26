<?php
/* @var $this GraduateController */
/* @var $model Graduate */
?>

<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/create'); ?>')">
            Додати випускника</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="deletePhoto('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/deletePhoto'); ?>',
                    '<?php echo $model->id; ?>', '<?php echo $model->first_name . " " . $model->last_name; ?>');">
            Видалити фото випускника</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/index'); ?>')">
            Список випускників</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/view', array('id' => $model->id)); ?>')">
            Переглянути інформацію про випускника</button>
    </li>
</ul>

<div class="page-header">
    <h4>Редагувати інформацію про <?php echo $model->first_name . " " . $model->last_name; ?></h4>
</div>
<?php $this->renderPartial('_form', array('model' => $model)); ?>

<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'graduate.js'); ?>"></script>