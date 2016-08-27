<?php
/* @var $model Level */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('configuration/levels')">
            Всі рівні курсів
        </button>
    </li>
</ul>
<div class="panel-body">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form role="form" method="post" action="<?= Yii::app()->createUrl('/_teacher/_admin/level/update'); ?>">
                    <input name="id" class="form-control" value="<?= $model->id; ?>" hidden style="display: none"
                           type="number">

                    <div class="form-group">
                        <label>Номер (рейтинг)</label>
                        <div class="form-control" disabled><?= $model->id; ?></div>
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

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Зберегти</button>
                        <button type="reset" class="btn btn-outline btn-default" ng-click="changeView('configuration/levels')">Скасувати
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
