<a type="button" class="btn btn-primary" ng-href="#/configuration/create_task_type">
    Створити новий тип
</a>
<br>
<br>
<div class="panel panel-default" ng-controller="taskTypesTableCtrl">
    <div class="panel-body" >
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" style="table-layout: fixed">
                <tr>
                    <th>Назва українською</th>
                    <th>Назва російською</th>
                    <th>Назва англійською</th>
                    <th>П/н</th>
                </tr>
                <tr ng-repeat="row in taskTypes">
                    <td>
                        <a ng-href="#/configuration/task_types/update/{{row.id}}">{{row.title_ua}}</a>
                    </td>
                    <td>
                        <a ng-href="#/configuration/task_types/update/{{row.id}}">{{row.title_ru}}</a>
                    </td>
                    <td>
                        <a ng-href="#/configuration/task_types/update/{{row.id}}">{{row.title_en}}</a>
                    </td>
                    <td>
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon">{{row.order}}</span>
                                <input type="number" step="1" size="3" min="1" max="{{taskTypes.length}}" placeholder="новий порядок" ng-model="order" class="form-control" >
                                <span class="input-group-addon">
                                    <i class="fa fa-save" aria-hidden="true" title="Змінити" ng-click="changeTypeOrder(row.id, order)"></i>
                                </span>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>