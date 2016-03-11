<?php
/**
 * @var $model MessagesAuthorRequest
 * @var $user StudentReg
 */
$user = Yii::app()->user->model;
?>
<div class="row">
    <div class="col col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Запит</h4>
            </div>
            <div class="panel-body">
                <h4>
                    Модуль: <a
                        href="<?= Yii::app()->createUrl('module/index', array('idModule' => $model->id_module)); ?>">
                        <?= $model->idModule->getTitle(); ?></a>
                </h4>
                <h4>
                    Користувач: <a
                        href="<?= Yii::app()->createUrl('studentreg/profile', array('idUser' => $model->message0->sender)); ?>">
                        <?= $model->message0->sender0->userNameWithEmail(); ?></a>
                </h4>
                <br>
                <ul class="list-inline">
                    <li>
                        <button class="btn btn-outline btn-success" onclick="load('<?=Yii::app()->createUrl("/_teacher/_admin/request/approve",
                            array("message" => $model->id_message, "module" => $model->id_message, "user" => $user->id));?>'>">
                            Підтвердити</button>
                    </li>
                    <li>
                        <button class="btn btn-outline btn-default" onclick="load('<?=Yii::app()->createUrl("/_teacher/_admin/request/index");?>'
                            , 'Запити')">Ігнорувати</button>
                    </li>
                    <li>
                        <button class="btn btn-outline btn-danger" onclick="load('<?=Yii::app()->createUrl("/_teacher/_admin/request/cancel",
                            array("message" => $model->id_message, "module" => $model->id_message, "user" => $user->id));?>'>">
                            Видалити</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>