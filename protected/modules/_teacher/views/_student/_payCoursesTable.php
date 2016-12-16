<div class="panel panel-default">
    <div class="panel-body">
        <table ng-table="paidCoursesTable" class="table table-striped table-bordered table-hover">
            <tr ng-repeat="row in $data"  ng-if="row.course">
                <td data-title="'Назва'">
                    <div ng-if="!row.course.cancelled">
                        <a href="/course/{{row.course.language}}/{{row.course.alias}}" target="_blank">{{row.course.title_ua}}</a>
                    </div>
                    <div ng-if="row.course.cancelled">{{row.course.title_ua}} (скасований)</div>
                </td>
                <td data-title="'Сума, грн'">
                    <div ng-if="row.agreement.summa">{{row.agreement.summa | number:2}}</div>
                    <div ng-if="!row.agreement.summa">безкоштовно</div>
                </td>
                <td data-title="'Сплачено, грн'">
                    <div>{{row.paidAmount | number:2}}</div>
                </td>
                <td data-title="'Доступний до:'">
                    {{row.endDate}}
                </td>
            </tr>
        </table>
    </div>
</div>
