<?php
/**
 * @var $model RegisteredUser
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php if (Yii::app()->user->model->isAdmin()) { ?>
            <ul class="list-inline">
                <li>
                    <a type="button" class="btn btn-primary" ng-href="#/admin/users/user/{{data.user.id}}/addrole">
                        Призначити роль
                    </a>
                </li>
                <li>
                    <a type="button" class="btn btn-primary" ng-href="#/admin/teacher/create">
                        Додати співробітника
                    </a>
                </li>
            </ul>
        <?php } ?>
            <ul ng-if="data.user.roles.length" ng-repeat="role in data.user.roles track by $index" class="list-group">
                <li class="list-group-item">
                    {{role}}
                    <?php if (Yii::app()->user->model->isAdmin()) { ?>
                        <a ng-if="role!='<?php echo UserRoles::STUDENT ?>'" ng-href="#/admin/teacher/{{data.user.id}}/editRole/role/{{role}}">
                        <em>редагувати</em>
                        </a>
                        <a href=""
                           ng-click="cancelUserRole('<?= Yii::app()->createUrl("/_teacher/user/unsetUserRole"); ?>',
                               role,data.user.id);">
                            <em>скасувати</em>
                        </a>
                    <?php } ?>
                </li>
            </ul>
        <?php if($model->isAdmin()){?>
        <div class="alert alert-info">
            Деякі ролі (<?=implode(', ', TeacherRolesDataSource::roles());?>) можуть бути призначені лише співробітникам. Додати нового співробітника можна
            за посиланням:
            <a type="button" class="alert-link" ng-href="#/admin/teacher/create">
                Додати співробітника
            </a>.
            <br>
            Список усіх співробітників:
            <a ng-href="#/admin/teachers" class="alert-link">Список</a>.
        </div>
        <?php } ?>
    </div>
</div>
<script>

</script>