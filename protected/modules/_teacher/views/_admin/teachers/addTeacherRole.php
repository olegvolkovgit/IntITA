<?php
/**
 * @var $teacher Teacher
 * @var $roles array
 * @var $role UserRoles
 */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/index'); ?>',
                    'Співробітники')">Співробітники</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/showTeacher', array('id' => $teacher->user_id)); ?>',
                    'Переглянути інформацію про співробітника')">
            Переглянути інформацію про співробітника</button>
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
            <input class="btn btn-default" type="submit" onclick="setTeacherRole('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/setTeacherRole');?>'); return false" value="Призначити роль">
        </fieldset>
    </form>
</div>
</div>

