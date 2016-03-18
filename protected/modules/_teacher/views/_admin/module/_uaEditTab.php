<?php
/* @var $model Module
 * @var $scenario string
 */
?>
<br>
<div class="form-group">
    <label class="control-label col-sm-2" for="title_ua">Назва (укр.) *:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="title_ua" name="title_ua" placeholder="назва українською"
               value="<?= $model->title_ua; ?>">
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Зберегти</button>
    </div>
</div>
