<?php
/* @var $user StudentReg */
/* @var $users array */
?>
<div class="col-lg-12">
    <br>
    <button class="btn btn-primary"
            onclick="updateStudentList()"
                'Додати викладача')">
        Всі студенти
    </button>

    <button class="btn btn-primary"
            onclick="updateStudentList('<?=date('Y-m-d')?>', '<?=date('Y-m-d')?>')"
                'Додати викладача')">
        Зареєстровані сьогодні
    </button>

    <button class="btn btn-primary"
            onclick="updateStudentList('<?=date('Y-m-d', time() - 60 * 60 * 24)?>', '<?=date('Y-m-d', time() - 60 * 60 * 24)?>')"
                'Додати викладача')">
        Зареєстровані вчора
    </button>

    <button class="btn btn-primary"
            onclick="updateStudentList($jq('#startDate').val(), $jq('#endDate').val())">
        Зареєстровані за період:
    </button>

    <span> з </span><input type="text" class="form-inline" id="startDate"\>
    <span> по </span><input type="text" class="form-inline" id="endDate"\>

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
