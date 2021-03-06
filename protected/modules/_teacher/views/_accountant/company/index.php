<div class="row">
    <div class="col-xs-12">
        <em>Для успішного укладання договору організація повинна мати хоч одну актуальну компанію та її рахунок</em>
        <ul class="list-inline">
            <li>
                <a ui-sref="^.add" class="btn btn-primary">Додати компанію</a>
            </li>
        </ul>
        <table ng-table="companiesTable" class="table table-striped table-bordered table-hover" width="100%"
               style="cursor:pointer">
            <tr ng-repeat="row in $data">
                <td data-title="'Назва компанії'" filter="{'title' : 'text'}" sortable="'title'">
                    <a ui-sref="^.view({companyId:row.id})">{{row.title}}</a><br>
                </td>
                <td data-title="'ЄДРПОУ'" filter="{'EDPNOU' : 'text'}" sortable="'EDPNOU'">
                    <a ui-sref="^.view({companyId:row.id})">{{row.EDPNOU}}</a><br>
                </td>
                <td data-title="'Юридична адреса'" filter="{'legal_address' : 'text'}"
                    sortable="'legal_address'">{{row.legal_address}}
                </td>
                <td data-title="'Фактична адреса'" filter="{'actual_address' : 'text'}"
                    sortable="'actual_address '">{{row.actual_address}}
                </td>
                <td data-title="'Організація'" filter="{'organization.name' : 'text'}" sortable="'organization.name'">
                    {{row.organization.name}}
                </td>
            </tr>
        </table>
    </div>
</div>