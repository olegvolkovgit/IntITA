<div class="col-md-12" ng-controller="specializationsTableCtrl">
    <div class="col-lg-12">
        <a type="button" class="btn btn-primary" ng-href="#/configuration/createSpecialization">
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
                            <th>Спеціалізація(укр.)</th>
                            <th>Спеціалізація(рос.)</th>
                            <th>Спеціалізація(англ.)</th>
                        </tr>
                        <tr ng-repeat="row in specializations">
                            <td>{{row.id}}</td>
                            <td>
                                <a ng-href="#/configuration/specialization/update/{{row.id}}">{{row.title_ua}}</a>
                            </td>
                            <td>
                                <a ng-href="#/configuration/specialization/update/{{row.id}}">{{row.title_ru}}</a>
                            </td>
                            <td>
                                <a ng-href="#/configuration/specialization/update/{{row.id}}">{{row.title_en}}</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>