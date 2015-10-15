<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/module/index');?>">Список модулів</a>
<br>
<h2>Модуль #<?php echo $id." ".ModuleHelper::getModuleName($id);?></h2>
<br>
<form action="<?php echo Yii::app()->createUrl('/_admin/module/addMandatoryModule');?>" method="POST" name="add-accessModule">
    <fieldset>
        <legend id="label">Задати попередній модуль у курсі:</legend>
        Виберіть курс:<br>
        <input type="text" hidden="hidden" value="<?php echo $id;?>" name="module">
        <select name="course" id="courseList">
            <option value="">Виберіть курс</option>
            <optgroup label="Курси">
                <?php $courses = CourseHelper::generateModuleCoursesList($id);
                $count = count($courses);
                for($i = 0; $i < $count; $i++){
                        ?>
                        <option value="<?php echo $courses[$i]['id'];?>"><?php echo $courses[$i]['alias'];
                    if ($courses[$i]["mandatory"] != 0 || $courses[$i]["mandatory"] != null) {
                            ?>
                            - попередній модуль
                            #<?php echo ModuleHelper::getModuleName($courses[$i]["mandatory"]); ?></option>
                    <?php
                    }
                }
                ?>
        </select>
        <br>
        <br>

        Попередній модуль:<br>
        <div name="selectModule" style="float:left;">
            <select name="mandatory" id="moduleList">
                <option value="">Виберіть модуль</option>
                <optgroup label="Модулі">
                    <?php $modules = AccessHelper::generateModulesList();
                    $count = count($modules);

                    for($i = 0; $i < $count; $i++){
                        ?>
                        <option value="<?php echo $modules[$i]['id'];?>"><?php echo $modules[$i]['alias'];?></option>
                        <?php
                    }
                    ?>
            </select>
        </div>

        <br>
        <br>

        <input type="submit" value="Задати попередній модуль">
</form>

