<ul class="list-inline">
    <li>
        <a type="button" class="btn btn-primary" ng-href="#/admin/users">
            Користувачі
        </a>
    </li>
    <li>
        <a type="button" class="btn btn-primary" ng-href="#/admin/users/user/{{data.user.id}}">
            Переглянути інформацію про користувача
        </a>
    </li>
</ul>
<div class="col-md-8">
    <div id="addTeacherRole">
        <form name="add-access">
            <fieldset>
                <legend>Користувач:
                    <em>{{data.user.firstName}} {{data.user.secondName}} &lt;{{data.user.email}}&gt;</em>
                </legend>
                <input type="number" hidden="hidden" ng-value="data.user.id" id="user">
                Роль:<br>
                <div class="form-group">
                    <select class="form-control" ng-options="role as role for (choice, role) in data.user.noroles" ng-model="selectedRole">
                        <option value="" disabled selected>(Виберіть роль)</option>
                    </select>
                </div>
                <br>
                <input class="btn btn-success" type="submit" ng-click="assignLocalRole(data.user.id, selectedRole)"
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

