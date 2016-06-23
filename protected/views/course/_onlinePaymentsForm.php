<?php
/* @var $model Course */
if ($model->isReady()   ) {
    $schema = PaymentScheme::getSchema(PaymentScheme::ADVANCE, EducationForm::ONLINE);
    $price = round($schema->getSumma($model));
    if ($price == 0) {
        echo Yii::t('courses', '0147') . ' '; ?>
        <span class="colorGreen"><?= Yii::t('module', '0421'); ?></span>
        <?php
    } else {
        ?>
        <span class="spoilerLinks"
              onclick="paymentSpoiler('<?php echo Yii::t('course', '0414'); ?>', '<?php echo Yii::t('course', '0415'); ?>', 'Online')">
        <span id="spoilerClickOnline"><?php echo Yii::t('course', '0414'); ?></span>
        <span id="spoilerTriangleOnline"> &#9660;</span></span>
    <?php }
    if ($price != 0) {
        ?>
        <table class="mainPay">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td>
                                <div class="numbers" id="numbersFirstOnline">
                                            <span
                                                class="coursePriceStatus1"><?php echo Yii::t('courses', '0322').sprintf ("%01.2f", round($price * 1.3, 2)); ?>
                                            </span>
                                    &nbsp
                                            <span
                                                class="coursePriceStatus2"><?php echo Yii::t('courses', '0322').sprintf ("%01.2f", round($price, 2)); ?>
                                            </span>
                                            <span id="discount">
                                                <img style="text-align:right"
                                                     src="<?php echo StaticFilesHelper::createPath('image', 'course', 'pig.png') ?>"/>
                                                (<?php echo Yii::t('courses', '0144') . ' - 30%)'; ?>
                                            </span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    <?php }
} ?>
<div class="paymentsForm">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => '#',
        'id' => 'payments-form',
        'enableAjaxValidation' => false,
    )); ?>
    <input value="1" type="hidden" name="schema"/>
    <input value="Online" type="hidden" name="type" id="type"/>

    <?php $this->renderPartial('schemas/_onlinePaymentsScheme', array('model' => $model)); ?>

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
                if ($model->isReady()) {
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
    <?php $this->endWidget(); ?>
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
