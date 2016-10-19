<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="representativesTable" class="table table-striped table-bordered table-hover" width="100%" style="cursor:pointer">
                    <tr ng-repeat="row in $data">
                        <td data-title="'Повне ім\'я'">
                            <a ng-href="#/accountant/viewRepresentative/{{row.id}}">{{row.full_name}}</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>