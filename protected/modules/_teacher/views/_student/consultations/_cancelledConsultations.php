<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="canceledConsultationsTable" class="table table-striped table-bordered table-hover" id="" style="table-layout: fixed">
                    <tr ng-repeat="row in $data">
                        <td data-title="'Викладач'" style="width: "><a href="javascript:void(0)" ng-click="changeView('students/viewConsultation/'+row.id)">{{row.teacher.firstName}} {{row.teacher.middleName}} {{row.teacher.secondName}}</a></td>
                        <td data-title="'Лекція'" ><div ng-if="row.lecture"><a href="javascript:void(0)" ng-click="changeView('students/viewConsultation/'+row.id)">{{row.lecture.title_ua}}</a></div><div ng-if="!row.lecture"><a href="javascript:void(0)" ng-click="changeView('students/viewConsultation/'+row.id)">Лекція видалена</a></div></td>
                        <td data-title="'Дата'">{{row.date_cons}}</td>
                        <td data-title="'Скасував'">{{row.userCancelled.firstName}} {{row.userCancelled.middleName}} {{row.userCancelled.secondName}}</td>
                        <td data-title="'Дата скасування'">{{row.date_cancelled}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
