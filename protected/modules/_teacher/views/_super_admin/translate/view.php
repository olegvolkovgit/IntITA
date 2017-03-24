<?php
/* @var $this MessagesController */
/* @var $model Translate */
?>
<div class="row">
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/interfacemessages">
                Інтерфейсні повідомлення</a>
        </li>
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/interfacemessages/edit/<?= $model->id_record ?>">
                Редагувати</a>
        </li>
    </ul>
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
                            <?php if($model->source){
                                CHtml::encode($model->source->category);
                            } ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
