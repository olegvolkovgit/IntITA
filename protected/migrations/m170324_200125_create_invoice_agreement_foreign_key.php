<?php

class m170324_200125_create_invoice_agreement_foreign_key extends CDbMigration
{
    public function safeUp() {
        $this->execute("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_DATE',''))");
        $this->execute("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_IN_DATE',''))");
        /*
         * Remove all records from invoices table that haven't related agreement in agreements table
         * I'v made this to avoid problems while migration on qa database since it has data inconsistency.
         * Production db doesn't have such problems
         */
        $this->execute("DELETE acc_invoice
                            FROM acc_invoice
                              LEFT JOIN acc_user_agreements a ON a.id = acc_invoice.agreement_id
                            WHERE a.id IS NULL;
                            ");
        $this->addForeignKey('FK_acc_invoice_user_agreement', 'acc_invoice', 'agreement_id', 'acc_user_agreements', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown() {
        $this->dropForeignKey('FK_acc_invoice_user_agreement', 'acc_invoice');
    }
}