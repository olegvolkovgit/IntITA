<?php
/* @var $model Teacher */
?>
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/admin/teachers">
                Співробітники
            </a>
        </li>
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/admin/teacher/create">
                Додати спвіробітника
            </a>
        </li>
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/admin/users/teacher/<?php echo $model->user_id ?>">
                Переглянути інформацію про співробітника
            </a>
        </li>
    </ul>
<?php $this->renderPartial('_form', array('model' => $model, 'scenario' => 'update')); ?>