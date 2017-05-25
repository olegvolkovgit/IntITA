<?php

class m170523_162824_add_checking_account_id_column_to_corporate_entity_service extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('acc_corporate_entity_service', 'checkingAccountId', 'INT(11) NOT NULL');
        $this->update('acc_corporate_entity_service', array('checkingAccountId' => 1));
        $this->addForeignKey('FK_acc_corporate_entity_service_checking_accounts', 'acc_corporate_entity_service', 'checkingAccountId', 'acc_checking_accounts', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_acc_corporate_entity_service_checking_accounts', 'acc_corporate_entity_service');
        $this->dropColumn('acc_corporate_entity_service', 'checkingAccountId');
    }
}