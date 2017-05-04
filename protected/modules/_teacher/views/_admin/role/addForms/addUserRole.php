<div ng-controller="userProfileCtrl">
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/organization/registeredUsers">
                Користувачі
            </a>
        </li>
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/users/profile/{{user.id}}">
                Переглянути інформацію про користувача
            </a>
        </li>
    </ul>
    <div class="col-md-8" >
        <div id="addTeacherRole">
            <form name="add-access">
                <fieldset>
                    <legend>Користувач:
                        <em>{{user.fullName}}</em>
                    </legend>
                    <input type="number" hidden="hidden" ng-value="user.id" id="user">
                    Роль:<br>
                    <div class="form-group">
                        <select class="form-control" ng-options="item.role as item.name for item in roles.no_roles" ng-model="selectedRole">
                            <option value="" disabled selected>(Виберіть роль)</option>
                        </select>
                    </div>
                    <br>
                    <input class="btn btn-success" type="submit" ng-click="assignLocalRole(user.id, selectedRole)"
                           value="Призначити роль">
                    <a type="button" class="btn btn-default" ng-click='back()'>
                        Назад
                    </a>
                </fieldset>
                <br>
                <div class="alert alert-info">
                    <?php if (Yii::app()->user->model->isAdmin()) { ?>
                        Перед тим як призначити користувачу роль(за виключенням ролі 'студент'), він має бути призначеним співробітником.
                        Призначити співробітника можна на сторінці
                        <a ng-href="#/admin/teacher/create" class="alert-link">
                            призначити співробітника
                        </a>.
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>
