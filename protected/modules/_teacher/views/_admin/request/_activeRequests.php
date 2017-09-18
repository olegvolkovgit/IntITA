<div class="panel panel-default" >
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table ng-table="activeRequestsTable" class="table table-striped table-bordered table-hover" id="activeRequestsTable">
                <tr ng-repeat="row in $data">
                    <td data-title="'Користувач'">{{row.user}}</td>
                    <td data-title="'Модуль'" >{{row.module}}</td>
                    <td data-title="'Тип'" >{{row.type}}</td>
                    <td data-title="'Дата'" >{{row.date}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>