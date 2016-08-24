<?php
/* @var $this AboutusSliderController */
/* @var $model AboutusSlider */
?>
    <br>
    <br>
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/admin/aboutusSlider" >Список фото</a>
        </li>
    </ul>

<?php $this->renderPartial('_form', array('model' => $model)); ?>