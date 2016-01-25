<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/index'); ?>')">
            Права доступу</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/showAddAccessForm'); ?>')">
            Додати запис</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/showCancelTeacherAccess'); ?>')">
            Скасувати автора модуля</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/UserStatus'); ?>')">
            Змінити статус користувача</button>
    </li>
</ul>

<div id="addTeacherAccess">
    <br>
    <a name="formTeacher"></a>

    <form action="" name="add-teacher-access"
       onsubmit="addTeacherAccess('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/newTeacherPermission');?>');
            return false;">
        <fieldset>
            <legend id="label">Надати права автора модуля:</legend>
            Викладач:<br>
            <div class="col-md-4">
                <div class="form-group">
                    <select name="user" class="form-control" placeholder="(Виберіть викладача)" autofocus required="true">
                        <?php
                        foreach($users as $user){
                            ?>
                            <option value="<?php echo $user['id']; ?>"><?php echo $user['alias']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            <br>
            <br>
            Курс:<br>
                <div class="form-group">
                    <select name="course" class="form-control" placeholder="(Виберіть курс)" required="true"
                       onchange="selectModule('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/showModules');?>');">
                    <option value="">Всі курси</option>
                    <optgroup label="Виберіть курс">
                        <?php
                        foreach($courses as $course){
                            ?>
                            <option value="<?php echo $course['id'];?>">
                                <?php echo $course['alias']." (".$course['language'].")";?>
                            </option>
                        <?php
                        }
                        ?>
                     </select>
                    </div>
            <br>
            <br>

            Модуль:<br>
            <div name="selectModule" class="form-group" ></div>
            <br>
            <br>
                <br>

            <input type="submit" class="btn btn-default" value="Додати">
            </div>
        </fieldset>

    </form>
</div>

<script src="<?php echo StaticFilesHelper::fullPathTo('css', '/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>