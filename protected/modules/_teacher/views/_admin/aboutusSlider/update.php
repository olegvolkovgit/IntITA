<?php
/* @var $this AboutusSliderController */
/* @var $model AboutusSlider */
?>
    <br>
    <br>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/aboutusSlider/index');?>')">
                Список фото</button>
        </li>
    </ul>


    <div class="page-header">
        <h4>Змінити зображення #<?php echo $model->image_order; ?></h4>
    </div>

<?php $this->renderPartial('_form', array('model' => $model)); ?>