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
                        <tr ng-repeat="row in $data">
                             <td data-title="'Прізвище, ім\'я'" style="width: "><a href="#/graduate/view/{{row.id}}"> {{row.first_name}} {{row.last_name}} </a></td>
                             <td data-title="'Фото'" ><img src="/images/graduates/{{row.avatar}}"></td>
                             <td data-title="'Посада'">{{row.position}}</td>
                             <td data-title="'Місце роботи'">{{row.work_place}}</td>
                             <td data-title="'Відгук'" style="white-space:nowrap; height:100px; text-overflow: ellipsis !important; overflow: hidden; ">{{row.recall}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
