<?php
/* @var $this GraduateController */
/* @var $model Graduate */
?>
<div class="row" ng-controller="graduateCtrl">
    <div class="col col-lg-9">
        <ul class="list-inline">
            <li>
            <li>
                <button type="button" class="btn btn-primary" ng-click="changeView('graduate')">
                    Список випускників</button>
            </li>
            <li>
                <button type="button" class="btn btn-primary" ng-click="deleteGraduatePhoto('<?= $model->id?>')">
                    Видалити фото випускника
                </button>
            </li>
            <li>
            <li>
                <button type="button" class="btn btn-primary" ng-click="changeView('graduate/view/<?= $model->id ?>')">
                    Переглянути інформацію про випускника
                </button>
            </li>
        </ul>
        <?php $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
</div>
