<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 13.11.2016
 * Time: 22:43
 */
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        Перегляд електронного листа
    </div>
    <div class="panel-body" ng-controller="newsletterCtrl">
        <div class="row">
            <div class="form-group col-md-8" id="receiver">
                <label>
                    Тип розсилки
                </label>
                <br>
            </div>
        </div>
        <div class="form-group col-md-8" id="receiver" ng-show="newsletterType=='roles'">
            <label>Кому</label>

        </div>

        <div class="form-group col-md-8" id="receiver">
        </div>
        <div class="form-group col-md-8">
            <label>Тема</label>
        </div>

        <div class="form-group col-md-8">
            <label>Лист</label>
        </div>
        <div class="form-group col-md-8">
            <label for="selectSchedulerType">Відправка</label>
            <select class="form-control" id="selectTaskType"
                    ng-model="taskType"
                    ng-options="taskType.value as taskType.name for taskType in taskTypes">
            </select>
        </div>
    </div>
</div>