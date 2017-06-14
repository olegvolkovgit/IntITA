<?php

class m170602_185144_acc_user_agreement_contracting_party extends CDbMigration {

    public function safeUp() {
        $this->createTable('acc_user_agreement_contracting_party', [
            'user_agreement_id' => 'INT NOT NULL',
            'contracting_party_id' => 'INT NOT NULL',
            'role_id' => 'INT NOT NULL',
            'CONSTRAINT FK_user_agreement FOREIGN KEY (`user_agreement_id`) REFERENCES `acc_user_agreements` (`id`)',
            'CONSTRAINT FK_contracting_party_4 FOREIGN KEY (`contracting_party_id`) REFERENCES `acc_contracting_party` (`id`)',
            'CONSTRAINT FK_contracting_party_role FOREIGN KEY (`role_id`) REFERENCES `acc_contracting_party_role` (`id`)',
            'UNIQUE KEY UC_user_agreement_contracting_party (`user_agreement_id`, `contracting_party_id`)'
        ]);
    }

    public function safeDown() {
        $this->dropForeignKey('FK_user_agreement', 'acc_user_agreement_contracting_party');
        $this->dropForeignKey('FK_contracting_party_4', 'acc_user_agreement_contracting_party');
        $this->dropForeignKey('FK_contracting_party_role', 'acc_user_agreement_contracting_party');
        $this->dropTable('acc_user_agreement_contracting_party');
    }
}