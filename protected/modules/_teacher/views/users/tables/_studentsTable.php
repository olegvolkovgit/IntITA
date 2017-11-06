<?php
$currentTime = date('Y-m-d H:i:s');
$last_24h = date('Y-m-d H:i:s', time()-60*60*24);
$startOfDay = date('Y-m-d H:i:s', strtotime(date('Y-m-d')));
?>
<div ng-controller="studentsTableCtrl" organization="<?php echo $organization ?>">
    <br>
    <button class="btn btn-primary"
            ng-click="updateStudentList('<?php echo $organization ?>')">
        Всі студенти
    </button>

    <button class="btn btn-primary"
            ng-click="updateStudentList('<?php echo $organization ?>','<?=$startOfDay?>', '<?=$currentTime?>')">
        За сьогодні
    </button>

    <button class="btn btn-primary"
            ng-click="updateStudentList('<?php echo $organization ?>','<?=$last_24h?>', '<?=$currentTime?>')">
        За добу
    </button>

    <button class="btn btn-primary"
            ng-click="updateStudentList('<?php echo $organization ?>',startDate+ ' 00:00:00', endDate+' 23:59:59')">
        За період:
    </button>

    <span> з </span><input type="text" class="form-inline" ng-model=startDate id="startDate"/>
    <span> по </span><input type="text" class="form-inline" ng-model=endDate id="endDate"/>
    <a title="Експорт" class="glyphicon glyphicon-floppy-disk btn btn-primary pull-right" style="margin: 5px;"
       href="/_teacher/users/export/type/students">
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
                    </colgroup>
                    <tr ng-repeat="row in $data track by $index">
                        <td style="word-wrap:break-word" data-title="'Студент'" sortable="'idUser.fullName'" filter="{'idUser.fullName': 'text'}" >
                            <a ng-href="#/users/profile/{{row.id_user}}">{{row.idUser.fullName}}</a>
                        </td>
                        <td data-title="'Надано роль'" filter="{'start_date': 'text'}" sortable="'start_date'">{{row.start_date}}</td>
                        <td data-title="'Форма'" filter="{'idUser.education_shift': 'select'}" filter-data="educationForms">
                            {{row.idUser.education_shift==1? "онлайн":"онлайн/оффлайн"}}
                        </td>
                        <td data-title="'Місто'" filter="{'city.title_ua': 'text'}" sortable="'city.title_ua'">{{row.city.title_ua}}</td>
                        <td style="word-wrap:break-word" data-title="'Тренер'" filter="{'trainer.fullName': 'text'}" sortable="'trainer.fullName'">
                            <a ng-href="#/users/profile/{{row.trainer.id}}">{{row.trainer.fullName}}</a>
                        </td>
                        <td style="word-wrap:break-word;" data-title="'Телефон'" sortable="'idUser.phone'" filter="{'idUser.phone': 'text'}">
                            {{row.idUser.phone}}
                        </td>
                        <?php if (Yii::app()->user->model->isSuperVisor() && $organization) { ?>
                        <td data-title="">
                            <a ng-href="#/supervisor/addOfflineStudent/{{row.id_user}}">Додати в підгрупу</a>
                        </td>
                        <?php } ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
