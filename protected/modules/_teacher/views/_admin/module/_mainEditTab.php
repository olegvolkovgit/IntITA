<?php
/*
 * @var $model Module
 * @var $levels array
 * @var $level Level
 * @var $scenario string
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="form-group">
            <label class="control-label col-sm-2" for="alias">Псевдонім</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="alias" placeholder="Псевдонім" name="alias"
                       value="<?= $model->alias ?>" required pattern="[a-z0-9]{1,20}"
                       title="Псевдонім модуля може містити тільки англійські літери, довжиною 1-20 символів.">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="number">Номер модуля:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="number" name="number" placeholder="Номер модуля"
                       value="<?= $model->number ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="level">Pівень:</label>
            <div class="col-sm-10">
                <select class="form-control" id="level" name="level">
                    <?php foreach ($levels as $level) { ?>
                        <option value="<?= $level->id ?>"><?= $level->title_ua; ?></option>
                        <?php
                    } ?>
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
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Зберегти</button>
            </div>
        </div>
    </div>
</div>
