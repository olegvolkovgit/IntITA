<?php

class m160205_124802_task_marks_change_column_time extends CDbMigration
{
	public function up()
	{
		$this->renameColumn('task_marks', 'time', 'date');
		$this->alterColumn('task_marks', 'date', 'DATE');
	}

	public function down()
	{
		$this->renameColumn('task_marks', 'date', 'time');
		$this->alterColumn('task_marks', 'time', 'VARCHAR(30) NOT NULL');
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