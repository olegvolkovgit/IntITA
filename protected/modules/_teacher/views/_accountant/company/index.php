<div class="row">
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/accountant/addcompany">Додати компанію</a>
        </li>
    </ul>

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table ng-table="companiesTable" class="table table-striped table-bordered table-hover" width="100%" style="cursor:pointer">
                        <tr ng-repeat="row in $data">
                            <td data-title="'Назва'"  filter="{'title' : 'text'}" sortable="'title'">
                                <a ng-href="#/accountant/viewCompany/{{row.id}}">{{row.title}}</a>
                            </td>
                            <td data-title="'ЄДРПОУ'" filter="{'EDPNOU' : 'text'}" sortable="'EDPNOU'">
                                <a ng-href="#/accountant/viewCompany/{{row.id}}">{{row.EDPNOU}}</a>
                            </td>
                            <td data-title="'Юридична адреса'" filter="{'legal_address' : 'text'}" sortable="'legal_address'">{{row.legal_address}}</td>
                            <td data-title="'Фактична адреса'" filter="{'actual_address' : 'text'}" sortable="'actual_address '">{{row.actual_address}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>