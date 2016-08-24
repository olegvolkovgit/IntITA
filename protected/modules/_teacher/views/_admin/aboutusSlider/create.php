<?php
/* @var $this AboutusSliderController */
/* @var $model AboutusSlider */
?>

    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/admin/aboutusSlider" >Список фото</a>
        </li>
    </ul>

    <div class="page-header">
        <h4>Додати фото</h4>
    </div>

<?php $this->renderPartial('_form', array('model' => $model)); ?>