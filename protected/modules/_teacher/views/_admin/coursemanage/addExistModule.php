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
            <legend id="label">Виберіть курс:</legend>
            Курс:<br>
            <div class="form-group">
                <select name="course" placeholder="(Виберіть курс)" onchange="selectAccessModules('/_teacher/_admin/coursemanage/generationAvailableModule');" class="form-control">
                        <option disabled selected>Виберіть курс</option>
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
            Модуль:<br>
            <div name="selectModule" class="form-group" style="float:left;"></div>
            <br>
            <br>
            <input class="btn btn-default" type="submit" value="Додати модуль до курса">
        </fieldset>
    </form>
</div>
</div>
