<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="paidCoursesTable" class="table table-striped table-bordered table-hover" id="agreementsTable">
                    <tr ng-repeat="row in $data">
                        <td data-title="'Назва'"><a href="javascript:void(0)" ng-click="showStudentAgreement(row.id,row.number)">Договір {{row.number}} </a></td>
                        <td data-title="'Сума, грн'">{{row.summa}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
