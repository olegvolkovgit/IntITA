<div class="panel panel-default">
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table ng-table="pastConsultationsTable" class="table table-striped table-bordered table-hover" id="" style="table-layout: fixed">
                <tr ng-repeat="row in $data">
                    <td data-title="'Викладач'" style="width: "><a href="javascript:void(0)" ng-click="changeView('student/viewConsultation/'+row.id)">{{row.teacher.firstName}} {{row.teacher.middleName}} {{row.teacher.secondName}}</a></td>
                    <td data-title="'Лекція'" ><div ng-if="row.lecture"><a href="javascript:void(0)" ng-click="changeView('student/viewConsultation/'+row.id)">{{row.lecture.title_ua}}</a></div><div ng-if="!row.lecture"><a href="javascript:void(0)" ng-click="changeView('student/viewConsultation/'+row.id)">Лекція видалена</a></div></td>
                    <td data-title="'Дата'">{{row.date_cons}}</td>
                    <td data-title="'Початок'">{{row.start_cons}}</td>
                    <td data-title="'Закінчення'" >{{row.end_cons}}</td>
                </tr>
            </table>

        </div>
    </div>
</div>
