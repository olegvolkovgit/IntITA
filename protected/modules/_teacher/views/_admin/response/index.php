<div class="col-md-12" ng-controller="responseCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="teacherResponsesTable" datatable="ng" dt-options="dtOptions" dt-column-defs="dtColumnDefs">
                    <thead>
                    <tr>
                        <th>Автор</th>
                        <th>Про кого</th>
                        <th>Текст</th>
                        <th>Дата відгуку</th>
                        <th>Оцінка</th>
                        <th>Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="response in responsesList">
                        <td>{{response.author}}</td>
                        <td>{{response.about}}</td>
                        <td><a ng-href="#/response/detail/{{response.id}}"> {{response.response["text"]}}</a></td>
                        <td>{{response.date}}</td>
                        <td>{{response.rate}}</td>
                        <td>{{response.publish}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>