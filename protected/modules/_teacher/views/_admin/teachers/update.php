<?php
/* @var $model Teacher */
?>
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/users/coworkers">
                Співробітники
            </a>
        </li>
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/admin/teacher/create">
                Додати співробітника
            </a>
        </li>
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/users/profile/<?php echo $model->id_user ?>">
                Переглянути інформацію про співробітника
            </a>
        </li>
    </ul>
<?php $this->renderPartial('_teacherForm', array('model' => $model, 'scenario' => 'update')); ?>