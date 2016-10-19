<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="companyRepresentativesTable" class="table table-striped table-bordered table-hover" width="100%" style="cursor:pointer">
                    <tr ng-repeat="row in $data">
                        <td data-title="'Повне ім\'я'">
                            <a ng-href="#/accountant/viewRepresentative/{{row.id}}">{{row.title.name}}</a>
                        </td>
                        <td data-title="'Посада'">
                            {{row.position}}
                        </td>
                        <td data-title="'Компанія'">{{row.companies}}</td>
                        <td data-title="'Номер'">{{row.order}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>