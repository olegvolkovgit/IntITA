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
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'graduates', $model->avatar); ?>"
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
                    <tr>
                        <td width="30%"><strong>Закінчив(ла) курс</strong></td>
                        <td>
                            <a href="<?= Yii::app()->createUrl('course/index', array('id' => $model->courses_page)); ?>"
                            target="_blank">
                                <?= $model->course->getTitle(); ?>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Рейтинг</strong></td>
                        <td>
                            <?= $model->rate; ?>
                        </td>
                    </tr>
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