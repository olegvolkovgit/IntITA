<?php
/* @var $model Course */
?>
<div class="paymentsForm">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => '#',
        'id' => 'payments-form',
        'enableAjaxValidation' => false,
    )); ?>
    <input value="1" type="hidden" name="schema"/>
    <input value="Online" type="hidden" name="type" id="type"/>

    <?php $this->renderPartial('_onlinePaymentsScheme', array('model' => $model)); ?>

    <?php $this->renderPartial('_offlinePaymentsForm', array('model' => $model)); ?>

    <div class="markAndButton">
        <div class="markCourse">
            <span class="colorP"><?php echo Yii::t('course', '0203'); ?> </span>
                            <span>
                                <?php echo CommonHelper::getRating($model->rating); ?>
                            </span>
        </div>
        <div class="startCourse">
            <?php
            if (Yii::app()->user->isGuest) {
                echo CHtml::button(Yii::t('course', '0328'), array('id' => "paymentButton",
                    'onclick' => 'openSignIn();'));
            } else {
                if ($model->status != 0) {
                    ?>
                    <a ng-cloak ng-if="modulesProgress.isPaidCourse==false" id="paymentButton"
                       onclick="redirectToProfile()"
                       href="<?php echo Yii::app()->createUrl('/_teacher/cabinet/index', array(
                           'scenario' => 'payCourse',
                           'receiver' => 0,
                           'course' => $model->course_ID
                       )); ?>"><?php echo Yii::t('course', '0328'); ?>
                    </a>
                    <?php
                }
            } ?>
        </div>
    </div>
    <?php $this->endWidget();?>
</div>

<script>
    $(function () {
        $('input:radio[name="payment"]').filter('[value="1"]').attr('checked', true);
    });
    function redirectToProfile() {
        schema = $('input:radio[name="payment"]:checked').val();
        type = $('#type').val();
        $.cookie('courseSchema', schema, {'path': "/"});
        $.cookie('agreementType', type, {'path': "/"});
    }
</script>
