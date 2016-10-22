<div class="panel panel-default">
    <div class="panel-body">
            <ul class="list-inline">
                <li>
                    <a type="button" class="btn btn-primary" ng-href="#/supervisor/offlineStudents">
                        Оффлайн студенти
                    </a>
                </li>
            </ul>
    </div>
    <div class="row">
        <div class="col-md-3">
            <img src="{{student.avatar}}"
                 class="img-thumbnail" style="height:200px">
        </div>
        <div class="col-md-9">
            <ul class="list-group">
                <li class="list-group-item">Ім'я, email:
                    <a href="{{student.profileLink}}" target="_blank">
                        {{student.fullName}}
                    </a>
                </li>
                <li class="list-group-item">Електронна пошта:
                    <a href="/cabinet/#/newmessages/receiver/{{student.id}}" target="_blank">
                        {{student.email}}
                        <i class="fa fa-envelope fa-fw"></i>
                    </a>
                    <div ng-if='student.skype'>
                        Skype: {{student.skype}}
                    </div>
                    <div ng-if='student.phone'>
                        Телефон: {{student.phone}}
                    </div>
                    <br>
                    Приватний чат:
                    <a href="<?= Config::getChatPath()?>{{student.id}}" target="_blank">почати чат <i class="fa fa-wechat fa-fw"></i>
                    </a>
                </li>
                <li class="list-group-item">Тренер:
                    <div ng-if="student.trainer">
                        <a ng-href="/teacher/{{student.trainer.id}}" target="_blank">
                            {{student.trainer.firstName}} {{student.trainer.secondName}}({{student.trainer.email}})
                        </a>
                        <a type="button" class="btn  btn-outline btn-primary btn-xs" ng-href="#/supervisor/student/{{student.id}}/changetrainer">
                            змінити
                        </a>
                    </div>
                    <div ng-if="!student.trainer">
                        <a type="button" class="btn  btn-outline btn-primary btn-xs" ng-href="#/supervisor/student/{{student.id}}/addtrainer">
                            додати
                        </a>
                    </div>
                </li>
                <li class="list-group-item">Акаунт: <em>{{student.status==1 ? "активований" : "не активований"}}</em>
                </li>
                <li class="list-group-item">Статус: <em>{{student.cancelled==0 ? "активний" : "видалений"}}</em>
                </li>
                <li class="list-group-item">Форма навчання: <em>{{student.educform}}</em></li>
                <li class="list-group-item" ng-if="student.addressAge">Адреса, вік: <em>{{student.addressAge}}</em></li>
            </ul>
        </div>
    </div>
</div>