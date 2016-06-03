<?php
/**
 * @var $model Course
 */
?>

<div id="rowRadio">
    <div class="spoilerBodyOnline">
        <div class="paymentsListOdd">
            <input id='firstRadioOnline' type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::ADVANCE?>">
            <?php
            $this->widget('PaymentSchemaWidget',array(
                'billableObject' => $model,
                'discount' => 30,
                'schema' => PaymentScheme::getSchema(PaymentScheme::ADVANCE, EducationForm::ONLINE),
                'educForm' => 'online',
                'view' => '_advancePaymentSchema'
            ));
            ?>
        </div>

        <div class="paymentsListEven">
            <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::BASE_TWO_PAYS?>">
            <?php
            $this->widget('PaymentSchemaWidget',array(
                'billableObject' => $model,
                'discount' => 10,
                'schema' => PaymentScheme::getSchema(PaymentScheme::BASE_TWO_PAYS, EducationForm::ONLINE),
                'educForm' => 'online',
                'view' => '_basePaymentSchema'
            ));
            ?>
        </div>

        <div class="paymentsListOdd">
            <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::BASE_FOUR_PAYS?>">
            <?php
            $this->widget('PaymentSchemaWidget',array(
                'billableObject' => $model,
                'discount' => 8,
                'schema' => PaymentScheme::getSchema(PaymentScheme::BASE_FOUR_PAYS, EducationForm::ONLINE),
                'educForm' => 'online',
                'view' => '_basePaymentSchema'
            ));
            ?>
        </div>

        <div class="paymentsListEven">
            <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::MONTHLY?>">
            <?php
            $this->widget('PaymentSchemaWidget',array(
                'billableObject' => $model,
                'schema' => PaymentScheme::getSchema(PaymentScheme::MONTHLY, EducationForm::ONLINE),
                'educForm' => 'online',
                'view' => '_monthlyPaymentSchema'
            ));
            ?>
        </div>

        <div class="paymentsListOdd">
            <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::CREDIT_TWO_YEARS?>">
            <?php
            $this->widget('PaymentSchemaWidget',array(
                'billableObject' => $model,
                'schema' => PaymentScheme::getSchema(PaymentScheme::CREDIT_TWO_YEARS, EducationForm::ONLINE),
                'educForm' => 'online',
                'view' => '_creditPaymentSchema'
            ));
            ?>
        </div>

        <div class="paymentsListEven">
            <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::CREDIT_THREE_YEARS?>">
            <?php
            $this->widget('PaymentSchemaWidget',array(
                'billableObject' => $model,
                'schema' => PaymentScheme::getSchema(PaymentScheme::CREDIT_THREE_YEARS, EducationForm::ONLINE),
                'educForm' => 'online',
                'view' => '_creditPaymentSchema'
            ));
            ?>
        </div>

        <div class="paymentsListOdd">
            <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::CREDIT_FOUR_YEARS?>">
            <?php
            $this->widget('PaymentSchemaWidget',array(
                'billableObject' => $model,
                'schema' => PaymentScheme::getSchema(PaymentScheme::CREDIT_FOUR_YEARS, EducationForm::ONLINE),
                'educForm' => 'online',
                'view' => '_creditPaymentSchema',
            ));
            ?>
        </div>

        <div class="paymentsListEven">
            <input type="radio" class="paymentPlan_value" name="payment" value="<?=PaymentScheme::CREDIT_FIVE_YEARS?>">
            <?php
            $this->widget('PaymentSchemaWidget',array(
                'billableObject' => $model,
                'schema' => PaymentScheme::getSchema(PaymentScheme::CREDIT_FIVE_YEARS, EducationForm::ONLINE),
                'educForm' => 'online',
                'view' => '_creditPaymentSchema',
            ));
            ?>
        </div>
    </div>
</div>