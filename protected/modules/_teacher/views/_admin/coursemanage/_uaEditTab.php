<?php
/* @var $model Course
 * @var $scenario string
 */
?>
<br>
<div class="form-group">
    <label class="control-label col-sm-2" for="titleUa">Назва (укр.) *:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="titleUa" placeholder="назва українською" required
               value="<?= $model->title_ua; ?>" name="titleUa"
               pattern="/^[=а-еж-щьюяА-ЕЖ-ЩЬЮЯa-zA-Z0-9ЄєІіЇї.,\/<>:;`'?!~* ()+-]+$/u">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="forWhomUa">Для кого (укр.):</label>
    <div class="col-sm-10">
        <textarea class="form-control" rows="5" id="forWhomUa" name="forWhomUa"
                  placeholder="для кого"><?= $model->for_whom_ua; ?></textarea>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="whatYouLearnUa">Що ти вивчиш (укр.):</label>
    <div class="col-sm-10">
        <textarea class="form-control" rows="5" id="whatYouLearnUa" name="whatYouLearnUa"
                  placeholder="що ти вивчиш"><?= $model->what_you_learn_ua; ?></textarea>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="whatYouGetUa">Що ти отримаєш (укр.):</label>
    <div class="col-sm-10">
        <textarea class="form-control" rows="5" id="whatYouGetUa" name="whatYouGetUa"
                  placeholder="що ти отримаєш"><?= $model->what_you_get_ua; ?></textarea>
    </div>
</div>
<div class='form-actions'>
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Зберегти</button>
    </div>
<!--    <button type="reset" class="btn">Скасувати</button>-->
</div>
