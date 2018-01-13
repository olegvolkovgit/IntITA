<?php

class m180112_123059_create_table_task_documents extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('crm_task_documents', array(
            'id' => 'INT NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'id_task' => 'INT(10) NOT NULL',
            'file_name' => 'TEXT NOT NULL',
            'uploaded_by' => 'INT(11) NOT NULL',
            'upload_time' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
        ));

        $this->addForeignKey('FK_task_documents_user', 'crm_task_documents', 'uploaded_by', 'user', 'id');
        $this->addForeignKey('FK_task_documents_task', 'crm_task_documents', 'id_task', 'crm_tasks', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_task_documents_task','crm_task_documents');
        $this->dropForeignKey('FK_task_documents_user','crm_task_documents');

        $this->dropTable('crm_task_documents');
    }
}