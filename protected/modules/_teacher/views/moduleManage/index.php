<?php if (Yii::app()->user->model->isContentManager()) { ?>
<ul class="list-inline">
    <li>
        <a type="button" class="btn btn-primary" ng-href="#/module/create">Створити модуль</a>
    </li>
</ul>
<?php } ?>
<div class="panel panel-default" ng-controller="modulesTableCtrl" organization="<?php echo $organization ?>">
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table ng-table="modulesTable" class="table table-striped table-bordered table-hover">
                <colgroup>
                    <col width="5%" />
                    <col width="12%" />
                    <col width="6%" />
                    <col width="20%" />
                    <col width="10%" />
                    <col width="10%" />
                    <col width="12%" />
                    <col width="10%" />
                    <col width="15%" />
                </colgroup>
                <tr ng-repeat="row in $data">
                    <td data-title="'Id'" sortable="'module_ID'" filter="{module_ID: 'text'}">{{row.module_ID}}</td>
                    <td data-title="'Псевдонім'" sortable="'alias'" filter="{alias: 'text'}">{{row.alias}}</td>
                    <td data-title="'Мова'" sortable="'language'" filter="{language: 'select'}" filter-data="lang">{{row.language}}</td>
                    <td data-title="'Назва'" sortable="'title_ua'" filter="{title_ua: 'text'}">
                        <a ng-href="#/module/id/{{row.module_ID}}">{{row.title_ua}}</a>
                    </td>
                    <td data-title="'Статус онлайн'" filter="{status_online: 'select'}" filter-data="statuses"><span ng-if="row.status_online">готовий</span>
                        <span ng-if="!row.status_online">в розробці</span>
                    </td>
                    <td data-title="'Статус офлайн'" filter="{status_offline: 'select'}" filter-data="statuses"><span ng-if="row.status_offline">готовий</span>
                        <span ng-if="!row.status_offline">в розробці</span>
                    </td>
                    <td data-title="'Рівень'" filter="{'level0.id': 'select'}" filter-data="levels">{{row.level0.title_ua}}</td>
                    <td data-title="'Видалений'" filter="{cancelled: 'select'}" filter-data="cancelled"><span ng-if="row.cancelled">видалений</span>
                        <span ng-if="!row.cancelled">доступний</span>
                    </td>
                    <td data-title="'Організація'" sortable="'organization.name'" filter="{'organization.name': 'text'}">{{row.organization.name}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>