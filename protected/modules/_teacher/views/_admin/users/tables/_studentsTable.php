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
                    <tr ng-repeat="row in $data track by row.id">
                        <td data-title="'ПІБ'" filter="{'fullName': 'text'}" sortable="'fullName'">
                            <a ng-href="#/admin/users/user/{{row.id}}">{{row.firstName}} {{row.middleName}} {{row.secondName}}</a>
                        </td>
                        <td data-title="'Email'" filter="{'email': 'text'}" sortable="'email'">
                            <a ng-href="#/admin/users/user/{{row.id}}">{{row.email}}</a>
                        </td>
                        <td data-title="'Зареєстровано'" filter="{'reg_time': 'text'}" sortable="'reg_time'">{{row.reg_time=='0000-00-00 00:00:00'  ? "невідомо" : row.reg_time}}</td>
                        <td data-title="'Форма'" filter="{'educform': 'text'}" sortable="'educform'">{{row.educform}}</td>
                        <td data-title="'Країна'" filter="{'country0.title_ua': 'text'}" sortable="'country0.title_ua'">{{row.country0.title_ua}}</td>
                        <td data-title="'Місто'" filter="{'city0.title_ua': 'text'}" sortable="'city0.title_ua'">{{row.city.title_ua}}</td>
<!--                        <td data-title="'Тренер'" filter="{'trainer.trainer': 'text'}" sortable="'trainer.trainer'">{{row.trainer.trainer}}</td>-->
<!--                        <td data-title="'Доступ'">-->
<!--                            <a type="button" class="btn btn-outline btn-{{row.addAccessLink.color}} btn-block" ng-href="#/admin/users/user/{{row.id}}">є проплати{{row.addAccessLink.text}}</a>-->
<!--                        </td>-->
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
