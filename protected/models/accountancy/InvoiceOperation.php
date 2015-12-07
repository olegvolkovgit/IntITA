<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 07.12.2015
 * Time: 16:04
 */

class InvoiceOperation implements IOperation {

    public function perform($summa, $user, $type, $invoicesListId, $externalSource){

        $this->summa = $summa;
        $this->user_create = $user;

        $this->type_id = $type;
        $this->invoicesList = Invoice::getInvoiceListById($invoicesListId);

        $transaction = Yii::app()->db->beginTransaction();
        try
        {
            if ($this->save()){
                $this->addInvoices($invoicesListId);
                $createDate = Operation::model()->findByPk($this->id)->date_create;
                if(!ExternalPays::addNewExternalPay($this, $createDate, $externalSource)){
                    throw new \application\components\Exceptions\FinanceException('External pay is failed!');
                }
                if (!$this->addInternalPays($this->invoicesList, $createDate, $this->type_id)){
                    throw new \application\components\Exceptions\FinanceException('Internal pay is failed!');
                }
                Invoice::setInvoicesPayDate($this->invoicesList, $createDate);
                $transaction->commit();
            } else {
                throw new \application\components\Exceptions\FinanceException('Adding operation is failed!');
            }
        }
        catch(Exception $e)
        {
            $transaction->rollback();
            throw new \application\components\Exceptions\FinanceException('Операцію не додано! '.$e->getMessage());
        }
    }

    public function cancel(){

    }

}