<?php
/**
 * Created by PhpStorm.
 * User: Adm
 * Date: 14.09.2017
 * Time: 12:29
 */
?>

<div class="row" ng-controller="studentProgressCtrl">
    <div class="panel panel-default">
        <div class="panel-body" class="ng-cloak">
            <div class="row" ng-repeat="row in data">
                    <label class="col-sm-4"style="float: left;"><a href="#" ng-attr-class="{{!row.isDone && 'disabled'}}">Заняття: {{row.title}} </a> </label>
                <div class="col-sm-6" ng-show="row.isDone">Пройдено</div>
                <div class="col-sm-6" ng-show="!row.isDone">Не пройдено</div>
            </div>
        </div>
    </div>
</div>
