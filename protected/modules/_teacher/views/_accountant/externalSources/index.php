<div class="col-lg-12" ng-controller="externalSourcesTableCtrl">
    <br>
    <a class="btn btn-primary" ng-href="#/accountant/externalsource/create">Додати</a>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <table ng-table="externalSourcesParams" class="table table-bordered table-striped table-condensed">
                <tr ng-repeat="row in $data track by $index">
                    <td data-title="'Номер'" filter="{id: 'text'}" sortable="'id'">
                        {{row.id}}
                    </td>
                    <td data-title="'Назва'" filter="{name: 'text'}" sortable="'name'">
                        {{row.name}}
                    </td>
                    <td data-title="'Negative summa'" filter="{cash: 'text'}" sortable="'cash'">
                        {{row.cash}}
                    </td>
                    <td data-title="'Управління'">
                        <a ng-href="#/accountant/externalsource/view/{{row.id}}" title="Переглянути">
                            <i class="fa  fa-eye fa-fw"></i>
                        </a>
                        <a ng-href="#/accountant/externalsource/update/{{row.id}}" title="Редагувати">
                            <i class="fa fa-pencil fa-fw"></i>
                        </a>
                        <a href="" title="Видалити" ng-click="deleteExternalSources(row.id);">
                            <i class="fa fa-trash-o fa-fw"></i>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

