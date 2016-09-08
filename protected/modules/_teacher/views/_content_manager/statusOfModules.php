<div class="panel panel-default" ng-controller="statusOfModulesCtrl">
    <div class="panel-body">
        <uib-tabset active="0">
            <uib-tab index="0" heading="Всі модулі">
                <?php $this->renderPartial('/_content_manager/_allModules', array('filter_id' => '0','id'=>$id));?>
            </uib-tab>
            <uib-tab index="1" heading="Модулі без відео">
                <?php $this->renderPartial('/_content_manager/_modulesWithoutVideos',array('filter_id'=>'1','id'=>$id)); ?>
            </uib-tab>
            <uib-tab index="2" heading="Модулі без тестів">
                <?php $this->renderPartial('/_content_manager/_modulesWithoutTests',array('filter_id'=>'2','id'=>$id)); ?>
            </uib-tab>
            <uib-tab index="3" heading="Модулі без тестів і відео">
                <?php $this->renderPartial('/_content_manager/_modulesWithoutTestsAndVideos',array('filter_id'=>'3','id'=>$id)); ?>
            </uib-tab>
        </uib-tabset>

    </div>
</div>