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

<div id="addTeacherRole">
    <br>
    <a name="form"></a>
    <form action="<?php echo Yii::app()->createUrl('/_admin/permissions/setTeacherRoleAttribute');?>" method="POST" name="add-access">
        <fieldset>
            <legend id="label">Призначити роль викладачу <?php echo $teacher;?>:</legend>
            Викладач:<br>
            <select name="teacher" placeholder="(Виберіть викладача)" autofocus>
                <?php $users = AccessHelper::generateTeachersList();
                $count = count($users);
                for($i = 0; $i < $count; $i++){
                    ?>
                    <option value="<?php echo $users[$i]['id'];?>"><?php echo $users[$i]['alias'];?></option>
                <?php
                }
                ?>
            </select>
            <br>
            <br>
            Роль:<br>
            <select name="role" placeholder="(Виберіть роль)" onchange="selectRole();">
                <option value="">Всі ролі</option>
                <optgroup label="Виберіть роль">
                    <?php $courses = AccessHelper::generateRolesList();
                    $count = count($courses);
                    for($i = 0; $i < $count; $i++){
                        ?>
                        <option value="<?php echo $courses[$i]['id'];?>"><?php echo $courses[$i]['alias'];?></option>
                    <?php
                    }
                    ?>
            </select>
            <br>
            <br>

            Атрибути ролі:<br>
            <div name="selectAttribute" style="float:left;" onchange="selectAttribute();"></div>
            <br>
            <br>
            <div name="inputValue"  style="float:left;"></div>
            <br>
            <br>
            <br>
            <br>
            <input type="submit" value="Призначити атрибут">
    </form>
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
                url: "/IntITA/_admin/permissions/showAttributes",
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
                url: "/IntITA/_admin/permissions/showAttributeInput",
                data: {attribute: attribute},
                cache: false,
                success: function (response) {
                    $('div[name="inputValue"]').html(response);
                }
            });
        }
    }
</script>