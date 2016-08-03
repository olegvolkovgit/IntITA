<div class="col-md-12" ng-controller="configCtrl">

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body" >
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="configTable" datatable="ng" dt-options="dtOptions" width="100%">
                        <thead>
                        <tr>
                            <th style="width: 8%">ID</th>
                            <th>Параметр</th>
                            <th>Значення</th>
                            <th>Опис</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="parameter in configsite">
                            <td>{{parameter.id}}</td>
                            <td><a href="#/config/view/{{parameter.id}}"> {{parameter.param["name"]}}</a></td>
                            <td>{{parameter.value}}</td>
                            <td>{{parameter.label}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

