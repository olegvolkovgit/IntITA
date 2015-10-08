<?php

class m151006_134030_add_column_time_to_task_marks extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('task_marks', 'time', 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
	}

	public function down()
	{
		$this->dropColumn('task_marks', 'time');
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