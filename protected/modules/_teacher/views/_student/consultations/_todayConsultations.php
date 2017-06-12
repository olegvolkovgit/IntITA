<div class="panel panel-default">
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table ng-table="todayConsultationsTable" class="table table-striped table-bordered table-hover" >
                <tr ng-repeat="row in $data">
                    <td data-title="'Викладач'" style="width: "><a href="javascript:void(0)" ng-click="changeView('student/viewConsultation/'+row.id)">{{row.teacher.firstName}} {{row.teacher.middleName}} {{row.teacher.secondName}}</a></td>
                    <td data-title="'Лекція'" ><div ng-if="row.lecture"><a href="javascript:void(0)" ng-click="changeView('student/viewConsultation/'+row.id)">{{row.lecture.title_ua}}</a></div><div ng-if="!row.lecture"><a href="javascript:void(0)" ng-click="changeView('student/viewConsultation/'+row.id)">Лекція видалена</a></div></td>
                    <td data-title="'Дата'">{{row.date_cons}}</td>
                    <td data-title="'Початок'">{{row.start_cons}}</td>
                    <td data-title="'Закінчення'" >{{row.end_cons}}</td>
                    <td data-title="'Почати'"><span ng-if="row.status != 'start'">{{row.status}}</span><span ng-if="row.status === 'start'"><a class="btn btn-success btn-sm" href="/crmChat/#/consultation_view/{{row.id}}"  target="_blank">Почати</a></span></td>
                </tr>
            </table>
        </div>
    </div>
</div>
