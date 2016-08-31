<div class="panel panel-default" ng-controller="permissionsCtrl">
    <div class="panel-body">
        <uib-tabset active="0" >
            <uib-tab  index="0" heading="Призначити автора модуля" select="reload()">
                <?php $this->renderPartial('_addTeacherAccess');?>
            </uib-tab>
            <uib-tab index="1" heading="Скасувати права автора модуля" select="reload()">
                <?php $this->renderPartial('_cancelTeacherAccess');?>
            </uib-tab>
            <uib-tab  index="2" heading="Призначити консультанта" select="reload()" >
                <?php $this->renderPartial('_addConsultantModule');?>
            </uib-tab>
            <uib-tab  index="3" heading="Скасувати права консультанта" select="reload()" >
                <?php $this->renderPartial('_cancelConsultantModule');?>
            </uib-tab>
        </uib-tabset>
    </div>
</div>
