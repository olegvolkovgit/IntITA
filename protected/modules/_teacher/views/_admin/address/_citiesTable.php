<?php
/**
 *
 */
?>
<div class="col-lg-12">
    <br>
    <button class="btn btn-primary"
            ng-click="changeView('admin/addcity')">
        Додати місто
    </button>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" datatable="ng" dt-options="dtOptionsCity" id="citiesTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Країна</th>
                        <th>Українською</th>
                        <th>Російською</th>
                        <th>Англійською</th>
                        <th>Редагувати</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="row in citiesList">
                        <td>{{row.id}}</td>
                        <td>{{row.country}}</td>
                        <td>{{row.title_ua}}</td>
                        <td>{{row.title_ru}}</td>
                        <td>{{row.title_en}}</td>
                        <td><a type="button" class="btn btn-outline btn-success btn-sm" ng-href="#/admin/editcity/{{row.id}}">редагувати</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
