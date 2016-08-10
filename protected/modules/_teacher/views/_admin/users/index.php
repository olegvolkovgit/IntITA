<?php
/**
 * @var $counters array
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul id="userTabs" class="nav nav-tabs" ng-controller="usersCtrl">
            <li class="active"><a href="#register" data-toggle="tab">Зареєстровані користувачі (<?=$counters["users"];?>)</a>
            </li>
            <li><a href="#studentslist" data-toggle="tab">Студенти (<?=$counters["students"];?>)</a>
            </li>
            <li><a href="#teacher" data-toggle="tab">Співробітники (<?=$counters["teachers"];?>)</a>
            </li>
            <li><a href="#withoutRoles" data-toggle="tab">Користувачі без ролі (<?=$counters["withoutRoles"];?>)</a>
            </li>
            <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="">Ролі користувачів
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
        <div class="tab-content" ng-controller="usersCtrl">
            <div class="tab-pane fade in active" id="register" ng-controller="usersTableCtrl">
                <?php $this->renderPartial('tables/_usersTable');?>
            </div>
            <div class="tab-pane fade" id="studentslist" ng-controller="studentsTableCtrl">
                <?php $this->renderPartial('tables/_studentsTable');?>
            </div>
            <div class="tab-pane fade" id="teacher" ng-controller="teachersTableCtrl">
                <?php $this->renderPartial('tables/_teachersTable');?>
            </div>
            <div class="tab-pane fade" id="withoutRoles" ng-controller="withoutRolesTableCtrl">
                <?php $this->renderPartial('tables/_withoutRolesTable');?>
            </div>
            <div class="tab-pane fade" id="admin" ng-controller="adminsTableCtrl">
                <?php $this->renderPartial('tables/_adminsTable');?>
            </div>
            <div class="tab-pane fade" id="accountant" ng-controller="accountantsTableCtrl">
                <?php $this->renderPartial('tables/_accountantsTable');?>
            </div>
            <div class="tab-pane fade" id="content_manager" ng-controller="contentManagersTableCtrl">
                <?php $this->renderPartial('tables/_contentManagersTable');?>
            </div>
            <div class="tab-pane fade" id="teacher_consultant" ng-controller="teacherConsultantsTableCtrl">
                <?php $this->renderPartial('tables/_teacherConsultantsTable');?>
            </div>
            <div class="tab-pane fade" id="tenant" ng-controller="tenantsTableCtrl">
                <?php $this->renderPartial('tables/_tenantsTable');?>
            </div>
            <div class="tab-pane fade" id="consultant" ng-controller="consultantsTableCtrl">
                <?php $this->renderPartial('tables/_consultantsTable');?>
            </div>
            <div class="tab-pane fade" id="trainer" ng-controller="trainersTableCtrl">
                <?php $this->renderPartial('tables/_trainersTable');?>
            </div>
        </div>
    </div>
</div>





