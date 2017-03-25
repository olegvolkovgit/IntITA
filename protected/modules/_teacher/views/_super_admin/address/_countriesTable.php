<div class="panel panel-default">
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" ng-table="countriesTable">
                <colgroup>
                    <col width="10%" />
                    <col width="25%" />
                    <col width="25%" />
                    <col width="25%" />
                    <col width="10%" />
                </colgroup>
                <tr ng-repeat="row in $data">
                    <td data-title="'ID'" sortable="'id'" filter="{id:'text'}">{{row.id}}</td>
                    <td data-title="'Українською'" sortable="'title_ua'" filter="{title_ua:'text'}">{{row.title_ua}}</td>
                    <td data-title="'Російською'" sortable="'title_ru'" filter="{title_ru:'text'}">{{row.title_ru}}</td>
                    <td data-title="'Англійською'" sortable="'title_en'" filter="{title_en:'text'}">{{row.title_en}}</td>
                    <td data-title="'Геокод'" sortable="'geocode'" filter="{geocode:'text'}">{{row.geocode}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
