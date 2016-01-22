<?php
/* @var $model Level */
?>
<div class="panel-body">
    <div class="row">
        <div class="col-lg-6">
            <form role="form" method="post" action="<?=Yii::app()->createUrl('/_teacher/_admin/level/update');?>">
                <input name="id" class="form-control" value="<?= $model->id; ?>" hidden style="display: none" type="number">
                <div class="form-group">
                    <label>Номер (рейтинг)</label>
                    <p class="form-control-static"><?= $model->id; ?></p>
                </div>
                <div class="form-group">
                    <label>Назва українською</label>
                    <input name="titleUa" class="form-control" value="<?= $model->title_ua; ?>" required>
                </div>
                <div class="form-group">
                    <label>Назва англійською</label>
                    <input name="titleEn" class="form-control" value="<?= $model->title_en; ?>" required>
                </div>

                <div class="form-group">
                    <label>Назва російською</label>
                    <input name="titleRu" class="form-control" value="<?= $model->title_ru; ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Зберегти</button>
                <button type="reset" class="btn btn-default">Скасувати</button>
            </form>
        </div>
    </div>
</div>
