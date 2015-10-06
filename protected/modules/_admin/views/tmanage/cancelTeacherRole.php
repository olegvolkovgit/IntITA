<?php
/**
 * @var $teacher Teacher
 */
?>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/index');?>">Викладачі - Головна</a>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/roles');?>">Список ролей</a>


<div id="addTeacherRole">
    <br>
    <a name="form"></a>
    <form action="<?php echo Yii::app()->createUrl('/_admin/permissions/cancelTeacherRole');?>" method="POST"
          name="cancel-access">
        <fieldset>
            <legend id="label">Скасувати роль викладача <?php echo $teacher->first_name." ".$teacher->last_name;?>:</legend>
            <input type="text" name="teacher" value="<?php echo $teacher->teacher_id?>" style="display:none">
            Роль:<br>
            <select name="role" placeholder="(Виберіть роль)">
                <optgroup label="Виберіть роль">
                    <?php $roles = AccessHelper::generateTeacherRolesList($teacher->teacher_id);
                    $count = count($roles);
                    for($i = 0; $i < $count; $i++){
                        ?>
                        <option value="<?php echo $roles[$i]['id'];?>"><?php echo $roles[$i]['alias'];?></option>
                    <?php
                    }
                    ?>
            </select>
            <br>
            <br>
            <input type="submit" value="Скасувати роль">
    </form>
</div>

