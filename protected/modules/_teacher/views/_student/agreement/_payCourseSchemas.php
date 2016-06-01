<?php
/**
 * @var $model Course
 * @var $price int
 * @var $scenario string
  * @var $offerScenario string
 * @var $schema integer
 * @var $isSelected bool
 */
$schema = isset(Yii::app()->request->cookies['courseSchema']) ? Yii::app()->request->cookies['courseSchema']->value
    : '0';
?>
<div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-body" style="margin-left: 30px; margin-top: 20px">
            <div class="col-md-7">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'action' => '#',
                'method' => 'post',
                'enableAjaxValidation' => false,
            )); ?>
            <?php
            if ($price == 0) {
                echo Yii::t('courses', '0147') . ' '; ?>
                <span class="colorGreen"><?= Yii::t('module', '0421'); ?></span>
                <?php
            } else {
                ?>
                <div id="rowRadio">
                    <div class="paymentsListOdd">
                        <input type="radio" class="paymentPlan_value" name="payment<?=$scenario?>"
                               value="<?= PaymentScheme::ADVANCE ?>">
                        <?php $this->renderPartial('/_student/schemas/_advancePaymentSchema', array(
                            'model' => $model,
                            'price' => $price,
                            'discount' => 30
                        )); ?>
                    </div>

                    <div class="spoilerBody">
                        <div class="paymentsListEven">
                            <input type="radio" class="paymentPlan_value" name="payment<?=$scenario?>"
                                   value="<?= PaymentScheme::BASE_TWO_PAYS ?>">
                            <?php $this->renderPartial('/_student/schemas/_basePaymentSchema', array(
                                'image1' => StaticFilesHelper::createPath('image', 'course', 'coins.png'),
                                'image2' => StaticFilesHelper::createPath('image', 'course', 'checkCoins.png'),
                                'model' => $model,
                                'price' => $price,
                                'number' => 2,
                                'discount' => 10
                            )); ?>
                        </div>

                        <div class="paymentsListOdd">
                            <input type="radio" class="paymentPlan_value" name="payment<?=$scenario?>"
                                   value="<?= PaymentScheme::BASE_FOUR_PAYS ?>">
                            <?php $this->renderPartial('/_student/schemas/_basePaymentSchema', array(
                                'image1' => StaticFilesHelper::createPath('image', 'course', 'moreCoins.png'),
                                'image2' => StaticFilesHelper::createPath('image', 'course', 'checkMoreCoins.png'),
                                'model' => $model,
                                'price' => $price,
                                'number' => 4,
                                'discount' => 8
                            )); ?>
                        </div>

                        <div class="paymentsListEven">
                            <input type="radio" class="paymentPlan_value" name="payment<?=$scenario?>"
                                   value="<?= PaymentScheme::MONTHLY ?>">
                            <?php $this->renderPartial('/_student/schemas/_monthlyPaymentSchema', array('model' => $model, 'price' => $price)); ?>
                        </div>

                        <div class="paymentsListOdd">
                            <input type="radio" class="paymentPlan_value" name="payment<?=$scenario?>"
                                   value="<?= PaymentScheme::CREDIT_TWO_YEARS ?>">
                            <?php $this->renderPartial('/_student/schemas/_creditPaymentSchema', array('model' => $model, 'price' => $price,
                                'year' => 2)); ?>
                        </div>

                        <div class="paymentsListEven">
                            <input type="radio" class="paymentPlan_value" name="payment<?=$scenario?>"
                                   value="<?= PaymentScheme::CREDIT_THREE_YEARS ?>">
                            <?php $this->renderPartial('/_student/schemas/_creditPaymentSchema', array('model' => $model, 'price' => $price,
                                'year' => 3)); ?>
                        </div>

                        <div class="paymentsListOdd">
                            <input type="radio" class="paymentPlan_value" name="payment<?=$scenario?>"
                                   value="<?= PaymentScheme::CREDIT_FOUR_YEARS ?>">
                            <?php $this->renderPartial('/_student/schemas/_creditPaymentSchema', array('model' => $model, 'price' => $price,
                                'year' => 4)); ?>
                        </div>

                        <div class="paymentsListEven">
                            <input type="radio" class="paymentPlan_value" name="payment<?=$scenario?>"
                                   value="<?= PaymentScheme::CREDIT_FIVE_YEARS ?>">
                            <?php $this->renderPartial('/_student/schemas/_creditPaymentSchema', array('model' => $model, 'price' => $price,
                                'year' => 5)); ?>
                        </div>
                    </div>
                    <input name="course" type="hidden" value="<?php echo $model->course_ID; ?>">
                    <input name="user" type="hidden" value="<?php echo Yii::app()->user->getId(); ?>">
                    <input name="educationForm" type="hidden" value="<?= $scenario ?>">
                </div>
            <?php }
            $this->endWidget(); ?>
                </div>
            <div class="col-md-3">
                <?php if ($price > 0) { ?>
                    <br>
                    <button class="btn btn-primary" type="button"
                            onclick="createAccount('<?php echo Yii::app()->createUrl('/_teacher/_student/student/newCourseAgreement'); ?>',
                                '<?php echo $model->course_ID; ?>', '0', 'Course', '<?=$offerScenario?>',
                                '', '<?=$scenario;?>')"><?php echo Yii::t('profile', '0261'); ?></button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php if($schema != 0 && $isSelected){?>
<script>
    $jq(function () {
        $jq('input:radio[name="payment<?=$scenario;?>"]').filter('[value="<?=$schema;?>"]').attr('checked', true);
        $jq.cookie('courseSchema', 0, {'path': "/"});
        $jq.cookie('agreementType', 'Online', {'path': "/"});
    });
</script>
<?php }?>




