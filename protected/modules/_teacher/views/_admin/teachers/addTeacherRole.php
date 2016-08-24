<?php
/**
 * @var $teacher Teacher
 * @var $roles array
 * @var $role UserRoles
 */
?>
<ul class="list-inline">
    <li>
        <a type="button" class="btn btn-primary" ng-href="#/admin/teachers">Співробітники</a>
    </li>
    <li>
        <a type="button" class="btn btn-primary" ng-href="#/admin/users/teacher/<?php echo $teacher->user_id ?>">
            Переглянути інформацію про співробітника
        </a>
    </li>
</ul>
<div class="col-md-8">
<div id="addTeacherRole">
    <form name="add-access">
        <fieldset>
            <legend>Співробітник: <em>
                <?php echo $teacher->lastName()." ".$teacher->firstName(). " ".$teacher->middleName().' '.$teacher->email();?></em></legend>
            <input type="number" hidden="hidden" value="<?=$teacher->user_id;?>" id="teacher">
            Роль:<br>
            <div class="form-group">
            <select name="role" class="form-control" placeholder="(Виберіть роль)">
                <optgroup label="Виберіть роль">
                    <?php
                    foreach($roles as $role){
                        ?>
                        <option value="<?php echo $role;?>"><?php echo $role;?></option>
                    <?php
                    }
                    ?>
            </select>
            </div>
            <br>
            <input class="btn btn-default" type="submit" ng-click="setTeacherRole('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/setTeacherRole');?>')" value="Призначити роль">
        </fieldset>
    </form>
</div>
</div>

