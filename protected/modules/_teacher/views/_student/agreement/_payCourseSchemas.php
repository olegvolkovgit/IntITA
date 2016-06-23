<?php
/**
 * @var $model Course
 * @var $price int
 * @var $scenario string
 * @var $offerScenario string
 * @var $schema integer
 * @var $isSelected bool
 * @var $educForm integer
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
                            <input id='firstRadioOffline' type="radio" class="paymentPlan_value" name="payment<?=$educForm?>"
                                   value="<?= PaymentScheme::ADVANCE ?>">
                            <?php
                            $this->widget('PaymentSchemaWidget', array(
                                'billableObject' => $model,
                                'discount' => 30,
                                'schema' => PaymentScheme::getSchema(PaymentScheme::ADVANCE, $educForm),
                                'educForm' => $scenario,
                                'view' => '_advancePaymentSchema',
                                'price' => $price
                            ));
                            ?>
                        </div>

                        <div class="paymentsListEven">
                            <input type="radio" class="paymentPlan_value" name="payment<?=$educForm?>"
                                   value="<?= PaymentScheme::BASE_TWO_PAYS ?>">
                            <?php
                            $this->widget('PaymentSchemaWidget', array(
                                'billableObject' => $model,
                                'discount' => 10,
                                'schema' => PaymentScheme::getSchema(PaymentScheme::BASE_TWO_PAYS, $educForm),
                                'educForm' => $scenario,
                                'view' => '_basePaymentSchema',
                                'price' => $price
                            ));
                            ?>
                        </div>

                        <div class="paymentsListOdd">
                            <input type="radio" class="paymentPlan_value" name="payment<?=$educForm?>"
                                   value="<?= PaymentScheme::BASE_FOUR_PAYS ?>">
                            <?php
                            $this->widget('PaymentSchemaWidget', array(
                                'billableObject' => $model,
                                'discount' => 8,
                                'schema' => PaymentScheme::getSchema(PaymentScheme::BASE_FOUR_PAYS, $educForm),
                                'educForm' => $scenario,
                                'view' => '_basePaymentSchema',
                                'price' => $price
                            ));
                            ?>
                        </div>

                        <div class="paymentsListEven">
                            <input type="radio" class="paymentPlan_value" name="payment<?=$educForm?>"
                                   value="<?= PaymentScheme::MONTHLY ?>">
                            <?php
                            $this->widget('PaymentSchemaWidget', array(
                                'billableObject' => $model,
                                'discount' => 8,
                                'schema' => PaymentScheme::getSchema(PaymentScheme::MONTHLY, $educForm),
                                'educForm' => $scenario,
                                'view' => '_monthlyPaymentSchema',
                                'price' => $price
                            ));
                            ?>
                        </div>

                        <div class="paymentsListOdd">
                            <input type="radio" class="paymentPlan_value" name="payment<?=$educForm?>"
                                   value="<?= PaymentScheme::CREDIT_TWO_YEARS ?>">
                            <?php
                            $this->widget('PaymentSchemaWidget', array(
                                'billableObject' => $model,
                                'schema' => PaymentScheme::getSchema(PaymentScheme::CREDIT_TWO_YEARS, $educForm),
                                'educForm' => $scenario,
                                'view' => '_creditPaymentSchema',
                                'price' => $price
                            ));
                            ?>
                        </div>

                        <div class="paymentsListEven">
                            <input type="radio" class="paymentPlan_value" name="payment<?=$educForm?>"
                                   value="<?= PaymentScheme::CREDIT_THREE_YEARS ?>">
                            <?php
                            $this->widget('PaymentSchemaWidget', array(
                                'billableObject' => $model,
                                'schema' => PaymentScheme::getSchema(PaymentScheme::CREDIT_THREE_YEARS, $educForm),
                                'educForm' => $scenario,
                                'view' => '_creditPaymentSchema',
                                'price' => $price
                            ));
                            ?>
                        </div>

                        <div class="paymentsListOdd">
                            <input type="radio" class="paymentPlan_value" name="payment<?=$educForm?>"
                                   value="<?= PaymentScheme::CREDIT_FOUR_YEARS ?>">
                            <?php
                            $this->widget('PaymentSchemaWidget', array(
                                'billableObject' => $model,
                                'schema' => PaymentScheme::getSchema(PaymentScheme::CREDIT_FOUR_YEARS, $educForm),
                                'educForm' => $scenario,
                                'view' => '_creditPaymentSchema',
                                'price' => $price
                            ));
                            ?>
                        </div>

                        <div class="paymentsListEven">
                            <input type="radio" class="paymentPlan_value" name="payment<?=$educForm?>"
                                   value="<?= PaymentScheme::CREDIT_FIVE_YEARS ?>">
                            <?php
                            $this->widget('PaymentSchemaWidget', array(
                                'billableObject' => $model,
                                'schema' => PaymentScheme::getSchema(PaymentScheme::CREDIT_FIVE_YEARS, $educForm),
                                'educForm' => $scenario,
                                'view' => '_creditPaymentSchema',
                                'price' => $price
                            ));
                            ?>
                        </div>
                        <input name="course" type="hidden" value="<?php echo $model->course_ID; ?>">
                        <input name="user" type="hidden" value="<?php echo Yii::app()->user->getId(); ?>">
                        <input name="educationForm" type="hidden" value="<?= $educForm ?>">
                    </div>
                <?php }
                $this->endWidget(); ?>
            </div>
            <div class="col-md-3">
                <?php if ($price > 0) { ?>
                    <br>
                    <button class="btn btn-primary" type="button"
                            onclick="createAccount(
                                '<?php echo Yii::app()->createUrl('/_teacher/_student/student/newCourseAgreement'); ?>',
                                '<?php echo $model->course_ID; ?>',
                                '0',
                                'Course',
                                '<?= $offerScenario ?>',
                                '', '<?= $educForm; ?>')"><?php echo Yii::t('profile', '0261'); ?></button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php if ($schema != 0 && $isSelected) { ?>
    <script>
        $jq(function () {
            $jq('input:radio[name="payment<?=$educForm;?>"]').filter('[value="<?=$schema;?>"]').attr('checked', true);
            $jq.cookie('courseSchema', 0, {'path': "/"});
            $jq.cookie('agreementType', 'Online', {'path': "/"});
        });
    </script>
<?php } ?>




