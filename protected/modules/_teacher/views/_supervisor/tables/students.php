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
                <table ng-table="studentsTableParams" class="table table-bordered table-striped table-condensed">
                    <tr ng-repeat="row in $data track by $index">
                        <td data-title="'ПІБ'" filter="{'fullName': 'text'}" sortable="'fullName'">
                            <a ng-href="#/supervisor/userProfile/{{row.id}}">{{row.firstName}} {{row.middleName}} {{row.secondName}}</a>
                        </td>
                        <td data-title="'Email'" filter="{'email': 'text'}" sortable="'email'">
                            <a ng-href="#/supervisor/userProfile/{{row.id}}">{{row.email}}</a>
                        </td>
                        <td data-title="'Надано роль'" filter="{'student.start_date': 'text'}" sortable="'student.start_date'">{{row.student.start_date}}</td>
                        <td style="text-align: center" data-title="'Форма'" filter="{'educform': 'text'}" sortable="'educform'">
                            {{row.educform}}
                            <button type="button" class="btn btn-outline btn-primary btn-xs"
                                    ng-click="changeStudentEducForm(row.id,row.educform);">
                                змінити
                            </button>
                        </td>
                        <td data-title="'Країна'" filter="{'country0.title_ua': 'text'}" sortable="'country0.title_ua'">{{row.country0.title_ua}}</td>
                        <td data-title="'Місто'" filter="{'city0.title_ua': 'text'}" sortable="'city0.title_ua'">{{row.city0.title_ua}}</td>
                        <td data-title="'Тренер'" filter="{'trainerData.fullName': 'text'}" sortable="'trainerData.fullName'">
                            <a ng-href="#/supervisor/userProfile/{{row.trainerData.id}}">{{row.trainerData.fullName}} {{row.trainerData.email}}</a>
                        </td>
                        <td style="word-wrap:break-word;" data-title="'Телефон'" sortable="'phone'" filter="{'phone': 'text'}">
                            {{row.phone}}
                        </td>
                        <td data-title="">
                            <a ng-href="#/supervisor/addOfflineStudent/{{row.id}}">Додати в підгрупу</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
