<?php
/**
 * @var $course Course
 * @var $type string
 * @var $offerScenario string
 */
$price = $course->getBasePrice();
?>
<div class="panel panel-default" ng-controller="paymentsCtrl">
    <div class="panel-body">
        <div class="tab-content">
            <uib-tabset active="active" >
                <uib-tab  index="0" heading="Навчання онлайн">
                    <payments-scheme data-schemes="onlineSchemeData" data-other-schemes='offlineSchemeData'></payments-scheme>
                </uib-tab>
                <uib-tab  index="1" heading="Навчання офлайн">
                    <payments-scheme data-schemes="offlineSchemeData" data-other-schemes='onlineSchemeData'></payments-scheme>
                </uib-tab>
            </uib-tabset>
            <br>
            <div class="col-md-3">
                <button class="btn btn-primary" type="button"
                        ng-click="createAccount(
                            '<?php echo Yii::app()->createUrl('/_teacher/_student/student/newCourseAgreement'); ?>',
                            '<?php echo $course->course_ID; ?>',
                            '0',
                            'Course',
                            '<?= $offerScenario ?>',
                            '')">Продовжити
                </button>
            </div>
        </div>
    </div>
</div>


