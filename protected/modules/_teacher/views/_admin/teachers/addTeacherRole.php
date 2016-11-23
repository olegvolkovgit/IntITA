<ul class="list-inline">
    <li>
        <a type="button" class="btn btn-primary" ng-href="#/admin/teachers">Співробітники</a>
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
            <legend>Співробітник:
                <em>{{data.user.secondName}} {{data.user.firstName}} {{data.user.middleName}}({{data.user.email}})</em>
            </legend>
            <input type="number" hidden="hidden" ng-value="data.user.id" id="teacher">
            Роль:<br>
            <div class="form-group">
                <div class="form-group">
                    <select class="form-control" ng-options="role as role disable when role=='author' for (choice, role) in data.user.noroles " ng-model="selectedRole">
                        <option value="" disabled selected>(Виберіть роль)</option>
                    </select>
                </div>
            </div>
            <br>
            <input class="btn btn-default" type="submit" ng-click="setTeacherRole('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/setTeacherRole');?>')" value="Призначити роль">
        </fieldset>
    </form>
</div>
</div>

