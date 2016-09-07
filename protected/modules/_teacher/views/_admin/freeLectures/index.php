<?php
/* @var $model Lecture */
?>
<div class="col-lg-12" ng-controller="freelecturesCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <label>
                <span>Пошук:  <input class="form-control" type="text" placeholder="" ng-model="search" ng-change="searchLectures()"></span>
                </label>
                    <table ng-table="tableParams" class="table table-striped table-bordered table-hover" id="freeLecturesTable" style="width:100%">
                    <colgroup>
                        <col width="25%"/>
                        <col width="10%"/>
                        <col width="20%"/>
                        <col width="15%"/>
                        <col width="10%"/>
                        <col width="10%"/>
                    </colgroup>
                    <tr ng-repeat="row in $data">
                        <td sortable="'module.title_ua'" data-title="'Модуль'" style="width: "><a href="/module/ua/{{row.module.module_ID}}" target="_blank">{{row.module.title_ua}}</td>
                        <td sortable="'t.order'" data-title="'Порядок у модулі'" style="width: ">{{row.order}}</td>
                        <td sortable="'t.title_ua'" data-title="'Назва'" ><a href="/module/ua/{{row.module.module_ID}}/{{row.order}}" target="_blank">{{row.title_ua}}</a></td>
                        <td sortable="'type.title_ua'" data-title="'Тип заняття'">{{row.type.title_ua}}</td>
                        <td sortable="'t.isFree'" data-title="'Статус'"><span ng-show="row.isFree==1">бескоштовна</span><span ng-show="row.isFree==0">платна</span></td>
                        <td data-title="'Змінити'"><a href="javascript:void(0)" ng-click="changeStatus(row)">Змінити</a> </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>