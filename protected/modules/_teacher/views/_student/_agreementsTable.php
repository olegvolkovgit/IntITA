<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="agreementsTable" class="table table-striped table-bordered table-hover" id="agreementsTable">
                    <tr ng-repeat="row in $data">
                        <td data-title="'Назва'"><a href="javascript:void(0)" ng-click="showStudentAgreement(row.id,row.number)">Договір {{row.number}} </a></td>
                        <td data-title="'Опис'">{{row.service.description}}</td>
                        <td data-title="'Схема оплати'">{{row.paymentSchema.name}}</td>
                        <td data-title="'Дата'">{{(row.create_date | cmdate:"dd-MM-yyyy")}}</td>
                        <td data-title="'Сума, грн'">{{row.summa}}</td>
                        <td data-title="'Рахунки'"><a href="javascript:void(0)" ng-click="showStudentAgreement(row.id,row.number)">рахунки</a> </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
</div>
