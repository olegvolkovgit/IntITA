<div class="panel panel-default">
    <div class="panel-body">
        <table ng-table="groupCoursesAccessParams" class="table table-bordered table-striped table-condensed">
            <tr ng-repeat="row in $data track by $index">
                <td data-title="'Курс'" filter="{'course.title_ua': 'text'}" sortable="'course.title_ua'">
                    <a href="" ng-click="courseLink(row.course.course_ID)" >{{row.course.title_ua}}</a>
                </td>
                <td data-title="'Закінчення доступу'" sortable="'end_date'" filter="{'end_date': 'text'}">
                    {{row.end_date}}
                </td>
            </tr>
        </table>
    </div>
</div>