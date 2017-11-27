<?php
/**
 * Created by PhpStorm.
 * User: Adm
 * Date: 14.09.2017
 * Time: 12:29
 */
?>
<div class="row">
    <div class="form-group">
        <a type="button" class="btn btn-default" ng-click='back()'>
            Назад
        </a>
    </div>
    <div class="panel panel-default">
        <div class="panel-body" class="ng-cloak">
            <div class="form-group row">
                <div class="col-xs-2 col-md-2 col-lg-2">
                    <select class="form-control col-md-3" ng-change="progress.pageChanged()" ng-model="progress.filter.service" ng-init="progress.filter.service = progress.servicesCategory[0].id"
                            ng-options="service.id as service.title for service in progress.servicesCategory">
                    </select>
                </div>
                <div class="col-xs-2 col-md-2 col-lg-2">
                    <input class="form-control col-md-3" type="text" id="searchField" ng-keypress="progress.allpyFilter($event)" ng-model="progress.filter.search" placeholder="Фільтр"/>
                </div>
                <div class="col-xs-2 col-md-2 col-lg-2">
                    <select class="form-control col-md-3" ng-model="progress.filter.group" ng-change="progress.pageChanged()" id="groupSelect">
                        <option ng-repeat="category in progress.studentsCategory track by $index" value="{{category.id}}">{{category.title}}</option>
                    </select>
                </div>
                <button class="btn btn-primary" id="searchButton" ng-click="progress.allpyFilter()">Пошук</button>
            </div>
            <content-progress
                    data-template="progress.filter.service==1?'<?php echo Config::getBaseUrl() ?>/angular/js/templates/progress/courseProgress.html':'<?php echo Config::getBaseUrl() ?>/angular/js/templates/progress/moduleProgress.html'"
                    data-data-url="'<?php echo Config::getBaseUrl() ?>/_teacher/studentProgress/getUsers'"
                    data-progress=progress
                    data-state-params=stateParams
            >
            </content-progress>
        </div>
    </div>
</div>