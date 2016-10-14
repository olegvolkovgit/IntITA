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
            <div class="list-group-item" ng-click="isCollapsed = !isCollapsed" style="cursor:pointer">
            Історія зміни ролей
            <div uib-collapse="!isCollapsed">
                <br/>
                <table class="table table-bordered table-striped table-condensed" width="100%">
                    <thead>
                    <th>Роль</th>
                    <th>Дата призначення</th>
                    <th>Призначено користувачем</th>
                    <th>Дата скасування</th>
                    <th>Скасовано користувачем</th>
                    <th>Активна</th>
                    </thead>
                    <tbody>
                    <tr ng-repeat="row in roles">
                        <td>{{row.role}} <span ng-if="row.module">({{row.module.title_ua}})</span></td>
                        <td>{{row.start_date |shortDate:"dd-MM-yyyy"}}</td>
                        <td>
                            <span ng-if="row.assigned_by == 0">Адміністратор</span>
                            <span ng-if="row.assigned_by > 0">{{row.assigned_by_user.firstName}} {{row.assigned_by_user.middleName}} {{row.assigned_by_user.secondName}}</span>
                        </td>
                        <td>{{row.end_date |shortDate:"dd-MM-yyyy"}}</td>
                        <td>
                            <span ng-if="row.cancelled_by == 0">Адміністратор</span>
                            <span ng-if="row.cancelled_by > 0">{{row.cancelled_by_user.firstName}} {{row.cancelled_by_user.middleName}} {{row.cancelled_by_user.secondName}}</span>
                            </td>
                        <td><span ng-if="!row.end_date">Так</span><span ng-if="row.end_date">Ні</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            </div>
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