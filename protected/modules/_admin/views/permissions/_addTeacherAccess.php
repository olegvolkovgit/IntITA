<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 23.05.2015
 * Time: 13:32
 */
?>

<div id="addTeacherAccess">
    <br>
    <a name="formTeacher"></a>
    <form action="<?php echo Yii::app()->createUrl('/_admin/permissions/newTeacherPermission');?>" method="POST" name="add-teacher-access">
        <fieldset>
            <legend id="label">Надати права автора модуля:</legend>
            Викладач:<br>
            <select name="user" placeholder="(Виберіть викладача)" autofocus>
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
            Курс:<br>
            <select name="course1" placeholder="(Виберіть курс)" onchange="javascript:selectModule1();">
                <option value="">Всі курси</option>
                <optgroup label="Виберіть курс">
                    <?php $courses = AccessHelper::generateCoursesList();
                    $count = count($courses);
                    for($i = 0; $i < $count; $i++){
                        ?>
                        <option value="<?php echo $courses[$i]['id'];?>">
                            <?php echo $courses[$i]['alias']." (".$courses[$i]['language'].")";?>
                        </option>
                    <?php
                    }
                    ?>
            </select>
            <br>
            <br>

            Модуль:<br>
            <div name="selectModule1" style="float:left;"></div>
            <br>
            <br>

            <input type="submit" value="Додати">
    </form>
</div>