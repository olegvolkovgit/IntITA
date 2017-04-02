<div class="panel panel-default" ng-controller="roleAttributesCtrl">
    <div class="panel-body">
        <uib-tabset active="0" >
            <uib-tab  index="0" heading="Призначити автора модуля" select="reload()">
                <?php $this->renderPartial('/_content_manager/addForms/_addModuleToAuthor', array(), false, true);?>
            </uib-tab>
            <uib-tab index="1" heading="Скасувати модуль у автора" select="reload()">
                <?php $this->renderPartial('/_content_manager/addForms/_cancelAuthorModule');?>
            </uib-tab>
        </uib-tabset>
    </div>
</div>