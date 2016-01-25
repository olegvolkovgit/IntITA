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
<div class="col-md-4">
<div id="addTeacherRole">
    <br>
    <a name="form"></a>
    <form action="<?php echo Yii::app()->createUrl('/_admin/permissions/setTeacherRole');?>" method="POST" name="add-access">
        <fieldset>
            <legend id="label">Призначити роль викладачу
                <?php echo $teacher->lastName()." ".$teacher->firstName(). " ".$teacher->middleName();?>:</legend>
            <input type="number" hidden="hidden" value="<?=$teacher->teacher_id;?>" name="teacher">
            <br>
            <br>
            Роль:<br>
            <div class="form-group">
            <select name="role" class="form-control" placeholder="(Виберіть роль)" onchange="
                selectRole('<?=Yii::app()->createUrl("/_admin/permissions/showRoles");?>');">
                <option value="">Всі ролі</option>
                <optgroup label="Виберіть роль">
                    <?php $courses = Roles::generateRolesList();
                    $count = count($courses);
                    for($i = 0; $i < $count; $i++){
                        ?>
                        <option value="<?php echo $courses[$i]['id'];?>"><?php echo $courses[$i]['alias'];?></option>
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

<script>
    function selectRole(url){
        var course = $('select[name="course"]').val();
        if(!course){
            $('div[name="selectRole"]').html('');
        }else{
            $.ajax({
                type: "POST",
                url: url,
                data: {course: course},
                cache: false,
                success: function(response){ $('div[name="selectModule"]').html(response); }
            });
        }
    }
</script>
