<?php

class m170523_175218_add_id_checking_account_column_to_acc_user_agreements extends CDbMigration
{
    public function safeUp() {
        $this->addColumn('acc_user_agreements', 'id_checking_account', 'INT(11)');
        $this->update('acc_user_agreements', ['id_checking_account' => 1]);
        $this->addForeignKey('FK_user_agreement_checking_account', 'acc_user_agreements', 'id_checking_account', 'acc_checking_accounts', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown() {
        $this->dropForeignKey('FK_user_agreement_checking_account', 'acc_user_agreements');
        $this->dropColumn('acc_user_agreements', 'id_checking_account');
    }
}