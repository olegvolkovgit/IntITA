<?php
/* @var $model Course
 * @var $scenario string
 */
?>
<br>
<form class="form-horizontal" role="form" enctype="multipart/form-data">
    <div class="form-group">
        <label class="control-label col-sm-2" for="titleRu">Назва (рос.) *:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="titleRu" placeholder="назва російською" required value="<?=$model->title_ru;?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="forWhomRu">Для кого (рос.):</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="5" id="forWhomRu" placeholder="для кого"><?=$model->for_whom_ru;?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="whatYouLearnRu">Що ти вивчиш (рос.):</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="5" id="whatYouLearnRu" placeholder="що ти вивчиш"><?=$model->what_you_learn_ru;?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="whatYouGetRu">Що ти отримаєш (рос.):</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="5" id="whatYouGetRu" placeholder="що ти отримаєш"><?=$model->what_you_get_ru;?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Зберегти</button>
        </div>
    </div>
</form>