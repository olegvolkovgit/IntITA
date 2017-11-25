<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 09.06.2017
 * Time: 12:36
 */
?>
<div class="col-md-12 col-sm-12" >
    <button class="btn btn-primary" ng-click="addProject()"> Додати проект</button>
</div>

<div class="row" ng-repeat="project in projects">
        <div class="col-md-2 col-sm-2">
                <strong>Проект:</strong>
        </div>
        <div class="col-md-5 col-sm-5">
            <a href="{{project.url}}" target="_blank">{{project.title}}</a>
        </div>
        <div class="col-md-5 col-sm-5">
            <span class="col-sm-4">
            <button class="btn btn-sm btn-primary" ng-click="editProject(project.id)">Змінити</button>
            </span>
            <span class="col-sm-1">
            <button class="btn btn-sm btn-success" ng-click="makeApproveRequest(project.id)">Запит на перевірку</button>
            </span>
        </div>

</div>