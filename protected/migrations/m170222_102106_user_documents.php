<?php

class m170222_102106_user_documents extends CDbMigration
{
	public function up()
	{
		$this->createTable('user_documents', array(
			'id' => 'INT NOT NULL PRIMARY KEY AUTO_INCREMENT',
			'id_user' => 'INT(10) NOT NULL',
			'type' => 'VARCHAR(30) NOT NULL',
			'file_name' => 'TEXT NOT NULL',
			'upload_time' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'check' => 'BOOLEAN NOT NULL DEFAULT FALSE',
		));

		$this->addForeignKey('FK_users_documents', 'user_documents', 'id_user', 'user', 'id');
	}

	public function down()
	{
		$this->dropTable('user_documents');
	}
}