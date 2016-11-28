<?php

class m161128_112426_add_tasks_table extends CDbMigration
{

	public function safeUp()
	{
		$this->createTable('tasks', array(
			'id' => 'pk',
			'name' => 'VARCHAR(255) NOT NULL',
			'type' => 'INT(10) NOT NULL',
			'start_time' => 'DATETIME NULL DEFAULT NULL',
			'end_time' => 'DATETIME NULL DEFAULT NULL',
			'parameters' => 'TEXT DEFAULT NULL',
			'status' => 'INT(10) NOT NULL',
			'error' => 'VARCHAR(255) DEFAULT NULL',
		));
	}

	public function safeDown()
	{
		echo "m161128_112426_add_tasks_table goes down.\n";
		$this->dropTable('tasks');
		return true;
	}

}