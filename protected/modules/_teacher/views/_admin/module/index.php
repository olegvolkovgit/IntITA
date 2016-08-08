<div ng-controller="modulemanageCtrl">

<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/create'); ?>',
                    'Створити модуль')">
            Створити модуль</button>
    </li>
</ul>

<div class="col-lg-12" >
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" style="width:100%" datatable="ng" dt-options="dtOptions" dt-column-defs="dtColumnDefs">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Псевдонім</th>
                        <th>Мова</th>
                        <th>Назва</th>
                        <th>Статус</th>
                        <th>Рівень</th>
                        <th>Видалений</th>
                        <th>Призначити</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="module in modulesList">
                        <td>{{module.id}}</td>
                        <td>{{module.alias}}</td>
                        <td>{{module.lang}}</td>
                        <td><a href="#/module/view/{{module.id}}"> {{module.title["name"]}} </a></td>
                        <td>{{module.status}}</td>
                        <td>{{module.level}}</td>
                        <td>{{module.cancelled}}</td>
                        <td><button type="button" class="btn btn-outline btn-success btn-sm" ng-click="">автора</></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>