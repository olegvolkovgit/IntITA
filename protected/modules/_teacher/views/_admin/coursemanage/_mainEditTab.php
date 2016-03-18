<?php
/**
 * @var $model Course
 * @var $levels array
 * @var $level Level
 * @var $scenario string
 */
?>
<br>
<div class="form-group">
    <label class="control-label col-sm-2" for="lang">Мова *:</label>
    <div class="col-sm-10">
        <select class="form-control" id="lang" name="lang">
            <option value="ua" <?php if ($model->language == "ua") echo "selected"; ?>>Українська</option>
            <option value="ru" <?php if ($model->language == "ru") echo "selected"; ?>>Російська</option>
            <option value="en" <?php if ($model->language == "en") echo "selected"; ?>>Англійська</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="alias">Псевдонім *:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="alias" placeholder="псевдонім"
               value="<?= $model->alias; ?>"
               pattern="[a-z0-9]{1,20}" title="Псевдонім може містити тільки англійські літери і цифри." name="alias">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="num">Номер *:</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" id="num" name="num" placeholder="номер"
               value="<?= $model->course_number; ?>" min="0">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="level">Pівень *:</label>
    <div class="col-sm-10">
        <select class="form-control" id="level" name="level">
            <?php foreach ($levels as $level) { ?>
                <option value="<?= $level->id ?>" <?php if ($model->level == $level->id) echo "selected"; ?>>
                    <?= $level->title_ua; ?>
                </option>
                <?php
            } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
            <label class="radio-inline"><input type="radio" name="status" value="develop" checked>В розробці</label>
            <label class="radio-inline"><input type="radio" name="status" value="ready">Готовий</label>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
            <label class="radio-inline"><input type="radio" name="isCancel" value="available">Доступний</label>
            <label class="radio-inline"><input type="radio" name="isCancel" value="cancelled" checked>Видалений</label>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="image">Зображення:</label>
    <div class="col-sm-10">
        <input type="file" id="image" data-fv-file-maxfiles="1" data-fv-file-maxsize="5242880"
               data-fv-file-type="image/jpeg,image/png,image/gif">
    </div>
</div>
<div class='form-actions'>
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">
            Зберегти
        </button>
<!--        <button type="reset" class="btn">Скасувати</button>-->
    </div>
</div>


