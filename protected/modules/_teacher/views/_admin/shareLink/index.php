<?php
/* @var $model Lecture */
?>

<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('_teacher/_admin/shareLink/create'); ?>',
                    'Створити посилання на ресурс')">
            Створити посилання на ресурс</button>
    </li>
</ul>

<div class="col-lg-12" ng-controller="sharedlinksCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="shareLinksTable" style="width:100%">
                    <thead>
                    <tr>
                        <th>Назва</th>
                        <th>Посилання</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


