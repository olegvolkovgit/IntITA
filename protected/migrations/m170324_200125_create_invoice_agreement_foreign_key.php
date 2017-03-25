<?php

class m170324_200125_create_invoice_agreement_foreign_key extends CDbMigration
{
    public function safeUp() {
        $this->execute("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_DATE',''))");
        $this->execute("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_IN_DATE',''))");
        $this->addForeignKey('FK_acc_invoice_user_agreement', 'acc_invoice', 'agreement_id', 'acc_user_agreements', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown() {
        $this->dropForeignKey('FK_acc_invoice_user_agreement', 'acc_invoice');
    }
}