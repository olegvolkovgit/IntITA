<?php

class m170708_110131_update_user_documents_table extends CDbMigration
{
    public function safeUp()
    {
        $this->renameTable('user_documents', 'acc_documents_files');
        $this->dropForeignKey('FK_users_documents', 'acc_documents_files');
        $this->addColumn('acc_documents_files','id_document','INT(11) NOT NULL');
        $this->dropColumn('acc_documents_files', 'id_user');
        $this->dropColumn('acc_documents_files', 'type');
        $this->dropColumn('acc_documents_files', 'check');

        $this->addForeignKey('FK_documents_files_user_documents', 'acc_documents_files', 'id_document', 'acc_user_documents', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        return false;
    }
}