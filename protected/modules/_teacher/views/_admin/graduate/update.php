<?php
/* @var $this GraduateController */
/* @var $model Graduate */
?>
<div class="row">
    <div class="col col-lg-9">
        <ul class="list-inline">
            <li>
                <button type="button" class="btn btn-primary"
                        onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/index'); ?>',
                            'Список випускників')">
                    Список випускників
                </button>
            </li>
            <li>
                <button type="button" class="btn btn-primary"
                        onclick="deletePhoto('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/deletePhoto'); ?>',
                            '<?php echo $model->id; ?>', '<?php echo addslashes($model->first_name) . " " . addslashes($model->last_name); ?>');">
                    Видалити фото випускника
                </button>
            </li>
            <li>
                <button type="button" class="btn btn-primary"
                        onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/view', array('id' => $model->id)); ?>',
                            '<?="Випускник ".addslashes($model->first_name." ".$model->last_name);?>')">
                    Переглянути інформацію про випускника
                </button>
            </li>
        </ul>

        <?php $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
</div>
