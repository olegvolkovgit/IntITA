<?php
$currentTime = date('Y-m-d H:i:s');
$last_24h = date('Y-m-d H:i:s', time()-60*60*24);
$startOfDay = date('Y-m-d H:i:s', strtotime(date('Y-m-d')));
?>
<div ng-controller="studentsTableCtrl" organization="<?php echo $organization ?>">
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
                        <col width="20%"/>
                        <col/>
                        <col/>
                        <col/>
                        <col/>
                        <col/>
                        <col/>
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
                        <td style="word-wrap:break-word;" data-title="'Телефон'" sortable="'phone'" filter="{'phone': 'text'}">
                            {{row.phone}}
                        </td>
                        <?php if (Yii::app()->user->model->isSuperVisor() && $organization) { ?>
                        <td data-title="">
                            <a ng-href="#/supervisor/addOfflineStudent/{{row.id}}">Додати в підгрупу</a>
                        </td>
                        <?php } ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
