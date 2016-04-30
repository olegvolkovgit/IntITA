<?php
/**
 * @var $model IRequest
 * @var $user StudentReg
 * @var $module Module
 * @var $sender StudentReg
 * @var $teacher Teacher
 */
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
                <?php if($module){?>
                <h4>
                    Модуль: <a
                        href="<?= Yii::app()->createUrl('module/index', array('idModule' => $module->module_ID)); ?>" target="_blank">
                        <?= $module->getTitle(); ?></a>
                </h4>
                <?php }?>
                <?php if ($model->type() == Request::TEACHER_CONSULTANT_REQUEST) { ?>
                    <h4>
                        Викладач-консультант: <a
                            href="<?= Yii::app()->createUrl('studentreg/profile', array('idUser' => $model->idTeacher->id)); ?>" target="_blank">
                            <?= $model->idTeacher->userNameWithEmail(); ?></a>
                    </h4>
                <?php } ?>
                <h4>
                    Користувач: <a
                        href="<?= Yii::app()->createUrl('studentreg/profile', array('idUser' => $sender->id)); ?>" target="_blank">
                        <?= $sender->userNameWithEmail(); ?></a>
                </h4>
                 <?php if($model->message0->type == MessagesType::COWORKER_REQUEST){
                    $teacher = $model->teacher();?>
                    <h4>
                        Призначити співробітником: <a
                            href="<?= Yii::app()->createUrl('studentreg/profile', array('idUser' => $teacher->id)); ?>">
                            <?= $teacher->userNameWithEmail(); ?></a>
                    </h4>
                <?php }?>
                <br>
                <ul class="list-inline">
                    <li>
                        <button class="btn btn-outline btn-success"
                                <?php if($model->message0->type != MessagesType::COWORKER_REQUEST){?>
                                onclick="setRequestStatus('<?= Yii::app()->createUrl("/_teacher/_admin/request/approve",
                                    array("message" => $model->getMessageId(), "user" => $user->id)); ?>', 'Підтвердити запит?')"
                                <?php } else {?>
                                    onclick="approveCoworkerRequest('<?= Yii::app()->createUrl("/_teacher/_admin/teachers/create");?>',
                                        '<?=$model->getMessageId()?>', '<?=$model->id_teacher;?>')"
                            <?php }?>
                        >Підтвердити
                        </button>
                    </li>
                    <li>
                        <button class="btn btn-outline btn-default"
                                onclick="load('<?= Yii::app()->createUrl("/_teacher/_admin/request/index"); ?>'
                                    , 'Запити')">Ігнорувати
                        </button>
                    </li>
                    <li>
                        <button class="btn btn-outline btn-danger"
                                onclick="setRequestStatus('<?= Yii::app()->createUrl("/_teacher/_admin/request/cancel",
                                    array("message" => $model->getMessageId(), "user" => $user->id)); ?>', 'Відхилити запит?')">
                            Видалити
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>