<?php
date_default_timezone_set(Config::getServerTimezone());
$currentTime = date('Y-m-d H:i:s');
$last_24h = date('Y-m-d H:i:s', time()-60*60*24);
$startOfDay = date('Y-m-d H:i:s', strtotime(date('Y-m-d')));
?>
<div class="col-lg-12">
    <br>
    <button class="btn btn-primary"
            ng-click="updateStudentList()">
        Всі студенти
    </button>

    <button class="btn btn-primary"
            ng-click="updateStudentList('<?=$startOfDay?>', '<?=$currentTime?>')">
        За сьогодні
    </button>

    <button class="btn btn-primary"
            ng-click="updateStudentList('<?=$last_24h?>', '<?=$currentTime?>')">
        За добу
    </button>

    <button class="btn btn-primary"
            ng-click="updateStudentList(startDate+ ' 00:00:00', endDate+' 23:59:59')">
        За період:
    </button>

    <span> з </span><input type="text" class="form-inline" ng-model=startDate id="startDate"/>
    <span> по </span><input type="text" class="form-inline" ng-model=endDate id="endDate"/>

    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="studentsTable" datatable="ng" dt-options="dtOptions">
                    <thead>
                    <tr>
                        <th>ПІБ</th>
                        <th>Email</th>
                        <th>Зареєстровано</th>
                        <th>Форма</th>
                        <th>Країна</th>
                        <th>Місто</th>
                        <th>Тренер</th>
                        <th>Доступ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="row in studentsList">
                        <td><a ng-href="#/admin/users/teacher/{{row.name.id}}">{{row.name.name}}</a></td>
                        <td><a ng-href="#/admin/users/teacher/{{row.name.id}}">{{row.email.title}}</a></td>
                        <td>{{row.date}}</a> </td>
                        <td>{{row.educForm}}</td>
                        <td>{{row.country}}</td>
                        <td>{{row.city}}</td>
                        <td>{{row.trainer}}</td>
                        <td><button type="button" class="btn btn-outline btn-{{row.addAccessLink.color}} btn-block" >{{row.addAccessLink.text}}</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
