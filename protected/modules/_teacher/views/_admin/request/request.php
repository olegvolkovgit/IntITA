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
<div class="row" ng-controller="requestsCtrl">
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
                <?php if (!($model->isDeleted() || $model->isApproved() ||
                    (in_array($model->message0->type, array(MessagesType::REVISION_REQUEST,MessagesType::MODULE_REVISION_REQUEST)) && $model->isRejected()))) { ?>
                    <ul class="list-inline">
                        <li>


                            <button class="btn btn-outline btn-success"
                                <?php if ($model->message0->type != MessagesType::COWORKER_REQUEST) { ?>
                                    ng-bootbox-confirm="Підтвердити запит?" ng-bootbox-confirm-action="setRequestStatus('<?=$model->getMessageId()?>','<?=$user->id?>')" ng-bootbox-confirm-action-cancel="cancelMessage()"
                                <?php } else { ?>
                                    ng-bootbox-confirm="Підтвердити запит?" ng-bootbox-confirm-action="setCoworkerRequest('<?=$model->getMessageId()?>','<?=$user->id?>')" ng-bootbox-confirm-action-cancel="cancelMessage()"
                                <?php } ?>>
                                Підтвердити
                            </button>

                        </li>
                        <?php if(in_array($model->message0->type, array(MessagesType::REVISION_REQUEST,MessagesType::MODULE_REVISION_REQUEST)) && !$model->isRejected()) { ?>
                            <li>
                                <button class="btn btn-outline btn-danger" ng-bootbox-confirm-action="cancelRequest('<?=$model->getMessageId()?>','<?=$user->id?>')" ng-bootbox-confirm-action-cancel="cancelMessage()" ng-bootbox-confirm="<h3>Ти впевнений, що хочеш відхилити ревізію?</h3><br/><textarea ng-model='comment' class='form-control' style='resize: none' rows='6' id='rejectMessageText'
                                placeholder='тут можна залишити коментар при відхилені ревізії'></textarea>">
                                Відхилити
                                </button>
                            </li>
                        <?php } else {?>
                            <li>
                                <button class="btn btn-outline btn-danger" ng-bootbox-confirm-action="cancelRequest('<?=$model->getMessageId()?>','<?=$user->id?>')" ng-bootbox-confirm-action-cancel="cancelMessage()" ng-bootbox-confirm="Відхилити запит?">
                                    Відхилити
                                </button>
                            </li>
                        <?php } ?>
                        <li>
                            <button class="btn btn-outline btn-default" ng-click="changeView('requests')">
                                    Ігнорувати
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
                            <?php if($model->message0->type==MessagesType::REVISION_REQUEST) {?>
                                <h4>
                                    <?php $resolution=MessagesRejectRevision::model()->findByAttributes(array('id_revision'=>$model->id_revision));
                                    echo $resolution?'Резолюція: '.$resolution->comment:''?>
                                </h4>
                            <?php }else if($model->message0->type==MessagesType::MODULE_REVISION_REQUEST){ ?>
                                <h4>
                                    <?php $resolution=MessagesRejectModuleRevision::model()->findByAttributes(array('id_revision'=>$model->id_module_revision));
                                    echo $resolution?'Резолюція: '.$resolution->comment:''?>
                                </h4>
                            <?php } ?>
                            <?= $model->rejectedByToString() ?>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</div>