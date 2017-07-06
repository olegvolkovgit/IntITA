<?php
/**
 * @var $model Graduate
 */
?>
<div class="row">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-2">
                <a href="<?= Yii::app()->createUrl('graduates/index'); ?>" target="_blank">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'graduates', $model->user->avatar); ?>"
                         class="img-thumbnail" style="height:150px">
                </a>
            </div>
            <div class="col-md-10">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <td width="30%"><strong>Дата випуску</strong></td>
                        <td><?= $model->graduate_date; ?></td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Посада</strong></td>
                        <td>
                            <?= $model->position; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Місце роботи</strong></td>
                        <td>
                            <?= $model->work_place; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Сайт (місце роботи)</strong></td>
                        <td>
                            <a href="<?=$model->work_site; ?>" target="_blank">
                                <?= $model->work_site; ?>
                            </a>
                        </td>
                    </tr>
                    <?php if(!empty($model->courses)) { ?>
                        <tr>
                            <td width="30%"><strong>Закінчив(ла) курс</strong></td>
                            <td>
                                <ul>
                                    <?php foreach ($model->courses as $course) {?>
                                        <li>
                                            <a href="<?php echo Yii::app()->createUrl('course/index', array('id' => $course->id_course)); ?>"
                                               target="_blank"> <?php echo $course->idCourse->getTitle(); ?></a>
                                            <div class="rat" style="padding-top: 5px;">
                                                <?php echo Yii::t('graduates', '0319')?>
                                                <?php echo CommonHelper::getRating(((double)$course->rating*Config::getRatingScale())); ?>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if(!empty($model->modules)) { ?>
                    <tr>
                        <td width="30%"><strong>Закінчив(ла) модуль</strong></td>
                        <td>
                            <ul>
                                <?php foreach ($model->modules as $module) {?>
                                    <li>
                                        <a href="<?php echo Yii::app()->createUrl('course/index', array('id' => $module->id_module)); ?>"
                                           target="_blank"> <?php echo $module->idModule->getTitle(); ?></a>
                                        <div class="rat" style="padding-top: 5px;">
                                            <?php echo Yii::t('graduates', '0319')?>
                                            <?php echo CommonHelper::getRating(((double)$module->rating*Config::getRatingScale())); ?>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td width="30%"><strong>Відгук</strong></td>
                        <td>
                            <p class="recall"><?= $model->recall; ?></p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>