<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/index'); ?>')">
            Права доступу</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/showAddTeacherAccess'); ?>')">
            Призначити автора модуля</button>
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

<div id="addAccess">
    <br>

    <form name="add-access" action=""
        onsubmit="newPermissions('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/newPermission'); ?>');return false;">
        <fieldset>
            <div class="col-md-4">
                <legend id="label">Додати новий запис:</legend>
                Користувач:<br>
                <div class="form-group">
                    <select name="user" class="form-control" placeholder="(Виберіть користувача)" autofocus required="true">
                        <?php foreach($users as $user)
                        {?>
                            <option value="<?php echo $user['id'];?>"><?php echo $user['alias'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <br>

                Курс:<br>
                <div class="form-group">
                    <select name="course" class="form-control" placeholder="(Виберіть курс)" required="true"
                            onchange="selectModule('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/showModules');?>');">
                        <option value="">Всі курси</option>
                        <optgroup label="Виберіть курс">
                            <?php
                            foreach($courses as $course)
                            {
                                ?>
                                <option value="<?php echo $course['id'];?>"><?php echo $course['alias'];?></option>
                            <?php
                            }
                            ?>
                    </select>
                </div>
                <br>
                <br>

                Модуль:<br>

                <div name="selectModule"></div>
                <br>
                <br>

                <fieldset id="rights">
                    <legend>Права</legend>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permission[]" value="1"/>READ<br/>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permission[]" value="2"/>EDIT<br/>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permission[]" value="3"/>CREATE<br/>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permission[]" value="4"/>DELETE<br/>
                        </label>
                    </div>

                </fieldset>
                <input type="submit" class="btn btn-default" value="Додати">
                <br>
            </div>
    </form>
</div>

<script src="<?php echo StaticFilesHelper::fullPathTo('css', '/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>