<?php
/**
 * @var $post Module
 * @var $isPaidModule bool
 * @var $isPaidCourse bool
 */
if (!Yii::app()->user->isGuest) {
    if (Yii::app()->user->model->isAdmin()) $post->setScenario('canedit');
}
?>
<div class="leftModule">
    <div class="headerLeftModule">
        <?php
        if (!Yii::app()->user->isGuest && Yii::app()->user->model->isAdmin()) {
            $this->renderPartial('_moduleInfoForAdmin', array('post' => $post));
        } else {
            $this->renderPartial('_moduleInfo', array('post' => $post));
        }
        ?>
        <div class="paymentsButtons">
            <div class="startModule">
                <input ng-if="moduleProgress.canPayModule && !((moduleStatus=='payable') || (moduleStatus=='paid') && (moduleStatus!='no_agreement'))"
                       type="button" ng-cloak
                       ng-class="{'expired': (moduleStatus=='expired'), 'warning': (moduleStatus=='delay'), 'paymentButton' : true}"
                       ng-click="redirectToCabinet('payModule',moduleProgress.module.module_ID,selectedScheme)"
                       ng-value="(moduleStatus=='delay' || moduleStatus=='expired')? '<?php echo Yii::t('module', '0956'); ?> />':'<?php echo Yii::t('module', '0279'); ?>'">
            </div>
            <div  class="startCourse">
                <input ng-if="moduleProgress.course.canPayCourse && !((courseStatus=='payable') || (courseStatus=='paid') && (courseStatus!='no_agreement'))"
                       type="button" ng-cloak
                       ng-class="{'expired': (courseStatus=='expired'), 'warning': (courseStatus=='delay'), 'paymentButton' : true}"
                       ng-click="payService('payCourse',moduleProgress.course.course_ID,'<?php echo Yii::app()->user->isGuest ?>')"
                       ng-value="(courseStatus=='delay' || courseStatus=='expired')? '<?php echo Yii::t('module', '0957'); ?> />':'<?php echo Yii::t('course', '0328'); ?>'">
            </div>
        </div>
        <?php $this->renderPartial('_lectures', array('module' => $post,"idCourse" => $idCourse)); ?>
    </div>
</div>