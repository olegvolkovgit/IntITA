<div id="addTeacherAccess">
    <br>
    <a name="formTeacher"></a>

    <form action="<?php echo Yii::app()->createUrl('/_admin/permissions/newTeacherPermission'); ?>" method="POST"
          name="add-teacher-access">
        <fieldset>
            <legend id="label">Надати права автора модуля:</legend>
            Викладач:<br>

            <div class="col-md-4">
                <div class="form-group">
                    <select name="user" class="form-control" placeholder="(Виберіть викладача)" autofocus>
                        <?php $users = Teacher::generateTeachersList();
                        $count = count($users);
                        for ($i = 0; $i < $count; $i++) {
                            ?>
                            <option value="<?php echo $users[$i]['id'];?>"><?php echo $users[$i]['alias'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <br>
                <br>
                Курс:<br>

                <div class="form-group">
                    <select name="course1" class="form-control" placeholder="(Виберіть курс)"
                            onchange="selectModule1('<?=Yii::app()->createUrl('/_admin/permissions/showModules')?>')">
                        <option value="">Всі курси</option>
                        <optgroup label="Виберіть курс">
                            <?php $courses = Course::generateCoursesList();
                            $count = count($courses);
                            for ($i = 0; $i < $count; $i++) {
                                ?>
                                <option value="<?php echo $courses[$i]['id'];?>">
                                    <?php echo $courses[$i]['alias'] . " (" . $courses[$i]['language'] . ")";?>
                                </option>
                            <?php
                            }

                            ?>
                    </select>
                </div>
                <br>
                <br>
                Модуль:<br>
                <div name="selectModule1" class="form-group" style="float:left;"></div>
                <br>
                <br>
                <br>
                <input type="submit" class="btn btn-default" value="Додати">
            </div>
        </fieldset>
    </form>
</div>