<?php

class m170324_212751_create_users_agreement_service_foreign_key extends CDbMigration {

    public function safeUp() {
        $this->execute("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_DATE',''))");
        $this->execute("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_IN_DATE',''))");

        $this->dropForeignKey('FK_messages_payment_acc_service', 'messages_payment');
        $this->alterColumn('acc_service', 'service_id', 'INT(10) UNSIGNED AUTO_INCREMENT');
        $this->alterColumn('messages_payment', 'service_id', 'INT(10) UNSIGNED');
        $this->alterColumn('acc_user_agreements', 'service_id', 'INT(10) UNSIGNED');
        $this->addForeignKey('FK_messages_payment_acc_service', 'messages_payment', 'service_id', 'acc_service', 'service_id');

        $this->addForeignKey('FK_acc_user_agreements_service', 'acc_user_agreements', 'service_id', 'acc_service', 'service_id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_acc_course_service_service', 'acc_course_service', 'service_id', 'acc_service', 'service_id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_acc_module_service_service', 'acc_module_service', 'service_id', 'acc_service', 'service_id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown() {
        $this->dropForeignKey('FK_acc_user_agreements_service', 'acc_user_agreements');
        $this->dropForeignKey('FK_acc_course_service_service', 'acc_course_service');
        $this->dropForeignKey('FK_acc_module_service_service', 'acc_module_service');
    }
}