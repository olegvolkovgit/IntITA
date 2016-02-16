<?php
/* @var $user StudentReg */
/* @var $users array */

$currentTime = date('Y-m-d H:i:s');
$last_24h = date('Y-m-d H:i:s', time()-60*60*24);
$startOfDay = date('Y-m-d H:i:s', strtotime(date('Y-m-d')));

//2016-02-13 11:37:17

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
            onclick="updateStudentList($jq('#startDatePeriod').val(), $jq('#endDatePeriod').val())">
        За період:
    </button>

    <span> з </span><input type="text" class="form-inline" id="startDatePeriod"/>
    <span> по </span><input type="text" class="form-inline" id="endDatePeriod"/>

    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="studentsTable" style="width:100%">
                    <thead>
                    <tr>
                        <th>ФІО</th>
                        <th>Email</th>
                        <th>Зареєстровано</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
