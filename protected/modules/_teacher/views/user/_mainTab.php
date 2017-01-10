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
<div class="panel panel-default" ng-cloak>
    <div class="row">
        <div class="col-md-3">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'avatars', $user->avatar); ?>"
                 class="img-thumbnail" style="height:200px">
        </div>
        <div class="col-md-9">
            <ul class="list-group">
                <?php if (Yii::app()->user->model->isAdmin()) { ?>
                    <li class="list-group-item" ng-if="data.teacher">
                        <a ng-href="#/admin/teacher/update/{{data.user.id}}">
                            Редагувати як співробітника
                        </a>
                    </li>
                <?php } ?>
                <li class="list-group-item">Ім'я, email:
                    <a href="<?php echo Yii::app()->createUrl('studentreg/profile', array('idUser' => $user->id)) ?>" target="_blank">
                        <?php echo $user->userNameWithEmail() ?>
                    </a>
                </li>
                <li class="list-group-item" ng-if="data.teacher">Ім'я російською:
                    {{data.teacher.last_name_ru}} {{data.teacher.first_name_ru}} {{data.teacher.middle_name_ru}}
                </li>
                <li class="list-group-item" ng-if="data.teacher">Ім'я англійською:
                    {{data.teacher.last_name_en}} {{data.teacher.first_name_en}} {{data.teacher.middle_name_en}}
                </li>
                <li class="list-group-item">Електронна пошта:
                    <a ng-href="#/newmessages/receiver/{{data.user.id}}" target="_blank">
                        {{data.user.email}}
                        <i class="fa fa-envelope fa-fw"></i>
                    </a>
                    <div ng-if='data.teacher'>
                        Електронна пошта(корпоративна): {{data.teacher.corporate_mail}}
                        <?php if (Yii::app()->user->model->isAdmin()) { ?>
                            <button type="button" class="btn btn-outline btn-primary btn-xs"
                                    ng-click="addCorpAddress()" ng-show="!data.teacher.corporate_mail">
                                Додати корпоративну адресу
                            </button>
                        <?php } ?>
                    </div>
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
                <li ng-if="data.offlineStudent" class="list-group-item">
                    Офлайн навчання:
                    <ul class="list-group">
                        <li class="list-group-item groupList" ng-repeat="subgroup in data.offlineStudent track by $index">
                            <label>Спеціалізація:</label> {{subgroup.specialization}}<br>
                            <label>Група</label>: {{subgroup.groupName}}<br>
                            <label>Підгрупа:</label> {{subgroup.subgroupName}}<br>
                            <label>Дата старту:</label> {{subgroup.startDate}}<br>
                            <label>Дата виключення:</label> {{subgroup.endDate}}<br>
                            <label>Дата випуску:</label> {{subgroup.graduateDate}}<br>
                            <?php if (Yii::app()->user->model->isSuperVisor()) { ?>
                            <a ng-if="!subgroup.endDate" ng-href="#/supervisor/updateOfflineStudent/{{subgroup.idOfflineStudent}}">
                                Редагувати студента в підгрупі
                            </a>
                            <?php }?>
                        </li>
                    </ul>
                </li>
                <?php if (Yii::app()->user->model->isSuperVisor() && $model->isStudent()) { ?>
                <li ng-if="data.offlineStudent" class="list-group-item">
                    <a ng-href="#/supervisor/addOfflineStudent/{{data.user.id}}">
                        Додати студента в підгрупу
                    </a>
                </li>
                <?php }?>
                <?php if ($model->isStudent()) { ?>
                    <li class="list-group-item">Тренер:
                        <span>
                            <a ng-if="data.trainer" ng-href="/teacher/{{data.trainer.id}}" target="_blank">
                                {{data.trainer.firstName}} {{data.trainer.secondName}}({{data.trainer.email}})
                            </a>
                            <?php if (Yii::app()->user->model->isAdmin() || Yii::app()->user->model->isSuperVisor()) { ?>
                            <a type="button" class="btn  btn-outline btn-primary btn-xs" ng-href="#/admin/users/user/{{data.user.id}}/addtrainer">
                                <span ng-if="data.trainer">змінити</span>
                                <span ng-if="!data.trainer">додати</span>
                            </a>
                            <?php } ?>
                        </span>
                    </li>
                <?php } ?>
                <li class="list-group-item" ng-if="data.teacher">Статус співробітника(видимий/не видимий): <em>{{data.teacher.isPrint==1 ? "видимий" : "невидимий"}}</em>
                    <?php if (Yii::app()->user->model->isAdmin()) { ?>
                    <button type="button" class="btn btn-outline btn-primary btn-xs"
                            ng-click="changeUserStatus('<?= Yii::app()->createUrl("/_teacher/_admin/teachers/changeTeacherStatus"); ?>',
                                data.user.id,
                                data.teacher.isPrint==1?'Приховати викладача?':'Показати викладача?')";>
                        змінити
                    </button>
                    <?php } ?>
                </li>
                <li class="list-group-item">Акаунт(активований/не активований): <em>{{data.user.status==1 ? "активований" : "не активований"}}</em>
                    <?php if (Yii::app()->user->model->isAdmin()) { ?>
                        <button type="button" class="btn btn-outline btn-primary btn-xs"
                                ng-click="changeUserStatus('<?= Yii::app()->createUrl("/_teacher/user/changeAccountStatus"); ?>',
                                    data.user.id,
                                    data.user.status==1?'Заблокувати акаунт користувача?':'Активувати акаунт користувача?');">
                            змінити
                        </button>
                    <?php } ?>
                </li>
                <li class="list-group-item">Статус(активний/заблокований): <em>{{data.user.cancelled==0 ? "активний" : "заблокований"}}</em>
                    <?php if (Yii::app()->user->model->isAdmin()) { ?>
                        <button type="button" class="btn  btn-outline btn-primary btn-xs"
                                ng-click="changeUserStatus('<?= Yii::app()->createUrl("/_teacher/user/changeUserStatus"); ?>',
                                    data.user.id,
                                    data.user.cancelled==0?'Заблокувати користувача?':'Відновити користувача?');">
                            змінити
                        </button>
                    <?php } ?>
                </li>
                <li class="list-group-item" ng-if="data.user.educform">
                    Форма навчання: <em>{{data.user.educform}}</em>
                    <?php if (Yii::app()->user->model->isAdmin() || Yii::app()->user->model->isSuperVisor()) { ?>
                        <button type="button" class="btn btn-outline btn-primary btn-xs"
                                ng-click="changeStudentEducForm(data.user.id,data.user.educform);">
                            {{data.user.educform=='Онлайн' ? "змінити на 'Онлайн/Офлайн'" : "змінити на 'Онлайн'"}}
                        </button>
                    <?php } ?>
                </li>
                <li class="list-group-item">Адреса, вік: <em><?php echo $user->addressString(); ?></em></li>
                <?php if (Yii::app()->user->model->isContentManager()) { ?>
                    <li class="list-group-item" ng-repeat="role in data.user.roles track by $index" ng-if="role=='author' || role=='teacher_consultant'">
                        <a ng-href="#/content_manager/user/{{data.user.id}}/role/{{role}}">
                            Призначити модуль, як {{role=='author' ? "автору" : "викладачу"}}
                        </a>
                    </li>
                <?php } ?>
                <li ng-if="data.teacher.modules.length" class="list-group-item"> Автор модулів:<br>
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




