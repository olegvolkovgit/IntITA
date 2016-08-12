<div class="col-md-12">
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary" ng-click="changeView('graduate/create')">
                Додати випускника
            </button>
        </li>
    </ul>
    <div class="col-lg-12" ng-controller="graduateCtrl">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table ng-table="tableParams" class="table table-striped table-bordered table-hover" id="graduatesTable" style="table-layout: fixed">
                        <tr ng-repeat="row in $data" role="row">
                             <td data-title="'Прізвище, ім\'я'"  style="height: 25px; overflow: hidden;text-overflow: ellipsis;"><a href="#/graduate/view/{{row.id}}"> {{row.first_name}} {{row.last_name}} </a></td>
                             <td data-title="'Фото'" style="height: 25px; overflow: hidden;text-overflow: ellipsis;"><img src="/images/graduates/{{row.avatar}}"></td>
                             <td data-title="'Посада'" style="height: 25px; overflow: hidden;text-overflow: ellipsis;">{{row.position}}</td>
                             <td data-title="'Місце роботи'" style="height: 25px; overflow: hidden;text-overflow: ellipsis;">{{row.work_place}}</td>
                             <td data-title="'Відгук'" style="height: 25px;  overflow: hidden;text-overflow: ellipsis;">{{row.recall}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
