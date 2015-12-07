<?php
/**
 * @var $teacher Teacher
 */
?>
<br>
<br>
<button type="button" class="btn btn-link">
<a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/index');?>">Викладачі - Головна</a>
</button>
    <br>
<button type="button" class="btn btn-link">
<a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/roles');?>">Список ролей</a>
</button>

<div id="addTeacherRole">
    <br>
    <a name="form"></a>
    <form action="<?php echo Yii::app()->createUrl('/_admin/permissions/cancelTeacherRole');?>" method="POST"
          name="cancel-access">
        <fieldset>
            <legend id="label">Скасувати роль викладача <?php echo $teacher->first_name." ".$teacher->last_name;?>:</legend>
            <input type="text" name="teacher" value="<?php echo $teacher->teacher_id?>" style="display:none">
            Роль:<br>
            <div class="form-group">
            <select name="role" class="form-control" placeholder="(Виберіть роль)">
                <optgroup label="Виберіть роль">
                    <?php $roles = Teacher::generateTeacherRolesList($teacher->teacher_id);
                    $count = count($roles);
                    for($i = 0; $i < $count; $i++){
                        ?>
                        <option value="<?php echo $roles[$i]['id'];?>"><?php echo $roles[$i]['alias'];?></option>
                    <?php
                    }
                    ?>
            </select>
                </div>
            <br>
            <br>
            <input type="submit" class="btn btn-default" value="Скасувати роль">
    </form>
</div>

