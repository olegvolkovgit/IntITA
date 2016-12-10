<div class="ng-scope ng-isolate-scope alert alert-dismissible alert-success">
    *Викладач - співробітник, за яким закріплені деякі студенти і деякі модулі. Студента до викладача закріплює його тренер.
    При умові, коли студент має доступ до модуля і за студентом закріплений викладач, за яким закріплений цей самий модуль -
    викладач може перевіряти і оцінювати 'прості задачі', на які дав відповідь студент, а такоєж з ним можна назначати консультації.
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <ul id="accessTabs" class="nav nav-tabs">
            <li class="active"><a href="#all" data-toggle="tab">Викладачі</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="all">
                <div class="col-lg-12">
                    <br>
                    <ul class="list-inline">
                        <li>
                            <a class="btn btn-primary" ng-href="#/content_manager/teacherConsultantAttributes">
                                Призначити модуль викладачу
                            </a>
                        </li>
                    </ul>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="panel panel-default" ng-controller="teacherConsultantsTableCtrl">
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <table ng-table="teacherConsultantsTableParams" class="table table-bordered table-striped table-condensed">
                                            <tr ng-repeat="row in $data track by $index">
                                                <td data-title="'ПІБ'" filter="{'idUser.fullName': 'text'}" sortable="'idUser.fullName'">
                                                    <a ng-href="#/admin/users/user/{{row.id_user}}">{{row.idUser.firstName}} {{row.idUser.middleName}} {{row.idUser.secondName}}</a>
                                                </td>
                                                <td data-title="'Email'" sortable="'idUser.email'" filter="{'idUser.email': 'text'}">
                                                    <a ng-href="#/admin/users/user/{{row.id_user}}">{{row.idUser.email}}</a>
                                                </td>
                                                <td data-title="'Призначено'" filter="{'start_date': 'text'}" sortable="'start_date'">{{row.start_date}}</td>
                                                <td data-title="'Профіль'"><a ng-href="/profile/{{row.id_user}}" target="_blank">Профіль</a></td>
                                                <td data-title="'Відправити листа'">
                                                    <a class="btnChat"  ng-href="#/newmessages/receiver/{{row.id_user}}"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                                                        <i class="fa fa-envelope fa-fw"></i>
                                                    </a>
                                                </td>
                                                <td data-title="'Додати'">
                                                    <a class="btn btn-primary" ng-href="#/content_manager/user/{{row.id_user}}/role/teacher_consultant">модуль</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>