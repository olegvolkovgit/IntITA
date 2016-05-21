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
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/create'); ?>',
                        ' Додати співробітника')">
                Додати співробітника
            </button>
        </li>
    </ul>
    <div class="col-lg-12">
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
<script>
    $jq(document).ready(function () {
        initTeachersAdminTable();
    });
</script>
