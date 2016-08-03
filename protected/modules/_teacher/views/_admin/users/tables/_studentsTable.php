<?php
date_default_timezone_set(Config::getServerTimezone());
$currentTime = date('Y-m-d H:i:s');
$last_24h = date('Y-m-d H:i:s', time()-60*60*24);
$startOfDay = date('Y-m-d H:i:s', strtotime(date('Y-m-d')));
?>
<div class="col-lg-12">
    <br>
    <button class="btn btn-primary"
            onclick="updateStudentList()">
        Всі студенти
    </button>

    <button class="btn btn-primary"
            onclick="updateStudentList('<?=$startOfDay?>', '<?=$currentTime?>')">
        За сьогодні
    </button>

    <button class="btn btn-primary"
            onclick="updateStudentList('<?=$last_24h?>', '<?=$currentTime?>')">
        За добу
    </button>

    <button class="btn btn-primary"
            onclick="updateStudentList($jq('#startDate').val()+ ' 00:00:00', $jq('#endDate').val()+' 23:59:59')">
        За період:
    </button>

    <span> з </span><input type="text" class="form-inline" id="startDate"/>
    <span> по </span><input type="text" class="form-inline" id="endDate"/>

    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="studentsTable" style="width:100%">
                    <thead>
                    <tr>
                        <th>ПІБ</th>
                        <th>Email</th>
                        <th>Зареєстровано</th>
                        <th>Форма</th>
                        <th>Країна</th>
                        <th>Місто</th>
                        <th>Тренер</th>
                        <th>Доступ</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
