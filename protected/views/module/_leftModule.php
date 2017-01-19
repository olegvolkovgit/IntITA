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
                <a ng-if="module.canPayModule" id="paymentButtonModule"
                   ng-click="payService('payModule',module.module.module_ID,'<?php echo Yii::app()->user->isGuest ?>')">
                    <?php echo Yii::t('module', '0279'); ?>
                </a>
            </div>
            <div  class="startCourse">
                <a ng-if="module.canPayCourse" id="paymentButtonCourse"
                   ng-click="payService('payCourse',module.idCourse,'<?php echo Yii::app()->user->isGuest ?>')">
                    <?php echo Yii::t('course', '0328'); ?>
                </a>
            </div>
        </div>
        <?php $this->renderPartial('_lectures', array('module' => $post,"idCourse" => $idCourse)); ?>
    </div>
</div>