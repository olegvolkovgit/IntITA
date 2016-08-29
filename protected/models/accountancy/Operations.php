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
     * @return bool
     * @throws Exception
     */
    private function getUnpaidInvoices($agreementId, $invoices, $amount) {
        if (!is_empty($invoices) && is_array($invoices)) {
            /* if we have is in invoices we should check if this invoices unpaid */
            $agreementInvoices = Invoice::model()->findAllByPk($invoices, 'agreement_id=:agreementId', [':agreementId' => $agreementId]);
            if (count($agreementInvoices) !== count($invoices)) {
                throw new Exception("Invoices count don't match");
            }

            foreach ($agreementInvoices as $invoice) {
                if ($invoice->internalPayment !== null) {
//                    throw 
                }
            }

        } else {
            /* otherwise we should select invoices to cover the sum */
        }

        return false;
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

    public function performOperation($operation) {
        $transaction = Yii::app()->db->beginTransaction();
        $result = [];
        try {
            $invoicesCriteria = new CDbCriteria([
                'condition' => 'agreement_id=:agreementId',
                'params' => [':agreementId' => $operation['agreementId']],
                'order' => 'expiration_date ASC'
            ]);
            $operationInvoices = $this->getUnpaidInvoices($operation['agreementId'], $operation['invoices'], $operation['amount']);

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            $result = ['status' => 'error', 'message' => $e];
        }
        return $result;
    }

}