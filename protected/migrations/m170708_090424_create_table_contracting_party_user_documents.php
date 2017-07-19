<?php

class m170708_090424_create_table_contracting_party_user_documents extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('acc_contracting_party_user_documents', array(
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'id_contracting_party' => 'INT(11) NOT NULL',
            'id_documents' => 'INT(11) NOT NULL',
            'create_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'checked_by' => 'INT(10) NOT NULL',
        ));

        $this->addForeignKey('FK_contracting_party_user_documents_party', 'acc_contracting_party_user_documents', 'id_contracting_party', 'acc_contracting_party_private_person', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_contracting_party_user_documents_documents', 'acc_contracting_party_user_documents', 'id_contracting_party', 'acc_contracting_party_private_person', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_contracting_party_user_documents_user_checked', 'acc_contracting_party_user_documents', 'checked_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_contracting_party_user_documents_party', 'acc_contracting_party_user_documents');
        $this->dropForeignKey('FK_contracting_party_user_documents_documents', 'acc_contracting_party_user_documents');
        $this->dropForeignKey('FK_contracting_party_user_documents_user_checked', 'acc_contracting_party_user_documents');

        $this->dropTable('acc_contracting_party_user_documents');
    }
}