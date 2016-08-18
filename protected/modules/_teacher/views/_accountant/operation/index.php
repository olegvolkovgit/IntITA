<?php
/* @var $operations array
 * @var $model Operation
 */
?>
<div class="col-lg-12" ng-controller="operationCtrl">
    <br>
        <button class="btn btn-primary" ng-click="createOperation()">Нова проплата</button>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <operations-table></operations-table>
            </div>
        </div>
    </div>
</div>
