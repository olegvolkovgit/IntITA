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
     * @param Invoice[] $agreementInvoices
     * @param array $invoices
     * @return bool
     */
    private function getUnpaidInvoices($agreementInvoices, $invoices) {
//        $invoices =
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
            $agreementInvoices = Invoice::model()->with('internalPayment')->findAll($invoicesCriteria);
            $operationInvoices = null;

            if (!is_empty($operation['invoices'])) {
                $operationInvoices = $this->getUnpaidInvoices($agreementInvoices, $operation['invoices']);
            } else {

            }

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            $result = ['status' => 'error', 'message' => $e];
        }

        echo json_encode($result);
    }

}