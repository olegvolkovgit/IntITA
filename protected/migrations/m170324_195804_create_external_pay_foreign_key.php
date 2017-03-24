<?php

class m170324_195804_create_external_pay_foreign_key extends CDbMigration {

    public function safeUp() {
        $this->addForeignKey('FK_acc_external_pays_corporate_entity', 'acc_external_pays', 'companyId', 'acc_corporate_entity', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown() {
        $this->dropForeignKey('FK_acc_external_pays_corporate_entity', 'acc_external_pays');
    }
}