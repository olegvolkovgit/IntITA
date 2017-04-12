<div class="panel panel-default" ng-controller="roleAttributesCtrl">
    <div class="panel-body">
        <uib-tabset active="0" >
            <uib-tab  index="0" heading="Призначити модуль викладачу" select="reload()" >
                <?php $this->renderPartial('/_content_manager/addForms/_addModuleToTeacherConsultant');?>
            </uib-tab>
            <uib-tab  index="1" heading="Скасувати модуль у викладача" select="reload()" >
                <?php $this->renderPartial('/_content_manager/addForms/_cancelTeacherConsultantModule');?>
            </uib-tab>
        </uib-tabset>
    </div>
</div>
