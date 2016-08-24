<?php
/* @var $this CarouselController */
/* @var $model Carousel */
?>
    <br>
    <br>
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/admin/carousel" >Список фото</a>
        </li>
    </ul>

    <h1>Змінити зображення <?php echo $model->order; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>