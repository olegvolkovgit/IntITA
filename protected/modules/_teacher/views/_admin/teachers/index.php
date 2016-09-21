<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 22.12.2015
 * Time: 17:07
 */
?>
<div class="col-md-12">
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/admin/teacher/create">
                Додати співробітника
            </a>
        </li>
    </ul>
    <div class="col-lg-12" ng-controller="teachersTableCtrl">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table ng-table="teachersTableParams" class="table table-bordered table-striped table-condensed">
                        <tr ng-repeat="row in $data track by row.user_id">
                            <td data-title="'ПІБ'" filter="{'user.fullName': 'text'}" sortable="'user.fullName'">
                                <a ng-href="#/admin/users/teacher/{{row.user.id}}">{{row.user.firstName}} {{row.user.middleName}} {{row.user.secondName}}</a>
                            </td>
                            <td data-title="'Email'" filter="{'user.email': 'text'}" sortable="'user.email'">
                                <a ng-href="#/admin/users/teacher/{{row.user.id}}">{{row.user.email}}</a>
                            </td>
                            <td data-title="'Статус'" sortable="'isPrint'">{{row.isPrint==1  ? "видимий" : "невидимий"}}</td>
                            <td data-title="'Змінити статус'" sortable="'isPrint'">
                                <a ng-click="setTeacherStatus(row.isPrint, row.user.id)">{{row.isPrint==1  ? "приховати" : "показати"}}</a>
                            </td>
                            <td data-title="'Відправити листа'">
                                <a class="btnChat"  ng-href="#/newmessages/receiver/{{row.user.id}}"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                                    <i class="fa fa-envelope fa-fw"></i>
                                </a>
                            </td>
                            <td data-title="'Додати'"><a type="button" class="btn btn-primary" ng-href="#/admin/teacher/{{row.user.id}}/editRole/role/author">модуль</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>