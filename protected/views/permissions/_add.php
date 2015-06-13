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
        <select name="course" placeholder="(Виберіть курс)" onchange="javascript:selectModule();">
            <option value="">Всі курси</option>
            <optgroup label="Виберіть курс">
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
            <div name="selectModule" style="float:left;"></div>
            <br>
            <br>

        Лекція:<br>
            <div name="selectLecture" style="float:left;"></div>
        <br>
        <br>
            <fieldset id="rights">
                <legend>Права</legend>
                <input type="checkbox" name="read" value="1" />READ<br />
                <input type="checkbox" name="edit" value="2" />EDIT<br />
                <input type="checkbox" name="create" value="3" />CREATE<br />
                <input type="checkbox" name="delete" value="4" />DELETE<br/>
                </fieldset>
        <input type="submit" value="Додати">
    </form>
</div>
