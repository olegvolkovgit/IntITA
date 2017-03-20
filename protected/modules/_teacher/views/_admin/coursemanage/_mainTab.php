<?php
/**
 * @var $model Course
 */
?>
<div class="row">
    <div class="col-md-2">
        <a href="<?= Yii::app()->createUrl('course/index', array('id' => $model->course_ID)); ?>" target="_blank">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'course', $model->course_img); ?>"
                 class="img-thumbnail" style="height:150px">
        </a>
    </div>
    <div class="col-md-10">
        <table class="table table-hover">
            <tbody>
            <tr>
                <td width="30%">Мова:</td>
                <td><?= $model->language; ?></td>
            </tr>
            <tr>
                <td>Псевдонім: </td>
                <td><?=CHtml::encode($model->alias);?></td>
            </tr>
            <tr>
                <td>Номер:</td>
                <td><?= $model->course_number; ?></td>
            </tr>
            <tr>
                <td>Рівень:</td>
                <td><?= $model->level(); ?></td>
            </tr>
            <tr>
                <td>Онлайн-статус:</td>
                <td><?= $model->onlineStatusLabel(); ?></td>
            </tr>
            <tr>
                <td>Офлайн-статус:</td>
                <td><?= $model->offlineStatusLabel(); ?></td>
            </tr>
            <tr>
                <td>Видалений:</td>
                <td><?= $model->cancelledLabel(); ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>