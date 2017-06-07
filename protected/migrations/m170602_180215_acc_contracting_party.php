<?php

class m170602_180215_acc_contracting_party extends CDbMigration {

    public function safeUp() {
        $this->createTable('acc_contracting_party', [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'type_id' => 'INT NOT NULL',
            'CONSTRAINT `FK_contracting_party_type` FOREIGN KEY (`type_id`) REFERENCES `acc_contracting_party_type` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT',
        ]);
    }

    public function safeDown() {
        $this->dropForeignKey('FK_contracting_party_type', 'acc_contracting_party');
        $this->dropTable('acc_contracting_party');
    }
}