<?php
/* @var $this CarouselController */
/* @var $model Carousel */
?>
    <br>
    <br>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/carousel/index');?>')">
                Список фото</button>
        </li>
    </ul>

    <h1>Змінити зображення <?php echo $model->order; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>