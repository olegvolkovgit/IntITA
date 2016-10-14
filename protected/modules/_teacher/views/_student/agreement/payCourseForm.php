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
                    <payments-scheme-online data-course-id="<?php echo $course->course_ID;?>"></payments-scheme-online>
                </uib-tab>
                <uib-tab  index="1" heading="Навчання офлайн">
                    <payments-scheme-offline data-course-id="<?php echo $course->course_ID;?>"></payments-scheme-offline>
                </uib-tab>
            </uib-tabset>
            <br>
            <div class="col-md-3">
                <?php if ($price > 0) { ?>
                <button class="btn btn-primary" type="button"
                        ng-click="createAccount(
                            '<?php echo Yii::app()->createUrl('/_teacher/_student/student/newCourseAgreement'); ?>',
                            '<?php echo $course->course_ID; ?>',
                            '0',
                            'Course',
                            '<?= $offerScenario ?>',
                            '')"><?php echo Yii::t('profile', '0261'); ?>
                </button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


