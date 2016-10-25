<?php
/**
 * @var $counters array
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <!-- Tab panes -->
        <div class="tab-content">
            <uib-tabset>
                <uib-tab  index="0" heading="Зареєстровані користувачі (<?=$counters["users"];?>)">
                    <div ng-controller="usersTableCtrl">
                        <?php $this->renderPartial('tables/_usersTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="1" heading="Студенти (<?=$counters["students"];?>)">
                    <div ng-controller="studentsTableCtrl">
                        <?php $this->renderPartial('tables/_studentsTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="2" heading="Оффлайн студенти (<?=$counters["offlineStudents"];?>)">
                    <div ng-controller="offlineStudentsTableCtrl">
                        <?php $this->renderPartial('tables/_offlineStudentsTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="3" heading="Співробітники (<?=$counters["teachers"];?>)">
                    <div ng-controller="teachersTableCtrl">
                        <?php $this->renderPartial('tables/_teachersTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="4" heading="Користувачі без ролі (<?=$counters["withoutRoles"];?>)">
                    <div ng-controller="withoutRolesTableCtrl">
                        <?php $this->renderPartial('tables/_withoutRolesTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="5" heading="Адміністратори (<?=$counters["admins"];?>)">
                    <div ng-controller="adminsTableCtrl">
                        <?php $this->renderPartial('tables/_adminsTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="6" heading="Бухгалтери (<?=$counters["accountants"];?>)">
                    <div ng-controller="accountantsTableCtrl">
                        <?php $this->renderPartial('tables/_accountantsTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="7" heading="Контент менеджери (<?=$counters["contentManagers"];?>)">
                    <div ng-controller="contentManagersTableCtrl">
                        <?php $this->renderPartial('tables/_contentManagersTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="8" heading="Викладачі (<?=$counters["teacherConsultants"];?>)">
                    <div ng-controller="teacherConsultantsTableCtrl">
                        <?php $this->renderPartial('tables/_teacherConsultantsTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="9" heading="Тренери (<?=$counters["trainers"];?>)">
                    <div ng-controller="trainersTableCtrl">
                        <?php $this->renderPartial('tables/_trainersTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="10" heading="Консультанти (<?=$counters["consultants"];?>)">
                    <div ng-controller="consultantsTableCtrl">
                        <?php $this->renderPartial('tables/_consultantsTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="11" heading="Tenants (<?=$counters["tenants"];?>)">
                    <div ng-controller="tenantsTableCtrl">
                        <?php $this->renderPartial('tables/_tenantsTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="12" heading="Supervisors (<?=$counters["superVisors"];?>)">
                    <div ng-controller="superVisorsTableCtrl">
                        <?php $this->renderPartial('tables/_superVisorsTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="13" heading="Заблоковані користувачі (<?=$counters["blockedUsers"];?>)">
                    <div ng-controller="blockedUsersCtrl">
                        <?php $this->renderPartial('tables/_blockedUsersTable');?>
                    </div>
                </uib-tab>
            </uib-tabset>
        </div>
    </div>
</div>





