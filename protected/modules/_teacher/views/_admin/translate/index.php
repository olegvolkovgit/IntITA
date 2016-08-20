<?php
/* @var $model Translate */
?>
<div class="col-lg-12" ng-controller="interfaceMessagesCtrl">
    <button class="btn btn-primary" ng-click="changeView('interfacemessages/create')">
        Додати повідомлення
    </button>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="tableParams" class="table table-striped table-bordered table-hover" id="graduatesTable" style="table-layout: fixed">
                    <colgroup>
                        <col width="10%"/>
                        <col width="10%"/>
                        <col width="15%"/>
                        <col width="50%"/>
                        <col width="15%"/>
                    </colgroup>
                    <tr ng-repeat="row in $data">
                        <td data-title="'ID'" style="width: ">{{row.id}}</td>
                        <td data-title="'Мова'" >{{row.language}}</td>
                        <td data-title="'Категорія'">{{row.category}}</td>
                        <td data-title="'Переклад'"><a href="#/interfacemessages/view/{{row.id_record}}">{{row.translation}}</a></td>
                        <td data-title="'Коментар'" >{{row.comment}}</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</div>
<script>
    $jq(document).ready(function () {
        initTranslatesList();
    });
</script>
