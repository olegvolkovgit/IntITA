<?php
/* @var $model Course
 * @var $scenario string
 */
?>
<br>
<form role="form" class="form-horizontal">
    <div class="form-group">
        <label class="control-label col-sm-2" for="titleEn">Назва (англ.) *:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="titleEn" placeholder="назва англійською" required
                   value="<?= $model->title_en; ?>" pattern="/^[=a-zA-Z0-9.,\/<>:;`'?!~* ()+-]+$/u"
                   title="Тільки англійські літери">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="forWhomEn">Для кого (англ.):</label>
        <div class="col-sm-10">
        <textarea class="form-control" rows="5" id="forWhomEn"
                  placeholder="для кого"><?= $model->for_whom_en; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="whatYouLearnEn">Що ти вивчиш (англ.):</label>
        <div class="col-sm-10">
        <textarea class="form-control" rows="5" id="whatYouLearnEn"
                  placeholder="що ти вивчиш"><?= $model->what_you_learn_en; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="whatYouGetEn">Що ти отримаєш (англ.):</label>
        <div class="col-sm-10">
        <textarea class="form-control" rows="5" id="whatYouGetEn"
                  placeholder="що ти отримаєш"><?= $model->what_you_get_en; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Зберегти</button>
        </div>
    </div>
</form>
