<?php

class m170602_180832_acc_contracting_party_corporate_entity extends CDbMigration {

    public function safeUp() {
        $this->createTable('acc_contracting_party_corporate_entity', [
            'id' => 'INT PRIMARY KEY',
            'corporate_entity_id' => 'INT NOT NULL',
            'checking_account_id' => 'INT NOT NULL',
            'CONSTRAINT FK_contracting_party FOREIGN KEY (`id`) REFERENCES `acc_contracting_party` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT',
            'CONSTRAINT FK_corporate_entity FOREIGN KEY (`corporate_entity_id`) REFERENCES `acc_corporate_entity` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT',
            'CONSTRAINT FK_checking_accounts FOREIGN KEY (`checking_account_id`) REFERENCES `acc_checking_accounts` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT'
        ]);
    }

    public function safeDown() {
        $this->dropForeignKey('FK_checking_accounts', 'acc_contracting_party_corporate_entity');
        $this->dropForeignKey('FK_corporate_entity', 'acc_contracting_party_corporate_entity');
        $this->dropForeignKey('FK_contracting_party', 'acc_contracting_party_corporate_entity');
        $this->dropTable('acc_contracting_party_corporate_entity');
    }
}