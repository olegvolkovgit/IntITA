<?php

class m170131_180332_create_table_users_email extends CDbMigration
{
	public function up()
	{
		$this->createTable('users_email', array(
			'email' => 'VARCHAR(60) NOT NULL',
			'PRIMARY KEY (`email`)',
		));
	}

	public function down()
	{
		$this->dropTable('users_email');
	}
}