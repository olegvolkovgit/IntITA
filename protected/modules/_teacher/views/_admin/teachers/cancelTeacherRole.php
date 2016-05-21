<?php
/**
 * @var $teacher Teacher
 * @var $roles array
 * @var $role UserRoles
 */
?>
<div class="col-md-8">
    <div id="addTeacherRole">
        <br>
        <form name="cancel-access">
            <fieldset>
                <legend>Співробітник: <em>
                        <?php echo $teacher->lastName()." ".$teacher->firstName(). " ".$teacher->middleName();?></em></legend>
                <input type="text" id="teacher" value="<?php echo $teacher->user_id ?>" style="display:none">
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
                <br>
                <input type="submit" class="btn btn-default" onclick="cancelTeacherRole('<?= Yii::app()->createUrl("/_teacher/_admin/teachers/unsetTeacherRole"); ?>'); return false;" value="Скасувати роль">
        </form>
    </div>
</div>