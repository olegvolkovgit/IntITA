<?php

class m170306_140450_messages_service_schemes_request extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('messages_service_schemes_request', array(
			'id_message' => 'INT NOT NULL',
			'id_service' => 'INT(10) NOT NULL',
			'id_schema_template' => 'INT(10) NOT NULL',
			'id_user' => 'INT(10) NOT NULL',
			'date_create' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'date_checked' => 'DATETIME NULL',
			'user_checked' => 'INT(10) NULL',
			'status' => 'TINYINT(1) NOT NULL DEFAULT \'0\' COMMENT \'0 - actual, 1 - in process, 2 - approved, 3 - cancelled\'',
			'comment' => 'VARCHAR(255) NULL DEFAULT NULL',
			'reject_comment' => 'VARCHAR(255) NULL DEFAULT NULL',
		),
			'COMMENT=\'User requests about apply service schema(to accountant).\'
            COLLATE=\'utf8_general_ci\'
            ENGINE=InnoDB'
		);
		$this->insert('messages_type', array(
			'id' => '13',
			'type' => 'service_schemes_request',
			'description' => 'User requests about apply service schema'
		));
	}

	public function safeDown()
	{
		$this->dropTable('messages_service_schemes_request');
		$this->delete('messages_type', 'id=13');
	}
}