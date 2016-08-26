<?php
/* @var $this ConfigController */
/* @var $model Config */
?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary" ng-click="changeView('/configuration/siteconfig')">
                Список налаштувань
            </button>
        </li>
        <li>
            <button type="button" class="btn btn-primary" ng-click="changeView('/configuration/siteconfig/view/<?=$model->id?>')">
                Переглянути налаштування
            </button>
        </li>
    </ul>
<?php $this->renderPartial('_form', array('model' => $model)); ?>