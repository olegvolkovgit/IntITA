<div class="col-lg-12" ng-controller="lecturesTableCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" style="width:100%" datatable="ng" dt-options="dtOptions" dt-instance="dtInstance">
                                <thead>
                                <tr>
                                    <th>Модуль</th>
                                    <th>Порядок у модулі</th>
                                    <th>Назва</th>
                                    <th>Тип заняття</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr  ng-repeat="lecture in lectures">
                                    <td>{{lecture.module}}</td>
                                    <td>{{lecture.order}}</td>
                                    <td><a href="{{lecture.lesson_url}}">{{lecture.title}}</a></td>
                                    <td>{{lecture.type}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>