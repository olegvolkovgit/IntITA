<div class="col-md-12">
    <div class="col-lg-12">
        <a type="button" class="btn btn-primary" ng-href="#/supervisor/createSpecialization">
            Створити нову спеціалізацію
        </a>
        <br>
        <br>
        <div class="panel panel-default">
            <div class="panel-body" >
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" style="table-layout: fixed">
                        <tr>
                            <th>ID</th>
                            <th>Спеціалізація</th>
                        </tr>
                        <tr ng-repeat="row in specializations">
                            <td>{{row.id}}</td>
                            <td>
                                <a ng-href="#/supervisor/specialization/update/{{row.id}}">{{row.specialization}}</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>