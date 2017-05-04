<div class="panel panel-default" ng-controller="statusOfModulesCtrl">
    <div class="panel-body">
        <uib-tabset active="0">
            <uib-tab index="0" heading="Всі модулі" select="initModulesList()">
                <?php $this->renderPartial('/_content_manager/contentState/_allModules', array('filter_id' => '0','id'=>$id));?>
            </uib-tab>
            <uib-tab index="1" heading="Модулі без відео" select="initModuleWithoutVideos()">
                <?php $this->renderPartial('/_content_manager/contentState/_modulesWithoutVideos',array('filter_id'=>'1','id'=>$id)); ?>
            </uib-tab>
            <uib-tab index="2" heading="Модулі без тестів" select="initModuleWithoutTests()">
                <?php $this->renderPartial('/_content_manager/contentState/_modulesWithoutTests',array('filter_id'=>'2','id'=>$id)); ?>
            </uib-tab>
            <uib-tab index="3" heading="Модулі без тестів і відео" select="initModuleWithoutVideosAndTests()">
                <?php $this->renderPartial('/_content_manager/contentState/_modulesWithoutTestsAndVideos',array('filter_id'=>'3','id'=>$id)); ?>
            </uib-tab>
        </uib-tabset>

    </div>
</div>