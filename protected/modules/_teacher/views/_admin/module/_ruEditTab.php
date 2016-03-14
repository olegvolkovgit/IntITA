<?php
/* @var $model Module
 * @var $scenario string
 */
?>
<br>
<form class="form-horizontal" role="form" enctype="multipart/form-data">
    <div class="form-group">
        <label class="control-label col-sm-2" for="titleRu">Назва (англ.) *:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="titleRu" placeholder="назва англійською" required value="<?=$model->title_ru;?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Зберегти</button>
        </div>
    </div>
</form>