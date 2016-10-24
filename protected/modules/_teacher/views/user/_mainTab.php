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
                <li ng-if="data.teacher">
                    <a type="button" class="btn btn-primary" ng-href="#/admin/users/teacher/update/{{data.user.id}}">Редагувати</a>
                </li>
                <li ng-if="data.teacher">
                    <a type="button" class="btn btn-primary" ng-href="#/admin/teacher/{{data.user.id}}/editRole/role/author">Додати модуль</a>
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
                <li class="list-group-item" ng-if="data.teacher">Ім'я російською:
                    {{data.teacher.last_name_ru}} {{data.teacher.first_name_ru}} {{data.teacher.middle_name_ru}}
                </li>
                <li class="list-group-item" ng-if="data.teacher">Ім'я англійською:
                    {{data.teacher.last_name_en}} {{data.teacher.first_name_en}} {{data.teacher.middle_name_en}}
                </li>
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
                        <div ng-if="data.trainer">
                            <a ng-href="/teacher/{{data.trainer.id}}" target="_blank">
                                {{data.trainer.firstName}} {{data.trainer.secondName}}({{data.trainer.firstName}})
                            </a>
                            <?php if (Yii::app()->user->model->isAdmin()) { ?>
                            <a type="button" class="btn  btn-outline btn-primary btn-xs" ng-href="#/admin/users/user/{{data.user.id}}/changetrainer">
                                змінити
                            </a>
                            <?php } ?>
                        </div>
                        <div ng-if="!data.trainer">
                            <?php if (Yii::app()->user->model->isAdmin()) { ?>
                                <a type="button" class="btn  btn-outline btn-primary btn-xs" ng-href="#/admin/users/user/{{data.user.id}}/addtrainer">
                                    додати
                                </a>
                            <?php } ?>
                        </div>
                    </li>
                <?php } ?>
                <li class="list-group-item" ng-if="data.teacher">Статус співробітника: <em>{{data.teacher.isPrint==1 ? "видимий" : "невидимий"}}</em>
                    <button type="button" class="btn btn-outline btn-primary btn-xs"
                            ng-click="changeUserStatus('<?= Yii::app()->createUrl("/_teacher/_admin/teachers/changeTeacherStatus"); ?>',
                                data.user.id,
                                data.teacher.isPrint==1?'Приховати викладача?':'Показати викладача?')";>
                        змінити
                    </button>
                </li>
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
                <li class="list-group-item">Статус: <em>{{data.user.cancelled==0 ? "активний" : "заблокований"}}</em>
                    <?php if (Yii::app()->user->model->isAdmin()) { ?>
                        <button type="button" class="btn  btn-outline btn-primary btn-xs"
                                ng-click="changeUserStatus('<?= Yii::app()->createUrl("/_teacher/user/changeUserStatus"); ?>',
                                    data.user.id,
                                    data.user.cancelled==0?'Видалити користувача?':'Відновити користувача?');">
                            змінити
                        </button>
                    <?php } ?>
                </li>
                <li class="list-group-item" ng-if="data.user.educform">Форма навчання: <em>{{data.user.educform}}</em></li>
                <li class="list-group-item">Адреса, вік: <em><?php echo $user->addressString(); ?></em></li>

                <li ng-if="data.teacher.modules.length" class="list-group-item"> Веде модулі:<br>
                    <ul>
                        <li ng-if="module.cancelled==0" ng-repeat="module in data.teacher.modules track by $index">
                            <a href="" ng-click="moduleLink(module.module_ID)">
                                {{module.title_ua}} ({{module.language}})
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>




