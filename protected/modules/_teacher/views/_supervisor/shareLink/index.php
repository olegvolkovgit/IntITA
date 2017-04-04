<?php
/* @var $model Lecture */
?>
<div class="col-lg-12" ng-controller="sharedlinksCtrl">
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary" ng-click="changeView('sharedlinks/create')">
                Створити посилання на ресурс</button>
        </li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="shareLinksTable" style="width:100%" datatable="ng" dt-options="dtOptions">
                    <thead>
                    <tr>
                        <th>Назва</th>
                        <th>Посилання</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="sharedLink in sharedLinksList">
                        <td>{{sharedLink.name}} </td>
                        <td><a ng-href="#/sharedlinks/detail/{{sharedLink.id}}">{{sharedLink.link["title"]}}</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


