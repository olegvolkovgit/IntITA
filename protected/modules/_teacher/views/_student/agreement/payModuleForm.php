<?php
/**
 * @var $module Module
 * @var $type string
 * @var $offerScenario string
 */
$price = $module->getBasePrice();
?>
<h2><?php echo $module->getTitle() ?></h2>
<div class="panel panel-default" ng-controller="paymentsCtrl">
    <div class="panel-body">
        <div class="tab-content" ng-cloak>
            <div class="schemesBlock">
                <h3>Навчання онлайн</h3>
                <payments-scheme
                    data-content-id="contentId"
                    data-service-type="serviceType"
                    data-education-form="online"
                    data-schemes="onlineSchemeData"
                    data-selected-model-scheme="selectedScheme"
                    data-set-form="setForm"
                    data-set-scheme="schemeId"
                >
                </payments-scheme>
            </div>
            <div class="schemesBlock">
                <h3>Навчання офлайн</h3>
                <payments-scheme
                    data-content-id="contentId"
                    data-service-type="serviceType"
                    data-education-form="offline"
                    data-schemes="offlineSchemeData"
                    data-selected-model-scheme="selectedScheme"
                    data-set-form="setForm"
                    data-set-scheme="schemeId"
                >
                </payments-scheme>
            </div>
            <br>
            <div style="width:96%">
                <button class="schemesBlockButton btn btn-primary" type="button"
                        ng-click="createAccount(
                            '<?php echo Yii::app()->createUrl('/_teacher/_student/student/newModuleAgreement'); ?>',
                            '0',
                            '<?php echo $module->module_ID; ?>',
                            'Module',
                            '<?= $offerScenario ?>',
                            '',
                            '',
                            selectedScheme)">Продовжити
                </button>
            </div>
        </div>
    </div>
</div>
