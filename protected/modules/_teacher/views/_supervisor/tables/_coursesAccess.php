<div class="panel panel-default">
    <div class="panel-body">
        <a type="button" class="btn btn-primary" ng-href="#/supervisor/groupAccess/course/group/{{groupId}}">
            Додати доступ до курсу
        </a>
        <br>
        <br>
        <table ng-table="groupCoursesAccessParams" class="table table-bordered table-striped table-condensed">
            <tr ng-repeat="row in $data track by $index">
                <td data-title="'Курс'" filter="{'course.title_ua': 'text'}" sortable="'course.title_ua'">
                    <a href="" ng-click="courseLink(row.course.course_ID)" >{{row.course.title_ua}}</a>
                </td>
                <td data-title="'Закінчення доступу'" sortable="'end_date'" filter="{'end_date': 'text'}">
                    {{row.end_date}}
                </td>
                <td data-title="'Скасувати доступ'">
                    <a href="" ng-if="row.end_date > date" ng-click="cancelGroupAccess(row.group_id, row.service_id, 'course')">
                        <i class="fa fa-trash fa-fw"></i>
                    </a>
                </td>
                <td data-title="'Редагувати'">
                    <a ng-href="#/supervisor/editGroupAccess/course/group/{{row.group_id}}/service/{{row.service_id}}">
                        редагувати
                    </a>
                </td>
            </tr>
        </table>
    </div>
</div>