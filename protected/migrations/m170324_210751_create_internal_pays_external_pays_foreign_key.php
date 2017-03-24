<?php

class m170324_210751_create_internal_pays_external_pays_foreign_key extends CDbMigration
{
    public function safeUp() {
        $this->execute("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_DATE',''))");
        $this->execute("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_IN_DATE',''))");
        $this->addForeignKey('FK_acc_internal_pays_external_pays', 'acc_internal_pays', 'externalPaymentId', 'acc_external_pays', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown() {
        $this->dropForeignKey('FK_acc_internal_pays_external_pays', 'acc_internal_pays');
    }
}