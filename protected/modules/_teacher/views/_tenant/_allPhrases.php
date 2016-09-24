

<div class="col-lg-12" ng-controller="phrasesCtrl">
    <br>
    <ul class="list-inline">
        <li>
            <button class="btn btn-primary" ng-click="changeView('tenant/phrases/create')">
                Створити фразу
            </button>
        </li>

    </ul>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="phrasesTable" class="table table-striped table-bordered table-hover">
                    <colgroup>
                        <col style="width:30%;"/>
                        <col style="width:12%;"/>
                        <col style="width:12%;"/>
                    </colgroup>
                    <tr ng-repeat="row in $data">
                        <td data-title="'Фраза'">{{row.text}}</td>
                        <td data-title="'Змінити'"><a href="javascript:void(0)" ng-click="editPhrase(row.id)">Змінити</a> </td>
                        <td data-title="'Видалити'"><a href="javascript:void(0)" ng-click="deletePhrase(row.id)">Видалити</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>


