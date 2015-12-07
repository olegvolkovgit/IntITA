<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 16.06.2015
 * Time: 17:47
 */

$this->breadcrumbs=array(
    'Викладачі'=>array('index'),
    'Ролі викладача',
    'Призначити атрибут ролі'
);
?>
<div class="col-md-4">
<div id="addTeacherRole">
    <br>
    <a name="form"></a>
    <form action="<?php echo Yii::app()->createUrl('/_admin/permissions/setTeacherRoleAttribute');?>" method="POST" name="add-access">
        <fieldset>
            <legend id="label">Призначити роль викладачу <?php echo $teacher;?>:</legend>
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
            <select name="role" class="form-control" placeholder="(Виберіть роль)" onchange="selectRole();">
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

            Атрибути ролі:<br>

            <div name="selectAttribute" class="form-group" style="float:left;" onchange="selectAttribute();"></div>
            <br>
            <br>
            <div name="inputValue" class="form-group" style="float:left;"></div>
            <br>
            <br>
            <br>
            <br>
            <input type="submit" class="btn btn-default" value="Призначити атрибут">
    </form>
</div>
</div>
<script type="text/javascript">
    function selectRole(){
        var role = $('select[name="role"]').val();

        if(!role){
            $('div[name="selectRole"]').html('');
            $('div[name="selectAttribute"]').html('');
        }else{
            $.ajax({
                type: "POST",
                url: "/_admin/permissions/showAttributes",
                data: {role: role},
                cache: false,
                success: function(response){
                    $('div[name="selectAttribute"]').html(response);
                }
            });
        }
    }

    function selectAttribute(){
        var attribute = $('select[name="attribute"]').val();
        if(!attribute){
            $('div[name="inputValue"]').html('');
        }else {
            $.ajax({
                type: "POST",
                url: "/_admin/permissions/showAttributeInput",
                data: {attribute: attribute},
                cache: false,
                success: function (response) {
                    $('div[name="inputValue"]').html(response);
                }
            });
        }
    }
</script>