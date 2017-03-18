<?php
$currentTime = date('Y-m-d H:i:s');
$last_24h = date('Y-m-d H:i:s', time()-60*60*24);
$startOfDay = date('Y-m-d H:i:s', strtotime(date('Y-m-d')));
?>
<div class="col-lg-12" ng-controller="studentsTableCtrl">
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
    <a title="Експорт" class="glyphicon glyphicon-floppy-disk btn btn-primary pull-right" style="margin: 5px;"
       href="/_teacher/_admin/users/export/type/students">
    </a>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="studentsTableParams" class="table table-bordered table-striped table-condensed">
                    <colgroup>
                        <col/>
                        <col width="10%"/>
                        <col width="10%"/>
                        <col width="10%"/>
                        <col width="10%"/>
                        <col/>
                        <col width="10%"/>
                    </colgroup>
                    <tr ng-repeat="row in $data track by $index">
                        <td style="word-wrap:break-word" data-title="'Користувач'" sortable="'fullName'" filter="{'fullName': 'text'}" >
                            <a ng-href="#/users/profile/{{row.id}}">{{row.fullName}}</a>
                        </td>
                        <td data-title="'Надано роль'" filter="{'student.start_date': 'text'}" sortable="'student.start_date'">{{row.student.start_date}}</td>
                        <td data-title="'Форма'" filter="{educform: 'select'}" filter-data="educationForms">
                            {{row.educform==1? "онлайн":"онлайн/оффлайн"}}
                        </td>
                        <td data-title="'Країна'" filter="{'country0.title_ua': 'text'}" sortable="'country0.title_ua'">{{row.country0.title_ua}}</td>
                        <td data-title="'Місто'" filter="{'city0.title_ua': 'text'}" sortable="'city0.title_ua'">{{row.city0.title_ua}}</td>
                        <td style="word-wrap:break-word" data-title="'Тренер'" filter="{'trainerData.fullName': 'text'}" sortable="'trainerData.fullName'">
                            <a ng-href="#/users/profile/{{row.trainerData.id}}">{{row.trainerData.fullName}}</a>
                        </td>
                        <td data-title="'Доступ до контента (по договору)'" >
                            <a type="button"
                               ng-class="{'btn btn-outline btn-success btn-block': row.serviceAccess.length,
                               'btn btn-outline btn-danger btn-block': !row.serviceAccess.length }" ng-href="#/admin/users/user/{{row.id}}">
                                {{row.serviceAccess.length? "є доступ":"немає доступу"}}
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
