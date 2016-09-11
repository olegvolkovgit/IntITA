<div class="col-md-12">
    <div class="row">

        <ul class="list-inline">
            <li>
                <a type="button" class="btn btn-primary" ng-href="#/admin/teachers">Співробітники</a>
            </li>
            <li>
                <a type="button" class="btn btn-primary" ng-href="#/admin/teacher/addTeacherRole/{{data.user.id}}">Призначити роль</a>
            </li>
            <li>
                <a type="button" class="btn btn-primary" ng-href="#/admin/users/teacher/update/{{data.user.id}}">Редагувати</a>
            </li>
            <li>
                <a type="button" class="btn btn-primary" ng-href="#/admin/teacher/{{data.user.id}}/editRole/role/author">Додати модуль</a>
            </li>
            <?php if (Yii::app()->user->model->isAdmin()) { ?>
                <li>
                    <a type="button" class="btn btn-primary" ng-href="#/admin/users">Користувачі</a>
                </li>
            <?php } ?>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-3">
            <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacher->user_id)) ?>"
               target="_blank">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'avatars', $teacher->user->avatar); ?>"
                     class="img-thumbnail" style="height:200px">
            </a>
        </div>
        <div class="col-md-9">
            <ul class="list-group">
                <li class="list-group-item">Ім'я:
                    <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacher->user_id)) ?>"
                       target="_blank">
                        {{data.user.secondName}} {{data.user.firstName}} {{data.user.middleName}}
                    </a>
                </li>
                <li class="list-group-item">Ім'я російською:
                    {{data.teacher.last_name_ru}} {{data.teacher.first_name_ru}} {{data.teacher.middle_name_ru}}
                </li>
                <li class="list-group-item">Ім'я англійською:
                    {{data.teacher.last_name_en}} {{data.teacher.first_name_en}} {{data.teacher.middle_name_en}}
                </li>
                <li class="list-group-item">Електронна пошта:
                    <a ng-href="<?= Yii::app()->createUrl('/cabinet/#/newmessages/receiver/'); ?>{{data.user.id}}">
                        {{data.user.email}}
                        <i class="fa fa-envelope fa-fw"></i>
                </li>
                <li class="list-group-item">
                    Приватний чат:
                    <a href="<?= Config::getChatPath()?>{{data.user.id}}" target="_blank">почати чат <i class="fa fa-wechat fa-fw"></i></a>
                </li>
                <li class="list-group-item">Статус співробітника: <em>{{data.teacher.isPrint==1 ? "видимий" : "невидимий"}}</em>
                    <button type="button" class="btn btn-outline btn-primary btn-xs"
                            ng-click="changeUserStatus('<?= Yii::app()->createUrl("/_teacher/_admin/teachers/changeTeacherStatus"); ?>',
                                data.user.id,
                                data.teacher.isPrint==1?'Приховати викладача?':'Показати викладача?')";>
                        змінити
                    </button>
                </li>
                <li class="list-group-item">Акаунт: <em>{{data.user.status==1 ? "активований" : "не активований"}}</em>
                    <button type="button" class="btn btn-outline btn-primary btn-xs"
                            ng-click="changeUserStatus('<?= Yii::app()->createUrl("/_teacher/user/changeAccountStatus"); ?>',
                                data.user.id,
                                data.user.status==1?'Заблокувати акаунт користувача?':'Активувати акаунт користувача?')";>
                        змінити
                    </button>
                </li>
                <li class="list-group-item">Статус користувача: <em>{{data.user.cancelled==0 ? "активний" : "видалений"}}</em>
                    <button type="button" class="btn  btn-outline btn-primary btn-xs"
                            ng-click="changeUserStatus('<?= Yii::app()->createUrl("/_teacher/user/changeUserStatus"); ?>',
                                 data.user.id,
                                 data.user.cancelled==0?'Видалити користувача?':'Відновити користувача?');">
                        змінити
                    </button>
                </li>
                
                <li ng-if="data.user.roles.length" class="list-group-item">Ролі користувача:
                    <ul>
                        <li ng-repeat="role in data.user.roles track by $index">
                            {{role}}
                            <a ng-if="role!='student'" ng-href="#/admin/teacher/{{data.user.id}}/editRole/role/{{role}}">
                                <em>редагувати</em>
                            </a>
                            <a href=""
                               ng-click="cancelUserRole('<?= Yii::app()->createUrl("/_teacher/user/unsetUserRole"); ?>',
                               role,data.user.id);">
                                <em>скасувати</em>
                            </a>
                        </li>
                    </ul>
                </li>

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



