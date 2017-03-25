<?php

class m170324_193335_bind_users_agreements_to_corporate_entity extends CDbMigration {

    public function safeUp() {
        $this->execute("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_DATE',''))");
        $this->execute("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_IN_DATE',''))");
        $this->addColumn('acc_user_agreements', 'id_corporate_entity', 'INT(10)');
        $this->addForeignKey('FK_user_agreement_corporate_entity', 'acc_user_agreements', 'id_corporate_entity', 'acc_corporate_entity', 'id', 'RESTRICT', 'RESTRICT');
        $this->update('acc_user_agreements', ['id_corporate_entity' => 1]);
        $this->alterColumn('acc_user_agreements', 'id_corporate_entity', 'INT(10) NOT NULL');
    }

    public function safeDown() {
        $this->dropForeignKey('FK_user_agreement_corporate_entity', 'acc_user_agreements');
        $this->dropColumn('acc_user_agreements', 'id_corporate_entity');
    }
}