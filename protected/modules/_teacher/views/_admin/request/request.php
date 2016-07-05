<?php
/**
 * @var $model IRequest
 * @var $user StudentReg
 * @var $module Module
 * @var $sender StudentReg
 * @var $teacher Teacher
 */
date_default_timezone_set(Config::getServerTimezone());
$user = Yii::app()->user->model;
$module = $model->module();
$sender = $model->sender();
?>
<div class="row">
    <div class="col col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><?= $model->title(); ?></h4>
            </div>
            <div class="panel-body">
                <h4>Статус: <em><?php echo $model->statusToString(); ?></em></h4>
                <h4>Дата запиту: <?php echo date("d.m.Y H:i", strtotime($model->message()->create_date));?></h4>
                <?php if ($module) { ?>
                    <h4>
                        Модуль: <a
                            href="<?= Yii::app()->createUrl('module/index', array('idModule' => $module->module_ID)); ?>"
                            target="_blank">
                            <?= $module->getTitle(); ?></a>
                    </h4>
                <?php } ?>
                <?php $this->renderPartial('_requestDetails', array('model'=> $model));?>
                <h4>
                    Надіслав користувач: <a
                        href="<?= Yii::app()->createUrl('studentreg/profile', array('idUser' => $sender->id)); ?>"
                        target="_blank">
                        <?= $sender->userNameWithEmail(); ?></a>
                </h4>
                <br>
                <?php if (!($model->isDeleted() || $model->isApproved())) { ?>
                    <ul class="list-inline">
                        <li>
                            <button class="btn btn-outline btn-success"
                                <?php if ($model->message0->type != MessagesType::COWORKER_REQUEST) { ?>
                                    onclick="setRequestStatus('<?= Yii::app()->createUrl("/_teacher/_admin/request/approve",
                                        array("message" => $model->getMessageId(), "user" => $user->id)); ?>', 'Підтвердити запит?')"
                                <?php } else { ?>
                                    onclick="approveCoworkerRequest('<?= Yii::app()->createUrl("/_teacher/_admin/teachers/create"); ?>',
                                        '<?= $model->getMessageId() ?>', '<?= $model->id_teacher; ?>')"
                                <?php } ?>>
                                Підтвердити
                            </button>
                        </li>
                        <?php if(in_array($model->message0->type, array(MessagesType::REVISION_REQUEST,MessagesType::MODULE_REVISION_REQUEST)) && !$model->isRejected()) { ?>
                        <li>
                            <button class="btn btn-outline btn-danger"
                                    onclick="setRequestStatus('<?= Yii::app()->createUrl("/_teacher/_admin/request/reject",
                                        array("message" => $model->getMessageId(), "user" => $user->id)); ?>', 'Відхилити ревізію?')">
                                Відхилити
                            </button>
                        </li>
                        <?php } ?>
                        <li>
                            <button class="btn btn-outline btn-default"
                                    onclick="load('<?= Yii::app()->createUrl("/_teacher/_admin/request/index"); ?>'
                                        , 'Запити')">Ігнорувати
                            </button>
                        </li>
                        <li>
                            <button class="btn btn-outline btn-danger"
                                    onclick="setRequestStatus('<?= Yii::app()->createUrl("/_teacher/_admin/request/cancel",
                                        array("message" => $model->getMessageId(), "user" => $user->id)); ?>', 'Видалити запит?')">
                                Видалити
                            </button>
                        </li>
                    </ul>
                <?php } else {
                    if ($model->isApproved()) { ?>
                        <div class="alert alert-info">
                            <?= $model->approvedByToString() ?>
                        </div>
                    <?php } else if((in_array($model->message0->type, array(MessagesType::REVISION_REQUEST,MessagesType::MODULE_REVISION_REQUEST)) && $model->isRejected())){ ?>
                        <div class="alert alert-info">
                            <?= $model->rejectedByToString() ?>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</div>