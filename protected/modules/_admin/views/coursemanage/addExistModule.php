<div id="addModuleToCourse" style="margin-top: 50px">
    <br>
    <a name="form"></a>


    <form action="<?php echo Yii::app()->createUrl('/_admin/coursemanage/addModuleToCourse'); ?>" method="POST"
          name="add-module">
        <fieldset>
            <legend id="label">Виберіть модуль:</legend>
            Модуль:<br>

            <div class="form-group">
                <select name="module" placeholder="(Виберіть модуль)" autofocus class="form-control"
                        style="width: 350px">
                    <?php $modules = Module::generateModulesList();
                    $count = count($modules);
                    for ($i = 0; $i < $count; $i++) {
                        ?>
                        <option value="<?php echo $modules[$i]['id']; ?>"><?php echo $modules[$i]['alias']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <br>
            <br>
            Курс:<br>

            <div class="form-group">
                <select name="course" placeholder="(Виберіть курс)" onchange="selectModule();" class="form-control"
                        style="width: 350px">
                    <option value="">Всі курси</option>
                    <optgroup label="Виберіть курс">
                        <?php $courses = Course::generateCoursesList();
                        $count = count($courses);
                        for ($i = 0; $i < $count; $i++) {
                            ?>
                            <option
                                value="<?php echo $courses[$i]['id']; ?>"><?php echo $courses[$i]['alias']." (".
                                    $courses[$i]['language'].")"; ?></option>
                        <?php
                        }
                        ?>
                </select>
            </div>
            <br>
            <br>
            <input class="btn btn-default" type="submit" value="Додати модуль до курсу">
        </fieldset>
    </form>
</div>
