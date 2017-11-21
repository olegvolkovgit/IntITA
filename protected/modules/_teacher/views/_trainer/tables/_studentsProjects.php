<div ng-controller="studentsProjectsCtrl">
    <table ng-table="studentProjectTable" class="table table-bordered table-striped table-condensed">
        <colgroup>
            <col/>
            <col/>
            <col width="15%"/>
            <col width="15%"/>
        </colgroup>
        <tr ng-repeat="row in $data track by $index">
            <td style="word-wrap:break-word" data-title="'Студент'" filter="{'studentModel.fullName': 'text'}" sortable="'studentModel.fullName'">
                <a ng-href="#/users/profile/{{row.idStudent.id}}">{{row.idStudent.fullName}}</a>
            </td>
            <td data-title="'Проект'" filter="{'title': 'text'}" sortable="'start_time'">{{row.title}}</td>
            <td data-title="'Переглянути'">
                <button class="btn btn-outline btn-success btn-sm" ng-click="viewProject(row.id)">
                Переглянути останню версію
                </button>
            </td>
            <td data-title="'Затвердити'">
                <p ng-show="!row.need_check"> Затверджено </p>
                <button class="btn btn-outline btn-success btn-sm" ng-click="approveProject(row.id)" " ng-show="row.need_check">
                    Затвердити
                </button>
            </td>
        </tr>
    </table>
</div>