<div class="panel panel-default">
    <div class="panel-body">
            <ul class="list-inline">
                <li>
                    <a type="button" class="btn btn-primary" href="#/supervisor/users">Зареєстровані користувачі</a>
                </li>
                <li>
                    <a type="button" class="btn btn-primary" href="#/supervisor/students">Усі студенти</a>
                </li>
                <li>
                    <a type="button" class="btn btn-primary" href="#/supervisor/studentsWithoutGroup">Усі студенти(офлайн ф.н.)</a>
                </li>
                <li>
                    <a type="button" class="btn btn-primary" href="#/supervisor/offlineStudents">Студенти в підгрупах</a>
                </li>
            </ul>
    </div>
    <div class="row">
        <div class="col-md-3">
            <img src="{{user.avatar}}"
                 class="img-thumbnail" style="height:200px">
        </div>
        <div class="col-md-9">
            <ul class="list-group">
                <li class="list-group-item">Ім'я, email:
                    <a href="{{user.profileLink}}" target="_blank">
                        {{user.fullName}}
                    </a>
                </li>
                <li class="list-group-item">Електронна пошта:
                    <a href="/cabinet/#/newmessages/receiver/{{user.id}}" target="_blank">
                        {{user.email}}
                        <i class="fa fa-envelope fa-fw"></i>
                    </a>
                    <div ng-if='user.skype'>
                        Skype: {{user.skype}}
                    </div>
                    <div ng-if='user.phone'>
                        Телефон: {{user.phone}}
                    </div>
                    <br>
                    Приватний чат:
                    <a href="<?= Config::getChatPath()?>{{user.id}}" target="_blank">почати чат <i class="fa fa-wechat fa-fw"></i>
                    </a>
                </li>
                <li ng-if="offlineStudent" class="list-group-item">
                    Офлайн навчання:
                    <ul class="list-group">
                        <li class="list-group-item groupList" ng-repeat="subgroup in offlineStudent track by $index">
                            <label>Група</label>: {{subgroup.groupName}}<br>
                            <label>Спеціалізація:</label> {{subgroup.specialization}}<br>
                            <label>Підгрупа:</label> {{subgroup.subgroupName}}<br>
                            <label>Дата старту:</label> {{subgroup.startDate}}<br>
                            <label>Дата виключення:</label> {{subgroup.endDate}}<br>
                            <label>Дата випуску:</label> {{subgroup.graduateDate}}<br>
                            <a ng-href="#/supervisor/editOfflineStudent/{{subgroup.idOfflineStudent}}">
                                Редагувати студента в підгрупі
                            </a>
                        </li>
                    </ul>
                </li>
                <li ng-if="user.student" class="list-group-item">
                    <a ng-href="#/supervisor/addStudentToSubgroup/{{user.id}}">
                        Додати студента в підгрупу
                    </a>
                </li>
                <li class="list-group-item" ng-if="user.student">Тренер:
                    <div ng-if="user.trainer">
                        <a ng-href="/teacher/{{user.trainer.id}}" target="_blank">
                            {{user.trainer.firstName}} {{user.trainer.secondName}}({{user.trainer.email}})
                        </a>
                        <a type="button" class="btn  btn-outline btn-primary btn-xs" ng-href="#/supervisor/student/{{user.id}}/changetrainer">
                            змінити
                        </a>
                    </div>
                    <a ng-if="!user.trainer" type="button" class="btn  btn-outline btn-primary btn-xs" ng-href="#/supervisor/student/{{user.id}}/addtrainer">
                        додати
                    </a>
                </li>
                <li class="list-group-item">Акаунт: <em>{{user.status==1 ? "активований" : "не активований"}}</em>
                </li>
                <li class="list-group-item">Статус: <em>{{user.cancelled==0 ? "активний" : "видалений"}}</em>
                </li>
                <li class="list-group-item">Форма навчання: <em>{{user.educform}}</em></li>
                <li class="list-group-item" ng-if="user.addressAge">Адреса, вік: <em>{{user.addressAge}}</em></li>
            </ul>
        </div>
    </div>
</div>