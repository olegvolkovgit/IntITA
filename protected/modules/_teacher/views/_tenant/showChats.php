<div class="col-lg-12" ng-controller="chatsCtrl">
    <br>
    <ul class="list-inline">

    </ul>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="chatsTable" class="table table-striped table-bordered table-hover" id="allChatsTable">
                    <colgroup>
                        <col style="width:5%;" />
                        <col style="width:30%;" />
                    </colgroup>
                    <tr ng-repeat="row in $data">
                        <td  data-title="'ID кімнати'">{{row.id}}</td>
                        <td  data-title="'Назва кімнати'">{{row.name}}</td>

<!--                        <th style="width:12%;">Інформація</th>-->
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>