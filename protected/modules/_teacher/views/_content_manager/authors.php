<div class="ng-scope ng-isolate-scope alert alert-dismissible alert-success">
    *Автор - співробітник, який може створювати та редагувати ревізії занятть в модулі
    та ревізії самого модуля, який призначений йому, як автору.
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <ul id="accessTabs" class="nav nav-tabs">
            <li class="active"><a href="#all" data-toggle="tab">Автори модулів</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="all">
                <div class="col-lg-12" ng-controller="authorsTableCtrl">
                    <br>
                    <ul class="list-inline">
                        <li>
                            <a class="btn btn-primary" ng-href="#/content_manager/authorAttributes">
                                Призначити модуль автору контента
                            </a>
                        </li>
                    </ul>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table ng-table="authorsTableParams" class="table table-bordered table-striped table-condensed">
                                <tr ng-repeat="row in $data track by $index">
                                    <td data-title="'ПІБ'" filter="{'user.fullName': 'text'}" sortable="'user.fullName'">
                                        <a ng-href="#/users/profile/{{row.id_user}}">{{row.user.firstName}} {{row.user.middleName}} {{row.user.secondName}}</a>
                                    </td>
                                    <td data-title="'Email'" sortable="'user.email'" filter="{'user.email': 'text'}">
                                        <a ng-href="#/users/profile/{{row.id_user}}">{{row.user.email}}</a>
                                    </td>
                                    <td data-title="'Призначено'" filter="{'start_date': 'text'}" sortable="'start_date'">{{row.start_date}}</td>
                                    <td data-title="'Профіль'"><a ng-href="/profile/{{row.id_user}}" target="_blank">Профіль</a></td>
                                    <td data-title="'Відправити листа'">
                                        <a class="btnChat"  ng-href="#/newmessages/receiver/{{row.id_user}}"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                                            <i class="fa fa-envelope fa-fw"></i>
                                        </a>
                                    </td>
                                    <td data-title="'Додати'">
                                        <a class="btn btn-primary" ng-href="#/content_manager/user/{{row.id_user}}/role/author">модуль</a>
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