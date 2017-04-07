<div class="panel panel-default" ng-controller="trainerStudentsCtrl">
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table ng-table="trainersStudentsTableParams" class="table table-bordered table-striped table-condensed">
                <colgroup>
                    <col/>
                    <col/>
                    <col width="15%"/>
                    <col width="15%"/>
                    <col width="5%"/>
                </colgroup>
                <tr ng-repeat="row in $data track by $index">
                    <td style="word-wrap:break-word" data-title="'Студент'" filter="{'studentModel.fullName': 'text'}" sortable="'studentModel.fullName'">
                        <a ng-href="#/users/profile/{{row.student}}">{{row.studentModel.fullName}}</a>
                    </td>
                    <td data-title="'Призначено'" filter="{'start_time': 'text'}" sortable="'start_time'">{{row.start_time}}</td>
                    <td data-title="'Закріплені викладачі'">
                        <a type="button" class="btn btn-outline btn-success btn-sm" ng-href="#/trainer/viewStudent/{{row.student}}">
                            Курси/модулі
                        </a>
                    </td>
                    <td data-title="'Договори та рахунки'">
                        <a type="button" class="btn btn-outline btn-success btn-sm" ng-href="#/student/{{row.student}}/agreements">
                            Переглянути
                        </a>
                    </td>
                    <td data-title="''">
                        <a class="btnChat"  ng-href="#/newmessages/receiver/{{row.student}}"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                            <i class="fa fa-envelope fa-fw"></i>
                        </a>
                        <a class="btnChat" href="<?php echo Config::getChatPath(); ?>{{row.student}}" target="_blank" data-toggle="tooltip" data-placement="left" title="Чат">
                            <i class="fa fa-weixin fa-fw"></i>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>