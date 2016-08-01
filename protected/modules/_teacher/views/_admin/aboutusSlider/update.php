<?php
/* @var $this AboutusSliderController */
/* @var $model AboutusSlider */
?>
    <br>
    <br>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    ng-click="changeView('admin/addaboutussliderphoto')">
                Список фото</button>
        </li>
    </ul>

<?php $this->renderPartial('_form', array('model' => $model)); ?>