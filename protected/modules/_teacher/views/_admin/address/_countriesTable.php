<?php
/**
 *
 */
?>
<div class="col-lg-12">
    <br>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" datatable="ng" dt-options="dtOptionsCountry" id="countriesTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Українською</th>
                        <th>Російською</th>
                        <th>Англійською</th>
                        <th>Геокод</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="row in countriesList">
                        <td>{{row.id}}</td>
                        <td>{{row.title_ua}}</td>
                        <td>{{row.title_ru}}</td>
                        <td>{{row.title_en}}</td>
                        <td>{{row.geocode}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
