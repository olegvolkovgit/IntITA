<?php

class m161128_123859_group_access_to_content extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('group_access_to_content', array(
			'group_id' => 'INT(10) NOT NULL',
			'service_id' => 'INT(10) NOT NULL',
			'start_date' => 'DATE DEFAULT NULL',
			'end_date' => 'DATE DEFAULT NULL',
			'PRIMARY KEY (`group_id`, `service_id`)',
		));
	}

	public function safeDown()
	{
		$this->dropTable('group_access_to_content');
	}
}