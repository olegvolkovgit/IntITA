<?php
/* @var $this ConfigController */
/* @var $model Config */
?>
<div class="row">
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/configuration/siteconfig">
                Список налаштувань
            </a>
        </li>
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/configuration/siteconfig/edit/<?=$model->id?>">
                Редагувати налаштування
            </a>
        </li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-12">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <td width="30%"><strong>Налаштування</strong></td>
                        <td><?= $model->param; ?></td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Значення</strong></td>
                        <td>
                            <?= $model->value; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Значення (за замовчуванням)</strong></td>
                        <td>
                            <?= $model->default; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Опис</strong></td>
                        <td>
                            <?= $model->label; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Тип значення</strong></td>
                        <td>
                            <?= $model->type; ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

