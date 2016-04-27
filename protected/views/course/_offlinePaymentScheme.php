<?php
/**
 * @var $model Course
 */
$price = $model->priceOffline();
?>
<div class="spoilerBodyOffline">
    <div class="paymentsListOdd">
        <input id='firstRadioOffline' type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::ADVANCE?>">
        <?php $this->renderPartial('_advancePaymentSchema', array(
            'model' => $model,
            'price' => $price,
            'discount' => 30
        )); ?>
    </div>

    <div class="paymentsListEven">
        <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::BASE_TWO_PAYS?>">
        <?php $this->renderPartial('_basePaymentSchema', array(
            'image1' => StaticFilesHelper::createPath('image', 'course', 'coins.png'),
            'image2' => StaticFilesHelper::createPath('image', 'course', 'checkCoins.png'),
            'model' => $model,
            'price' => $price,
            'number' => 2,
            'discount' => 10
        )); ?>
    </div>

    <div class="paymentsListOdd">
        <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::BASE_FOUR_PAYS?>">
        <?php $this->renderPartial('_basePaymentSchema', array(
            'image1' => StaticFilesHelper::createPath('image', 'course', 'moreCoins.png'),
            'image2' => StaticFilesHelper::createPath('image', 'course', 'checkMoreCoins.png'),
            'model' => $model,
            'price' => $price,
            'number' => 4,
            'discount' => 8
        )); ?>
    </div>

    <div class="paymentsListEven">
        <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::MONTHLY?>">
        <?php $this->renderPartial('_monthlyPaymentSchema', array('model' => $model, 'price' => $price)); ?>
    </div>

    <div class="paymentsListOdd">
        <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::CREDIT_TWO_YEARS?>">
        <?php $this->renderPartial('_creditPaymentSchema', array('model' => $model, 'price' => $price,
            'year' => 2)); ?>
    </div>

    <div class="paymentsListEven">
        <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::CREDIT_THREE_YEARS?>">
        <?php $this->renderPartial('_creditPaymentSchema', array('model' => $model, 'price' => $price,
            'year' => 3)); ?>
    </div>

    <div class="paymentsListOdd">
        <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::CREDIT_FOUR_YEARS?>">
        <?php $this->renderPartial('_creditPaymentSchema', array('model' => $model, 'price' => $price,
            'year' => 4)); ?>
    </div>

    <div class="paymentsListEven">
        <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::CREDIT_FIVE_YEARS?>">
        <?php $this->renderPartial('_creditPaymentSchema', array('model' => $model, 'price' => $price,
            'year' => 5)); ?>
    </div>
</div>
