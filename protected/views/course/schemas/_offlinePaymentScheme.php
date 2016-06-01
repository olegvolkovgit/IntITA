<?php
/**
 * @var $model Course
 */
$price = $model->priceOffline();
?>
<div class="spoilerBodyOffline">
    <div class="paymentsListOdd">
        <input id='firstRadioOffline' type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::ADVANCE?>">
        <?php
        $this->widget('PaymentSchemaWidget',array(
            'billableObject' => $model,
            'discount' => 30,
            'schema' => new AdvancePaymentSchema(30, 1),
            'educForm' => 'offline',
            'view' => '_advancePaymentSchema',
            'price' => $price
        ));
        ?>
    </div>

    <div class="paymentsListEven">
        <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::BASE_TWO_PAYS?>">
        <?php
        $this->widget('PaymentSchemaWidget',array(
            'billableObject' => $model,
            'discount' => 10,
            'schema' => new BasePaymentSchema(2),
            'educForm' => 'offline',
            'view' => '_basePaymentSchema',
            'price' => $price
        ));
        ?>
    </div>

    <div class="paymentsListOdd">
        <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::BASE_FOUR_PAYS?>">
        <?php
        $this->widget('PaymentSchemaWidget',array(
            'billableObject' => $model,
            'discount' => 8,
            'schema' => new BasePaymentSchema(4),
            'educForm' => 'offline',
            'view' => '_basePaymentSchema',
            'price' => $price
        ));
        ?>
    </div>

    <div class="paymentsListEven">
        <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::MONTHLY?>">
        <?php
        $this->widget('PaymentSchemaWidget',array(
            'billableObject' => $model,
            'discount' => 8,
            'schema' => new AdvancePaymentSchema(0, 12),
            'educForm' => 'offline',
            'view' => '_monthlyPaymentSchema',
            'price' => $price
        ));
        ?>
    </div>

    <div class="paymentsListOdd">
        <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::CREDIT_TWO_YEARS?>">
        <?php
        $this->widget('PaymentSchemaWidget',array(
            'billableObject' => $model,
            'schema' => PaymentScheme::getSchema(PaymentScheme::CREDIT_TWO_YEARS),
            'educForm' => 'offline',
            'view' => '_creditPaymentSchema',
            'price' => $price
        ));
        ?>
    </div>

    <div class="paymentsListEven">
        <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::CREDIT_THREE_YEARS?>">
        <?php
        $this->widget('PaymentSchemaWidget',array(
            'billableObject' => $model,
            'schema' => PaymentScheme::getSchema(PaymentScheme::CREDIT_THREE_YEARS),
            'educForm' => 'offline',
            'view' => '_creditPaymentSchema',
            'price' => $price
        ));
        ?>
    </div>

    <div class="paymentsListOdd">
        <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::CREDIT_FOUR_YEARS?>">
        <?php
        $this->widget('PaymentSchemaWidget',array(
            'billableObject' => $model,
            'schema' => PaymentScheme::getSchema(PaymentScheme::CREDIT_FOUR_YEARS),
            'educForm' => 'offline',
            'view' => '_creditPaymentSchema',
            'price' => $price
        ));
        ?>
    </div>

    <div class="paymentsListEven">
        <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::CREDIT_FIVE_YEARS?>">
        <?php
        $this->widget('PaymentSchemaWidget',array(
            'billableObject' => $model,
            'schema' => PaymentScheme::getSchema(PaymentScheme::CREDIT_FIVE_YEARS),
            'educForm' => 'offline',
            'view' => '_creditPaymentSchema',
            'price' => $price
        ));
        ?>
    </div>
</div>
