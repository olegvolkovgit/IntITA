<div class="col-md-12">
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/create'); ?>',
                        'Додати випускника')">
                Додати випускника
            </button>
        </li>
    </ul>
    <div class="col-lg-12" ng-controller="graduateCtrl">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table ng-table="tableParams" class="table table-striped table-bordered table-hover" style="table-layout: fixed;">
                        <tr ng-repeat="row in $data">
                             <td data-title="'Прізвище, ім\'я'">{{row.first_name}} {{row.last_name}}</td>
                             <td data-title="'Фото'"><img src="/images/graduates/{{row.avatar}}"></td>
                             <td data-title="'Посада'">{{row.position}}</td>
                             <td data-title="'Місце роботи'">{{row.work_place}}</td>
                             <td data-title="'Відгук'" style="overflow: hidden; text-overflow: ellipsis;">{{row.recall}}</td>
                        </tr>
                    </table>
<!--                    <table class="table table-striped table-bordered table-hover" id="graduatesTable">-->
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th>Прізвище, ім'я</th>-->
<!--                            <th>Фото</th>-->
<!--                            <th>Посада</th>-->
<!--                            <th>Місце роботи</th>-->
<!--                            <th>Відгук</th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!--                        </tbody>-->
<!--                    </table>-->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $jq(document).ready(function () {

    });
</script>
