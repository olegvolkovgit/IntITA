<?php
/**
 * @var $model RegisteredUser
 * @var $module Module
 * @var $user StudentReg
 * @var $role UserRoles
 * @var $trainer StudentReg
 */
$user = $model->registrationData;
?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php if (Yii::app()->user->model->isAdmin()) { ?>
            <ul class="list-inline">
                <li>
                    <a type="button" class="btn btn-primary" ng-href="#/admin/users">
                        Користувачі
                    </a>
                </li>
            </ul>
        <?php } ?>
    </div>

    <div class="row">
        <div class="col-md-3">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'avatars', $user->avatar); ?>"
                 class="img-thumbnail" style="height:200px">
        </div>
        <div class="col-md-9">
            <ul class="list-group">
                <li class="list-group-item">Ім'я, email:
                    <a href="<?php echo Yii::app()->createUrl('studentreg/profile', array('idUser' => $user->id)) ?>"
                       target="_blank">
                        <?php echo $user->userNameWithEmail() ?></a></li>
                <li class="list-group-item">Електронна пошта:
                    <a href="<?= Yii::app()->createUrl('/cabinet/#/newmessages/receiver/').$user->id; ?>" target="_blank">
                        <?php echo $user->email . " "; ?>
                        <i class="fa fa-envelope fa-fw"></i>
                    </a>
                    <div ng-if='data.user.skype'>
                        Skype: {{data.user.skype}}
                    </div>
                    <div ng-if='data.user.phone'>
                        Телефон: {{data.user.phone}}
                    </div>
                    <br>
                    Приватний чат:
                    <a href="<?= Config::getChatPath()?>{{data.user.id}}"
                       target="_blank">почати чат <i class="fa fa-wechat fa-fw"></i>
                    </a>
                </li>

                <?php if ($model->isStudent()) { ?>
                    <li class="list-group-item">Тренер:
                        <?php if ($trainer) { ?>
                            <div ng-if="data.trainer">
                                <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $trainer->id)) ?>" target="_blank">
                                    <?php echo $trainer->userNameWithEmail(); ?>
                                </a>
                                <?php if (Yii::app()->user->model->isAdmin()) { ?>
                                <a type="button" class="btn  btn-outline btn-primary btn-xs" ng-href="#/admin/users/user/{{data.user.id}}/changetrainer">
                                    змінити
                                </a>
                                <?php } ?>
                            </div>
                        <?php }?>
                        <div ng-if="!data.trainer">
                            <?php if (Yii::app()->user->model->isAdmin()) { ?>
                                <a type="button" class="btn  btn-outline btn-primary btn-xs" ng-href="#/admin/users/user/{{data.user.id}}/addtrainer">
                                    додати
                                </a>
                            <?php } ?>
                        </div>
                    </li>
                <?php } ?>

                <li class="list-group-item">Акаунт: <em>{{data.user.status==1 ? "активований" : "не активований"}}</em>
                    <?php if (Yii::app()->user->model->isAdmin()) { ?>
                        <button type="button" class="btn btn-outline btn-primary btn-xs"
                                ng-click="changeUserStatus('<?= Yii::app()->createUrl("/_teacher/user/changeAccountStatus"); ?>',
                                    data.user.id,
                                    data.user.status==1?'Заблокувати акаунт користувача?':'Активувати акаунт користувача?');">
                            змінити
                        </button>
                    <?php } ?>
                </li>
                <li class="list-group-item">Статус: <em>{{data.user.cancelled==0 ? "активний" : "видалений"}}</em>
                    <?php if (Yii::app()->user->model->isAdmin()) { ?>
                        <button type="button" class="btn  btn-outline btn-primary btn-xs"
                                ng-click="changeUserStatus('<?= Yii::app()->createUrl("/_teacher/user/changeUserStatus"); ?>',
                                    data.user.id,
                                    data.user.cancelled==0?'Видалити користувача?':'Відновити користувача?');">
                            змінити
                        </button>
                    <?php } ?>
                </li>
                <li class="list-group-item">Форма навчання: <em>{{data.user.educform}}</em></li>
                <li class="list-group-item">Адреса, вік: <em><?php echo $user->addressString(); ?></em></li>
            </ul>
        </div>
    </div>
</div>




