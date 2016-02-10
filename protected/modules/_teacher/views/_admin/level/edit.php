<?php
/* @var $model Level */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/level/index'); ?>',
                    'Рівні курсів, модулів')">
            Всі рівні курсів
        </button>
    </li>
</ul>
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
                    <label>Назва українською
                    <input name="titleUa" class="form-control" value="<?= $model->title_ua; ?>" required>
                    </label>
                </div>
                <div class="form-group">
                    <label>Назва англійською
                    <input name="titleEn" class="form-control" value="<?= $model->title_en; ?>" required>
                    </label>
                </div>

                <div class="form-group">
                    <label>Назва російською
                    <input name="titleRu" class="form-control" value="<?= $model->title_ru; ?>" required>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Зберегти</button>
                <button type="reset" class="btn btn-default"
                        onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/level/index'); ?>',
                    'Рівні курсів, модулів')">Скасувати</button>
            </form>
        </div>
    </div>
</div>
