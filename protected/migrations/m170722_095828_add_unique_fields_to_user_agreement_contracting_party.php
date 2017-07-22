<?php

class m170722_095828_add_unique_fields_to_user_agreement_contracting_party extends CDbMigration
{
    public function safeUp()
    {
        $this->dropForeignKey('FK_user_agreement', 'acc_user_agreement_contracting_party');
        $this->dropForeignKey('FK_contracting_party_4', 'acc_user_agreement_contracting_party');
        $this->dropForeignKey('FK_contracting_party_role', 'acc_user_agreement_contracting_party');

        $this->dropIndex('UC_user_agreement_contracting_party', 'acc_user_agreement_contracting_party');

        $this->addForeignKey('FK_user_agreement', 'acc_user_agreement_contracting_party', 'user_agreement_id', 'acc_user_agreements', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_contracting_party_4', 'acc_user_agreement_contracting_party', 'contracting_party_id', 'acc_contracting_party', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_contracting_party_role', 'acc_user_agreement_contracting_party', 'role_id', 'acc_contracting_party_role', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('UC_user_agreement_contracting_party', 'acc_user_agreement_contracting_party',
            array('user_agreement_id','role_id'), true);
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_user_agreement', 'acc_user_agreement_contracting_party');
        $this->dropForeignKey('FK_contracting_party_4', 'acc_user_agreement_contracting_party');
        $this->dropForeignKey('FK_contracting_party_role', 'acc_user_agreement_contracting_party');

        $this->dropIndex('UC_user_agreement_contracting_party', 'acc_user_agreement_contracting_party');

        $this->addForeignKey('FK_user_agreement', 'acc_user_agreement_contracting_party', 'user_agreement_id', 'acc_user_agreements', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_contracting_party_4', 'acc_user_agreement_contracting_party', 'contracting_party_id', 'acc_contracting_party', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_contracting_party_role', 'acc_user_agreement_contracting_party', 'role_id', 'acc_contracting_party_role', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('UC_user_agreement_contracting_party', 'acc_user_agreement_contracting_party',
            array('user_agreement_id','contracting_party_id'), true);
    }

}