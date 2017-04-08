<div class="col-lg-12" ng-controller="schedulerTasksCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" ng-table="schedulerTasksTable">
                    <colgroup>
                        <col width="5%"/>
                        <col width="8%"/>
                        <col width="15%"/>
                        <col width="10%"/>
                        <col width="15%"/>
                        <col width="15%"/>
                        <col width="10%"/>
                        <col width="10%"/>
                        <col width="10%"/>
                        <col width="10%"/>
                    </colgroup>
                    <tr ng-repeat="row in $data" ng-class="{ 'danger': row.error }">
                        <td data-title="'ID'">{{row.id}}</td>
                        <td data-title="'Тема'" filter="{ type: 'text'}" filter-data="subjectFilter">{{row.newsletter.subject}}</span></td>
                        <td data-title="'Повтор завдання'" filter="{ repeat_type: 'select'}" filter-data="repeatFilter"><span ng-if="row.repeat_type == 1">Однократно</span>
                            <span ng-if="row.repeat_type == 2">Раз на день</span>
                            <span ng-if="row.repeat_type == 3">Раз на тиждень</span>
                            <span ng-if="row.repeat_type == 4">Раз на місяць</span>
                            <span ng-if="row.repeat_type == 5">Раз на рік</span>
                        </td>
                        <td data-title="'Час початку'" sortable="'start_time'">{{row.start_time |shortDate:"dd-MM-yyyy HH:mm:ss"}}</td>
                        <td data-title="'Час закінчення'" sortable="'end_time'">{{row.end_time |shortDate:"dd-MM-yyyy HH:mm:ss"}}</td>
                        <td data-title="'Статус завдання'" filter="{ status: 'select'}" filter-data="statusesFilter"><span ng-if="row.status == 1">Заплановано</span>
                            <span ng-if="row.status == 2">В процесі</span>
                            <span ng-if="row.status == 3">Завершено</span>
                            <span ng-if="row.status == 4">Помилка</span>
                            <span ng-if="row.status == 5">Редагується</span>
                            <span ng-if="row.status == 6">Скасовано</span>
                        </td>
                        <td data-title="'Помилка'">{{row.error}}</td>
                        <td data-title="'Створено'">{{row.user.fullName}}</td>
                        <td data-title="'Дії'"><span><button class="btn btn-success" ng-click="viewTask(row.id)" title="Подивитись"><i class="glyphicon glyphicon-eye-open"></i></button>
								<span><button ng-show="row.status == 1"class="btn btn-info" ng-click="editTask(row.id)"  title="Редагувати"><i class="glyphicon glyphicon-pencil"></i></button>
								<span><button ng-show="row.status == 1" class="btn btn-warning" ng-click="cancelTask(row.id)"  title="Відмінити"><i class="glyphicon glyphicon-remove"></i></button>
								<span><button class="btn btn-danger" ng-click="deleteTask(row.id)"  title="Видалити"><i class="glyphicon glyphicon-trash"></i></button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
