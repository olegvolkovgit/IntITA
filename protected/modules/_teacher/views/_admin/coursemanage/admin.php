<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('admin/addcourse')"><?php echo Yii::t("coursemanage", "0511"); ?></button>
    </li>
</ul>
<div class="col-lg-12" ng-controller="coursemanageCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="coursesTable" style="width:100%" datatable="ng" dt-options="dtOptions">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Псевдонім</th>
                        <th>Назва</th>
                        <th>Статус</th>
                        <th>Видалений</th>
                        <th>Рівень</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="course in coursesList">
                        <td>{{course.id}}</td>
                        <td>{{course.alias}}</td>
                        <td><a href="#/course/detail/{{course.id}}">{{course.title["name"]}}</a> </td>
                        <td>{{course.status}}</td>
                        <td>{{course.cancelled}}</td>
                        <td>{{course.level}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
