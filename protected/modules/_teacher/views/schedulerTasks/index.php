<div class="col-lg-12" ng-controller="schedulerTasksCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" ng-table="schedulerTasksTable">
                    <colgroup>
                        <col width="10%"/>
                        <col width="20%"/>
                        <col width="20%"/>
                        <col width="20%"/>
                        <col width="20%"/>
                        <col width="10%"/>
                        <col width="10%"/>
                        <col width="10%"/>
                    </colgroup>
                    <tr ng-repeat="row in $data" ng-class="{ 'danger': row.error }">
                        <td data-title="'ID'">{{row.id}}</td>
                        <td data-title="'Назва'">{{row.name}}</td>
                        <td data-title="'Тип'"><span ng-if="row.type == 1">Розсилка електронних листів</span></td>
                        <td data-title="'Повтор завдання'"><span ng-if="row.repeat_type == 1">Однократно</span>
                            <span ng-if="row.repeat_type == 2">Раз на день</span>
                            <span ng-if="row.repeat_type == 3">Раз на тиждень</span>
                            <span ng-if="row.repeat_type == 4">Раз на місяць</span>
                            <span ng-if="row.repeat_type == 5">Раз на рік</span>
                        </td>
                        <td data-title="'Час початку'">{{row.start_time |shortDate:"dd-MM-yyyy HH:mm:ss"}}</td>
                        <td data-title="'Час закінчення'">{{row.end_time |shortDate:"dd-MM-yyyy HH:mm:ss"}}</td>
                        <td data-title="'Статус завдання'"><span ng-if="row.status == 1">Заплановано</span>
                            <span ng-if="row.status == 2">В процесі</span>
                            <span ng-if="row.status == 3">Завершено</span>
                            <span ng-if="row.status == 4">Помилка</span>
                        </td>
                        <td data-title="'Помилка'">{{row.error}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
