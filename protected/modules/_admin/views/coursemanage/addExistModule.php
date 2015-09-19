<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 19.09.2015
 * Time: 11:51
 */
?>

<div id="addModuleToCourse">
    <br>
    <a name="form"></a>
    <form action="<?php echo Yii::app()->createUrl('/_admin/coursemanage/addModuleToCourse');?>" method="POST" name="add-module">
        <fieldset>
            <legend id="label">Виберіть модуль:</legend>
            Модуль:<br>
            <select name="module" placeholder="(Виберіть користувача)" autofocus>
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
            Курс:<br>
            <select name="course" placeholder="(Виберіть курс)" onchange="selectModule();">
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

            <input type="submit" value="Додати модуль до курса">
    </form>
</div>
