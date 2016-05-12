<?php

class m160511_203053_create_quiz_uid_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('quiz_uid', [
            'uid' => 'INT(10) AUTO_INCREMENT PRIMARY KEY',
            'id_module' => 'INT(10) NOT NULL'
        ]);
	}

	public function down()
	{
		$this->dropTable('quiz_uid');
		return true;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}