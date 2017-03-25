<?php
/* @var $model Level */
?>
<div class="panel-body">
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/configuration/levels">
                Всі рівні курсів
            </a>
        </li>
    </ul>
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form role="form" method="post" action="<?= Yii::app()->createUrl('/_teacher/_super_admin/level/update'); ?>">
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
                        <a type="reset" class="btn btn-outline btn-default" ng-href="#/configuration/levels">Скасувати
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
