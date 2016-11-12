<?php

class m161019_140515_create_table_subgroups extends CDbMigration
{
	public function up()
	{
		$this->createTable('offline_subgroups', array(
			'id' => 'pk',
			'name' => 'varchar(128) NOT NULL',
			'group' => 'INT(10) NOT NULL',
			'data' => 'TEXT DEFAULT NULL',
		));
	}

	public function safeDown()
	{
		$this->dropTable('offline_subgroups');
	}
}