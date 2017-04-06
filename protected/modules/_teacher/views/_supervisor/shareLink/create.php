<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */
?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary" ng-click="changeView('sharedlinks')">
                Перегляд посилань на ресурси</button>
        </li>
    </ul>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>