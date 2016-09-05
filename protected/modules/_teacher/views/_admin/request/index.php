<div class="panel panel-default">
    <div class="panel-body">
        <!-- Tab panes -->
        <div class="tab-content">
            <uib-tabset active="0" >
                <uib-tab index="0" heading="Очікують підтвердження">
                    <?php $this->renderPartial('_activeRequests');?>
                </uib-tab>
                <uib-tab index="1" heading="Підтверджені">
                    <?php $this->renderPartial('_approvedRequests');?>
                </uib-tab>
                <uib-tab index="2" heading="Відхилені запити">
                    <?php $this->renderPartial('_deletedRequests');?>
                </uib-tab>
                <?php if(Yii::app()->user->model->isContentManager()){ ?>
                    <uib-tab index="3" heading="Відхилені ревізії">
                        <?php $this->renderPartial('_rejectedRevisionRequests');?>
                    </uib-tab>
                <?php } ?>
            </uib-tabset>
        </div>
    </div>
</div>