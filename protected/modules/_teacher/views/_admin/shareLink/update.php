<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */
?>
<div ng-controller="sharedlinksCtrl">
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary" ng-click="changeView('sharedlinks')">
                Всі посилання
            </button>
        </li>

        <li>
            <button type="button" class="btn btn-primary" ng-click="changeView('sharedlinks/detail/<?= $model->id ?>')">
                Переглянути посилання
            </button>
        </li>
        <li>
            <button type="button" class="btn btn-primary" ng-click="deleteSharedLink('<?=$model->id?>')">
                Видалити посилання
            </button>
        </li>
    </ul>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
</div>