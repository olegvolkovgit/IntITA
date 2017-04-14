<?php
/**
 * @var $model RegisteredUser
 * @var $user StudentReg
 */
$user = $model->registrationData;
?>
<div class="panel panel-default" ng-cloak ng-init="organization='<?php echo Yii::app()->user->model->getCurrentOrganizationId(); ?>'">
    <div class="row">
        <div class="col-md-3">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'avatars', $user->avatar); ?>"
                 class="img-thumbnail" style="height:200px">
        </div>
        <div class="col-md-9">
            <ul class="list-group">
                <li class="list-group-item">Ім'я, email:
                    <a href="<?php echo Yii::app()->createUrl('studentreg/profile', array('idUser' => $user->id)) ?>" target="_blank">
                        <?php echo $user->userNameWithEmail() ?>
                    </a>
                </li>
                <li class="list-group-item" ng-if="user.teacher">Ім'я російською:
                    {{user.teacher.last_name_ru}} {{user.teacher.first_name_ru}} {{user.teacher.middle_name_ru}}
                </li>
                <li class="list-group-item" ng-if="user.teacher">Ім'я англійською:
                    {{user.teacher.last_name_en}} {{user.teacher.first_name_en}} {{user.teacher.middle_name_en}}
                </li>
                <li class="list-group-item">Електронна пошта:
                    <a ng-href="#/newmessages/receiver/{{user.id}}" target="_blank">
                        {{user.email}}
                        <i class="fa fa-envelope fa-fw"></i>
                    </a>
                    <div ng-if='user.teacher'>
                        Електронна пошта (корпоративна): {{user.teacher.corporate_mail}}
                        <?php if (Yii::app()->user->model->isAdmin()) { ?>
                            <button type="button" class="btn btn-outline btn-primary btn-xs"
                                    ng-click="addCorpAddress()" ng-show="!user.teacher.corporate_mail">
                                Додати корпоративну адресу
                            </button>
                            <button class="btn btn-outline btn-primary btn-xs" ng-show="!user.teacher.corporate_mail"
                                    ng-bootbox-title="Адреса корпоративної пошти без домену"
                                    ng-bootbox-custom-dialog
                                    ng-bootbox-custom-dialog-template="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/templates/addMailAddress.html'); ?>">
                                Додати корпоративну адресу
                            </button>
                        <?php } ?>
                    </div>
                    <div ng-if='user.skype'>
                        Skype: {{user.skype}}
                    </div>
                    <div ng-if='user.phone'>
                        Телефон: {{user.phone}}
                    </div>
                    <br>
                    Приватний чат:
                    <a href="<?= Config::getChatPath()?>{{user.id}}"
                       target="_blank">почати чат <i class="fa fa-wechat fa-fw"></i>
                    </a>
                </li>
                <li ng-if="user.offlineStudents" class="list-group-item">
                    Офлайн навчання:
                    <ul class="list-group" >
                        <li class="list-group-item groupList" ng-repeat="subgroup in user.offlineStudents track by $index">
                            <label>Спеціалізація:</label> {{subgroup.subgroupName.groupName.specializationName.title_ua}}<br>
                            <label>Група</label>: {{subgroup.subgroupName.groupName.name}}<br>
                            <label>Підгрупа:</label> {{subgroup.subgroupName.name}}<br>
                            <label>Організація:</label> {{subgroup.subgroupName.organization.name}}<br>
                            <label>Дата старту:</label> {{subgroup.start_date}}<br>
                            <label>Дата виключення:</label> {{subgroup.end_date}}<br>
                            <label>Дата випуску:</label> {{subgroup.graduate_date}}<br>
                            <?php if (Yii::app()->user->model->isSuperVisor()) { ?>
                            <a ng-if="!subgroup.end_date && organization==subgroup.subgroupName.organization.id"
                               ng-href="#/supervisor/updateOfflineStudent/{{subgroup.id}}">
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
                <li ng-if="user.student" class="list-group-item">
                    Тренер:
                    <ul>
                        <li ng-repeat="std in user.student track by $index">
                            {{std.organization.name}}:
                            <a ng-if="std.studentTrainer.trainer" ng-href="/teacher/{{std.studentTrainer.trainer}}" target="_blank">
                                {{std.studentTrainer.trainerModel.firstName}}
                                {{std.studentTrainer.trainerModel.secondName}}
                                ({{std.studentTrainer.trainerModel.email}})
                            </a>
                            <?php if (Yii::app()->user->model->isSuperVisor()) { ?>
                                <a ng-if="organization==std.id_organization"
                                   type="button" class="btn  btn-outline btn-primary btn-xs" ng-href="#/users/profile/{{user.id}}/addtrainer">
                                    <span ng-if="std.studentTrainer.trainer">змінити</span>
                                    <span ng-if="!std.studentTrainer.trainer">додати</span>
                                </a>
                            <?php } ?>
                        </li>
                    </ul>
                </li>
                <li class="list-group-item">Акаунт (активований/не активований): <em>{{user.status==1 ? "активований" : "не активований"}}</em>
                    <?php if (Yii::app()->user->model->isSuperAdmin()) { ?>
                        <button type="button" class="btn btn-outline btn-primary btn-xs"
                                ng-click="changeUserStatus('<?= Yii::app()->createUrl("/_teacher/user/changeAccountStatus"); ?>',
                                user.id, user.status==1?'Деактивувати акаунт користувача?':'Активувати акаунт користувача?');">
                            змінити
                        </button>
                    <?php } ?>
                </li>
                <li class="list-group-item">Статус (активний/заблокований): <em>{{user.cancelled==0 ? "активний" : "заблокований"}}</em>
                    <?php if (Yii::app()->user->model->isSuperAdmin()) { ?>
                        <button type="button" class="btn  btn-outline btn-primary btn-xs"
                                ng-click="changeUserStatus('<?= Yii::app()->createUrl("/_teacher/user/changeUserStatus"); ?>',
                                user.id, user.cancelled==0?'Заблокувати користувача?':'Відновити користувача?');">
                            змінити
                        </button>
                    <?php } ?>
                </li>
                <li class="list-group-item" ng-if="user.educform">
                    Форма навчання: <em>{{user.educform==1? "онлайн":"онлайн/оффлайн"}}</em>
                </li>
                <li class="list-group-item" ng-if="user.educform==3">
                    Навчальна зміна:
                    <em ng-if="user.education_shift==1">ранкова</em>
                    <em ng-if="user.education_shift==2">вечірня</em>
                    <em ng-if="user.education_shift==3">байдуже</em>
                </li>
                <li class="list-group-item" ng-if="user.startCareers.length">Як би хотів розпочати кар'єру в ІТ:
                    <span style="background-color:#ddd;border: 1px solid #ccc;margin: 0 2px" ng-repeat="career in user.startCareers track by $index">
                        {{career.career.title_ua}}
                    </span>
                </li>
                <li class="list-group-item" ng-if="user.preferSpecializations.length">Спеціалізації яким надає перевагу:
                    <span style="background-color:#ddd;border: 1px solid #ccc;margin: 0 2px" ng-repeat="specialization in user.preferSpecializations track by $index">
                        {{specialization.specialization.title_ua}}
                    </span>
                </li>
                <li class="list-group-item">Адреса, вік: <em><?php echo $user->addressString(); ?></em></li>
                <li class="list-group-item" ng-if="user.prev_job">Попередня зайнятість: <em>{{user.prev_job}}</em></li>
                <li class="list-group-item" ng-if="user.current_job">Теперішня зайнятість: <em>{{user.current_job}}</em></li>
                <?php if (Yii::app()->user->model->isAccountant()) { ?>
                    <li class="list-group-item" ng-if="user.passport">Номер паспорта: <em>{{user.passport}}</em></li>
                    <li class="list-group-item" ng-if="user.document_issued_date">Дата видачі паспорта: <em>{{user.document_issued_date}}</em></li>
                    <li class="list-group-item" ng-if="user.passport_issued">Ким виданий паспорт: <em>{{user.passport_issued}}</em></li>
<!--                    <li class="list-group-item" ng-if="documents.passport.length">-->
<!--                        Копія паспорта:-->
<!--                        <ul>-->
<!--                            <li ng-repeat="item in data.documents.passport track by $index">-->
<!--                                <a ng-href="--><?php //echo StaticFilesHelper::fullPathToFiles('documents') ?><!--/{{item.id_user}}/{{item.type}}/{{item.file_name}}" target="_blank">-->
<!--                                    {{item.file_name}}-->
<!--                                </a>-->
<!--                                <span style="background-color:lightgreen;padding:2px" ng-if="item.check==1">перевірено</span>-->
<!--                                <span ng-if="item.check==0">не перевірено</span>-->
<!--                                <button type="button" class="btn btn-outline btn-primary btn-xs" ng-click="changeDocStatus(item.id);">-->
<!--                                    змінити статус-->
<!--                                </button>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
                    <li class="list-group-item" ng-if="user.inn">Ідентифікаційний код: <em>{{user.inn}}</em></li>
<!--                    <li class="list-group-item" ng-if="data.documents.inn.length">-->
<!--                        Копія ідентифікаційного кода:-->
<!--                        <ul>-->
<!--                            <li ng-repeat="item in data.documents.inn track by $index">-->
<!--                                <a ng-href="--><?php //echo StaticFilesHelper::fullPathToFiles('documents') ?><!--/{{item.id_user}}/{{item.type}}/{{item.file_name}}" target="_blank">-->
<!--                                    {{item.file_name}}-->
<!--                                </a>-->
<!--                                <span style="background-color:lightgreen;padding:2px" ng-if="item.check==1">перевірено</span>-->
<!--                                <span ng-if="item.check==0">не перевірено</span>-->
<!--                                <button type="button" class="btn btn-outline btn-primary btn-xs" ng-click="changeDocStatus(item.id);">-->
<!--                                    змінити статус-->
<!--                                </button>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
                <?php } ?>
            </ul>
        </div>
    </div>
</div>




