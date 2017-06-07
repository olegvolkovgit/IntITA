<?php

class m170602_184917_acc_contracting_party_private_person extends CDbMigration {

    public function safeUp() {
        $this->createTable('acc_contracting_party_private_person', [
            'id' => 'INT PRIMARY KEY',
            'user_id' => 'INT NOT NULL',
            'CONSTRAINT FK_contracting_party_2 FOREIGN KEY (`id`) REFERENCES `acc_contracting_party` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT',
            'CONSTRAINT FK_user FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT',
        ]);
    }

    public function safeDown() {
        $this->dropForeignKey('FK_contracting_party_2', 'acc_contracting_party_private_person');
        $this->dropForeignKey('FK_user', 'acc_contracting_party_private_person');
        $this->dropTable('acc_contracting_party_private_person');
    }
}