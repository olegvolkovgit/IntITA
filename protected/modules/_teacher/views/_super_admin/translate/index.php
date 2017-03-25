<?php
/* @var $model Translate */
?>
<div class="col-lg-12" ng-controller="interfaceMessagesCtrl">
<!--    <a class="btn btn-primary" ng-href="#/interfacemessages/create">-->
<!--        Додати повідомлення-->
<!--    </a>-->
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="tableParams" class="table table-striped table-bordered table-hover" style="table-layout: fixed">
                    <colgroup>
                        <col width="10%"/>
                        <col width="10%"/>
                        <col width="15%"/>
                        <col width="50%"/>
                        <col width="15%"/>
                    </colgroup>
                    <tr ng-repeat="row in $data">
                        <td data-title="'ID'" filter="{'id': 'text'}" style="width: ">{{row.id}}</td>
                        <td data-title="'Мова'" filter="{'language': 'text'}">{{row.language}}</td>
                        <td data-title="'Категорія'"filter="{'source.category': 'text'}" >{{row.source.category}}</td>
                        <td data-title="'Переклад'" filter="{'translation': 'text'}" ><a href="#/interfacemessages/view/{{row.id_record}}">{{row.translation}}</a></td>
                        <td data-title="'Коментар'" filter="{'comment.comment': 'text'}">{{row.comment.comment}}</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</div>
