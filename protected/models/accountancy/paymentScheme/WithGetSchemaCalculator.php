<?php

trait WithGetSchemaCalculator {

    /**
     * @param EducationForm $educationForm
     * @return IPaymentCalculator
     */
    public function getSchemaCalculator(EducationForm $educationForm) {
        $schema = null;
        if ($this->loan > 0) {
            $schema = new LoanPaymentSchema($this->loan, $this->payCount, $educationForm);
        } else {
            if ($this->monthpay > 0) {
                $schema = new BasePaymentSchema($this->payCount, $educationForm);
            } else {
                $schema = new AdvancePaymentSchema($this->discount, $this->payCount, $educationForm);
            }
        }
        return $schema;
    }

}