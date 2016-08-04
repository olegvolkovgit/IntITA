<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('admin/addcourse')"><?php echo Yii::t("coursemanage", "0511"); ?></button>
    </li>
</ul>
<div class="col-lg-12" ng-controller="coursemanageCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="coursesTable" style="width:100%">
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
