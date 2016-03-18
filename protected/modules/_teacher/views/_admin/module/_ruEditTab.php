<?php
/* @var $model Module
 * @var $scenario string
 */
?>
<br>
<div class="form-group">
    <label class="control-label col-sm-2" for="title_ru">Назва (рус.) *:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="title_ru" name="title_ru" placeholder="назва російською"
               value="<?= $model->title_ru; ?>">
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Зберегти</button>
    </div>
</div>
