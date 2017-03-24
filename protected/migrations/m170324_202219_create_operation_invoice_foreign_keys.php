<?php

class m170324_202219_create_operation_invoice_foreign_keys extends CDbMigration
{
    public function safeUp() {
        $this->execute("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_DATE',''))");
        $this->execute("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_IN_DATE',''))");
        $this->addForeignKey('FK_acc_operation_invoice_invoice', 'acc_operation_invoice', 'id_invoice', 'acc_invoice', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_acc_operation_invoice_operation', 'acc_operation_invoice', 'id_operation', 'acc_operation', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown() {
        $this->dropForeignKey('FK_acc_operation_invoice_invoice', 'acc_operation_invoice');
        $this->dropForeignKey('FK_acc_operation_invoice_operation', 'acc_operation_invoice');
    }
}