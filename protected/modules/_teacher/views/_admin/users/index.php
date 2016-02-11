<?php
/* @var $user StudentReg*/
/* @var $users array */
/* @var $adminsList array */
/* @var $accountants array */
/* @var $teachers array */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li><a href="#admin" data-toggle="tab">Адміністратори (<?=count($adminsList);?>)</a>
            </li>
            <li><a href="#accountant" data-toggle="tab">Бухгалтери (<?=count($accountants);?>)</a>
            </li>
            <li><a href="#teacher" data-toggle="tab">Викладачі (<?=count($teachers);?>)</a>
            </li>
            <li><a href="#register" data-toggle="tab">Зареєстровані користувачі (<?=count($users);?>)</a>
            </li>
            <li><a href="#students" data-toggle="tab">Студенти</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="admin">
                <?php $this->renderPartial('_adminsTable', array('adminsList' => $adminsList));?>
            </div>
            <div class="tab-pane fade" id="accountant">
                <?php $this->renderPartial('_accountantsTable', array('accountants' => $accountants));?>
            </div>
            <div class="tab-pane fade" id="teacher">
                <?php $this->renderPartial('_teachersTable', array('teachers' => $teachers));?>
            </div>
            <div class="tab-pane fade" id="register">
                <?php $this->renderPartial('_usersTable', array('users' => $users));?>
            </div>
            <div class="tab-pane fade" id="students">
                <?php $this->renderPartial('_studentsTable');?>
            </div>
        </div>
    </div>
</div>
<!-- DataTables JavaScript -->

<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'jquery-ui.min.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'jquery-ui.min.css') ?>"/>

<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/studentsList.js'); ?>"></script>

<script>

    $jq(document).ready(function () {
        $jq('#adminsTable, #accountantsTable, #usersTable, #teachersTable').DataTable({
                language: {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );

        studentTable = initStudentsList();

    });

    $jq("#startDate").datepicker(lang);
    $jq("#startDate").datepicker("option", "dateFormat", "yy-mm-dd");
    $jq("#endDate").datepicker(lang);
    $jq("#endDate").datepicker("option", "dateFormat", "yy-mm-dd");

</script>




