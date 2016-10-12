<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('admin/addcourse')"><?php echo Yii::t("coursemanage", "0511"); ?></button>
    </li>
</ul>
<div class="col-lg-12" ng-controller="coursemanageCtrl">
    <div class="panel panel-default">
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
                        <td data-title="'Назва'" sortable="'title_ua'" filter="{title_ua: 'text'}"> <a href="#/course/detail/{{row.course_ID}}">{{row.title_ua}}</a> </td>
                        <td data-title="'Статус'" filter="{status: 'select'}" filter-data="statuses">
                            <span ng-if="row.status">готовий</span>
                            <span ng-if="!row.status">в розробці</span>
                        </td>
                        <td data-title="'Видалений'" filter="{cancelled: 'select'}" filter-data="cancelled">
                            <span ng-if="row.cancelled">видалений</span>
                            <span ng-if="!row.cancelled">доступний</span>
                        </td>
                        <td data-title="'Рівень'" filter="{'level0.id': 'select'}" filter-data="levels">{{row.level0.title_ua}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
