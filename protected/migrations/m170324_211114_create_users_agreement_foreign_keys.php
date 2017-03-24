<?php

class m170324_211114_create_users_agreement_foreign_keys extends CDbMigration {

    public function safeUp() {
        $this->execute("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_DATE',''))");
        $this->execute("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_IN_DATE',''))");
        $this->addForeignKey('FK_acc_user_agreements_user', 'acc_user_agreements', 'user_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_acc_user_agreements_approval_user', 'acc_user_agreements', 'approval_user', 'user', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_acc_user_agreements_cancel_user', 'acc_user_agreements', 'cancel_user', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown() {
        $this->dropForeignKey('FK_acc_user_agreements_user', 'acc_user_agreements');
        $this->dropForeignKey('FK_acc_user_agreements_approval_user', 'acc_user_agreements');
        $this->dropForeignKey('FK_acc_user_agreements_cancel_user', 'acc_user_agreements');
    }
}