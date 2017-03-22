<?php
/* @var $this GraduateController */
/* @var $model Graduate */
?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary" ng-click="changeView('graduate')">
                Список випускників</button>
        </li>
    </ul>
<?php $this->renderPartial('_form', array('model' => $model)); ?>