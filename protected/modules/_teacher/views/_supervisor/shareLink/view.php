<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('sharedlinks')">
            Всі посилання
        </button>
    </li>
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('sharedlinks/edit/<?=$model->id?>')">
            Редагувати посилання
        </button>
    </li>
</ul>

<div class="row">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-12">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <td width="30%"><strong>Назва</strong></td>
                        <td><?= CHtml::encode($model->name); ?></td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Посилання</strong></td>
                        <td>
                            <a href="<?= $model->link ?>">
                                <?= CHtml::encode($model->link); ?>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

