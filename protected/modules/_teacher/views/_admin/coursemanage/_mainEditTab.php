<?php
/*
 * @var $model Course
 * @var $levels array
 * @var $level Level
 * @var $scenario string
 */
?>
<br>
<form class="form-horizontal" role="form" enctype="multipart/form-data">
    <div class="form-group">
        <label class="control-label col-sm-2" for="lang">Мова *:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="lang" placeholder="мова" required value="<?=$model->language;?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="alias">Псевдонім *:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="alias" placeholder="псевдонім" required value="<?=$model->alias;?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="number">Номер *:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="number" placeholder="номер" required value="<?=$model->course_number;?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="level">Pівень *:</label>
        <div class="col-sm-10">
            <select class="form-control" id="level">
                <?php foreach ($levels as $level) {?>
                    <option value="<?=$level->id?>" <?php if($model->level == $level->id) echo "selected"; ?>>
                        <?=$level->title_ua;?>
                    </option>
                    <?php
                }?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label class="radio-inline"><input type="radio" name="status" checked>В розробці</label>
                <label class="radio-inline"><input type="radio" name="status">Готовий</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label class="radio-inline"><input type="radio" name="cancelled">Доступний</label>
                <label class="radio-inline"><input type="radio" name="cancelled" checked>Видалений</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="image">Зображення:</label>
        <div class="col-sm-10">
            <input type="file" id="image">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Зберегти</button>
        </div>
    </div>
</form>

