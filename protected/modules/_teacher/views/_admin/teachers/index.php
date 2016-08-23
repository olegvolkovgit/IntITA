<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 22.12.2015
 * Time: 17:07
 */
?>
<div class="col-md-12">
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/admin/teacher/create">
                Додати спвіробітника
            </a>
        </li>
    </ul>
    <div class="col-lg-12" ng-controller="teachersCtrl">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="teachersAdminTable">
                        <thead>
                        <tr>
                            <th>ПІБ</th>
                            <th>Email</th>
                            <th>Статус</th>
                            <th></th>
                            <th></th>
                            <th>Додати</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>