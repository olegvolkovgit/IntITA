<div class="panel panel-default">
    <div class="panel-body">
        <table ng-table="paidCoursesTable" class="table table-striped table-bordered table-hover">
            <tr ng-repeat="row in $data">
                <td data-title="'Назва'"><div ng-if="!row.course.cancelled"><a href="/course/{{row.course.language}}/{{row.course.alias}}">{{row.course.title_ua}}</a></div>
                    <div ng-if="row.course.cancelled">{{row.course.title_ua}} (скасований)</div>
                </td>
                <td data-title="'Сума, грн'"><div ng-if="row.course.course_price">{{row.course.course_price *usd}}</div><div ng-if="!row.course.course_price">безкоштовно</div></td>
            </tr>
        </table>
    </div>
</div>
