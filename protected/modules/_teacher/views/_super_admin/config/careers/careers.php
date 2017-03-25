<a type="button" class="btn btn-primary" ng-href="#/configuration/createcareer">
    Створити нову кар'єру
</a>
<br>
<br>
<div class="panel panel-default" ng-controller="careerStartTableCtrl">
    <div class="panel-body" >
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" style="table-layout: fixed">
                <tr>
                    <th style="width:5%">ID</th>
                    <th>Назва українською</th>
                    <th>Назва російською</th>
                    <th>Назва англійською</th>
                </tr>
                <tr ng-repeat="row in careers">
                    <td>{{row.id}}</td>
                    <td>
                        <a ng-href="#/configuration/careers/update/{{row.id}}">{{row.title_ua}}</a>
                    </td>
                    <td>
                        <a ng-href="#/configuration/careers/update/{{row.id}}">{{row.title_ru}}</a>
                    </td>
                    <td>
                        <a ng-href="#/configuration/careers/update/{{row.id}}">{{row.title_en}}</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>