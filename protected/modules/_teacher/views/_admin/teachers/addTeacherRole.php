<?php
/**
 * @var $teacher Teacher
 */
?>
<div class="col-md-4">
<div id="addTeacherRole">
    <br>
    <a name="form"></a>
    <form onsubmit="setTeacherRole('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/setTeacherRole');?>')"
          name="add-access">
        <fieldset>
            <legend id="label">Призначити роль викладачу
                <?php echo $teacher->lastName()." ".$teacher->firstName(). " ".$teacher->middleName();?>:</legend>
            <input type="number" hidden="hidden" value="<?=$teacher->teacher_id;?>" id="teacher">
            <br>
            <br>
            Роль:<br>
            <div class="form-group">
            <select name="role" class="form-control" placeholder="(Виберіть роль)">
                <option value="">Всі ролі</option>
                <optgroup label="Виберіть роль">
                    <?php
                    foreach($roles as $role){
                        ?>
                        <option value="<?php echo $role['id'];?>"><?php echo $role['alias'];?></option>
                    <?php
                    }
                    ?>
            </select>
            </div>
            <br>
            <br>
            <input class="btn btn-default" type="submit" value="Призначити роль">
    </form>
</div>
</div>

