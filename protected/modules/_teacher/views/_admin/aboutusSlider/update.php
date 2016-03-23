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

<?php $this->renderPartial('_form', array('model' => $model)); ?>