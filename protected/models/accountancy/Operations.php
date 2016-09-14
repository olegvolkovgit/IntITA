<?php

class Operations {

    private $relatedModelsMapping = [
        'type_id' => 'type.description',
        'user_create' => 'userCreated.fullName'
    ];

    /* TODO */
    private function validateOperation($operation) {
        return true;
    }

    /**
     * @param $agreementId
     * @param array $invoices
     * @param $amount
     * @return Invoice[]
     * @throws Exception
     */
    private function getUnpaidInvoices($agreementId, $invoices, $amount) {
        $unpaidInvoices = [];
        if (!empty($invoices) && is_array($invoices)) {
            /* if we have invoices we should check if this invoices unpaid */

            $_invoices = [];
            foreach ($invoices as $invoice) {
                $_invoices[$invoice['id']] = $invoice['amount'];
            }

            $unpaidInvoices = Invoice::model()
                ->with('internalPayment')
                ->findAllByPk(array_keys($_invoices), 'agreement_id=:agreementId', [':agreementId' => $agreementId]);
            
            if (count($unpaidInvoices) !== count($invoices)) {
                throw new Exception("Invoices count doesn't match");
            }

            foreach ($unpaidInvoices as $invoice) {
                if ($invoice->getUnpaidSum() <= $_invoices[$invoice->id]['amount']) {
                    throw new Exception("Invoice $invoice->number already payed");
                }
            }

        } else {
            /* otherwise we should select invoices to cover the sum */
            $agreementInvoices = Invoice::model()
                ->with('internalPayment')
                ->findAll('agreement_id=:agreementId', [':agreementId' => $agreementId]);
            $index = 0;
            while ($amount >0 && $index < count($agreementInvoices)) {
                if ($agreementInvoices[$index]->getUnpaidSum() > 0 ) {
                    $unpaidInvoices[] = $agreementInvoices[$index];
                }
                $amount -= $agreementInvoices[$index]->getUnpaidSum();
                ++$index;
            }
        }

        return $unpaidInvoices;
    }

    public function getOperations($offset = 0, $limit = 10) {
        $criteria = new CDbCriteria([
            'offset' => $offset,
            'limit' => $limit
        ]);

        $operations = Operation::model()->with('type', 'userCreated')->findAll($criteria);
        $totalCount = Operation::model()->count($criteria);

        return [
            'count' => $totalCount,
            'rows' => AccountancyHelper::toAssocArray($operations, $this->relatedModelsMapping)
        ];
    }

    /**
     * @param $operation
     * @param IntITAUser $user
     * @return array|bool
     */
    public function performOperation($operation, $user) {
        $transaction = Yii::app()->db->beginTransaction();
        $result = ['status'=>'ok', 'message'=>[]];
        try {
            $externalPayment = ExternalPays::model()->with('internalPays')->findByPk($operation['sourceId']);
            $amount = min($operation['amount'], $externalPayment->getUnallocatedAmount());
            $operationInvoices = $this->getUnpaidInvoices($operation['agreementId'], $operation['invoices'], $amount);

            foreach ($operationInvoices as $invoice){
                $paymentAmount = min($invoice->summa, $amount, $externalPayment->amount);
                $resultMakePayment = $invoice->makePayment($externalPayment, $paymentAmount, $user);
                if ($resultMakePayment!== true) {
                    throw new Exception('Internal payment error ' . json_encode($resultMakePayment));
                }
                $amount -= $paymentAmount;
                $result['message'][] = "По рахунку № $invoice->number зараховано $paymentAmount";

            }
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            $result = ['status' => 'error', 'message' => $e->getMessage()];
        }
        return $result;
    }

}