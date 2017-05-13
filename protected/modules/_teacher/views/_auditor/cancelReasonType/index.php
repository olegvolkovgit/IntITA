<div class="col-lg-12" ng-controller="cancelReasonTypeCtrl">
    <br>
    <a class="btn btn-primary" ng-href="#/auditor/createCancelreasontype" >Додати</a>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="cancelReasonTypeTableParams" class="table table-bordered table-striped table-condensed">
                    <colgroup>
                        <col width="10%"/>
                        <col/>
                        <col width="10%"/>
                    </colgroup>
                    <tr ng-repeat="row in $data track by $index">
                        <td data-title="'Id'" filter="{'id': 'text'}" sortable="'id'">
                            {{row.id}}
                        </td>
                        <td data-title="'Опис'" filter="{'description': 'text'}" sortable="'description'">
                            {{row.description}}
                        </td>
                        <td class="center">
                            <a title="Переглянути" ng-href="#/auditor/cancelReasonType/view/{{row.id}}">
                                <i class="fa  fa-eye fa-fw"></i>
                            </a>
                            <a title="Редагувати" ng-href="#/auditor/cancelReasonType/update/{{row.id}}">
                                <i class="fa fa-pencil fa-fw"></i>
                            </a>
                            <a title="Видалити" ng-href="" ng-click="deleteCancelReasonTypes(row.id)">
                                <i class="fa fa-trash-o fa-fw"></i>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>


