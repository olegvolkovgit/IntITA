<?php

class m170602_181628_acc_contracting_party_corporate_entity_representatives extends CDbMigration {

    public function safeUp() {
        $this->createTable('acc_contracting_party_corporate_entity_representatives', [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'contracting_party_id' => 'INT NOT NULL',
            'corporate_representative_id' => 'INT NOT NULL',
            'CONSTRAINT FK_contracting_party_1 FOREIGN KEY (`contracting_party_id`) REFERENCES acc_contracting_party (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT',
            'CONSTRAINT FK_corporate_representative_1 FOREIGN KEY (`corporate_representative_id`) REFERENCES acc_corporate_representative (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT'
        ]);
    }

    public function safeDown() {
        $this->dropForeignKey('FK_contracting_party_1', 'acc_contracting_party_corporate_entity_representatives');
        $this->dropForeignKey('FK_corporate_representative_1', 'acc_contracting_party_corporate_entity_representatives');
        $this->dropTable('acc_contracting_party_corporate_entity_representatives');
    }
}