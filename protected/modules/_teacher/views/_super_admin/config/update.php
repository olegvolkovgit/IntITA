<?php
/* @var $this ConfigController */
/* @var $model Config */
?>
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/configuration/siteconfig">
                Список налаштувань
            </a>
        </li>
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/configuration/siteconfig/view/<?=$model->id?>">
                Переглянути налаштування
            </a>
        </li>
    </ul>
<?php $this->renderPartial('_form', array('model' => $model)); ?>