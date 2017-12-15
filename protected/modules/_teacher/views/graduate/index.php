<div class="col-lg-12" ng-controller="graduateCtrl">
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary" ng-click="changeView('graduate/create')">
                Додати випускника
            </button>
        </li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="tableParams" class="table table-striped table-bordered table-hover" id="graduatesTable" style="table-layout: fixed">
                    <tr ng-repeat="row in $data">
                         <td data-title="'Прізвище, ім\'я'" sortable="'user.fullName'" filter="{'user.fullName': 'text'}" ><a href="#/graduate/view/{{row.id}}"> {{row.user.fullName}}</a></td>
                         <td data-title="'Фото'" ><img src="/images/avatars/{{row.user.avatar}}"></td>
                         <td data-title="'Посада'" filter="{position: 'text'}">{{row.position}}</td>
                         <td data-title="'Місце роботи'" filter="{work_place: 'text'}">{{row.work_place}}</td>
                         <td data-title="'Відгук'" style="white-space:nowrap; height:100px; text-overflow: ellipsis !important; overflow: hidden; ">{{row.recall}}</td>
                         <td data-title="'Дата випуску'" style="white-space:nowrap; height:100px; text-overflow: ellipsis !important; overflow: hidden; " sortable="'graduate_date'" filter="{graduate_date: 'text'}">{{row.graduate_date}}</td>
                         <td data-title="'Статус'" filter="{published: 'select'}" filter-data="publishStatus" style="white-space:nowrap; height:100px; text-overflow: ellipsis !important; overflow: hidden; "><a href="javascript:void(0)" ng-click="changeGraduateStatus(row)">
                                <span> {{row.published ? 'Опубліковано' : 'Не опубліковано'}} <span>
                             </a>
                         </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
