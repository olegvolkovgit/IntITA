<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 23.05.2015
 * Time: 13:32
 */

?>

<div id="addAccess">
    <br>
    <a name="form"></a>
    <form action="<?php echo Yii::app()->createUrl('permissions/newPermission');?>" method="POST" name="add-access">
        <fieldset>
            <legend id="label">Додати новий запис:</legend>
        Користувач:<br>
        <select name="user" placeholder="(Виберіть користувача)" autofocus>
            <?php $users = AccessHelper::generateUsersList();
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
        <select name="course" placeholder="(Виберіть курс)">
            <?php $courses = AccessHelper::generateCoursesList();
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
        Модуль:<br>
            <select name="module" placeholder="(Виберіть модуль)">
                <?php $modules = AccessHelper::generateModulesList();
                $count = count($modules);
                for($i = 0; $i < $count; $i++){
                    ?>
                    <option value="<?php echo $modules[$i]['id'];?>"><?php echo $modules[$i]['alias'];?></option>
                <?php
                }
                ?>
            </select>
            <br>
            <br>
        Лекція:<br>
            <select name="lecture" placeholder="(Виберіть лекцію)">
                <?php $lectures = AccessHelper::generateLecturesList();
                $count = count($lectures);
                for($i = 0; $i < $count; $i++){
                    ?>
                    <option value="<?php echo $lectures[$i]['id'];?>"><?php echo $lectures[$i]['alias'];?></option>
                <?php
                }
                ?>
            </select>
        <br><br>
        <input type="submit" value="Додати">
    </form>
</div>
