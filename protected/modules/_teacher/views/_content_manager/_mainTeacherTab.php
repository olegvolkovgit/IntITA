<?php
/**
 * @var $user RegisteredUser
 * @var $model StudentReg
 */
$model = $user->registrationData;
$teacher = $user->getTeacher();
?>
<div class="row">
    <div class="col-md-3">
        <img src="<?php echo StaticFilesHelper::createPath('image', 'avatars', $model->avatar); ?>"
             class="img-thumbnail" style="height:200px">
    </div>
    <div class="col-md-9">
        <ul class="list-group">
            <li class="list-group-item">Ім'я:
                <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $user->id)) ?>">
                    <?php echo $model->userName(); ?></a></li>
            <li class="list-group-item">Електронна пошта: <?php echo $user->email; ?></li>
            <li class="list-group-item">Статус: <em><?php echo $user->getTeacher()->getStatus(); ?></em>
                <?php if (Yii::app()->user->model->isAdmin()) { ?>
                    <button type="button" class="btn btn-outline btn-primary btn-xs" ng-click="changeUserStatus('/_teacher/_admin/teachers/changeTeacherStatus','<?= $teacher->user_id ?>','<?= ($teacher->isShow()) ? "Приховати викладача?" : "Показати викладача?"; ?>')"
                    >
                        змінити
                    </button>
                <?php } ?>
            </li>
        </ul>
    </div>
</div>
