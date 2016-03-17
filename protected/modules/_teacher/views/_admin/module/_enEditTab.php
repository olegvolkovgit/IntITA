<?php
/* @var $model Module
 * @var $scenario string
 */
?>
<br>
<div class="form-group">
    <label class="control-label col-sm-2" for="titleEn">Назва (англ.) *:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="titleEn" name="titleEn" placeholder="назва англійською" required
               value="<?= $model->title_en; ?>" pattern="/^[=a-zA-Z0-9.,\/<>:;`'?!~* ()+-]+$/u">
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Зберегти</button>
    </div>
</div>
