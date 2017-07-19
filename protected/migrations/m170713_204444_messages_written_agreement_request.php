<?php

class m170713_204444_messages_written_agreement_request extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('messages_written_agreements_request', array(
            'id_message' => 'INT NOT NULL',
            'id_agreement' => 'INT(10) NOT NULL',
            'id_user' => 'INT(10) NOT NULL',
            'date_create' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'date_checked' => 'DATETIME NULL',
            'user_checked' => 'INT(10) NULL',
            'status' => 'TINYINT(1) DEFAULT NULL COMMENT \'0 - cancelled, 1 - approved\'',
            'comment' => 'VARCHAR(255) NULL DEFAULT NULL',
            'reject_comment' => 'VARCHAR(255) NULL DEFAULT NULL',
        ),
            'COMMENT=\'User requests about apply written agreement(to accountant).\'
            COLLATE=\'utf8_general_ci\'
            ENGINE=InnoDB'
        );
        $this->insert('messages_type', array(
            'id' => '14',
            'type' => 'written_agreement_request',
            'description' => 'User requests about apply written agreement'
        ));
    }

    public function safeDown()
    {
        $this->dropTable('messages_written_agreements_request');
        $this->delete('messages_type', 'id=14');
    }
}