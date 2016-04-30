<div class="col-lg-12">
    <br>
    <ul class="list-inline">
        <li>
            <button class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/renderAddForm',
                        array('role' => "teacherConsultant")); ?>', 'Призначити викладача')">
                Призначити викладача
            </button>
        </li>
        <li>
            <button class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/addTeacherConsultantForm',
                        array('role' => "teacher_consultant")); ?>', 'Призначити модуль для викладача')">
                Призначити модуль для викладача
            </button>
        </li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="teacherConsultantsTable">
                    <thead>
                    <tr>
                        <th>ПІБ</th>
                        <th>Email</th>
                        <th>Призначено</th>
                        <th>Відмінено</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    initTeacherConsultantsTableCM();
</script>