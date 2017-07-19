<?php

class m170707_085231_create_user_documents_table extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('acc_user_documents', array(
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'id_user' => 'INT(11) NOT NULL',
            'type' => 'INT NOT NULL',
            'number' => 'VARCHAR(255) DEFAULT NULL',
            'issued' => 'VARCHAR(255) DEFAULT NULL',
            'issued_date' => 'DATE DEFAULT NULL',
            'registration_address' => 'VARCHAR(255) DEFAULT NULL',
            'updatedAt' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'checked' => 'BOOLEAN NOT NULL DEFAULT FALSE',
            'actual' => 'BOOLEAN NOT NULL DEFAULT TRUE',
            'checked_date' => 'DATETIME DEFAULT NULL',
            'description' => 'VARCHAR(255) DEFAULT NULL',
            'UNIQUE KEY UC_user_documents_type_actual (`id_user`, `type`, `actual`)'
        ));

        $this->addForeignKey('FK_user_documents_documents_types', 'acc_user_documents', 'type', 'acc_documents_types', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_user_documents_user', 'acc_user_documents', 'id_user', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_user_documents_user', 'acc_user_documents');
        $this->dropForeignKey('FK_user_documents_documents_types', 'acc_user_documents');

        $this->dropTable('acc_user_documents');
    }
}