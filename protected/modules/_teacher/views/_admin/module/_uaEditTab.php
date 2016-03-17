<?php
/* @var $model Module
 * @var $scenario string
 */
?>
<br>
<div class="form-group">
    <label class="control-label col-sm-2" for="titleUa">Назва (укр.) *:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="titleUa" name="titleUa" placeholder="назва українською" required
               value="<?= $model->title_ua; ?>" pattern="/^[=а-еж-щьюяА-ЕЖ-ЩЬЮЯa-zA-Z0-9ЄєІіЇї.,\/<>:;`'?!~* ()+-]+$/u">
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Зберегти</button>
    </div>
</div>
