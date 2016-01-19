<div class="col-md-6">
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/index'); ?>')">
                Список курсів</button>
        </li>
    </ul>
<div id="addModuleToCourse">
    <br>

    <form onsubmit="addExistModule('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/addModuleToCourse'); ?>');
        return false;"
                name="add-module">
        <fieldset>
            <legend id="label">Виберіть модуль:</legend>
            Модуль:<br>
            <div class="form-group">
                <select name="module" placeholder="(Виберіть модуль)" autofocus class="form-control"
                        >
                    <?php
                    foreach($modules as $module) {
                        ?>
                        <option value="<?php echo $module['id']; ?>"><?php echo $module['alias']." (".$module['language'].")"; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <br>
            <br>
            Курс:<br>

            <div class="form-group">
                <select name="course" placeholder="(Виберіть курс)" onchange="selectModule();" class="form-control">
                    <optgroup label="Виберіть курс">
                        <?php
                        foreach($courses as $course)  {
                            ?>
                            <option
                                value="<?php echo $course['id']; ?>"><?php echo $course['alias']." (".
                                    $course['language'].")"; ?></option>
                        <?php
                        }
                        ?>
                </select>
            </div>
            <br>
            <br>
            <input class="btn btn-default" type="submit" value="Додати модуль до курса">
        </fieldset>
    </form>
</div>
</div>
