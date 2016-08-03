<?php
/* @var $this CarouselController */
/* @var $model Carousel */
?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    ng-click="changeView('admin/carousel')">
                Список фото</button>
        </li>
    </ul>

    <div class="page-header">
        <h4>Додати фото</h4>
    </div>
<?php $this->renderPartial('_form', array('model' => $model)); ?>