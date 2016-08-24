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
                Додати спвіробітника
            </a>
        </li>
    </ul>
    <div class="col-lg-12" ng-controller="teachersTableCtrl">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="teachersAdminTable" datatable="ng" dt-options="dtOptions">
                        <thead>
                        <tr>
                            <th>ПІБ</th>
                            <th>Email</th>
                            <th>Статус</th>
                            <th>Змінити</th>
                            <th>Відправити листа</th>
                            <th>Додати</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="row in teachersList">
                            <td><a ng-href="#/admin/users/teacher/{{row.name.id}}">{{row.name.name}}</a></td>
                            <td><a ng-href="#/admin/users/teacher/{{row.name.id}}">{{row.email.title}}</a></td>
                            <td>{{row.status}}</td>
                            <td><a ng-click="setTeacherStatus(row.changeStatus.link, 'true')">{{row.changeStatus.title}}</a></td>
                            <td>
                                <a class="btnChat"  ng-href="{{row.mailto}}"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                                    <i class="fa fa-envelope fa-fw"></i>
                                </a>
                            </td>
                            <td><a type="button" class="btn btn-primary" ng-href="#/admin/teacher/addModule/{{row.name.id}}">модуль</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>