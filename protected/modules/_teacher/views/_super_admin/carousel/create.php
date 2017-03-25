<?php
/* @var $this CarouselController */
/* @var $model Carousel */
?>
<ul class="list-inline">
    <li>
        <a type="button" class="btn btn-primary" ng-href="#/carousel">Список фото</a>
    </li>
</ul>
<div class="page-header">
    <h4>Додати фото</h4>
</div>
<?php $this->renderPartial('_form', array('model' => $model)); ?>