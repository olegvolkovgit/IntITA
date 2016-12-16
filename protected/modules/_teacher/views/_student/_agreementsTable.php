<div class="panel panel-default">
    <div class="panel-body">
        <table ng-table="agreementsTable" class="table table-striped table-bordered table-hover">
            <tr ng-repeat="row in $data">
                <td data-title="'Назва'"><a ng-href="#/students/agreement/{{row.id}}">Договір {{row.number}} </a></td>
                <td data-title="'Опис'">{{row.service.description}}</td>
                <td data-title="'Схема оплати'">{{row.paymentSchema.name}}</td>
                <td data-title="'Дата заведення'">{{(row.create_date | shortDate:"dd-MM-yyyy")}}</td>
                <td data-title="'Загальна сума, грн'">{{row.summa}}</td>
<!--                <td data-title="'Сплачено, грн'">{{row.summa}}</td>-->
                <td data-title="'Рахунки'"><a ng-href="#/students/agreement/{{row.id}}">рахунки</a> </td>
            </tr>
        </table>
    </div>
</div>
