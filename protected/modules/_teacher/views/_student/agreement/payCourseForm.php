<?php
/**
 * @var $course Course
 * @var $type string
 * @var $offerScenario string
 */
$price = $course->getBasePrice();
?>
<h2><?php echo $course->getTitle() ?></h2>
<div class="panel panel-default" ng-controller="paymentsCtrl">
    <div class="panel-body">
        <div class="tab-content" ng-cloak>
            <div style="overflow: hidden">
            <div style="width: 50%; float: right">
                <em>*Зверніть увагу! Заключайте договір по офлайн формі навчання лише у тому випадку,
                    коли це було обговорено з адміністрацією по данному контенту
                </em>
            </div>
            </div>
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
                            '<?php echo Yii::app()->createUrl('/_teacher/_student/student/newCourseAgreement'); ?>',
                            '<?php echo $course->course_ID; ?>',
                            '0',
                            'Course',
                            '<?= $offerScenario ?>',
                            '',
                            '',
                            selectedScheme)">Продовжити
                </button>
            </div>
        </div>
    </div>
</div>


