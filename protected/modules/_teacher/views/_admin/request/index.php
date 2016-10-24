<div class="panel panel-default" ng-controller="requestsCtrl">
    <div class="panel-body">
        <!-- Nav tabs -->
        <uib-tabset  active="0">
            <uib-tab index="0" heading="Очікують підтвердження" select="initActiveRequests()">
                <?php $this->renderPartial('_activeRequests');?>
            </uib-tab>
            <uib-tab index="1" heading="Підтверджені" select="initApprovedRequests()">
                <?php $this->renderPartial('_approvedRequests');?>
            </uib-tab>
            <uib-tab index="2"  heading="Відхилені запити" select="initDeletedRequests()">
                <?php $this->renderPartial('_deletedRequests');?>
            </uib-tab>
            <?php if(Yii::app()->user->model->isContentManager()){ ?>
            <uib-tab index="3" heading="Відхилені ревізії" select="initRejectedRevisionRequests()">
                <?php $this->renderPartial('_rejectedRevisionRequests');?>
            </uib-tab>
            <?php } ?>
        </uib-tabset>
    </div>
</div>
