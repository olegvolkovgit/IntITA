<?php

class m160205_121537_task_marks_add_result_and_warning extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('task_marks','result','TEXT NULL DEFAULT NULL');
		$this->addColumn('task_marks','warning','TEXT NULL DEFAULT NULL');
	}

	public function safeDown()
	{
		$this->dropColumn('task_marks','result');
		$this->dropColumn('task_marks','warning');
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