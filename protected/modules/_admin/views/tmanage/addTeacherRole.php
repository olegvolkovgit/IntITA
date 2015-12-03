<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 16.06.2015
 * Time: 17:47
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
<div class="col-md-4">
<div id="addTeacherRole">
    <br>
    <a name="form"></a>
    <form action="<?php echo Yii::app()->createUrl('/_admin/permissions/setTeacherRole');?>" method="POST" name="add-access">
        <fieldset>
            <legend id="label">Призначити роль викладачу <?php  echo $teacher->last_name. ' ' . $teacher->first_name . ' ' . $teacher->middle_name;?>:</legend>
            Викладач:<br>
            <div class="form-group">
            <select name="teacher" class="form-control" placeholder="(Виберіть викладача)" autofocus>
                <?php $users = AccessHelper::generateTeachersList();
                $count = count($users);
                for($i = 0; $i < $count; $i++){
                    ?>
                    <option value="<?php echo $users[$i]['id'];?>"><?php echo $users[$i]['alias'];?></option>
                <?php
                }
                ?>
            </select>
            </div>
            <br>
            <br>
            Роль:<br>
            <div class="form-group">
            <select name="role" class="form-control" placeholder="(Виберіть роль)" onchange="javascript:selectRole();">
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



<script type="text/javascript">
    function selectRole(){
        var course = $('select[name="course"]').val();
        if(!course){
            $('div[name="selectRole"]').html('');
        }else{
            $.ajax({
                type: "POST",
                url: "/_admin/permissions/showRoles",
                data: {course: course},
                cache: false,
                success: function(response){ $('div[name="selectModule"]').html(response); }
            });
        }
    }
</script>
