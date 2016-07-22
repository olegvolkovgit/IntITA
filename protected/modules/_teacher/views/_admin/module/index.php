<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/create'); ?>',
                    'Створити модуль')">
            Створити модуль</button>
    </li>
</ul>

<div class="col-lg-12" ng-controller="moduleemanageCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="modulesTable" style="width:100%">
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>