<div class="panel panel-default" ng-controller="coursesTableCtrl">
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table ng-table="courseTable" class="table table-striped table-bordered table-hover" style="width:100%">
                <colgroup>
                    <col width="6%" />
                    <col width="15%" />
                    <col width="8%" />
                    <col width="24%" />
                    <col width="12%" />
                    <col width="12%" />
                    <col width="10%" />
                </colgroup>
                <tr ng-repeat="row in $data">
                    <td data-title="'Id'" sortable="'course_ID'" filter="{course_ID: 'text'}">{{row.course_ID}}</td>
                    <td data-title="'Псевдонім'" sortable="'alias'" filter="{alias: 'text'}">{{row.alias}}</td>
                    <td data-title="'Мова'" filter="{language: 'select'}" filter-data="languages">{{row.language}}</td>
                    <td data-title="'Назва'" sortable="'title_ua'" filter="{title_ua: 'text'}">
                        <a ui-sref="courses.course({id:row.course_ID})">{{row.title_ua}}</a>
                    </td>
                    <td data-title="'Онлайн-статус'" filter="{status_online: 'select'}" filter-data="statuses">
                        <span ng-if="row.status_online">готовий</span>
                        <span ng-if="!row.status_online">в розробці</span>
                    </td>
                    <td data-title="'Офлайн-статус'" filter="{status_offline: 'select'}" filter-data="statuses">
                        <span ng-if="row.status_offline">готовий</span>
                        <span ng-if="!row.status_offline">в розробці</span>
                    </td>
                    <td data-title="'Видалений'" filter="{cancelled: 'select'}" filter-data="cancelled">
                        <span ng-if="row.cancelled">видалений</span>
                        <span ng-if="!row.cancelled">доступний</span>
                    </td>
                    <td data-title="'Рівень'" filter="{'level0.id': 'select'}" filter-data="levels">{{row.level0.title_ua}}</td>
                    <td data-title="'Організація'" sortable="'organization.name'" filter="{'organization.name': 'text'}">{{row.organization.name}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
