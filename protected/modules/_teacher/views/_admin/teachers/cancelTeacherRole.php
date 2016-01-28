<?php
/**
 * @var $teacher Teacher
 * @var $roles array
 */
?>
<div class="col-md-8">
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/index'); ?>','Викладачі')">
            Викладачі</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/roles'); ?>')">
            Ролі викладачів</button>
    </li>
</ul>

<div id="addTeacherRole">
    <br>
    <a name="form"></a>
    <form name="cancel-access">
        <fieldset>
            <legend id="label">Скасувати роль викладача <?php echo $teacher->first_name." ".$teacher->last_name;?>:</legend>
            <input type="text" id="teacher" value="<?php echo $teacher->teacher_id?>" style="display:none">
            Роль:<br>
            <div class="form-group">
            <select name="role" class="form-control" placeholder="(Виберіть роль)">
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
            <input type="submit" class="btn btn-default"
                   onsubmit="cancelTeacherRole('<?= Yii::app()->createUrl('/_teachers/_admin/permissions/cancelTeacherRole');?>');
                       return false;"
                   value="Скасувати роль">
    </form>
</div>

</div>
<script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
