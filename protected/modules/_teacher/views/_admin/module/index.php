<div ng-controller="modulemanageCtrl">

<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('row/create')">Створити модуль</button>
    </li>
</ul>

<div class="col-lg-12" >
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="modulesTable" class="table table-striped table-bordered table-hover">
                    <colgroup>
                        <col width="8%" />
                        <col width="15%" />
                        <col width="8%" />
                        <col width="24%" />
                        <col width="10%" />
                        <col width="17%" />
                        <col width="10%" />
                        <col width="8%" />
                    </colgroup>
                    <tr ng-repeat="row in $data">
                        <td data-title="'Id'" sortable="'module_ID'" filter="{module_ID: 'text'}">{{row.module_ID}}</td>
                        <td data-title="'Псевдонім'" sortable="'alias'" filter="{alias: 'text'}">{{row.alias}}</td>
                        <td data-title="'Мова'" sortable="'language'" filter="{language: 'text'}">{{row.language}}</td>
                        <td data-title="'Назва'" sortable="'title_ua'" filter="{title_ua: 'text'}"><a href="#/module/view/{{row.module_ID}}"> {{row.title_ua}} </a></td>
                        <td data-title="'Статус'" filter="{status: 'select'}" filter-data="statuses"><span ng-if="row.status">готовий</span>
                                                                                                    <span ng-if="!row.status">в розробці</span>
                        </td>
                        <td data-title="'Рівень'" filter="{'level0.id': 'select'}" filter-data="levels">{{row.level0.title_ua}}</td>
                        <td data-title="'Видалений'" filter="{cancelled: 'select'}" filter-data="cancelled"><span ng-if="row.cancelled">видалений</span>
                                                                                                            <span ng-if="!row.cancelled">доступний</span>
                        </td>
                        <td data-title="'Призначити'"><button type="button" class="btn btn-outline btn-success btn-sm" ng-click="changeView('row/addAuchtor/'+row.id)">автора</></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</div>