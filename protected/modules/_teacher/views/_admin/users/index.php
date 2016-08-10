<?php
/**
 * @var $counters array
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <!-- Tab panes -->
        <div class="tab-content" ng-controller="usersCtrl">
            <uib-tabset active="0" >
                <uib-tab  index="0" heading="Зареєстровані користувачі">
                    <div ng-controller="usersTableCtrl">
                        <?php $this->renderPartial('tables/_usersTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="1" heading="Студенти">
                    <div ng-controller="studentsTableCtrl">
                        <?php $this->renderPartial('tables/_studentsTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="2" heading="Співробітники">
                    <div ng-controller="teachersTableCtrl">
                        <?php $this->renderPartial('tables/_teachersTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="3" heading="Користувачі без ролі">
                    <div ng-controller="withoutRolesTableCtrl">
                        <?php $this->renderPartial('tables/_withoutRolesTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="4" heading="Адміністратори">
                    <div ng-controller="adminsTableCtrl">
                        <?php $this->renderPartial('tables/_adminsTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="5" heading="Бухгалтери">
                    <div ng-controller="accountantsTableCtrl">
                        <?php $this->renderPartial('tables/_accountantsTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="6" heading="Контент менеджери">
                    <div ng-controller="contentManagersTableCtrl">
                        <?php $this->renderPartial('tables/_contentManagersTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="7" heading="Викладачі">
                    <div ng-controller="teacherConsultantsTableCtrl">
                        <?php $this->renderPartial('tables/_teacherConsultantsTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="8" heading="Тренери">
                    <div ng-controller="tenantsTableCtrl">
                        <?php $this->renderPartial('tables/_tenantsTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="9" heading="Консультанти">
                    <div ng-controller="consultantsTableCtrl">
                        <?php $this->renderPartial('tables/_consultantsTable');?>
                    </div>
                </uib-tab>
                <uib-tab  index="10" heading="Tenants">
                    <div ng-controller="trainersTableCtrl">
                        <?php $this->renderPartial('tables/_trainersTable');?>
                    </div>
                </uib-tab>
            </uib-tabset>
        </div>
    </div>
</div>





