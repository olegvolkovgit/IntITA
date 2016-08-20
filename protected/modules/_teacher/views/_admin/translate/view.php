<?php
/* @var $this MessagesController */
/* @var $model Translate */
?>

<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('interfacemessages')">
            Інтерфейсні повідомлення</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('interfacemessages/edit/<?= $model->id_record ?>')">
            Редагувати</button>
    </li>
</ul>

<div class="row">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-12">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <td width="30%"><strong>ID запису</strong></td>
                        <td><?= $model->id_record; ?></td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>ID перекладу</strong></td>
                        <td>
                            <?= $model->id; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Мова</strong></td>
                        <td>
                            <?= $model->language; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Переклад</strong></td>
                        <td>
                            <?= CHtml::encode($model->translation); ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Коментар:</strong></td>
                        <td>
                            <?= MessageComment::getMessageCommentById($model->id); ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Категорія:</strong></td>
                        <td>
                            <?= CHtml::encode($model->source->category); ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
