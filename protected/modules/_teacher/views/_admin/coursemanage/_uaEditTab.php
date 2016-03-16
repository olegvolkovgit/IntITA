<?php
/* @var $model Course
 * @var $scenario string
 */
?>
<br>
<form class="form-horizontal" role="form">
    <div class="form-group">
        <label class="control-label col-sm-2" for="titleUa">Назва (укр.) *:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="titleUa" placeholder="назва українською" required
                   value="<?= $model->title_ua; ?>"
                   pattern="/^[=а-еж-щьюяА-ЕЖ-ЩЬЮЯa-zA-Z0-9ЄєІіЇї.,\/<>:;`'?!~* ()+-]+$/u">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="forWhomUa">Для кого (укр.):</label>
        <div class="col-sm-10">
        <textarea class="form-control" rows="5" id="forWhomUa"
                  placeholder="для кого"><?= $model->for_whom_ua; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="whatYouLearnUa">Що ти вивчиш (укр.):</label>
        <div class="col-sm-10">
        <textarea class="form-control" rows="5" id="whatYouLearnUa"
                  placeholder="що ти вивчиш"><?= $model->what_you_learn_ua; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="whatYouGetUa">Що ти отримаєш (укр.):</label>
        <div class="col-sm-10">
        <textarea class="form-control" rows="5" id="whatYouGetUa"
                  placeholder="що ти отримаєш"><?= $model->what_you_get_ua; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Зберегти</button>
        </div>
    </div>
</form>
