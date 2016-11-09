<?php
/**
 * @var $model Module
 * @var $schema int
 * @var $type string
 * @var $course int
 * @var $offerScenario string
 */
?>
<div class="panel panel-default" ng-controller="paymentsCtrl">
    <div class="panel-body">
        <div class="tab-content">
            <uib-tabset active="0" >
                <uib-tab  index="0" heading="Навчання онлайн">
                    <?php $this->renderPartial('/_student/agreement/_paymentsModule', array(
                        'scenario' => 'online',
                        'model' => $model,
                        'price' => $model->getBasePrice(),
                        'offerScenario' => $offerScenario,
                        'educForm' => EducationForm::ONLINE
                    )); ?>
                </uib-tab>
                <uib-tab  index="1" heading="Навчання офлайн">
                    <?php $this->renderPartial('/_student/agreement/_paymentsModule', array(
                        'scenario' => 'offline',
                        'model' => $model,
                        'price' => $model->priceOffline(),
                        'offerScenario' => $offerScenario,
                        'educForm' => EducationForm::OFFLINE
                    )); ?>
                </uib-tab>
            </uib-tabset>
        </div>
    </div>
</div>
