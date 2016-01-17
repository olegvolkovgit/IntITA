<?php
/**
 * @var $model Teacher
 */
?>
<div class="col-md-6">
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/index'); ?>','Викладачі')">
                Викладачі</button>
        </li>
    </ul>
<div id="addTeacherRole">
    <form onsubmit="addTeacherAttr('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/setTeacherRoleAttribute');?>')"
          name="add-access">
        <fieldset>
            <legend id="label">Призначити роль викладачу
                <?php echo $model->lastName()." ".$model->firstName(). " ".$model->middleName();?>:</legend>
            <input type="number" hidden="hidden" value="<?=$model->teacher_id;?>" id="teacher">

            Роль:<br>
            <div class="form-group">
            <select name="role" class="form-control" placeholder="(Виберіть роль)" required="required"
                    onchange="selectRole('<?= Yii::app()->createUrl('/_teacher/_admin/permissions/showAttributes') ?>');">
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

            Атрибути ролі:<br>

            <div name="selectAttribute" class="form-group"></div>
            <br>
            <br>
            <br>
            <div name="inputValue" class="form-group"></div>
            <br>
            <br>
            <input type="submit" class="btn btn-default" value="Призначити атрибут">
    </form>
</div>
</div>
<script>

</script>