<?php

class m170324_210751_create_internal_pays_external_pays_foreign_key extends CDbMigration
{
    public function safeUp() {
        $this->execute("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_DATE',''))");
        $this->execute("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_IN_DATE',''))");

        /*
         * Remove all records from internal pays table that haven't related record in external pays table
         * I'v made this to avoid problems while migration on qa database since it has data inconsistency.
         * Production db doesn't have such problems
         */
        $this->execute("DELETE acc_internal_pays
                            FROM acc_internal_pays
                              LEFT JOIN acc_external_pays e ON acc_internal_pays.externalPaymentId = e.id
                            WHERE e.id IS NULL
                            ");
        $this->addForeignKey('FK_acc_internal_pays_external_pays', 'acc_internal_pays', 'externalPaymentId', 'acc_external_pays', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown() {
        $this->dropForeignKey('FK_acc_internal_pays_external_pays', 'acc_internal_pays');
    }
}