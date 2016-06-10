<?php
/**
 * @var $counters array
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul id="userTabs" class="nav nav-tabs">
            <li class="active"><a href="#register" data-toggle="tab">Зареєстровані користувачі (<?=$counters["users"];?>)</a>
            </li>
            <li><a href="#students" data-toggle="tab">Студенти (<?=$counters["students"];?>)</a>
            </li>
            <li><a href="#teacher" data-toggle="tab">Співробітники (<?=$counters["teachers"];?>)</a>
            </li>
            <li><a href="#withoutRoles" data-toggle="tab">Користувачі без ролі<?//=$counters["withoutRoles"];?></a>
            </li>
            <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Ролі користувачів
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#admin" data-toggle="tab">Адміністратори (<?=$counters["admins"];?>)</a>
                    </li>
                    <li><a href="#accountant" data-toggle="tab">Бухгалтери (<?=$counters["accountants"];?>)</a>
                    </li>
                    <li><a href="#content_manager" data-toggle="tab">Контент менеджери (<?=$counters["contentManagers"];?>)</a>
                    </li>
                    <li><a href="#teacher_consultant" data-toggle="tab">Викладачі (<?=$counters["teacherConsultants"];?>)</a>
                    </li>
                    <li><a href="#trainer" data-toggle="tab">Тренери (<?=$counters["trainers"];?>)</a>
                    </li>
                    <li><a href="#consultant" data-toggle="tab">Консультанти (<?=$counters["consultants"];?>)</a>
                    </li>
                    <li><a href="#tenant" data-toggle="tab">Tenants (<?=$counters["tenants"];?>)</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade" id="admin">
                <?php $this->renderPartial('tables/_adminsTable');?>
            </div>
            <div class="tab-pane fade" id="accountant">
                <?php $this->renderPartial('tables/_accountantsTable');?>
            </div>
            <div class="tab-pane fade" id="teacher">
                <?php $this->renderPartial('tables/_teachersTable');?>
            </div>
            <div class="tab-pane fade" id="withoutRoles">
                <?php $this->renderPartial('tables/_withoutRolesTable');?>
            </div>
            <div class="tab-pane fade in active" id="register">
                <?php $this->renderPartial('tables/_usersTable');?>
            </div>
            <div class="tab-pane fade" id="students">
                <?php $this->renderPartial('tables/_studentsTable');?>
            </div>
            <div class="tab-pane fade" id="teacher_consultant">
                <?php $this->renderPartial('tables/_teacherConsultantsTable');?>
            </div>
            <div class="tab-pane fade" id="content_manager">
                <?php $this->renderPartial('tables/_contentManagersTable');?>
            </div>
            <div class="tab-pane fade" id="trainer">
                <?php $this->renderPartial('tables/_trainersTable');?>
            </div>
            <div class="tab-pane fade" id="consultant">
                <?php $this->renderPartial('tables/_consultantsTable');?>
            </div>
            <div class="tab-pane fade" id="tenant">
                <?php $this->renderPartial('tables/_tenantsTable');?>
            </div>
        </div>
    </div>
</div>

<script>
    $jq(document).ready(function () {
        initUsersTable();
        initStudentsList();
        initWithoutRolesUsersTable();
        initAdminsTable();
        initAccountantsTable();
        initTeachersTable();
        initContentManagersTable();
        initTeacherConsultantsTable();
        initTenantsTable();
        initTrainersTable();
        initConsultantsRolesTable();

        $jq("#startDate").datepicker(lang);
        $jq("#endDate").datepicker(lang);

        //$jq('.nav-tabs a[href="#accountant"]').tab('show');
       if(history.state!=null)
        openTab('#userTabs', history.state.tab);

        $jq('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            var currentTab = $jq(e.target).text(); // get current tab
            $jq("#pageTitle").html(currentTab);
        });
    });

</script>




