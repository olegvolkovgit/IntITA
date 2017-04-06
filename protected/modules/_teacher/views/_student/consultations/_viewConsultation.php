<?php
/**
 * @var $model Consultationscalendar
 */
?>
<div class="row" ng-controller="studentCtrl">
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary" ng-click="changeView('student/consultations')">Всі консультації
            </button>
        </li>
        <?php if ($model->isAvailable() && !$model->isCancelled()) { ?>
            <li>
                <a class="btn btn-success" role="button"
                   href="<?= Config::getBaseUrl() . '/crmChat/#/consultation_view/' . $model->id ?>" target="_blank">
                    Почати консультацію
                </a>
            </li>
        <?php }?>
        <?php if ($model->isCanBeCancelled() && !$model->isCancelled()) { ?>
        <li>
            <button type="button" class="btn btn-outline btn-warning" ng-click="cancelConsultation('<?=$model->id?>')">Скасувати консультацію
            </button>
        </li>
        <?php } ?>
    </ul>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-10">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <td width="30%">Викладач:</td>
                        <td>
                            <a href="<?= Yii::app()->createUrl('profile/index', array('idTeacher' => $model->teacher_id)); ?>"
                               target="_blank">
                                <?= $model->teacher->userNameWithEmail(); ?>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Модуль:</td>
                        <td>
                            <?php if($model->lecture){?>
                            <a href="<?= Yii::app()->createUrl('module/index', array('idModule' => $model->lecture->idModule)); ?>"
                               target="_blank">
                                <?= $model->lecture->module->getTitle(); ?>
                            </a>
                            <?php } else {
                                echo "Лекція видалена.";
                            }?>
                        </td>
                    </tr>
                    <tr>
                        <td>Лекція:</td>
                        <td>
                            <?php if($model->lecture){?>
                            <a href="<?= Yii::app()->createUrl('lesson/index', array('id' => $model->lecture_id, 'idCourse' => 0)); ?>"
                               target="_blank">
                                <?= $model->lecture->title(); ?>
                            </a>
                            <?php } else {
                                echo "Лекція видалена.";
                            }?>
                        </td>
                    </tr>
                    <tr>
                        <td>Дата консультації:</td>
                        <td><?= date("d.m.Y", strtotime($model->date_cons)); ?></td>
                    </tr>
                    <tr>
                        <td>Початок:</td>
                        <td><?= $model->start_cons; ?></td>
                    </tr>
                    <tr>
                        <td>Закінчення:</td>
                        <td><?= $model->end_cons; ?></td>
                    </tr>
                    <?php if($model->isCancelled()){?>
                        <tr>
                            <td>Скасував(ла):</td>
                            <td><?= $model->userCancelled->userNameWithEmail(); ?></td>
                        </tr>
                        <tr>
                            <td>Дата скасування:</td>
                            <td><?= $model->date_cancelled; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>