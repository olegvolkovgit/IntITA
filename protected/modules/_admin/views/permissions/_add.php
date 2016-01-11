<div id="addAccess">
    <br>
    <a name="form"></a>

    <form action="<?php echo Yii::app()->createUrl('/_admin/permissions/newPermission'); ?>" method="POST"
          name="add-access">
        <fieldset>
            <div class="col-md-4">
                <legend id="label">Додати новий запис:</legend>
                Користувач:<br>

                <div class="form-group">
                    <select name="user" class="form-control" placeholder="(Виберіть користувача)" autofocus>
                        <?php $users = StudentReg::generateUsersList();
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
                    <select name="course" class="form-control" placeholder="(Виберіть курс)" onchange="selectModule();">
                        <option value="">Всі курси</option>
                        <optgroup label="Виберіть курс">
                            <?php $courses = Course::generateCoursesList();
                            $count = count($courses);
                            for ($i = 0; $i < $count; $i++) {
                                ?>
                                <option
                                    value="<?php echo $courses[$i]['id'];?>"><?php echo $courses[$i]['alias'];?></option>
                            <?php
                            }
                            ?>
                    </select>
                </div>
                <br>
                <br>

                Модуль:<br>

                <div name="selectModule" style="float:left;"></div>
                <br>
                <br>

                <fieldset id="rights">
                    <legend>Права</legend>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="read" value="1"/>READ<br/>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="edit" value="2"/>EDIT<br/>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="create" value="3"/>CREATE<br/>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="delete" value="4"/>DELETE<br/>
                        </label>
                    </div>


                </fieldset>
                <input type="submit" class="btn btn-default" value="Додати">
                <br>
            </div>
    </form>
</div>
