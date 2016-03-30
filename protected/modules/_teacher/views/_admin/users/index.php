<?php
/* @var $countAdmins int
 * @var $countUsers array
 * @var $countAccountants array
 * @var $countStudents array
 * @var $countTeachers array
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul id="userTabs" class="nav nav-tabs">
            <li class="active"><a href="#admin" data-toggle="tab">Адміністратори (<?=$countAdmins;?>)</a>
            </li>
            <li><a href="#accountant" data-toggle="tab">Бухгалтери (<?=$countAccountants;?>)</a>
            </li>
            <li><a href="#teacher" data-toggle="tab">Викладачі (<?=$countTeachers;?>)</a>
            </li>
            <li><a href="#register" data-toggle="tab">Зареєстровані користувачі (<?=$countUsers;?>)</a>
            </li>
            <li><a href="#students" data-toggle="tab">Студенти (<?=$countStudents;?>)</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="admin">
                <?php $this->renderPartial('_adminsTable');?>
            </div>
            <div class="tab-pane fade" id="accountant">
                <?php $this->renderPartial('_accountantsTable');?>
            </div>
            <div class="tab-pane fade" id="teacher">
                <?php $this->renderPartial('_teachersTable');?>
            </div>
            <div class="tab-pane fade" id="register">
                <?php $this->renderPartial('_usersTable');?>
            </div>
            <div class="tab-pane fade" id="students">
                <?php $this->renderPartial('_studentsTable');?>
            </div>
        </div>
    </div>
</div>

<script>
    $jq(document).ready(function () {
        initAdminsTable();
        initAccountantsTable();
        initStudentsList();
        initUsersTable();
        initTeachersTable();

        $jq("#startDate").datepicker(lang);
        $jq("#endDate").datepicker(lang);

       if(history.state!=null)
        openTab('#userTabs', history.state.tab);
    });

</script>




