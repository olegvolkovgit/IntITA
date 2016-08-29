<?php
/**
 * @var $model RegisteredUser
 * @var $user StudentReg
 * @var $roles array
 * @var $role UserRoles
 */
$user = $model->registrationData;
?>
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
                    <select name="role" class="form-control" placeholder="(Виберіть роль)">
                        <optgroup label="Виберіть роль">
                            <?php
                            foreach ($roles as $role) {
                                ?>
                                <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
                                <?php
                            }
                            ?>
                    </select>
                </div>
                <br>
                <input class="btn btn-success" type="submit"
                       ng-click="setUserRole('<?php echo Yii::app()->createUrl('/_teacher/user/setUserRole'); ?>');"
                       value="Призначити роль">

                <a type="button" class="btn btn-primary" ng-href="#/admin/users/user/{{data.user.id}}">
                    Скасувати
                </a>
            </fieldset>
        </form>
    </div>
</div>

